<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class User_management extends Model
{
    protected $table = 'nj_ms_user';
    protected  $primaryKey = 'id';

    public static function getTableUser(){
        
        $sql_user = DB::table('nj_ms_user')
		            ->select('nj_ms_user.*')
		            ->where('is_active','1')
		            ->get(); 
     return $sql_user;
    }
}
