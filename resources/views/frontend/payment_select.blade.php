@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        @include('frontend.partials.checkout_header',['step'=>3]);
        <section class="py-3 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST" id="checkout-form" onsubmit="return paymentModal();">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4 py-3">
                                    <h3 class="heading heading-5 strong-500">
                                        {{__('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="">

                                    <div class="row no-gutters dark-bg">

                                        @if(getBusinessSettings('show_payment_cod'))
                                            <div class='col-6 col-lg-3 col-md-4'>
                                                <div class='position-relative payment_wrap'>
                                                    <input type="radio"  onclick="setPayment('CashOnDelivery')" name='payment_type' value='CashOnDelivery' class='position-absolute w-100 h-100'>
                                                    <div class="payment-indicator position-absolute w-100"></div>
                                                    <div class='position-absolute d-flex flex-column align-items-center w-100 h-100 justify-content-center' style='z-index: 2'>
                                                        <i class="fa fa-truck" style='font-size: 1.8rem; transform: rotateY(180deg)'></i>
                                                        <div style='height: 33px' class='d-flex align-items-start justify-content-center pt-2' >
                                                            <span class="strong">{{__('Cash On Delivery')}}</span>
                                                        </div>
                                                        <div style='height: 20px' class='d-flex align-items-start justify-content-center' >
                                                            {{-- <span class="small">{{__('Account required')}}</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(getBusinessSettings('disable_payment_cod'))
                                                    <div class="position-absolute h-100 w-100 payment-disabler"></div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="payment-information">
                                    <div id="Eghl" class="payment-information-container">
                                        <div  class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
                                            <div class="flex-grow-1">
                                                <img src="{{ asset('frontend/images/icons/cards/eGHL.png')}}" height='70px' alt="eGHL">
                                                <!-- PayPal Logo -->
                                            </div>
                                        </div>
                                        <div class="card-text d-flex flex-column align-items-center zoomIn mt-2">
                                            <span>After clicking “Complete order”, you will be redirected to eGHL Payment Gateway to complete your purchase securely.</span>
                                        </div>
                                    </div>
                                    <div id="BankDeposit" class="payment-information-container">
                                        <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
                                            <h3 class='strong'>BPI</h3>
                                        </div>
                                        <div class="card-text d-flex flex-column align-items-center zoomIn mt-2">
                                            <span>Once the order is completed, you can settle the amount into our BPI account (via deposit or bank transfer)</span>
                                            <table class='table table-borderless'>
                                                <tbody>
                                                    <tr>
                                                        <th>Bank: </th>
                                                        <td>BPI</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Type of account: </th>
                                                        <td>Checking</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Account name:</th>
                                                        <td>Blue Aurora Solutions, Inc.</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Account number: </th>
                                                        <td>0071-1013-71</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <span class='text-danger text-sm'>NOTE: Proof of payment must be sent before your selected delivery time to ensure we are able to process the order. Otherwise your order will be cancelled. Our customer service team will confirm the order as soon as the payment has been verified.</span>
                                        </div>
                                    </div>
                                    <div id="PaypalPayment" class="payment-information-container">
                                        <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
                                            <img src="{{ asset('frontend/images/icons/cards/paypal150.png')}}" alt="PayPal">
                                            <input type="hidden" name="payment_option" value="paypal">
                                        </div>
                                        <div class="card-text d-flex flex-column align-items-center zoomIn">
                                            <span>After clicking “Complete order”, you will be redirected to PayPal to complete your purchase securely.</span>
                                        </div>
                                    </div>
                                    <div id="CashOnDelivery"  class="payment-information-container">
                                        <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
                                            <h3 class='strong'>COD</h3>
                                        </div>
                                        <div class="card-text d-flex flex-column align-items-center zoomIn">
                                            <span>After your order has been placed we will collect the total amount when delivering the order.</span>
                                        </div>
                                    </div>
                                    <div id="GrabPay"  class="payment-information-container">
                                        <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
                                            <img src="{{ asset('frontend/images/icons/cards/GrabPayLogo.png')}}" alt="GrabPay" height='50'>
                                            <input type="hidden" name="payment_option" value="Billease">
                                        </div>
                                        <div class="card-text d-flex flex-column align-items-center zoomIn">
                                            <span>Please note that you need to have a GrabPay account.</span>
                                            <span>
                                                After clicking "Complete order".
                                            </span>
                                            <span>
                                                You will be redirected to the GrabPay Payment Gateway to complete your purchase securely.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right" >
                                    <button type="submit"   class="btn btn-styled btn-base-1">{{__('Complete Order')}}</button>
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

    <div class="modal fade" id="payment-modal">
        <div class="d-flex h-100 w-100 align-items-center justify-content-center text-center flex-column">
            <div class="loader">
                <div class="dot bg-white"></div>
                <div class="dot bg-white"></div>
                <div class="dot bg-white"></div>
            </div>
        </div>
    </div>
@endsection

<script>

        function setPayment(payment_type){
            var radios = document.querySelectorAll(".payment-information-container");

            [].forEach.call(radios, function(radio) {
                radio.classList.remove("active");
            });
            console.log(document.querySelectorAll("#"+payment_type));

             document.getElementById(payment_type).className +=" active";

        }
</script>

<style>
.dark-bg{
    background-color: rgba(0,0,0,.03);
}

.payment-information{
    position: relative;
    padding: 1.5rem 1.5rem;
}

.payment-information-container{
    position:absolute;
    opacity: 0;
}

.payment-information-container.active{
    position: static;
    opacity: 1;
    transition: opacity 0.25s linear;
}

@keyframes createBox {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}
</style>
