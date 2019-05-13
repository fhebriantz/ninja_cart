<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class District extends Model
{
    protected $table = 'nj_ms_districts';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_districts as nmd')
    				->join('nj_ms_regencies as nmr', 'nmr.id', '=', 'nmd.regency_id')
    				->select('nmd.*','nmr.name as regency_name')
                    ->where('nmd.is_active', '!=', '2') //2 = deleted
                    ->orderBy('regency_name', 'asc')
                    ->orderBy('name', 'asc')
                    ->get();

        return $data;
    }
}
