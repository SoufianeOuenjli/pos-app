<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCart extends Component
{
    public $cart = [];

    protected $listeners = ['productAdded' => 'addProduct'];

    public function addProduct($product)
    {
        foreach ($this->cart as &$item) {
            if ($item['id'] === $product['id']) {
                $item['qty']++;
                return;
            }
        }

        $product['qty'] = 1;
        $this->cart[] = $product;
    }

    public function incrementQty($index)
    {
        $this->cart[$index]['qty']++;
    }

    public function decrementQty($index)
    {
        if ($this->cart[$index]['qty'] > 1) {
            $this->cart[$index]['qty']--;
        }
    }

    public function removeProduct($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart); // reindex
    }

    public function getSubTotalProperty()
    {
        return collect($this->cart)->sum(fn($item) => $item['qty'] * $item['price']);
    }

    public function getQtyProperty()
    {
        return collect($this->cart)->sum('qty');
    }

    public function render()
    {
        return view('livewire.product-cart');
    }
}
