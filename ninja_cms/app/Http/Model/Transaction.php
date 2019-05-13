<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $table = 'nj_tr_order';

    public static function GetDataTransaction()
    {
    	$data = DB::table('nj_tr_order as nto')
    				->join('nj_ms_customer as nmc', 'nmc.id', '=', 'nto.id_customer')
    				->select('nto.*','nmc.fullname','nmc.address','nmc.province','nmc.regency','nmc.district','nmc.village','nmc.zipcode')
                    ->where('nto.is_active', '=', '1') //1 = active
                    ->orderBy('nto.date_order', 'desc')
                    ->get();

        return $data;
    }

    public static function GetDataTransactionDetail()
    {
    	$data = DB::table('nj_dt_order as ndo')
    				->join('nj_ms_product as nmp', 'nmp.id', '=', 'ndo.id_product')
    				//->join('nj_ms_product_img as nmpi', 'nmpi.id_product', '=', 'nmp.id')
    				->select('ndo.*','nmp.product_name')//,'nmpi.filename','nmpi.full_path')
    				//->where('is_cover','1')
                    ->orderBy('product_name', 'asc')
                    ->get();

        return $data;
    }
}
