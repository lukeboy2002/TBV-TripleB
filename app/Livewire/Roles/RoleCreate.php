<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public string $name;

    public array $allPermissions = [];

    public array $selectedPermissions = [];

    public function mount()
    {
        $this->allPermissions = Permission::pluck('name')->toArray();
    }

    public function createRole()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);

        $this->reset(['name', 'selectedPermissions']);

        flash()->success('Role created successfully');

        return redirect()->route('roles.index');
    }

    public function refreshRoles()
    {
        $this->allPermissions = Permission::pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.roles.role-create');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'selectedPermissions' => 'array',
            'selectedPermissions.*' => 'string|exists:permissions,name',
        ];
    }
}
