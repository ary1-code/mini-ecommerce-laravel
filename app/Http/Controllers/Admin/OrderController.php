<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'لیست سفارش';

        $orders = Order::query()
            ->applyOrderSort()
            ->applyOrderSearch()
            ->with('user')
            ->paginate(20);
        return view('admin.orders.index', compact('title', 'orders'));
    }

    public function show(Order $order)
    {
        $title = 'جزییات سفارش';

        $order->load([
            'orderItems.product',
            'user'
        ]);
        return view('admin.orders.show', compact('title', 'order'));
    }

    public function edit(Order $order)
    {
        $title = 'ویرایش محصول';
        return view('admin.orders.edit', compact('title', 'order'));
    }

    public function update(Order $order, OrderUpdateRequest $request)
    {
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index');
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');

    }
}
