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
    public $selectedBrand = null;
    public $selectedCategory = null;
    protected $queryString = ['search', 'selectedBrand', 'selectedCategory'];

    protected $listeners = [
        'cartUpdated' => '$refresh',
        'brandFilterUpdated' => 'handleBrandFilter',
        'categoryFilterUpdated' => 'handleCategoryFilter'
    ];

    public function handleBrandFilter($brandId)
    {
        $this->selectedBrand = $brandId;
        $this->resetPage();
    }
    public function handleCategoryFilter($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }


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
        $query = Article::query()
            ->when($this->selectedBrand, function ($q) {
                $q->where('marque_id', $this->selectedBrand);
            })
            ->when($this->selectedCategory, function ($q) {
                $q->where('famille_id', $this->selectedCategory);
            })
            ->where(function ($q) {
                $q->where('nom', 'like', '%' . $this->search . '%')
                    ->orWhere('code_barre', 'like', '%' . $this->search . '%');
            });

        $products = $query->paginate(12);

        return view('livewire.product-grid', [
            'products' => $products,
            'cartCount' => app(CartService::class)->getCount()
        ]);
    }
}
