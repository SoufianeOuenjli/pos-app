<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ProductGrid extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = ['search'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function selectProduct($id)
    {
        $product = Article::findOrFail($id);

        $this->dispatch('productAdded', [
            'id' => $product->id,
            'name' => $product->nom,
            'price' => $product->prix_ht,
        ]);
    }

    protected $listeners = ['updateSearch' => 'setSearch'];

    public function setSearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }
    public function render()
    {
        $products = Article::query()
            ->where('nom', 'like', '%' . $this->search . '%')
            ->orWhere('code_barre', 'like', '%' . $this->search . '%')
            ->paginate(12);

        return view('livewire.product-grid', compact('products'));
    }
}
