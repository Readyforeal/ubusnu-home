<div class="p-3 border-l-2 border-indigo-500 bg-gradient-to-r from-indigo-500/10 to-indigo-500/5 h-1/2">
    <div class="flex justify-between">
        <flux:heading class="font-black" size="lg">Shopping List</flux:heading>

        <div class="flex gap-2">
            <flux:button size="xs" variant="ghost" :disabled="$selectedItems == []" wire:click="delete" icon="trash"></flux:button>

            <flux:modal.trigger name="create-item">
                <flux:button size="xs" variant="filled" icon="plus">Add Item</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <div class="mt-3">
        <flux:checkbox.group wire:model.live="selectedItems">
        @forelse($shoppingListItems as $item)
                <flux:checkbox
                    value="{{ $item->id }}"
                    label="{{ $item->name }}"
                    wire:key="{{ $item->id }}"
                />
        @empty
            <flux:text>No items</flux:text>
        @endforelse
        </flux:checkbox.group>
    </div>

    <flux:modal name="create-item" class="w-lg">
        <div class="space-y-3">
            <flux:heading>Add Item</flux:heading>

            <flux:input placeholder="Name" wire:model="name" data-keyboard-target />

            <div class="flex">
                <flux:button wire:click="store" variant="primary" class="w-full" icon="plus">Create Item</flux:button>
            </div>

            @vite(['resources/js/keyboard.js'])
            <div wire:ignore>
                <div class="simple-keyboard"></div>
            </div>
        </div>
    </flux:modal>
</div>
