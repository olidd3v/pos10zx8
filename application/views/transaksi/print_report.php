<html>
<head>
    <meta charset="ISO-8859-1">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('public');?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public');?>/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public');?>/plugins/ionic/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('public');?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public');?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public');?>/css/fa-loading.css">
    <link rel="stylesheet" href="<?php echo base_url('public');?>/css/main.css">
    <style>
        @media print {
          html, body {
            height: 99%;
          }
            @page {
                size: 24cm;
                /* size: 24cm 14cm . Random dot?; */
            }
        }
    </style>
</head>
<body onload="setup();"> 
            <div style="font-size: medium;">
              <br>
              <center>
              <b><?php print_r($app[0]['judul_app']);?></b>
              <br>
              <?php print_r($app[0]['alamat']);?>
              <br>
              Telp. <?php print_r($app[0]['no_telp']);?>
              </center>
              <br>
            </div>
            <div style="border-bottom: 1px solid #000;"></div>
            <br>
            <H4><b><center>LAPORAN PEMBELIAN</center></b></H4>
            <div>
              <b>Periode</b>: <?php
              if(!empty($_GET['date_from'] && $_GET['date_end'])){
                echo $_GET['date_from']." s/d ".$_GET['date_end'];
              } elseif (!empty($_GET['date_from'])) {
                echo $_GET['date_from'];
                }elseif(!empty($_GET['date_end'])){
                  echo $_GET['date_end'];
                }else{
                  echo "Semua";
                  } ?>
            </div>
            <br>
            <table id="tb" class="table">
              <thead style="text-align: left; border-top: 1px solid #000;border-bottom: 1px solid #000;">
                <tr>
                  <th style="width: 50px; border-bottom: 1px solid #000;">No</th>
                  <th style="border-bottom: 1px solid #000;">Date</th>
                  <th style="border-bottom: 1px solid #000;">Transaksi ID</th>
                  <th style="border-bottom: 1px solid #000;">Supplier Name</th>
                  <th style="border-bottom: 1px solid #000;">Nama Barang</th>
                  <th style="border-bottom: 1px solid #000;">Total Item</th>
                  <th style="border-bottom: 1px solid #000;">Total Harga</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; if(isset($transaksis) && is_array($transaksis)){ ?>
                  <?php foreach($transaksis as $transaksi){?>
                    <?php if ($transaksi->total_price == 0 || $transaksi->total_price == NULL) { ?>
                    <?php }else{ ?>
                    <tr>
                      <td><?php $no <= count($transaksis); echo $no++; ?></td>
                      <td><?php echo $transaksi->date;?></td>
                      <td><?php echo $transaksi->id;?></td>
                      <td><?php echo $transaksi->supplier_name;?></td>
                      <td><?php echo $transaksi->product_name;?></td>
                      <td id="item"><?php echo $transaksi->quantity;?></td>
                      <td>Rp<?php echo number_format($transaksi->total_price);?></td>
                      <td id="item_2" style="display: none;"><?php echo $transaksi->total_price;?></td>
                    </tr>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot style="text-align: left;">
                <tr>
                  <th colspan="5" style="border-top: 1px solid #000;">Total</th>
                  <th id="total" style="border-top: 1px solid #000;"></th>
                  <th colspan="2" id="harga" style="border-top: 1px solid #000;"></th>
                </tr>
                </tfoot>
              </table>
</body>
<footer>
  <!-- ./wrapper -->

		<!-- jQuery 2.2.0 -->
		<script src="<?php echo base_url('public');?>/plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="<?php echo base_url('public');?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('public');?>/dist/js/app.js"></script>
		<script src="<?php echo base_url('public');?>/dist/js/demo.js"></script>		
		<script src="<?php echo base_url('public');?>/js/fa-loading.js"></script>
		<script src="<?php echo base_url('public');?>/plugins/jquery-price-format/jquery.price_format.2.0.min.js"></script>
    <script type="text/javascript">
       function setup(){
        var TotalValue = 0;
        var TotalValuer = 0;

        $("tr #item").each(function(index,value){
          currentRow = parseFloat($(this).text());
          TotalValue += currentRow
        });

        document.getElementById('total').innerHTML = TotalValue;

        $("tr #item_2").each(function(index,value){
          currentRow = parseFloat($(this).text());
          TotalValuer += currentRow
        });

        // document.getElementById('harga').innerHTML = TotalValuer;

        var	reverse = TotalValuer.toString().split('').reverse().join(''),
          ribuan 	= reverse.match(/\d{1,3}/g);
          ribuan	= ribuan.join(',').split('').reverse().join('');
        
        document.getElementById('harga').innerHTML = 'Rp' + ribuan;
        }
    </script>
</footer>

  
</html>