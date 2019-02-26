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

use Response;
use Illuminate\Support\Facades\Input;

// LOCATION
use App\Http\Controllers\Model\Master_provinces; // Profinsi
use App\Http\Controllers\Model\Master_regencies; // Kota / Kabupaten
use App\Http\Controllers\Model\Master_districts; // Kecamatan 
use App\Http\Controllers\Model\Master_villages; // Kelurahan

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

    public function province_ajax(){ 

        $province_id = Input::get('province_id');
        $regency = Master_regencies::where('province_id','=',$province_id)->get();
        return Response::json($regency);
    }

    public function regency_ajax(){ 

        $regency_id = Input::get('regency_id');
        $district = Master_districts::where('regency_id','=',$regency_id)->get();
        return Response::json($district);
    }

    public function district_ajax(){ 

        $district_id = Input::get('district_id');
        $village = Master_villages::where('district_id','=',$district_id)->get();
        return Response::json($village);
    }

    // Ajax Regency village_ajax
    public function check(Request $id){

                $check_coupon = Master_coupon::where('coupon_code','=',strtoupper($id->coupon_code))
                ->first();

                    try {
                        $coupon_name=$check_coupon->coupon_name;
                        $type=$check_coupon->type;
                        $nominal=$check_coupon->nominal;
                        $total=Cart::subtotal(null,null,'');

                        if ($type == 'nominal') {
                            $discount = $nominal;
                        }elseif ($type == 'percentage') {
                            $discount = (Cart::subtotal(null,null,'') * $nominal)/100;
                        }

                        // array
                        $ambil = array();
                        $ambil[] = $coupon_name; //Nama Coupon
                        $ambil[] = $type; // Tipe
                        $ambil[] = $nominal; // Nominal
                        $ambil[] = $total; // Total
                        $ambil[] = $discount; // Total

                        return $ambil;
                    } catch (Exception $e) {
                        echo "Couldn't find id: " . $e -> getMessage() . "\n";
                    }
                
                
                
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
                'province' => 'required',
                'regency' => 'required',
                'district' => 'required',
                'village' => 'required',
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
                $biodata->province = $request->province;
                $biodata->district = $request->district;
                $biodata->village = $request->village;
                $biodata->regency = $request->regency;
                $biodata->country = "Indonesia";
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


            // disable coupon
                $coupon->is_active = 0;
            $coupon->save();

            Session::flash('success_msg', "Transaksi Berhasil");
            Cart::destroy();
            return  redirect('/cart');

    }

     public function checkout(){
        $product = Master_product::all();
        $provinces = Master_provinces::all();
        $regencies = Master_regencies::all();
        $districts = Master_districts::all();
        $villages = Master_villages::all();
        return view('pages/checkout/checkout',  compact('product','provinces','regencies','districts','villages'));
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

