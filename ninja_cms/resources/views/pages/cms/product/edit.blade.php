@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Product</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Product <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Product</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    	<form method="POST" action="{{url('/product/'.$data_product->id.'/edit')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
	                        <table class="table">     
                                <tr>
                                    <td>Product Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="product_name" placeholder="Product name" value="{{ $data_product->product_name }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="{{ $data_product->product_price }}" style="width: 100%"></td>
                                </tr>            
                                <tr>
                                    <td>SKU</td>
                                    <td><input type="text"  class="form-control" name="sku" placeholder="12345678" style="width: 100%" value="{{ $data_product->sku }}"></td>
                                </tr>     
                                <tr>
                                    <td>Weight <em style="color:red">*</em></td>
                                    <td><input type="number" class="form-control" name="weight" placeholder="0" style="width: 100%" value="{{ $data_product->weight }}"></td>
                                </tr>
                                <tr>
                                    <td>Upload Picture </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <!-- <input id="file-1" type="file" name="test_file" multiple class="file" data-show-upload="true" data-overwrite-initial="false" data-theme="fas"> -->
                                                <input id="picture" type="file" name="picture" class="file" data-show-upload="false" data-theme="fas">
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="1" {{ ($data_product->is_active=='1' ? 'Selected':'') }} >Active</option>
                                            <option value="0" {{ ($data_product->is_active=='0' ? 'Selected':'') }} >Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="{{url('/product')}}"  style="text-decoration: none;">Back</a>
									</td>
								</tr>
	                        </table>
	                        <input type="hidden" name="_method" value="PUT">
	                    </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('header')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{ asset('themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .kv-file-remove{visibility: hidden;}
</style>
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
      $('#summernote').summernote();
    });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
<script>
    $("#picture").fileinput({
        theme: 'fas',
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
        maxFileSize: 2000,
        maxFilesNum: 1,
        initialPreviewAsData: true,
        initialPreview: [
            "{{ asset('assets/images/products/'.$data_product->filename) }}",
        ],
        initialPreviewConfig: [
            {caption: "{{ $data_product->filename }}", url: "{{ asset('assets/images/products/'.$data_product->filename) }}",height: "150px", key: 1},
        ],
        // defaultPreviewContent: '<img src="http://azha.ddns.net:8080/ninja_cms/public/assets/images/products/product1551864171.jpg" alt="Your Avatar" height="150"> ',
        overwriteInitial: true,
        showRemove: false,
        removeLabel: '',
        autoOrientImage: false,
        uploadAsync: false
    });

    $("form").submit(function(){
        var err = $(this).find(".kv-fileinput-error").text();

        if ($.trim(err)) {
            // do something
            return false;
        }
    });
</script>
@endsection