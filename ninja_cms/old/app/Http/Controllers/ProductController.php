<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Product;
use App\Http\Model\ProductImage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_product = Product::GetAllData();
        //$data_product = Product::where('is_active', '!=', '2')->orderBy('product_name', 'asc')->get();
        $no = 1;

    	return view('pages/cms/product/index', compact('data_product','no'));
    }

    function create()
    {
        return view('pages/cms/product/create');
    }

    function edit($id)
    {
        $product=Product::GetDataDetail()->where('id','=',$id)->first();
        return view('pages/cms/product/edit')
        ->with('data_product',$product);
    }

    function view($id)
    {
        $product=Product::GetDataDetail()->where('id','=',$id)->first();

        return view('pages/cms/product/view')
        ->with('data_product',$product);
    }

    // Function: Create new data
    function insert(Request $request)  
    {

        $validatedData = $request->validate([
            'product_name' => 'required|unique:nj_ms_product',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'status' => 'required',
            'picture' => 'required',
        ]);

        //Upload picture
        $tb_product_img = new ProductImage;
        if($request->file('picture') == "" || $request->file('picture') == null)
        {
            $tb_product_img->filename = $tb_product_img->filename;
        } 
        else
        {
            $files      = $request->file('picture');
            $fileNames   = 'product'.time().'.'.$files->getClientOriginalExtension();
            // $fileNames   = $request->product_name.'.'.$files->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/products');
            $files->move($destinationPath, $fileNames);
            $tb_product_img->filename = $fileNames;
        }

        try {   
            //Save new product data 
            $tb_product = new Product;
            $tb_product->product_name = $request->product_name; 
            $tb_product->product_price = $request->price; 
            $tb_product->sku = $request->sku;
            $tb_product->weight = $request->weight;
            $tb_product->is_active = $request->status;
            $tb_product->created_by = session()->get('session_name'); 
            $tb_product->save();

            //Save new product data image
            $tb_product_img->id_product = $tb_product->id;
            $tb_product_img->sort_number = '1';
            $tb_product_img->is_cover = '1';
            $tb_product_img->is_active = '1';
            $tb_product_img->created_by = session()->get('session_name'); 
            $tb_product_img->save();

            $request->session()->flash('alert-success', 'New product has been added successfully!');
        }
        catch (Exception $e)
        {
            $request->session()->flash('alert-danger', 'Error to upload picture, please try again!');
        }

    	return redirect('product');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
                                                'product_name' => 'required',
                                                'price' => 'required|numeric',
                                                'weight' => 'required|numeric',
                                                'status' => 'required',
                                            ]);
        
    	//Upload picture
        $tb_product_img = ProductImage::where('id_product' , '=', $id)->first();
        if($request->file('picture') == "" || $request->file('picture') == null)
        {
            $tb_product_img->filename = $tb_product_img->filename;
        } 
        else
        {
            $files      = $request->file('picture');
            $fileNames  = 'product'.time().'.'.$files->getClientOriginalExtension();
            // $fileNames   = $request->product_name.'.'.$files->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/products');
            $files->move($destinationPath, $fileNames);
            $tb_product_img->filename = $fileNames;
        }

        try {   
            //Update product data 
            $tb_product = Product::find($id);
            $tb_product->product_name = $request->product_name; 
            $tb_product->product_price = $request->price; 
            $tb_product->sku = $request->sku;
            $tb_product->weight = $request->weight;
            $tb_product->is_active = $request->status;
            $tb_product->updated_by = session()->get('session_name') ;
            $tb_product->save();

            //Update product data image
            $tb_product_img->updated_by = session()->get('session_name') ;
            $tb_product_img->save();

            $request->session()->flash('alert-success', 'Product has been updated successfully!');
        }
        catch (Exception $e)
        {
            $request->session()->flash('alert-danger', 'Error to upload picture, please try again!');
        }

    	return redirect('product');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $tb_product = Product::find($id);
        $tb_product->is_active = '2';
        $tb_product->updated_by = session()->get('session_name') ;
        $tb_product->save();

        $request->session()->flash('alert-success', 'Product has been deleted successfully!');

        return  redirect('product');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$abouts = Product::find($id);
    	$abouts->delete();

    	return redirect('product');
    } 
}
