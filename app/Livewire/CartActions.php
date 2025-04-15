<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use Livewire\Attributes\On;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartActions extends Component
{
    public $clientId;
    public function clearCart(){
        $cartService = app(CartService::class);
        $cartService->clearCart();
        Session::flash('success', 'Cart cleared successfully.');
        $this->dispatch('cartUpdated', type: 'success', title: 'Votre panier a été vide.');
        // $this->dispatch('cartUpdated');
    }


    #[On('clientSelected')]
    public function handleClient($clientId)
    {
        $this->clientId = $clientId;

    }
    public function checkout(){
        if(empty($this->clientId) || $this->clientId == "null"){
            // Session::flash('error', 'Please select a client before proceeding to checkout.');
            $this->dispatch('cartUpdated', type: 'error', title: 'Choisir un client.');
            return;
        }

        $cartService = app(CartService::class);
        $cart = $cartService->getCart();
        if (empty($cart)) {
            $this->dispatch('cartUpdated', type: 'error', title: 'Votre panier est vide.');
            return;
        }

        $commande = Commande::create([
            'client_id' => $this->clientId,
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
