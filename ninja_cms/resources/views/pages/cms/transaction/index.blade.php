@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Transaction</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Transaction</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Transaction</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Order</th>
                                    <th>Customer Name</th>
                                    <th>Date Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_transaction as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->id_order}}</td>
                                    <td>{{$data->fullname}}</td>
                                    <td>{{$data->date_order}}</td>
                                    <td>
                                        <a href="{{url('/transaction/'.$data->id_order.'/view')}}"><button type="button" class="btn btn-primary">View</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection