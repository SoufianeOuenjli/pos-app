<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CartService;

class ProductGrid extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    protected $queryString = ['search'];

    public function addToCart($productId)
    {
        $product = Article::findOrFail($productId);

        app(CartService::class)->addItem([
            'id' => $product->id,
            'name' => $product->nom,
            'price' => $product->prix_ht,
            'qty' => 1
        ]);

        $this->dispatch('cartUpdated');
    }

    // ... keep other methods the same ...

    public function render()
    {
        $products = Article::query()
            ->where('nom', 'like', '%' . $this->search . '%')
            ->orWhere('code_barre', 'like', '%' . $this->search . '%')
            ->paginate(12);

        return view('livewire.product-grid', [
            'products' => $products,
            'cartCount' => app(CartService::class)->getCount()
        ]);
    }
}
