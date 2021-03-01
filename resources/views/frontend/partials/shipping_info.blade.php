@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        @include('frontend.partials.checkout_header')

        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="form-default" data-toggle="validator" role="form" id="shipping_form">
                            @csrf
                            <div class="card">
                                @if(Auth::check())
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Name')}}</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address')}}</label>
                                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your country')}}</label>
                                                    <select class="form-control custome-control" data-live-search="true" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <input type="text" class="form-control" value="{{ $user->city }}" name="city" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="text" class="form-control" value="{{ $user->postal_code }}" name="postal_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="text" class="form-control" value="{{ $user->phone }}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="checkout_type" value="logged">
                                    </form>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Email')}}</label>
                                                <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Address')}}</label>
                                                <input type="text" class="form-control" name="address" placeholder="{{__('Address')}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Select your country')}}</label>
                                                <select class="form-control custome-control" data-live-search="true" name="country">
                                                    @foreach (\App\Country::all() as $key => $country)
                                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('City')}}</label>
                                                <input type="text" class="form-control" placeholder="{{__('City')}}" name="city" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('Postal code')}}</label>
                                                <input type="text" class="form-control" placeholder="{{__('Postal code')}}" name="postal_code" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('Phone')}}</label>
                                                <input type="text" class="form-control" placeholder="{{__('Phone')}}" name="phone" required>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="checkout_type" value="guest">
                                </div>
                            @endif
                        </div>

                        <div class="row align-items-center pt-4">
                            <div class="col-6">
                                <a href="{{ route('home') }}" class="link link--style-3">
                                    <i class="ion-android-arrow-back"></i>
                                    {{__('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-styled btn-base-1" onclick="getPaymentInfo()">{{__('Continue to Payment')}}</button>
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

@section('script')
    <script type="text/javascript">
    function getPaymentInfo(){
        var isValid = true;
        $('.card-body input').each(function() {
            if ( this.value == '' ){
                isValid = false;
            }
        });

        if(isValid){
            //console.log($('#shipping_form').serialize());
             $.ajax({
                type:"POST",
                url:'{{ route('checkout.payment_info') }}',
                data: $('#shipping_form').serialize(),
                success: function(data){
                    $('#page-content').html(data);
                }
            });
        }
        else{
            alert('Please fill all the fileds');
        }
    }
    </script>
@endsection
