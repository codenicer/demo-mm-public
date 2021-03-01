@php
    $pageSize = getBusinessSettings('home_flash_deal_size');

@endphp
@if($flashDeal)
    @php
        $products = $flashDeal->products;
        $listing = 'flash-deal'
    @endphp
    <section class="mb-1">
        <div class="container">
            <div class="flash-deal-box d-block d-md-none mb-2">
                <div class="countdown countdown--style-1 countdown--style-1-v1 d-flex align-items-center justify-content-center" data-countdown-date="{{$flashDeal->end_date }}" data-countdown-label="show"></div>
            </div>
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix ">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Flash Sale')}}</span>
                    </h3>
                    <div class="flash-deal-box float-left d-none d-md-block">
                        <div class="countdown countdown--style-1 countdown--style-1-v1 " data-countdown-date="{{$flashDeal->end_date }}" data-countdown-label="show"></div>
                    </div>
                    <ul class="inline-links float-right">
                        <li><a href='{{route('home.flash_deal_listing',$flashDeal->slug)}}' class="active">View More</a></li>
                        </ul>
                </div>
                <div class="row gutters-5 sm-gutters-2">
                    @foreach ($products as $key => $product)
                            @php
                                $product = getProductPrice($product, $productPrices,$products,$campaignProducts);
                            @endphp
                          {{-- @if ($product->discountPrice > 0 && $product->qty > 0) --}}
                          @if ( $product->qty > 0)
                                <div class="col-6 col-md-4 col-lg-2">
                                    @include('frontend.components.product_card2', compact('product', 'listing'))
                                </div>
                            @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


