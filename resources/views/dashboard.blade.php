<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full border-t border-r border-b dark:border-zinc-800">
        <div class="w-3/4 flex-1">
            @livewire('calendar')
        </div>
        <div class="w-1/4">
            @livewire('shopping-list-items')
            <flux:spacer />
            @livewire('tasks')
        </div>
        <flux:text class="fixed bottom-2 right-8" size="sm">Ubusnu-Home V1.0</flux:text>
    </div>
</x-layouts.app>
