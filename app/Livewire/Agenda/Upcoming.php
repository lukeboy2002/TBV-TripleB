<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Component;

class Upcoming extends Component
{
    public function render()
    {
        $query = Agenda::query();

        // Guests and non-privileged users only see public events
        if (! (auth()->check() && auth()->user()->hasAnyRole(['admin', 'member']))) {
            $query->where('private', false);
        }

        $agenda = $query
            ->orderBy('date')
            ->first();

        return view('livewire.agenda.upcoming', [
            'agenda' => $agenda,
        ]);
    }
}
