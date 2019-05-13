@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Regencies</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Regencies</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Regencies</h3>  <a href="{{url('/regency/create')}}"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Regency</button></a></div>
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
                                    <th>Province Name</th>
                                    <th>Regency Name</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Modified By</th>
                                    <th>Modified Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_regency as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->province_name}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{ $data->is_active=='1' ? 'Active':'Inactive' }}</td>
                                    <td>{{$data->created_by}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->updated_by}}</td>
                                    <td>{{$data->updated_at}}</td>
                                    <td>
                                        <a href="{{url('/regency/'.$data->id.'/edit')}}"><button type="button" class="btn btn-warning" style="margin-bottom: 5px">Edit</button></a>
                                        <form method="POST" action="{{url('/regency/'.$data->id.'/delete')}}">
                                            <!-- csrf perlu ditambahakan di setiap post -->
                                            {{ csrf_field() }}
                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure want to delete caption {{$data->name}}?');"> 
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