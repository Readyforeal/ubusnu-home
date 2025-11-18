<div class="w-full h-[calc(100vh-104px)] md:h-[calc(100vh)] rounded-xl flex flex-col p-3">

    <!-- Header -->
    <div class="md:flex items-start justify-between gap-2 mb-4">
        <flux:heading size="xl">
            {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}
        </flux:heading>

        <div class="flex items-center gap-2 mt-3 md:mt-0">
            <flux:button wire:click="prevMonth" variant="filled">
                &larr;
            </flux:button>

            <flux:button wire:click="nextMonth" variant="filled">
                &rarr;
            </flux:button>

            <flux:field>
                <flux:select wire:model.live="month">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endforeach
                </flux:select>
            </flux:field>

            <flux:field>
                <flux:select wire:model.live="year">
                    @foreach(range($year - 50, $year + 50) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </flux:select>
            </flux:field>
            @livewire('create-event-form')
        </div>
    </div>

    <!-- Labels -->
    <div class="grid grid-cols-7 text-sm mb-2">
        <flux:text>Sun</flux:text>
        <flux:text>Mon</flux:text>
        <flux:text>Tue</flux:text>
        <flux:text>Wed</flux:text>
        <flux:text>Thu</flux:text>
        <flux:text>Fri</flux:text>
        <flux:text>Sat</flux:text>
    </div>

    <!-- Calendar Grid -->
    <div class="grid grid-cols-7 flex-1 auto-rows-fr">
        @foreach($days as $i => $day)

            <div
                wire:key="{{ $day['day'] }}"
                {{-- name="create-event" --}}
                {{-- wire:click="$dispatch('setStartDateTime', { dateTime: '{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day['day'], 2, '0', STR_PAD_LEFT) }} 09:00'})" --}}
                class="p-2 flex flex-col items-start text-sm gap-1 rounded-lg opacity-20 transition
                    {{ $day['current'] ? 'hover:bg-zinc-500/10 opacity-100' : 'text-gray-400' }}
                    {{ $day['current'] && $day['day'] == now()->day && $month == now()->month && $year == now()->year
                        ? 'bg-zinc-500/5 border dark:border-zinc-700'
                        : '' }}"
            >
                <div class="w-full flex justify-between">
                    <flux:text class="{{ $day['current'] && $day['day'] == now()->day && $month == now()->month && $year == now()->year ? 'font-extrabold' : '' }}">
                        {{ $day['day'] }}
                    </flux:text>

                    <flux:modal.trigger name="create-event" wire:click="$dispatch('setStartDateTime', { dateTime: '{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day['day'], 2, '0', STR_PAD_LEFT) }} 09:00'})">
                        <flux:icon.plus variant="micro" class="opacity-20 hover:opacity-100 transition"/>
                    </flux:modal.trigger>
                </div>


                @if ($day['current'] && isset($eventsByDay[$day['day']]))
                    @foreach ($eventsByDay[$day['day']] as $event)
                        @livewire('calendar-event', ['eventId' => $event->id], key('event-' . $event->id))
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

</div>
