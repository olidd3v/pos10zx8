<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Retur Purchase Form
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
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Retur Purchase</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($edit) && $edit){?>
            <!-- <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('retur_purchase/update').'/'.$code_retur_penjualan;?>"> -->
            <form class="form-horizontal" method="POST" action="<?php echo site_url('retur_purchase/update').'/'.$code_retur_penjualan;?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('retur_purchase/add_process');?>">
            <!-- <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('retur_purchase/add_process');?>"> -->
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Retur Purchase</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?php echo !empty($code_retur_penjualan) ? $code_retur_penjualan : '';?>" class="form-control" disabled/>
                      <input type="hidden" name="retur_id" id="retur_id" value="<?php echo !empty($code_retur_penjualan) ? $code_retur_penjualan : '';?>"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Purchase TRX</label>
                     <div class="col-sm-8">
                       <input type="text" name="id" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>" class="form-control" disabled/>
                       <input type="hidden" name="retur_code" id="retur_code" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>"/>
                     </div>
                  </div>
                  <div class="form-group" style="display: none;">
                    <label class="col-sm-4 control-label" for="date">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($date) ? $date : date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="retur_date" value="<?php echo !empty($date) ? $date : date('Y-m-d H:i:s');?>" id="retur_date" class="form-control"/>
                    </div>
                  </div>
                  <?php if(!empty($edit) && $edit){?>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Pengembalian Barang</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="is_return" id="is_return">
                            <option value="1" <?php echo (int)$details[0]->is_return == 1 ? "selected" : "";?>>Yes</option>
                            <option value="0" <?php echo (int)$details[0]->is_return == 0 ? "selected" : "";?>>No</option>
                        </select>
                    </div>
                  </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Return By</label>
                      <div class="col-sm-8">
                        <select class="form-control">
                          <option value="1">Barang</option>
                        </select>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                      <label class="col-sm-4 control-label">Description</label>
                      <div class="col-sm-8">
                       <textarea name="desc_retur" id="desc_retur" class="form-control"><?php echo !empty($desc_retur) ? $desc_retur : '';?></textarea>
                      </div>
                    </div>
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Informasi Barang yang ingin di Retur</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Kategori</td>
                          <td>Nama Barang</td>
                          <td>Jumlah</td>
                          <td>Harga Beli Satuan</td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody>
                      <!-- <tbody id="transaksi-item"> -->
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php $nox=1;$noz=1; foreach($carts['data'] as $k => $cart){?>
                              <tr>
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <input type="hidden" name="idx[]" value="<?php echo $cart['id'];?>">
                                <!-- <td><input type="number" id="jml_qty" row-id="<?php echo $k;?>" class="retur_purchase_qty" value="<?php echo $cart['qty'];?>" max="<?php echo $details[0]->total_item;?>" min="1" oninput="runx();"/></td> -->
                                <td><input type="number" id="jml_qty_<?php echo $nox++;?>" name="qty[]" value="<?php echo $cart['qty'];?>" max="<?php echo $cart['qty'];?>" min="1" oninput="runx_<?php echo $noz++;?>();"/></td>
                                <td>Rp<?php echo number_format($cart['price']);?></td>
                                <input type="hidden" name="total_price[]" value="<?php echo $cart['price']; ?>">
                                <td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Total Penjualan</td>
                          <td id="total-pembelian"><?php echo !empty($carts) ? 'Rp'.number_format($carts['total_price']) : '';?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('retur_purchase');?>">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		</div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    <?php $no=1; $nop=1; foreach($carts['data'] as $k => $cart){?>
        function runx_<?php echo $no++; ?>(){
          var con = document.getElementById("jml_qty_<?php echo $nop++;?>").value;
          if (con > <?php echo $cart['qty'];?> ) {
            alert('Jumlah Barang Input Melebihi Total Item Pembelian!');
            location.reload();
          }
          if (con == 0 ) {
            alert('Jumlah Barang Input Tidak Boleh Kosong!');
            location.reload();
          }
        }
        <?php } ?>
    </script>
<?php $this->load->view('element/footer');?>