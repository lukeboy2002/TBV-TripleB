<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public User $user;

    // Dropdown options for roles
    public array $availableRoles = [];

    // Currently selected role name
    public string $selectedRole = '';

    public array $allPermissions = [];

    public array $selectedPermissions = [];

    public function mount(User $user)
    {
        $this->user = $user;

        $this->availableRoles = Role::pluck('name')->toArray();
        $this->selectedRole = $user->getRoleNames()->first() ?? '';

        $this->selectedPermissions = $user->permissions->pluck('name')->toArray();
        $this->allPermissions = Permission::pluck('name')->toArray();
    }

    public function updateRole()
    {
        $this->user->syncRoles($this->selectedRole ? [$this->selectedRole] : []);

        flash()->success(__('User edited successfully'));

        return redirect()->route('users.index');
    }

    public function updatePermissions()
    {
        $this->user->syncPermissions($this->selectedPermissions);

        flash()->success(__('User edited successfully'));
        $this->selectedPermissions = [];

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
