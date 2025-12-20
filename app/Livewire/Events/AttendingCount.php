<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendingCount extends Component
{
    public Event $event;

    #[On('attendance-updated')]
    public function handleAttendanceUpdated(int $eventId): void
    {
        if ($eventId === $this->event->id) {
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $count = $this->event->attendances()->where('status', 'attending')->count();

        return view('livewire.events.attending-count', [
            'count' => $count,
        ]);
    }
}
