<div class="p-3 border-l-2 border-red-500 bg-gradient-to-r from-red-500/10 to-red-500/5 h-1/2">
    <div class="flex justify-between">
        <flux:heading class="font-black" size="lg">Tasks</flux:heading>

        <div class="flex gap-2">
            <flux:button size="xs" variant="ghost" :disabled="$selectedTasks == []" wire:click="delete" icon="trash"></flux:button>

            <flux:modal.trigger name="create-task">
                <flux:button size="xs" variant="filled" icon="plus">Add Task</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <div class="mt-3">
        <flux:checkbox.group wire:model.live="selectedTasks">
            @forelse($tasks as $task)
                <flux:checkbox
                    value="{{ $task->id }}"
                    label="{{ $task->desc }}"
                    wire:key="{{ $task->id }}"
                />
            @empty
                <flux:text>No tasks</flux:text>
            @endforelse
        </flux:checkbox.group>
    </div>

    <flux:modal name="create-task" class="w-lg">
        <div class="space-y-3">
            <flux:heading>Add Task</flux:heading>

            <flux:input placeholder="Description" wire:model="desc" data-keyboard-target />
            <div class="flex">
                <flux:button wire:click="store" variant="primary" class="w-full" icon="plus">Create Task</flux:button>
            </div>

            @vite(['resources/js/keyboard.js'])
            <div wire:ignore>
                <div class="simple-keyboard"></div>
            </div>
        </div>
    </flux:modal>
</div>
