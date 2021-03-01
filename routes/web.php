<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('/verifiedemail', '\App\Http\Controllers\Auth\LoginController@verified');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');

Route::get('/social-login/redirect/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');
Route::get('/users/login', 'FrontEndAuthController@login')->name('user.login');
Route::get('/users/registration', 'FrontEndAuthController@registration')->name('user.registration');
//Route::post('/users/login', 'HomeController@user_login')->name('user.login.submit');
Route::post('/users/login/cart', 'HomeController@cart_login')->name('cart.login.submit');

Route::post('/subcategories/get_subcategories_by_category', 'SubCategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');
Route::post('/subsubcategories/get_brands_by_subsubcategory', 'SubSubCategoryController@get_brands_by_subsubcategory')->name('subsubcategories.get_brands_by_subsubcategory');
Route::post('/subsubcategories/get_attributes_by_subsubcategory', 'SubSubCategoryController@get_attributes_by_subsubcategory')->name('subsubcategories.get_attributes_by_subsubcategory');

//Home Page
Route::get('/', 'HomeController@index')->name('home');
Route::post('/home/section/flash_deals', 'HomeController@loadFlashDealsSection')->name('home.section.flash_deals');
Route::post('/home/section/categories', 'HomeController@loadHomeCategoriesSection')->name('home.section.home_categories');
Route::post('/home/section/collections', 'HomeController@loadHomeCollectionsSection')->name('home.section.home_collections');
Route::post('/home/section/campaigns', 'HomeController@loadHomeCampaignSection')->name('home.section.home_campaign');
Route::post('/home/section/featured', 'HomeController@loadFeaturedProductsSection')->name('home.section.featured');
Route::post('/home/section/banner1', 'HomeController@loadBanner1Section')->name('home.section.banner1');
Route::post('/home/section/banner2', 'HomeController@loadBanner2Section')->name('home.section.banner2');
Route::post('/home/section/best_selling', 'HomeController@loadBestSellingSection')->name('home.section.best_selling');
Route::post('/home/section/best_brands', 'HomeController@loadBestBrandsSection')->name('home.section.brands');
//category dropdown menu ajax call
Route::post('/category/nav-element-list', 'HomeController@get_category_items')->name('category.elements');

//Flash Deal Details Page
Route::get('/flash-deal/{slug}', 'FrontEndFlashDealController@index')->name('home.flash_deal_listing');

//frontend product listings
Route::get('/category/{slug}', 'FrontEndCategoryController@index')->name('home.category_product_list');
Route::get('/best-sellers', 'FrontEndBestSellersController@index')->name('home.best_sller_product_list');
Route::get('/featured-products', 'FrontEndFeaturedProductsController@index')->name('home.featured_products_product_list');
Route::get('/top-brands', 'FrontEndBestBrandsController@index')->name('home.top_brands_product_list');



######  Collection #######

Route::get('/collection/{slug}', 'FrontEndCollectionController@index')->name('product.collection');
Route::get('/collection/{slug}/sortBy', 'FrontEndCollectionController@index')->name('product.collection-sortby');
Route::get('/collection/{slug}?search={search}', 'FrontEndCollectionController@index')->name('product.collection-search');
Route::get('/collection/{slug}/{category?}', 'FrontEndCollectionController@index')->name('product.collection-category');
Route::get('/collection/{slug}/sortBy/{category?}', 'FrontEndCollectionController@index')->name('product.collection-category-sortby');

###### Collection End #######


###### Categories ######

Route::get('/category/{slug}', 'FrontEndCategoryController@index')->name('product.category');
Route::get('/category/{slug}/sortBy', 'FrontEndCategoryController@index')->name('product.category-sortby');
Route::get('/category/{slug}?search={search}', 'FrontEndCategoryController@index')->name('product.category-search');
Route::get('/categorey/{slug}/{category?}', 'FrontEndCategoryController@index')->name('product.category-category');
Route::get('/category/{slug}/sortBy/{category?}', 'FrontEndCategoryController@index')->name('product.category-category-sortby');

###### Categories End ######



###### Product Page Start ######

Route::get('/product/{slug}', 'FrontEndProductController@index')->name('product');
Route::post('/product/variant_price', 'FrontEndProductController@variant_price')->name('products.variant_price');
Route::post('/product', 'FrontEndProductController@product_post')->name('product_post');
Route::post('/product/show-cart-modal', 'FrontEndProductController@showCartModal')->name('cart.showCartModal');
Route::get('/products', 'FrontEndProductController@listing')->name('products');

###### Product Page End ######



###### Contact Us Start ######

Route::get('/contact-us', 'ContactUsController@index')->name('contactus.view');
Route::post('/contact-us/sendmail', 'ContactUsController@sendmail')->name('contactus.sendmail');
Route::get('/contact-us/refresh_captcha', 'ContactUsController@refreshCaptcha')->name('contactus.refreshcaptcha');

###### Contach Us End ######




Route::get('/sitemap.xml', function(){
	return base_path('sitemap.xml');
});



//page 

Route::get('/pages/{title}', 'PagesController@viewpage')->name('pages.view');

//blog
Route::get('/blogs/news', 'BlogController@home')->name('blogs.home');
Route::get('/blogs/pressrelease', 'BlogController@press_release')->name('blogs.press_release');
Route::get('/blogs/{slug}', 'BlogController@blog')->name('blogs.find');
Route::post('blog/upload_html_pic','BlogController@upload_html_pic')->name('blog.upload_html_pic');



Route::get('/search?category={category_slug}', 'HomeController@search')->name('products.category');
Route::get('/search?subcategory={subcategory_slug}', 'HomeController@search')->name('products.subcategory');
Route::get('/search?subsubcategory={subsubcategory_slug}', 'HomeController@search')->name('products.subsubcategory');
Route::get('/search?brand={brand_slug}', 'HomeController@search')->name('products.brand');


Route::get('/shops/visit/{slug}', 'FrontEndShopsController@shop')->name('shop.visit');
Route::get('/shops/visit/{slug}/{type}', 'FrontEndShopsController@filter_shop')->name('shop.visit.type');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/nav-cart-items', 'CartController@updateNavCart')->name('cart.nav_cart');
Route::post('/cart/proceedToCheckout', 'CartController@proceedToCheckout')->name('cart.proceedToCheckout');
Route::post('/cart/addtocart', 'CartController@addToCart')->name('cart.addToCart');
Route::post('/cart/removeFromCart', 'CartController@removeFromCart')->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', 'CartController@updateQuantity')->name('cart.updateQuantity');

//campaign product listing
Route::get('/campaign/{slug}', 'FrontEndCampaignController@index')->name('products.campaign');
Route::get('/campaign/{slug}/sortBy', 'FrontEndCampaignController@index')->name('products.campaign-sortby');
Route::get('/campaign/{slug}/{category}', 'FrontEndCampaignController@categoryCampaignProducts')->name('products.campaign-category');
Route::get('/campaign/{slug}/sortBy/{category}', 'FrontEndCampaignController@categoryCampaignProducts')->name('products.campaign-category-sortby');
Route::get('/campaign/{slug}?search={search}', 'FrontEndCampaignController@index')->name('products.campaign-search');

//best sellers
Route::get('/best-sellers', 'FrontEndBestSellersController@index')->name('best_seller.product-list');
Route::get('/best-sellers?search={search}', 'FrontEndBestSellersController@index')->name('best_seller.list-search');
Route::get('/best-sellers/sortBy', 'FrontEndBestSellersController@index')->name('best_seller.list-sortby');
Route::get('/best-sellers/{category}', 'FrontEndBestSellersController@categoryProducts')->name('best_seller.list-category');
Route::get('/best-sellers/sortBy/{category}', 'FrontEndBestSellersController@categoryProducts')->name('best_seller.list-category-sortby');

//featured
Route::get('/featured-products', 'FrontEndFeaturedProductsController@index')->name('featured_products.product-list');
Route::get('/featured-products?search={search}', 'FrontEndFeaturedProductsController@index')->name('featured_products.list-search');
Route::get('/featured-products/sortBy', 'FrontEndFeaturedProductsController@index')->name('featured_products.list-sortby');
Route::get('/featured-products/{category}', 'FrontEndFeaturedProductsController@categoryProducts')->name('featured_products.list-category');
Route::get('/featured-products/sortBy/{category}', 'FrontEndFeaturedProductsController@categoryProducts')->name('featured_products.list-category-sortby');

//topbrands
Route::get('/top-brands/{slug}', 'FrontEndTopBrandProductsController@index')->name('top_brands.product-list');
Route::get('/top-brands/{slug}?search={search}', 'FrontEndTopBrandProductsController@index')->name('top_brands.list-search');
Route::get('/top-brands/sortBy', 'FrontEndTopBrandProductsController@index')->name('top_brands.list-sortby');
Route::get('/top-brands/{slug}/{category}', 'FrontEndTopBrandProductsController@categoryProducts')->name('top_brands.list-category');
Route::get('/top-brands/{slug}/sortBy/{category}', 'FrontEndTopBrandProductsController@categoryProducts')->name('top_brands.list-category-sortby');


//Checkout Routes
Route::group(['middleware' => ['checkout']], function(){
	Route::get('/checkout', 'CheckoutController@get_shipping_info')->name('checkout.shipping_info');
	Route::post('/checkout/shipping_info', 'CheckoutController@store_shipping_info')->name('checkout.store_shipping_info');
	Route::get('/checkout/payment_select', 'CheckoutController@get_payment_info')->name('checkout.payment_select');
    Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
    Route::get('/payment/done/{id}', 'CheckoutController@paymentDone')->name('payment.done');
    Route::get('/checkout/payment/error', 'CheckoutController@paymentError')->name('checkout.payment_error');


    Route::post('/checkout/apply_coupon_code', 'CheckoutController@apply_coupon_code')->name('checkout.apply_coupon_code');
    Route::post('/checkout/remove_coupon_code', 'CheckoutController@remove_coupon_code')->name('checkout.remove_coupon_code');

    Route::get('/checkout/order_confirm_page/{id}', 'CheckoutController@order_confirm_page')->name('checkout.order_confirm_page');


    //eGHL
    Route::match(array('GET', 'POST'),'/eghl/payment/cancelled/{payment_id}', 'EghlController@cancelledPayment')->name('eghl.cancelled');
    Route::match(array('GET', 'POST'),'/eghl/payment/approved/{payment_id}', 'EghlController@confirmedPayment')->name('eghl.approved');
    Route::match(array('GET', 'POST'),'/eghl/payment/declined/{payment_id}', 'EghlController@declinedPayment')->name('eghl.declined');
    Route::get('/eghl/payment/done', 'EghlController@getDone')->name('eghl.done');
    Route::get('/eghl/process', 'EghlController@processPayment')->name('eghl.process');


});




Route::post('/get_pick_ip_points', 'HomeController@get_pick_ip_points')->name('shipping_info.get_pick_ip_points');

//Paypal CALLBACK
Route::get('/paypal/payment/done/{payment_reference}', 'PaypalController@confirmPayment')->name('payment.done');
Route::get('/paypal/confirm', 'PaypalController@confirmPayment')->name('payment.confirm-payment');
//Paypal END


Route::get('/compare', 'CompareController@index')->name('compare');
Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');

Route::resource('subscribers','SubscriberController');

Route::get('/brands', 'HomeController@all_brands')->name('brands.all');
Route::get('/categories', 'HomeController@all_categories')->name('categories.all');
Route::get('/search', 'HomeController@homeSearch')->name('search');
Route::get('/search?q={search}', 'HomeController@search')->name('suggestion.search');
Route::post('/ajax-search', 'HomeController@ajax_search')->name('search.ajax');
Route::post('/config_content', 'HomeController@product_content')->name('configs.update_status');

Route::get('/sellerpolicy', 'HomeController@sellerpolicy')->name('sellerpolicy');
Route::get('/returnpolicy', 'HomeController@returnpolicy')->name('returnpolicy');
Route::get('/supportpolicy', 'HomeController@supportpolicy')->name('supportpolicy');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/privacypolicy', 'HomeController@privacypolicy')->name('privacypolicy');

Route::group(['middleware' => ['user', 'verified']], function(){
	Route::get('/dashboard', 'FrontEndAuthController@dashboard')->name('dashboard');
	Route::get('/profile', 'FrontEndAuthController@profile')->name('profile');
	Route::get('/delete-address/{id}', 'FrontEndAuthController@delete_address')->name('address.destroy');
	Route::get('/add-address', 'FrontEndAuthController@add_address')->name('addAddress');
	Route::get('/delete-address/{id}', 'FrontEndAuthController@delete_address')->name('address.destroy');
	Route::get('/edit-address/{id}', 'FrontEndAuthController@edit_address')->name('address.edit');
	Route::patch('/edit-address/', 'HomeController@edit_address_update')->name('address.edit.update');
	Route::post('/customer/update-profile', 'FrontEndAuthController@customer_update_profile')->name('customer.profile.update');
	Route::post('/seller/update-profile', 'FrontEndAuthController@seller_update_profile')->name('seller.profile.update');

	Route::resource('purchase_history','PurchaseHistoryController');
	Route::post('/purchase_history/details', 'PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');
	Route::get('/purchase_history/destroy/{id}', 'PurchaseHistoryController@destroy')->name('purchase_history.destroy');

	Route::resource('wishlists','WishlistController');
	Route::post('/wishlists/remove', 'WishlistController@remove')->name('wishlists.remove');

	Route::get('/wallet', 'WalletController@index')->name('wallet.index');
	Route::post('/recharge', 'WalletController@recharge')->name('wallet.recharge');

	Route::resource('support_ticket','SupportTicketController');
	Route::post('support_ticket/reply','SupportTicketController@seller_store')->name('support_ticket.seller_store');

	Route::post('/add-address', 'FrontEndAuthController@create_new_address')->name('add.new.address');

});

Route::group(['prefix' =>'seller', 'middleware' => ['seller', 'verified']], function(){
	Route::get('/products', 'HomeController@seller_product_list')->name('seller.products');
	Route::get('/product/upload', 'HomeController@show_product_upload_form')->name('seller.products.upload');
	Route::get('/product/{id}/edit', 'HomeController@show_product_edit_form')->name('seller.products.edit');
	Route::resource('payments','PaymentController');

	Route::get('/shop/apply_for_verification', 'ShopController@verify_form')->name('shop.verify');
	Route::post('/shop/apply_for_verification', 'ShopController@verify_form_store')->name('shop.verify.store');

	Route::get('/reviews', 'ReviewController@seller_reviews')->name('reviews.seller');
});

Route::group(['middleware' => ['auth']], function(){
	Route::post('/products/store/','ProductController@store')->name('products.store');
	Route::post('/products/update/{id}','ProductController@update')->name('products.update');
	Route::get('/products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
	Route::get('/products/duplicate/{id}', 'ProductController@duplicate')->name('products.duplicate');
	Route::post('/products/generateSKUFromName', 'ProductController@generateSKUFromName')->name('products.generateSKUFromName');
	Route::post('/products/sku_combination', 'ProductController@sku_combination')->name('products.sku_combination');
	Route::post('/products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('products.sku_combination_edit');
	Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
	Route::post('/products/published', 'ProductController@updatePublished')->name('products.published');

	Route::get('invoice/customer/{order_id}', 'InvoiceController@customer_invoice_download')->name('customer.invoice.download');
	Route::get('invoice/seller/{order_id}', 'InvoiceController@seller_invoice_download')->name('seller.invoice.download');
	
	Route::resource('orders','OrderController');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
	Route::post('/orders/details', 'OrderController@order_details')->name('orders.details');
	Route::post('/orders/update_delivery_status', 'OrderController@update_delivery_status')->name('orders.update_delivery_status');
	Route::post('/orders/update_payment_status', 'OrderController@update_payment_status')->name('orders.update_payment_status');

	Route::resource('/reviews', 'ReviewController');

	Route::resource('/withdraw_requests', 'SellerWithdrawRequestController');
	Route::get('/withdraw_requests_all', 'SellerWithdrawRequestController@request_index')->name('withdraw_requests_all');
	Route::post('/withdraw_request/payment_modal', 'SellerWithdrawRequestController@payment_modal')->name('withdraw_request.payment_modal');
	Route::post('/withdraw_request/message_modal', 'SellerWithdrawRequestController@message_modal')->name('withdraw_request.message_modal');

	Route::resource('conversations','ConversationController');
	Route::post('conversations/refresh','ConversationController@refresh')->name('conversations.refresh');
	Route::resource('messages','MessageController');

	//Product Bulk Upload	
	Route::get('/product-bulk-upload/index', 'ProductBulkUploadController@index')->name('product_bulk_upload.index');
	Route::post('/bulk-product-upload', 'ProductBulkUploadController@bulk_upload')->name('bulk_product_upload');
	Route::get('/product-csv-download/{type}', 'ProductBulkUploadController@import_product')->name('product_csv.download');
	Route::get('/vendor-product-csv-download/{id}', 'ProductBulkUploadController@import_vendor_product')->name('import_vendor_product.download');

	
	Route::group(['prefix' =>'bulk-upload/download'], function(){
		Route::get('/category', 'ProductBulkUploadController@pdf_download_category')->name('pdf.download_category');
		Route::get('/sub_category', 'ProductBulkUploadController@pdf_download_sub_category')->name('pdf.download_sub_category');
		Route::get('/sub_sub_category', 'ProductBulkUploadController@pdf_download_sub_sub_category')->name('pdf.download_sub_sub_category');
		Route::get('/brand', 'ProductBulkUploadController@pdf_download_brand')->name('pdf.download_brand');
		Route::get('/seller', 'ProductBulkUploadController@pdf_download_seller')->name('pdf.download_seller');
	});
	
	//Product Export
	Route::get('/product-bulk-export', 'ProductBulkUploadController@export')->name('product_bulk_export.index');

	###### PRODUCT BULK UPDATE ROUTES START ######

		Route::get('/product-bulk-update/index', 'ProductBulkUploadController@bulk_update_page')->name('product_bulk_update.index');
	    Route::get('/product-bulk-update-export', 'ProductBulkUploadController@bulk_update_export')->name('product_bulk_update_export');
	    Route::post('/product-bulk-update-import', 'ProductBulkUploadController@bulk_update_import')->name('product_bulk_update_import');

	###### PRODUCT BULK UPDATE ROUTES START ######

});

Route::resource('shops', 'ShopController');
Route::get('/track_your_order', 'OrderController@trackOrder')->name('orders.track');
Route::get('/instamojo/payment/pay-success', 'InstamojoController@success')->name('instamojo.success');
Route::post('rozer/payment/pay-success', 'RazorpayController@payment')->name('payment.rozer');
Route::get('/paystack/payment/callback', 'PaystackController@handleGatewayCallback');


Route::get('/vogue-pay', 'VoguePayController@showForm');
Route::get('/vogue-pay/success/{id}', 'VoguePayController@paymentSuccess');
Route::get('/vogue-pay/failure/{id}', 'VoguePayController@paymentFailure');


Route::post('/address/get_province', 'AddressController@showProvince')->name('address.get_province');
Route::post('/address/get_city', 'AddressController@showCityMun')->name('address.get_city');
Route::post('/address/get_baranggay', 'AddressController@showBaranggay')->name('address.get_baranggay');

//abandoned cart
Route::get('/abandoned-cart', 'SessionCartController@getAbandonItems')->name('abandoned.cart');
//loadmore
Route::post('product_listing/loadmore','HomeController@loadmore')->name('loadmore');