<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RoleIndex extends Component
{
    use withPagination;

    public bool $showModal = false;

    public bool $showPermissionModal = false;

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    #[Url()]
    public $perPage = 10;

    public $confirmingDeletion = false;

    public $selectedPermissions = [];

    public $availablePermissions = [];

    public $role;

    protected $listeners = [
        'roleCreated' => 'refreshRoles',
        'roleDeleted' => 'refreshRoles',
    ];

    public function mount()
    {
        $this->showModal = false;
        $this->showPermissionModal = false;
        $this->selectedPermissions = [];
        $this->availablePermissions = [];
    }

    public function setSortBy($sortByField)
    {

        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';

            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function deleteRole(Role $role)
    {

        if (! auth()->user()->can('delete:role')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->role = $role;
        $this->showModal = true;
    }

    public function confirmDelete()
    {
        if ($this->role) {

            $this->role->delete();

            session()->flash('success', 'The role has been deleted');
            $this->dispatch('roleDeleted');
            $this->showModal = false;
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function togglePermissionModal()
    {
        $this->showPermissionModal = ! $this->showPermissionModal;
    }

    public function updateRole(Role $role)
    {
        if (! auth()->user()->can('update:role')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->role = $role;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->availablePermissions = Permission::all();
        $this->showPermissionModal = true;
    }

    public function assignPermissions()
    {
        if ($this->role) {
            $this->role->permissions()->sync($this->selectedPermissions);

            session()->flash('success', 'Permissions have been assigned to the role');
            $this->showPermissionModal = false;
        }
    }

    #[Computed]
    public function roles()
    {
        return Role::orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
    }
}
