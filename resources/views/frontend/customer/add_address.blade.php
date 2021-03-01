@extends('frontend.layouts.app')

@section('content')

@php
   $error =  Session::get('address_error') ?Session::get('address_error') : '';
   Session::forget('address_error');
@endphp
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>
                
                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Add Address')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('profile') }}">{{__('Manage Profile')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form class="" action="{{ route('add.new.address') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Shipping info')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker address" data-placeholder="Select Address Type" name="address_type" required>
                                                    <option value="shipping">Shipping Address</option>
                                                    <option value="billing">Billing Address</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="id_about">{{__('Customer Name')}}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="First Name" rows="1" name="first_name" required></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="Last Name" rows="1" name="last_name" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Address')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Province')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your Province')}}" id="select_province" name="province">
                                                    <option value=""></option>
                                                    @foreach($provinces as $key => $province)
                                                        <option value="{{ $province->provCode }}">
                                                        {{ $province->provDesc }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                       <div class="col-md-2">
                                            <label>{{__('City')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control  mb-3 selectpicker" name="city" id="select_cityMun"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-2">
                                            <label>{{__('Baranggay')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control  mb-3 selectpicker" name="brgy" id="select_brgy"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Postal Code')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="{{ Auth::user()->postal_code }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Phone')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Add Address')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>
    
    console.log('error: ' +'{{$error}}');
    
    var select_province = document.getElementById("select_province");
    var select_city = document.getElementById("select_cityMun");
    var select_brgy = document.getElementById("select_brgy");
    select_province.onchange = function(){
        $('#select_brgy').empty();
        
        ajaxHelper(select_province.value, '{{ route('address.get_city') }}', $('#select_cityMun'), 'city');
    }
    
    ajaxHelper('{{Auth::user()->province_code}}', '{{ route('address.get_city') }}', $('#select_cityMun'), 'city');
    ajaxHelper('{{Auth::user()->citymun_code}}', '{{ route('address.get_baranggay') }}', $('#select_brgy'), 'brgy');
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
                    var element_type = '{{ Auth::user()->citymun_code }}' == x.citymunCode ? '<option selected>' : '<option >';
                    var option =  $(element_type).val(x.citymunCode).html(x.citymunDesc.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            }));
                }else{
                    var element_type = '{{ Auth::user()->brgy_code }}' == x.brgyCode ? '<option selected>' : '<option >';

                    var option =  $(element_type).val(x.brgyCode).html(x.brgyDesc.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            }));
                }
                element.append(option);
            });
        });
    }


</script>


@endsection