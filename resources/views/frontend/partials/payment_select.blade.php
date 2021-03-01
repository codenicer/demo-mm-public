@include('frontend.partials.checkout_header')

<section class="py-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-8">
                <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-title px-4">
                            <h3 class="heading heading-5 strong-500">
                                {{__('Select a payment option')}}
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <ul class="inline-links">

                                @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                    <li>
                                        <label class="payment_option">
                                            <input type="radio" id="" name="payment_option" value="cash_on_delivery" checked>
                                            <span>
                                                <img src="{{ asset('frontend/images/icons/cards/cod.png')}}" class="img-fluid">
                                            </span>
                                        </label>
                                    </li>
                                @endif
                            </ul>
                            @if (Auth::check())
                                <div class="text-center mt-4">
                                    or
                                    <div class="h5">Your wallet balance : <strong>{{ single_price(Auth::user()->balance) }}</strong></div>
                                    <button onclick="use_wallet()" class="btn btn-base-1" @if(Auth::user()->balance < $total) disabled @endif>Use your Wallet</button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row align-items-center pt-4  flex-xs-column-reverse flex-xs-row">
                        <div class="col-6 mt-xs-3 text-xs-center">
                            <a href="{{ route('home') }}" class="link link--style-3">
                                <i class="ion-android-arrow-back"></i>
                                {{__('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-6  text-right text-xs-center">
                            <button type="submit" class="btn btn-styled btn-base-1">{{__('Complete Order')}}</button>
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

<script type="text/javascript">
    function use_wallet(){
        $('input[name=payment_option]').val('wallet');
        $('#checkout-form').submit();
    }
</script>

<style>
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
