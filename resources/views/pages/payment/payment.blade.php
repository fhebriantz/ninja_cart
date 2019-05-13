<!DOCTYPE html>
<html>
<head>
  
  <title>Fiber Creme - Shopping Cart</title>
  @include('include_cart/head')
  
</head>
<body>
<div class="ui inverted menu fiber">
  <div class="ui container">
    <a href="http://fibercreme.com/" class="header item">
      <img class="logo" src="{{ asset('image/logo.png')}}">
    </a>
  </div>
</div>
<div class="end-order">
  <div class="ui container aligned">
      <h2 class="ui header">Terima kasih atas pembelian Anda!</h2>
       <p>Terima kasih telah berbelanja dengan kami hari ini. Order Anda segera di proses dan akan dikirimkan. Anda dapat menggunakan Nomor Order untuk melacak pembelian Anda di <a href="https://www.ninjaxpress.co/" target="_blank">www.ninjaxpress.co</a></p>
      <div class="ui card">

        <div class="content">
          <div class="center aligned description">
            <p>NO.ORDER</p>
          </div>
          <div id="idorder" class="center aligned header">FCNX{{ $transaction->id_order }}</div>
          <div id="idorder_hidden" hidden="">{{ $transaction->id_order }}</div>
        </div>
        <div class="extra content">
          <div class="center aligned author">
             <h5>jumlah tagihan</h5>
             <h2>Rp. {{ number_format($transaction->grand_total,0,'','.') }}</h2>
          </div>
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
        var idorder = $('#idorder_hidden').html();
         window.history.pushState('', null, './'+idorder);
        $(window).on('popstate', function() {
            // alert('Back button was pressed.');
           window.location = "{{url('/cart')}}";

        });
    }
 });
</script>
<script>
  
</script>

</body>

</html>