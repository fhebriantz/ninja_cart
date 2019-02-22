@extends('layouts.layout')
@section('head')
	<title>Transaksi Order</title>
@endsection

@section('content')

<div class="container">
	<div class="col-sm-12"">
		<div class="row">
			<div class="col-sm-12 mt-sm-5
			">
				<div class="row">

					<!-- Form Start ============================================================= Form Start -->
					<form id="insert_biodata" method="POST" action="{{url('/insert_biodata')}}">
						{{ csrf_field() }}
					</form>
					<form id="insert_coupon" method="POST" action="{{url('/insert_coupon')}}">
						{{ csrf_field() }}
					</form>
					<!-- Form End  ============================================================= Form End-->
					<form  method="POST" action="{{url('/insert_coupon')}}">
						{{ csrf_field() }}
						<input type="hidden" value="3" name="id">
						<input type="submit" value="submit" name="submit">
					</form>
					<!-- Form ============= Insert Biodata Start -->
					<div class="card_box">
						<div class="col-sm-12">
							<h3 class="mb-sm-4">Biodata</h3>

							<div class="p-10">
								<div class="form-group">
									<label for="">Full Name</label>
									<input form="insert_biodata"  type="text" name="fullname" class="form-control">
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Gender</label>
									<select form="insert_biodata" name="gender" class="form-control" id="">
										<option value="man">Man</option>
										<option value="woman">Woman</option>
									</select>
								</div>
							</div>

							<div class="p-10">
								<div class="form-group">
									<label for="">Address</label>
									<textarea name="address" form="insert_biodata" id="" cols="30" class="form-control" rows="3"></textarea>
								</div>
							</div>

							<div class="p-10">
								  <div class="form-row">
								    <div class="form-group col-md-6">
								      <label for="inputCity">City</label>
								      <input form="insert_biodata" type="text" class="form-control" id="inputCity">
								    </div>
								    <div class="form-group col-md-4">
								      <label for="inputState">State</label>
								      <select form="insert_biodata" id="inputState" class="form-control">
								        <option selected>Choose...</option>
								        <option>...</option>
								      </select>
								    </div>
								    <div class="form-group col-md-2">
								      <label for="inputZip">Zip</label>
								      <input form="insert_biodata" type="text" class="form-control" id="inputZip">
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

												  <input type="text" name="voucher"  form="insert_coupon"  class="form-control" placeholder="Voucher Code">

												  <div class="input-group-append">
												  	<input type="submit" name="submit" value="Submit" form="insert_coupon" class="btn btn-outline-secondary" >
												  </div>

												</div>

												<p class="text-success m-0">Kode Voucher Diskon 10% </p>
												<p class="text-danger m-0">Kode Voucher Salah </p>

											</div>

											<div class="col-sm-6">
												<p>Total 		= {{Cart::subtotal()}}</p>
												<p>Pengiriman 	= 9000</p>
												-------------------------------------------
												<p>Grand Total 	= {{Cart::subtotal()}}</p>
												
											</div>
										</div>
									</div>

									
								</div>

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
@endsection