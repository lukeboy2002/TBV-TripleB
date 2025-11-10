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

        // Scoring rules:
        // - There are 14 total base points available for the last remaining player.
        // - If a bonus is chosen, the winner receives additional points (default +2 => 16 total).
        // - For a game with N players, the first eliminated gets (baseMax - N + 1) points,
        //   the second eliminated gets (baseMax - N + 2), ..., and the last (winner) gets baseMax (+ bonus).
        $baseMax = (int) config('game.base_max_points', 14);
        $winnerBonus = (int) config('game.winner_bonus', 0);

        $position = count($eliminatedPlayers) + 1; // 1-based elimination order
        $points = max(0, $baseMax - $totalPlayers + $position);

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
                    'points' => $baseMax + $winnerBonus,
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
