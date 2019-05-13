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
use App\Http\Controllers\Model\API_check; // Kelurahan

// LOCATION
use App\Http\Controllers\Model\Master_provinces; // Profinsi
use App\Http\Controllers\Model\Master_regencies; // Kota / Kabupaten 
use App\Http\Controllers\Model\Master_districts; // Kecamatan 
use App\Http\Controllers\Model\Master_villages; // Kelurahan


use App\Http\Controllers\Model\Master_usergroup; // Kelurahan
use Carbon;
use DateTime;
use Auth;
use GuzzleHttp\Client; 
// use GuzzleHttp\Psr7;
// use Psr\Http\Message\ServerRequestInterface;

use DB;
use Session;
use Mail;
use Cart;

use vendor\autoload;

class CartController extends Controller
{ 
    public function test_email($id_order, $email,$name,$grand_total){
    	$transaction = Transaction::getTrans()->where('id_order','=',$id_order)->first();
        $detail = Detail::getDetail()->where('id_order','=',$id_order);
        $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();

        $to_name = $name;
        $to_email = $email;
        $data = array('name'=>$to_name, "body" => "Total pembayaran anda = Rp. ".$grand_total."", 'detail'=>$detail, 'transaction'=>$transaction);
            
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Receipt from fibercreme onlinestore');
            $message->from('no-reply@azha.co.id','Fibercreme Onlinestore');
        });
    }


    public function show(){
    	$product = Master_product::getProd();
    	return view('pages/cart/cart',  compact('product'));
    }


    public function noreload(){
        return view('pages/cart/noreload');
    } 

     public function checkout(){
        $product = Master_product::all();
        $provinces = Master_provinces::all();
        if (Cart::content() == '[]'){
            Session::flash('failed_msg', 'Anda belum membuat pesanan apa pun');
            return redirect('/cart');
        }else{
            return view('pages/checkout/checkout',  compact('product','provinces'));
        }
    } 

    public function payment($id){
        $transaction = Transaction::getTrans()->where('id_order','=',$id)->first();
        $detail = Detail::getDetail()->where('id_order','=',$id);
        $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();

        return view('pages/payment/payment', compact('transaction','detail','customer'));
    }

    public function payment_send($id){
        $transaction = Transaction::getTrans()->where('id_order','=',$id)->first();
        $detail = Detail::getDetail()->where('id_order','=',$id);
        $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();

        return view('pages/payment/payment_send', compact('transaction','detail','customer'));
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
        if (Cart::content() == '[]'){
            Session::flash('failed_msg', 'Anda belum membuat pesanan apa pun');
            return redirect('/cart');
        }else{
            $validatedData = $request->validate([
                'fullname' => 'required',
                'address' => 'required',
                'g-recaptcha-response'=>'required',
                'province' => 'required',
                'regency' => 'required',
                'district' => 'required',
                'village' => 'required',
                'zipcode' => 'required',
                'phone_number' => 'required',
                'gender' => 'required',
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
            $ongkir = 9000;
            $order = new Transaction;

                $order->id_order = $id_order;
                $order->ongkir = $ongkir;
                $order->id_customer = $biodata->id;
                $order->total = (Cart::subtotal(null,null,''));
                // Select Coupon
                $coupon = Master_coupon::where('coupon_code','=',strtoupper($request->coupon_code))->where('is_active','=',1)->first();

                    // Cek coupon
                    if ($coupon) {
                        // insert row
                        $order->id_coupon = $coupon->id;

                        // disable coupon
                        $coupon->is_active = 2;
                        $coupon->save();

                        // cek nominal or persentase
                        if ($coupon->type == 'nominal') {
                            $grand_total = (Cart::subtotal(null,null,'') - $coupon->nominal)+$ongkir;
                            if ( $grand_total <= 0) {
                                $grand_total = 0;
                            }
                            $order->grand_total = $grand_total;
                            $order->discount = $coupon->nominal;
                            $order->discount_type = $coupon->type;
                        }elseif ($coupon->type == 'percentage') {
                            $grand_total = (Cart::subtotal(null,null,'') - ((Cart::subtotal(null,null,'') * $coupon->nominal)/100))+$ongkir;
                            if ( $grand_total <= 0) {
                                $grand_total = 0;
                            }
                            $order->grand_total = $grand_total;
                            $order->discount = $coupon->nominal;
                            $order->discount_type = $coupon->type;
                        }

                    } else{
                        // coupon not available
                        $order->id_coupon = null;
                        $grand_total = Cart::subtotal(null,null,'')+$ongkir;
                            if ( $grand_total <= 0) {
                                $grand_total = 0;
                            }
                        $order->grand_total = $grand_total;

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

            // Kirim Next Payment

            // Get Token =======================================================
                $API_check = API_check::all()->first();

                if ( ($API_check->expires+$API_check->expires_in) < strtotime(date('D-m-y H:i:s')) ) {

                    $data = [

                    'client_id'  => '4ebf488472154b3896dd2801b5141bbf',
                    'client_secret' => '0d5c41b9495545c8a1e7b9f3dd8e9b51',
                    'grant_type' => 'client_credentials'

                    ];


                    $client = new Client(['base_uri' => 'https://api.ninjasaas.com/','http_errors' => false]);
                    $headers = [
                        'Content-Type'  => 'application/json',      
                        'Accept'        => 'application/json',
                    ];
                    $response = $client->request('POST', 'demo/2.0/oauth/access_token',  [
                                'headers' => $headers,
                                'body'   => json_encode($data)
                    
                     ]);


                    $status =  $response->getStatusCode(); 

                    if($status == 200)
                    {
                        $buffer =  $response->getBody()->getContents();   
                        $token = json_decode($buffer);
                        $access_token = $token->access_token;
                        $expires = $token->expires;
                        $token_type = $token->token_type;
                        $expires_in = $token->expires_in;
                        $new_token = 0 ;
                    }else {
                        Session::flash('failed_api', 'Error Create Token API');
                        return redirect('/checkout');
                    } 
                  
                }else{
                    $access_token = $API_check->access_token;
                    $expires = $API_check->expires;
                    $token_type = $API_check->token_type;
                    $expires_in = $API_check->expires_in;
                    $new_token = 1 ;
                }

            // End Get Token =================================================================

            // Create Order =================================================================

                $transaction = Transaction::getTrans()->where('id_order','=',$id_order)->first();
                $detail = Detail::getDetail()->where('id_order','=',$id_order);
                $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();

                $weight = 0;
                foreach($detail as $det){
                    $weight = $weight+($det->weight * $det->qty);
                }
                $weight = $weight / 1000;

                $tanggal = explode(" ", $transaction->created_at);
                $tanggal[0]; // tanggal
                $tanggal[1]; // jam 


                $datenow = new DateTime();
                $sekarang = $datenow->format('Y-m-d H:i:s'); 
                $datenow->modify('+1 day');
                $besok = $datenow->format('Y-m-d H:i:s');
                $datenow->modify('+3 day');
                $tigahari = $datenow->format('Y-m-d H:i:s');

                $besok = explode(" ", $besok);
                $besok[0]; // tanggal

                $tigahari = explode(" ", $tigahari);
                $tigahari[0]; // tanggal

                if ($new_token != 1) {
                    $now = new DateTime();
                    $API_check = API_check::all()->first();
                    $API_check->access_token = $access_token;
                    $API_check->expires = $expires;
                    $API_check->token_type = $token_type;
                    $API_check->expires_in = $expires_in;
                    $API_check->save();
                }

                $data = [

                    'service_type'  => 'Parcel',
                    'service_level' => 'Standard',
                    'requested_tracking_number' => $id_order,
                    'reference' => array(

                        'merchant_order_number' => $id_order

                    ),
                    'from' => array(

                        'name' => 'Fibercreme', 
		                'phone_number' => '+62818758820',
		                'email' => 'pathfindersline@gmail.com',
		                'address' => array(

		                    'address1' => 'Ninja Xpress Semper - Solution Warehouse', 
		                    'address2' => 'Jl. Sungai Brantas No.6, RT.13/RW.1',
		                    'kelurahan' => 'Semper Barat',
		                    'kecamatan' => 'Cilincing',
		                    'city' => 'Kota Jakarta Utara',
		                    'province' => 'Daerah Khusus Ibukota Jakarta',
		                    'country' => 'ID',
		                    'postcode' => '14130'

                        )
                    ),
                    'to' => array(

                        'name' => $customer->fullname, 
                        'phone_number' => $customer->phone_number,
                        'email' => $customer->email,
                        'address' => array(

                            'address1' => $customer->address, 
                            'address2' => $customer->address,
                            'kelurahan' => $customer->village,
                            'kecamatan' => $customer->district,
                            'city' => $customer->regency,
                            'province' => $customer->province,
                            'country' => 'ID',
                            'postcode' => $customer->zipcode

                        )
                    ),
                    'parcel_job' => array(

                        'is_pickup_required' => false, 
                        'pickup_service_type' => 'Scheduled',
                        'pickup_service_level' => 'Premium',
                        'pickup_date' => $besok[0].'T00:00:00.000Z',
                        'pickup_timeslot' => array(

                            'start_time' => '09:00', 
                            'end_time' => '12:00',
                            'timezone' => 'Asia/Jakarta'

                        ),
                        'dimensions' => array(

                            'weight' => $weight

                        ),
                        'pickup_instruction' => '',
                        'delivery_instruction' => '',
                        'delivery_start_date' => $tigahari[0],
                        'delivery_timeslot' => array(

                            'start_time' => '09:00', 
                            'end_time' => '22:00',
                            'timezone' => 'Asia/Jakarta'

                        )
                    )];
                    
                    
                        $client = new Client(['base_uri' => 'https://api.ninjasaas.com/','http_errors' => false]);
                        $headers = [
                            'Content-Type'  => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token,        
                            'Accept'        => 'application/json',
                        ];
                        $response = $client->request('POST', 'demo/4.0/orders',  [
                                'headers' => $headers,
                                'body'   => json_encode($data)                    
                        ]);
                    


                $status =  $response->getStatusCode(); 
                 if($status == 200)
                {
                    $buffer =  $response->getBody()->getContents();    

                    Cart::destroy();
                    $this->test_email($id_order, $request->email,$request->fullname,$grand_total); 
                    return redirect(url('payment/'.$id_order));
                }else
                {

                    Session::flash('failed_api', 'Error Create Order API');
                    return redirect('/checkout');
                }
            

            // End Create Order =================================================================
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
                'options' => ['sku' => $select_product->sku]
            ],
        ]);

        $noreload = array(
            'contet' => $contet, 
            'total' => Cart::subtotal(0,'','.'), 
            'count' => Cart::count(), 
            'subtotal' => number_format(($qty*$select_product->product_price),0,'','.'), 
            'sku'=> $select_product->sku
        );
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
                        $ambil[] = number_format(($discount),0,'','.'); // Total

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

        $noreload = array('sukses' => 'sukses', 'total' => Cart::subtotal(0,'','.'), 'subtotal' => $subtotal);
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

        $noreload = array(
            'sukses' => 'sukses', 
            'count' => Cart::count(), 
            'total' => Cart::subtotal(0,'','.')
        );

        return $noreload;
    } 

    public function address_input(){
    	$address = Transaction::getTrans();
    	return view('pages/address/address_input',  compact('address'));
    } 


    // public function send_email(){
    // 	$transaction = Transaction::getTrans()->where('id_order','=','FCNX1552508840')->first();
    //     $detail = Detail::getDetail()->where('id_order','=','FCNX1552508840');
    //     $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();

    //     $to_name = 'Lutfi';
    //     $to_email = 'Lutfi.febrianto@gmail.com';
    //     $grand_total = '1000';
    //     $data = array('name'=>$to_name, "body" => "Total pembayaran anda = Rp. ".$grand_total."", 'detail'=>$detail, 'transaction'=>$transaction);
            
    //     Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
    //         $message->to($to_email, $to_name)
    //                 ->subject('TEST Email');
    //         $message->from('no-reply@azha.co.id','Ninja Title Email');
    //     });
    // }
 

    // public function create_order(Request $request){
    //     $check_api = $request->still_active; // 1 = active, 0 udah lewat is_cover

    //     $id_order = $request->id_order;

    //     $transaction = Transaction::getTrans()->where('id_order','=',$id_order)->first();
    //     $detail = Detail::getDetail()->where('id_order','=',$id_order);
    //     $customer = Master_customer::all()->where('id','=',$transaction->id_customer)->first();


    //     $access_token = $request->access_token;
    //     $expires = $request->expires;
    //     $token_type = $request->token_type;
    //     $expires_in = $request->expires_in;

    //     $tanggal = explode(" ", $transaction->created_at);
    //     $tanggal[0]; // tanggal
    //     $tanggal[1]; // jam 

    //     if ($check_api != 1) {
    //         $now = new DateTime();
    //         $API_check = API_check::all()->first();
    //         $API_check->access_token = $access_token;
    //         $API_check->expires = $expires;
    //         $API_check->token_type = $token_type;
    //         $API_check->expires_in = $expires_in;
    //         $API_check->save();
    //     }

    //     $data = [

    //         'service_type'  => 'Parcel',
    //         'service_level' => 'Standard',
    //         'requested_tracking_number' => $id_order,
    //         'reference' => array(

    //             'merchant_order_number' => $id_order

    //         ),
    //         'from' => array(

    //             'name' => 'Fibercreme', 
    //             'phone_number' => '+62818758820',
    //             'email' => 'pathfindersline@gmail.com',
    //             'address' => array(

    //                 'address1' => 'Ninja Xpress Semper - Solution Warehouse', 
    //                 'address2' => 'Jl. Sungai Brantas No.6, RT.13/RW.1',
    //                 'kelurahan' => 'Semper Barat',
    //                 'kecamatan' => 'Cilincing',
    //                 'city' => 'Kota Jakarta Utara',
    //                 'province' => 'Daerah Khusus Ibukota Jakarta',
    //                 'country' => 'ID',
    //                 'postcode' => '14130'

    //             )
    //         ),
    //         'to' => array(

    //             'name' => $customer->fullname, 
    //             'phone_number' => $customer->phone_number,
    //             'email' => $customer->email,
    //             'address' => array(

    //                 'address1' => $customer->address, 
    //                 'address2' => $customer->address,
    //                 'kelurahan' => $customer->village,
    //                 'kecamatan' => $customer->district,
    //                 'city' => $customer->regency,
    //                 'province' => $customer->province,
    //                 'country' => 'ID',
    //                 'postcode' => $customer->zipcode

    //             )
    //         ),
    //         'parcel_job' => array(

    //             'is_pickup_required' => false, 
    //             'pickup_service_type' => 'Scheduled',
    //             'pickup_service_level' => 'Premium',
    //             'pickup_date' => '2019-03-25T00:00:00.000Z',
    //             'pickup_timeslot' => array(

    //                 'start_time' => '09:00', 
    //                 'end_time' => '12:00',
    //                 'timezone' => 'Asia/Jakarta'

    //             ),
    //             'dimensions' => array(

    //                 'weight' => '1'

    //             ),
    //             'pickup_instruction' => '',
    //             'delivery_instruction' => '',
    //             'delivery_start_date' => '2019-03-27',
    //             'delivery_timeslot' => array(

    //                 'start_time' => '09:00', 
    //                 'end_time' => '22:00',
    //                 'timezone' => 'Asia/Jakarta'

    //             )
    //         )];

    //     $client = new Client(['base_uri' => 'https://api.ninjasaas.com/']);
    //     $headers = [
    //         'Content-Type'  => 'application/json',
    //         'Authorization' => 'Bearer ' . $access_token,        
    //         'Accept'        => 'application/json',
    //     ];
    //     $response = $client->request('POST', 'demo/4.0/orders',  [
    //                 'headers' => $headers,
    //                 'body'   => json_encode($data)
        
    //      ]);
    //     $status =  $response->getStatusCode(); 

    //     if($status == 200)
    //     {
    //         $buffer =  $response->getBody()->getContents();     
    //         return $buffer;
    //     }else {
    //         return 'error_api';
    //     } 

               
    // }

    // public function get_token(Request $request){
    //     $id = $request->id_order;
    //     $API_check = API_check::all()->first();

    //     if ( ($API_check->expires+$API_check->expires_in) > strtotime(date('D-m-y H:i:s')) ) {

    //         $data = [

    //         'client_id'  => '4ebf488472154b3896dd2801b5141bbf',
    //         'client_secret' => '0d5c41b9495545c8a1e7b9f3dd8e9b51',
    //         'grant_type' => 'client_credentials'

    //         ];

    //         $client = new Client(['base_uri' => 'https://api.ninjasaas.com/']);
    //         $headers = [
    //             'Content-Type'  => 'application/json',      
    //             'Accept'        => 'application/json',
    //         ];
    //         $response = $client->request('POST', 'demo/2.0/oauth/access_token',  [
    //                     'headers' => $headers,
    //                     'body'   => json_encode($data)
            
    //          ]);
    //         $status =  $response->getStatusCode(); 
    //         $response =  $response->getBody()->getContents();   
    //         $token = json_decode($response);

    //         $access_token = $token->access_token;
    //         $expires = $token->expires;
    //         $token_type = $token->token_type;
    //         $expires_in = $token->expires_in;
    //         $new_token = 0 ;


    //     }else{
    //         $access_token = $API_check->access_token;
    //         $expires = $API_check->expires;
    //         $token_type = $API_check->token_type;
    //         $expires_in = $API_check->expires_in;
    //         $new_token = 1 ;
    //     }

    //     $data = array();
    //     $data = array('0' => $response,'1' => $new_token,'2' => $access_token,'3' => $expires,'4' => $token_type,'5' => $expires_in,'6' => $id);

    //     return Response::json($data);
    // }
}

