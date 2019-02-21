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
				<h1>Master Product</h1>
				<br>
				<table class="table table-hover">
					 <thead>
					    <tr>
							<th scope="col" >Gambar</th>
							<th scope="col" >Nama Produk</th>
							<th scope="col" >SKU</th>
							<th scope="col" >Harga</th>
							<th scope="col" >Qty</th>
							<th scope="col" >Pilih</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1 ?>
						@foreach ($product as $prod)
						<tr class="height_row">
							<td scope="row" ><div class="imagesquare"><img class="imageproduct" src="{{ asset('image/product/'.$prod->image)}}" alt=""></div></td>
							<td class="padding_row" >{{$prod->product_name}}</td>
							<td class="padding_row" >{{$prod->sku}}</td>
							<td class="padding_row" >{{$prod->product_price}}</td>

							<form method="POST" action="{{url('/buy')}}">
								{{ csrf_field() }}
							<input type="hidden" name="id_product" value="{{$prod->id}}">
							<td class="padding_row" ><input class="qty{{$prod->id}} widthqty" value="1" min="1" type="number" name="qty"></td>
							<td class="padding_row" ><input value="Buy" name="submit" type="submit"></td>

							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>


			<div class="col-sm-12 mt-sm-3">
				<h1>Transaksi Order / Cart</h1>
				<br>
				<table class="table table-hover">
					 <thead>
					    <tr>
							<th scope="col" >No</th>
							<th scope="col" >Nama Produk</th>
							<th scope="col" >Qty</th>
							<th scope="col" >Harga</th>
							<th scope="col" >Sub Total</th>
							<th></th>

						</tr>
					</thead>
					<tbody>
						<?php $no = 1 ?>
						@foreach (Cart::content() as $cart)
						<tr class="height_row">
							<td class="padding_row" scope="row" >{{$no++}}</td>
							<td class="padding_row">{{$cart->name}}</td>
			           		<td class="padding_row" >
			           			<form method="POST" action="{{url('/changeqty')}}">
									{{ csrf_field() }}
									<input type="text" name="qty" class="widthqty" value="{{$cart->qty}}">
									<input type="hidden" name="rowId" value="{{$cart->rowId}}">
									<input value="Change" name="submit" type="submit">
								</form>
							</td>
			           		<td class="padding_row" ><?php echo $cart->price; ?></td>
			           		<td class="padding_row" ><?php echo $cart->subtotal; ?></td>
			           		<td class="padding_row"><a href="{{url('/deletecart/'.$cart->rowId)}}">X</a></td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><strong>Total</strong></td>
							<td><strong>{{Cart::subtotal()}}</strong></td>
						</tr>
					</tfoot>
				</table>
				<a class="btn btn-danger" onclick="return confirm();" href="{{url('/destroy')}}">Destroy Cart </a>
				<a class="btn btn-success" onclick="return confirm();" href="{{url('/checkout')}}">Lanjutkan Pembayaran </a>
			</div>


		</div>
	</div>

	
</div>


@endsection

@section('script')
<script type="text/javascript">
	$(document).ready( function () {
	    $('#cartTable').DataTable();
	} );
</script>
@endsection