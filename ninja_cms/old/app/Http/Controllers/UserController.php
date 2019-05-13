<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\User_management;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function password()
    { 
        $data_user = User_management::where('id','=',session()->get('session_id'))->first();

        return view('pages/cms/user/password')->with('data_user',$data_user);
    }

    function update_password (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'username' => 'required',
                                                'password' => 'required|confirmed',
                                            ]);
        
        $tb_user = User_management::find($id);
        $tb_user->password = sha1($request->password); 
        $tb_user->password = sha1($request->password_confirmation); 
        $tb_user->updated_by = session()->get('session_name') ;
        $tb_user->save();

        $request->session()->flash('alert-success', 'Password has been changed successfully!');

        return  redirect('user/password');
    }
}
