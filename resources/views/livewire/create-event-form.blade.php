<div>
    <flux:modal.trigger name="create-event">
        <flux:button icon="calendar-plus" variant="filled" wire:click="$set('startDateTime', '')">Create event</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-event" class="md:w-96">
        <div class="space-y-3">
            <div>
                <flux:heading size="lg">Create event</flux:heading>
            </div>
            <flux:input placeholder="Event name" wire:model="name" />
            <flux:input placeholder="Event location" wire:model="location" />
            <flux:input type="datetime-local" wire:model="startDateTime" />
            <flux:input type="datetime-local" wire:model="endDateTime" />
            <flux:input placeholder="Event notes" wire:model="notes" />
            
            @php
                $colors = [
                    'zinc'    => 'bg-zinc-300',
                    'red'     => 'bg-red-300',
                    'orange'  => 'bg-orange-300',
                    'amber'   => 'bg-amber-300',
                    'yellow'  => 'bg-yellow-300',
                    'lime'    => 'bg-lime-300',
                    'green'   => 'bg-green-300',
                    'emerald' => 'bg-emerald-300',
                    'teal'    => 'bg-teal-300',
                    'cyan'    => 'bg-cyan-300',
                    'sky'     => 'bg-sky-300',
                    'blue'    => 'bg-blue-300',
                    'indigo'  => 'bg-indigo-300',
                    'violet'  => 'bg-violet-300',
                    'purple'  => 'bg-purple-300',
                    'fuchsia' => 'bg-fuchsia-300',
                    'pink'    => 'bg-pink-300',
                    'rose'    => 'bg-rose-300',
                ];
            @endphp

            <flux:badge color="{{ $color }}">{{ ucfirst($color) }}</flux:badge>

            <div class="flex flex-wrap gap-1">
                @foreach ($colors as $clr => $cls)
                    <div 
                        class="{{ $cls }} w-5 h-5 rounded-full cursor-pointer
                            {{ $color === $clr ? 'ring-2 ring-offset-1 ring-zinc-300' : 'opacity-50 hover:opacity-100' }}"
                        wire:click="$set('color', '{{ $clr }}')"
                        title="{{ ucfirst($clr) }}"
                    ></div>
                @endforeach
            </div>

            <div class="flex">
                <flux:button wire:click="store" variant="primary" class="w-full" icon="calendar-plus">Create</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
