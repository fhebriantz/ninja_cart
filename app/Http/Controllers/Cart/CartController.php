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

