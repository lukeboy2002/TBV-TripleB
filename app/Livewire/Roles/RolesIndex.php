<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    public $role;

    public bool $showModal = false;

    protected $listeners = [
        'roleCreated' => 'refreshRoles',
        'roleDeleted' => 'refreshRoles',
    ];

    public function mount()
    {
        $this->showModal = false;
    }

    public function deleteRole(Role $role)
    {
        if (! auth()->user()->hasRole('admin')) {
            abort(403, 'You do not have access to delete this role.');
        }

        $this->role = $role;
        $this->showModal = true;
    }

    public function confirmDelete()
    {
        if (! auth()->user()->hasRole('admin')) {
            abort(403, 'You do not have access to delete this role.');
        }

        if ($this->role) {
            // Prevent deletion if the role has permissions or is assigned to any user
            if ($this->role->permissions()->exists() || $this->role->users()->exists()) {
                flash()->error('This role cannot be deleted because it has permissions assigned or is assigned to one or more users.');
                $this->showModal = false;

                return;
            }

            $this->role->delete();

            flash()->success('The role has been deleted');

            $this->dispatch('roleDeleted');
            $this->showModal = false;
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function refreshRoles()
    {
        // Intentionally left blank: Livewire will re-render as needed when events are dispatched.
    }

    public function render()
    {
        $roles = Role::with('permissions')->paginate(5);

        return view('livewire.roles.roles-index', [
            'roles' => $roles,
        ]);
    }
}
