<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Points;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with('users', 'winner', 'cupWinner')->get();

        return view('games.index', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game = Game::create([
            'date' => $request['date'],
        ]);

        $game->users()->attach($request->users);

        return redirect()->route('games.edit', $game)
            ->banner('Game created');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role('member')->get();

        return view('games.create', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //        $game = DB::table('games')
        //            ->join('game_user', 'games.id', '=', 'game_user.game_id') // assuming a pivot table for game-user relationship
        //            ->join('users', 'game_user.user_id', '=', 'users.id')
        //            ->join('points', 'points.game_id', '=', 'games.id')
        //            ->select('games.*', 'users.username', 'points.value as points')
        //            ->get();
        //
        //        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        Game::with('users')->findOrFail($game->id);

        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        Game::findOrFail($game->id);
        $game->winner_id = $request->winner_id;
        if ($request->cup_winner_id) {
            $game->cup_winner_id = $request->cup_winner_id;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->storeAs('cupwinners', $game->id.'-'.$game->cup_winner_id.'.'.$extension);

            $game->image = $filename;
        }
        $game->save();

        // Retrieve the users and their points from the request
        $users = $request->users; // Array of user IDs
        $pointsData = $request->points; // Array of points indexed by user ID

        foreach ($users as $userId) {
            // Ensure the points for the user exist in the request
            if (isset($pointsData[$userId])) {
                Points::create([
                    'game_id' => $game->id,
                    'user_id' => $userId,
                    'points' => $pointsData[$userId], // Access points using user ID
                ]);
            }
        }

        return redirect()->route('games.index', $game)
            ->banner('Game added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
