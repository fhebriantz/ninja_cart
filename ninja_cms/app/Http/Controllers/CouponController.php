<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Coupon;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_coupon = Coupon::GetAllData();
        $no = 1;

    	return view('pages/cms/coupon/index', compact('data_coupon','no'));
    }

    function create()
    {
        return view('pages/cms/coupon/create');
    }

    function edit($id)
    {
        $coupon=Coupon::where('id','=',$id)->first();
        return view('pages/cms/coupon/edit')
        ->with('data_coupon',$coupon);
    }

    function view($id)
    {
        $coupon=Coupon::where('id','=',$id)->first();

        return view('pages/cms/coupon/view')
        ->with('data_coupon',$coupon);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
                                                'coupon_code' => 'required|unique:nj_ms_coupon',
                                                'coupon_name' => 'required',
                                                'quota' => 'required|numeric',
                                                'nominal' => 'required|numeric',
                                                'status' => 'required',
                                            ]);

    	$tb_coupon = new Coupon;
        $tb_coupon->coupon_code = $request->coupon_code; 
		$tb_coupon->coupon_name = $request->coupon_name; 
		$tb_coupon->description = $request->description;
        $tb_coupon->quota = $request->quota;
        $tb_coupon->nominal = $request->nominal;
        $tb_coupon->type = 'nominal';
        $tb_coupon->start_date = $request->start_date;
        $tb_coupon->end_date = $request->end_date;
        $tb_coupon->is_active = $request->status;
        $tb_coupon->created_by = session()->get('session_name'); 
    	$tb_coupon->save();

        $request->session()->flash('alert-success', 'New coupon has been added successfully!');

    	return redirect('coupon');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'coupon_code' => 'required',
                                                'coupon_name' => 'required',
                                                'quota' => 'required|numeric',
                                                'nominal' => 'required|numeric',
                                                'status' => 'required',
                                            ]);
        
    	$tb_coupon = Coupon::find($id);
        $tb_coupon->coupon_code = $request->coupon_code; 
        $tb_coupon->coupon_name = $request->coupon_name; 
        $tb_coupon->description = $request->description;
        $tb_coupon->quota = $request->quota;
        $tb_coupon->nominal = $request->nominal;
        $tb_coupon->type = 'nominal';
        $tb_coupon->start_date = $request->start_date;
        $tb_coupon->end_date = $request->end_date;
        $tb_coupon->is_active = $request->status;
        $tb_coupon->updated_by = session()->get('session_name') ;
    	$tb_coupon->save();

        $request->session()->flash('alert-success', 'Coupon has been updated successfully!');

    	return  redirect('coupon');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_coupon = Coupon::find($id);
        $tb_coupon->is_active = '2';
        $tb_coupon->updated_by = session()->get('session_name') ;
        $tb_coupon->save();

        $request->session()->flash('alert-success', 'Coupon has been deleted successfully!');

        return  redirect('coupon');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$tb_coupon = Coupon::find($id);
    	$tb_coupon->delete();

    	return  redirect('coupon');
    } 
}
