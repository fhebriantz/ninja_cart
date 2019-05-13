<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'nj_ms_product';

    public static function GetAllData()
    {
    	$data = DB::table('nj_ms_product')
                    ->where('is_active', '!=', '2') //2 = deleted
                    ->orderBy('product_name', 'asc')
                    ->get();

        return $data;
    }

    public static function GetDataDetail()
    {
    	$data = DB::table('nj_ms_product as nmp')
    				->leftjoin('nj_ms_product_img as nmpi', 'nmpi.id_product', '=', 'nmp.id')
    				->select('nmp.*','nmpi.filename')
                    ->get();

        return $data;
    }
}
