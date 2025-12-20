<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceList extends Component
{
    public Event $event;

    #[On('attendance-updated')]
    public function onAttendanceUpdated(int $eventId): void
    {
        if ($eventId === $this->event->id) {
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        // Eager-load users to avoid N+1
        $attendances = $this->event->attendances()->with('user')->get();

        $attending = $attendances->where('status', 'attending');
        $notAttending = $attendances->where('status', 'not_attending');
        $maybe = $attendances->where('status', 'maybe');

        return view('livewire.events.attendance-list', [
            'attending' => $attending,
            'notAttending' => $notAttending,
            'maybe' => $maybe,
        ]);
    }
}
