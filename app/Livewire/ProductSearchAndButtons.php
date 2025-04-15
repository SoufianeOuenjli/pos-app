<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSearchAndButtons extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        // dd($this->search);
        $this->dispatch('updateSearch', $this->search);
    }

    public function render()
    {
        return view('livewire.product-search-and-buttons');
    }
}
