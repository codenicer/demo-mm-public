<!DOCTYPE html>
<html lang="en">
<head>

@php
    $seoSetting = (new \App\SeoSetting)->getCache();
    $generalSetting =  ( new \App\GeneralSetting)->getCacheGeneralSettings();
    $categories = (new \App\Category)->getCachedCategories();
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(Auth::check())
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
    @else
        <meta name="robots" content="index, follow">
    @endif
<meta name="description" content="@yield('meta_description', $seoSetting->description)" />
<meta name="keywords" content="@yield('meta_keywords', $seoSetting->keyword)">
<meta name="author" content="{{ $seoSetting->author }}">
<meta name="sitemap_link" content="{{ $seoSetting->sitemap_link }}">

@yield('meta')

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('/site.webmanifest') }}">
<meta name="msapplication-config" href="{{ asset('/browserconfig.xml') }}">
<link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">

<meta name="msapplication-TileColor" content="#2b5797">
<meta name="theme-color" content="#ffffff">

<title>@yield('meta_title', config('app.name', 'Laravel'))</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">

<!-- Icons -->
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.min.css') }}" type="text/css">

<link type="text/css" href="{{ asset('frontend/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/jodit.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/xzoom.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/jquery.share.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/intlTelInput.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel='stylesheet'>

<!-- Global style (main) -->
<link type="text/css" href="{{ asset('frontend/css/active-shop.css') }}" rel="stylesheet" media="screen">

<!--Spectrum Stylesheet [ REQUIRED ]-->
<link href="{{ asset('css/spectrum.css')}}" rel="stylesheet">

<link type="text/css" href="{{ asset('frontend/css/main.css') }}?v=1.8" rel="stylesheet">

{{--@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)--}}
     {{--<!-- RTL -->--}}
    {{--<link type="text/css" href="{{ asset('frontend/css/active.rtl.css') }}" rel="stylesheet">--}}
{{--@endif--}}

<!-- Facebook Chat style -->
<link href="{{ asset('frontend/css/fb-style.css')}}" rel="stylesheet">

<!-- color theme -->
<link href="{{ asset('frontend/css/colors/'.$generalSetting->frontend_color.'.css')}}?v=1.1" rel="stylesheet">

<!-- jQuery -->
<script src="{{ asset('frontend/js/vendor/jquery.min.js') }}"></script>

    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>


<!-- MAIN WRAPPER -->
<div class="body-wrap shop-default shop-cards shop-tech gry-bg">

    <!-- Header -->
    @include('frontend.inc.nav')

    @yield('content')

    @include('frontend.inc.footer', compact('generalSetting'))

    @include('frontend.partials.modal')

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    @include('frontend.inc.footer-nav', compact('categories'))

</div><!-- END: body-wrap -->

<!-- SCRIPTS -->
<a href="#" class="back-to-top btn-back-to-top"></a>

<!-- Core -->
<script src="{{ asset('frontend/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bootstrap.min.js') }}"></script>

<!-- Plugins: Sorted A-Z -->
<script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>


<script src="{{ asset('frontend/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>

<script src="{{ asset('frontend/js/jquery.share.js') }}"></script>


<script src="{{ asset('frontend/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('frontend/js/jodit.min.js') }}"></script>
<script src="{{ asset('frontend/js/xzoom.min.js') }}"></script>
{{--<script src="{{ asset('frontend/js/fb-script.js') }}"></script>--}}
<script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>
<script src="{{ asset('frontend/js/intlTelInput.min.js') }}"></script>

<!-- App JS -->
<script src="{{ asset('frontend/js/active-shop.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}?v=1.4"></script>

<script>
    @if(config('app.env') == 'development' || config('app.env') == 'beta') {
        console.log('env')
        if('once' in localStorage){
        } else {
            hardRefresh()
        }
        function hardRefresh(){
            console.log('force refresh')
            localStorage.setItem('once', true),
            location.reload(true);
        }
    }
    @endif
    function addToCartNew(e, element, listing){
        e.stopPropagation();
        var productId = $(element).data('content');
        console.log($('#quantity_'+listing+'_'+productId).val());
        $.ajax({
            type:"POST",
            url: '{{ route('cart.addToCart') }}',
            data: {
                _token : '{{ @csrf_token() }}',
                type: 'product-card-button',
                id: productId,
                quantity: $('#quantity_'+listing+'_'+productId).val()
            },
            success: function(data){
               // console.log(data);
                updateNavCart();
                showFrontendAlert('success', data['name'] +" added to your cart", data);
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }
    function showFrontendAlert(type, message, data){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 2000
        });

    }
    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('{{ route('category.elements') }}', {_token: '{{ csrf_token()}}', id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                        location.reload();
                    });
                });
            });
        }
        if ($('#currency-change').length > 0) {
            $('#currency-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var currency_code = $this.data('currency');
                    $.post('{{ route('currency.change') }}',{_token:'{{ csrf_token() }}', currency_code:currency_code}, function(data){
                        location.reload();
                    });
                });
            });
        }
    });
    // $('#search').on('keyup', function(){
    //     search();
    // });
    // $('#search').on('focus', function(){
    //     search();
    // });
    // function search(){
    //     var search = $('#search').val();
    //     if(search.length > 0){
    //         $('body').addClass("typed-search-box-shown");
    //         $('.typed-search-box').removeClass('d-none');
    //         $('.search-preloader').removeClass('d-none');
    //         $.post('{{ route('search.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
    //             if(data == '0'){
    //                 // $('.typed-search-box').addClass('d-none');
    //                 $('#search-content').html(null);
    //                 $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
    //                 $('.search-preloader').addClass('d-none');
    //             }
    //             else{
    //                 console.log({data})
    //                 $('.typed-search-box .search-nothing').addClass('d-none').html(null);
    //                 $('#search-content').html(data);
    //                 $('.search-preloader').addClass('d-none');
    //             }
    //         }).fail(function(xhr, status, error) {
    //                 console.log({
    //                     xhr,status,error
    //                 })
    //       });;
    //     }
    //     else {
    //         $('.typed-search-box').addClass('d-none');
    //         $('body').removeClass("typed-search-box-shown");
    //     }
    // }
    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data['desktop']);
            $('.mobile-cart-wrap').html(data['mobile']);
        });
    }
    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            location.reload();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }
    function removeFromCartMobile(key) {
        removeFromCart(key);
        closeMobileCart();
    }
    function addToCompare(id){
        $.post('{{ route('compare.addToCompare') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#compare').html(data);
            showFrontendAlert('success', 'Item has been added to compare list');
            $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
        });
    }
    function addToWishList(id){
        @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
            $.post('{{ route('wishlists.store') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                if(data != 0){
                    $('#wishlist').html(data);
                    showFrontendAlert('success', 'Item has been added to wishlist');
                }
                else{
                    showFrontendAlert('warning', 'Please login first');
                }
            });
        @else
            showFrontendAlert('warning', 'Please login first');
        @endif
    }
    function showAddToCartModal(e, id, uniqueName = null){
        console.log("QWEQWEQWEQ")
        e.stopPropagation();
        var qty = 1;

        if(uniqueName){
            var qty = $(`input[name='${uniqueName}']`).val();
        }

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id, qty:qty}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }
    $('#option-choice-form input[type="radio"]').on('change', function(){
        getVariantPrice();
        $("#option-choice-form button[data-type='plus']").attr('disabled', false)
        $("#option-choice-form button[data-type='minus']").attr('disabled', true)
    });
    $('#option-choice-form input[name="quantity"]').on('change', function(){
        getVariantPrice();
    });
    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '{{ route('products.variant_price') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                   $('#option-choice-form #chosen_price_div #chosen_price').removeClass('c-white');
                   $('#base_price').html(data.base_price);
                   $('#discounted_price').html(data.discounted_price);
                   $('#available-quantity').html(data.quantity);
                   $('.input-number').prop('max', data.quantity ? data.quantity  :1 );
                   if($('.input-number').val() >= data.quantity ){
                       $('.input-number').val(data.quantity ? data.quantity  :1)
                   }
                   //console.log(data.quantity);
                   if(parseInt(data.quantity) <= 0){
                       $('#btn_atc').addClass('d-none');
                       $('#btn_bn').addClass('d-none');
                       $('#btn_oos').removeClass('d-none');
                   }
                   else{
                        $('#btn_atc').removeClass('d-none');
                        $('#btn_bn').removeClass('d-none');
                        $('#btn_oos').addClass('d-none');
                   }
               }
           });
        }else{
           // console.log('no action:');
        }
    }
    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });
       // console.log('count:',count);
       // console.log(' option choic:',$('#option-choice-form input:radio:checked').length);
        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }
        return false;
    }
    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }
    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   //$('#addToCart-modal-body').html(null);
                   //$('.c-preloader').hide();
                   //$('#modal-size').removeClass('modal-lg');
                   //$('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }
    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }
    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }
    function cartQuantityInitialize(btn = '.btn-number', input = '.input-number'){
        $(btn).click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    $("button[data-type='plus']").attr('disabled', false)
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        if(btn == '.btn-number'){
                            $(this).attr('disabled', true);
                        }
                    }
                } else if (type == 'plus') {
                    $("button[data-type='minus']").attr('disabled', false)
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        if(btn == '.btn-number'){
                            $(this).attr('disabled', true);
                        }
                    }
                }
            } else {
                input.val(0);
            }
        });
        $(input).focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
        $(input).change(function() {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                // $(`${btn}[data-type='minus'][data-field="${name}"]`).removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                // $(`${btn}[data-type='plus'][data-field="${name}"]`).removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }
    function paymentModal(){
       // if(confirm('You are about to process this order. Click Ok to continue.')){
            $('#payment-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
            return true
//        }
//        return false;
        }
     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();
             $input.on('change', function(e) {
                 var fileName = '';
                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();
                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });
             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }
     var placeholder = '{{ asset('frontend/images/placeholder.jpg') }}';
     var productImgs = [];
     function lazyLoad(listing){
        document.querySelectorAll(`.product-img-${listing}`).forEach( function(image, index) {
            var imgMark = `product-img-${listing}-${index}`
            if(productImgs.indexOf(imgMark) !== -1){
                // console.log('nandito na')
                // console.log(productImgs)
            } else {
                if((image.getBoundingClientRect().bottom - 300) <= window.innerHeight){
                    productImgs.push(imgMark);
                    var productImg = new Image();
                    productImg.src = image.childNodes[1].childNodes[1].dataset.src;
                    productImg.onload = function(){
                        image.classList.remove('product-img-loading');
                        image.childNodes[1].childNodes[1].src = image.childNodes[1].childNodes[1].dataset.src;
                    }
                    productImg.onerror = function(){
                        image.classList.remove('product-img-loading');
                        image.childNodes[1].childNodes[1].src = placeholder
                    }
                }
            }
        })
    }
    @foreach (session('flash_notification', collect())->toArray() as $message)
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
</script>

@yield('script')

</body>
</html>
<!--
<?php
