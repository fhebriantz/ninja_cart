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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'LoginController@show');
Route::get('login', 'LoginController@show'); 
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::get('/logout', 'LogoutController@index');


Route::get('/home', 'ImagesController@showcms')->name('home');

// ----------------------------------------------------------------------------------CMS:COUPON
// =====ROUTE:SHOW=====
// Show list of Coupon
Route::get('coupon', 'CouponController@list'); 
// Show form create of Coupon
Route::get('coupon/create', 'CouponController@create');
// Show form edit of Coupon
Route::get('coupon/{id}/edit','CouponController@edit');  
// Show form view of Coupon
Route::get('coupon/{id}/view','CouponController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('coupon/create','CouponController@insert'); 
// Call function to update
Route::put('coupon/{id}/edit','CouponController@update');  
// Call function to delete
Route::delete('coupon/{id}/delete','CouponController@delete');
// Call function to view
Route::get('coupon/{id}/view','CouponController@view'); 


// ----------------------------------------------------------------------------------CMS:PRODUCT
// =====ROUTE:SHOW=====
// Show list of Product
Route::get('product', 'ProductController@list'); 
// Show form create of Product
Route::get('product/create', 'ProductController@create');
// Show form edit of Product
Route::get('product/{id}/edit','ProductController@edit');  
// Show form view of Product
Route::get('product/{id}/view','ProductController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('product/create','ProductController@insert'); 
// Call function to update
Route::put('product/{id}/edit','ProductController@update');  
// Call function to delete
Route::delete('product/{id}/delete','ProductController@delete');
// Call function to view
Route::get('product/{id}/view','ProductController@view'); 


// ----------------------------------------------------------------------------------CMS:SHIPMENT
// =====ROUTE:SHOW=====
// Show list of Shipment
Route::get('shipment', 'ShipmentController@list'); 
// Show form create of Shipment
Route::get('shipment/create', 'ShipmentController@create');
// Show form edit of Shipment
Route::get('shipment/{id}/edit','ShipmentController@edit');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('shipment/create','ShipmentController@insert'); 
// Call function to update
Route::put('shipment/{id}/edit','ShipmentController@update'); 
// Call function to delete
Route::delete('shipment/{id}/delete','ShipmentController@delete');  


// ----------------------------------------------------------------------------------CMS:PROVINCES
// =====ROUTE:SHOW=====
// Show list of Provinces
Route::get('province', 'ProvinceController@list'); 
// Show form create of Provinces
Route::get('province/create', 'ProvinceController@create');
// Show form edit of Provinces
Route::get('province/{id}/edit','ProvinceController@edit');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('province/create','ProvinceController@insert'); 
// Call function to update
Route::put('province/{id}/edit','ProvinceController@update');  
// Call function to delete
Route::delete('province/{id}/delete','ProvinceController@delete');


// ----------------------------------------------------------------------------------CMS:REGENCIES
// =====ROUTE:SHOW=====
// Show list of Regencies
Route::get('regency', 'RegencyController@list'); 
// Show form create of Regencies
Route::get('regency/create', 'RegencyController@create');
// Show form edit of Regencies
Route::get('regency/{id}/edit','RegencyController@edit');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('regency/create','RegencyController@insert'); 
// Call function to update
Route::put('regency/{id}/edit','RegencyController@update');  
// Call function to delete
Route::delete('regency/{id}/delete','RegencyController@delete');


// ----------------------------------------------------------------------------------CMS:DISTRICTS
// =====ROUTE:SHOW=====
// Show list of Districts
Route::get('district', 'DistrictController@list'); 
// Show form create of Districts
Route::get('district/create', 'DistrictController@create');
// Show form edit of Districts
Route::get('district/{id}/edit','DistrictController@edit');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('district/create','DistrictController@insert'); 
// Call function to update
Route::put('district/{id}/edit','DistrictController@update');  
// Call function to delete
Route::delete('district/{id}/delete','DistrictController@delete');
// Call json
Route::get('district/json','DistrictController@json');


// ----------------------------------------------------------------------------------CMS:VILLAGES
// =====ROUTE:SHOW=====
// Show list of Villages
Route::get('village', 'VillageController@list'); 
// Show form create of Villages
Route::get('village/create', 'VillageController@create');
// Show form edit of Villages
Route::get('village/{id}/edit','VillageController@edit');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('village/create','VillageController@insert'); 
// Call function to update
Route::put('village/{id}/edit','VillageController@update');  
// Call function to delete
Route::delete('village/{id}/delete','VillageController@delete');
// Call json
Route::get('village/json','VillageController@json');
Route::get('village/list_ajax','VillageController@list_ajax');
Route::get('village/init_list_ajax','VillageController@init_list_ajax');


// ----------------------------------------------------------------------------------CMS:CUSTOMER
// =====ROUTE:SHOW=====
// Show list of Customer
Route::get('customer', 'CustomerController@list'); 
// Show form view of Customer
Route::get('customer/{id}/view','CustomerController@view');  

// =====ROUTE:FUNCTION=====
// Call function to view
Route::get('customer/{id}/view','CustomerController@view'); 


// ----------------------------------------------------------------------------------CMS:TRANSACTION
// =====ROUTE:SHOW=====
// Show list of Transaction
Route::get('transaction', 'TransactionController@list'); 
// Show form view of Transaction
Route::get('transaction/{id}/view','TransactionController@view');  

// =====ROUTE:FUNCTION=====
// Call function to view
Route::get('transaction/{id}/view','TransactionController@view'); 

Route::get('transaction/send-email','TransactionController@test_email'); 


// ----------------------------------------------------------------------------------CMS:CHANGE PASSWORD
// =====ROUTE:SHOW=====
// Show list of User
Route::get('user/password', 'UserController@password'); 

// =====ROUTE:FUNCTION=====
// Call function to update
Route::put('user/password/{id}/edit','UserController@update_password'); 


// ----------------------------------------------------------------------------------CMS:REPORT
// Show and call function to search
Route::get('report','ReportController@list')->name('searchReport');