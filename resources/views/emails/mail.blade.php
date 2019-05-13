<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
  body{font-family: 'Roboto', sans-serif;}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

.container{
  max-width:500px;
  margin: auto;
}

.topnav {
      overflow: hidden;
      background-color: #815085;
    }

    .topnav a {
      float: left;
      display: block;
      color: #fff;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    .topnav a:hover {
      background-color: #815085;
      color: black;
    }

    .active {
      color: white;
    }

    .topnav .icon {
      display: none;
    }


tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
  <div class="topnav" id="myTopnav">
              <a href="#home" class="active"><img style="height: 50px; width: auto;"  src="http://54.169.60.212/public/image/logo.png" alt=""></a>
            </div>

<div class="container">
    <h3>INVOICE #FCNX{{$transaction->id_order}}</h3>
  <p>Hi {{$name}}, berikut daftar belanja untuk id order FCNX{{$transaction->id_order}}:</p>

  <div style="overflow-x:auto;">
    <table>
      <tbody>
                            @foreach($detail as $det)
                              <tr>
                                <td>{{$det->product_name}}</td>
                                <td>{{$det->qty}} x {{$det->product_price}}</td>
                                <td><?php echo number_format((($det->qty)*($det->product_price)),0,'','.'); ?></td>
                              </tr>
                            @endforeach
                              

                            </tbody>
                            <tfoot>
                              <tr>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><strong><?php echo number_format(($transaction->total),0,'','.'); ?></strong></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><strong>Diskon</strong></td>
                                <td><strong><?php echo number_format(($transaction->discount),0,'','.'); ?></strong></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><strong>Ongkir</strong></td>
                                <td><strong><?php echo number_format(($transaction->ongkir),0,'','.'); ?></strong></td>
                              </tr>
                            </tfoot>
    </table>
    <div style="width: 100%" align="center">
      <p style="font-size: 12px">Total pembayaran anda <br>
                          <strong>Rp. <?php  echo number_format((($transaction->grand_total)+0),0,'','.');?></strong></p>
      
    </div>
    <p>Terima kasih telah berbelanja dengan kami hari ini. Order Anda segera di proses dan akan dikirimkan. Anda dapat menggunakan Tracking ID untuk melacak pembelian Anda di <a href="www.ninjaxpress.co">www.ninjaxpress.co</a></p>
  </div>
</div>


</body>
</html>
