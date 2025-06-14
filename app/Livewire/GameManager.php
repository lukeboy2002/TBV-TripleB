<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class GameManager extends Component
{
    use WithFileUploads;

    public $showGameForm = false;

    public $gameDate;

    public $selectedPlayers = [];

    public $currentGame = null;

    public $eliminatedPlayers = [];

    public $cupPhoto;

    public function mount()
    {
        $this->gameDate = now()->format('Y-m-d H:i');
        $this->loadCurrentGame();
    }

    public function loadCurrentGame()
    {
        $this->currentGame = Game::where('status', 'in_progress')->latest()->first();
        if ($this->currentGame) {
            $this->eliminatedPlayers = $this->currentGame->gamePlayers()
                ->whereNotNull('position')
                ->orderBy('position')
                ->with('user')
                ->get()
                ->pluck('user.id')
                ->toArray();
        }
    }

    public function startNewGame()
    {

        $this->validate([
            'gameDate' => 'required|date',
            'selectedPlayers' => 'required|array|min:2',
        ]);

        $game = Game::create([
            'date' => $this->gameDate,
            'status' => 'in_progress',
        ]);

        foreach ($this->selectedPlayers as $playerId) {
            $game->gamePlayers()->create([
                'user_id' => $playerId,
            ]);
        }

        $this->showGameForm = false;
        $this->loadCurrentGame();
        $this->dispatch('game-started');
    }

    public function isFirstGameOfDay($game)
    {
        // Check if there are any other completed games on the same day
        return ! Game::where('status', 'completed')
            ->whereDate('date', $game->date->toDateString())
            ->where('id', '!=', $game->id)
            ->whereNotNull('completed_at')  // Voeg deze check toe
            ->where('completed_at', '<', $game->completed_at ?? now())
            ->exists();

    }

    public function eliminatePlayer($playerId)
    {
        if (! $this->currentGame) {
            return;
        }

        $position = count($this->eliminatedPlayers) + 1;
        $points = $position;
        $isWinner = ($position === count($this->selectedPlayers));

        $gamePlayer = $this->currentGame->gamePlayers()->where('user_id', $playerId)->first();
        $gamePlayer->update([
            'position' => $position,
            'points' => $points,
            'is_winner' => $isWinner,
        ]);

        $this->eliminatedPlayers[] = $playerId;

        // If this was the last player, complete the game
        if (count($this->eliminatedPlayers) === count($this->selectedPlayers) - 1) {
            // The last remaining player is the winner
            $lastPlayerId = collect($this->selectedPlayers)->diff($this->eliminatedPlayers)->first();
            $this->currentGame->gamePlayers()->where('user_id', $lastPlayerId)->update([
                'position' => count($this->selectedPlayers),
                'points' => count($this->selectedPlayers),
                'is_winner' => true,
            ]);

            $this->currentGame->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $this->eliminatedPlayers[] = $lastPlayerId;
            $this->currentGame = null;

            // Prepare for a new game immediately
            $this->prepareNewGame();
        }

        $this->dispatch('player-eliminated');
    }

    public function prepareNewGame()
    {
        // Reset game state
        $this->selectedPlayers = [];
        $this->gameDate = now()->format('Y-m-d H:i');
        $this->showGameForm = true;
    }

    public function uploadCupPhoto($playerId)
    {
        $this->validate([
            'cupPhoto' => 'required|image|max:1024',
        ]);

        $path = $this->cupPhoto->store('cup-photos', 'public');

        $gamePlayer = GamePlayer::where('user_id', $playerId)
            ->where('position', 1)
            ->latest()
            ->first();

        if ($gamePlayer) {
            $gamePlayer->update([
                'cup_photo_path' => $path,
            ]);
        }

        $this->cupPhoto = null;
        $this->dispatch('cup-photo-uploaded');
    }

    public function render()
    {
        $availablePlayers = User::role('member')->get();
        $recentGames = Game::where('status', 'completed')
            ->with('gamePlayers.user')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.game-manager', [
            'availablePlayers' => $availablePlayers,
            'recentGames' => $recentGames,
        ]);
    }
}
