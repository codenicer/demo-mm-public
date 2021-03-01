@extends('frontend.layouts.app')

@section('content')

    <section class="home-banner-area">
        <div class="container">

            <!--- SHOW  SLIDER HERE ---->
            <div class="home-slide">
                <div class="slick-carousel" data-slick-arrows="true" data-slick-dots="true" data-slick-autoplay="true">
                    @foreach ($sliders as $key => $slider)
                        <div>
                            <a href="{{ $slider->link }}" target="_blank">
                                <img class="d-block w-100" src="{{ asset($slider->photo) }}" alt="{{ env('APP_NAME')}} promo">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


            <!--- SHOW  CARDS FOR FEATURED CATEGORIES HERE ---->
                {{-- <div class="d-none d-lg-block mt-3">
                    <div class="row no-gutters">
                        @foreach ($categories as $key=>$category)
                            <div class="px-2 pt-3 h-100 categories-wrapper">
                                @include('frontend.components.mobile_categories_card', compact('category'))
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-block d-lg-none no-scrollbar categories-main-wrap mt-3" >
                    <div class="categories-slider d-flex">
                        @foreach ($categories as $key=>$category)
                            <div class="px-2 pt-3 categories-wrapper">
                                @include('frontend.components.mobile_categories_card', compact('category'))
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                {{-- <div class="my-3 categories-main-wrap bg-white d-lg-none d-block">
                    <div class="categories-slider-2 d-flex bg-white">
                        @foreach ($categories as $category)
                            <div class="categories-wrapper-2 bg-white p-1">
                                @include('frontend.components.mobile_categories_card', compact('category'))
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                <div class="my-1 categories-main-wrap-2 bg-white d-none d-lg-flex d-md-flex">
                    @foreach ($categories as $category)

                        <div class="categories-wrapper-2 p-1 "  >
                            @include('frontend.components.categories_card', compact('category'))
                        </div>
                    @endforeach
                </div>
        </div>
    </section>
    <!--- SHOW  Flash deals ---->
    <div id="section_flash_deals"></div>

    <!--- SHOW PRODUCT CARDS FOR CAMPAIGN HERE ---->
    <div id="section_campaigns"></div>

    <!--- SHOW PRODUCT CARDS FOR CAMPAIGN HERE ---->
    <div id="section_categories"></div>

    <!--- SHOW BANNER1 ---->
    <div id="section_banner1"></div>

    <!--- SHOW PRODUCT CARDS FOR COLLECTIONS HERE ---->
    <div id="section_collections"></div>

    <!--- SHOW FEATURED PRODUCT CARDS FOR COLLECTIONS HERE ---->
    <div id="section_featured_products"></div>


    <!--- SHOW BANNER2 ---->
    <div id="section_banner2"></div>


    <!--- SHOW PRODUCT CARDS FOR BEST SELLERS HERE ---->
    <div id="section_best_selling"></div>


    {{--<!--- SHOW PRODUCT CARDS FOR FEATURED ITEMS HERE ---->--}}
    {{--<div id="section_featured">--}}
    {{--@if(getBusinessSettings('show_home_featured_products'))--}}
        {{--@include('frontend.partials.featured_products_section')--}}
    {{--@endif--}}
    {{--</div>--}}
    <!--- SHOW PRODUCT CARDS FOR TODAYS DEAL HERE ---->
    <div id="section_best_brands"></div>



@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('.categories-main-wrap-2').slick({
                infinite: true,
                slidesToShow: 10,
                slidesToScroll: 1,
                prevArrow:
                    '<button type="button" class="slick-prev"><i class="la la-angle-left"></i></button>',
                nextArrow:
                    '<button type="button" class="slick-next"><i class="la la-angle-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 8
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 6
                        }
                    },
                ]
            })
            slickInit();
            @if(getBusinessSettings('show_home_flash_deals'))
                $.post('{{ route('home.section.flash_deals') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_flash_deals').html(data);
                if(data != 0){
                    cartQuantityInitialize('.flash-deal-btn-number', '.flash-deal-input-number');
                    cardQuantityResponsivenessHandler('.flash-deal');
                    $('.flash-deal-card input[type="number"]').on('click', function(e){
                        e.stopPropagation();
                    });
                    lazyLoad('flash-deal');
                    var element = $('.countdown')
                    var date = element.data('countdown-date');
                    var jsDate = new Date(date.replace(/\s/, 'T'))
                    var jsDatetoSecond = jsDate.getTime();
                    element.countdown(jsDatetoSecond).on('update.countdown', function(event) {
                        var element = $(this).html(event.strftime('' +
                            '<div class="countdown-item"><span class="countdown-digit">%-D</span><span class="countdown-label countdown-days">day%!d</span></div>' +
                            '<div class="countdown-item"><span class="countdown-digit">%H</span><span class="countdown-separator">:</span><span class="countdown-label">hr</span></div>' +
                            '<div class="countdown-item"><span class="countdown-digit">%M</span><span class="countdown-separator">:</span><span class="countdown-label">min</span></div>' +
                            '<div class="countdown-item"><span class="countdown-digit">%S</span><span class="countdown-label">sec</span></div>'
                        ));
                    });
                }
            });
            @endif
            @if(getBusinessSettings('show_home_campaigns'))
                $.post('{{ route('home.section.home_campaign') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_campaigns').html(data);
                cartQuantityInitialize('.campaign-btn-number', '.campaign-input-number');
                cardQuantityResponsivenessHandler('.campaign');
                $('.campaign-card input[type="number"]').on('click', function(e){
                    e.stopPropagation();
                })
                lazyLoad('campaign')
            });
            @endif
            @if(getBusinessSettings('show_home_categories'))
                $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_categories').html(data);
                cartQuantityInitialize('.home_categories-btn-number', '.home_categories-input-number');
                cardQuantityResponsivenessHandler('.home_categories');
                $('.home_categories-card input[type="number"]').on('click', function(e){
                    e.stopPropagation();
                })
                lazyLoad('home_categories');
            });
            @endif


            @if(getBusinessSettings('show_home_banner_1'))
                $.post('{{ route('home.section.banner1') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_banner1').html(data);
            });
            @endif
            @if(getBusinessSettings('show_home_collections'))
                $.post('{{ route('home.section.home_collections') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_collections').html(data);
                cartQuantityInitialize('.home_collections-btn-number', '.home_collections-input-number')
                cardQuantityResponsivenessHandler('.home_collections');
                $('.home_collections-card input[type="number"]').on('click', function(e){
                    e.stopPropagation();
                })
                lazyLoad('home_collections');
            });
            @endif
            @if(getBusinessSettings('show_home_banner_2'))
                $.post('{{ route('home.section.banner2') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_banner2').html(data);
            });
            @endif
            @if(getBusinessSettings('show_home_featured_products'))
                $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured_products').html(data);
                cartQuantityInitialize('.featured_products-btn-number', '.featured_products-input-number')
                cardQuantityResponsivenessHandler('.featured_products');
                $('.featured_products-card input[type="number"]').on('click', function(e){
                    e.stopPropagation();
                })
                lazyLoad('featured_products');
            });
            @endif
            @if(getBusinessSettings('show_home_best_sellers'))
                $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                cartQuantityInitialize('.best_selling-btn-number', '.best_selling-input-number')
                cardQuantityResponsivenessHandler('.best_selling');
                $('.best_selling-card input[type="number"]').on('click', function(e){
                    e.stopPropagation();
                })
                lazyLoad('best_selling');
            });
            @endif
            @if(getBusinessSettings('show_home_brands'))
                $.post('{{ route('home.section.brands') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_brands').html(data);
            });
            @endif
        });
        $(window).resize(function(){
            console.log('resize')
            @if(getBusinessSettings('show_home_flash_deals'))
                cardQuantityResponsivenessHandler('.flash-deal');
            @endif
            @if(getBusinessSettings('show_home_campaigns'))
                cardQuantityResponsivenessHandler('.campaign');
            @endif
            @if(getBusinessSettings('show_home_categories'))
                cardQuantityResponsivenessHandler('.home_categories');
            @endif
            @if(getBusinessSettings('show_home_collections'))
                cardQuantityResponsivenessHandler('.home_collections');
            @endif
            @if(getBusinessSettings('show_home_featured_products'))
                cardQuantityResponsivenessHandler('.featured_products');
            @endif
            @if(getBusinessSettings('show_home_best_sellers'))
                cardQuantityResponsivenessHandler('.best_selling');
            @endif
        });
        $(window).scroll(function (){
            console.log('scroll')
            @if(getBusinessSettings('show_home_flash_deals'))
                lazyLoad('flash-deal');
            @endif
            @if(getBusinessSettings('show_home_campaigns'))
                lazyLoad('campaign');
            @endif
             @if(getBusinessSettings('show_home_categories'))
                lazyLoad('home_categories');
            @endif
            @if(getBusinessSettings('show_home_collections'))
                lazyLoad('home_collections');
            @endif
            @if(getBusinessSettings('show_home_featured_products'))
                lazyLoad('featured_products');
            @endif
            @if(getBusinessSettings('show_home_best_sellers'))
                lazyLoad('best_selling');
            @endif
        })



    </script>
@endsection
