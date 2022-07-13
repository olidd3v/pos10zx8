<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Purchase Order Form
        <small>List Purchase Order</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <!-- <li role="presentation" class="active"><a href="<?php echo site_url('retur_purchase/create');?>">Input Retur Purchase</a></li>
            <li role="presentation"><a href="<?php echo site_url('retur_purchase');?>">List Retur Purchase</a></li>
            <li role="presentation"><a href="<?php echo site_url('retur_purchase/report?search=true&date_from=&date_end=');?>">Report Retur Purchase</a></li> -->
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Order</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo site_url('transaksi/add_process_po');?>">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Purchase Order</label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>" class="form-control" disabled/>
                        <input type="hidden" name="id_po" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
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
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Informasi Barang</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Kategori</td>
                          <td>Nama Barang</td>
                          <td>Jumlah</td>
                          <td>Harga Beli Satuan</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php $nox=1;$noz=1; foreach($carts['data'] as $k => $cart){?>
                              <tr>
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><input type="number" id="jml_qty_<?php echo $nox++;?>" name="qty[]" value="<?php echo $cart['qty'];?>" max="<?php echo $cart['qty'];?>" min="1" oninput="runx_<?php echo $noz++;?>();"/></td>
                                <input type="hidden" name="id_pox[]" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>"/>
                                <input type="hidden" name="product_id[]" value="<?php echo !empty($cart['id']) ? $cart['id'] : '';?>"/>
                                <td><input type="number" name="po_price[]" class="form-control" required="required"></td>
                                <!-- <td>Rp<?php echo number_format($cart['price']);?></td> -->
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <!-- <tr>
                          <td>Total Penjualan</td>
                          <td id="total-pembelian"><?php echo !empty($carts) ? 'Rp'.number_format($carts['total_price']) : '';?></td>
                        </tr> -->
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('transaksi');?>">Cancel</a>
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
  <!-- <script>
        function runx(){
          var con = document.getElementById("jml_qty").value;
          var btn = document.getElementById("submit-transaksi");

          if (con > <?php #echo $details[0]->total_item;?> ) {
            alert('Jumlah Barang Input Melebihi Total Item Pembelian!');
            location.reload();
            btn.style.display = "none";
          } else {
            btn.style.display = "block";
          }
          if (con == 0 ) {
            alert('Jumlah Barang Input Tidak Boleh Kosong!');
            location.reload();
            btn.style.display = "none";
          } else {
            btn.style.display = "block";
          }
        }
    </script> -->

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