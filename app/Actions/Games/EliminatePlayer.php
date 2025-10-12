<?php

namespace App\Actions\Games;

use App\Models\Game;

class EliminatePlayer
{
    /**
     * @param  array<int,int>  $eliminatedPlayers
     * @return array{0:Game|null,1:array<int,int>,2:bool}
     */
    public function __invoke(?Game $currentGame, array $eliminatedPlayers, int $playerId): array
    {
        if (! $currentGame) {
            return [null, $eliminatedPlayers, false];
        }

        $totalPlayers = $currentGame->gamePlayers()->count();

        $position = count($eliminatedPlayers) + 1;
        $points = $position;

        $gamePlayer = $currentGame->gamePlayers()->where('user_id', $playerId)->first();
        if (! $gamePlayer) {
            return [$currentGame, $eliminatedPlayers, false];
        }

        $gamePlayer->update([
            'position' => $position,
            'points' => $points,
            'is_winner' => false,
        ]);

        $eliminatedPlayers[] = $playerId;

        $completed = false;

        if (count($eliminatedPlayers) === ($totalPlayers - 1)) {
            $allPlayerIds = $currentGame->gamePlayers()->pluck('user_id')->toArray();
            $lastPlayerId = collect($allPlayerIds)->diff($eliminatedPlayers)->first();

            if ($lastPlayerId) {
                $currentGame->gamePlayers()->where('user_id', $lastPlayerId)->update([
                    'position' => $totalPlayers,
                    'points' => $totalPlayers,
                    'is_winner' => true,
                ]);

                $eliminatedPlayers[] = $lastPlayerId;
            }

            $currentGame->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $currentGame = null;
            $completed = true;
        }

        return [$currentGame, $eliminatedPlayers, $completed];
    }
}
