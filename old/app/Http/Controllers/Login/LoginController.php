<?php

namespace App\Http\Controllers\Login;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Routing\Middleware\LoginCheck;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Model\User_management;
use App\Http\Controllers\Model\User_cms;
use DateTime;
use Auth;
use DB;
use Session;

class LoginController extends Controller
{ 

    // ============================ DMS LOGIN ==============================

    public function show(Request $request){
        $request->session()->forget('message');
        return view('pages/login/login');
    } 

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $checkLogin = User_management::where(['username'=>$username,'password'=>$password])
        ->join('dms_user_group', 'dms_user_group.id', '=', 'dms_user_management.id_usergroup')
        ->join('dms_master_project', 'dms_master_project.id', '=', 'dms_user_management.id_project')
        ->join('dms_master_location', 'dms_master_location.id', '=', 'dms_user_management.id_location')
        ->select('dms_user_management.*', 'dms_user_group.usergroup_name', 'dms_user_group.id as id_group', 'dms_master_project.master_project_name', 'dms_master_location.id as id_loc', 'dms_master_location.location')
        ->get();
        if (sizeof($checkLogin) > 0){
            foreach ($checkLogin as $key => $val) {

                $id_akun = $val->id;
                $id_group_akun = $val->id_group;
                $name = $val->name;
                $username = $val->username;
                $nama_group = $val->usergroup_name;
                $id_project = $val->id_project;
                $location = $val->location;
                $id_location = $val->id_loc;
                $project_name = $val->master_project_name;

                $request->session()->put('session_login', true);
                $request->session()->put('session_id', $id_akun);
                $request->session()->put('session_name', $name);
                $request->session()->put('session_username', $username);
                $request->session()->put('session_id_group', $id_group_akun);
                $request->session()->put('session_group', $nama_group);
                $request->session()->put('session_project', $id_project);
                $request->session()->put('session_id_loc', $id_location);
                $request->session()->put('session_location', $location);
                $request->session()->put('session_name_project', $project_name);
                return  redirect('/dms/dashboard');
            }
        }
        else{
            $request->session()->put('message', "Login failed username/password not match");
            return view('pages/login/login');
        }
    }

    public function logout (Request $request){
                $request->session()->forget('session_login');
                $request->session()->forget('session_id');
                $request->session()->forget('session_name');
                $request->session()->forget('session_username');
                $request->session()->forget('session_id_group');
                $request->session()->forget('session_group');
                $request->session()->forget('session_project');
                $request->session()->forget('session_id_loc');
                $request->session()->forget('session_location');
                $request->session()->forget('session_name_project');
                $request->session()->forget('message');

                // $request->session()->flush();

                return  redirect('/dms/login');
    }

    // ============================ CMS LOGIN ==============================

    public function showcms(Request $request){
        $request->session()->forget('message_cms');
        return view('pages/login/login_cms');
    }

    public function logincms(Request $request){
        $username = $request->username;
        $password = $request->password;

        $checkLogin = User_cms::where(['username'=>$username,'password'=>$password])
        ->select('cms_user.*')
        ->get();
        if (sizeof($checkLogin) > 0){
            foreach ($checkLogin as $key => $val) {

                $id_akun = $val->id;
                $name = $val->name;
                $username = $val->username;

                $request->session()->put('session_login_cms', true);
                $request->session()->put('session_id_cms', $id_akun);
                $request->session()->put('session_name_cms', $name);
                $request->session()->put('session_username_cms', $username);

                return  redirect('/cms/dashboard');
            }
        }
        else{
            $request->session()->put('message_cms', "Login failed username/password not match");
            return view('pages/login/login_cms');
        }
    }

    public function logoutcms (Request $request){
                $request->session()->forget('session_login_cms');
                $request->session()->forget('session_id_cms');
                $request->session()->forget('session_name_cms');
                $request->session()->forget('session_username_cms');
                $request->session()->forget('message_cms');

                // $request->session()->flush();

                return  redirect('/cms/login');
    }
}
