<div class="product-card-2 align-items-center border mb-2 {{$listing}}-card bg-white">
    <div class="product-img-wrapper position-relative">

        <a href={{ route('product', $product->slug)}} class="position-absolute h-100 w-100">
             <img class="product-img" src="{{ asset($product->thumbnail_img) }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
        </a>
        {{-- <img class="img-fit lazyload mx-auto" src="https://via.placeholder.com/300"> --}}
        @if($product->qty <= 0)
            <div class='product-card-sold-out position-absolute h-100 w-100 d-flex align-items-center justify-content-center'>
                <div class="product-card-sold-out-badge px-3 py-2">
                    <span class='text-uppercase strong c-white '>{{__('Sold out')}}</span>
                </div>
            </div>
        @endif
    </div>
    <div class="p-2 position-relative">
        @if($product->qty <= 0)
            <div class="product-card-sold-out position-absolute h-100 w-100">

            </div>
        @endif
        <h2 class="product-title mb-2 p-0 text-truncate-2">
            <a href="#">{{ __($product->name) }}</a>
        </h2>
        {{--<div class="star-rating star-rating-sm mt-1">--}}
            {{--@php--}}
                {{--$rev = getReview($product->product_id);--}}

                {{--if($rev){--}}
                    {{--$review = $rev->total_reviews;--}}
                    {{--$avg_star = $rev->avg_reviews;--}}
                {{--}else{--}}
                    {{--$review = 0;--}}
                    {{--$avg_star = 0;--}}

                {{--}--}}
            {{--@endphp--}}
            {{--{{ renderStarRating($avg_star) }}--}}
        {{--</div>--}}
        <div class="price-box mb-2">
            @php
                $price = $product->base_price >= $product->unit_price ? $product->base_price : $product->unit_price;
            @endphp
            @if($price > $product->discountPrice)
                <del class="old-product-price strong-400 text-sm">{{ format_price($price) }}</del>

            @endif
            <span class="product-price strong-600">
                {{ format_price($product->discountPrice) }}
            </span>
        </div>
        <div class="d-flex {{$listing}}-product-card-qty-wrap">
            <div>
                <div class="d-flex h-100 product-card-qty" >
                    <div class="p-2">
                        <button class='{{$listing}}-btn-number' data-type="minus" data-field="quantity{{$product->product_id}}" disabled="disabled">
                            <i class="fa fa-minus text-black-50"></i>
                        </button>
                    </div>
                    <input type="number" class='{{$listing}}-input-number' name='quantity{{$product->product_id}}' value="1" min="1" max="{{$product->current_stock}}" step="1"/>
                    <div class="p-2">
                        <button class='{{$listing}}-btn-number' type="button" data-type="plus" data-field="quantity{{$product->product_id}}">
                            <i class="fa fa-plus text-black-50"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <button class="w-100 btn btn-base-1" title="Add to Cart" onclick="showAddToCartModal({{ $product->product_id }}, 'quantity{{$product->product_id}}')">
                    <i class="la la-shopping-cart text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</div>
