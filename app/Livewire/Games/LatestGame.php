<?php

namespace App\Livewire\Games;

use App\Models\Game;
use Livewire\Component;

class LatestGame extends Component
{
    public function render()
    {
        $latestGame = Game::where('status', 'completed')
            ->orderByDesc('completed_at') // safest indicator of latest completed
            ->with(['gamePlayers' => function ($q) {
                // Winner first: highest position comes first
                $q->with('user')
                    ->orderByDesc('position')
                    // Optional tie-breaker if needed
                    ->orderByDesc('is_winner')
                    ->orderByDesc('id');
            }])
            ->first();

        return view('livewire.games.latest-game', [
            'latestGame' => $latestGame,
        ]);
    }
}
