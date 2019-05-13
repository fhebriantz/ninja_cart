@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Transaction</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Transaction <span class="fa-angle-right fa"></span> View</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Transaction</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table class="table">       
                            <tr>
                                <td>ID Order</td>
                                <td><input type="text" class="form-control" name="fullname"  value="{{ $header->fullname }}" style="width: 100%" readonly></td>
                            </tr>                     
                            <tr>
                                <td>Date Order</td>
                                <td><input type="text"  class="form-control" name="date_order" value="{{ $header->date_order }}" style="width: 100%" readonly></td>
                            </tr>    
                            <tr>
                                <td>Customer Name</td>
                                <td><input type="text" class="form-control" name="fullname"  value="{{ $header->fullname }}" style="width: 100%" readonly></td>
                            </tr>           
                            <tr>
                                <td>Address</td>
                                <td><textarea type="text" class="form-control" name="address" style="width: 100%" readonly>{{ $header->address }}</textarea></td>
                            </tr>  
                            <tr>
                                <td></td>
                                <td>
                                    <a class="btn btn-danger" href="{{url('/transaction')}}" style="text-decoration: none;">Back</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel-body">
                    <h4>List of Transaction Detail:</h4>
                    <div class="responsive-table">
                        <table id="datatables-example1" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($detail as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->product_name}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>Rp {{number_format($data->price)}}</td>
                                    <td>Rp {{number_format($data->qty * $data->price)}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        $('#datatables-example1').DataTable( {
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\Rp,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                total = addCommas(total);
     
                // Total over this page
                pageTotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                pageTotal = addCommas(pageTotal);
     
                // Update footer
                $( api.column( 4 ).footer() ).html(
                     'Rp '+ pageTotal +' ( Rp '+ total +' total)'
                );
            }
        } );
    } );
</script>
@endsection