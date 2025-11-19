<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEventForm extends Component
{
    #[Validate('required')]
    public $name = '';
    public $location = '';
    public $startDateTime = null;
    public $endDateTime = null;
    public $notes = '';
    public $color = 'zinc';

    public function render()
    {
        return view('livewire.create-event-form');
    }

    public function store()
    {
        $user = auth()->user();

        $this->validate();

        $user->events()->create([
            'name' => $this->name,
            'location' => $this->location,
            'start_date_time' => $this->startDateTime,
            'end_date_time' => $this->endDateTime ?: null,
            'notes' => $this->notes,
            'color' => $this->color,
        ]);

        Flux::modals()->close();
        $this->dispatch('created-event');
    }

    #[On('setStartDateTime')]
    public function setStartDateTime($dateTime)
    {
        $this->startDateTime = $dateTime;
    }
}
