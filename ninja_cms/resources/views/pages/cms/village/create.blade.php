@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Villages</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Villages <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Villages</h3></div>
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
                    	<form method="POST" action="{{url('/village/create')}}">
						{{ csrf_field() }}
	                        <table class="table">  
                                <tr>
                                    <td>District Name <em style="color:red">*</em></td>
                                    <td>
                                        <select class="itemName form-control selectpicker" style="width:100%;" id="district_id" name="district_id"></select>
                                    </td>
                                </tr>       
                                <tr>
                                    <td>Village Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="name" placeholder="Village Name" value="{{ old('name') }}" style="width: 100%"></td>
                                </tr>         
                                <tr>
                                    <td>Zone <em style="color:red">*</em></td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="zone" style="width: 100%">
                                            <option value="">-- Choose Zone --</option>
                                            @foreach($list_zone as $list)
                                            <option value="{{$list->to_zone}}" {{ (old('zone') == $list->to_zone ? 'selected':'') }} >{{$list->to_zone}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>        
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" {{ (old('status') == '1' ? 'selected':'') }}>Active</option>
                                            <option value="0" {{ (old('status') == '0' ? 'selected':'') }}>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 
                                <!--<tr>
                                    <td>Description</td>
                                    <td><textarea id="summernote" name="desc">{{ old('desc') }}</textarea></td>
                                </tr>-->

								<tr>
									<td></td>
									<td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/village')}}" style="text-decoration: none;">Back</a>
                                    </td>
								</tr>
	                        </table>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 34px !important;}
.select2-container .select2-selection--single {height: 34px !important;font-size:14px !important}
.select2-container--default .select2-selection--single .select2-selection__arrow {height: 34px !important;}
</style>
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('.itemName').select2({
        placeholder: '-- Choose District --',
        ajax: 
        {
            url: "{{ url('village/list_ajax') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                                return {
                                    results:  $.map(data, function (item) {
                                        return {
                                            text: item.name,
                                            id: item.id
                                        }
                                    })
                                };
                            },
            cache: true
        }
    });

    $(document).ready(function() {
        const districtOldValue = '{{ old('district_id') }}';
        if(districtOldValue !== '') { 
            $("#district_id option").remove();

            $.ajax({
                 type: "GET",
                 url: "{{ url('village/init_list_ajax') }}",
                 data: "old_val=" + districtOldValue,
                 success: function(response){
                     $("#district_id").append("<option value='" + districtOldValue + "'>" + response + "</option>");
                 }
            });
        };
    });
</script>
@endsection