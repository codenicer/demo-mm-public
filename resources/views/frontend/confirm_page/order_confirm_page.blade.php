@extends('frontend.layouts.app')

@section('content')
{{-- {{dd($address)}} --}}

    <section class="gry-bg py-2">
        <div class="card mx-auto" style="max-width: 650px;">
            <div class="card-body">
                <div class="text-center">


                    <i class='la la-check-circle c-base-1' style='font-size: 60px;'></i>
                    <h4 class='strong mt-2'>Thank you for your order</h4>

                </div>
                <hr />
                <div class='row no-gutters'>
                    <span class="text-muted col-6 mb-2">{{__('Order #')}}: </span>
                    <span class="col-6   mb-2">{{$order->order_name}}</span>




                    <span class="text-muted col-6 mb-2">{{__('Customer')}}: </span>
                    <span class="col-6 mb-2">{{$address->shipping_first_name }} {{$address->shipping_last_name }}</span>

                    <span class="text-muted col-6 mb-2">{{__('Contact Email')}}: </span>
                    <span class="col-6 mb-2">{{$order->contact_email}}</span>

                    <span class="text-muted col-6 mb-2">{{__('Delivery Date')}}: </span>
                    <span class="col-6 mb-2">{{$order->delivery_date}}</span>

                    <span class="text-muted col-6 mb-2">{{__('Payment Method')}}: </span>
                    <span class="col-6 mb-2">{{ getPaymentMethodNameByID($order->payment_id)}}</span>


                </div>

                <hr />

                <div class="row no-gutters">
                    <div class="col-12 col-lg-6 col-md-8 d-flex flex-column mb-3">
                        <h6 class='strong'>{{__('Shipping Info')}}</h6>
                        <span class='strong'>{{$address->shipping_first_name }} {{$address->shipping_last_name }}</span>
                        <span>{{$address->shipping_phone }}</span>
                        <span>{{$address->shipping_address }}</span>
                        <span>{{$address->shipping_city }} </span>
                    </div>

                    <div class="col-12 col-lg-6 col-md-4 d-flex flex-column">
                        <h6 class='strong'>{{__('Billing Info')}}</h6>
                        <span class='strong'>{{$address->billing_first_name }} {{$address->billing_last_name }}</span>
                        <span>{{$address->billing_phone }}</span>
                        <span>{{$address->billing_address }}</span>
                        <span>{{$address->billing_city }}</span>
                    </div>
                </div>

                <hr />

                <div class="row no-gutters flex-column">
                    <h6 class="align-self-start strong mb-2">{{__('Order Summary')}}</h6>

                    @php

                    $product_ids = "";

                    @endphp
                    @foreach($orderDetails as  $order_detail)
                        {{-- {{dd($orderDetails)}} --}}
                        @php
                            $total_item_price = $order_detail->quantity * $order_detail->item_price;





                        @endphp
                        <div class="d-flex">
                            <div class="">
                                <img style='width: 100px;' src="{{isset($order_detail->product->featured_img) ? asset($order_detail->product->featured_img) : ''}}">
                            </div>
                            <div class='ml-2 d-flex flex-column flex-grow align-self-center'>
                                <span class=""><strong>{{$order_detail->name}}</strong> <i class="muted">({{$order_detail->sku}})</i></span>
                                @if($order_detail->variation != 'base')
                                <span class="text-muted font-italic">Variation : {{$order_detail->variation}}</span>
                                @endif
                                <span class="text-muted font-italic">Quantity : {{$order_detail->product_count}}</span>
                                <span class="text-muted font-italic">Price : {{format_price($order_detail->item_price)}}</span>
                            </div>
                            <div class="flex-grow-1 text-right align-self-end">
                                <h6>{{format_price($order_detail->total_item_price)}}</h6>
                            </div>
                        </div>
                        <hr />
                    @endforeach
                </div>

                <hr />

                <div class="row no-gutters">
                    <span class="mb-2 col-8 text-muted initialism text-right">{{__('Subtotal')}}</span>
                    <span class="mb-2 col-4 text-right">{{ format_price($order->total_line_items_price) }}</span>
                    <span class="mb-2 col-8 text-muted initialism text-right">{{__('Shipping')}}</span>
                    <span class="mb-2 col-4 text-right">{{ $order->shipping_fee ? format_price($order->shipping_fee) : "FREE" }}</span>
                    @if($order->total_discount > 0)
                        <span class="mb-2 col-8 text-muted initialism text-right">{{__('Discount')}}</span>
                        <span class="mb-2 col-4 text-right "><em>-{{ format_price($order->total_discount) }}</em></span>
                    @endif
                </div>

                <hr />

                <div class="row no-gutters">
                    <div class="col-6">
                        <div class="d-flex c-base-1 align-items-center">
                            <a href="{{ route('home') }}" class='c-base-1'><i class="la la-reply text-lg mr-1"></i>{{__("Back to Shopping")}}</a>
                        </div>
                    </div>
                    <div class="col-6 d-flex">
                        <div class="flex-grow-1 mr-3">
                            <h6 class="text-muted text-right strong initialism">{{__('Grand Total')}}</h6>
                        </div>
                        <h4 class="text-2x">{{$order->total_price < 0 ? format_price(0) : format_price( $order->total_price)}}</h4>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </section>
    <script>

@endsection
