
@php
    $sessionCart = (new \App\Http\Controllers\SessionCartController());
    $cartItems = collect($sessionCart->getItems());
    $orderInfo = $sessionCart->getOrderInfo();
    $subtotal = $cartItems->sum('subtotal');
    $shipping_cost = isset($orderInfo['shipping_fee'] ) ? $orderInfo['shipping_fee'] : 0;
    $discount = isset($orderInfo['discount']) ? $orderInfo['discount']: 0;
    $discount_code = isset($orderInfo['discount_code']) ? $orderInfo['discount_code'] : '';
    $tax = 0;
    $total = $subtotal + $shipping_cost - $discount;
    $total = $total <= 0 ? 0 : $total;
@endphp
<div id="summary_container" class="card sticky-top mb-3">
    <div class="card-title  p-2 pr-4 ">
        <div class="row align-items-center">
            <di class="col-12 text-right">
                <a href="{{ route('home') }}" class="link link--style-3">
                    <i class="ion-android-arrow-back"></i>
                    {{__('Return to shop')}}
                </a>
            </di>
        </div>
    </div>
    <div class="card-title py-3">
        <div class="row align-items-center">

            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>{{__('Summary')}}</span>
                </h3>
            </div>


            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count($cartItems ? $cartItems: []) }} {{  count($cartItems ? $cartItems : []) > 1 ?'Items':'Item'}}</span>
            </div>

        </div>
    </div>


    <div class="card-body">



        <table class="table-cart table-cart-review">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ format_price($subtotal) }}</span>
                    </td>
                </tr>

                {{--<tr class="cart-shipping">--}}
                    {{--<th>{{__('Tax')}}</th>--}}
                    {{--<td class="text-right">--}}
                        {{--<span class="text-italic">{{ format_price($tax) }}</span>--}}
                    {{--</td>--}}
                {{--</tr>--}}

                <tr class="cart-shipping">
                    <th>{{__('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ format_price($shipping_cost) }}</span>
                    </td>
                </tr>

                @if ($discount)
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ format_price($discount) }}</span>
                        </td>
                    </tr>
                @endif



                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ format_price($total) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if (getBusinessSettings('coupon_system') == 1 && (Request::path() != 'cart' && Request::path() != 'checkout' && Request::path() != 'cart/updateQuantity' ))
            @if ($discount_code)
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ $discount_code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1" >{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1 mb-0">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have coupon code? Enter here')}}">
                        </div>
                        <button type="submit" class="btn btn-base-1" >{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>


<script>
    $(document).ready(function() {
        if( typeof isCheckout !== 'undefined' && isCheckout){

            $( window ).resize(function() {
                setSummaryPosition($(this).width())
            });
            function setSummaryPosition(windowW){
                if(windowW <= 992){
                    if(!$("#summary_parent_mobile").find('#summary_container').length){
                        $("#summary_container").detach().appendTo("#summary_parent_mobile");
                    }
                }else{
                    if($("#summary_parent_desktop  #summary_container").length == 0){
                        $("#summary_container").detach().appendTo("#summary_parent_desktop");
                    }
                }
            }
            setSummaryPosition($( window ).width())
        }
    })
</script>
