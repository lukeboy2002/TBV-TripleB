<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceLists extends Component
{
    public Agenda $agenda;

    #[On('attendance-updated')]
    public function onAttendanceUpdated(int $agendaId): void
    {
        if ($agendaId === $this->agenda->id) {
            // Re-render with fresh data
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        // Eager-load users to avoid N+1
        $attendances = $this->agenda->attendances()->with('user')->get();

        $attending = $attendances->where('status', 'attending');
        $notAttending = $attendances->where('status', 'not_attending');
        $maybe = $attendances->where('status', 'maybe');

        return view('livewire.agenda.attendance-lists', [
            'attending' => $attending,
            'notAttending' => $notAttending,
            'maybe' => $maybe,
        ]);
    }
}
