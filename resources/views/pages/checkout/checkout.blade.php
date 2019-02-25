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
										<option value="{{$provinsi->name}}" {{ (Input::old("province") == $provinsi->name ? "selected":"") }} >{{$provinsi->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="p-10">
								  <div class="form-row">

								    <div class="form-group col-md-4">
								      <label for="inputregency">Regency</label><!-- Kota -->

								      <select form="insert_order" name="regency" id="regency" class="form-control">
								        
								      </select>
								    </div>

								    <div class="form-group col-md-4">
								      <label for="inputState">District</label>
								      <select form="insert_order"  name="district" id="district" class="form-control">
								        
								      </select>
								    </div>

								    <div class="form-group col-md-2">
								      <label for="inputZip">Village</label>
								      <select form="insert_order"  name="village" id="village" class="form-control">
								        <
								      	
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

												  <input type="text" name="coupon_code"  form="check_coupon" id="check_coupon" value="" class="form-control" placeholder="Check Code">

												  <input type="hidden" name="coupon_code"  form="insert_order" id="coupon_code" value="" class="form-control" placeholder="Enter Code">

												  <div class="input-group-append">
												  	<input type="submit" name="submit" value="Check" form="check_coupon" class="btn btn-outline-secondary" >
												  </div>

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
												@if (Session::has('discount'))
										          	<p>Discount 	= -{{ Session::get('discount') }}</p>
										        @endif
												-------------------------------------------
												@if (Session::has('discount'))
												<?php $discount = Cart::subtotal(null,null,'')-Session::get('discount')+9000 ?>
										          	<p>Grand Total 	= {{$discount}}</p>
										        @else
										        <?php $discount = Cart::subtotal(null,null,'')+9000 ?>
										        	<p>Grand Total 	= {{$discount}}</p>
										        @endif
												
												
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
	$(document).ready( function () {
	    $('#cartxtable').Dataxtable();
	} );
</script>

<script  type="text/javascript">
	$('#province').on('change',function(e){
      console.log(e);

      var province_id = e.target.value;

      // ajax 
      $.ajax({
              url: "{{url("ajax-regency")}}",
              data: "province_id="+province_id,
              cache: false,
              success: function(data){
                  alert(data)
         
              },
                  error:function(data){
                    $('.statusbypass').html("ID DMS Tidak Ada / Sudah Selesai");
                    $('.valuestatus').html("");
                    console.log("failed"); 
                  }
            });

    });
</script>
@endsection