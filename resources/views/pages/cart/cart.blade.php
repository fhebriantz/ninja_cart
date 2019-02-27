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
			@if (Session::has('success_msg'))
	          	<div class="alert alert-success">{{ Session::get('success_msg') }}</div>
	        @elseif (Session::has('failed_msg'))
	        	<div class="alert alert-danger">{{ Session::get('failed_msg') }}</div>
	        @endif
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

							<input type="hidden" name="id_product" id="id_product{{$prod->id}}" value="{{$prod->id}}">

							<td class="padding_row" ><input class="qty{{$prod->id}} widthqty" value="1" min="1" type="number" id="qty_{{$prod->id}}" name="qty"></td>

							<td class="padding_row" >
								<button  data-id_product="{{$prod->id}}" class=" buy">Buy</button>
							</td>

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>


			<div class="col-sm-12 mt-sm-3">
				<h1>Transaksi Order / Cart</h1>
				<br>
				<table id="carttable" class="table table-hover">
					 <thead>
					    <tr>
							<th scope="col" >Nama Produk</th>
							<th scope="col" >Qty</th>
							<th scope="col" >Harga</th>
							<th scope="col" >Sub Total</th>
							<th></th>

						</tr>
					</thead>
					<div id="ubah">

						<tbody>

							<!-- <div id="append_cart"> -->

								  @foreach (Cart::content() as $cart) 
									<tr id="rowcart{{$cart->id}}" class="height_row">
										<td class="padding_row"><?php echo $cart->name?></td>
						           		<td class="padding_row" >
						           			
												<input type="text" name="qty" id="cartqty_<?php echo $cart->rowId?>" class="widthqty" value="<?php echo $cart->qty?>">

												<input type="hidden" name="rowId" value="<?php echo $cart->rowId?>">

												<button  data-rowid="<?php echo $cart->rowId?>"  class="changeqty">change</button>
											
										</td>
						           		<td class="padding_row" ><?php echo $cart->price; ?></td>
						           		<td class="padding_row" ><?php echo $cart->subtotal; ?></td>
						           		<td class="padding_row"><a href="<?php echo url("/deletecart/".$cart->rowId)?>">X</a></td>
									</tr>
								 @endforeach  

							<!-- </div> -->

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

					</div>
				</table>
				<a class="btn btn-danger" onclick="return confirm();" href="{{url('/destroy')}}">Destroy Cart </a>
				<a class="btn btn-primary" data-fancybox data-src="#lanjut" href="javascript:;" >Lanjutkan Pembayaran </a>
			</div>

			<div id="lanjut" style="display: none;">
				<div style="width: 350px">
					
				</div>
				<a class="btn btn-danger" style="width: 49%; color: white;" onclick="$.fancybox.close()">Batal</a>
				<a class="btn btn-primary" style="width: 49%;" href="{{url('/checkout')}}">Lanjut</a>
			</div>


		</div>
	</div>


	
</div>


@endsection

@section('script')
<script type="text/javascript">
    var htmlobjek;
		    $(document.body).on('click',".buy",function (e) {
		      id_product = $(this).data('id_product');
		      qty = $("#qty_"+id_product).val();
		       	$.ajax({
	              url: "{{url('/buy')}}",
	              data: { id_product: id_product, qty: qty },
	              cache: false,
	              success: function(data){

	              		if ($('#rowcart'+id_product).length)
						{
						 var obj = data[0].data;
						 alert(obj[rowId]);
						}
						else
						{
						 	$('#carttable tbody').append('<tr class="height_row"><td class="padding_row">'+data[0].rowId+'</td><td class="padding_row" ><input type="text" name="qty" id="cartqty_rowId" class="widthqty" value="qty"><input type="hidden" name="rowId" value="rowId"><button  data-rowid="rowId"  class="changeqty">change</button></td><td class="padding_row" >price</td><td class="padding_row" >subtotal</td><td class="padding_row"><a href="fungsi delete">X</a></td></tr>');
						}

                  		// validasi id
                  		// $('#carttable tbody').html("");

                  		// @foreach (Cart::content() as $cart)
                  		// $('#carttable tbody').append('<tr class="height_row"><td class="padding_row"><?php echo $cart->name?></td><td class="padding_row" ><input type="text" name="qty" id="cartqty_<?php echo $cart->rowId?>" class="widthqty" value="<?php echo $cart->qty?>"><input type="hidden" name="rowId" value="<?php echo $cart->rowId?>"><button  data-rowid="<?php echo $cart->rowId?>"  class="changeqty">change</button></td><td class="padding_row" ><?php echo $cart->price; ?></td><td class="padding_row" ><?php echo $cart->subtotal; ?></td><td class="padding_row"><a href="fungsi delete">X</a></td></tr>');
                  		// @endforeach

	              },
	              	error:function(data){
	                  	alert('produk gagal dibeli');
	              	}
	            });
		    });

</script>

<script type="text/javascript">
    var htmlobjek;
		    $(document.body).on('click',".changeqty",function (e) {
		      rowId = $(this).data('rowid');
		      qty = $("#cartqty_"+rowId).val();
		       	$.ajax({
	              url: "{{url('/changeqty')}}",
	              data: { rowId: rowId, qty: qty },
	              cache: false,
	              success: function(data){
	              		alert('qty sudah diubah');
	              },
	              	error:function(data){
	                  	alert('qty gagal diubah');
	              	}
	            });
		    });

</script>
@endsection