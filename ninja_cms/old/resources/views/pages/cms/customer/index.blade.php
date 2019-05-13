@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Customer</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Customer</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Customer</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_customer as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->fullname}}</td>
                                    <td>{!!$data->address!!}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                        <a href="{{url('/customer/'.$data->id.'/view')}}" style="margin-bottom: 5px"><button type="button" class="btn btn-primary" style="margin-bottom: 5px">View</button></a>
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