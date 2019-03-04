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
				<h1>Rp. {{ $transaction->total }}</h1>
			</div>

			div



				<h4>id_order : {{ $transaction->id_order }}</h4>
				<h4>id_customer : {{ $transaction->id_customer }}</h4>
				<h4>id_coupon : {{ $transaction->id_coupon }}</h4>
				<h4>total : {{ $transaction->total }}</h4>
				<h4>discount_type : {{ $transaction->discount_type }}</h4>
				<h4>discount : {{ $transaction->discount }}</h4>
				<h4>grand_total : {{ $transaction->grand_total }}</h4>
				<h4>date_order : {{ $transaction->date_order }}</h4>
				<h4>is_active : {{ $transaction->is_active }}</h4>
				<br>
				<br>
				<br>
				@foreach($detail as $detil)
				<p>{{$detil->id_product}}</p>
				@endforeach

			</div>

		</div>
	</div>


	
</div>


@endsection

@section('script')

@endsection