<?php

namespace App\Livewire\Actions;

use App\Mail\DeleteEvent;
use App\Models\Event;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EventActions extends Component
{
    public Event $event;

    public bool $showModal = false;

    public function mount(Event $event)
    {
        $this->showModal = false;
        $this->event = $event;
    }

    public function deleteEvent()
    {
        $this->authorize('delete', $this->event);

        $this->showModal = true;

        // Delete the event (attendances removed via cascade)
        $this->event->delete();

        //        // Send notification to all users with the 'member' role
        $members = User::role('member')->get();
        foreach ($members as $member) {
            Mail::to($member->email)->send(new DeleteEvent($this->event, Auth::user()->username));
        }

        $this->dispatch('event-deleted');
        session()->flash('success', 'The event has been deleted');

        $this->redirect(route('events.index'));
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.actions.event-actions');
    }
}
