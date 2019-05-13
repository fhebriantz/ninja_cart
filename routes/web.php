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

Route::get('/coba_email','Cart\CartController@coba_email'); 
Route::get('/test_email','Cart\CartController@send_email'); 

Route::get('/check', 'Cart\CartController@check');
Route::get('/total_pembayaran', 'Cart\CartController@total_pembayaran');
Route::get('/noreload', 'Cart\CartController@noreload');
Route::get('/payment/{id}', 'Cart\CartController@payment');
Route::get('/payment_send/{id}', 'Cart\CartController@payment_send');
// Route::get('/payment', function () {
//     return redirect('/cart');
// });
Route::post('/noreloads', 'Cart\CartController@noreloads');


Route::get('/get_token', 'Cart\CartController@get_token');
Route::get('/create_order', 'Cart\CartController@create_order');

// Homeshowaddress noreload post_payment /payment/
Route::get('/cart', 'Cart\CartController@show');
Route::get('/checkout', 'Cart\CartController@checkout');
Route::get('/cart', 'Cart\CartController@show');
Route::get('/buy', 'Cart\CartController@buy');
Route::get('/changeqty', 'Cart\CartController@changeqty');
Route::get('/destroy', 'Cart\CartController@destroy');
Route::get('/deletecart', 'Cart\CartController@deletecart');
Route::get('/', 'Cart\CartController@show');

// ajax location
Route::get('ajax-province', 'Cart\CartController@province_ajax');
Route::get('ajax-regency', 'Cart\CartController@regency_ajax');
Route::get('ajax-district', 'Cart\CartController@district_ajax');

Route::get('ajax-ongkir', 'Cart\CartController@ongkir_ajax');

// Bayar
Route::get('/address', 'Cart\CartController@address_input');

Route::post('/insert_order', 'Cart\CartController@insert_order');

Route::post('/check_coupon', 'Cart\CartController@check_coupon');