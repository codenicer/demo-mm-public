
<div class=
                                    "col-6 col-md-4 col-lg-2"
                                    >
 <div class="product-card-2 align-items-center border">
<div class="">
{{-- <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
    <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
</a> --}}
<img class="img-fit lazyload mx-auto" src="https://via.placeholder.com/300">
</div>
    <div class="">
        <div class="p-2">
            <h2 class="product-title mb-2 p-0 text-truncate-2">
                <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
            </h2>
            <div class="price-box mb-2">
                @if($product->unit_price > $product->purchase_price)
                    <del class="old-product-price strong-400 text-sm">{{ format_price($product->unit_price) }}</del>
                @endif
                <span class="product-price strong-600">
                                                            {{ format_price($product->purchase_price) }}
                                                        </span>
            </div>
            <div class="d-flex">
                <div class='mr-2'>
                    <input type="number" min="0" max="999" class='w-100 h-100 p-1'>
                </div>
                <div class="flex-grow-1">
                    <button class="w-100 btn btn-base-1" title="Add to Cart" onclick="showAddToCartModal({{ $product->product_id }})">
                        ADD
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
