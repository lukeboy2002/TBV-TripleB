<?php

namespace App\Livewire\Invitation;

use App\Mail\DeleteInvitation;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class InvitationIndex extends Component
{
    use WithPagination;

    public $user;

    public bool $showModal = false;

    public $confirmingDeletion = false;

    #[Url(history: true)]
    public $sortBy = 'email';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    protected $listeners = [
        'user-created' => 'refreshUsers',
        'user-deleted' => 'refreshUsers',
    ];

    public function mount()
    {
        $this->showModal = false;
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
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

    public function deleteUser(Invitation $user)
    {
        if (! auth()->user()->can('delete', $user)) {
            abort(403, __('You do not have access to delete this invitation.'));
        }

        $this->user = $user;
        $this->showModal = true;
    }

    public function confirmDelete(Invitation $user)
    {
        if (! auth()->user()->can('delete', $this->user)) {
            abort(403, __('You do not have access to delete this invitation.'));
        }

        if ($this->user) {
            // Capture details before deletion
            $recipientEmail = strtolower(trim($this->user->email));

            // Perform deletion
            $this->user->delete();

            // Prepare and send notification email
            $mailData = [
                'title' => 'Removed Invitation from TripleB',
                'deleted_by' => auth()->user()->username,
            ];

            Mail::to($recipientEmail)->send(new DeleteInvitation($mailData));

            flash()->success(__('The invitation has been deleted'));

            $this->dispatch('user-deleted');
            $this->showModal = false;
        }
    }

    public function render()
    {
        $currentUser = auth()->user();

        if ($currentUser->hasRole('admin')) {
            $users = Invitation::with('invitedBy')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10);
        } else {
            $users = Invitation::where('invited_by', $currentUser->id)
                ->with('invitedBy')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10);
        }

        return view('livewire.invitation.invitation-index', [
            'users' => $users,
        ]);
    }
}
