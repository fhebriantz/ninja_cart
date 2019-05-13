<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Routing\Middleware\FormFacade;
use vendor\autoload;
use App\Http\Model\District;
use App\Http\Model\Village;
use App\Http\Model\Shipment;
// use DataTables;
use yajra\DataTables\DataTables;

class VillageController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        // $data_village = Village::GetAllData();
        // $count_village = Village::GetAllData()->count();
        // $no = 1;

        // return view('pages/cms/village/index', compact('data_village','count_village','no'));
        return view('pages/cms/village/index');
    }

    function create()
    {   
        // $district = District::where('is_active','1')->orderBy('name')->get();
        $list_zone = Shipment::distinct()->where('is_active','1')->orderBy('to_zone')->get('to_zone');

        // return view('pages/cms/village/create')->with('list_district',$district);
        return view('pages/cms/village/create')->with('list_zone',$list_zone);
    }

    function edit($id)
    {   
        $data_village=Village::where('id','=',$id)->first();
        $list_district = District::find($data_village->district_id);
        $list_zone = Shipment::distinct()->where('is_active','1')->orderBy('to_zone')->get('to_zone');
        
        return view('pages/cms/village/edit', compact('data_village','list_district','list_zone'));
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
                                                'district_id' => 'required',
                                                'name' => 'required',
                                                'zone' => 'required',
                                                'status' => 'required',
                                            ]);

        $dis_id = $request->district_id;
        $last = Village::where('district_id','=',$dis_id)->orderBy('id', 'desc')->first();
        $tb_village = new Village;
        if ($last) {
            $last_id = substr($last->id, 7);
            $last_id = $last_id + 1;
            $tb_village->id = $dis_id.sprintf("%03d", $last_id);
        } else {
            $tb_village->id = $dis_id.'001';
        }
        $tb_village->district_id = $dis_id; 
        $tb_village->name = strtoupper($request->name); 
        $tb_village->zone = $request->zone; 
        $tb_village->is_active = $request->status;
        $tb_village->created_by = session()->get('session_name'); 
        $tb_village->save();

        $request->session()->flash('alert-success', 'New village has been added successfully!');

        return redirect('village');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'name' => 'required',
                                                'zone' => 'required',
                                                'status' => 'required',
                                            ]);
        
        $tb_village = Village::find($id);
        $tb_village->name = strtoupper($request->name); 
        $tb_village->zone = $request->zone; 
        $tb_village->is_active = $request->status;
        $tb_village->updated_by = session()->get('session_name') ;
        $tb_village->save();

        $request->session()->flash('alert-success', 'Village has been updated successfully!');

        return redirect('village');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_village = Village::find($id);
        $tb_village->is_active = '2';
        $tb_village->updated_by = session()->get('session_name') ;
        $tb_village->save();

        $request->session()->flash('alert-success', 'Village has been deleted successfully!');

        return  redirect('village');
    } 

    // Function: Delete data from table
    public function delete_db($id){
        // find khusus untuk primary key di database
        $tb_village = Village::find($id);
        $tb_village->delete();

        return  redirect('village');
    } 
	
    public function json(Datatables $datatables){
        // return Datatables::of(Village::select('name','created_by','created_at'))->make(true);
        return Datatables::of(Village::GetAllData())->make(true);

        // $builder = Village::GetAllData();

        // return $datatables->eloquent($builder)
        //                   // ->editColumn('name', function ($user) {
        //                   //     return '<a>' . $user->name . '</a>';
        //                   // })
        //                   ->addColumn('no', '1')
        //                   // ->rawColumns([1, 5])
        //                   ->make();
    }

    public function list_ajax(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = District::select("id","name")->where('name','LIKE',"%$search%")->where('is_active','=','1')->get();
        }

        return response()->json($data);
    }

    public function init_list_ajax(Request $request)
    {
        $data = [];

        if($request->has('old_val')){
            $id = $request->old_val;
            $data = District::find($id);
        }

        return response()->json($data->name);
    }
}
