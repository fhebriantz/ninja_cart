<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shipment extends Model
{
    protected $table = 'nj_ms_shipment';

    public static function GetAllData(){
    	$data = DB::table('nj_ms_shipment')
                    ->where('shipment_type', '=', 'Delivery')
                    ->where('is_active', '!=', '2') //2 = deleted
                    ->orderBy('id', 'asc')
                    ->get();

        return $data;
    }
}
