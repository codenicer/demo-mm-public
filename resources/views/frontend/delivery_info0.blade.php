@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        @include('frontend.partials.checkout_header')

        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-xl-8">
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header bg-white py-3">
                                    <h5 class="heading-6 mb-0">{{__('Delivery type')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <label class="tab-radio w-100 ">
                                                        <input class="d-none" type="radio" name="shippimg_type" value="home_delivery" checked="checked" onclick="hide_pickup()">
                                                        <span class="d-block">
                                                            {{__('Home Delivery')}}
                                                        </span>
                                                    </label>
                                                </div>
                                                @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    <div class="col">
                                                        <label class="tab-radio w-100">
                                                            <input class="d-none" type="radio" name="shippimg_type" id="shippimg_type2" value="pickup_point" onclick="pick_up_points()">
                                                            <span class="d-block">
                                                                {{__('Pickup from Pickup Point')}}
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-4 row">
                                                <div class="col-md-6 offset-md-3">
                                                    <div id="pickup">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Payment')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
{{-- @section('script')

<script type="text/javascript">

    function pick_up_points(){
        var shippimg_type2 = $('#shippimg_type2').val();
		$.post('{{ route('shipping_info.get_pick_ip_points') }}',{_token:'{{ csrf_token() }}', shippimg_type2:shippimg_type2}, function(data){
            $('#pickup').html(data);
            $('#pickup').show();
		});
    }

    function hide_pickup(){
        $('#pickup').hide();
    }

</script>

@endsection --}}
