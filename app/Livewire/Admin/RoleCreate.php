<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;

class RoleCreate extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|min:4|max:255|unique:roles,name',
    ];

    public function save()
    {
        if (! auth()->user()->can('create:role')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->validate();

        $role = Role::create([
            'name' => $this->name,
        ]);

        flash()->success('The role has been created.');

        $this->reset(['name']);
        $this->dispatch('roleCreated');

    }

    public function render()
    {
        return view('livewire.admin.role-create');
    }
}
