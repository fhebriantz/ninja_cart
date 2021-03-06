@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Coupon</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Coupon <span class="fa-angle-right fa"></span> View</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Coupon</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table class="table">    
                            <tr>
                                <td>Coupon Code</td>
                                <td><input type="text" class="form-control" name="coupon_code" value="{{ $data_coupon->coupon_code }}" style="width: 100%" readonly=""></td>
                            </tr>    
                            <tr>
                                <td>Coupon Name</td>
                                <td><input type="text" class="form-control" name="coupon_name" value="{{ $data_coupon->coupon_name }}" style="width: 100%" readonly=""></td>
                            </tr>   
                            <tr>
                                <td>Description</td>
                                <td><textarea class="form-control" name="description" style="width: 100%" readonly="">{{ $data_coupon->description }}</textarea></td>
                            </tr> 
                            <tr>
                                <td>Quota</td>
                                <td><input type="text" class="form-control" name="quota" value="{{ $data_coupon->quota }}" style="width: 100%" readonly=""></td>
                            </tr> 
                            <tr>
                                <td>Used Quota</td>
                                <td><input type="text" class="form-control" name="quota" value="{{ $data_coupon->quota_used }}" style="width: 100%" readonly=""></td>
                            </tr> 
                            <tr>
                                <td>Nominal</td>
                                <td><input type="text" class="form-control" name="nominal" value="{{ $data_coupon->nominal }}" style="width: 100%" readonly=""></td>
                            </tr>              
                            <tr>
                                <td>Start Date</td>
                                <td>
                                    <div class='input-group date datetimepicker1'>
                                        <input type='text' class="form-control" name="start_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="{{ $data_coupon->start_date }}" readonly="">
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
                                        <input type='text' class="form-control" name="end_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="{{ $data_coupon->end_date }}" readonly="">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>     
                            <tr>
                                <td>Status</td>
                                <td><input type="text"  class="form-control" name="status" value="{{ $data_coupon->is_active=='1' ? 'Active':'Inactive' }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Created Date</td>
                                <td><input type="text"  class="form-control" name="created_at" value="{{ $data_coupon->created_at }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td><input type="text"  class="form-control" name="created_by" value="{{ $data_coupon->created_by }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Modified Date</td>
                                <td><input type="text"  class="form-control" name="updated_at" value="{{ $data_coupon->updated_at }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><input type="text"  class="form-control" name="updated_by" value="{{ $data_coupon->updated_by }}" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a class="btn btn-danger" href="{{url('/coupon')}}"  style="text-decoration: none;">Back</a>
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