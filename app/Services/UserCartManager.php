<?php

namespace App\Services;

use App\Models\Product;

class UserCartManager
{
    public static function getItems(): array
    {
        return session('user_cart', []);
    }

    public static function getItemsDetail(): array
    {
        $cartItems = self::getItems();

        foreach ($cartItems as $productId => $cartItem) {

            $cartItems[$productId]['product'] = Product::find($productId);
        }
        return $cartItems;
    }

    public static function add(int $productId, int $qty): void
    {
        $cartItems = self::getItems();

        $cartItems[$productId] = [
            'product_id' => $productId,
            'qty' => $qty
        ];

        session()->put('user_cart', $cartItems);

    }

    public static function getProductQty(int $productId): int
    {
        $cartItems = self::getItems();

        if (!isset($cartItems[$productId])) {
            return 0;

        }
        return $cartItems[$productId]['qty'];
    }

    public static function getProductCount(): int
    {
        return count(self::getItems());

    }

}
