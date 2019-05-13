<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Coupon extends Model
{
    protected $table = 'nj_ms_coupon';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_coupon')
                    ->where('is_active', '!=', '2') //2 = deleted
                    ->orderBy('coupon_code', 'asc')
                    ->get();

        return $data;
    }
}
