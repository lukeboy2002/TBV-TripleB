<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('show:permission');

        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create:permission');

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create:permission');

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
        ]);

        $permission = Permission::create([
            'name' => $request['name'],
        ]);

        $role = Role::select('id')->where('name', 'admin')->first();

        $permission->roles()->attach($role);

        toastr()->success('Permission created successfully.', 'New Permission');
        return redirect()->route('admin.permissions.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permission $permission)
    {
        $this->authorize('update:permission');

        $roles = Role::all();

        return view('admin.permissions.edit', [
            'permission'=>$permission,
            'roles'=>$roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permission $permission)
    {
        $this->authorize('update:permission');

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission)],
        ]);

        $permission->update([
            'name' => $request['name'],
        ]);

        toastr()->success('Permission successfully updated.', 'Edit Permission');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        //
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            $request->session()->flash('error', 'Role already exists on permission.');
            return back();
        }

        $permission->assignRole($request->role);
        toastr()->success('Role successfully added to permission.', 'Edit Permission');

        return back();
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);

            toastr()->success('Role successfully removed from permission.', 'Edit Permission');
            return back();
        }

        toastr()->error('Role not exists.', 'Edit Permission');
        return back();
    }
}
