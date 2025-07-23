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
        $this->authorize('create', Role::class);

        $this->validate();

        $role = Role::create([
            'name' => $this->name,
        ]);

        session()->flash('success', 'The role has been created');

        $this->reset(['name']);
        $this->dispatch('roleCreated');

    }

    public function render()
    {
        return view('livewire.admin.role-create');
    }
}
