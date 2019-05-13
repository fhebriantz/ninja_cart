<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Routing\Middleware\FormFacade;
use vendor\autoload;
use App\Http\Model\Province;
use App\Http\Model\Regency;

class RegencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_regency = Regency::GetAllData();
        $no = 1;

    	return view('pages/cms/regency/index', compact('data_regency','no'));
    }

    function create()
    {   
        $province = Province::where('is_active','1')->orderBy('name')->get();

        return view('pages/cms/regency/create')->with('list_province',$province);
    }

    function edit($id)
    {   
        $data_regency=Regency::where('id','=',$id)->first();
        $list_province = Province::where('is_active','1')->orderBy('name')->get();
        
        return view('pages/cms/regency/edit', compact('data_regency','list_province'));
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
                                                'province_id' => 'required',
                                                'name' => 'required',
                                                'status' => 'required',
                                            ]);

        $prov_id = $request->province_id;
        $last = Regency::where('province_id','=',$prov_id)->orderBy('id', 'desc')->first();
        $tb_regency = new Regency;
        if ($last) {
            $last_id = substr($last->id, 2);
            $last_id = $last_id + 1;
            $tb_regency->id = $prov_id.sprintf("%02d", $last_id);
        } else {
            $tb_regency->id = $prov_id.'01';
        }
        $tb_regency->province_id = $prov_id; 
        $tb_regency->name = strtoupper($request->name); 
        $tb_regency->is_active = $request->status;
        $tb_regency->created_by = session()->get('session_name'); 
    	$tb_regency->save();

        $request->session()->flash('alert-success', 'New regency has been added successfully!');

    	return redirect('regency');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'name' => 'required',
                                                'status' => 'required',
                                            ]);
        
    	$tb_regency = Regency::find($id);
        $tb_regency->name = strtoupper($request->name); 
        $tb_regency->is_active = $request->status;
        $tb_regency->updated_by = session()->get('session_name') ;
    	$tb_regency->save();

        $request->session()->flash('alert-success', 'Regency has been updated successfully!');

    	return  redirect('regency');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_regency = Regency::find($id);
        $tb_regency->is_active = '2';
        $tb_regency->updated_by = session()->get('session_name') ;
        $tb_regency->save();

        $request->session()->flash('alert-success', 'Regency has been deleted successfully!');

        return  redirect('regency');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$tb_regency = Regency::find($id);
    	$tb_regency->delete();

    	return  redirect('regency');
    } 
}
