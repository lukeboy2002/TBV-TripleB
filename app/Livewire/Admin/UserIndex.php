<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use withPagination;

    public bool $showModal = false;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public $confirmingDeletion = false;

    public $user;

    public function mount()
    {
        $this->showModal = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
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

    public function deleteUser(User $user)
    {
        if (! auth()->user()->can('delete:user')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->user = $user;
        $this->showModal = true;
    }

    public function confirmDelete()
    {
        if ($this->user) {
            $this->user->delete();
            session()->flash('success', 'The user has been deleted');
            $this->redirect(route('admin.users.index'));
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.admin.user-index', [
            'users' => User::search($this->search)
                ->leftJoin('model_has_roles as role', 'users.id', '=', 'role.model_id')
                ->leftJoin('roles', 'role.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role_name') // Specificeren van de tabel 'roles'
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
