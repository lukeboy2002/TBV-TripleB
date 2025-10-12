<?php

namespace App\Actions\Games;

use App\Models\Game;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StartNewGame
{
    /**
     * @param  array<int,int>  $selectedPlayers
     * @return array{0:bool,1:Game|null,2:array<int,int>}
     *
     * @throws ValidationException
     */
    public function __invoke(string $gameDate, array $selectedPlayers): array
    {
        Validator::validate([
            'gameDate' => $gameDate,
            'selectedPlayers' => $selectedPlayers,
        ], [
            'gameDate' => 'required|date',
            'selectedPlayers' => 'required|array|min:2',
        ]);

        $game = Game::create([
            'date' => $gameDate,
            'status' => 'in_progress',
        ]);

        foreach ($selectedPlayers as $playerId) {
            $game->gamePlayers()->create([
                'user_id' => $playerId,
            ]);
        }

        // showGameForm false, currentGame set, eliminatedPlayers reset
        return [false, $game, []];
    }
}
