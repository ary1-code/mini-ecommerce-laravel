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

    public static function clearAllItems(): void
    {
        session()->forget('user_cart');
    }

    public static function removeItem(int $productId): void
    {
        $cartItems = self::getItems();

        unset($cartItems[$productId]);

        session()->put('user_cart', $cartItems);
    }

    public static function updateQty(int $productId, int $newQty): void
    {
        $cartItems = self::getItems();

        if (!isset($cartItems[$productId]['qty'])) {
            return;
        }

        $cartItems[$productId]['qty'] = $newQty;
        session()->put('user_cart', $cartItems);
    }

    public static function getCartPrice()
    {
        $cartItems = self::getItemsDetail();
        $amount = 0;
        foreach ($cartItems as $cartItem) {
            $amount += $cartItem['product']->price * $cartItem['qty'];

        }
        return $amount;
    }

    public static function getCartDiscountPrice()
    {
        $cartItems = self::getItemsDetail();
        $amount = 0;
        foreach ($cartItems as $cartItem) {
            $amount += $cartItem['product']->disscount * $cartItem['qty'];

        }
        return $amount;
    }

    public static function getCartPrices(): array
    {
        $cartItems = self::getItemsDetail();
        $price = 0;
        $disscount = 0;

        foreach ($cartItems as $cartItem) {
            $price += $cartItem['product']->price * $cartItem['qty'];
            $disscount += $cartItem['product']->disscount * $cartItem['qty'];
        }
        return compact('price', 'disscount');
    }


}
