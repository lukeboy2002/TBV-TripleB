<?php

namespace App\Actions\Games;

use App\Models\Game;

class IsFirstGameOfDay
{
    public function __invoke(Game $game): bool
    {
        return ! Game::where('status', 'completed')
            ->whereDate('date', $game->date->toDateString())
            ->where('id', '!=', $game->id)
            ->whereNotNull('completed_at')
            ->where('completed_at', '<', $game->completed_at ?? now())
            ->exists();
    }
}
