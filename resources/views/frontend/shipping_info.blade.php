@extends('frontend.layouts.app')

@section('content')
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <div id="page-content">
        @include('frontend.partials.checkout_header',['step'=>2]);

        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                            <div class="card">
                                @if(Auth::check())
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('First Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" required />
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Last Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="checkbox py-2 text-left">
                                                    <input id="marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
                                                    <label for="marketing" class='text-sm'>
                                                        {{ __('Keep me up to date on news and exclusive offers') }}
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
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
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="number" min="0" class="form-control" value="{{ $user->phone }}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your province')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="province" id="select_province">
                                                        <option value=""></option>
                                                        @foreach (\App\Http\Controllers\AddressController::showProvince() as $key => $province)
                                                            <option value="{{ $province->provCode }}"
                                                                @if ($province->code == $user->province) selected @endif>{{ $province->provDesc }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="cityMun" id="select_cityMun">
                                                        <option value=""></option>
                                                    </select>
                                                    <!-- <input type="text" class="form-control" value="{{ $user->city }}" name="city" required> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">Baranggay</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="brgy" id="select_brgy">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="number" min="0" class="form-control" value="{{ $user->postal_code }}" name="postal_code" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="checkout_type" value="logged">
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class='d-flex align-items-center h6 card-title'>
                                            <span id='ship_err_text'>{{__("Shipping Info")}}</span>
                                            <i class='ml-2 la la-truck' style='font-size: 1.5rem; background-color: white; color: rgba(27, 154, 163, 0.822);'></i>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('First Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" required />
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Last Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}" required>
                                                </div>
                                                <div class="checkbox py-2 text-left">
                                                    <input id="marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
                                                    <label for="marketing" class='text-sm'>
                                                        {{ __('Keep me up to date on news and exclusive offers') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address')}}</label>
                                                    <input type="text" class="form-control" name="address" placeholder="{{__('Street address, P.O. box, company name, c/o')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your province')}}</label>
                                                    <select class="form-control custome-control" data-live-search="true" name="province" id="select_province">
                                                        <option value=""></option>
                                                        @foreach (\App\Http\Controllers\AddressController::showProvince() as $key => $province)
                                                            <option value="{{ $province->provCode }}">{{ $province->provDesc }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="cityMun" id="select_cityMun">
                                                        <option value=""></option>
                                                    </select>
                                                    <!-- <input type="text" class="form-control" placeholder="{{__('City')}}" name="city" required> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-6">
                                         <div class="form-group has-feedback">
                                                    <label class="control-label">Baranggay</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="brgy" id="select_brgy">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                        </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="postal_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="number" min="0" class="form-control" placeholder="{{__('Phone')}}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="checkout_type" value="guest">
                                    </div>

                                    <!-- <div id="billing_card" class="card my-4">
                                        <div id="billing_form" class="card-body">
                                            <div class='d-flex align-items-center h6 card-title'>
                                                <span>{{__("My Info")}}</span>
                                                <i class='ml-2 la la-user' style='font-size: 1.5rem; background-color: white; color: rgba(27, 154, 163, 0.822);'></i>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('First Name')}}</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{__('First Name')}}" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('Last Name')}}</label>
                                                        <input type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required/>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="billing" name="address_type">
                                            </div>



                                            <div class='row'>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('Email')}}</label>
                                                        <input type="email" id="email" class="form-control" name="email" placeholder="{{__('Email')}}" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='row'>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('Country')}} {{__('Phone')}}</label> <span id='bill_err_text' name='phone-text-validator' style="color:red;margin-left:2.6rem;display:none;">Invalid phone number</span>
                                                        <span class="d-flex">

                                                            {{--<select  class="form-control" placeholder="{{__('Prefix')}}" name="prefix"  value={{"63"}} required='true'>--}}
                                                                {{--@php--}}
                                                                    {{--$countryPrefix = getCountryPhone();--}}
                                                                {{--@endphp--}}
                                                                {{--@foreach($countryPrefix as $country => $phonePrefix)--}}
                                                                    {{--<option value="{{$phonePrefix['code']}}" {{ $phonePrefix['code']== }} >{{$phonePrefix['name']}} +{{$phonePrefix['code']}}</option>--}}
                                                                {{--@endforeach--}}
                                                            {{--</select>--}}

                                                            {{-- <input type="tel" class="form-control" name="phone2" id="phone2" placeholder="{{__('Phone2')}}"/> --}}


                                                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="{{__('Phone')}}" required />
                                                        <span/>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <input type='hidden' name="accepts_marketing" value='on'/> --}}
                                        </div>
                                    </div> -->
                                @endif
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Payment')}}</button>
                                </div>
                            </div>
                            {{-- <div class="row align-items-center pt-4">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Delivery Info')}}</a>
                                </div>
                            </div> --}}
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        <div class="row ">
                            <div class="col-12 ">
                                <div class="form-group card  pt-0">
                                    <div class="card-title pl-4">
                                        <h3 class="heading heading-3 strong-400 mb-0">
                                            <span>{{__('Delivery Date')}}</span>
                                        </h3>
                                    </div>
                                    <div class="card-body pl-4">
                                        <input type="date" name="delivery_date" class='d-flex form-control datepicker'  readonly id='delivery_date' value="{{ Session::get('order_details')['delivery_date'] }}" />
                                        <div id='deldatepicker' class='d-flex justify-content-center' data-date="{{ Session::get('order_details')['delivery_date'] }}" data-date-format='yyyy-mm-dd'> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
<script>
    var select_province = document.getElementById("select_province");
    var select_city = document.getElementById("select_cityMun");
    var select_brgy = document.getElementById("select_brgy");
    select_province.onchange = function(){
        $('#select_brgy').empty();
        ajaxHelper(select_province.value, '{{ route('address.get_city') }}', $('#select_cityMun'), 'city');
    }

    select_city.onchange = function(){
         $('#select_brgy').empty();
        ajaxHelper(select_city.value, '{{ route('address.get_baranggay') }}', $('#select_brgy'), 'brgy');
    }

    function ajaxHelper(event, route, element, key) {
        element.prop('disabled', false);
        element.empty();
        $.post(route, {
            _token: '{{ csrf_token() }}',
            value: event
        }, function(data) {
            element.empty();
            element.append($('<option></option>'));

            data.forEach((x) => {
                if(key == 'city'){
                    var option =  $('<option>').val(x.citymunCode).html(x.citymunDesc.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            }));
                }else{
                    var option =  $('<option>').val(x.brgyCode).html(x.brgyDesc.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            }));
                }
                element.append(option);
            });
        });
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
@endsection
