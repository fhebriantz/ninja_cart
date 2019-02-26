@extends('layouts.layout')
@section('head')
	<title>Transaksi Order</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')

<?php 
use Illuminate\Support\Facades\Input; ?>

<div class="container">
	<div class="col-sm-12"">
		<div class="row">
			<div class="col-sm-12 mt-sm-5
			">
				<div class="row">

					<!-- Form Start ============================================================= Form Start -->
					@if ($errors->any())
			            <div class="alert alert-danger">
			              <ul>
			                @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			                @endforeach
			              </ul>
			          </div>
			        @endif
					
					<form id="check_coupon" method="POST" action="{{url('/check_coupon')}}">
						{{ csrf_field() }}
					</form>
					<!-- Form End  ============================================================= Form End-->


					<!-- Form ============= Insert Biodata Start -->
					<div class="card_box">
						<div class="col-sm-12">
							<h3 class="mb-sm-4">Biodata</h3>

							<div class="p-10">
								<div class="form-group">
									<label for="">Full Name</label>
									<input form="insert_order"  type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Phone Number</label>
									<input form="insert_order"  type="number" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">E-Mail</label>
									<input form="insert_order"  type="email" name="email" class="form-control" value="{{ old('email') }}">
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Gender</label>
									<select form="insert_order" name="gender" class="form-control" id="">
										<option>Select Gender ...</option>
										<option value="Man" {{ (Input::old("gender") == "Man" ? "selected":"") }} >Man</option>
										<option value="Woman" {{ (Input::old("gender") == "Woman" ? "selected":"") }} >Woman</option>
									</select>
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Address</label>
									<textarea name="address" form="insert_order" id="" cols="30" class="form-control" rows="3">{{ old('address') }}</textarea>
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Provinces</label>
									<select form="insert_order" id="province" name="province" class="form-control" >
										<option>Select Provinces ...</option>
										@foreach($provinces as $provinsi)
										<option value="{{$provinsi->id}}" {{ (Input::old("province") == $provinsi->id ? "selected":"") }} >{{$provinsi->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="p-10">
								  <div class="form-row">

								    <div class="form-group col-md-4">
								      <label for="inputregency">Regency</label><!-- Kota -->

								      <select form="insert_order" name="regency" id="regency" class="form-control">
								        <option value="">Select Regency ...</option>
								      </select>
								    </div>

								    <div class="form-group col-md-4">
								      <label for="inputState">District</label>
								      <select form="insert_order"  name="district" id="district" class="form-control">
								        <option value="district">Select District ...</option>
								      </select>
								    </div>

								    <div class="form-group col-md-2">
								      <label for="inputZip">Village</label>
								      <select form="insert_order"  name="village" id="village" class="form-control">
								        <option value="village">Select Village ...</option>
								      	
									  </select>
								    </div>

								    <div class="form-group col-md-2">
								      <label for="inputZip">Zip</label>
								      <input form="insert_order" value="{{ old('zipcode') }}" maxlength="15" name="zipcode" type="text" class="form-control" id="inputZip">
								    </div>
								  </div>
							</div>

						</div>
					</div>
					<!-- form ============= Insert Biodata End -->

					<div class="card_box">
						<div class="col-sm-12">
							<h3 class="mb-sm-4">Transaksi Order</h3>

							<div class="p-10">

								<div class="form-group">
									<div class="xtable mb-sm-4" id="results">

									  <div class='theader'>
									    <div class='xtable_header'>Product</div>
									    <div class='xtable_header'>Qty</div>
									    <div class='xtable_header'>Price</div>
									    <div class='xtable_header'>Sub Total</div>
									  </div>

									@foreach (Cart::content() as $cart)

									  <div class='xtable_row'>

									    <div class='xtable_small'>
									      <div class='xtable_cell'>Product</div>
									      <div class='xtable_cell'>{{$cart->name}}</div>
									    </div>

									    <div class='xtable_small'>
									      <div class='xtable_cell'>Qty</div>
									      <div class='xtable_cell'>{{$cart->qty}}</div>
									    </div>

									    <div class='xtable_small'>
									      <div class='xtable_cell'>Price</div>
									      <div class='xtable_cell'>{{$cart->price}}</div>
									    </div>

									    <div class='xtable_small'>
									      <div class='xtable_cell'>Sub Total</div>
									      <div class='xtable_cell'>{{$cart->subtotal}}</div>
									    </div>

									  </div>
									@endforeach

									</div>

									<div class="checkout_box">
										<div class="row">
											<div class="col-sm-6">

												<h6 class="mb-sm-2">Kode Voucher</h6>

												<div class="input-group mb-3">

												  <input type="text" name="coupon_code" id="coupon_code"  form="insert_order" value="" class="form-control " placeholder="Enter Code">
													

												  <div class="input-group-append">
												  	<button id="check_coupon" class="btn btn-outline-secondary ">Check</button>
												  </div>

												</div>
												<div id="statuscoupon">
													
												</div>
												@if (Session::has('success_msg'))
										          	<p class="text-success m-0">{{ Session::get('success_msg') }}</p>
										        @elseif (Session::has('failed_msg'))
										        	<p class="text-danger m-0">{{ Session::get('failed_msg') }}</p>
										        @endif

											</div>

											<div class="col-sm-6">
												<table>
													<th>
														
													</th>
												</table>
												<p>Total 		= {{Cart::subtotal()}}</p>
												<p>Pengiriman 	= 9000</p>
												<div id="discount">
												<p>Discount 	= -0</p>
												</div>
												-------------------------------------------
												<div id="grandtotal">
													<p>Grand total = {{Cart::subtotal(null,null,'')+9000}}</p> 
												</div>
												
												
											</div>
										</div>
									</div>

									
								</div>
								
								<form id="insert_order" method="POST" action="{{url('/insert_order')}}">
									{{ csrf_field() }}
									<div class="g-recaptcha"   data-sitekey="6LcKk5MUAAAAAPFX6OJ8R_LL6R7jt255mtrW3wWv"></div>
									<input type="hidden" form="insert_order" name="_token" value="{{ csrf_token() }}">
								</form>

								<p style="padding-top: 10px; color: red"><strong>{{ session('captcha')}}</strong></p>
								<input type="submit" name="submit" value="Bayar" form="insert_order">

							</div>

						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

	
</div>


@endsection

@section('script')
<script type="text/javascript">
	$('#province').on('change',function(e){
      console.log(e);

      var province_id = e.target.value;

      // ajax
      $.get('ajax-province?province_id=' + province_id, function(data){
        // success data
        $('#regency').empty();
        $('#regency').append('<option value="">Select Regency ...</option>');
        $.each(data, function(index, regencyObj){

          $('#regency').append('<option value="'+regencyObj.id+'" >'+regencyObj.name+'</option>');

        });

      });

    });
</script>

<script type="text/javascript">
	$('#regency').on('change',function(e){
      console.log(e);

      var regency_id = e.target.value;

      // ajax
      $.get('ajax-regency?regency_id=' + regency_id, function(data){
        // success data
        $('#district').empty();
        $('#district').append('<option value="">Select District ...</option>');
        $.each(data, function(index, districtObj){

          $('#district').append('<option value="'+districtObj.id+'">'+districtObj.name+'</option>');

        });

      });

    });
</script>

<script type="text/javascript">
	$('#district').on('change',function(e){
      console.log(e);

      var district_id = e.target.value;

      // ajax
      $.get('ajax-district?district_id=' + district_id, function(data){
        // success data
        $('#village').empty();
        $('#village').append('<option value="">Select District ...</option>');
        $.each(data, function(index, villageObj){

          $('#village').append('<option value="'+villageObj.id+'">'+villageObj.name+'</option>');

        });

      });

    });
</script>



<script type="text/javascript">
    var htmlobjek;
		    $(document.body).on('click',"#check_coupon",function (e) {
		      coupon_code = $("#coupon_code").val();
		       	$.ajax({
	              url: "{{url("check")}}",
	              data: "coupon_code="+coupon_code,
	              cache: false,
	              	success: function(data){
		              	var coupon_name = data[0];
		              	var type = data[1];
		              	var nominal = data[2];
		              	var total = data[3];
		              	var discount = data[4];
		              	var ongkir = 9000;
		              	var grandtotal = total - discount + ongkir;
		                console.log(data);
		                $('#statuscoupon').html('<p class="text-success m-0">'+coupon_name+'</p>')
		                $('#discount').html('<p>Discount 	= -'+discount+'</p>')
		                $('#grandtotal').html('<p>Grand total = '+grandtotal+'</p> ')
	              },
	              	error:function(data){
	                  	$('#statuscoupon').html('<p class="text-danger m-0">Coupon tidak ditemukan</p>')
	                    console.log("failed"); 
	                    $('#discount').html('<p>Discount 	= -0</p>')
	                  	$('#grandtotal').html('<p>Grand total = {{Cart::subtotal(null,null,'')+9000}}</p> ')
	              	}
	            });
		    });

</script>
@endsection