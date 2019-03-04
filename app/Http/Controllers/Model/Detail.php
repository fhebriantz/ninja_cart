<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Detail extends Model
{
    protected $table = 'nj_dt_order';

    public static function getDetail(){
        
        $nj_dt_order = DB::table('nj_dt_order')
            ->join('nj_ms_product', 'nj_ms_product.id', '=', 'nj_dt_order.id_product')
            ->select('nj_dt_order.*', 'nj_ms_product.product_name' ,'nj_ms_product.product_price','nj_ms_product.sku','nj_ms_product.image','nj_ms_product.is_active','nj_ms_product.weight')
            ->get();

     return $nj_dt_order;
    }
}
