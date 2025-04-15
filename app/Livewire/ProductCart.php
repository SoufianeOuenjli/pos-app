<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;

class ProductCart extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function getCartProperty()
    {
        return app(CartService::class)->getCart();
    }

    public function incrementQty($productId)
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (isset($cart[$productId])) {
            $cartService->updateQty($productId, $cart[$productId]['qty'] + 1);
            $this->dispatch('cartUpdated');
        }
    }

    public function decrementQty($productId)
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (isset($cart[$productId])) {
            $newQty = max(1, $cart[$productId]['qty'] - 1);
            $cartService->updateQty($productId, $newQty);
            $this->dispatch('cartUpdated');
        }
    }

    public function removeProduct($productId)
    {
        app(CartService::class)->removeItem($productId);
        $this->dispatch('cartUpdated');
    }

    public function getSubTotalProperty()
    {
        return app(CartService::class)->getSubTotal();
    }

    public function getTotalQtyProperty()
    {
        return app(CartService::class)->getCount();
    }

    public function render()
    {
        return view('livewire.product-cart', [
            'cartItems' => $this->cart,
            'subTotal' => $this->subTotal,
            'totalQty' => $this->totalQty
        ]);
    }
}
