<!DOCTYPE html>
<html>
<head>
  
  <title>Fiber Creme - Shopping Cart</title>
  @include('include_cart/head')

</head>
<body>
<div class="ui inverted menu fiber">
  <div class="ui container">
    <a href="{{url('/')}}" class="header item">
      <img class="logo" src="{{ asset('image/logo.png')}}">
    </a>
  </div>
</div>
<div class="end-order">
  <div class="ui container aligned">
      <h2 class="ui header">Terima kasih atas pembelian Anda!</h2>
      <input type="hidden" readonly="" id="id_order" value="{{ $transaction->id_order }}">
       <p>Terima kasih telah berbelanja dengan kami hari ini. Order Anda segera di proses dan akan dikirimkan. Anda dapat menggunakan Nomor Order untuk melacak pembelian Anda di <a href="www.ninjaxpress.co">www.ninjaxpress.co</a></p>
      <div class="ui card">

        <div class="content">
          <div class="center aligned description">
            <p>NO.ORDER</p>
          </div>
          <div class="center aligned header">{{ $transaction->id_order }}</div>
        </div>
        <div class="extra content">
          <div class="center aligned author">
             <h5>jumlah tagihan</h5>
             <h2>Rp. {{ number_format($transaction->grand_total,0,'','.') }}</h2>
          </div>
        </div>
      </div>    
  </div>

        <div class="content mt-sm-4 text-center" >
          <a href="{{url('/')}}" name="submit"  class=" center aligned ui purple button check">Back</a>
        </div>
        


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

<script type="text/javascript">
  
$(document).ready(function() {
  $('.ui.accordion').accordion()

  $('.toggle').click(function() {
    $('.ui.accordion').accordion('toggle', 1);
  });

  $('.ui.radio.checkbox').checkbox();
});

</script>
<script> 
 $(function() {
     if (window.history && window.history.pushState) {
         window.history.pushState('', null, './');
         $(window).on('popstate', function() {
             // alert('Back button was pressed.');
            window.location = "{{url('/cart')}}";

         });
     }
 });
</script>
<script type="text/javascript">
        function create_order() {
            var id_order = $('#id_order').val();
             $.ajax({
                url: "{{url('/get_token')}}",
                data:  {id_order: id_order},
                cache: false,
                success: function(data){

                    var still_active = data[1];
                    var id_order = data[6]; 
                    console.log(data);

                    console.log('id_order = '+data[6]);
                    if (still_active==1) {

                      var access_token = data[2];
                      var expires = data[3];
                      var token_type = data[4];
                      var expires_in = data[5]; 
                        console.log('status token = '+still_active); 
                        console.log('Old Token = '+access_token);
                        console.log('expires = '+expires); 
                        console.log('token_type = '+token_type); 
                        console.log('expires_in = '+expires_in); 
                    }else{

                      var ambil = JSON.parse(data[0]);
                      var access_token = ambil.access_token;
                      var expires = ambil.expires;
                      var token_type = ambil.token_type;
                      var expires_in = ambil.expires_in; 
                        console.log('status token = '+still_active);
                        console.log('New Token = '+access_token); 
                        console.log('expires = '+expires); 
                        console.log('token_type = '+token_type); 
                        console.log('expires_in = '+expires_in); 
                    }


                    $.ajax({
                    url: "{{url('/create_order')}}",
                    data: {still_active: still_active, access_token: access_token, expires: expires , token_type: token_type , expires_in: expires_in , id_order: id_order},
                    cache: false,
                    success: function(dalem){

                            //console.log('success to make order');
                         window.location = "{{url('/payment')}}/"+id_order;
                },
                    error:function(dalem){
                          alert('failed to make order');

                          console.log(dalem);
                    }
                  });


                  },
                  error:function(data){
                      alert('failed to make token');
                  }
              });        }
        window.onload = create_order;
        </script>
</body>

</html>