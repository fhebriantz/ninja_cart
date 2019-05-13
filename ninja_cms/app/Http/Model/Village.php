<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Village extends Model
{
    protected $table = 'nj_ms_villages';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_villages as nmv')
    				->join('nj_ms_districts as nmd', 'nmd.id', '=', 'nmv.district_id')
    				->select('nmv.*','nmd.name as district_name')
                    ->where('nmv.is_active', '!=', '2') //2 = deleted
                    ->orderBy('district_name', 'asc')
                    ->orderBy('name', 'asc');
                    // ->limit(10)
                    // ->get();

        return $data;
    }
}
