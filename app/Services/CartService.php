<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;

class CartService
{
    public function getSummaries(User $user)
    {
        $cart = $user->cartItems()->get();

        // Hitung total pembelian dan jumlah kupon yang diterima
        $totalPurchase = 0;
        $couponsEarned = 0;
        $kuponKelipatan = 0;

        foreach ($cart as $cartItem) {
            $productTotalPrice = $cartItem->product->price * $cartItem->quantity;

            // Tambahkan harga produk ke total pembelian
            $totalPurchase += $productTotalPrice;

            // Logika untuk memberikan kupon jika harga produk di atas 50rb
            if ($cartItem->product->price > 50000 && $cartItem->quantity != 0) {
                $couponsEarned += 1;
            }
        }

        // Memberikan kupon untuk setiap kelipatan 100rb
        if($totalPurchase % 100000 === 0 && $totalPurchase != 0) {
            $kuponKelipatan += 1;
        }

        return [
            "kupon_50rb" => $couponsEarned,
            "kupon_100rb" => $kuponKelipatan,
            "total" => $totalPurchase
        ];


    }

    public function addItemToCart($productId, $quantity)
    {
        $c = new Cart();
        $c->user_id = auth()->user()->id;
        $c->product_id = $productId;
        $c->quantity = $quantity;
        $c->save();
    }

    public function updateQuantity($cartId, $quantity)
    {
        $c = Cart::find($cartId);

        $c->quantity = $quantity;
        $c->save();

        // harga
        $total = $c->product->price * $quantity;
        $summaries = $this->getSummaries(auth()->user());

        return [
            "summaries" => $summaries,
            "total" => $total
        ];
    }

    public function getHistoryBuy(User $user)
    {
        return $user->cartItems()->get();
    }

    public function deleteCart(User $user)
    {
    
        $deleted = Cart::where('user_id', '=', $user->id)->delete();
    }
}
