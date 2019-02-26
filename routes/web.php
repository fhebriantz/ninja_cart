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

Route::get('/check', 'Cart\CartController@check');

// Homeshowaddress
Route::get('/cart', 'Cart\CartController@show');
Route::get('/checkout', 'Cart\CartController@checkout');
Route::get('/cart', 'Cart\CartController@show');
Route::post('/buy', 'Cart\CartController@buy');
Route::post('/changeqty', 'Cart\CartController@changeqty');
Route::get('/destroy', 'Cart\CartController@destroy');
Route::get('/deletecart/{id}', 'Cart\CartController@deletecart');
Route::get('/', 'Cart\CartController@show');

// ajax location
Route::get('ajax-province', 'Cart\CartController@province_ajax');
Route::get('ajax-regency', 'Cart\CartController@regency_ajax');
Route::get('ajax-district', 'Cart\CartController@district_ajax');

// Bayar
Route::get('/address', 'Cart\CartController@address_input');

Route::post('/insert_order', 'Cart\CartController@insert_order');

Route::post('/check_coupon', 'Cart\CartController@check_coupon');