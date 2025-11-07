@extends('admin.layout.app')

@section('breadcrumbs')
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">جزئیات محصول</h1>
        <div>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">محصولات</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">جزئیات محصول</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')

    <!-- Start::app-content -->

    <div class="main-content app-content">
        <div class="container-fluid pt-4">


            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <!-- Product Images -->
                            <div class="image-upload-wrapper d-flex flex-wrap gap-2 mb-4"
                                 style="border-radius: 8px; padding: 10px;">
                                <div style="width:150px;height:150px;">
                                    <img
                                        @if(getProductDefaultImageUrl($product))
                                         src="{{ getProductDefaultImageUrl($product) }}"
                                         @endif
                                         class="img-fluid rounded"
                                         style="width:100%;height:100%;object-fit:cover;" alt="تصویر محصول">
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <strong>نام محصول:</strong>
                                    <p>{{$product->name}}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>اسلاگ:</strong>
                                    <p>{{$product->name_en}}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>دسته‌بندی:</strong>
                                    <p>{{$product->category->name}}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>قیمت:</strong>
                                    <p>{{number_format($product->price)}}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>قیمت تخفیفی:</strong>
                                    <p>
                                        {{$product->disscount}}
                                    </p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>موجودی:</strong>
                                    <p>{{$product->qty}}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>وضعیت:</strong>
                                    <p>
                                        <span class="badge bg-success">فعال</span>
                                    </p>
                                </div>

                                <div class="col-xl-12">
                                    <strong>توضیحات:</strong>
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{route('admin.products.index')}}" class="btn btn-secondary">
                                بازگشت به لیست محصولات
                            </a>
                            <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-warning ms-2">ویرایش محصول</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- End::app-content -->
@endsection
