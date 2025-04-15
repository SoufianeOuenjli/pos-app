<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartActions extends Component
{
    public function clearCart(){
        $cartService = app(CartService::class);
        $cartService->clearCart();
        Session::flash('success', 'Cart cleared successfully.');
        $this->dispatch('cartUpdated', type: 'success', title: 'Votre panier a été vide.');
        // $this->dispatch('cartUpdated');
    }

    public function checkout(){
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();
        if (empty($cart)) {
            Session::flash('error', 'Your cart is empty.');
            return;
        }

        $commande = Commande::create([
            'client_id' => 1,
            'date' => now(),
            'rgle' =>1,
            'mode_reglement_id' =>11,
            'remise' => 5,
        ]);

        $cartService->saveToDatabase($commande->id);
        $cartService->clearCart();
        $this->dispatch('cartUpdated', type: 'success', title: 'Votre commande a été passée avec succès.');

        // Proceed to checkout logic here
        // For example, redirect to a checkout page or show a modal
        session()->flash('success', 'Post successfully updated.');
        // Session::flash('success', 'Proceeding to checkout.');
    }
    public function render()
    {
        return view('livewire.cart-actions',[
            'flashMessage' => session('cart_message')
        ]);
    }
}
