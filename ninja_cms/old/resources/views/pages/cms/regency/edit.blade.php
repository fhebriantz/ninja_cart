@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Regencies</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Regencies <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Regencies</h3></div>
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
                    	<form method="POST" action="{{url('/regency/'.$data_regency->id.'/edit')}}">
						{{ csrf_field() }}
	                        <table class="table">  
                                <tr>
                                    <td>Province Name </td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="province_id" style="width: 100%" disabled>
                                            <option value="">-- Choose Province --</option>
                                            @foreach($list_province as $list)
                                            <!--<option data-subtext="Rep California">Tom Foolery</option>-->
                                            <option value="{{$list->id}}" {{ ($data_regency->province_id == $list->id ? 'selected':'') }} >{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>       
                                <tr>
                                    <td>Regency Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="name" placeholder="Regency Name" value="{{ $data_regency->name }}" style="width: 100%"></td>
                                </tr>         
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="1" {{ ($data_regency->is_active=='1' ? 'Selected':'') }} >Active</option>
                                            <option value="0" {{ ($data_regency->is_active=='0' ? 'Selected':'') }} >Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="{{url('/regency')}}"  style="text-decoration: none;">Back</a>
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
<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet"/>
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection