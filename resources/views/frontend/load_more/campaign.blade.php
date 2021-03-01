@php
    $productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
    $flashDealProducts = getFlashDealProducts();
    $listing = 'campaigns';
@endphp
@section('content')
<style>
    .url_product {
        cursor: pointer;
    }

    .cartenings {
        color: #F79F8E;
    }

    .cartenings:hover {
        color: white;
        transition: 0.03s;

    }

    #product-image{
        width: 189px;
        height: 189px;
    }
</style>
@endsection
@if($products)
        @foreach ($products as $key => $product)
            @php
                $product = getProductPrice($product, $productPrices,$flashDealProducts,$product);
            @endphp
            {{-- @if ($product->discountPrice > 0 && $product->qty > 0) --}}
            @if ( $product->qty > 0)
                <div class="my-2 col-lg-3 col-md-4 col-6">
                    @include('frontend.components.product_card2', compact('product', 'listing'))
                </div>
            @endif
        @endforeach
        {{-- <div class="d-flex ">
            @if(count($products) == 41)
                <button class="m-auto btn" style="cursor: pointer; color:orange" id="load_more_button">show more products</button>
            @endif
        </div> --}}
        <div class="products-pagination bg-white p-3">
            <nav aria-label="Center aligned pagination">
                <ul class="pagination justify-content-center">

                </ul>
            </nav>
        </div>

@endif


<script>
    $(document).ready(function(){
        cartQuantityInitialize('.best_selling-btn-number', '.best_selling-input-number');
        cardQuantityResponsivenessHandler('.best_selling');
        $('[id*="btn_{{$listing}}"]').on('click', function(){
            var id = $(this).data('content');
            window.location ='/product/'+$('#slug_{{$listing}}_'+id).val()+'?quantity=' + $('#quantity_{{$listing}}_'+id).val();
        });
    })
    $(window).resize(function(){
        cardQuantityResponsivenessHandler('.best_selling');
    })
</script>
