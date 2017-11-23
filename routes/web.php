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


Auth::routes();

// ################ index ####################### //

Route::get('/', 'MasterController@index');

// ###################### register ##################### //

Route::post('/register','RegistrationController@registerData');

//#################33 about us ################# //

Route::get('about-us','MasterController@about_us');

// ################### Tabletop here  ################### //

Route::get('tabletop','MasterController@tabletop');
Route::get('details/{slug?}','MasterController@details');
Route::post('add-to-cart','MasterController@add_to_Cart');
Route::delete('tabletop/removefromcart','MasterController@removeCart');
Route::post('shop/updatecart','MasterController@updateCart');


Route::get('tabletop/{slug?}','MasterController@tabletop_details');

Route::post('filter','MasterController@tabletopFilter');
//Route::get('add-to-cart/category/{cat}/cartid/{cart}','MasterController@addToCart');
Route::post('select-theme','MasterController@selectTheme');

// ####################### apparels #################### //

Route::get('apparels','MasterController@apparels');
Route::get('apparel/{slug?}','MasterController@apparel_details');

Route::post('apparel/add-to-cart','MasterController@apparel_add_to_cart');
Route::get('apparel/category/{slug?}','MasterController@apparel_category');
// ######################### gift #################### //

Route::get('gift','MasterController@gift');

// ##################### our brands #################### //

Route::get('our-brands','MasterController@brands');

// ######################### contact us #################### //

Route::get('contact-us','MasterController@contact_us');
Route::post('contact-us','MasterController@contactReply');


// ###################v login page ##################### //

Route::post('login/home','LoginController@loginHome');
Route::get('users/login','LoginController@userLogin');
Route::get('user/logout','LoginController@signOut');
Route::post('user/account','LoginController@saveProfile');
Route::post('save/password','LoginController@savePassword');

// ######################### console #################### //

Route::get('console','MasterController@console');
Route::get('console/{slug?}','MasterController@console_details'); //
Route::post('console/add-to-cart','MasterController@console_add_to_cart');
Route::get('console/category/{slug?}','MasterController@console_category');

// ########################### cart page ########################### //

Route::get('cart','MasterController@cart');
Route::post('cart/checkout','MasterController@checkout');

// ------------------------ calendar ----------------------------- //

Route::get('calendar','MasterController@calendar');




// ################################ newsletter ######################### //

Route::post('newsletter/subscribe','SubscribeController@Subscribe');



// 888888888888888888888888888888888888888888888888888888888888888888888888888888  //
//############################### ADMIN PANEL STARTS  ########################### //
// 888888888888888888888888888888888888888888888888888888888888888888888888888888 //

Route::group([
	'prefix' => 'admin',
	'middleware' => 'auth'], function () {

		Route::get('/', 'HomeController@index');
		//Route::get('/login','HomeController@index');
// ###################### brands ##################### //

		Route::get('brands','BrandController@index');
		Route::post('brand/upload-image','BrandController@upload_image');
		
		Route::post('brands','BrandController@store');
		Route::delete('brands/delete-image','BrandController@deleteImage');
		Route::get('manage/brands','BrandController@manageBrand');
		Route::get('brand/edit/{id}','BrandController@editBrand');
		Route::put('brands/{id}','BrandController@updateBrands');
		Route::delete('brand/{id}','BrandController@deleteBrands');


// ############################# shop category ########################## //

		Route::get('tabletop/category','ShopCategoryController@index');
		Route::post('tabletop/category','ShopCategoryController@category');
		Route::get('manage/category','ShopCategoryController@manage');
		Route::get('tabletop/category/edit/{id}','ShopCategoryController@edit');
		Route::put('tabletop/category/edit/{id}','ShopCategoryController@update');
		Route::delete('tabletop/category/{id}','ShopCategoryController@deletes');

		Route::get('shop','ShopController@index');
		Route::post('shop/upload-image','ShopController@upload');
		Route::post('shop','ShopController@store');
		Route::get('manage/tabletop','ShopController@manageShop');
		Route::get('shops/edit/{id}','ShopController@edit');
		Route::put('shop/{id}','ShopController@update');
		Route::delete('shops/{id}','ShopController@deletes');
		Route::delete('shop/delete','ShopController@deleteImage');


// ############################### apparels ################################ //

	Route::get('apparels/add-category' ,'ApparelCategoryController@index');		
	Route::post('apparels/add-category' ,'ApparelCategoryController@category');
	Route::get('apparels/catgeory','ApparelCategoryController@manage');
	Route::get('apparels/category/edit/{id}','ApparelCategoryController@edit');
	Route::put('apparels/category/edit/{id}','ApparelCategoryController@update');
	Route::delete('apparels/category/{id}','ApparelCategoryController@deletes');	


	Route::get('apparels','ApparelController@index');
	Route::post('apparels/upload-image','ApparelController@upload');
	Route::post('apparels','ApparelController@store');
	Route::get('apparels/manage','ApparelController@manage');
	Route::get('apparels/edit/{id}','ApparelController@edit');
	Route::put('apparels/{id}','ApparelController@update');
	Route::delete('apparels/{id}','ApparelController@deletes');
	Route::delete('apparel/delete','ApparelController@deleteImage');


 // ############################ console ################################## //


	Route::get('console/add-category','ConsoleCategoryController@index');
	Route::post('console/add-category','ConsoleCategoryController@category');
	Route::get('console/category','ConsoleCategoryController@manage');
	Route::get('category/edit/{id}','ConsoleCategoryController@edit');
	Route::put('category/edit/{id}','ConsoleCategoryController@update');
	Route::delete('category/{id}','ConsoleCategoryController@deletes');

	Route::get('console','ConsoleController@index');
	Route::post('console/upload-image','ConsoleController@upload');
	Route::post('console','ConsoleController@store');
	Route::get('console/manage','ConsoleController@manage');
	Route::get('console/edit/{id}','ConsoleController@Console_edit');
	Route::put('console/edit/{id}','ConsoleController@update');
	Route::delete('console/{id}','ConsoleController@deletes');
	Route::delete('consoles/delete','ConsoleController@deleteImage');

	// ########################################## gifts ##################//

	//
	Route::get('gift/add-category','GiftcategoryController@index');
	Route::post('gift/add-category','GiftcategoryController@add');
	Route::get('gift/category','GiftcategoryController@manage');
	Route::get('gift/category/edit/{id}','GiftcategoryController@edit');
	Route::put('category/edit/{id}','GiftcategoryController@update');
	Route::delete('gift/category/{id}','GiftcategoryController@delete');

	Route::get('gift','GiftController@index');
	//
	Route::post('gift/upload-image','GiftController@upload_image');
	Route::post('gift','GiftController@store');
	Route::get('gift/manage','GiftController@manage');
	Route::get('gift/edit/{id}','GiftController@edit');
	Route::put('gift/edit/{id}','GiftController@update');
	Route::delete('gift/{id}','GiftController@delete');
	
	//Route::post('gift','GiftController@add');



	// events 

	Route::get('event/add-event','EventController@index');
	Route::post('event/add-event','EventController@addEvent');
	Route::get('event/manage','EventController@manage');
	Route::get('event/edit/{id}','EventController@edit');
	Route::put('event/edit-event/{id}','EventController@update');
	Route::delete('event/{id}','EventController@deletes');


	// calendar 

	// Route::get('calendar','CalendarController@index');
	// Route::post('store-event','CalendarController@store');
	// Route::get('get-event-lists','CalendarController@getEventLists');
	Route::get('calendar','CalendarController@index');
	Route::post('event/add', 'CalendarController@save');
	Route::post('event/delete', 'CalendarController@delete');


	// subscribed users

	Route::get('subscribed-email','SubscribeController@index');
	Route::delete('list/{id}','SubscribeController@deletes');

	// newsletters

	Route::get('users/newsletter','NewsletterController@index');
	Route::post('users/newsletter','NewsletterController@sendNewsletter');
	
	});


// Route::get('test','TestController@test');

