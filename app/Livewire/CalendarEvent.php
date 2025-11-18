<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CalendarEvent extends Component
{
    public $eventId;
    public $event;

    public $eventColors = [
        'zinc'    => ['bg' => 'bg-zinc-500/20',    'text' => 'text-zinc-700 dark:text-zinc-300'],
        'red'     => ['bg' => 'bg-red-500/20',     'text' => 'text-red-700 dark:text-red-300'],
        'orange'  => ['bg' => 'bg-orange-500/20',  'text' => 'text-orange-700 dark:text-orange-300'],
        'amber'   => ['bg' => 'bg-amber-500/20',   'text' => 'text-amber-700 dark:text-amber-300'],
        'yellow'  => ['bg' => 'bg-yellow-500/20',  'text' => 'text-yellow-700 dark:text-yellow-300'],
        'lime'    => ['bg' => 'bg-lime-500/20',    'text' => 'text-lime-700 dark:text-lime-300'],
        'green'   => ['bg' => 'bg-green-500/20',   'text' => 'text-green-700 dark:text-green-300'],
        'emerald' => ['bg' => 'bg-emerald-500/20', 'text' => 'text-emerald-700 dark:text-emerald-300'],
        'teal'    => ['bg' => 'bg-teal-500/20',    'text' => 'text-teal-700 dark:text-teal-300'],
        'cyan'    => ['bg' => 'bg-cyan-500/20',    'text' => 'text-cyan-700 dark:text-cyan-300'],
        'sky'     => ['bg' => 'bg-sky-500/20',     'text' => 'text-sky-700 dark:text-sky-300'],
        'blue'    => ['bg' => 'bg-blue-500/20',    'text' => 'text-blue-700 dark:text-blue-300'],
        'indigo'  => ['bg' => 'bg-indigo-500/20',  'text' => 'text-indigo-700 dark:text-indigo-300'],
        'violet'  => ['bg' => 'bg-violet-500/20',  'text' => 'text-violet-700 dark:text-violet-300'],
        'purple'  => ['bg' => 'bg-purple-500/20',  'text' => 'text-purple-700 dark:text-purple-300'],
        'fuchsia' => ['bg' => 'bg-fuchsia-500/20', 'text' => 'text-fuchsia-700 dark:text-fuchsia-300'],
        'pink'    => ['bg' => 'bg-pink-500/20',    'text' => 'text-pink-700 dark:text-pink-300'],
        'rose'    => ['bg' => 'bg-rose-500/20',    'text' => 'text-rose-700 dark:text-rose-300'],
    ];

    public function mount()
    {
        $this->event = Event::find($this->eventId);
    }

    public function render()
    {
        return view('livewire.calendar-event');
    }
}
