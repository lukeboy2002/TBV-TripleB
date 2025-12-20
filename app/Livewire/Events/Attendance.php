<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\EventAttendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Attendance extends Component
{
    public Event $event;

    public string $status = 'maybe';

    public ?EventAttendance $userAttendance = null;

    protected $rules = [
        'status' => 'required|in:attending,not_attending,maybe',
    ];

    public function mount(Event $event)
    {
        $this->event = $event;

        if (Auth::check()) {
            $this->userAttendance = EventAttendance::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($this->userAttendance) {
                $this->status = $this->userAttendance->status;
            }
        }
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $payload = [
            'event_id' => $this->event->id,
            'user_id' => Auth::id(),
            'status' => $this->status,
        ];

        if ($this->userAttendance) {
            $this->userAttendance->update(['status' => $this->status]);
        } else {
            $this->userAttendance = EventAttendance::create($payload);
        }

        // Tell other components to refresh
        $this->dispatch('attendance-updated', eventId: $this->event->id);

        // Optionally reset the UI selection to the default (uncomment if desired)
        // $this->status = 'maybe';

        session()->flash('message', 'Attendance updated.');
    }

    public function render()
    {
        return view('livewire.events.attendance');
    }
}
