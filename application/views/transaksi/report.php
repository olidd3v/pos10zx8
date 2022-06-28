<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Transaksi Pembelian
        <small>List Transaksi</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?php echo site_url('transaksi/create');?>">Input Transaksi</a></li>
            <li role="presentation"><a href="<?php echo site_url('transaksi');?>">List Transaksi</a></li>
            <li role="presentation" class="active"><a href="<?php echo site_url('transaksi/report');?>">Report Transaksi</a></li>
          </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('transaksi/report?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date From</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date End</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <a href="<?php echo site_url('transaksi/export_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <div id="print" class="form-control btn btn-success" onclick="printData();"><i class="fa fa-print"></i> Print </div>
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
              <thead style="text-align: left;">
                <tr>
                  <th>Transaksi ID</th>
                  <th>Supplier Name</th>
                  <th>Total Item</th>
                  <th>Total Harga</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($transaksis) && is_array($transaksis)){ ?>
                  <?php foreach($transaksis as $transaksi){?>
                    <tr>
                      <td><?php echo $transaksi->id;?></td>
                      <td><?php echo $transaksi->supplier_name;?></td>
                      <td id="item"><?php echo $transaksi->total_item;?></td>
                      <td>Rp<?php echo number_format($transaksi->total_price);?></td>
                      <td id="item_2" style="display: none;"><?php echo $transaksi->total_price;?></td>
                      <td><?php echo $transaksi->date;?></td>
                    </tr>
                  <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot style="text-align: left;">
                <tr>
                  <th colspan="2">Total</th>
                  <th id="total"></th>
                  <th id="harga"></th>
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
  <script>
    function printData()
    {
      var divToPrint=document.getElementById("example1");
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
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
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>