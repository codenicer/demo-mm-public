<footer id="footer border-top" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">

                <div class="col-lg-5 col-xl-4 text-center text-md-left">
                    <div class="col">
                        <a href="{{ route('home') }}" class="d-block">
                            <img loading="lazy"  src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt="Ecommerce Demo" height="44">
                        </a>

                        <p class="mt-3"> Please enter your email address to subscribe to our newsletter</p>
                        <div class="d-inline-block d-md-block">
                            <form class="form-inline" method="GET" action="#">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="{{__('Your Email Address')}}" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-base-1 btn-icon-left">
                                    {{__('Subscribe')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-xl-1">
                    <div class="col text-center text-lg-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Site Link')}}
                        </h4>
                        <ul class="footer-links contact-widget">
                            <li>
                               <a href="#" title="About us">
                                    {{__('About us')}}
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Contact us">
                                    {{__('Contact us')}}
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Privacy policy">
                                    {{__('Privacy policy')}}
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Terms of Service">
                                    {{__('Terms of service')}}
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Facts and Questions">
                                    {{__('Facts and Questions')}}
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class=" col-lg-2">
                    <div class="col text-center text-lg-left">
                    <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Our branch delivery  is available in ')}}
                        </h4>
                       <ul class="footer-links">

                            <li>
                                <p class="d-block" ><strong>{{__('Metro Manila')}} </strong></p>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2">
                    <div class="col text-center text-lg-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Online Grocery Delivery Manila')}}
                        </h4>
                        <ul class="footer-links">
                            <li>
                            <p>Buy Groceries Safely Online And Get Them Delivered Straight To Your Doorstep.</p>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="footer-bottom py-3">
        <div class="container">
            <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
                <div class="col-md-4">
                    <div class="copyright text-center text-md-left">
                        <ul class="copy-links no-margin">
                            <li>
                                © {{ "2021 Code Nicer"}}
                            </li>
                            <li>
                                <a href="#">{{__('Terms')}}</a>
                            </li>
                            <li>
                                <a href="#">{{__('Privacy policy')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="text-center my-3 my-md-0 social-nav model-2">
                        @if ($generalSetting->facebook != null)
                            <li>
                                <a href="#" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalSetting->instagram != null)
                            <li>
                                <a href="#" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalSetting->twitter != null)
                            <li>
                                <a href="#" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalSetting->youtube != null)
                            <li>
                                <a href="#" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalSetting->google_plus != null)
                            <li>
                                <a href="#" class="google-plus" target="_blank" data-toggle="tooltip" data-original-title="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="text-center text-md-right">
                        <ul class="inline-links">
                                @if(getBusinessSettings('show_payment_paypal'))
                                    <li>
                                        <img loading="lazy" alt="paypal" src="{{ asset('frontend/images/icons/cards/paypal-256x160.png')}}" height="20">
                                    </li>
                                @endif
                                @if(getBusinessSettings('show_payment_credit'))
                                    <li>
                                        <img loading="lazy" alt="mastercard" src="{{ asset('frontend/images/icons/cards/mastercard.png')}}" height="20">
                                    </li>
                                    <li>
                                        <img loading="lazy" alt="visa" src="{{ asset('frontend/images/icons/cards/visa.png')}}" height="20">
                                    </li>
                                @endif
                                @if(getBusinessSettings('show_payment_grabpay'))
                                    <li>
                                        <img loading="lazy" alt="GrabPay" src="{{ asset('frontend/images/icons/cards/GrabPayLogo.png')}}" height="20">
                                    </li>
                                @endif
                                @if(getBusinessSettings('show_payment_bank_deposit'))
                                    <li>
                                        <div class='d-flex align-items-center justify-content'>
                                            <i class="fa fa-university" style='font-size: 19px' data-toggle='tooltip' data-placement='bottom' title='Bank transfer'></i>
                                        </div>
                                    </li>
                                @endif
                                @if(getBusinessSettings('show_payment_cod'))
                                    <li>
                                        <div class='d-flex align-items-center justify-content'>
                                            <i class="fa fa-truck" style='font-size: 20px; transform: rotateY(180deg)' data-toggle='tooltip' data-placement='bottom' title='Cash on delivery'></i>
                                        </div>
                                    </li>
                                @endif

                            {{--@if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)--}}
                                {{--@foreach(\App\ManualPaymentMethod::all() as $method)--}}
                                  {{--<li>--}}
                                    {{--<img loading="lazy" alt="{{ $method->heading }}" src="{{ asset($method->photo)}}" height="20">--}}
                                {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
