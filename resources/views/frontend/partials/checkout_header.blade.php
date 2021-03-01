@php
    $step = isset($step) ? $step : 1
@endphp
<section class="slice-xs sct-color-2 border-bottom">
    <div class="container container-sm">
        <div class="row cols-delimited justify-content-center">
            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{ $step == 1 ? 'active':'' }}">
                    <div class="block-icon {{ $step == 1 ? '':'c-gray-light' }} mb-0">
                        <i class="la la-shopping-cart"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{ $step == 2 ? 'active':'' }}">
                    <div class="block-icon {{ $step == 2 ? '':'c-gray-light' }} mb-0">
                        <i class="la la-map-o"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Shipping info')}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{ $step == 3 ? 'active':'' }}">
                    <div class="block-icon {{ $step == 3 ? '':'c-gray-light' }} mb-0">
                        <i class="la la-credit-card"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Payment')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>