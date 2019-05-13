<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Province extends Model
{
    protected $table = 'nj_ms_provinces';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_provinces')
                    ->where('is_active', '!=', '2') //2 = deleted
                    ->orderBy('name', 'asc')
                    ->get();

        return $data;
    }
}
