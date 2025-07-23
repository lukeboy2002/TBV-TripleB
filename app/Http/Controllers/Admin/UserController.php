<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function edit(User $user)
    {
        if (! auth()->user()->can('update', $user)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('user.edit', [
            'user' => $user,
        ]);
    }
}
