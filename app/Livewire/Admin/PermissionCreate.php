<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class PermissionCreate extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|min:4|max:255|unique:permissions,name',
    ];

    public function save()
    {
        if (! auth()->user()->can('create:permission')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->validate();

        $permission = Permission::create([
            'name' => $this->name,
        ]);

        // Koppel aan de admin rol
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permission);
        }

        flash()->success('The permission has been created');

        $this->reset(['name']);
        $this->dispatch('permissionCreated');
    }

    public function render()
    {
        return view('livewire.admin.permission-create');
    }
}
