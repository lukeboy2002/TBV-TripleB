<?php

namespace App\Livewire;

use App\Models\Agenda;
use App\Models\AgendaAttendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AgendaShow extends Component
{
    public bool $showModal = false;

    public Agenda $agenda;

    public $attendanceStatus = 'maybe';

    public $userAttendance = null;

    protected $rules = [
        'attendanceStatus' => 'required|in:attending,not_attending,maybe',
    ];

    public function mount(Agenda $agenda)
    {
        $this->showModal = false;

        $this->agenda = $agenda;

        if (Auth::check()) {
            $this->userAttendance = AgendaAttendance::where('agenda_id', $this->agenda->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($this->userAttendance) {
                $this->attendanceStatus = $this->userAttendance->status;
            }
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function updateAttendance()
    {
        $this->validate();

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->userAttendance) {
            $this->userAttendance->update([
                'status' => $this->attendanceStatus,
            ]);
        } else {
            $this->userAttendance = AgendaAttendance::create([
                'agenda_id' => $this->agenda->id,
                'user_id' => Auth::id(),
                'status' => $this->attendanceStatus,
            ]);
        }

        $this->dispatch('attendance-updated');

        session()->flash('message', 'Attendance status updated!');

        // Force a full page refresh to update the attendance lists
        return redirect()->route('agenda.show', $this->agenda);
    }

    public function delete()
    {
        $this->authorize('delete', $this->agenda);

        $this->agenda->delete();

        session()->flash('message', 'Appointment deleted successfully!');

        return redirect()->route('agenda.index');
    }

    #[layout('layouts.app')]
    public function render()
    {
        $attendances = $this->agenda->attendances()->with('user')->get();

        return view('livewire.agenda-show', [
            'attendances' => $attendances,
        ])->title('Event');
    }
}
