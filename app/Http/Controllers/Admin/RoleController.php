<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function edit(Role $role)
    {
        if (! auth()->user()->can('update', $role)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('role.edit', [
            'role' => $role,
        ]);
    }
}
