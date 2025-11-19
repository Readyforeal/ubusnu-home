<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-4">
        <div class="col-span-3">
            @livewire('calendar')
        </div>
        <div class="col-span-1 flex-1">
            @livewire('shopping-list-items')
            <flux:spacer />
            @livewire('tasks')
        </div>
    </div>

    <style>
        .simple-keyboard {
            background: rgba(0,0,0,0);
            padding: 0px;
            border-radius: 12px;
        }

        .simple-keyboard .hg-button {
            background: rgba(0,0,0,0.3);
            color: var(--color-zinc-300);
            border-radius: 8px;
            font-size: 1rem;
            padding: 6px;
            margin: 0px;
            border: none;
        }

        .simple-keyboard .hg-button:active {
            background: var(--color-zinc-900);
        }

        .simple-keyboard .hg-button.hg-functionBtn {
            background: rgba(0,0,0,0.6);
            color: var(--color-zinc-300);
        }
    </style>
</x-layouts.app>
