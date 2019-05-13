<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    protected $table = 'nj_ms_customer';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_customer')
                    ->where('is_active', '=', '1') //1 = active
                    ->orderBy('fullname', 'asc')
                    ->get();

        return $data;
    }
}
