<?php

namespace App\Livewire;

use Cache;
use Livewire\Component;

class BrandList extends Component
{
    public $selectedBrand = null;
    protected $listeners = ['cartUpdated' => '$refresh'];
    public function filterByBrand($brandId)
    {
        $this->selectedBrand = $brandId;
        $this->dispatch('brandFilterUpdated', brandId: $brandId);
    }
    public function render()
    {
        $brands = \App\Models\Marque::all();
        return view('livewire.brand-list', compact('brands'));
    }
}
