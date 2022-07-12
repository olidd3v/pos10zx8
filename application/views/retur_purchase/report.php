<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Retur Purchase
        <small>Report Retur Purchase</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?php echo site_url('retur_purchase/create');?>">Input Retur Purchase</a></li>
            <li role="presentation"><a href="<?php echo site_url('retur_purchase');?>">List Retur Purchase</a></li>
            <li role="presentation" class="active"><a href="<?php echo site_url('retur_purchase/report?search=true&date_from=&date_end=');?>">Report Retur Purchase</a></li>
          </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Retur Purchase</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('retur_purchase/report?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <!-- <div class="col-md-2">
                    <div class="form-group">
                      <label for="id">Kode Purchase</label>
                      <input type="text" class="form-control" name="id" value="<?php echo !empty($_GET['id']) ? $_GET['id'] : '';?>"/>
                    </div>
                  </div> -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date From</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date End</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  </form>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <a href="<?php echo site_url('retur_purchase/print_report/')."?search=true&date_from=".$_GET['date_from']."&date_end=".$_GET['date_end'];?>" class="form-control btn btn-success btnPrint"><i class="fa fa-print"></i> Print</a>
                      <!-- <div id="print" class="form-control btn btn-success" onclick="printData();"><i class="fa fa-print"></i> Print </div> -->
                    </div>
                  </div>
                </div>
              <table id="example1" class="table table-bordered table-striped">
              <thead style="text-align: left;">
                <tr>
                  <th>Retur ID</th>
                  <th>Date</th>
                  <th>Sales Retur ID</th>
                  <th>Product Name</th>
                  <th>Qty</th>
                  <th>Harga Satuan</th>
                  <th>Total Harga</th>
                  <th>Pengembalian Barang</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($penjualans) && is_array($penjualans)){ ?>
                  <?php foreach($penjualans as $penjualan){?>
                  <?php if ($penjualan->total_price == 0 || $penjualan->total_price == NULL) { ?>
                  <?php } else {?>
                <tr>
                  <td><?php echo $penjualan->id;?></td>
                  <td><?php echo $penjualan->date;?></td>
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
                <?php } ?>
                </tbody>
                <tfoot style="text-align: left;">
                <tr>
                  <th colspan="4">Total</th>
                  <th id="total"></th>
                  <th id="harga"></th>
                  <th id="hargax" coslpan="2"></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              <?php echo $paggination;?>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
<?php $this->load->view('element/footer');?>