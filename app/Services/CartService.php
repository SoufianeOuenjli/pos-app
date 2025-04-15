<?php

namespace App\Services;

use App\Models\CommandeDetail;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected const CART_KEY = 'shopping_cart';

    public function addItem(array $item): void
    {
        $cart = $this->getCart();

        if (isset($cart[$item['id']])) {
            $cart[$item['id']]['qty'] += $item['qty'];
        } else {
            $cart[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ];
        }

        $this->saveCart($cart);
    }

    public function removeItem(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->saveCart($cart);
    }

    public function updateQty(int $productId, int $qty): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = max(1, $qty);
            $this->saveCart($cart);
        }
    }

    public function clearCart(): void
    {
        Session::forget(self::CART_KEY);
    }

    public function getCart(): array
    {
        $cart = Session::get(self::CART_KEY, []);

        // Ensure we always return an array
        return is_array($cart) ? $cart : [];
    }

    public function getSubTotal(): float
    {
        return array_reduce($this->getCart(), function($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0);
    }

    public function getTotalQty(): float
    {
        return array_reduce($this->getCart(), function($carry, $item) {
            return $carry + $item['qty'];
        }, 0);
    }

    public function getTotalDiscountFix($discount , $shipping){
        $subTotal = $this->getSubTotal();
        $total = $subTotal - $discount + $shipping;
        return max(0, $total);

    }

    public function getTotalDiscountPercent($discount , $shipping){
        $subTotal = $this->getSubTotal();
        $total = $subTotal - ($subTotal * $discount / 100) + $shipping;
        return max(0, $total);
    }

    public function getCount(): int
    {
        return array_sum(array_column($this->getCart(), 'qty'));
    }

    protected function saveCart(array $cart): void
    {
        Session::put(self::CART_KEY, $cart);
        Session::save();
    }

    public function saveToDatabase($commandeId): void
    {
        $cart = $this->getCart();
        foreach ($cart as $item) {
            CommandeDetail::create([
                'article_id' => $item['id'],
                'commande_id' => $commandeId,
                'prix_ht' => $item['price'],
                'quantite' => $item['qty'],
            ]);
        }

    }
}
