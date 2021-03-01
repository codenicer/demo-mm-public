@php

@endphp
@foreach($collections as $key => $collection)
    @php
            $products = isset($collection->products) ? $collection->products : null;
            $listing = 'home_collections';
    @endphp
    @if($products)
    <section class="mb-1">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{ $collection->title }}</span>
                    </h3>
                    <ul class="inline-links float-right">
                    <li><a href="{{route('product.collection',$collection->slug)}}" class="active">View More</a></li>
                    </ul>
                </div>
                <div class="row gutters-5 sm-gutters-2">
                    @foreach ($products as $key => $product)
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
    </section>

    @endif
@endforeach
