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
                size: 24cm/* . Random dot? */;
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
            <H4><b><center>LAPORAN RETUR</center></b></H4>
            <div style="font-size: medium;">
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
                  <th style="border-bottom: 1px solid #000;">Retur ID</th>
                  <th style="border-bottom: 1px solid #000;">Sales Retur ID</th>
                  <th style="border-bottom: 1px solid #000;">Product Name</th>
                  <th style="border-bottom: 1px solid #000;">Qty</th>
                  <th style="border-bottom: 1px solid #000;">Harga Satuan</th>
                  <th style="border-bottom: 1px solid #000;">Total Harga</th>
                  <th style="border-bottom: 1px solid #000;">Pengembalian Barang</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; if(isset($penjualans) && is_array($penjualans)){ ?>
                  <?php foreach($penjualans as $penjualan){?>
                    <tr>
                      <td><?php $no <= count($penjualans); echo $no++; ?></td>
                      <td><?php echo $penjualan->date;?></td>
                      <td><?php echo $penjualan->id;?></td>
                      <td>
                      <?php echo $penjualan->sales_retur_id;?>
                      </td>
                      <td><?php echo $penjualan->product_name;?></td>
                      <td id="item"><?php echo $penjualan->quantity;?></td>
                      <td id="item_2" style="display: none;"><?php echo $penjualan->price_item;?></td>
                      <td>Rp<?php echo number_format($penjualan->price_item);?></td>
                      <td id="item_3" style="display: none;"><?php echo $penjualan->subtotal;?></td>
                      <td>Rp<?php echo number_format($penjualan->subtotal);?></td>
                      <td><?php echo $penjualan->is_return == 1 ? "Complete" : "Not Complete";?></td>
                    </tr>
                  <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot style="text-align: left;">
                <tr style="border-top: 1px solid #000;">
                  <th colspan="5" style="border-top: 1px solid #000;">Total</th>
                  <th id="total" style="border-top: 1px solid #000;"></th>
                  <th id="harga" style="border-top: 1px solid #000;"></th>
                  <th id="hargax" coslpan="4" style="border-top: 1px solid #000;"></th>
                  <th id="hargax" style="border-top: 1px solid #000;"></th>
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
    <script>
    function printData()
    {
      var divToPrint=document.getElementById("example1");
      newWin= window.open("");
      newWin.document.write("<div style='margin-bottom: 10px; text-align: center;'> <h1> Laporan Penjualan Barang</h1><h3><?php echo $_GET['date_from'].' - '.$_GET['date_end']; ?></h3><hr></div>");
      newWin.document.write(divToPrint.outerHTML);
      var css =`table, tfoot, td, th {
          border: 1px solid #000;
          text-align:left;
          padding: 0px 5px;
          width: 100%;
      }

      html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}

      tfoot {
          height: 30px;
      }

      th {
          background-color: #7a7878;
          text-align:left
      }`;
    var div = $("<div />", {
      html: '&shy;<style>' + css + '</style>'
    }).appendTo( newWin.document.body);
      newWin.print();
      newWin.close();
    }

    $('button').on('click',function(){
    printData();
    })
  </script>
  <script type="text/javascript">
       function setup(){
        var TotalValue = 0;
        var TotalValuer = 0;
        var TotalValuerx = 0;

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

        $("tr #item_3").each(function(index,value){
          currentRow = parseFloat($(this).text());
          TotalValuerx += currentRow
        });

        // document.getElementById('harga').innerHTML = TotalValuer;

        var	reverse = TotalValuerx.toString().split('').reverse().join(''),
          ribuanx 	= reverse.match(/\d{1,3}/g);
          ribuanx	= ribuanx.join(',').split('').reverse().join('');
        
        document.getElementById('hargax').innerHTML = 'Rp' + ribuanx;
        }
    </script>
</footer>

  
</html>