<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class TotalsSection extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];

    public $shipping;
    public $discount;

    public $discountType = 'fixe';




    public function getSubTotalProperty()
    {
        $cartService = app(CartService::class);
        $total = $cartService->getSubTotal();
        return $total;

    }
    public function getTotalQtyProperty()
    {
        $cartService = app(CartService::class);
        $totalQty = $cartService->getTotalQty();
        return $totalQty;
    }

    public function getTotalProperty()
    {
        $cartService = app(CartService::class);
        $subTotal = $cartService->getSubTotal();

        // Calculate discount
        if ($this->discountType === 'percentage') {
            // dd($this->discount);
            $discountValue = $subTotal * ($this->discount / 100);
        } else {
            // dd($this->discount);
            $discountValue = $this->discount;
        }

        // Calculate total
        $total = $subTotal - $discountValue + $this->shipping;
        // $this->dispatch('cartUpdated', type: 'success', title: 'Votre commande a été passée avec succès.');
        return number_format($total, 2);
    }
    public function render()
    {
        return view('livewire.totals-section'
        ,
            [
                'subTotal' => $this->getSubTotalProperty(),
                'totalQty' => $this->getTotalQtyProperty(),
                'total' => $this->getTotalProperty(),
            ]
        );
    }
}
