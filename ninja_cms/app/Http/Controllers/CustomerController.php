<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Customer;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_customer = Customer::GetAllData();
        $no = 1;

    	return view('pages/cms/customer/index', compact('data_customer','no'));
    }

    function view($id)
    {
        $customer=Customer::where('id','=',$id)->first();

        return view('pages/cms/customer/view')
        ->with('data_customer',$customer);
    }
}
