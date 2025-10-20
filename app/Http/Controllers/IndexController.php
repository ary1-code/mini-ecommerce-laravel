<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'صفحه اصلی';

        $categories = Category::query()
            ->limit(5)
            ->get();

        $newestProducts = Product::query()
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();


        $bestSellingProducts = Product::query()
            ->withCount([
                'orderItems' => function ($queryBuilder) {
                    $queryBuilder
                        ->whereHas('order', function ($queryBuilder) {
                            $queryBuilder->where('status', '=', OrderStatus::DELIVERED);
                        });
                }
            ])
            ->orderByDesc('order_items_count')
            ->limit(6)
            ->get();


        return view('index', compact('title', 'categories', 'newestProducts', 'bestSellingProducts'));
    }
}
