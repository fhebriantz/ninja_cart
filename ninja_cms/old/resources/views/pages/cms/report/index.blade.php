@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Report</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Report</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Report</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div id="msg-error" class="alert alert-danger" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="GET" action="{{url('/report')}}">
                        <!-- {{ csrf_field() }} -->
                            <table class="table">  
                                <tr>
                                    <td colspan="4" align="left">
                                        Search by Date Range:
                                    </td>
                                </tr>
                                <tr>
                                    <td>From <em style="color:red">*</em></td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="from_date" placeholder="YYYY-MM-DD" value="{{ old('from_date') }}" id="from_date">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>

                                    <td>To <em style="color:red">*</em></td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="to_date" placeholder="YYYY-MM-DD" value="{{ old('to_date') }}" id="to_date">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>  
                                <tr>
                                    <td colspan="4" align="left">
                                        <input id="submit" class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <!-- <a href="{{ route('searchReport', ['from_date' => '', 'to_date' => ''] ) }}">Test</a> -->
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br/>
                        @if(!empty($data_report))
                        <table id="datatables-report" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Order</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>Kodepos</th>
                                    <th>Date Order</th>
                                    <th>SKU/Item Code</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price per Unit</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_report as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->id_order}}</td>
                                    <td>{{$data->fullname}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone_number}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->province}}</td>
                                    <td>{{$data->regency}}</td>
                                    <td>{{$data->district}}</td>
                                    <td>{{$data->village}}</td>
                                    <td>{{$data->zipcode}}</td>
                                    <td>{{$data->date_order}}</td>
                                    <td>{{$data->sku}}</td>
                                    <td>{{$data->product_name}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->price}}</td>
                                    <td>{{$data->qty * $data->price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
    $(function () {
        $('.datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $(document).ready(function(){
        $('#datatables-report').DataTable( {
            "scrollX": true,
            dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
            buttons: [
                'csv', 'excel'
            ]
        } );

        $("#submit").click(function(){  
            $("#msg-error").css('display','none');
            $("#msg-error").html("");

            var val_from = $("#from_date").val();
            var val_to = $("#to_date").val();

            if(val_from=='' || val_to=='')
            {
                $("#msg-error").css('display','block').append('<ul></ul>');

                if(val_to=='') $("#msg-error").find('ul').append('<li>The to date field is required.</li>');
                if(val_from=='') $("#msg-error").find('ul').append('<li>The from date field is required.</li>');

                return false;
            }
        });
    });

    
</script>
@endsection