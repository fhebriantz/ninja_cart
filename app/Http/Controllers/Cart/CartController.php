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


use App\Http\Controllers\Model\Master_usergroup; // Kelurahan

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

    public function noreload(){
        return view('pages/cart/noreload');
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

    public function noreloads(Request $request){

        $usergroup = new Master_usergroup;

        $usergroup->usergroup = $request->usergroup;
        $usergroup->is_active = 1;
        $usergroup->created_by = "Admin Default";

        $usergroup->save();
        return 'berhasil';


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
            
            // table biodata
            $biodata = new Master_customer;

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
                $order->id_customer = $biodata->id;
                $order->total = (Cart::subtotal(null,null,''));
                // Select Coupon
                $coupon = Master_coupon::where('coupon_code','=',strtoupper($request->coupon_code))
                    ->first();

                    // Cek coupon
                    if ($coupon) {
                        // insert row
                        $order->id_coupon = $coupon->id;

                        // disable coupon
                        $coupon->is_active = 0;
                        $coupon->save();

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
        $provinces = Master_provinces::all();
        if (Cart::content() == '[]'){
            Session::flash('failed_msg', 'Anda belum membeli apapun');
            return Redirect::back();  
        }else{
            return view('pages/checkout/checkout',  compact('product','provinces','regencies','districts','villages'));
        }
    } 

    public function buy(Request $request){
    	$id_product = $request->id_product;
    	$qty = $request->qty;
    	$select_product = Master_product::where('id','=',$id_product)->first();
    	$product = Master_product::all();
    	$contet = Cart::add([
            [
                'id' => $id_product, 
                'name' => $select_product->product_name, 
                'qty' => $qty,
                'price' => $select_product->product_price,
            ],
        ]);

        $noreload = array('contet' => $contet, 'total' => Cart::subtotal());
    	return $noreload;

    } 

    // Ajax Regency village_ajax
    public function check(Request $id){

                $check_coupon = Master_coupon::where('coupon_code','=',strtoupper($id->coupon_code))
                ->where('is_active','=',1)
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



    public function changeqty(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        $price = $request->price;
        $subtotal = $qty * $price;
        Cart::update($rowId,$qty);

        $noreload = array('sukses' => 'sukses', 'total' => Cart::subtotal(), 'subtotal' => $subtotal);
        return $noreload;
    } 

    public function destroy(){
    	$product = Master_product::all();
    	Cart::destroy();
    	return Redirect::back();
    } 

    public function deletecart(Request $request){
        $rowId = $request->id;
        Cart::remove($rowId);

        $noreload = array('sukses' => 'sukses', 'total' => Cart::subtotal());

        return $noreload;
    } 

    public function address_input(){
    	$address = Transaction::getTrans();
    	return view('pages/address/address_input',  compact('address'));
    } 
}

