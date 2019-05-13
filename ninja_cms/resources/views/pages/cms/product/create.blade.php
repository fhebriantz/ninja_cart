@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Product</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Product <span class="fa-angle-right fa"></span> Create</p>
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
                    	<form method="POST" action="{{url('/product/create')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
	                        <table class="table">  
                                <tr>
                                    <td>Product Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="product_name" placeholder="Product name" value="{{ old('product_name') }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="{{ old('price') }}" style="width: 100%"></td>
                                </tr>              
	                            <tr>
									<td>SKU</td>
									<td><input type="text"  class="form-control" name="sku" placeholder="12345678" style="width: 100%" value="{{ old('sku') }}"></td>
								</tr>            
                                <tr>
                                    <td>Weight <em style="color:red">*</em></td>
                                    <td><input type="number" class="form-control" name="weight" placeholder="0" style="width: 100%" value="{{ old('weight') }}"></td>
                                </tr>
                                <tr>
                                    <td>Upload Picture <em style="color:red">*</em></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <!-- <input id="file-1" type="file" name="test_file" multiple class="file" data-show-upload="true" data-overwrite-initial="false" data-theme="fas"> -->
                                                <input id="picture" type="file" name="picture" class="file" data-show-upload="false" data-overwrite-initial="false" data-theme="fas">
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" {{ (old('status') == '1' ? 'selected':'') }}>Active</option>
                                            <option value="0" {{ (old('status') == '0' ? 'selected':'') }}>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 
                               
                                <!--<tr>
                                    <td>Description</td>
                                    <td><textarea id="summernote" name="desc"></textarea></td>
                                </tr>-->

								<tr>
									<td></td>
									<td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/product')}}"  style="text-decoration: none;">Back</a>
                                    </td>
								</tr>
	                        </table>
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
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 2000,
        maxFilesNum: 1,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
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