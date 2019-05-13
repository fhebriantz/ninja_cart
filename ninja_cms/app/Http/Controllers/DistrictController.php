<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Routing\Middleware\FormFacade;
use vendor\autoload;
use App\Http\Model\Regency;
use App\Http\Model\District;
// use DataTables;
use yajra\DataTables\DataTables;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_district = District::GetAllData();
        $no = 1;

    	return view('pages/cms/district/index', compact('data_district','no'));
    }

    function create()
    {   
        $regency = Regency::where('is_active','1')->orderBy('name')->get();

        return view('pages/cms/district/create')->with('list_regency',$regency);
    }

    function edit($id)
    {   
        $data_district=District::where('id','=',$id)->first();
        $list_regency = Regency::where('is_active','1')->orderBy('name')->get();
        
        return view('pages/cms/district/edit', compact('data_district','list_regency'));
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
                                                'regency_id' => 'required',
                                                'name' => 'required',
                                                'status' => 'required',
                                            ]);

        $reg_id = $request->regency_id;
        $last = District::where('regency_id','=',$reg_id)->orderBy('id', 'desc')->first();
        $tb_district = new District;
        if ($last) {
            $last_id = substr($last->id, 4);
            $last_id = $last_id + 1;
            $tb_district->id = $reg_id.sprintf("%03d", $last_id);
        } else {
            $tb_district->id = $reg_id.'010';
        }
        $tb_district->regency_id = $reg_id; 
        $tb_district->name = strtoupper($request->name); 
        $tb_district->is_active = $request->status;
        $tb_district->created_by = session()->get('session_name'); 
    	$tb_district->save();

        $request->session()->flash('alert-success', 'New district has been added successfully!');

    	return redirect('district');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'name' => 'required',
                                                'status' => 'required',
                                            ]);
        
    	$tb_district = District::find($id);
        $tb_district->name = strtoupper($request->name); 
        $tb_district->is_active = $request->status;
        $tb_district->updated_by = session()->get('session_name') ;
    	$tb_district->save();

        $request->session()->flash('alert-success', 'District has been updated successfully!');

    	return  redirect('district');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_regency = District::find($id);
        $tb_regency->is_active = '2';
        $tb_regency->updated_by = session()->get('session_name') ;
        $tb_regency->save();

        $request->session()->flash('alert-success', 'District has been deleted successfully!');

        return  redirect('district');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$tb_regency = District::find($id);
    	$tb_regency->delete();

    	return  redirect('district');
    } 
    
    public function json(Datatables $datatables){
        return Datatables::of(District::GetAllData())->make(true);
    }
}
