<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'لیست محصولات';

        $products = Product::query()
            ->with('defaultImage.file')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('title', 'products'));
    }

    public function show(Product $product)
    {
        $title = 'جزییات محصول';

        return view('admin.products.show', compact('title', 'product'));
    }

    public function create()
    {
        $title = 'درج محصول';

        $productsCategory = Category::query()
            ->orderBy('name')
            ->limit(100)
            ->get();
        return view('admin.products.create', compact('title', 'productsCategory'));
    }

    /**
     * @throws Throwable
     */
    public function store(ProductStoreRequest $request)
    {
        $input = $request->only([
            'name',
            'name_en',
            'category_id',
            'qty',
            'disscount',
            'price',
            'description',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::create($input);
            $imagePath = 'products';
            $isDefaultUse = false;

            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {

                    $imageExtension = $image->getClientOriginalExtension();
                    $imageSize = $image->getSize();
                    $imageName = $product->id . '_' . time() . '_' . mt_rand(11111, 99999);
                    $fullImageName = $imageName . '.' . $imageExtension;
                    $storedPath = $image->storeAs($imagePath, $fullImageName, 'public');

                    $file = File::create([
                        'name' => $fullImageName,
                        'extension' => $imageExtension,
                        'size' => $imageSize,
                        'path' => $storedPath,
                    ]);

                    if ($isDefaultUse === true) {
                        $isDefault = false;
                    } else {
                        $isDefault = true;
                        $isDefaultUse = true;
                    }
                    ProductImage::create([
                        'product_id' => $product->id,
                        'file_id' => $file->id,
                        'is_default' => $isDefault,
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'محصول با موفقیت ایجاد شد.');

        } catch (Exception $exception) {

            DB::rollBack();
            Log::error($exception);

            return back()->withErrors([
                'general' => 'محصول با موفقیت درج نشد.'
            ]);
        }
    }


    public function edit(Product $product)
    {
        $title = 'ویرایش محصول';
        return view('admin.products.edit', compact('title', 'product'));
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {
        $inputs = $request->validated();
        try {
            $product->update($inputs);
        }catch (Exception $exception){
            Log::error($exception);
            return back()->withErrors([
                'general'=>'تغییرات با موفقیت اعمال نشد'
            ]);
        }
        return redirect()->route('admin.products.index');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');

    }
}
