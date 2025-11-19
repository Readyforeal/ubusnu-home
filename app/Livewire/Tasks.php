<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class Tasks extends Component
{
    public $tasks;
    public $selectedTasks = [];

    public $desc = '';

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function store()
    {
//        $this->validate(['desc' => 'required']);

        $task = auth()->user()->tasks()->create([
            'desc' => $this->desc,
        ]);

        $this->desc = '';
        $this->modal('create-task')->close();
        $this->dispatch('created-task', task: $task);
    }

    public function delete()
    {
        foreach ($this->selectedTasks as $task) {
            Task::find($task)->delete();
        }

        $this->selectedTasks = [];

        $this->dispatch('deleted-task');
    }

    #[On('created-task')]
    #[On('deleted-task')]
    public function getTasks()
    {
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.tasks');
    }
}
