<?php

namespace App\Actions\Games;

class PrepareNewGame
{
    /**
     * @return array{0:array<int,int>,1:string,2:bool}
     */
    public function __invoke(): array
    {
        $selectedPlayers = [];
        $gameDate = now()->format('Y-m-d H:i');
        $showGameForm = true;

        return [$selectedPlayers, $gameDate, $showGameForm];
    }
}
