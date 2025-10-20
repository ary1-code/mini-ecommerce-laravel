<div class="swiper-slide product-card group">
    <!-- product header -->
    <div class="product-card_header">
        <div class="flex items-center gap-x-2">
            <form action="#"
                  method="POST"
            >
                @csrf
                <input type="hidden" name="product_id" value="2"/>
                <input type="hidden" name="qty" value="1"/>

                <div class="tooltip">
                    <button
                        type="submit"
                        class="rounded-full p-1.5 app-border app-hover"
                    >
                        <svg class="size-4">
                            <use href="#shopping-cart"></use>
                        </svg>
                    </button>
                    <div class="tooltiptext">
                        سبد خرید
                    </div>
                </div>
            </form>
        </div>

        @if($product->disscount > 0)
            <!-- badge offer -->
            <span class="product-card_badge">
            {{getDiscountPercent($product)}}
            %
            تخفیف‌
            </span>
        @endif
    </div>
    <!-- product img -->
    <a href="{{route('products.show', $product->id) }}">
        <img
            class="product-card_img group-hover:opacity-0 absolute"
            src="http://127.0.0.1:8000/assets/images/products/1.png"
            alt=""
        >
        <img class="product-card_img opacity-0 group-hover:opacity-100"
             src="http://127.0.0.1:8000/assets/images/products/1.png" alt="">
    </a>
    <!--  product footer -->
    <div class="space-y-2">
        <a href="{{route('products.show', $product->id) }}">
            {{getFullProductName($product)}}
        </a>
        <!-- Rate and Price -->
        <div class="product-card_price-wrapper">
            <!-- Price -->
            <div class="product-card_price">
                @if($product->disscount > 0)
                    <del>{{number_format($product->price)}}
                        <h6>تومان</h6>
                    </del>
                    <p>{{number_format($product->price - $product->disscount)}}</p>
                    <span>تومان</span>
                @else
                    <p>{{number_format($product->price)}}</p>
                    <span>تومان</span>
                @endif
            </div>
        </div>
    </div>
</div>
