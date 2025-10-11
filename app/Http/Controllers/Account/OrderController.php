<?php

namespace App\Http\Controllers\Account;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $title = 'سفارشات';

        $orders = Order::query()
            ->where('user_id', '=', Auth::id())
            ->where('status','!=',OrderStatus::PENDING)
            ->with('orderItems.product')
                ->orderByDesc('created_at')
                ->paginate(20);

        return view('account.orders', compact('title', 'orders'));

    }


}
