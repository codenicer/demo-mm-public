@php
@endphp

@foreach($categories as $key => $category)
    @php
            $products = isset($category->products) ? $category->products : null;

            if($products){

                    $homeCats = $homeCategories ? $homeCategories->where('category_id', $category->id)->first():null;
                    $limit  = $homeCats ? $homeCats->page_size : 10;



            }
            $listing = 'home_categories';
    @endphp
    @if($products)
    <section class="mb-1">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{ $category->name }}</span>
                    </h3>
                    <ul class="inline-links float-right">
                    <li><a href="{{route('product.category',$category->slug)}}" class="active">View More</a></li>
                    </ul>
                </div>
                <div class="row gutters-5 sm-gutters-2">
                    @php
                        $myLimit = 1;

                    @endphp

                    @foreach ($products as $key => $product)

                        @if($myLimit <= $limit)
                            @php
                                $product = getProductPrice($product, $productPrices,$flashDealProducts,$campaignProducts);

                            @endphp
                          {{-- @if ($product->discountPrice > 0 && $product->qty > 0) --}}
                          @if ( $product->qty > 0)
                                @php
                                 dd($product)
                                    $myLimit++;
                                @endphp

                                <div class="col-6 col-md-4 col-lg-2">
                                    @include('frontend.components.product_card2', compact('product', 'listing'))
                                </div>
                            @endif
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endforeach
