<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
    protected $table = 'nj_tr_order';

    public static function GetDataTransaction($from,$to)
    {
        $data = DB::table('nj_tr_order as nto')
                    ->join('nj_ms_customer as nmc', 'nmc.id', '=', 'nto.id_customer')
                    ->join('nj_dt_order as ndo', 'ndo.id_order', '=', 'nto.id_order')
                    ->join('nj_ms_product as nmp', 'nmp.id', '=', 'ndo.id_product')
                    ->select('nto.id_order','nto.date_order','nmc.fullname','nmc.email','nmc.phone_number','nmc.address','nmc.province','nmc.regency','nmc.district','nmc.village','nmc.zipcode','nmp.product_name','nmp.sku','ndo.price','ndo.qty')
                    ->whereDate('nto.date_order', '>=', $from)
                    ->whereDate('nto.date_order', '<=', $to)
                    ->where('nto.is_active', '=', '1') //1 = active
                    ->orderBy('nto.date_order', 'desc')
                    ->get();

        return $data;
    }
}
