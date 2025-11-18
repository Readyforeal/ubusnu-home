<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-4 divide-x dark:divide-zinc-800">
        <div class="col-span-3">
            @livewire('calendar')
            @livewire('edit-event-form')
        </div>
        <div class="col-span-1">
            <flux:heading>Shopping List</flux:heading>
        </div>
    </div>
</x-layouts.app>
