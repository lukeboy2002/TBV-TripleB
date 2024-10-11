<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Scorelist extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Retrieve all users with the 'member' role
        $users = User::role('member')->get();

        // Initialize an array to hold score data for members
        $scoreList = [];

        // Loop through each user to calculate their scores
        foreach ($users as $user) {
            $scoreData = DB::table('users')
                ->select(
                    'users.username',
                    DB::raw('COALESCE(SUM(points.points), 0) AS total_points'),
                    DB::raw('COALESCE(SUM(CASE WHEN games.winner_id = users.id THEN 1 ELSE 0 END), 0) AS total_wins'),
                    DB::raw('COALESCE(SUM(CASE WHEN games.cup_winner_id = users.id THEN 1 ELSE 0 END), 0) AS total_cups'),
                    DB::raw('COUNT(game_user.game_id) AS total_games_played') // Count the total number of games played
                )
                ->leftJoin('game_user', 'game_user.user_id', '=', 'users.id')
                ->leftJoin('games', 'game_user.game_id', '=', 'games.id')
                ->leftJoin('points', function ($join) {
                    $join->on('points.user_id', '=', 'users.id')
                        ->on('points.game_id', '=', 'games.id');
                })
                ->where('users.id', $user->id) // Filter by the current user ID
                ->groupBy('users.id')
                ->first(); // Get the first result as each user should only appear once

            // Add score data to the scoreList array
            $scoreList[] = $scoreData;
        }

        return view('components.scorelist', compact('scoreList'));
    }
}
