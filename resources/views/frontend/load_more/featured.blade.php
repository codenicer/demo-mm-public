@php
$campaignProducts = (new \App\ViewProductCampaigns)->getCachedActiveCampaignProducts();
$productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
$flashDealProducts = getFlashDealProducts();
$listing = 'featured_products';
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
    {{-- <div class="d-flex ">
        @if(count($products) == 1)
        <button class="m-auto btn" style="cursor: pointer; color:orange" id="load_more_button">show more
            products</button>
        @endif
    </div> --}}
    <div class="products-pagination bg-white p-3">
        <nav aria-label="Center aligned pagination">
            <ul class="pagination justify-content-center">

            </ul>
        </nav>
    </div>
@endif

@section('script')

    <script>
        $(document).ready(function(){
            cartQuantityInitialize('.featured_products-btn-number', '.featured_products-input-number');
            cardQuantityResponsivenessHandler('.featured_products');
            $('[id*="btn_{{$listing}}"]').on('click', function(){
                var id = $(this).data('content');
                window.location ='/product/'+$('#slug_{{$listing}}_'+id).val()+'?quantity=' + $('#quantity_{{$listing}}_'+id).val();
            });
        })

        $(window).resize(function(){
            cardQuantityResponsivenessHandler('.featured_products');
        })
    </script>

@endsection
