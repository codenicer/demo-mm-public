@extends('frontend.layouts.app')
@section('content')
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <div id="page-content">
        @include('frontend.partials.checkout_header',['step'=>2])

        <section class="py-4 gry-bg">
            <form class="form-default" autocomplete="off" id="form_info" data-toggle="validator" action="{{ route('checkout.store_shipping_info') }}" onsubmit="return formSubmit(this)"  role="form" method="POST">
                <div class="container">
                    <div class="row  flex-column-reverse flex-lg-row cols-xs-space cols-sm-space cols-md-space">
                        <div class="col-lg-8">

                            @csrf
                            <div class="card">
                                <div class="card-body">

                                    <div class="">
                                        @if($shipping_addresses)
                                            <div id="s_address_div no" class='d-flex scroll-hidden' style="overflow:hidden; overflow-x:auto ">
                                                @foreach($shipping_addresses  as $key => $shipping)
                                                    <label>
                                                        <input type="radio" name="shipping_auth_card" class="card-input-element d-none" value='{{$shipping->id}}' data-content="{{json_encode($shipping)}}" />
                                                        <div class="card p-2 shipping-info-card">
                                                            <i class='fa fa-check-square address_radio' style='position: absolute; top: -3px; right: 0; font-size: 1.2rem; display:none'></i>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                <span style='white-space: nowrap'>
                                                                    <strong class='font-weight-bold'>{{$shipping->first_name}} {{$shipping->last_name}}</strong>
                                                                    <em>({{$shipping->phone}})</em>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 d-flex flex-column text-sm">
                                                                    <span class="">{{$shipping->address}}</span>
                                                                    <span class="">{{$shipping->city}}, {{$shipping->province}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>



                                    <div class='d-flex align-items-center h6 card-title'>
                                        <span id='ship_err_text'>{{__("Shipping Info")}}</span>
                                        <i class='ml-2 la la-truck' style='font-size: 1.5rem; background-color: white; color: rgba(27, 154, 163, 0.822);'></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('First Name')}}</label>
                                                <input id="first_name" type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" value="{{isset($shippingInfo['first_name']) ? $shippingInfo['first_name'] : ''}}" required />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Last Name')}}</label>
                                                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" value="{{isset($shippingInfo['last_name']) ? $shippingInfo['last_name'] : ''}}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="control-label">{{__('Email')}}</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('Email')}}" value="{{isset($shippingInfo['email']) ? $shippingInfo['email'] : ''}}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('Contact Number')}}</label>
                                                <input id="phone" type="tel"  class="form-control" placeholder="{{__('Phone')}}" name="phone" value="{{isset($shippingInfo['phone']) ? $shippingInfo['phone'] : ''}}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox  text-left">
                                                <input id="accepts_marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
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
                                                <input type="text" id="address" class="form-control" name="address" placeholder="{{__('Street address, P.O. box, company name, c/o')}}" value="{{isset($shippingInfo['address'] ) ? $shippingInfo['address']: ''}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Select your province')}}</label>
                                                <select class="form-control custom-control" data-live-search="true" name="province_id" id="province_id" required>
                                                    @foreach ($provinces as $key => $province)
                                                        <option value="{{ $province->provCode }}" {{ (isset($shippingInfo['province_id']) && $province->provCode == $shippingInfo['province_id']) || getBusinessSettings('default_province') == $province->provCode ? 'selected':''}} >{{ $province->provDesc }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('City')}}</label>
                                                <select class="form-control selectpicker" data-live-search="true" name="city_id" id="city_id" required>
                                                    <option value="" disabled selected>-select-city-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Barangay</label>
                                                <select class="form-control selectpicker" data-live-search="true" name="barangay_id" id="barangay_id" required>
                                                    <option value="" disabled selected>-select-barangay-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{__('Postal code')}}</label>
                                                <input id="zip" type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="zip"  value="{{isset($shippingInfo) ? $shippingInfo['zip'] : ''}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="checkout_type" value="guest">
                                    <input type="hidden" name="province" id="province" value="{{isset($shippingInfo['province']) ? $shippingInfo['province'] : ''}}">
                                    <input type="hidden" name="city" id="city" value="{{isset($shippingInfo['city']) ? $shippingInfo['city'] : ''}}">
                                    <input type="hidden" name="barangay" id="barangay" value="{{isset($shippingInfo['barangay']) ? $shippingInfo['barangay'] : ''}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox py-2 text-left">
                                            @php
                                            if(isset($shippingInfo)){
                                                if(isset($shippingInfo['billing_same_as_shipping']) && $shippingInfo['billing_same_as_shipping'] == "0"  ){
                                                    $billingIsSame = 'checked';
                                                    {{$shippingInfo['billing_same_as_shipping'];}}
                                                }else{
                                                    $billingIsSame = '';
                                                }
                                            }else{
                                                $billingIsSame = 'checked';
                                            }
                                            @endphp
                                                <input  type="text" id="input_billing_same_as_shipping" name="input_billing_same_as_shipping"  class="d-none" required value="{{isset( $shippingInfo['billing_same_as_shipping']) ? $shippingInfo['billing_same_as_shipping'] : '' }}" >
                                                <input onchange="billing_checkbox_handler(this)"  id="billing_same_as_shipping" autocomplete="off" class="magic-checkbox"  type="checkbox"  {{$billingIsSame}}  value="same_billing"/>
                                                <label for="billing_same_as_shipping" class='text-sm'>
                                                    {{ __('Billing address same as shipping.')  }}
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <br>

                                    <div id="billing_info_form" >
                                    <div class="">
                                        @if($billing_addresses)
                                            <div id="s_address_div no" class='d-flex scroll-hidden' style="overflow:hidden; overflow-x:auto ">
                                                @foreach($billing_addresses  as $key => $billing)
                                                    <label>
                                                        <input type="radio" name="shipping_auth_card" class="card-input-element billing d-none" value='{{$billing->id}}' data-content="{{json_encode($billing)}}" />
                                                        <div class="card p-2 shipping-info-card">
                                                            <i class='fa fa-check-square address_radio' style='position: absolute; top: -3px; right: 0; font-size: 1.2rem; display:none'></i>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                <span style='white-space: nowrap'>
                                                                    <strong class='font-weight-bold'>{{$billing->first_name}} {{$billing->last_name}}</strong>
                                                                    <em>({{$billing->phone}})</em>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 d-flex flex-column text-sm">
                                                                    <span class="">{{$billing->address}}</span>
                                                                    <span class="">{{$billing->city}}, {{$billing->province}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                        @include('frontend.billing_info.billing_info')
                                    </div>
                                </div>
                            </div>
                            <div id="summary_parent_mobile" class="pt-4">
                            </div>
                            <div class="row align-items-center pt-4  flex-xs-column-reverse flex-xs-row">
                                <div class="col-6 mt-xs-3 text-xs-center">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right text-xs-center">
                                    <button type="submit" form='form_info' class="btn btn-styled btn-base-1">{{__('Continue to Payment')}}</button>
                                </div>
                            </div>
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
                                        @include('frontend.partials.billing_date',[ 'blockDays'=>$blockDays,'blockDates'=>$blockDates, 'today' => $today])

                                    </div>
                                </div>
                            </div>
                            <div id="summary_parent_desktop">
                                @include('frontend.partials.cart_summary')
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

@endsection
<link rel="stylesheet" href="{{asset('frontend/css/intlTelInput.min.css?'.date('His'))}}">
<script src="{{asset('frontend/js/intlTelInput.min.js?'.date('His'))}}"></script>
@section('script')
    <script>

        var province_id = 0;
        var city_id = 0;
        var barangay_id = 0;

        $('.card-input-element:not(.billing)').on('click', function(){
            //var selected = $(this).find('option:selected');
            var extra = $(this).data('content');


           try{
               var pcb = JSON.parse(extra.pcb_code);
               city_id = pcb.city_id;
               barangay_id = pcb.barangay_id;
               $('#first_name').val(extra.first_name);
               $('#last_name').val(extra.last_name);
               $('#address').val(extra.address);
               $('#email').val(extra.email);
               $('#phone').val(extra.phone);
               $('#zip').val(extra.zip);
               $('#city').val(extra.city);
               $('#barangay_id').val(pcb.barangay_id);

               $('#province_id').val(pcb.province_id);
               $('#province_id').trigger('change');

           }catch(e){
               $('#province_id').trigger('change');
           }


        });

        $('.card-input-element.billing').on('click', function(){
            //var selected = $(this).find('option:selected');
            var extra = $(this).data('content');
           try{
               var pcb = JSON.parse(extra.pcb_code);
               city_id = pcb.city_id;
               barangay_id = pcb.barangay_id;
               $('#billing_first_name').val(extra.first_name);
               $('#billing_last_name').val(extra.last_name);
               $('#billing_address').val(extra.address);
               $('#billing_phone').val(extra.phone);
               $('#billing_postal_code').val(extra.zip);
               $('#billing_city').val(extra.city);
               $('#billing_barangay').val(extra.barangay);

               $('#billing_province').val(extra.province);
            //    $('#billing_province').trigger('change');

           }catch(e){
            //    $('#province_id').trigger('change');
           }


        });
        var input = document.querySelector('#phone');

        var iti = intlTelInput(input, {
            initialCountry: "PH",
            utilsScript: "{{asset('frontend/js/utils.js')}}",
            formatOnDisplay: true,
            onlyCountries: ["ph","PH"]

        });

        input.value="{{ isset($shippingInfo['phone']) ? $shippingInfo['phone'] : ''}}";

        var isCheckout = true;
        $(document).ready(function() {
            /* init for address */

            $('#province_id').on('change', function(){
                // console.log('province_id triggered');
                if($(this).val()){
                    $('#province').val($(this).find('option:selected').text());
                    $.post('{{ route('address.get_city') }}',{_token:'{{ csrf_token() }}', value:$(this).val()}, function(data){
                        $('#city_id').html(null);
                        $('#city_id').append($('<option>', {
                            value: '',
                            text: '-select-city-',
                            selected: true,
                            disabled:true
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#city_id').append($('<option>', {
                                value: data[i].citymunCode,
                                text: data[i].citymunDesc
                            }));
                        }
                        $("#city_id > option").each(function() {
                            if(this.value == '{{isset($shippingInfo['city_id']) ? $shippingInfo['city_id'] : 0 }}'){
                                $("#city_id").val(this.value).change();
                            }else if(this.value == city_id){
                                $("#city_id").val(this.value).change();
                            }
                        });
                    });


                }

            });

            $('#city_id').on('change', function(){
                if($(this).val()){
                    $('#city').val($(this).find('option:selected').text());
                    $.post('{{ route('address.get_baranggay') }}',{_token:'{{ csrf_token() }}', value:$(this).val()}, function(data){
                        $('#barangay_id').html(null);
                        $('#barangay_id').append($('<option>', {
                            value: '',
                            text: '-select-barangay-',
                            selected: true,
                            disabled:true
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#barangay_id').append($('<option>', {
                                value: data[i].id,
                                text: data[i].brgyDesc
                            }));
                        }
                        $("#barangay_id > option").each(function() {

                            if(this.value == '{{isset($shippingInfo['barangay_id']) ? $shippingInfo['barangay_id']:0}}'){
                                $("#barangay_id").val(this.value).change();
                            }else if(this.value == barangay_id){
                                $("#barangay_id").val(this.value).change();
                            }

                        });
                    });


                }

            });

            $('#barangay_id').on('change', function() {
                if ($(this).val()) {
                    $('#barangay').val($(this).find('option:selected').text());
                }
            });

            /* on load */
            $('#province_id').trigger('change');



        });

        function philippineNumberPhoneValidator(){

            const number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
            const isvalid = iti.isValidNumber();
            const country_code = iti.s.iso2;
            return {
                valid:isvalid,
                philippine_number:country_code === 'ph' && isvalid,
                number:number
            }



        }

        function formSubmit(e) {
            try{
                var isvalid = philippineNumberPhoneValidator();
                const delivery_date = $('#delivery_date').val()
            if(!delivery_date){
                alert('Please select delivery date.');
                return false
            }
                if (isvalid.valid === false) {
                    alert('Invalid mobile number. Please try again');
                    $('#phone').focus();
                    $('#phone').select();
                    return false;
                }
            }catch(e){
                console.log(e);
                return false;
            }

            return true;
        }


    </script>
    <style>
        .pt-43px{
            padding-top:43px;
        }
        .card-input-element+.card:hover {
            cursor: pointer;
        }

        .card-input-element+.card {
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 2px solid #e2e2e2;
            border-radius: 4px;
        }



        .iti{
            display:block!important
        }


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
