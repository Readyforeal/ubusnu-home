<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-3 divide-x dark:divide-zinc-800 border dark:border-zinc-800 rounded-xl">
        <div class="col-span-2 p-3">
            @livewire('calendar')
        </div>
        <div class="col-span-1 p-3">
            <flux:heading>Shopping List</flux:heading>
        </div>
    </div>
</x-layouts.app>
