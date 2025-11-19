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
    public $event = null;
    public $eventId = null;

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

    #[On('editing-event')]
    public function editingEvent($id)
    {
        $event = Event::find($id);
        $this->eventId = $event->id;

        $this->name = $event->name;
        $this->location = $event->location;
        $this->startDateTime = Carbon::parse($event->start_date_time)->format('Y-m-d\TH:i');
        $this->endDateTime = $event->end_date_time ? Carbon::parse($event->end_date_time)->format('Y-m-d\TH:i') : null;
        $this->notes = $event->notes;
        $this->color = $event->color;
    }

    public function update()
    {
        Event::find($this->eventId)->update([
            'name' => $this->name,
            'location' => $this->location,
            'start_date_time' => $this->startDateTime,
            'end_date_time' => $this->endDateTime,
            'notes' => $this->notes,
            'color' => $this->color,
        ]);

        $this->modal('edit-event')->close();
        $this->reset();
        $this->dispatch('updated-event');
    }

    public function delete()
    {
        Event::find($this->eventId)->delete();
        $this->modal('edit-event')->close();
        $this->reset();
        $this->dispatch('deleted-event');
    }
}
