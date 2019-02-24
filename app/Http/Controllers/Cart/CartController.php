<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Model\Transaction;

use App\Http\Controllers\Model\Master_product;
use App\Http\Controllers\Model\Master_customer;
use App\Http\Controllers\Model\Master_coupon;
use App\Http\Controllers\Model\Detail;

use DateTime;
use Auth;
use DB;
use Session;
use Cart;

class CartController extends Controller
{ 
    public function show(){
    	$product = Master_product::all();
    	return view('pages/cart/cart',  compact('product'));
    } 

    public function check_coupon(Request $request){
        $coupon = Master_coupon::where('coupon_code','=',strtoupper($request->coupon_code))
                ->first();

        if ($coupon) {
            if ($coupon->type == 'nominal') {
                $discount = $coupon->nominal;
                Session::flash('success_msg', $coupon->coupon_name);
                Session::flash('discount', $discount);
                return Redirect::back();
            }elseif ($coupon->type == 'percentage') {
                $discount = (Cart::subtotal(null,null,'') * $coupon->nominal)/100;
                Session::flash('success_msg', $coupon->coupon_name);
                Session::flash('discount', $discount);
                return Redirect::back();
            }
                
            
        } else{
            Session::flash('failed_msg', "Coupon Tidak Ditemukan");
            return Redirect::back(); 
        }

        return view('pages/cart/cart',  compact('product'));
    } 

    public function insert_order(Request $request){
        $validatedData = $request->validate([
                'fullname' => 'required',
                'address' => 'required',
                'g-recaptcha-response'=>'required',
        ]);


            $date_str=strtotime(date('D-m-y H:i:s'));
            $id_order = $date_str;
            $now = new DateTime();
            $waktu = $now->format('Y-m-d H:i:s');



            $select_last_id = Master_customer::all()->last();
            if ($select_last_id ) {
                $last_id = $select_last_id->id_cus + 1;
            }else{
                $last_id = 1;
            }

            
            // table biodata
            $biodata = new Master_customer;

                $biodata->id_cus = $last_id;
                $biodata->fullname = $request->fullname;
                $biodata->email = $request->email;
                $biodata->phone_number = $request->phone_number;
                $biodata->gender = $request->gender;
                $biodata->address = $request->address;
                $biodata->country = $request->country;
                $biodata->city = $request->city;
                $biodata->zipcode = $request->zipcode;
                $biodata->is_active = 1;
                $biodata->created_by = "Admin Default";

            $biodata->save();

            // table transaction
            $order = new Transaction;

                $order->id_order = $id_order;
                $order->id_customer = $last_id;
                $order->total = (Cart::subtotal(null,null,''));
                // Select Coupon
                $coupon = Master_coupon::where('coupon_code','=',strtoupper($request->coupon_code))
                    ->first();
                    // Cek coupon
                    if ($coupon) {
                        // insert row
                        $order->id_coupon = $coupon->id;

                        // cek nominal or persentase
                        if ($coupon->type == 'nominal') {
                            $order->grand_total = (Cart::subtotal(null,null,'') - $coupon->nominal)+9000;
                            $order->discount = $coupon->nominal;
                            $order->discount_type = $coupon->type;
                        }elseif ($coupon->type == 'percentage') {
                            $order->grand_total = (Cart::subtotal(null,null,'') - ((Cart::subtotal(null,null,'') * $coupon->nominal)/100))+9000;
                            $order->discount = $coupon->nominal;
                            $order->discount_type = $coupon->type;
                        }

                    } else{
                        // coupon not available
                        $order->id_coupon = null;
                        $order->grand_total = Cart::subtotal(null,null,'');
                        $order->discount_type = null;
                    }
                
                
                $order->date_order = $now;
                $order->is_active = 1;
                $order->created_by = "Admin Default";

            $order->save();

            $cartdetail =  array();

            foreach(Cart::content() as $cart){
                $cartdetail[] = array(
                    'id_order' => $id_order,
                    'id_product'=>$cart->id,
                    'price'=>$cart->price,
                    'qty'=>$cart->qty
                );
            }
                Detail::insert($cartdetail);

            Session::flash('success_msg', "Transaksi Berhasil");
            Cart::destroy();
            return  redirect('/cart');

    }

     public function checkout(){
        $product = Master_product::all();
        return view('pages/checkout/checkout',  compact('product'));
    } 

    public function buy(Request $request){
    	$id_product = $request->id_product;
    	$qty = $request->qty;
    	$select_product = Master_product::where('id','=',$id_product)->first();
    	$product = Master_product::all();
    	Cart::add([
            [
                'id' => $id_product, 
                'name' => $select_product->product_name, 
                'qty' => $qty,
                'price' => $select_product->product_price,
            ],
        ]);
    	return Redirect::back();
    } 



    public function changeqty(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId,$qty);
        return Redirect::back();
    } 

    public function destroy(){
    	$product = Master_product::all();
    	Cart::destroy();
    	return Redirect::back();
    } 

    public function deletecart($id){
        $rowId = $id;
        Cart::remove($rowId);
        return Redirect::back();
    } 

    public function address_input(){
    	$address = Transaction::getTrans();
    	return view('pages/address/address_input',  compact('address'));
    } 
}

