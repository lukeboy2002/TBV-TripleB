<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $query = Agenda::query();

        // Guests and non-privileged users only see public events
        if (! (auth()->check() && auth()->user()->hasAnyRole(['admin', 'member']))) {
            $query->where('private', false);
        }

        //        // Apply search in a grouped where to avoid breaking the private filter with OR conditions
        //        if ($this->search) {
        //            $search = $this->search;
        //            $query->where(function ($q) use ($search) {
        //                $q->where('name', 'like', "%{$search}%")
        //                    ->orWhere('description', 'like', "%{$search}%");
        //            });
        //        }

        $agendas = $query
            ->orderBy('date')
            ->paginate(10);

        return view('agenda.index', [
            'agendas' => $agendas,
        ]);
    }

    public function show(Agenda $agenda)
    {
        return view('agenda.show', [
            'agenda' => $agenda,
        ]);
    }
}
