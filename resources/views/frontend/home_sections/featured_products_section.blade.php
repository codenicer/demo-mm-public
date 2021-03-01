@if (getBusinessSettings('show_home_featured_products'))
    @php
        $listing = 'featured_products';
    @endphp
    <section class="mb-1">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Featured Products')}}</span>
                    </h3>
                    <ul class="inline-links float-right">
                        <li><a href="{{route('featured_products.product-list')}}" class="active">View More</a></li>
                    </ul>
                </div>
                <div class="row gutters-5 sm-gutters-2">
                    @foreach ($featuredProducts as $key => $product)
                        @php
                            $product = getProductPrice($product, $productPrices,$flashDealProducts,$campaignProducts);
                        @endphp
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
