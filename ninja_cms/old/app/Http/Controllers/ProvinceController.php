<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Province;

class ProvinceController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_province = Province::GetAllData();
        $no = 1;

    	return view('pages/cms/province/index', compact('data_province','no'));
    }

    function create()
    {
        return view('pages/cms/province/create');
    }

    function edit($id)
    {
        $province=Province::where('id','=',$id)->first();
        return view('pages/cms/province/edit')
        ->with('data_province',$province);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
                                                'name' => 'required|unique:nj_ms_provinces',
                                                'status' => 'required',
                                            ]);

        $last = Province::orderBy('id', 'desc')->first();
    	$tb_province = new Province;
        if ($last) {
            $tb_province->id = $last->id + 1;
        } else {
            $tb_province->id = '1';
        }
        $tb_province->name = strtoupper($request->name); 
        $tb_province->is_active = $request->status;
        $tb_province->created_by = session()->get('session_name'); 
    	$tb_province->save();

        $request->session()->flash('alert-success', 'New province has been added successfully!');

    	return redirect('province');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'name' => 'required',
                                                'status' => 'required',
                                            ]);
        
    	$tb_province = Province::find($id);
        $tb_province->name = strtoupper($request->name); 
        $tb_province->is_active = $request->status;
        $tb_province->updated_by = session()->get('session_name') ;
    	$tb_province->save();

        $request->session()->flash('alert-success', 'Province has been updated successfully!');

    	return  redirect('province');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_province = Province::find($id);
        $tb_province->is_active = '2';
        $tb_province->updated_by = session()->get('session_name') ;
        $tb_province->save();

        $request->session()->flash('alert-success', 'Province has been deleted successfully!');

        return  redirect('province');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$tb_province = Province::find($id);
    	$tb_province->delete();

    	return  redirect('province');
    } 
}
