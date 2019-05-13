@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Shipment</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Shipment <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Shipment</h3></div>
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
                    	<form method="POST" action="{{url('/shipment/'.$data_shipment->id.'/edit')}}">
						{{ csrf_field() }}
	                        <table class="table">     
                                <tr>
                                    <td>From Zone <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="from_zone" placeholder="Code of Zone" value="{{ $data_shipment->from_zone }}" style="width: 100%" ></td>
                                </tr>  
                                <tr>
                                    <td>To Zone <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="to_zone" placeholder="Code of Zone" value="{{ $data_shipment->to_zone }}" style="width: 100%"></td>
                                </tr>    
                                <tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="{{ $data_shipment->price }}" style="width: 100%"></td>
                                </tr>    
                                <tr>
                                    <td>SLA <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="sla" placeholder="1-2" value="{{ $data_shipment->sla }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="1" {{ ($data_shipment->is_active=='1' ? 'Selected':'') }} >Active</option>
                                            <option value="0" {{ ($data_shipment->is_active=='0' ? 'Selected':'') }} >Inactive</option>
                                        </select>
                                    </td>
                                </tr>   

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="{{url('/shipment')}}"  style="text-decoration: none;">Back</a>
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
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@endsection