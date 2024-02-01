<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('show:role');

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create:role');

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create:role');

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);

        Role::create([
            'name' => $request['name'],
        ]);

        toastr()->success('Role created successfully.', 'New Role');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        $this->authorize('update:role');

        $permissions = Permission::all();

        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions'=>$permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, role $role)
    {
        $this->authorize('update:role');

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role)],
        ]);

        $role->update([
            'name' => $request['name'],
        ]);

        toastr()->success('Role successfully updated.', 'Edit Role');

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(role $role)
    {
        //
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)) {
            $request->session()->flash('error', 'Permission already exists on role.');
            return back();
        }

        $role->givePermissionTo($request->permission);

        toastr()->success('Permission successfully added to role.', 'Edit Role');
        return back();
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);

            toastr()->success('Permission successfully removed from role.', 'Edit Role');
            return back();
        }

        toastr()->error('Permission not exists.', 'Edit Role');
        return back();
    }
}
