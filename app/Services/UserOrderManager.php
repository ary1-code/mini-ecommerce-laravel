<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Exceptions\ProductQtyException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class UserOrderManager
{

    protected User $user;
    protected array $checkoutData;


    public function __construct(User $user, array $checkoutData)
    {
        $this->user = $user;
        $this->checkoutData = $checkoutData;

    }

    public function checkStock()
    {
        $cardItems = UserCartManager::getItemsDetail();
        foreach ($cardItems as $cardItem) {
            $product = $cardItem['product'];
            $requestedQty = $cardItem['qty'];
            $currentStock = $product->qty;
            if ($requestedQty > $currentStock) {
                throw new ProductQtyException();
            }
        }

    }

    public function register(): void
    {
        $cardItems = UserCartManager::getItemsDetail();
        $cardPrices = UserCartManager::getCartPrices();
        foreach ($cardItems as $cardItem) {
            $product = $cardItem['product'];
            $qty = $cardItem['qty'];
            $product->decrement('qty', $qty);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $cardPrices['price'] - $cardPrices['disscount'],
            'total_products' => count($cardItems),
            'user_province' => $this->checkoutData['province'],
            'user_city' => $this->checkoutData['city'],
            'user_address' => $this->checkoutData['user_address'],
            'user_postal_code' => $this->checkoutData['postal_code'],
            'user_mobile' => $this->checkoutData['mobile'],
            'description' => $this->checkoutData['description'],
            'status' => OrderStatus::PROCESSING
        ]);

        foreach ($cardItems as $cardItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cardItem['product']['id'] ,
                'qty' => $qty,
                'total_price' => $cardItem['product']['price'] * $qty,
                'price' => $cardItem['product']['price'],
                'disscount' => $cardItem['product']['disscount'],
                'total_disscount' => $cardItem['product']['disscount']
            ]);

        }

    }

}
