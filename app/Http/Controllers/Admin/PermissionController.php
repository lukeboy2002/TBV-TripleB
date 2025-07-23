<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.index');
    }

    public function edit(Permission $permission)
    {
        if (! auth()->user()->can('update', $permission)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('user.edit', [
            'permission' => $permission,
        ]);
    }
}
