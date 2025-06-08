<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        if (! auth()->user()->can('create', Game::class)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('games.index');
    }
}
