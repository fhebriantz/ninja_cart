<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Transaction;
use Mail;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_transaction = Transaction::GetDataTransaction();
        $no = 1;

    	return view('pages/cms/transaction/index', compact('data_transaction','no'));
    }

    function view($id)
    {
        $header=Transaction::GetDataTransaction()->where('id_order','=',$id)->first();
        $detail=Transaction::GetDataTransactionDetail()->where('id_order','=',$id);
        $no = 1;

        return view('pages/cms/transaction/view', compact('header','detail','no'));
    }

    function test_email()
    {
        $to_name = 'TEST RECEIVER';
        $to_email = 'lord.trafo@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
            
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Artisans Web Testing Mail');
            $message->from('no-reply@azha.co.id','Artisans Web');
        });
    }
}
