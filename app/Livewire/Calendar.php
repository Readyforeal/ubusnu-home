<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $month;
    public $year;
    public $days = [];

    public $eventsByDay = [];

    public function mount()
    {
        $today = now();
        $this->month = $today->month;
        $this->year  = $today->year;

        $this->generateDays();
    }

    public function updatedMonth()
    {
        $this->generateDays();
    }

    public function updatedYear()
    {
        $this->generateDays();
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month)->addMonth();
        $this->month = $date->month;
        $this->year  = $date->year;

        $this->generateDays();
    }

    public function prevMonth()
    {
        $date = Carbon::create($this->year, $this->month)->subMonth();
        $this->month = $date->month;
        $this->year  = $date->year;

        $this->generateDays();
    }

    public function generateDays()
    {
        $start = Carbon::create($this->year, $this->month, 1);
        $startDay = $start->dayOfWeek; // Sunday = 0

        $daysInMonth     = $start->daysInMonth;
        $daysInPrevMonth = $start->copy()->subMonth()->daysInMonth;

        $cells = [];

        // Previous month days
        for ($i = 0; $i < $startDay; $i++) {
            $cells[] = [
                'day' => $daysInPrevMonth - ($startDay - 1 - $i),
                'current' => false
            ];
        }

        // Current month days
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $cells[] = [
                'day' => $d,
                'current' => true
            ];
        }

        // Next month days
        while (count($cells) < 42) {
            $cells[] = [
                'day' => count($cells) - ($startDay + $daysInMonth) + 1,
                'current' => false
            ];
        }

        $this->days = $cells;

        $this->loadEvents();
    }

    public function loadEvents()
    {
        $monthStart = Carbon::create($this->year, $this->month, 1)->startOfDay();
        $monthEnd   = Carbon::create($this->year, $this->month, 1)->endOfMonth()->endOfDay();

        $grouped = [];

        $events = Event::whereBetween('start_date_time', [$monthStart, $monthEnd])
            ->orderBy('start_date_time', 'asc')
            ->get();

        $this->eventsByDay = [];

        foreach ($events as $event) {
            $day = $event->start_date_time->day;
            $grouped[$day][] = $event->toArray();
        }

        if($grouped) {
            foreach ($grouped as $day => $events) {
                $grouped[$day] = array_values($events);
            }
        }

        $this->eventsByDay = $grouped;
    }

    #[On('created-event')]
    #[On('updated-event')]
    #[On('deleted-event')]
    public function refreshCalendar()
    {
        $this->loadEvents();
        $this->generateDays();
    }


    public function render()
    {
        return view('livewire.calendar');
    }

}
