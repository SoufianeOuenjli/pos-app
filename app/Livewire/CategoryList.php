<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryList extends Component
{
    public $selectedCategory = null;
    protected $listeners = ['cartUpdated' => '$refresh'];
    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->dispatch('categoryFilterUpdated', categoryId: $categoryId);
    }
    public function render()
    {
        $familles = \App\Models\Famille::all();
        return view('livewire.category-list', compact('familles'));
    }
}
