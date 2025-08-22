<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use App\Models\AgendaAttendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Attendance extends Component
{
    public Agenda $agenda;

    public string $status = 'maybe';

    public ?AgendaAttendance $userAttendance = null;

    protected $rules = [
        'status' => 'required|in:attending,not_attending,maybe',
    ];

    public function mount(Agenda $agenda)
    {
        $this->agenda = $agenda;

        if (Auth::check()) {
            $this->userAttendance = AgendaAttendance::where('agenda_id', $agenda->id)
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
            'agenda_id' => $this->agenda->id,
            'user_id' => Auth::id(),
            'status' => $this->status,
        ];

        if ($this->userAttendance) {
            $this->userAttendance->update(['status' => $this->status]);
        } else {
            $this->userAttendance = AgendaAttendance::create($payload);
        }

        // Tell other components to refresh
        $this->dispatch('attendance-updated', agendaId: $this->agenda->id);

        // Optionally reset the UI selection to the default (uncomment if desired)
        // $this->status = 'maybe';

        session()->flash('message', 'Attendance updated.');
    }

    public function render()
    {
        return view('livewire.agenda.attendance');
    }
}
