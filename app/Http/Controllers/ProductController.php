<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductIndexRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductListHandler;
use App\Services\UserCartManager;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {

        $title = 'لیست محصولات';

        $productsQuery = Product::query();

        $productListHandler = new ProductListHandler($request, $productsQuery);
        $productListHandler->applySort();
        $productListHandler->applyFilter();
        $productListHandler->applySearch();

        $products = $productsQuery->paginate(25);

        $categories = Category::query()
            ->limit(100)
            ->get();

        $productCount = Product::count();

        return view('products.index', compact('title', 'products', 'productCount', 'categories'));
    }

    public function show(Product $product)
    {
        $title = $product->name;

        $product->load('category');
        $relatedProducts = Product::query()
            ->where('category_id', '=', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(6)
            ->get();


        $currentCartQty = UserCartManager::getProductQty($product->id);


        return view('products.show', compact('title', 'product', 'relatedProducts', 'currentCartQty'));
    }

    public function removeFilter(Request $request)
    {
        $queryString = $request->all();

        unset($queryString['category_id']);
        unset($queryString['exists']);

        return redirect()->route('products.index', $queryString);

    }

}
