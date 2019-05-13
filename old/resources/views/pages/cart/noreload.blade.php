@extends('layouts.layout')
@section('head')
	<title>No reload</title>
@endsection

@section('content')
<div class="container ">
	<form id="prospects_form" class="mt-sm-5"  >
			{{ csrf_field() }}
				
		<input type="text" id="usergroup" value="" placeholder="usergroup" name="usergroup">
		<input type="submit" class="btn btn-secondary" value="submit">
	</form>
	<p>
		<?php echo Cart::subtotal() ;?>
	</p>

	<div id="test">
		
	</div>
	
</div>
@endsection

@section('script')
<script>
	$("#prospects_form").submit(function(e) {
	    e.preventDefault();
	    $.ajax({
	              url: "{{url('/noreloads')}}",
	              data: $("#prospects_form").serialize(),
	              type : "POST",
	              cache: false,
	              success: function(data){
	              		console.log(data);
	              		$('#test').html('');
	              		$('#test').html('<?php echo Cart::subtotal() ;?>');
	              },
	              	error:function(data){
	                  	alert('gagal');
	              	}
	            });
	});
</script>

@endsection
