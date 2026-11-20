<?php

namespace App\Livewire\Games;

use App\Actions\Games\EliminatePlayer;
use App\Actions\Games\IsFirstGameOfDay;
use App\Actions\Games\LoadCurrentGame;
use App\Actions\Games\PrepareNewGame;
use App\Actions\Games\SortPresentPlayers;
use App\Actions\Games\StartNewGame;
use App\Actions\Games\UploadCupPhoto;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class GamesCreate extends Component
{
    use WithFileUploads;

    public $showGameForm = true;

    public $gameDate;

    public $selectedPlayers = [];

    public $currentGame = null;

    public $eliminatedPlayers = [];

    public $cupPhoto;

    public function mount(LoadCurrentGame $loader)
    {
        $this->gameDate = now()->format('Y-m-d H:i');
        [$this->currentGame, $this->eliminatedPlayers] = $loader();
    }

    public function loadCurrentGame(LoadCurrentGame $loader)
    {
        [$this->currentGame, $this->eliminatedPlayers] = $loader();
    }

    public function getPresentGamePlayersProperty(): Collection
    {
        if (! $this->currentGame) {
            return collect();
        }

        return app(SortPresentPlayers::class)($this->currentGame, (array) $this->eliminatedPlayers);
    }

    public function isFirstGameOfDay($game, ?IsFirstGameOfDay $action = null)
    {
        $action = $action ?? app(IsFirstGameOfDay::class);

        return $action($game);
    }

    public function startNewGame(StartNewGame $action)
    {
        [$this->showGameForm, $this->currentGame, $this->eliminatedPlayers] = $action(
            $this->gameDate,
            $this->selectedPlayers
        );

        $this->dispatch('game-started');
    }

    public function eliminatePlayer(EliminatePlayer $action, $playerId)
    {
        [$this->currentGame, $this->eliminatedPlayers, $completed] = $action(
            $this->currentGame,
            $this->eliminatedPlayers,
            (int) $playerId
        );

        if ($completed) {
            $this->dispatch('game-completed');
            $this->prepareNewGame(app(PrepareNewGame::class));
        }

        $this->dispatch('player-eliminated');
    }

    public function prepareNewGame(PrepareNewGame $action)
    {
        [$this->selectedPlayers, $this->gameDate, $this->showGameForm] = $action();
    }

    public function toggleSelectAll(): void
    {
        $allPlayers = User::role('member')->pluck('id')->map(fn ($id) => (int) $id)->toArray();
        $currentSelected = array_map('intval', (array) $this->selectedPlayers);

        if (! empty($allPlayers) && count(array_diff($allPlayers, $currentSelected)) === 0) {
            $this->selectedPlayers = [];
        } else {
            $this->selectedPlayers = $allPlayers;
        }
    }

    public function selectAll(): void
    {
        $this->selectedPlayers = User::role('member')->pluck('id')->map(fn ($id) => (int) $id)->toArray();
    }

    public function deselectAll(): void
    {
        $this->selectedPlayers = [];
    }

    public function areAllPlayersSelected(): bool
    {
        $allPlayers = User::role('member')->pluck('id')->map(fn ($id) => (int) $id)->toArray();

        if (empty($allPlayers)) {
            return false;
        }

        $currentSelected = array_map('intval', (array) $this->selectedPlayers);

        return count(array_diff($allPlayers, $currentSelected)) === 0;
    }

    //    public function updatedCupPhoto()
    //    {
    //        $this->validateOnly('cupPhoto', [
    //            'cupPhoto' => 'image|max:10240|mimes:jpg,jpeg,png,webp,heic,heif',
    //        ]);
    //    }

    //    TODO: UPLOAD IMAGES MADE BY PHONE
    public function uploadCupPhoto(UploadCupPhoto $action, $playerId)
    {
        $this->validate([
            'cupPhoto' => 'required|image|max:10240|mimes:jpg,jpeg,png,webp,heic,heif',
        ]);

        $ok = $action($this->cupPhoto, (int) $playerId);

        if (! $ok) {
            $this->addError('cupPhoto', __('Photo upload failed. Please try again.'));

            return;
        }

        $this->cupPhoto = null;
        $this->dispatch('cup-photo-uploaded');
    }

    public function render()
    {
        $availablePlayers = User::role('member')->get();

        return view('livewire.games.games-create', [
            'availablePlayers' => $availablePlayers,
        ]);
    }
}
