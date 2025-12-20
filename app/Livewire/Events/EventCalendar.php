<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventCalendar extends Component
{
    public $year;

    public $month;

    public function mount()
    {
        $this->year = now()->year;
        $this->month = now()->month;
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function previousMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function render()
    {
        // Huidige datum object voor titel en berekeningen
        $currentDate = Carbon::createFromDate($this->year, $this->month, 1);

        // Start van de kalender (eerste dag van de maand, terugrekenen naar maandag)
        $startOfCalendar = $currentDate->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);

        // Einde van de kalender (laatste dag van de maand, vooruitrekenen naar zondag)
        $endOfCalendar = $currentDate->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        // Haal alle events op voor deze periode om queries in de loop te voorkomen
        // We kijken of de startdatum (date) binnen de range valt
        $events = Event::query()
            ->whereBetween('date', [$startOfCalendar, $endOfCalendar])
            ->get()
            ->groupBy(function ($event) {
                return $event->date->format('Y-m-d');
            });

        $days = [];
        $day = $startOfCalendar->copy();

        // Loop door de dagen heen om het raster te vullen
        while ($day <= $endOfCalendar) {
            // Kijk of er events zijn op deze dag
            $dateKey = $day->format('Y-m-d');
            $dayEvents = $events->get($dateKey);

            // Pak het eerste event als er meerdere zijn, anders null
            $eventOnDay = $dayEvents ? $dayEvents->first() : null;

            $days[] = [
                'date' => $day->copy(),
                'day_number' => $day->day,
                'is_current_month' => $day->month === $this->month,
                'is_today' => $day->isToday(),
                'event' => $eventOnDay, // Hier geven we het event object mee
            ];

            $day->addDay();
        }

        return view('livewire.events.event-calendar', [
            'days' => $days,
            'currentMonthName' => $currentDate->format('F Y'),
        ]);
    }
}
