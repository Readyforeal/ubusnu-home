<?php

namespace App\Livewire;

use App\Models\ShoppingListItem;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingListItems extends Component
{
    public $shoppingListItems;
    public $selectedItems = [];

    public $name = '';

    public function mount()
    {
        $this->getItems();
    }

    public function store()
    {
//        $this->validate(['name' => 'required']);

        $item = ShoppingListItem::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->modal('create-item')->close();
        $this->dispatch('created-item', item: $item);
    }

    public function delete()
    {
        foreach ($this->selectedItems as $item) {
            ShoppingListItem::find($item)->delete();
        }

        $this->selectedItems = [];

        $this->dispatch('deleted-item');
    }

    #[On('created-item')]
    #[On('deleted-item')]
    public function getItems()
    {
        $this->shoppingListItems = ShoppingListItem::all();
    }

    public function render()
    {
        return view('livewire.shopping-list-items');
    }
}
