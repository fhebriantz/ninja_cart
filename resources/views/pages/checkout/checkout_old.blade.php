<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->

  <!-- Site Properties -->
  <title>Fiber Creme - Shopping Cart</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/parsley.css?v=0.02')}}">

  <script src='https://www.google.com/recaptcha/api.js'></script>
  @include('include_cart/head')
   
</head>

<?php 
use Illuminate\Support\Facades\Input; ?>

<body>
<div class="ui inverted menu fiber">
  <div class="ui container">
    <a href="{{url('/')}}" class="header item">
      <img class="logo" src="{{ asset('image/logo.png')}}">
    </a>
  </div>
</div>
<div class="checkout">
	<div class="ui container">

					@if ($errors->any())
			            <div class="alert alert-danger">
			              <ul>
			                @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			                @endforeach
			              </ul>
			          </div>
			        @endif

			        @if (Session::has('success_api'))
			            <div class="alert alert-success">{{ Session::get('success_api') }}</div>
			        @elseif (Session::has('failed_api'))
			            <div class="alert alert-danger">{{ Session::get('failed_api') }}</div>
			        @endif

			        <form id="check_coupon" method="POST" action="{{url('/check_coupon')}}">
						{{ csrf_field() }}
					</form>

					<form id="insert_order"  method="POST"  action="{{url('/insert_order')}}">
						{{ csrf_field() }}
		<div class="ui stackable grid">
      		<div class="ten wide column">
						<div class="ui styled fluid accordion">
						  <div id="title-1" class="title active">
						    <i class="dropdown icon"></i>
						    DAFTAR BELANJA
						  </div>
						  <div id="content-1" class="content active">
						    <div id="visible-1" class="form-content ui form transition visible">
						    	<table class="ui very basic table totalproduk">
						    		  <thead>
									    <tr>
									      <th colspan="3">Total produk : {{Cart::count()}} items </th>
									    </tr>
									  </thead>		
									  <tbody>
									  	@foreach (Cart::content() as $cart)
									    <tr>
									      <td width="40%">
									        {{$cart->name}}
									      </td>
									      <td>{{$cart->qty}} x Rp. {{number_format($cart->price,0,'','.')}}</td>
									      <td style="text-align: right;">Rp. {{number_format($cart->subtotal,0,'','.')}}</td>
									    </tr>
									    @endforeach
									    
									  </tbody>
									  <tfoot>
									  	<tr>
									  		<td colspan="2">Total Harga</td>
									  		<td>Rp. {{Cart::subtotal(0,',','.')}}</td>
									  	</tr>
									  </tfoot>
									</table>
						    </div>
						  </div>	
						  <div id="title-2" class="title">
						    <i class="dropdown icon"></i>
						    ALAMAT PENGIRIMAN
						  </div>
						  <div id="content-2" class="content">
						    <div id="visible-2" class="form-content ui form transition hidden">
						    	  <div class="two fields">	
									  <div class="field">
									    <label>Nama Lengkap</label>
								        <input placeholder="Nama Lengkap"  type="text" name="fullname" id="fullname" class="" value="{{ old('fullname') }}"  required="">
									  </div>
									  <div class="field">
										  <div class="grouped fields">
										    <label for="fruit">Jenis Kelamin:</label>
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input form="insert_order" type="radio"  name="gender" class="gender" checked="" value="Man" {{ (Input::old("gender") == "Man" ? "checked":"") }} >
										        <label>Laki-laki</label>
										      </div>
										    </div>
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input form="insert_order" data-required="true" class="gender parsley-validated" type="radio" name="gender" value="Woman" {{ (Input::old("gender") == "Woman" ? "checked":"") }} required="">
										        <label>Perempuan</label>
										      </div>
										    </div>
										  </div>
									  </div>
								  </div>
								  <div class="two fields">
								      <div class="field">
									    <label>Email</label>
								        <input input form="insert_order"  type="email" name="email" value="{{ old('email') }}" required="">
									  </div>
									  <div class="field">
									    <label>Nomor Handphone</label>
								        <input form="insert_order" data-parsley-type="digits" type="text" name="phone_number" maxlength="15" value="{{ old('phone_number') }}" placeholder="ex. 6208577266122" required="">
									  </div>
								  </div>
								  <div class="field">
								    <div class="field">
									    <label>Alamat </label>
									    <textarea name="address" form="insert_order" id="" required="" cols="30"  rows="3">{{ old('address') }}</textarea>
									  </div>
								  </div>
								  <div class="field">
									    <div class="field">
									      <label>Provinsi</label>
									      	<select form="insert_order" required="" id="province" name="province" class="ui fluid dropdown" >
												<option value="">Pilih Provinsi ...</option>
												@foreach($provinces as $provinsi)
												<option value="{{$provinsi->name}}" data-id="{{$provinsi->id}}" {{ (Input::old("province") == $provinsi->id ? "selected":"") }} >{{$provinsi->name}}</option>
												@endforeach
											</select>
										</div>
									    
								  </div>
								  <div class="two fields">
								  		<div class="field">
									      <label>Kabupaten/Kota</label>
									      <select form="insert_order" name="regency" id="regency" class="ui fluid dropdown" required="">
									        <option value="">Pilih Kabupaten/Kota ...</option>
									      </select>
										</div>
									    <div class="field">
									      <label>Kecamatan</label>
									      <select form="insert_order"  name="district" id="district" class="ui fluid dropdown" required="">
									        <option value="">Pilih Kecamatan ...</option>
									      </select>
										</div>
								  </div>

								  <div class="two fields">
									    <div class="field">
									      <label>Kelurahan</label>
									      <select form="insert_order"  name="village" id="village" class="ui fluid dropdown" required="">
									        <option value="">Pilih Kelurahan ...</option>
										  </select>
										</div>

										 <div class="field">
									      <label>Kode Pos</label>
									      <input required="" form="insert_order" value="{{ old('zipcode') }}" maxlength="5"   name="zipcode" type="number" id="inputZip">
										</div>
								  </div>
						    </div>
						  </div>
						  <div id="title-3" class="title">
						    <i class="dropdown icon"></i>
						    OPSI PENGIRIMAN
						  </div>
						  <div id="content-3" class="content">
						    <div id="visible-3" class="form-content ui form transition hidden">
						    	<div class="grouped fields">
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="ekspedisi" value="Ninja Express" checked="" tabindex="0" class="hidden">
								        <label>Standard Delivery (2-3 hari)</label>
								      </div>
								    </div>
								</div>
						    </div>
						  </div>
						  <div id="title-4" class="title">
						    <i class="dropdown icon"></i>
						    PEMBAYARAN
						  </div>
						  <div id="content-4" class="content">
						    <div id="visible-4" class="form-content ui form transition hidden">
						    	<div class="grouped fields">
								    <!-- <div class="field">
								      	<div class="ui radio checkbox">
									        <input form="insert_order" type="radio"  name="pembayaran" class="pembayaran" checked=""  value="Transfer Bank" {{ (Input::old("pembayaran") == "Transfer Bank" ? "checked":"") }} >
									        <label>Transfer Bank</label>
								      	</div>
								    </div> -->
								    <div class="field">
								      	<div class="ui radio checkbox">
									        <input form="insert_order" data-required="true" class="pembayaran parsley-validated" type="radio" name="pembayaran" value="COD" {{ (Input::old("pembayaran") == "COD" ? "checked":"") }} required="" checked=""  >
									        <label>Bayar di Tempat</label>
								      	</div>
								    </div>

								</div>
						    </div>
						  </div>
						</div>
			</div>
			<div class="six wide column">
		        <h4 class="ui top attached block  header">
		            <div class="content">
		              RINGKASAN PESANAN
		            </div>
		          </h4>
		        <div class="product_cart white ringkasan">
		            <div class="ui middle aligned list">
		              <div class="item">
		                  <div class="right floated content resume-price">
		                    <div class="price">Rp. {{Cart::subtotal(0,',','.')}}</div>
		                  </div>
		                <div class="content summary">
		                  <a class="header">TOTAL HARGA</a>
		                </div>
		              </div>
		              <div class="item">
		                <div class="right floated content resume-price">
		                    <div class="price">Rp. <span id="total_ongkir">0</span></div>
		                    <input type="hidden" id="ongkir_hidden" value="">
		                  </div>
		                <div class="content summary">
		                  <a class="header">TOTAL ONGKIR</a>
		                </div>
		              </div>
		              <div class="item">
		                <div class="right floated content resume-price">
		                    <div class="price" id="discount">- Rp. 0</div>
		                  </div>
		                <div class="content summary">
		                  <a class="header">DISCOUNT</a>
		                </div>
		              </div>
		            </div>

		          
		            <div class="ui divider"></div>
		            <div class="subtotal">
		              <div class="ui equal width grid">
		                  <div class="column">Total Pembayaran</div>
		                  <div class="column">
		                    <span class="subtotal-price" id="grandtotal">Rp. {{number_format((Cart::subtotal(null,null,'')+ 0 ),0,'','.')}}</span>
		                  </div>
		              </div>
		            </div>

					<div class="ui fluid action input">

						<input type="text" name="coupon_code" id="coupon_code"  form="insert_order" value=""  placeholder="Kupon">
						<div id="check_coupon" class="ui button">
							Apply
						</div>

						

					</div>
					<div class="ui">
						<div id="statuscoupon">
														
						</div>
						
						@if (Session::has('success_msg'))
							{{ Session::get('success_msg') }}
						@elseif (Session::has('failed_msg'))
							{{ Session::get('failed_msg') }}
						@endif
					</div>
					<br>
						<div class="g-recaptcha" data-sitekey="6LePSZcUAAAAAJztFb4Az9weuyKv3hwn9eby699N" data-callback="recaptchaCallback" data-theme="light" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
						<span id='errorContainer'></span>
						<input type="hidden" form="insert_order"  name="_token" value="{{ csrf_token() }}">
						<input id="myField" data-parsley-errors-container="#errorContainer" data-parsley-required="true" value="" type="text" style="display:none;">
					<br>
		            <input type="submit" name="submit" value="Bayar" form="insert_order" class="ui green button check">
		        </div>

					</form>

		      </div>			
		</div>
	</div>
</div>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='{{ asset("js/parsley.js?v=0.02")}}'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

<script type="text/javascript">
// $(document).ready(function() {
// 	$(".insert_order".submit(function(e){
// 		e.preventDefault();
// 		var fullname = $("#")
// 		var gender = $("")
// 	});
// });
</script>

<script type="text/javascript">
	
$(document).ready(function() {
  $('.ui.accordion').accordion()

  $('.toggle').click(function() {
    $('.ui.accordion').accordion('toggle', 1);
  });

  $('.ui.radio.checkbox').checkbox();

  $('#insert_order').parsley();

  $('#test-parsley').parsley();
});

</script>
<script>
	function formatMoney(n, c, d, t) {
	  var c = isNaN(c = Math.abs(c)) ? 0 : c,
	    d = d == undefined ? "," : d,
	    t = t == undefined ? "." : t,
	    s = n < 0 ? "-" : "",
	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
	    j = (j = i.length) > 3 ? j % 3 : 0;

	  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
</script>
<script>
	function recaptchaCallback() {
	    document.getElementById('myField').value = 'nonEmpty';
	}
</script>

<script type="text/javascript">

	 window.Parsley.on('field:error', function() {
	   // This global callback will be called for any field that fails validation.
	   $('.accordion #title-2').addClass('active');
	   $('.accordion #content-2').addClass('active');
	   $('.accordion #visible-2').addClass('visible');
	   $('.accordion #visible-2').removeClass('hidden');
	   $('.accordion #title-1').removeClass('active');
	   $('.accordion #content-1').removeClass('active');
	   $('.accordion #visible-1').removeClass('visible');
	 });

</script>

<script type="text/javascript">
	$('#province').on('change',function(e){
      console.log(e);

      var province_id = $('#province option:selected').data('id');

      // ajax
      $.get('ajax-province?province_id=' + province_id, function(data){
        // success data
        $('#regency').empty();
        $('#regency').append('<option value="">Pilih Kabupaten/Kota ...</option>');
        $.each(data, function(index, regencyObj){

          $('#regency').append('<option value="'+regencyObj.name+'" data-id="'+regencyObj.id+'">'+regencyObj.name+'</option>');

        });

      });

    });
</script>

<script type="text/javascript">
	$('#regency').on('change',function(e){
      console.log(e);

      var regency_id = $('#regency option:selected').data('id');

      // ajax
      $.get('ajax-regency?regency_id=' + regency_id, function(data){
        // success data
        $('#district').empty();
        $('#district').append('<option value="">Pilih Kecamatan ...</option>');
        $.each(data, function(index, districtObj){

          $('#district').append('<option value="'+districtObj.name+'" data-id="'+districtObj.id+'">'+districtObj.name+'</option>');

        });

      });

    });
</script>

<script type="text/javascript">
	$('#district').on('change',function(e){
      console.log(e);

      var district_id = $('#district option:selected').data('id');

      // ajax
      $.get('ajax-district?district_id=' + district_id, function(data){
        // success data
        $('#village').empty();
        $('#village').append('<option value="">Pilih Kelurahan ...</option>');
        $.each(data, function(index, villageObj){

          $('#village').append('<option value="'+villageObj.name+';'+villageObj.zone+'" data-zone="'+villageObj.zone+'">'+villageObj.name+'</option>');

        });

      });

    });
</script>

<script type="text/javascript">
	$('#village').on('change',function(e){
      console.log(e);

      var zone_id = $('#village option:selected').data('zone');

      // ajax
      $.get('ajax-ongkir?zone_id=' + zone_id, function(data){
        // success data
        $('#total_ongkir').empty();
        $.each(data, function(index, ongkirObj){

          $('#total_ongkir').html(formatMoney(ongkirObj.price));
          $('#ongkir_hidden').val(ongkirObj.price);
          $('#discount').html('- Rp. 0');
          $('#coupon_code').val('');
          $('#statuscoupon').empty();

          $.ajax({
	              url: "{{url("total_pembayaran")}}",

	              data: "ongkir="+ongkirObj.price,
	              cache: false,
	              	success: function(data){
		              	
		              	console.log(data);
		                $('#grandtotal').html('Rp. '+formatMoney(data)+'')
	              },
	              	error:function(data){
	                  	$('#grandtotal').html('Rp. {{number_format((Cart::subtotal(null,null,'')+ 0 ),0,'','.')}}')
	              	}
	            });

        });

      });

    });
</script>




<script type="text/javascript">
    var htmlobjek;
		    $(document.body).on('click',"#check_coupon",function (e) {
		      coupon_code = $("#coupon_code").val();
		      ongkir = $("#ongkir_hidden").val();
		      if (ongkir == null) {
		      	ongkir = 0;
		      }
		       	$.ajax({
	              url: "{{url("check")}}",
	              data: { coupon_code: coupon_code, ongkir: ongkir },
	              cache: false,
	              	success: function(data){
	              		if (!$.trim(data)){   
		                  	$('#statuscoupon').html('<p class="text-danger m-0">Coupon tidak ditemukan</p>')
		                    console.log("failed"); 
		                    $('#discount').html(' - Rp. 0')
		                  	$('#grandtotal').html('Rp. {{number_format((Cart::subtotal(null,null,'')+ 0 ),0,'','.')}}')
						}
						else{   
					    	var coupon_name = data[0];
			              	var type = data[1];
			              	var nominal = data[2];
			              	var total = data[3];
			              	var discount = data[4];
			              	var showdiscount = data[5];
			              	var ongkir =  data[6];
			              	var grandtotal = total - discount + ongkir;
			              	if (grandtotal <= 0) {
			              		grandtotal = 0;
			              	}
			                console.log(data);
			                $('#statuscoupon').html('<p class="text-success m-0">'+coupon_name+'</p>')
			                $('#discount').html(' - Rp. '+showdiscount+'')
			                $('#grandtotal').html('Rp. '+formatMoney(grandtotal)+'')
						}
		              	
	              },
	              	error:function(data){
	                  	$('#statuscoupon').html('<p class="text-danger m-0">Coupon tidak ditemukan</p>')
	                    console.log("failed"); 
	                    $('#discount').html(' - Rp. 0')
	                  	$('#grandtotal').html('Rp. {{number_format((Cart::subtotal(null,null,'')+ 0 ),0,'','.')}}')
	              	}
	            });
		    });

</script>
</body>

</html>