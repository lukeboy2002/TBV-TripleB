<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionIndex extends Component
{
    use withPagination;

    public bool $showModal = false;

    public bool $showRoleModal = false;

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    #[Url()]
    public $perPage = 10;

    public $confirmingDeletion = false;

    public $selectedRoles = [];

    public $availableRoles = [];

    public $permission;

    protected $listeners = [
        'permissionCreated' => 'refreshPermissions',
        'permissionDeleted' => 'refreshPermissions',
    ];

    public function mount()
    {
        $this->showModal = false;
        $this->showRoleModal = false;
        $this->selectedRoles = [];
        $this->availableRoles = [];
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

    public function deletePermission(Permission $permission)
    {
        if (! auth()->user()->can('delete:permission')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->permission = $permission;
        $this->showModal = true;
    }

    public function confirmDelete()
    {
        if ($this->permission) {

            $this->permission->delete();

            flash()->success('The permission has been deleted');

            $this->dispatch('permissionDeleted');
            $this->showModal = false;
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function toggleRoleModal()
    {
        $this->showRoleModal = ! $this->showRoleModal;
    }

    public function updatePermission(Permission $permission)
    {
        if (! auth()->user()->can('update:permission')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->permission = $permission;
        $this->selectedRoles = $permission->roles->pluck('id')->toArray();
        $this->availableRoles = Role::all();
        $this->showRoleModal = true;
    }

    public function assignRoles()
    {
        if ($this->permission) {
            $this->permission->roles()->sync($this->selectedRoles);

            flash()->success('Roles have been assigned to the permission');

            $this->showRoleModal = false;
        }
    }

    #[Computed]
    public function permissions()
    {
        return Permission::orderBy($this->sortBy, $this->sortDir)
            ->with('roles')
            ->paginate($this->perPage);
    }
}
