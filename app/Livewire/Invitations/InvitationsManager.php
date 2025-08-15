<?php

namespace App\Livewire\Invitations;

use App\Models\Invitation;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class InvitationsManager extends Component
{
    use withPagination;

    public bool $showModal = false;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public $confirmingDeletion = false;

    public $user;

    protected $listeners = [
        'userCreated' => 'refreshUsers',
        'userDeleted' => 'refreshUsers',
    ];

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

    public function mount()
    {
        $this->showModal = false;
    }

    public function deleteUser(Invitation $user)
    {
        if (! auth()->user()->can('delete', $user)) {
            abort(403, 'You do not have access to delete this invitation.');
        }

        $this->user = $user;
        $this->showModal = true;
    }

    public function confirmDelete()
    {
        if (! auth()->user()->can('delete', $this->user)) {
            abort(403, 'You do not have access to delete this invitation.');
        }

        if ($this->user) {
            $this->user->delete();

            flash()->success('The user has been deleted');

            $this->dispatch('userDeleted');
            $this->showModal = false;

        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        $currentUser = auth()->user();

        // Admins mogen alles zien
        if ($currentUser->hasRole('admin')) {
            $users = Invitation::search($this->search)
                ->with('invitedBy')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10);
        } else {
            $users = Invitation::where('invited_by', $currentUser->id)
                ->with('invitedBy')
                ->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10);
        }

        return view('livewire.invitations.invitations-manager', [
            'users' => $users,
        ]);
    }
}
