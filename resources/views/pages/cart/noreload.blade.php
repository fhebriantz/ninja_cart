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













	<div class="col-sm-12"">
		<div class="row">
			<div class="col-sm-12 mt-sm-5
			">
				<div class="card_box">
					<div class="col-sm-12  text-center">
					@if (Session::has('success_msg'))
			          	<div class="alert alert-success">{{ Session::get('success_msg') }}</div>
			        @elseif (Session::has('failed_msg'))
			        	<div class="alert alert-danger">{{ Session::get('failed_msg') }}</div>
			        @endif
						<br>
						<div class="headpayment">
							<h1>No Order : 123123123213</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos praesentium adipisci soluta voluptatum commodi excepturi, nam eos nulla explicabo placeat fugiat temporibus inventore harum ad nemo? Dicta architecto sequi repellendus!</p>
							
						</div>

						<div class="bank" style="width: 500px">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime nulla explicabo amet voluptatibus ratione numquam soluta commodi, vel consequuntur repellat ad. Non itaque, optio minus omnis quam assumenda voluptatum molestiae.
						</div>


						
						
					</div>
				</div>
				
				
			</div>

		</div>
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
