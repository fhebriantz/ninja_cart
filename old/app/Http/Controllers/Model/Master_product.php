<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Master_product extends Model
{
    protected $table = 'nj_ms_product';

    public static function getProd(){
        
        $nj_ms_product = DB::table('nj_ms_product')
            ->join('nj_ms_product_img', 'nj_ms_product_img.id_product', '=', 'nj_ms_product.id')
            ->select('nj_ms_product.*', 'nj_ms_product_img.filename', 'nj_ms_product_img.is_cover')
            ->where('nj_ms_product.is_active', '=', 1)
            ->where('nj_ms_product_img.is_cover', '=', 1)
            ->orderBy('nj_ms_product.product_price', 'ASC')
            ->get();

     return $nj_ms_product;
    }
}
