<?php

namespace App\Livewire;

use App\Models\Agenda;
use Carbon\Carbon;
use Livewire\Component;

class AgendaCalendar extends Component
{
    public $month;

    public $year;

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function previousMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function render()
    {
        $startOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->endOfMonth();

        $agendas = Agenda::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->orderBy('date')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });

        $calendar = [];
        $startDay = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $endDay = $endOfMonth->copy()->endOfWeek(Carbon::SUNDAY);

        for ($day = $startDay; $day->lte($endDay); $day->addDay()) {
            $dateKey = $day->format('Y-m-d');
            $calendar[] = [
                'date' => $day->copy(),
                'isCurrentMonth' => $day->month === (int) $this->month,
                'events' => $agendas[$dateKey] ?? [],
            ];
        }

        return view('livewire.agenda-calendar', [
            'calendar' => $calendar,
            'currentMonth' => Carbon::createFromDate($this->year, $this->month, 1),
        ]);
    }
}
