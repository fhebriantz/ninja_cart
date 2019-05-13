<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Model\User_management;
use DateTime;
use Auth;
use DB;
use Session;

class LoginController extends Controller
{ 

    // ============================ CMS LOGIN ==============================
    public function show(Request $request){
        $request->session()->forget('message');
        return view('pages/user/login');
    } 

    function insert (Request $request)  
    {
        $validatedData = $request->validate([
                
                'name' => 'required',
                'username' => 'required|unique:user_management',
                'password' => 'required|confirmed',
                'id_usergroup' => 'required',
            ]);

        $user_management = new User_management;

            $user_management->name = $request->name; 
            $user_management->username = $request->username; 
            $user_management->password = $request->password; 
            $user_management->password = $request->password_confirmation; 
            $user_management->id_usergroup = $request->id_usergroup; 
            $user_management->created_by = session()->get('session_name'); 
        // untuk mengsave
        $user_management->save();

        return  redirect('forgotpass');
    }

    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([

                'name' => 'required',
                'username' => 'required',
                'password' => 'required|confirmed',
                'id_usergroup' => 'required',
            ]);
        
        $user_management = User_management::find($id);

            $user_management->name = $request->name; 
            $user_management->username = $request->username; 
            $user_management->password = $request->password; 
            $user_management->password = $request->password_confirmation; 
            $user_management->id_usergroup = $request->id_usergroup; 
            $user_management->created_by = session()->get('session_name'); 
        // untuk mengsave
        $user_management->save();

        return  redirect('forgotpass');
    }

    public function delete($id){

        $user_management = User_management::find($id);
        $user_management->delete();
        
        return  redirect('forgotpass');
    } 

    public function login(Request $request){
        $username = $request->username;
        $password = sha1($request->password);
       
        //$token = $request->input('g-recaptcha-response');

        //if ($token) {
            $checkLogin = User_management::where(['id_usergroup'=>'1','username'=>$username,'password'=>$password,'is_active'=>'1'])
                                        ->select('nj_ms_user.*')
                                        ->get();

            if (sizeof($checkLogin) > 0){
                foreach ($checkLogin as $key => $val) {
                    $id_user = $val->id;
                    $name = $val->fullname;
                    $username = $val->username;
                    $id_usergroup = $val->id_usergroup;

                    $request->session()->put('session_login', true);
                    $request->session()->put('session_id', $id_user);
                    $request->session()->put('session_name', $name);
                    $request->session()->put('session_username', $username);
                    $request->session()->put('session_id_group', $id_usergroup);
                    return  redirect('product');
                }
            }
            else{
                // $request->session()->put('message', "Login failed username/password not match!");
                $request->session()->flash('message', 'Login failed username/password not match!');
                return view('pages/user/login');
            }
        /*}else{
            $request->session()->flash('captcha', 'Input the reCAPTCHA');
            return  Redirect::back();
        }*/
    }

    public function logout (Request $request){
                $request->session()->forget('session_login');
                $request->session()->forget('session_id');
                $request->session()->forget('session_name');
                $request->session()->forget('session_username');
                $request->session()->forget('id_usergroup');
                $request->session()->forget('message');

                // $request->session()->flush();

                return  redirect('login');
    }
}
