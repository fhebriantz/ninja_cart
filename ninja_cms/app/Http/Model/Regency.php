<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Regency extends Model
{
    protected $table = 'nj_ms_regencies';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_regencies as nms')
    				->join('nj_ms_provinces as nmp', 'nmp.id', '=', 'nms.province_id')
    				->select('nms.*','nmp.name as province_name')
                    ->where('nms.is_active', '!=', '2') //2 = deleted
                    ->orderBy('province_name', 'asc')
                    ->orderBy('name', 'asc')
                    ->get();

        return $data;
    }
}
