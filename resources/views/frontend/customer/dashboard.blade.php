@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="text-right mt-4">
                            <a href="{{ route('addAddress') }}">
                                <button type="button" class="btn btn-styled btn-base-1 mb-3">+ Add New Address</button>
                            </a>
                        </div>
                        <div class="row mt-4">

                            <div class="card w-100">
                                <div class="card-header">
                                    <span class='text-lg'>{{__('Shipping Address')}}</span>
                                    
                                </div>
                                @forelse($shipping_addresses as $shipping_address)
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-9">
                                                <div class="text-lg strong">{{$shipping_address->first_name}} {{$shipping_address->last_name}}</div>
                                                <div class="d-block"><em>{{$shipping_address->phone}}</em></div>
                                                <span class="">{{$shipping_address->address}}</span>
                                                <span class="">{{$shipping_address->city}}, {{$shipping_address->province}}</span>
                                                <span class="">{{$shipping_address->country}}</span>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="pull-right ml-2 btn btn-danger w-35" onclick="confirm_modal('{{route('address.destroy', encrypt($shipping_address->customer_address_id))}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                @empty
                                    <h6 class="bg-muted text-center mt-1">No Shipping Address Yet</h6>
                                @endforelse
                            </div>

                            
                        </div>

                        <div class="row mt-4">
                            <div class="card w-100">
                                <div class="card-header">
                                    <span class='text-lg'>{{__('Billing Address')}}</span>
                                </div>
                                @forelse($billing_addresses as $billing_address)
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-9">
                                                <div class="text-lg strong">{{$billing_address->first_name}} {{$billing_address->last_name}}</div>
                                                <div class="d-block"><em>{{$billing_address->phone}}</em></div>
                                                <span class="">{{$billing_address->address}}</span>
                                                <span class="">{{$billing_address->city}}, {{$billing_address->province}}</span>
                                                <span class="">{{$billing_address->country}}</span>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="pull-right ml-2 btn btn-danger w-35" onclick="confirm_modal('{{route('address.destroy', encrypt($billing_address->customer_address_id))}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                @empty
                                    <h6 class="bg-muted text-center mt-1">No Shipping Address Yet</h6>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
