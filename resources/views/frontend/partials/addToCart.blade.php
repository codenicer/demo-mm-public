@php

@endphp
<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="col-lg-6">
            <div class="product-gal sticky-top d-flex flex-row-reverse">
                {{-- @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                    <div class="product-gal-img">
                        <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($product->photos)[0]) }}" xoriginal="{{ asset(json_decode($product->photos)[0]) }}" />
                    </div>
                    <div class="product-gal-thumb">
                        <div class="xzoom-thumbs">
                            @foreach (json_decode($product->photos) as $key => $photo)
                                <a href="{{ asset($photo) }}">
                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif --}}
                <div class="product-gal-img">
                    <img class="img-fit lazyload mx-auto" src="https://via.placeholder.com/600">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                    {{ __($product->name) }}
                </h2>
                @php
                    $price = $product->base_price >= $product->unit_price ? $product->base_price : $product->unit_price;
                @endphp

                    <div class="row no-gutters mt-4" style="display: {{$price > $product->discountPrice ? 'block':'none'}};">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price-old">
                                <del>
                                    <span style="display: inline;" id="base_price">{{ format_price($price) }}</span>
                                    <span>/{{ $product->unit }}</span>
                                </del>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="discounted_price">
                                    {{ format_price($product->discountPrice) }}
                                </strong>
                                <span class="piece">/{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                <hr>



                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->product_id }}">

                    @foreach (json_decode($product->choice_options) as $key => $choice)

                    <div class="row no-gutters">
                        <div class="col-2">
                            <div class="product-description-label mt-2 ">{{ $attributes->where('id',$choice->attribute_id)->first()->name }}:</div>
                        </div>
                        <div class="col-10">
                            <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                @foreach ($choice->values as $key => $value)
                                    <li>
                                        <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif onclick="">
                                        <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @endforeach

                    @if (count(json_decode($product->colors)) > 0)
                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="product-description-label mt-2">{{__('Color')}}:</div>
                            </div>
                            <div class="col-10">
                                <ul class="list-inline checkbox-color mb-1">
                                    @foreach (json_decode($product->colors) as $key => $color)
                                        <li>
                                            <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                            <label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <hr>
                    @endif

                    <!-- Quantity + Add to cart -->
                    <div class="row no-gutters">
                        <div class="col-2">
                            <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-quantity d-flex align-items-center">
                                <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                    <span class="input-group-btn">
                                        <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" @if($initQty > 1) @else disabled @endif>
                                            <i class="la la-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value={{$initQty}} min="1" max="{{$product->stocks}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="avialable-amount">(<span id="available-quantity">{{ $product->stocks }}</span> {{__('available')}})</div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Total Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="d-table width-100 mt-3">
                    <div class="d-table-cell">
                        <!-- Add to cart button -->

                            <button type="button" id="btn_atc" class="btn btn-base-1 btn-styled add-to-cart " onclick="addToCart()">
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block"> {{__('Add to cart')}}</span>
                            </button>
                            <button type="button" id="btn_oos" class="btn btn-styled btn-base-3 hidden" disabled>
                                <i class="la la-cart-arrow-down"></i> {{__('Out of Stock')}}
                            </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input[type="radio"]').on('change', function(){
        getVariantPrice();
        $("#option-choice-form button[data-type='plus']").attr('disabled', false)
        $("#option-choice-form button[data-type='minus']").attr('disabled', true)
    });
</script>
