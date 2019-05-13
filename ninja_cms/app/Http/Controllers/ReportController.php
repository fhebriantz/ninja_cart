<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Support\Facades\Validator;
use vendor\autoload;
use App\Http\Model\Report;
use Mail;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list(Request $request){
        $validator = Validator::make(request()->all(), [
            'from_date'  => 'required',
            'to_date' => 'required',
        ]);
        
        $no = 1;
        $data_report = '';

        if ($validator->fails()) {
            redirect()
                ->back()
                ->withErrors($validator->errors());
        }
        else
        {
            if($request->has('from_date') and $request->has('to_date')){
                $from = $request->get('from_date');
                $to = $request->get('to_date');
                $data_report = Report::GetDataTransaction($from,$to);
            } 
        }

        return view('pages/cms/report/index', compact('data_report','no'));
    }

    // Function: Search data by date
    function search(Request $request)  
    {
        $validatedData = $request->validate([
                                                'date_search' => 'required',
                                            ]);

        // $tb_coupon = new Coupon;
        // $tb_coupon->coupon_code = $request->coupon_code; 
        // $tb_coupon->coupon_name = $request->coupon_name; 
        // $tb_coupon->description = $request->description;
        // $tb_coupon->nominal = $request->nominal;
        // $tb_coupon->type =         'nominal';
        // $tb_coupon->start_date = $reques        status;
        // $tb_coupon->created_by = session()->get('session_name'); 
        // $tb_coupon->save();

        // $request->session()->flash('alert-success', 'New coupon has been added successfully!');
        $view_table = '1';
            $no = '1';
        $data_transaction = 'aaa';//Transaction::all();
        // return Redirect::back()->with('query_data', 'some_data');
        // return redirect('report/1')->with('data_transaction', $data_transaction);
        // return redirect()->route('report',['data_transaction'=>$data_transaction]);
        // return redirect('report')->with('data_transaction');
        // return back()->with(compact('data_transaction'));
        $player = 'player_namne';
        return back()->with(compact('player'));

        
        // return view('pages/cms/report/index', compact('view_table','data_transaction','no'));
    }
}
