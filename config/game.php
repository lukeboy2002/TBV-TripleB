<?php

return [
    // The base maximum points for the winner when no bonus is applied
    'base_max_points' => env('GAME_BASE_MAX_POINTS', 14),

    // Additional bonus points for the winner. Set to 0 to disable bonus.
    // Example: with base_max_points=14 and winner_bonus=2, the winner gets 16 points.
    'winner_bonus' => env('GAME_WINNER_BONUS', 2),
];
