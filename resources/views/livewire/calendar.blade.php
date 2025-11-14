<div class="w-full h-[calc(100vh-104px)] md:h-[calc(100vh-64px)] rounded-xl flex flex-col">

    <!-- Header -->
    <div class="md:flex items-center justify-between gap-2 mb-4">
        <flux:heading size="xl">
            {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}
        </flux:heading>

        <div class="flex items-center gap-1 mt-3 md:mt-0">
            <flux:button wire:click="prevMonth">
                &larr;
            </flux:button>

            <flux:button wire:click="nextMonth">
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
            @livewire('edit-event-form')
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

            <flux:modal.trigger
                name="create-event"
                wire:click="$dispatch('setStartDateTime', { dateTime: '{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day['day'], 2, '0', STR_PAD_LEFT) }} 09:00'})"
                class="p-2 flex flex-col items-start text-sm gap-1 rounded-lg opacity-20 transition
                    {{ $day['current'] ? 'hover:bg-zinc-500/10 opacity-100' : 'text-gray-400' }}
                    {{ $day['current'] && $day['day'] == now()->day && $month == now()->month && $year == now()->year
                        ? 'bg-zinc-500/5 font-extrabold'
                        : '' }}"
            >
                <flux:text>
                    {{ $day['day'] }}
                </flux:text>

                @php
                    $eventColors = [
                        'zinc'    => ['bg' => 'bg-zinc-500/20',    'text' => 'text-zinc-700 dark:text-zinc-300'],
                        'red'     => ['bg' => 'bg-red-500/20',     'text' => 'text-red-700 dark:text-red-300'],
                        'orange'  => ['bg' => 'bg-orange-500/20',  'text' => 'text-orange-700 dark:text-orange-300'],
                        'amber'   => ['bg' => 'bg-amber-500/20',   'text' => 'text-amber-700 dark:text-amber-300'],
                        'yellow'  => ['bg' => 'bg-yellow-500/20',  'text' => 'text-yellow-700 dark:text-yellow-300'],
                        'lime'    => ['bg' => 'bg-lime-500/20',    'text' => 'text-lime-700 dark:text-lime-300'],
                        'green'   => ['bg' => 'bg-green-500/20',   'text' => 'text-green-700 dark:text-green-300'],
                        'emerald' => ['bg' => 'bg-emerald-500/20', 'text' => 'text-emerald-700 dark:text-emerald-300'],
                        'teal'    => ['bg' => 'bg-teal-500/20',    'text' => 'text-teal-700 dark:text-teal-300'],
                        'cyan'    => ['bg' => 'bg-cyan-500/20',    'text' => 'text-cyan-700 dark:text-cyan-300'],
                        'sky'     => ['bg' => 'bg-sky-500/20',     'text' => 'text-sky-700 dark:text-sky-300'],
                        'blue'    => ['bg' => 'bg-blue-500/20',    'text' => 'text-blue-700 dark:text-blue-300'],
                        'indigo'  => ['bg' => 'bg-indigo-500/20',  'text' => 'text-indigo-700 dark:text-indigo-300'],
                        'violet'  => ['bg' => 'bg-violet-500/20',  'text' => 'text-violet-700 dark:text-violet-300'],
                        'purple'  => ['bg' => 'bg-purple-500/20',  'text' => 'text-purple-700 dark:text-purple-300'],
                        'fuchsia' => ['bg' => 'bg-fuchsia-500/20', 'text' => 'text-fuchsia-700 dark:text-fuchsia-300'],
                        'pink'    => ['bg' => 'bg-pink-500/20',    'text' => 'text-pink-700 dark:text-pink-300'],
                        'rose'    => ['bg' => 'bg-rose-500/20',    'text' => 'text-rose-700 dark:text-rose-300'],
                    ];
                @endphp

                @if ($day['current'] && isset($eventsByDay[$day['day']]))
                    @foreach ($eventsByDay[$day['day']] as $event)
                        @php
                            $cls = $eventColors[$event->color] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'];
                        @endphp

                        <div
                            name="edit-event"
                            wire:click.stop="$dispatch('openEditEventModal', { id: {{ $event->id }} })"
                            class="z-10 w-full text-left text-xs font-bold rounded px-1 py-0.5 truncate {{ $cls['bg'] }} flex justify-between">
                            <flux:text class="{{ $cls['text'] }}" size="sm">
                                {{ $event->name }}
                            </flux:text>
                            <flux:text class="{{ $cls['text'] }}" size="sm">
                                {{ \Carbon\Carbon::parse($event->start_date_time)->format('H:i') }}
                            </flux:text>
                        </div>
                    @endforeach
                @endif
            </flux:modal.trigger>
        @endforeach
    </div>
</div>
