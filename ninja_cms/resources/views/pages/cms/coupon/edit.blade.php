@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Coupon</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Coupon <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Coupon</h3></div>
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
                    	<form method="POST" action="{{url('/coupon/'.$data_coupon->id.'/edit')}}">
						{{ csrf_field() }}
	                        <table class="table">     
                                <tr>
                                    <td>Coupon Code <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="coupon_code" placeholder="CODE" value="{{ $data_coupon->coupon_code }}" style="width: 100%" readonly=""></td>
                                </tr>    
                                <tr>
                                    <td>Coupon Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="coupon_name" placeholder="Coupon Name" value="{{ $data_coupon->coupon_name }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Description</td>
                                    <td><textarea class="form-control" name="description" placeholder="Description" style="width: 100%">{{ $data_coupon->description }}</textarea></td>
                                </tr> 
                                <tr>
                                    <td>Quota <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="quota" placeholder="0" value="{{ $data_coupon->quota }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Nominal <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="nominal" placeholder="0" value="{{ $data_coupon->nominal }}" style="width: 100%"></td>
                                </tr>              
                                <tr>
                                    <td>Start Date</td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="start_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="{{ $data_coupon->start_date }}" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>

                                </tr>            
                                <tr>
                                    <td>End Date</td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="end_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="{{ $data_coupon->end_date }}" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="1" {{ ($data_coupon->is_active=='1' ? 'Selected':'') }} >Active</option>
                                            <option value="0" {{ ($data_coupon->is_active=='0' ? 'Selected':'') }} >Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="{{url('/coupon')}}"  style="text-decoration: none;">Back</a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('.datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD hh:mm:ss'
            });
    });
</script>
@endsection