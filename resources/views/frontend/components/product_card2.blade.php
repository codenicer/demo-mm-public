
<div class="product-card-2 align-items-center border mb-2 {{$listing}}-card position-relative bg-white">
    <input type="hidden" id="slug_{{$listing}}_{{$product->product_id}}" name="slug_{{$listing}}_{{$product->product_id}}" value='{{$product->slug}}'>
    <input type="hidden" id="product_id_{{$listing}}_{{$product->product_id}}" name="product_id_{{$listing}}_{{$product->product_id}}" value='{{$product->product_id}}'>
    <div class="product-img-wrapper product-img-loading product-img-{{$listing}} position-relative border-bottom">
        <div class="position-absolute h-100 w-100">
            {{-- {{    dd($product->thumbnail_img)}} --}}
             <img class="position-relative h-100 w-100" style="top: 0; left:0" src="{{ asset($product->thumbnail_img) }}"  alt="{{ __($product->name) }}">
        </div>
        {{-- <img class="img-fit lazyload mx-auto" src="https://via.placeholder.com/300"> --}}
        @php

            $price = $product->purchase_price >= $product->unit_price ? $product->purchase_price : $product->unit_price;
            $higherPrice =  $product->purchase_price >= $product->unit_price ? $product->unit_price :$product->purchase_price;

        @endphp
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
        {{-- <h2 class="product-title mb-2 p-0 text-truncate-2">
            <a href="{{ route('product', $product->slug ? $product->slug : '#') }}?quantity=1"  >{{ __($product->name) }}</a >
        </h2> --}}
        <h2 class="product-title mb-2 p-0 text-truncate-2">
           <a href={{route('product', $product->slug)}}> {{ __($product->name) }} <a/>
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
            {{--{{ $avg_star ? renderStarRating($avg_star) : '' }}--}}
        {{--</div>--}}
        <div class="price-box mb-2">
                <del class="old-product-price strong-400 text-sm">{{ format_price($price) }}</del>

            <span class="product-price strong-600">
                {{ format_price($higherPrice) }}
            </span>
        </div>
        <div class="d-flex {{$listing}}-product-card-qty-wrap">
            <div class='d-flex {{$listing}}-product-card-qty' style="margin-left: -8px">
                <div class="d-flex product-card-qty" >
                    <div class="p-2" style="min-width: 25px">
                        <button class='{{$listing}}-btn-number' data-type="minus" data-field="quantity{{$product->product_id}}">
                            <i class="fa fa-minus text-black-50"></i>
                        </button>
                    </div>
                    <input type="number" class='{{$listing}}-input-number py-1' name='quantity{{$product->product_id}}'  id='quantity_{{$listing}}_{{$product->product_id}}' value="1" min="1" max="{{$product->current_stock}}" step="1"/>
                    <div class="p-2" style="min-width: 25px">
                        <button class='{{$listing}}-btn-number' type="button" data-type="plus" data-field="quantity{{$product->product_id}}">
                            <i class="fa fa-plus text-black-50"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1 {{$listing}}-product-atc">
                @if($product->variant_product)

                    <button class="h-100 w-100 d-block btn-base-1" onclick="showAddToCartModal(event, {{ $product->product_id }}, 'quantity{{$product->product_id}}')">
                        <i class="la la-shopping-cart text-lg"></i>
                    </button>
                @else
                    <button class="h-100 w-100 d-block btn-base-1 btn_{{$listing}}_cart" data-content="{{$product->product_id}}" onclick="addToCartNew(event, this, '{{$listing}}')">
                        <i class="la la-shopping-cart text-lg"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
