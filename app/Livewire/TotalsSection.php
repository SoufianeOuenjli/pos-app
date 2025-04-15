<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class TotalsSection extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];

    public $shipping = 0;
    public $discount = 0;

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

    public function getTotalProperty(): float|int{
        $cartService = app(CartService::class);
        $total = $cartService->getTotal((float)$this->discount , (float)$this->shipping);
        return $total;
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
