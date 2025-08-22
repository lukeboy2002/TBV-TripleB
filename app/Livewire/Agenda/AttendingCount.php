<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendingCount extends Component
{
    public Agenda $agenda;

    // Listen for the event and refresh this component when it pertains to this agenda
    #[On('attendance-updated')]
    public function handleAttendanceUpdated(int $agendaId): void
    {
        if ($agendaId === $this->agenda->id) {
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $count = $this->agenda->attendances()->where('status', 'attending')->count();

        return view('livewire.agenda.attending-count', [
            'count' => $count,
        ]);
    }
}
