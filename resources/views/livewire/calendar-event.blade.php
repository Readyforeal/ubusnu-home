<div class="w-full">

    @php
        $color = $eventColors[$event->color] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'];
    @endphp

    <flux:modal.trigger name="edit-event" wire:click="$dispatch('editing-event', {'id': {{ $event->id }}})"
        class="z-10 w-full text-left text-xs rounded px-1 py-0.5 truncate {{ $color['bg'] }} flex justify-between cursor-pointer p-6">
        <flux:text class="{{ $color['text'] }}" size="sm">
            {{ \Carbon\Carbon::parse($event->start_date_time)->format('H:i') }} {{ $event->name }}
        </flux:text>
    </flux:modal.trigger>
</div>
