<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Shipment;

class ShipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_shipment = Shipment::GetAllData();
        //$data_shipment = Shipment::where('is_active','!=','2')->orderBy('shipment_type', 'asc')->get();
        $no = 1;

    	return view('pages/cms/shipment/index', compact('data_shipment','no'));
    }

    function create()
    {
        return view('pages/cms/shipment/create');
    }

    function edit($id)
    {
        $shipment=Shipment::where('id','=',$id)->first();
        return view('pages/cms/shipment/edit')
        ->with('data_shipment',$shipment);
    }

    // Function: Create new data
    function insert(Request $request)  
    {

        $validatedData = $request->validate([
                                                'from_zone' => 'required',
                                                'to_zone' => 'required',
                                                'price' => 'required|numeric',
                                                'sla' => 'required',
                                                'status' => 'required',
                                            ]);

        

        //Save new shipment data 
        $tb_shipment = new Shipment;
        $tb_shipment->shipment_name = 'ninja_xpress'; 
        $tb_shipment->shipment_type = 'Delivery'; 
        $tb_shipment->from_zone = strtoupper($request->from_zone);
        $tb_shipment->to_zone = strtoupper($request->to_zone);
        $tb_shipment->price = $request->price;
        $tb_shipment->sla = $request->sla;
        $tb_shipment->is_active = $request->status;
        $tb_shipment->created_by = session()->get('session_name'); 
        $tb_shipment->save();
        
        $request->session()->flash('alert-success', 'New shipment has been added successfully!');

        return redirect('shipment');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'from_zone' => 'required',
                                                'to_zone' => 'required',
                                                'price' => 'required|numeric',
                                                'sla' => 'required',
                                                'status' => 'required',
                                            ]);
        
    	$tb_shipment = Shipment::find($id);
        $tb_shipment->from_zone = strtoupper($request->from_zone);
        $tb_shipment->to_zone = strtoupper($request->to_zone);
        $tb_shipment->price = $request->price;
        $tb_shipment->sla = $request->sla;
        $tb_shipment->is_active = $request->status;
        $tb_shipment->updated_by = session()->get('session_name') ;
    	$tb_shipment->save();

        $request->session()->flash('alert-success', 'Shipment has been updated successfully!');

    	return  redirect('shipment');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_shipment = Shipment::find($id);
        $tb_shipment->is_active = '2';
        $tb_shipment->updated_by = session()->get('session_name') ;
        $tb_shipment->save();

        $request->session()->flash('alert-success', 'Shipment has been deleted successfully!');

        return  redirect('shipment');
    } 

    // Function: Delete data from table
    public function delete_db($id){
        // find khusus untuk primary key di database
        $shipment = Shipment::find($id);
        $shipment->delete();

        return redirect('shipment');
    } 
}
