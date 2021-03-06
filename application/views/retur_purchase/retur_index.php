<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Retur Purchase
        <small>List Retur Purchase</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('retur_purchase/create');?>">Input Retur Purchase</a></li>
            <li role="presentation"><a href="<?php echo site_url('retur_purchase');?>">List Retur Purchase</a></li>
            <li role="presentation"><a href="<?php echo site_url('retur_purchase/report?search=true&date_from=&date_end=');?>">Report Retur Purchase</a></li>
          </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Purchase</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('retur_purchase/create?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="id">Code Transaksi</label>
                      <input type="text" class="form-control" name="id" value="<?php echo !empty($_GET['id']) ? $_GET['id'] : '';?>"/>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date From</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date End</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Transaksi ID</th>
                  <th>Total Item</th>
                  <th>Total Harga</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($penjualans) && is_array($penjualans)){ ?>
                  <?php foreach($penjualans as $penjualan){?>
                    <?php if ($penjualan->total_price == 0 || $penjualan->total_price == NULL) { ?>
                    <?php } else {?>
                    <tr>
                      <td><?php echo $penjualan->id;?></td>
                      <td><?php echo $penjualan->total_item;?></td>
                      <td>Rp<?php echo number_format($penjualan->total_price);?></td>
                      <td><?php echo $penjualan->date;?></td>
                      <td>
                        <a href="<?php echo site_url('retur_purchase/create_retur').'/'.$penjualan->id;?>" class="btn btn-xs btn-primary">Retur</a>
                      </td>
                    </tr>
                  <?php } ?>
                  <?php } ?>
                <?php } ?>
                </tbody>
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
<?php $this->load->view('element/footer');?>