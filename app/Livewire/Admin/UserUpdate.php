<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UserUpdate extends Component
{
    use AuthorizesRequests;

    public User $user;

    public $selectedRole;

    public $selectedPermission = '';

    public $newPermission = '';

    public function mount(User $user)
    {
        $this->authorize('update', $user);
        $this->user = $user;

        // Set the initial selected role
        $userRoles = $user->getRoleNames();
        if (count($userRoles) > 0) {
            $this->selectedRole = $userRoles[0];
        }
    }

    public function changeRole()
    {
        $this->validate([
            'selectedRole' => 'required|exists:roles,name',
        ]);

        // Remove all current roles and assign the new one
        $this->user->syncRoles([$this->selectedRole]);

        flash()->success('Role successfully changed for user.');
    }

    public function givePermission()
    {
        $permissionName = $this->newPermission ?: $this->selectedPermission;

        if (empty($permissionName)) {
            $this->addError('permission', 'Please select an existing permission or enter a new one.');

            return;
        }

        // Check if permission exists
        $permission = Permission::where('name', $permissionName)->first();

        // If permission doesn't exist, create it
        if (! $permission) {
            $permission = Permission::create(['name' => $permissionName, 'guard_name' => 'web']);

            flash()->success('New permission created successfully.');

        }

        // Check if user already has the permission
        if ($this->user->hasPermissionTo($permission)) {
            flash()->error('Permission already exists on user.');

            return;
        }

        // Give permission to user
        $this->user->givePermissionTo($permission);

        flash()->success('Permission successfully added to user.');

        // Reset form fields
        $this->selectedPermission = '';
        $this->newPermission = '';
    }

    public function revokePermission(Permission $permission)
    {
        if ($this->user->hasPermissionTo($permission)) {
            $this->user->revokePermissionTo($permission);

            flash()->success('Permission successfully removed from user.');

        } else {
            flash()->error('Permission not exists.');

        }
    }

    public function render()
    {
        // Get all permissions
        $allPermissions = Permission::all();

        // Get user's current permissions
        $userPermissions = $this->user->getAllPermissions();

        // Filter out permissions that the user already has
        $remainingPermissions = $allPermissions->reject(function ($permission) use ($userPermissions) {
            return $userPermissions->contains('id', $permission->id);
        });

        return view('livewire.admin.user-update', [
            'roles' => Role::all(),
            'permissions' => $remainingPermissions,
        ]);
    }
}
