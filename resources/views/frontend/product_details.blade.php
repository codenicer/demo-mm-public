@php
    $listing ='related_products';
@endphp
@extends('frontend.layouts.app')

@section('content')
    <!-- SHOP GRID WRAPPER -->
    <section class="product-details-area gry-bg">
        <div class="container">
            <div class="bg-white">
                <!-- Product gallery and Description -->
                <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-6">
                        <div class="product-gal sticky-top d-flex flex-row-reverse">
                            @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                <div class="product-gal-img">
                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($detailedProduct->photos)[0]) }}" xoriginal="{{ asset(json_decode($detailedProduct->photos)[0]) }}" />
                                </div>
                                <div class="product-gal-thumb">
                                    <div class="xzoom-thumbs">
                                        @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                            <a href="{{ asset($photo) }}">
                                                <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Product description -->
                        <div class="product-description-wrapper">
                            <!-- Product title -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="product-title mb-2 d-inline-block">
                                        {{ __($detailedProduct->name) }}
                                    </h1>
                                </div>
                            </div>
                            @php
                                $total = 0;
                                $total += $detailedProduct->reviews->count();
                            @endphp
                            @if($total > 0)
                            <div class="row align-items-center my-1">
                                <div class="col-6">
                                    <!-- Rating stars -->
                                    <div class="rating">
                                            <span class="star-rating">
                                                {{ renderStarRating($detailedProduct->reviews->average('rating')) }}
                                            </span>
                                            <span class="rating-count ml-1">({{ $total }} {{__('reviews')}})</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <hr />
                                <div class="row no-gutters mt-4" style="display: {{ $detailedProduct->base_price > $detailedProduct->discountPrice ? '':'none' }}">
                                    <div class="col-sm-2 col-4">
                                        <div class="product-description-label">{{__('Price')}}:</div>
                                    </div>
                                    <div class="col-sm-10 col-8">
                                        <div class="product-price-old">
                                            <del>
                                                <span id="base_price">{{ format_price($detailedProduct->base_price) }}</span>
                                                @if($detailedProduct->unit)
                                                    <span>/{{ $detailedProduct->unit }}</span>
                                                @endif
                                            </del>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters mt-3">
                                    <div class="col-sm-2 col-4">
                                        <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                                    </div>
                                    <div class="col-sm-10 col-8">
                                        <div class="product-price">
                                            <strong id="discounted_price">
                                                {{ format_price($detailedProduct->discountPrice) }}
                                            </strong>
                                            @if($detailedProduct->unit)
                                                <span class="piece">/{{ $detailedProduct->unit }}</span>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <hr>
                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->product_id }}">
                                @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                    <div class="row no-gutters">
                                        <div class="col-sm-2 col-4">
                                            <div class="product-description-label mt-2 ">{{ $attributes->where('id',$choice->attribute_id)->first()->name }}:</div>
                                        </div>
                                        <div class="col-sm-10 col-8">
                                            <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                                @foreach ($choice->values as $key => $value)
                                                    <li>
                                                        <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                        <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-sm-2 col-4">
                                            <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                        </div>
                                        <div class="col-sm-10 col-8">
                                            <ul class="list-inline checkbox-color mb-1">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $detailedProduct->product_id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};" for="{{ $detailedProduct->product_id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                <!-- Quantity + Add to cart -->
                                <div class="row no-gutters">
                                    <div class="col-sm-2 col-4">
                                        <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                                    </div>
                                    <div class="col-sm-10 col-8">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" {{isset($quantity) ? $quantity > 1 ? : 'disabled' : 'disabled'}}>
                                                        <i class="la la-minus"></i>
                                                    </button>
                                                </span>
                                            <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value="{{isset($quantity) ? $quantity : 1}}" min="1" max="10">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="plus" data-field="quantity" id='pdp_qty_button'>
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="avialable-amount">(<span id="available-quantity">{{ $detailedProduct->stock }}</span> {{__('available')}})</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row no-gutters pb-3" id="chosen_price_div">
                                    <div class="col-sm-2 col-4">
                                        <div class="product-description-label">{{__('Total Price')}}:</div>
                                    </div>
                                    <div class="col-sm-10 col-8">
                                        <div class="product-price">
                                            <strong id="chosen_price" class='c-white'>
                                                {{format_price(0)}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    <!-- Buy Now button -->

                                        <button type="button" id="btn_bn" class="btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now" onclick="buyNow()">
                                            <i class="la la-shopping-cart"></i> {{__('Buy Now')}}
                                        </button>
                                        <button type="button" id="btn_atc" class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart" onclick="addToCart()">
                                            <i class="la la-shopping-cart"></i>
                                            <span class=" d-md-inline-block"> {{__('Add to cart')}}</span>
                                        </button>

                                        <button type="button" id="btn_oos" class="btn btn-styled btn-base-3 btn-icon-left strong-700 d-none" disabled>
                                            <i class="la la-cart-arrow-down"></i> {{__('Out of Stock')}}
                                        </button>

                                </div>
                            </div>



                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    <!-- Add to wishlist button -->
                                    <!-- <button type="button" class="btn pl-0 btn-link strong-700" onclick="addToWishList({{ $detailedProduct->product_id }})">
                                        {{__('Add to wishlist')}}
                                    </button> -->
                                    <!-- Add to compare button -->
                                    <!-- <button type="button" class="btn btn-link btn-icon-left strong-700" onclick="addToCompare({{ $detailedProduct->product_id }})">
                                        {{__('Add to compare')}}
                                    </button> -->

                                </div>
                            </div>

                            <hr class="mt-2">


                            <div class="row no-gutters mt-3">
                                <div class="col-sm-2 col-4">
                                    <div class="product-description-label alpha-6">{{__('Payment')}}:</div>
                                </div>
                                <div class="col-sm-10 col-8">
                                    <ul class="inline-links">
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/visa.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/mastercard.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/maestro.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/paypal.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/cod.png') }}" width="30" class="lazyload">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="row no-gutters mt-3">
                                <div class="col-sm-2 col-4">
                                    <img loading="lazy"  src="{{ asset('frontend/images/icons/buyer-protection.png') }}" width="40" class="">
                                </div>
                                <div class="col-sm-10 col-8">
                                    <div class="heading-6 strong-700 text-info d-inline-block">Buyer protection</div><a href="" class="ml-2">View details</a>
                                    <ul class="list-symbol--1 pl-4 mb-0 mt-2">
                                        <li><strong>Full Refund</strong> if you don't receive your order</li>
                                        <li><strong>Full or Partial Refund</strong>, if the item is not as described</li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <hr class="mt-4">
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2 col-4">
                                    <div class="product-description-label mt-2">{{__('Share')}}:</div>
                                </div>
                                <div class="col-sm-10 col-8">
                                    <div id="share"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gry-bg">
        <div class="container ">
            <div class="row " >
            {{-- <div class="col-12 ">
                    @include('frontend.productreview',['reviews'=>$reviews,'reviews_count'=>$reviews_count , "paginatedReview"=>$paginatedReview,"id"=>$detailedProduct->product_id])
                </div>--}}
                <div class="col-12">
                    @if(count($detailedProduct->reviews) > 0)
                    <div class=" review-block" id="reviews_container" style="display:none">
                        @foreach ($detailedProduct->reviews as $key => $review)
                            <div class="block block-comment">
                                <div class="block-body">
                                    <div class="block-body-inner">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="rating  clearfix d-block">
                                                    <span class="star-rating star-rating-lg ">
                                                        @for ($i=0; $i < $review->rating; $i++)
                                                            <i class="fa fa-star active"></i>
                                                        @endfor
                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="comment-text">
                                            {{ $review->comment }}
                                        </p>
                                        <p>
                                        <div class="col">
                                            <span style="" class="blockquote-footer">Reviewed by<cite title="Source Title">{{ $review->full_name }}</cite></span>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                @if(count($detailedProduct->reviews) <= 0)
                                <div class="tab-pane" id="tab_default_4">
                                    <div class="fluid-paragraph py-4">
                                        <div class="text-center">
                                            {{ __('There have been no reviews for this product yet.') }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Related products')}}</span>
                    </h3>
                </div>
                <div class="row gutters-5 sm-gutters-2">
                    @foreach ($relatedProducts as $key => $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        @php
                            // $productPrice = $productPrices->where('product_id', $product->product_id)->first();
                            // $product->qty = $productPrices->where('product_id', $product->product_id)->sum('qty');
                            $productPrice  = $product->unit_price;
                            $product->qty =$product->current_stock;

                            $campaignProduct = $campaignProducts ? $campaignProducts->where('product_id', $product->product_id)->first() : null;

                            if($campaignProduct){
                                $product->base_price = $productPrice->campaign_price;
                            }else{
                                $product->base_price = $product->unit_price;
                            }
                            if($flashDealProducts){
                                $flashDealProduct = $flashDealProducts->where('product_id',$product->product_id)->first();
                                if($flashDealProduct){
                                    $flashDealProduct->base_price = $product->base_price;
                                    $product->discountPrice = getFlashDealPrice($flashDealProduct);
                                }else{
                                    $product->discountPrice = getDiscountedPrice($product);
                                }
                            }
                        @endphp
                        @include('frontend.components.product_card2', compact('product', 'listing'))
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any question about this product?')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->product_id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Question">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-person"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-locked"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <a href="#" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    @if(getBusinessSettings('google_login') == 1)
                                        <a href="#" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                        </a>
                                    @endif
                                    @if (getBusinessSettings('facebook_login') == 1)
                                        <a href="#" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                        </a>
                                    @endif
                                    @if (getBusinessSettings('twitter_login') == 1)
                                    <a href="#" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                        <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(() => {
                $('#reviews_container').css('display','')
            }, 2000);
//    		$('#share').share({
//    			networks: ['facebook','twitter','instagram'],
//    			theme: 'square'
//    		});
            getVariantPrice();
            cartQuantityInitialize('.related_products-btn-number', '.related_products-input-number')
            cardQuantityResponsivenessHandler('.related_products');

    	});
        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");
            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";
            }
            showFrontendAlert('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }
        $(window).resize(function(){
            //console.log('lmao')
            cardQuantityResponsivenessHandler('.related_products');
        })
    </script>
@endsection

<style>
.review-block {
    background-color: #ffffff;
    border: 1px solid #EFEFEF;
    padding: 15px;
    border-radius: 3px;
    margin-bottom: 15px;
}
</style>
