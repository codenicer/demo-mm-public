@php
$campaignProducts = (new \App\ViewProductCampaigns)->getCachedActiveCampaignProducts();
$productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
$flashDealProducts = getFlashDealProducts();
$listing = $currentCategory->slug;
@endphp
@if($products)
        @foreach ($products as $key => $product)
                @php
                    $product = getProductPrice($product, $productPrices,$flashDealProducts,$campaignProducts);
                @endphp
             {{-- @if ($product->discountPrice > 0 && $product->qty > 0) --}}
             @if ( $product->qty > 0)
                    <div class="my-2 col-lg-3 col-md-4 col-6">
                        @include('frontend.components.product_card2', compact('product', 'listing'))
                    </div>
                @endif
        @endforeach
@endif

@section('script')

<script>
    $(document).ready(function(){
            cartQuantityInitialize('.{{$currentCategory->slug}}-btn-number', '.{{$currentCategory->slug}}-input-number');
            cardQuantityResponsivenessHandler('.{{$currentCategory->slug}}');
            $('[id*="btn_{{$listing}}"]').on('click', function(){
                var id = $(this).data('content');
                window.location ='/product/'+$('#slug_{{$listing}}_'+id).val()+'?quantity=' + $('#quantity_{{$listing}}_'+id).val();
            });
            $('#selected_category_slug').on('change',function(){
                window.location = '/category/'+ $(this).val();
            });
        });

        $(window).resize(function(){
            cardQuantityResponsivenessHandler('.{{$currentCategory->slug}}');
        })
</script>

@endsection
