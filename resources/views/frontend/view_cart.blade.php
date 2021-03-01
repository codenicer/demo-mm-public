@extends('frontend.layouts.app')
@php
    $dataLayer = $cartItems ? $cartItems : [];
@endphp

@section('content')

    @include('frontend.partials.checkout_header',['step'=>1])

    <section class="py-4 gry-bg" id="cart-summary">
        <div class="container">
            @if(Session::has('cart') && count(Session::get('cart')))

                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-xl-8">

                        <!-- <form class="form-default bg-white p-4" data-toggle="validator" role="form"> -->
                        <div class="form-default bg-white p-4">
                            <div class="">
                                <div class="">
                                    <table class="table-cart border-bottom">
                                        <thead>
                                        <tr>
                                            <th class="product-image"></th>
                                            <th class="product-name">{{__('Product')}}</th>
                                            <th class="product-price d-none d-lg-table-cell">{{__('Price')}}</th>
                                            <th class="product-quanity d-none d-md-table-cell">{{__('Quantity')}}</th>
                                            <th class="product-total">{{__('Total')}}</th>
                                            <th class="product-remove"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($cartItems as $key => $cartItem)
                                            @php
                                                $productPrice = $productPrices->where('variant', $cartItem['variant'])->first();
                                                if($productPrice){
                                                    $sold_out = $productPrice->qty <  $cartItem['quantity'];
                                                }else{
                                                    $sold_out = false;
                                                }
                                            @endphp
                                            <tr class="cart-item">
                                                <td class="product-image">
                                                    <a href="#" class="mr-3">
                                                        <img loading="lazy"  src="{{ asset( isset($cartItem['thumbnail_img']) ? $cartItem['thumbnail_img'] : 'frontend/images/placeholder.jpg') }}">
                                                    </a>
                                                </td>

                                                <td class="product-name">
                                                    <span class="pr-4 d-block">{{ $cartItem['name'] }}</span>
                                                    @if(count($cartItem['specs']))
                                                        <div class="text-sm">
                                                            @foreach($cartItem['specs'] as $k => $value)
                                                                {{ucwords($k)}}:{{$value}}&nbsp;
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>

                                                <td class="product-price d-none d-lg-table-cell">
                                                    <span class="pr-3 d-block">{{ format_price($cartItem['price']) }}</span>
                                                </td>

                                                <td class="product-quantity d-none d-md-table-cell">
                                                    <div class="input-group input-group--style-2 pr-4" style="width: 150px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn cart-btn-number" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                                <i class="la la-minus"></i>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quantity[{{ $key }}]" class="form-control cart-input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="9999" onchange="updateQuantity({{ $key }}, this)">
                                                        <span class="input-group-btn">
                                                            <button class="btn cart-btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="product-total">
                                                    <span>{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</span>
                                                </td>
                                                <td class="product-remove">
                                                    <a href="javascript:void(0)" value="{{ $cartItem['id'] }}" class="text-right pl-4 item-delete">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row align-items-center pt-4  flex-xs-column-reverse flex-xs-row">
                                <div class="col-sm-6 text-xs-center mt-xs-3">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="la la-mail-reply"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-sm-6 text-right text-xs-center">
                                    @if(Auth::check())
                                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Continue to Shipping')}}</a>
                                    @else
                                        <button class="btn btn-styled btn-base-1" onclick="showCheckoutModal()">{{__('Continue to Shipping')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>

                    <div class="col-xl-4 ml-lg-auto ">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            @else
                <div class="dc-header text-center">
                    <h3 class="heading heading-6 strong-700">{{__('Your cart is empty')}}</h3>
                    <div class='btn btn-base-1 py-2 px-3 hov-bounce hov-shaddow mt-3'>
                        <a href="{{ route('home') }}" class='text-white'>{{__("Back to Shopping")}}</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 mt-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
     $(document).ready(function() {
        cartQuantityInitialize('.cart-btn-number', '.cart-input-number');
         $('.item-delete').click(function(e){
            e.preventDefault();
            removeFromCart($(this).attr('value'));
         })
    })
        function updateQuantity(key, element){
            if(parseInt(element.value) <= element.max ){
                $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
                    updateNavCart();
                    $('#cart-summary').html(data);
                });
            }
        }

        function showCheckoutModal(){
            window.location = '{{route('checkout.shipping_info') }}';
        }

        var date = new Date();
        date.setDate(date.getDate()-1);
        $('#deldatepicker').datepicker({startDate: date}).on('changeDate', function(e){
          if($('#deldatepicker').datepicker('getDate') == null){
            $('#delivery_time').attr('disabled', 'disabled');
          }else{
            var isoDate = new Date(e.date.getTime() - (e.date.getTimezoneOffset() * 60000)).toISOString().slice(0,10);
            $('#delivery_date').val(isoDate)
            $('#delivery_time').removeAttr("disabled", false)
          }
});
    </script>

    <!-- Facebook Pixel Code -->
    @if(!$dataLayer)
        <script>
            var dataLayer  = window.dataLayer || [];
            @if(Session::has('cart') && isset($total))
                dataLayer.push({
                'event': 'Cart',
                'total_cart' : '{{$total}}',
                'products': [

                        @foreach($carItems as $key => $product)
                        @php

                            $vp = \App\Product::with('brands','categories')->where('product_id', $product['id'])->first();

                            if(isset($vp->categories)){

                                $category = $vp->categories->name;
                            }else{
                                $category = null;
                            }
                            if(isset($vp->brands)){

                                $brand = $vp->brands->name;
                            }else{
                                $brand = null;
                            }
                        @endphp
                    {
                        'name':" @php echo $product['name'];
                        @endphp ",
                        'id': '{{$product['id'] ? $product['id'] : ''}}',
                        'price': '{{$product['price']}}',
                        'quantity': '{{$product['quantity']}}',
                        'brand': "@php echo $brand; @endphp",
                        'category': "@php echo $category; @endphp"
                    },
                    @endforeach
                ]
            });
            @endif
        </script>
    @endif



<style>
@media (max-width:575px) {
    .flex-xs-column-reverse {
        -ms-flex-direction: column-reverse!important;
        flex-direction: column-reverse!important;
    }

    .mt-xs-3{
        margin-top:3rem!important;
    }
	.text-xs-right {
		text-align:right
	}
	.text-xs-center {
		text-align:center!important
	}
	.text-xs-left {
		text-align:left
	}
}

</style>

@endsection
