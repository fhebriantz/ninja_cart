
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
<section class="cart">
  <div class="ui container">
    @if (Session::has('success_msg'))
              <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
          @elseif (Session::has('failed_msg'))
            <div class="alert alert-danger">{{ Session::get('failed_msg') }}</div>
          @endif
    <div class="ui stackable grid">
      <div class="ten wide column">
        <h4 class="ui top attached block  header">
            <div class="content">
              DAFTAR PRODUK
            </div>
          </h4>
        <div class="product_cart white">
            <div class="ui divided items">
<!-- http://azha.ddns.net:8080/ninja_cms/public/assets/images/products/product1552052710.png -->
              @foreach ($product as $prod)
              <div class="item">
                <a class="ui tiny image" id="single_image"  href="{{ url('ninja_cms/public/assets/images/products/'.$prod->filename)}}">
                    <img src="{{ url('ninja_cms/public/assets/images/products/'.$prod->filename)}}">
                
                </a>
                <div class="content">
                  <div class="grid-product">
                      <div class="column3">
                          <p class="item">{{$prod->sku}}</p>
                          <h4 class="header title">{{$prod->product_name}}</h4>
                          <div class="meta">
                            <span class="price">Rp. {{number_format($prod->product_price,0,'','.')}}</span>
                          </div>
                          <div class="description">
                            <p></p>
                          </div>
                      </div>
                      <div class="column3">
                        <div class="quantity buttons_added">

                          <input type="hidden" name="id_product" id="id_product{{$prod->id}}" value="{{$prod->id}}">

                          <input type="button" value="-" class="minus">

                          <input type="number" step="1" min="0" max="" name="qty" value="0" title="Qty" class="qty{{$prod->id}} input-text qty text"  id="qty_{{$prod->id}}" size="4" pattern="" inputmode="">

                          <input type="button" value="+" class="plus">

                        </div>
                      </div>
                      <div class="column3">
                        <div data-id_product="{{$prod->id}}" class="buy ui right floated basic button">
                          BELI
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              @endforeach

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
            <div class="cart_body ui middle aligned divided list">

              @foreach (Cart::content() as $cart) 
              <div class="item item_cart" id="rowcart{{$cart->id}}">
                  <div class="right floated content resume-price">
                    <div class="price" id="subtotalcart_{{$cart->id}}">Rp. <?php echo number_format($cart->subtotal,0,'',''); ?></div>
                  </div>
                <div class="content summary">
                  <a class="header"><?php echo $cart->name?></a>
                  <p class="item"><?php echo ($cart->options->has('sku') ? $cart->options->sku : ''); ?></p>
                  <div class="meta">
                    <span class="qty" id="cartqty_<?php echo $cart->rowId?>"><?php echo $cart->qty?></span> x <span class="pricing"><?php echo number_format($cart->price,0,'',''); ?></span>
                  </div>
                  <a id="deleterow" class="delete red" data-id="{{$cart->rowId}}">Hapus</a>
                </div>
              </div>
              @endforeach  

            </div>

          
            <div class="ui divider"></div>
            <div class="total-items">total <span  id="countitem">{{Cart::count()}}</span> items</div>
            <div class="subtotal">
              <div class="ui equal width grid">
                  <div class="column">Subtotal</div>
                  <div class="column">
                    <span class="subtotal-price"  id="totalcart">Rp. {{Cart::subtotal(0,'','.')}}</span>
                  </div>
              </div>
            </div>

            <a onclick="return confirm();" href="{{url('/destroy')}}">
              <div class="ui red button check" >
                Hapus Semua
              </div>
            </a>
            <a href="{{url('/checkout')}}">
              <div class="ui green button check">
                Checkout
              </div>
            </a>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/qty.js')}}"></script>

<script src="{{ asset('js/jquery.fancybox.min.js')}}"></script>
<!-- Buy -->

<script type="text/javascript">
  $("a#single_image").fancybox();
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
                      $('#rowcart'+id_product+' #cartqty_'+data.contet[0].rowId+'').html(data.contet[0].qty);
                      $('#rowcart'+id_product+' #subtotalcart_'+data.contet[0].id+'').html('Rp. '+(data.contet[0].qty * data.contet[0].price));
                      $('#totalcart').html('Rp. '+data.total);
                      $('#countitem').html(data.count);
                    }
                    else
                    {
                      $('.product_cart .cart_body').append('<div class="item item_cart" id="rowcart'+data.contet[0].id+'"><div class="right floated content resume-price"><div class="price" id="subtotalcart_'+data.contet[0].id+'">Rp. '+(data.contet[0].qty * data.contet[0].price)+'</div></div><div class="content summary"><a class="header">'+data.contet[0].name+'</a><p class="item">'+data.sku+'</p><div class="meta"><span class="qty" id="cartqty_'+data.contet[0].rowId+'">'+data.contet[0].qty+'</span> x <span class="pricing">'+data.contet[0].price+'</span></div><a id="rowappend" class="delete red" data-id="'+data.contet[0].rowId+'">Hapus</a></div></div>');
                      $('#totalcart').html('Rp. '+data.total);
                      $('#countitem').html(data.count);
                    }

                },
                  error:function(data){
                      console.log('produk gagal dibeli');
                  }
              });
        });
  
</script>
<!-- Delete Row -->
<script>
  $('.product_cart  a#deleterow').on('click',function(e) {
    id = $(this).data('id');
    var a = $(this).closest('.item_cart');
    $.ajax({
                url: "{{url('/deletecart')}}",
                data: {id : id},
                cache: false,
                success: function(data){
                    console.log(data);
                    console.log($(this).closest('.item_cart'));
                    a.remove();
            $('#totalcart').html('Rp. '+data.total);
            $('#countitem').html(data.count);
                },
                  error:function(data){
                      alert('gagal');
                  }
              });
    
  });
</script>
<script>

  $("#single_image").fancybox();
  var htmlobjek;
    $(document.body).on('click',"#rowappend",function (e) {
    id = $(this).data('id');
    var a = $(this).closest('.item_cart');
    console.log('ttt');
     $.ajax({
               url: "{{url('/deletecart')}}",
                data: {id : id},
                cache: false,
                success: function(data){
                    console.log(data);
                    console.log($(this).closest('.item_cart'));
                  a.remove();
          $('#totalcart').html('Rp. '+data.total);
            $('#countitem').html(data.count);
               },
                error:function(data){
                      alert('gagal');
                  }
               });
    
  });
</script>
</body>

</html>
