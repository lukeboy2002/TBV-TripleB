<?php

namespace App\Livewire\Invitation;

use App\Mail\UserInvitation;
use App\Models\Invitation;
use App\Rules\UniqueEmailAcrossUsersAndInvitations;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class InvitationCreate extends Component
{
    public $email = '';

    public function createInvitation()
    {
        if (! auth()->user()->can('create:user')) {
            abort(403, 'You do not have access to this page.');
        }

        $this->email = strtolower(trim($this->email)); // e-mail normaliseren
        $this->validate();

        $invitation = Invitation::create([
            'email' => $this->email,
            'invited_by' => auth()->user()->id,
            'invited_date' => now(),
        ]);

        $invitation->generateInvitationToken();
        $invitation->save();

        $mailData = [
            'title' => 'U have a invitation from TripleB',
            'link' => $invitation->getLink(),
            'invited_by' => auth()->user()->username,
            'invited_date' => now(),
        ];

        Mail::to($this->email)->send(new UserInvitation($mailData));

        flash()->success('A mail is sent to the user.');

        $this->reset(['email']);
        $this->dispatch('user-created');
    }

    public function render()
    {
        return view('livewire.invitation.invitation-create');
    }

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email', new UniqueEmailAcrossUsersAndInvitations],

        ];
    }
}
