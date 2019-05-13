@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Product</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Product <span class="fa-angle-right fa"></span> View</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Product</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table class="table">      
                            <tr>
                                <td>Product Name</td>
                                <td><input type="text" class="form-control"  name="product_name"  value="{{ $data_product->product_name }}" style="width: 100%" readonly></td>
                            </tr>            
                            <tr>
								<td>Price</td>
								<td><input type="text"  class="form-control" name="price" value="{{ number_format($data_product->product_price) }}" style="width: 100%" readonly></td>
							</tr>          
                            <tr>
                                <td>SKU</td>
                                <td><input type="text"  class="form-control" name="sku" value="{{ $data_product->sku }}" style="width: 100%" readonly></td>
                            </tr>          
                            <tr>
                                <td>Picture</td>
                                <td><img src="{{asset('assets/images/products/'.$data_product->filename)}}" class="css-class" alt="{{ $data_product->filename }}" height="150"></td>
                            </tr>           
                            <tr>
                                <td>Status</td>
                                <td><input type="text"  class="form-control" name="status" value="{{ $data_product->is_active=='1' ? 'Active':'Inactive' }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Created Date</td>
                                <td><input type="text"  class="form-control" name="created_at" value="{{ $data_product->created_at }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td><input type="text"  class="form-control" name="created_by" value="{{ $data_product->created_by }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Modified Date</td>
                                <td><input type="text"  class="form-control" name="updated_at" value="{{ $data_product->updated_at }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><input type="text"  class="form-control" name="updated_by" value="{{ $data_product->updated_by }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a class="btn btn-danger" href="{{url('/product')}}"  style="text-decoration: none;">Back</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection