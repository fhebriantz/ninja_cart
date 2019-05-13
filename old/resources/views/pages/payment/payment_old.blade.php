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
				<div class="text-center" style="width: 100%">
					<h2>No Order : {{ $transaction->id_order }}</h2>
					<p class="mt-sm-5" style="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi reiciendis nihil, eum expedita nulla. Nostrum quam est minus dolore! Unde iste debitis adipisci corrupti vero tempore doloremque ipsum in corporis! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur animi magnam, nulla quis odio ad cupiditate, dolor totam! Nobis adipisci sit eaque quibusdam assumenda est quidem ipsam. Soluta, nam, explicabo.</p>
					<h4>Silahkan transfer ke :</h4>
						
					
					<div class="bank_payment" > 
						<div class="row">
							<div class="col-sm-1"></div>
							
						<div class="col-sm-5">
							
				        <p>Bank BCA </p>
				        <p>Bank BRI </p>
				        <p>Bank BNI </p>
				        <p>Bank Mandiri </p>
				        <p>Bank Danamon </p>
				        <p>Bank BTN </p>
						</div>
						<div class="col-sm-5">
						<p>98798788789</p>
				        <p>1234564987987</p>
				        <p>156445640</p>
				        <p>90004953545</p>
				        <p>12884566540001</p>
				        <p>00116540010</p>
						</div>
						</div>
				    </div>	
				</div>

				<div class="card_box text-center">
					<h5>Total pembayaran</h5>
					<h1>Rp. {{ number_format($transaction->grand_total,0,'','.') }}</h1>
				</div>

				

				<div class="card_box">
					<h2>Daftar Pembelian</h2>
					<div class="row">
						@foreach($detail as $det)
						<div class="col-sm-12 p-3">
							<div class="row">
								<div class="col-sm-3">
									<div class="imagesquare"><img class="imageproduct" src="{{ asset('image/product/'.$det->image)}}" alt=""></div>	
								</div>
								<div class="col-sm-3">
									<p>{{$det->product_name}}</p>
									<p>Jumlah : {{$det->qty}}</p>
									<p>Berat : {{$det->weight}} gr</p>
								</div>
								<div class="col-sm-3">
									<h4>Rp.  {{number_format($det->price,0,'','.')}}</h4>
								</div>
							</div>
						</div>
						@endforeach


					</div>
					<h2 class="text-right">Total : Rp. {{number_format($transaction->total,0,'','.')}}</h2>

					<h2 class="text-right">Ongkir : Rp. {{number_format(9000,0,'','.')}}</h2>

				</div>


				<div class="alamat">
					<h5>Tujuan Pengiriman</h5>
					<h5>{{$customer->fullname}}</h5>
					<p>{{$customer->address}}</p>
					<p>{{$customer->village}}, {{$customer->district}}, {{$customer->regency}}, {{$customer->zipcode}}</p>
					<p>{{$customer->province}}</p>
					<p>{{$customer->phone_number}}</p>
				</div>

				<div class="bayar text-center" >
					<button id="bayar" data-id_order="{{ $transaction->id_order }}" style="width: 100px; height: auto;">Bayar</button>
				</div>

			</div>

		</div>
	</div>


	
</div>


@endsection

@section('script')
<script type="text/javascript">
    var htmlobjek;
		    $(document.body).on('click',"#bayar",function (e) {
		      id_order = $(this).data('id_order');
		       	$.ajax({
	              url: "{{url('/get_token')}}",
	              data:  {id_order: id_order},
	              cache: false,
	              success: function(data){

	              		var still_active = data[1];
		              	var id_order = data[6];	

	              		console.log(data[6]);
	              		if (still_active==1) {
	              			var access_token = data[2];
		              		var expires = data[3];
		              		var token_type = data[4];
		              		var expires_in = data[5];	
	              		}else{
		              		var ambil = JSON.parse(data[0]);
		              		var access_token = ambil.access_token;
		              		var expires = ambil.expires;
		              		var token_type = ambil.token_type;
		              		var expires_in = ambil.expires_in;	
	              		}

	              		alert(access_token+expires+token_type+expires_in);

	              		$.ajax({
			              url: "{{url('/create_order')}}",
			              data: {still_active: still_active, access_token: access_token, expires: expires , token_type: token_type , expires_in: expires_in , id_order: id_order},
			              cache: false,
			              success: function(dalem){
			              	alert("success dalem");
					      },
			              error:function(dalem){
			                  	alert('gagal');
			              }
			            });


	              	},
	              	error:function(data){
	                  	alert('gagal');
	              	}
	            });
		    });
	
</script>
@endsection