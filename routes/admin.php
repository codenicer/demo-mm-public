<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', 'FrontEndAuthController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	Route::resource('categories','CategoryController');
	Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
	Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

	Route::resource('subcategories','SubCategoryController');
	Route::get('/subcategories/destroy/{id}', 'SubCategoryController@destroy')->name('subcategories.destroy');

	Route::resource('subsubcategories','SubSubCategoryController');
	Route::get('/subsubcategories/destroy/{id}', 'SubSubCategoryController@destroy')->name('subsubcategories.destroy');

	Route::resource('brands','BrandController');
	Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

	Route::get('/products/admin','ProductController@admin_products')->name('products.admin');
	Route::get('/products/seller','ProductController@seller_products')->name('products.seller');
	Route::get('/products/create','ProductController@create')->name('products.create');
	Route::get('/products/admin/{id}/edit','ProductController@admin_product_edit')->name('products.admin.edit');
	Route::get('/products/seller/{id}/edit','ProductController@seller_product_edit')->name('products.seller.edit');
	Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
	Route::post('/products/get_products_by_subsubcategory', 'ProductController@get_products_by_subsubcategory')->name('products.get_products_by_subsubcategory');
	Route::post('/products/get_products_by_category', 'ProductController@get_products_by_category')->name('products.get_products_by_category');

	Route::resource('sellers','SellerController');
	Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
	Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
	Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
	Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
	Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
	Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
	Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');

	Route::resource('customers','CustomerController');
	Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');

	Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
	Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');

	Route::resource('profile','ProfileController');
    Route::patch('/business-settings/update_cache','BusinessSettingsController@updateCache')->name('business_settings.updateCache');
    Route::patch('/business-settings/update','BusinessSettingsController@updateItem')->name('business_settings.updateItem');
	Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
	Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
	Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
	Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
	Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
	Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
	Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
	Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
	Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
	Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
	Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
	Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
	Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');
	Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
	Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
	Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
	Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
	Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');
	Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
	Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
	Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
	Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

	Route::resource('/languages', 'LanguageController');
	Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
	Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
	Route::get('/languages/{id}/edit', 'LanguageController@edit')->name('languages.edit');
	Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
	Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

	Route::get('/frontend_settings/home', 'HomeSettingsController@index')->name('home_settings.index');
	Route::post('/frontend_settings/home/top_10', 'HomeSettingsController@top_10_settings')->name('top_10_settings.store');
	Route::get('/sellerpolicy/{type}', 'PolicyController@index')->name('sellerpolicy.index');
	Route::get('/returnpolicy/{type}', 'PolicyController@index')->name('returnpolicy.index');
	Route::get('/supportpolicy/{type}', 'PolicyController@index')->name('supportpolicy.index');
	Route::get('/terms/{type}', 'PolicyController@index')->name('terms.index');
	Route::get('/privacypolicy/{type}', 'PolicyController@index')->name('privacypolicy.index');

	//Policy Controller
	Route::post('/policies/store', 'PolicyController@store')->name('policies.store');

	Route::group(['prefix' => 'frontend_settings'], function(){
		Route::resource('sliders','SliderController');
	    Route::get('/sliders/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');

		Route::resource('home_banners','BannerController');
		Route::get('/home_banners/create/{position}', 'BannerController@create')->name('home_banners.create');
		Route::post('/home_banners/update_status', 'BannerController@update_status')->name('home_banners.update_status');
	    Route::get('/home_banners/destroy/{id}', 'BannerController@destroy')->name('home_banners.destroy');

        Route::resource('home_categories','HomeCategoryController');
        Route::get('/home_categories/destroy/{id}', 'HomeCategoryController@destroy')->name('home_categories.destroy');
        Route::post('/home_categories/update_status', 'HomeCategoryController@update_status')->name('home_categories.update_status');
        Route::post('/home_categories/priority', 'HomeCategoryController@priority')->name('home_categories.priority');

		Route::resource('home_collections','HomeCollectionController');
	    Route::get('/home_collections/destroy/{id}', 'HomeCollectionController@destroy')->name('home_collections.destroy');
		Route::post('/home_collections/update_status', 'HomeCollectionController@update_status')->name('home_collections.update_status');
        Route::post('/home_collections/priority', 'HomeCollectionController@priority')->name('home_collections.priority');
	});

	Route::resource('roles','RoleController');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs','StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');


	####### FLASH DEALS START ########

	Route::resource('flash_deals','FlashDealController');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
	Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
	Route::get('/flash_deals/product_prio/{id}', 'FlashDealController@flashdeal_product_prio')->name('flash_deals.product_prio');
	Route::post('/flash_deals/product_prio_update', 'FlashDealController@product_prio_update')->name('flash_deals.product_prio_update');
	Route::post('/flash_deals/export','FlashDealController@import')->name('flash_deals.import');
	Route::post('/flash_deals/import','FlashDealController@export')->name('flash_deals.export');

	####### FLASH DEALS EXPORT IMPORT #######



	Route::get('/default-flashdeal-product','FlashDealImportExportController@export_default_product')->name('export_default_flashdeal_product.index');
	Route::post('/import-flashdeal-product', 'FlashDealImportExportController@import_product')->name('import_flashdeal_product');
	Route::get('/export-flashdeal-product/{collection_id}', 'FlashDealImportExportController@export_product')->name('export_flashdeal_product');

	####### FLASH DEALS END #######

	

	###### PRODUCT BULK PRICE UPDATE  START ######
	Route::get('/product-price-bulk-update/', 'ProductPriceBulkUpdateController@index')->name('product_price_bulk_update.index');
	Route::get('/product-price-bulk-update/sortBy', 'ProductPriceBulkUpdateController@index')->name('product_price_bulk_update.sortBy');
	Route::get('/product-price-bulk-update/export_products', 'ProductPriceBulkUpdateController@export_products')->name('product_price_bulk_update.export_products');
	Route::post('/product-price-bulk-update/import_products', 'ProductPriceBulkUpdateController@import_update_products')->name('product_price_bulk_update.import_products');		
	// Route::get('/product-price-bulk-update/sortBy/brand_id/{brand_id?}', 'ProductPriceBulkUpdateController@index')->name('product_price_bulk_update.sortBy.brand');
	// Route::get('/product-price-bulk-update/sortBy/brand_id/{brand_id?}/category/{category_id?}', 'ProductPriceBulkUpdateController@index')->name('product_price_bulk_update.sortBy.brand.category');
	
		
		######  PRODUCT BULK PRICE UPDATE END   ######


	Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
	Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
	Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.d	estroy');
	Route::get('/sales', 'OrderController@sales')->name('sales.index');

	Route::resource('links','LinkController');
	Route::get('/links/destroy/{id}', 'LinkController@destroy')->name('links.destroy');

	Route::resource('generalsettings','GeneralSettingController');
	Route::get('/logo','GeneralSettingController@logo')->name('generalsettings.logo');
	Route::post('/logo','GeneralSettingController@storeLogo')->name('generalsettings.logo.store');
	Route::get('/color','GeneralSettingController@color')->name('generalsettings.color');
	Route::post('/color','GeneralSettingController@storeColor')->name('generalsettings.color.store');


	Route::resource('seosetting','SEOController');

	Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

	//Reports
	Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
	Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
	Route::get('/seller_report', 'ReportController@seller_report')->name('seller_report.index');
	Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
	Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');

	//Coupons
	Route::resource('coupon','CouponController');
	Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
	Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
	Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');

	//Reviews
	Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
	Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

	//Support_Ticket
	Route::get('support_ticket/','SupportTicketController@admin_index')->name('support_ticket.admin_index');
	Route::get('support_ticket/{id}/show','SupportTicketController@admin_show')->name('support_ticket.admin_show');
	Route::post('support_ticket/reply','SupportTicketController@admin_store')->name('support_ticket.admin_store');

	//Pickup_Points
	Route::resource('pick_up_points','PickupPointController');
	Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');


	Route::get('orders_by_pickup_point','OrderController@order_index')->name('pick_up_point.order_index');
	Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

	Route::get('invoice/admin/{order_id}', 'InvoiceController@admin_invoice_download')->name('admin.invoice.download');

	//conversation of seller customer
	Route::get('conversations','ConversationController@admin_index')->name('conversations.admin_index');
	Route::get('conversations/{id}/show','ConversationController@admin_show')->name('conversations.admin_show');
	Route::get('/conversations/destroy/{id}', 'ConversationController@destroy')->name('conversations.destroy');


    Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

	Route::resource('attributes','AttributeController');
	Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

	Route::get('hubs','ManageHubController@index')->name('hubs.index');
	Route::post('/hubs/store','ManageHubController@store')->name('hubs.store');
	Route::post('/hubs/edit','ManageHubController@edit')->name('hubs.edit');
	Route::post('/hubs/update','ManageHubController@update')->name('hubs.update');
	Route::post('/hubs/update_enable','ManageHubController@update_enable')->name('hubs.update_enable');
	Route::post('/hubs/update_active','ManageHubController@update_active')->name('hubs.update_active');
	Route::get('/hubs/{id}','ManageHubController@destroy')->name('hubs.destroy');

	Route::get('web_hubs','WebHubController@index')->name('web_hubs.index');
	Route::post('/web_hubs/store','WebHubController@store')->name('web_hubs.store');
	Route::post('/web_hubs/edit','WebHubController@edit')->name('web_hubs.edit');
	Route::post('/web_hubs/update','WebHubController@update')->name('web_hubs.update');
	Route::post('/web_hubs/update_enable','WebHubController@update_enable')->name('web_hubs.update_enable');
	Route::post('/web_hubs/update_active','WebHubController@update_active')->name('web_hubs.update_active');
	Route::get('/web_hubs/{id}','WebHubController@destroy')->name('web_hubs.destroy');

	Route::resource('addons','AddonController');
	Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

	Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
	Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
	Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
	Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');

	//Pages

	Route::resource('pages','PagesController');
	Route::get('/pages/create','PagesController@create')->name('pages.create');
	Route::get('/pages/edit/{id}','PagesController@edit')->name('pages.edit');
	Route::post('/pages/update','PagesController@update')->name('pages.update');
	Route::get('/pages/destroy/{id}', 'PagesController@destroy')->name('pages.destroy');
	Route::post('/pages/update_published_status', 'PagesController@update_published_status')->name('pages.update_published_status');

	//Blog

    Route::resource('blog','BlogController');
    Route::patch('blog/edit/{id}','BlogController@update')->name('blog.update');
	Route::get('blog/delete/{id}','BlogController@destroy')->name('blog.delete');
	Route::get('blog/create','BlogController@create')->name('blog.create');


	//Calendar settings

	Route::resource('calendar','CalendarController');
	Route::get('/calendar/create','CalendarController@create')->name('calendar.create');
	Route::get('/calendar/edit/{id}','CalendarController@edit')->name('calendar.edit');
	Route::post('/calendar/update','CalendarController@update')->name('calendar.update');
	Route::post('/calendar/update_status','CalendarController@update_status')->name('calendar.update_status');
	Route::post('/calendar/store','CalendarController@store')->name('calendar.store');
	Route::get('/calendar/destroy/{id}','CalendarController@destroy')->name('calendar.destroy');
	Route::post('/calendar/get-preview','CalendarController@get_calendar_preview')->name('calendar.get_preview');
	Route::post('/calendar/load-calendar','CalendarController@load_calendar')->name('calendar.load_calendar');
	//Collection
	
	// depricated routes, dont delete  for the meantime 
    // Route::post('/collections/add_addOn', 'CollectionController@edit_addOn')->name('collections.edit_addOn');
	// Route::get('/collections/addon/{id}', 'CollectionController@addon')->name('collections.addon');
	
	


	Route::resource('collections','CollectionController');
    Route::get('/collections/create', 'CollectionController@create')->name('collections.create');
    Route::get('/collections/edit_collection/{id}', 'CollectionController@edit_collection')->name('collections.edit_collection');
	Route::patch('/collections/store_collection/edit', 'CollectionController@store_collection')->name('collections.store_collection');
    Route::get('/collections/priority_product/{id}', 'CollectionController@priority_product')->name('collections.priority_product');
    Route::post('/collections/priority/product', 'CollectionController@priority')->name('collections.product_priorities');
    Route::get('/collections/destroy/{id}', 'CollectionController@destroy')->name('collections.destroy');
    Route::post('/collections/update_status', 'CollectionController@update_status')->name('collections.update_status');
    Route::post('/collections/update_collection_status', 'CollectionController@update_collection_status')->name('collections.update_collection_status');
    Route::post('/collections/product_discount', 'CollectionController@product_discount')->name('collections.product_discount');
    Route::post('/collections/product_discount_edit','CollectionController@product_discount_edit')->name('collections.product_discount_edit');

	//export import Collection

	Route::get('/default-collection-product','CollectionImportExportController@export_default_product')->name('export_default_product.index');
	Route::post('/import-collection-product', 'CollectionImportExportController@import_product')->name('import_collection_product');
	Route::get('/export-collection-product/{collection_id}', 'CollectionImportExportController@export_product')->name('export_collection_product');
	
	//Campaign

	Route::resource('campaigns','CampaignScheduleController');
	Route::get('/campaigns/products/{id}','CampaignScheduleController@products')->name('campaigns.products');
	Route::post('/campaigns/products/update','CampaignScheduleController@update')->name('campaigns.update');
	Route::post('/campaigns/update_enable','CampaignScheduleController@update_enable')->name('campaigns.update_enable');
	Route::post('/campaigns/update_active','CampaignScheduleController@update_active')->name('campaigns.update_active');
	Route::get('/campaigns/destroy/{id}', 'CampaignScheduleController@destroy')->name('campaigns.destroy');
	Route::get('/campaigns/edit/{id}', 'CampaignScheduleController@edit')->name('campaigns.edit');
	Route::put('/campaigns/update_campaign/{id}', 'CampaignScheduleController@update_campaign')->name('campaigns.update_campaign');
	Route::get('/campaigns/priority_product/{id}', 'CampaignScheduleController@priority_product')->name('campaigns.priority_product');
	Route::post('/campaigns/priority/product', 'CampaignScheduleController@priority')->name('campaigns.product_priorities');


	
});
