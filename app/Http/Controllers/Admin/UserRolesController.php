<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserRolesController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
}
