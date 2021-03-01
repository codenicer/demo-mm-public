@php
    $campaignProducts = (new \App\ViewProductCampaigns)->getCachedActiveCampaignProducts();
    $productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
    $flashDealProducts = getFlashDealProducts();
    $listing = 'flash-deal'
@endphp
@extends('frontend.layouts.app')

@section('content')

@if($flash_deal)
<style>
    .r-jc-center{
        justify-content: center;
    }
    .r-clock-style {
        justify-content: center;
        display: flex;
        margin: 2rem;
    }
    .f-5{
        font-size: 4rem;
    }
    /* .countdown-digit{
      width: auto !important;
      height: auto !important;
      font-size: 5rem !important;
    } */
</style>
    {{-- {{dd(date('m/d/Y', strtotime($flashDeal->start_date)) )}} --}}
        <section class='py-2' style='background: rgb(225,249,223)'>
            <div class="container">
                <div class='text-center'>
                    <h3 class='strong f-5'>{{$flash_deal->title}}</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="countdown countdown--style-2" data-countdown-date="{{$flash_deal->end_date}}" data-countdown-label="show"></div>
                </div>
                    <div class="row gutters-5 sm-gutters-2">
                       {{-- @if ($product->discountPrice > 0 && $product->qty > 0) --}}
                       @if ( $product->qty > 0)
                            @php
                                $product = getProductPrice($product, $productPrices,$flashDealProducts,$campaignProducts);
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

@endsection

@section('script')
    <script type="text/javascript">
        cartQuantityInitialize('.flash-deal-btn-number', '.flash-deal-input-number')
        cardQuantityResponsivenessHandler('.flash-deal');
        lazyLoad('flash-deal')

        $(window).resize(function(){
            cardQuantityResponsivenessHandler('.flash-deal');
        })

        $(window).scroll(function(){
            lazyLoad('flash-deal')
        })
    </script>
@endsection
