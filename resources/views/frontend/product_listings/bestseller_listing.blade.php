@php
    $campaignProducts = (new \App\ViewProductCampaigns)->getCachedActiveCampaignProducts();
    $productPrices = (new \App\ViewProductPrices)->getCachedProductPrices();
    $flashDealProducts = getFlashDealProducts();
    $listing = 'best_selling';
@endphp
@extends('frontend.layouts.app')


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

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                        <li><a href="#">{{__('Best Sellers')}}</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">

                    <div class="bg-white sidebar-box mb-3">
                        <div class="box-title text-center">
                            {{__('Categories')}}
                        </div>
                        <div class="box-content">
                            <div class="category-accordion">
                                @foreach ($frontendCategories as $key => $cat)
                                    @if($cat['count'] > 0)
                                        <div class="single-category">
                                            @if($key == "All products")
                                                <a class='w-100 sub-category-name'
                                                href="{{ route('best_seller.product-list') }}"
                                                style="color:{{$key == $categoryName ? '#eb7c16' : ''}}">
                                                    {{ __($key) }}
                                                    ({{$cat['count']}})
                                                </a>
                                            @else
                                                <a class='w-100 sub-category-name'
                                                href="{{ route('best_seller.list-category', [encrypt($key)]) }}"
                                                style="color:{{$key == $categoryName ? '#eb7c16' : ''}}">
                                                    {{ __($key) }}
                                                    ({{$cat['count']}})</a>
                                            @endif

                                        </div>
                                   @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-9">
                    <form class="" name="form2"
                          @if($categoryName != "All products")
                          action="{{ route('best_seller.list-category-sortby', ['category' => encrypt($categoryName)]) }}"
                          @else
                          action="{{ route('best_seller.list-sortby') }}"
                          @endif
                          method="GET">
                        @csrf
                    </form>
                    <form class="" id="search-form1" action="{{ route('best_seller.list-search', ['search' => $query ? $query : '']) }}" method="GET">

                        <div class="sort-by-bar row no-gutters bg-white px-3 pt-2">

                            <div class="col-12 col-lg-6 col-md-6 px-1">

                                <div class="sort-by-box">
                                    <div class="form-group">
                                        <label>{{__('Search')}}</label>
                                        <div class="search-widget">
                                            <input class="form-control input-lg" type="text" name="search"
                                                   placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}"
                                                    @endisset>
                                            <button type="submit" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 px-1">
                                <div class="sort-by-box">
                                    <div class="form-group">
                                        <label>{{__('Sort by')}}</label>
                                        <select class="form-control sortSelect" form="search-form1"
                                                data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                            <option value="1" @isset($sort_by) @if ($sort_by=='1' ) selected @endif
                                                    @endisset>{{__('Newest')}}</option>
                                            <option value="2" @isset($sort_by) @if ($sort_by=='2' ) selected @endif
                                                    @endisset>{{__('Oldest')}}</option>
                                            <option value="3" @isset($sort_by) @if ($sort_by=='3' ) selected @endif
                                                    @endisset>{{__('Price low to high')}}</option>
                                            <option value="4" @isset($sort_by) @if ($sort_by=='4' ) selected @endif
                                                    @endisset>{{__('Price high to low')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 section-title-1 clearfix" style="margin-bottom: -20px;">
                                <h3 class="heading-5 strong-700 mb-0 float-left">
                                    <span class="">Best Sellers</span>

                                </h3>

                            </div>

                        </div>

                    </form>

                    @if($products)
                        <div class="products-box-bar p-3 bg-white">
                            <div class="row sm-no-gutters gutters-5" id="load_more_products">
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
                            </div>
                            <div class="d-flex ">
                                @if(count($products) == 42)
                                    <button class="m-auto btn" style="cursor: pointer; color:orange" id="load_more_button">show more
                                        products</button>
                                @endif
                            </div>
                        </div>
                        <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">

                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form1').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
    <script>
        $('.url_product').click(function(){
            let id = $(this).attr('name');
            console.log($(`[url=${id}]`).attr("href"));
            window.location.href = $(`[url=${id}]`).attr("href");
        })
    </script>
    <script>
        var skip = 42
        @if(count($products) > 0)
            $( "#load_more_button" ).click(function() {
                $('#load_more_button').attr("disabled", true)
                $('#load_more_button').text('Please wait...');
                $.post('{{ route('loadmore') }}', {_token:'{{ csrf_token() }}', skip : skip, type: "bestselling", category_id: "{{isset($categoryId) ? $categoryId : null}}"}, function(data){
                    if(data == 0){
                        $('#load_more_button').text('no products available');

                    }else{
                        skip += 21
                        $('#load_more_products').append(data);
                        $('#load_more_button').text('show more products');
                        $('#load_more_button').attr("disabled", false)
                        lazyLoad('best_selling');
                    }
                });
            });
        @endif
        $(document).ready(function(){
            cartQuantityInitialize('.best_selling-btn-number', '.best_selling-input-number');
            cardQuantityResponsivenessHandler('.best_selling');
            lazyLoad('best_selling');

        })
        $(window).resize(function(){
            cardQuantityResponsivenessHandler('.best_selling');
        })

        $(window).scroll(function(){
            lazyLoad('best_selling');
        })
    </script>



@endsection

