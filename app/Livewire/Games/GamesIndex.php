<?php

namespace App\Livewire\Games;

use App\Models\Game;
use Livewire\Component;
use Livewire\WithPagination;

class GamesIndex extends Component
{
    use WithPagination;

    protected $listeners = ['game-completed' => '$refresh'];

    public function render()
    {
        $recentGames = Game::where('status', 'completed')
            ->with('gamePlayers.user')
            ->orderBy('date', 'desc')
            ->paginate(3);

        return view('livewire.games.games-index', [
            'recentGames' => $recentGames,
        ]);
    }
}
