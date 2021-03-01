@php
    $sessionCart = new \App\Http\Controllers\SessionCartController();
    $cartItems = $sessionCart->getItems();
@endphp
<a href="" class="nav-box-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
    <span class="nav-box-text d-none d-xl-inline-block">{{__('Cart')}}</span>
    @if(Session::has('cart'))
        <span class="nav-box-number">{{ count(Session::get('cart'))}}</span>
    @else
        <span class="nav-box-number">0</span>
    @endif
</a>
<ul class="dropdown-menu dropdown-menu-right px-0">
    <li>
        <div class="dropdown-cart px-0">
            @if(Session::has('cart'))
                @if($cartItems)
                    <div class="dc-header">
                        <h3 class="heading heading-6 strong-700">{{__('Cart Items')}}</h3>
                    </div>
                    <div class="dropdown-cart-items c-scrollbar">
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cartItems as $key => $cartItem)
                            @php
                                $productPrice = $productPrices->where('variant', $cartItem['variant'])->first();
                                if($productPrice){
                                    $sold_out = $productPrice->qty <  $cartItem['quantity'];
                                }else{
                                    $sold_out = false;
                                }
                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                            @endphp
                            <div class="dc-item">
                                <div class="d-flex align-items-center">
                                    <div class="dc-image">
                                        <a href="#">
                                            <img loading="lazy"  src="{{ asset(isset($cartItem['thumbnail_img']) ? $cartItem['thumbnail_img'] : 'frontend/images/placeholder.jpg') }}" class="img-fluid" alt="{{$cartItem['name']}}">
                                        </a>
                                    </div>
                                    <div class="dc-content">
                                        <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                            <a href="#">
                                                {{ __($cartItem['name']) }}
                                            </a>
                                            @if(count($cartItem['specs']))
                                                <span class="text-sm">
                                                            @foreach($cartItem['specs'] as $k => $value)
                                                        {{ucwords($k)}}:{{$value}}&nbsp;
                                                    @endforeach
                                                        </span>
                                            @endif
                                        </span>

                                        <span class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                        <span class="dc-price">{{ format_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                    </div>
                                    <div class="dc-actions">
                                        <button onclick="removeFromCart('{{ $cartItem['id'] }}')">
                                            <i class="la la-close"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="dc-item py-3">
                        <span class="subtotal-text">{{__('Subtotal')}}</span>
                        <span class="subtotal-amount">{{ format_price($total) }}</span>
                    </div>
                    <div class="py-2 text-center dc-btn">
                        <ul class="inline-links inline-links--style-3">
                            <li class="pr-3">
                                <a href="{{ route('cart') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1">
                                    <i class="la la-shopping-cart"></i> {{__('View cart')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('checkout.shipping_info') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1 light-text">
                                    <i class="la la-mail-forward"></i> {{__('Checkout')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="dc-header">
                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                    </div>
                @endif
            @else
                <div class="dc-header">
                    <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                </div>
            @endif
        </div>
    </li>
</ul>
