@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Shipment</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Shipment</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Shipment</h3>  <a href="{{url('/shipment/create')}}"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Shipment</button></a></div>
                <div class="panel-body">
                    <div class="responsive-table">

                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>From Zone</th>
                                    <th>To Zone</th>
                                    <th>Price</th>
                                    <th>SLA</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Modified By</th>
                                    <th>Modified Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_shipment as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->from_zone}}</td>
                                    <td>{{$data->to_zone}}</td>
                                    <td>{{ number_format($data->price) }}</td>
                                    <td>{{$data->sla}}</td>
                                    <td>{{ $data->is_active=='1' ? 'Active':'Inactive' }}</td>
                                    <td>{{$data->created_by}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->updated_by}}</td>
                                    <td>{{$data->updated_at}}</td>
                                    <td>
                                        <a href="{{url('/shipment/'.$data->id.'/edit')}}"><button type="button" style="margin-bottom: 5px;" class="btn btn-warning">Edit</button></a>
                                        <form method="POST" action="{{url('/shipment/'.$data->id.'/delete')}}">
                                            <!-- csrf perlu ditambahakan di setiap post -->
                                            {{ csrf_field() }}
                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure want to delete caption zone {{$data->from_zone}}-{{$data->to_zone}}?');"> 
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
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