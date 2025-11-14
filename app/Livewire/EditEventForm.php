<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditEventForm extends Component
{
    public $event;

    #[Validate('required')]
    public $name;
    public $location;
    public $startDateTime;
    public $endDateTime;
    public $notes;
    public $color = 'zinc';

    public function render()
    {
        return view('livewire.edit-event-form');
    }

    #[On('openEditEventModal')]
    public function OpenEditEventModal($id)
    {
        $this->event = Event::find($id);

        $this->name = $this->event->name;
        $this->location = $this->event->location;
        $this->startDateTime = Carbon::parse($this->event->start_date_time)->format('Y-m-d\TH:i');
        $this->endDateTime = Carbon::parse($this->event->end_date_time)->format('Y-m-d\TH:i');
        $this->notes = $this->event->notes;
        $this->color = $this->event->color;

        $this->modal('edit-event')->show();
    }

    public function update()
    {
        $this->event->update([
            'name' => $this->name,
            'location' => $this->location,
            'start_date_time' => $this->startDateTime,
            'end_date_time' => $this->endDateTime,
            'notes' => $this->notes,
            'color' => $this->color,
        ]);

        $this->dispatch('updated-event');
        $this->modal('edit-event')->close();
    }

    public function delete()
    {
        $this->event->delete();
        $this->event = null;
        $this->modal('edit-event')->close();
        $this->dispatch('deleted-event');
    }
}
