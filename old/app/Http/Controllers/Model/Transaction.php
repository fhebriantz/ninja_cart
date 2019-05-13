<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $table = 'nj_tr_order';

    public static function getTrans(){
        
        $nj_tr_order = DB::table('nj_tr_order')
            ->join('nj_dt_order', 'nj_dt_order.id_order', '=', 'nj_tr_order.id_order')
            ->join('nj_ms_product', 'nj_ms_product.id', '=', 'nj_dt_order.id_product')
            ->select('nj_tr_order.*', 'nj_dt_order.qty' , 'nj_ms_product.product_name', 'nj_dt_order.id as detailorder_id' ,'nj_ms_product.product_price','nj_ms_product.sku')
            ->orderBy('nj_tr_order.created_at', 'DESC')
            ->get();

     return $nj_tr_order;
    }
}
