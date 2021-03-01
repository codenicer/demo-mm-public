@php
    $campaignProducts = (new \App\ViewProductCampaigns)->getCachedActiveCampaignProducts();
    $productPrices = (new \App\ViewProductPrices())->getCachedProductPrices();
    $flashDealProducts = getFlashDealProducts();
@endphp
@extends('frontend.layouts.app')

@php
$meta_title = config('app.name');
$meta_description = \App\SeoSetting::first()->description;
@endphp

@section('meta_title'){{ $currentCollection->slug }}@stop
@section('meta_description'){{ $currentCollection->slug }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection


@php
    $listing = 'collections'
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

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                    <li><a >{{__('Collections')}}</a></li>
                    <li><a >{{$currentCollection->title}}</a></li>
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
                                            href="{{ route('product.collection', $currentCollection->slug) }}"
                                            style="color:{{$key == $categoryName ? '#eb7c16' : ''}}">
                                                {{ __($key) }}
                                                ({{$cat['count']}})
                                            </a>
                                        @else
                                            <a class='w-100 sub-category-name'
                                            href="{{ route('product.collection-category', [$currentCollection->slug, encrypt($key)]) }}"
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
                    action="{{ route('product.collection-category-sortby', ['slug' => $currentCollection->slug, 'category' => encrypt($categoryName)]) }}"
                @else
                    action="{{ route('product.collection-sortby', ['slug' => $currentCollection->slug]) }}"
                @endif
                method="GET">
                    @csrf
                </form>
                <form class="" id="search-form1" action="{{ route('product.collection-search', ['slug' => $currentCollection->slug, 'search' => $query ? $query : '']) }}" method="GET">
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
                                <span class="">{{ $currentCollection->title }}</span>
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
                        @if(count($products) == 40)
                            <button class="m-auto btn" style="cursor: pointer; color:orange" id="load_more_button">show more products</button>
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

    $('.url_product').click(function(){

        let id = $(this).attr('name');

        console.log($(`[url=${id}]`).attr("href"));


        window.location.href = $(`[url=${id}]`).attr("href");


    })

    var skip = 40
    @if(count($products) > 0)
        $( "#load_more_button" ).click(function() {

            $('#load_more_button').attr("disabled", true)
            $('#load_more_button').text('Please wait...');

            if(data == 0){
                $('#load_more_button').text('no products available');

            }else{
                skip += 21
                $('#load_more_products').append(data);
                $('#load_more_button').text('show more products');
                $('#load_more_button').attr("disabled", false)
                lazyLoad('collections');
            }
        });
    @endif

    $(document).ready(function(){
        cartQuantityInitialize('.collections-btn-number', '.collections-input-number');
        cardQuantityResponsivenessHandler('.collections');
        lazyLoad('collections');
    })

    $(window).resize(function(){
        cardQuantityResponsivenessHandler('.collections');
    })

    $(window).scroll(function(){
        lazyLoad('collections');
    })
</script>
@endsection
