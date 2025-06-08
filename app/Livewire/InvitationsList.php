<?php

namespace App\Livewire;

use App\Models\Invitation;
use Livewire\Component;

class InvitationsList extends Component
{
    public $sortField = 'invited_date';

    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteInvitation(Invitation $invitation)
    {
        if (auth()->user()->cannot('delete', $invitation)) {
            session()->flash('error', 'You do not have permission to delete this invitation.');

            return;
        }

        $invitation->delete();
        session()->flash('success', 'Invitation deleted successfully.');
    }

    public function render()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            // Admins see all invitations
            $invitations = Invitation::with('invitedBy')
                ->orderBy($this->sortField, $this->sortDirection)
                ->get();
        } else {
            // Members only see their own invitations
            $invitations = Invitation::where('invited_by', $user->id)
                ->with('invitedBy')
                ->orderBy($this->sortField, $this->sortDirection)
                ->get();
        }

        return view('livewire.invitations-list', [
            'invitations' => $invitations,
        ]);
    }
}
