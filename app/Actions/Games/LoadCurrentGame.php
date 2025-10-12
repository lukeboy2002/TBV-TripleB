<?php

namespace App\Actions\Games;

use App\Models\Game;

class LoadCurrentGame
{
    /**
     * @return array{0:Game|null,1:array<int,int>}
     */
    public function __invoke(): array
    {
        $currentGame = Game::where('status', 'in_progress')->latest()->first();

        $eliminated = [];
        if ($currentGame) {
            $eliminated = $currentGame->gamePlayers()
                ->whereNotNull('position')
                ->orderBy('position')
                ->with('user')
                ->get()
                ->pluck('user.id')
                ->toArray();
        }

        return [$currentGame, $eliminated];
    }
}
