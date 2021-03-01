<div class='p-2 d-flex'>
    <h6 class='text-md flex-grow-1 mb-0'>Your Cart</h6>
    <a href="{{ route('cart') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-2 py-1 mx-2 d-flex align-items-center justify-content-center strong">
        <i class="la la-shopping-cart text-white"></i><span class="text-white text-sm">{{__('View cart')}}</span>
    </a>

    <a href="{{ route('checkout.shipping_info') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-2 py-1 mx-2 d-flex align-items-center justify-content-center strong">
        <i class="la la-mail-forward"></i><span class="text-white text-sm">{{__('Checkout')}}</span>
    </a>

    <div class="px-2" onclick="closeMobileCart()">
        <i class="fa fa-close"></i>
    </div>
</div>
<div class="border p-2">
    @php
        $cart = Session::has('cart') ? Session::get('cart') : null
    @endphp
    @if(count($cart))
        <div style='max-height: 130px; overflow-y: auto'>
            @php
                $total = 0;
                $sessionCart = new \App\Http\Controllers\SessionCartController();
                $productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
                $cartItems = $sessionCart->getItems();
            @endphp
            @foreach($cartItems as $key => $cartItem)
                @php
                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                @endphp
                @include('frontend.components.mobile_cart_card', compact('cartItem', 'key'))
            @endforeach
        </div> 
        <div class="mobile-cart-total d-flex border-top mr-2">
            <span class="text-uppercase strong text-right flex-grow-1">
                total
            </span>
            <span class='strong text-lg text-right' style='min-width: 100px;'>
                {{format_price($total)}}
            </span>
        </div>
    @else
        <div class="d-flex align-items-center justify-content-center py-2">
            <h6 class='m-0 strong'>Your cart is empty</h6>
        </div>
    @endif
</div>