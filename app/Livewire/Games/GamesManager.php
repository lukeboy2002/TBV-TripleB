<?php

namespace App\Livewire\Games;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class GamesManager extends Component
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

        // Determine totals based on the current game, not transient component state
        $totalPlayers = $this->currentGame->gamePlayers()->count();

        $position = count($this->eliminatedPlayers) + 1;
        $points = $position;

        $gamePlayer = $this->currentGame->gamePlayers()->where('user_id', $playerId)->first();
        if (! $gamePlayer) {
            return; // Safety: player not part of current game
        }

        // Eliminated players are not winners; the last remaining player will be the winner
        $gamePlayer->update([
            'position' => $position,
            'points' => $points,
            'is_winner' => false,
        ]);

        $this->eliminatedPlayers[] = $playerId;

        // If only one player remains, complete the game and mark them as winner
        if (count($this->eliminatedPlayers) === ($totalPlayers - 1)) {
            // The last remaining player is the winner
            $allPlayerIds = $this->currentGame->gamePlayers()->pluck('user_id')->toArray();
            $lastPlayerId = collect($allPlayerIds)->diff($this->eliminatedPlayers)->first();

            if ($lastPlayerId) {
                $this->currentGame->gamePlayers()->where('user_id', $lastPlayerId)->update([
                    'position' => $totalPlayers,
                    'points' => $totalPlayers,
                    'is_winner' => true,
                ]);

                $this->eliminatedPlayers[] = $lastPlayerId;
            }

            $this->currentGame->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $this->currentGame = null;

            // Dispatch event that game is completed to refresh player statistics
            $this->dispatch('game-completed');

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

        return view('livewire.games.games-manager', [
            'availablePlayers' => $availablePlayers,
            'recentGames' => $recentGames,
        ]);
    }
}
