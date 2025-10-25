<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateQtyRequest;
use App\Services\UserCartManager;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $title = 'سبد خرید';

        $userCartItems = UserCartManager::getItemsDetail();

        $cartPrices=UserCartManager::getCartPrices();

        return view('cart', compact('title', 'userCartItems','cartPrices'));
    }


    public function add(CartAddRequest $request)
    {
        UserCartManager::add(
            $request->input('product_id'),
            $request->input('qty'));

        return back();
    }

    public function clear()
    {
        UserCartManager::clearAllItems();

        return back();
    }

    public function removeItem(int $productId)
    {
        UserCartManager::removeItem($productId);

        return back();
    }


    public function updateQty(CartUpdateQtyRequest $request)
    {
        $products = $request->input('qty', []);

        foreach ($products as $product) {
            UserCartManager::updateQty($product['product_id'],$product['qty']);
       }
        return back();
    }

}
