<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Penjualan Form
        <small>List Penjualan</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('penjualan/create');?>">Input Penjualan</a></li>
            <li role="presentation"><a href="<?php echo site_url('penjualan?page');?>">List Penjualan</a></li>
            <li role="presentation"><a href="<?php echo site_url('penjualan/report');?>">Report Penjualan</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Penjualan</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($penjualan)){?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('penjualan/update').'/'.$penjualan[0]->id;?>">
            <?php }else{?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('penjualan/add_process');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Penjualan</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>" class="form-control" disabled/>
                      <input type="hidden" name="penjualan_id" id="penjualan_id" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Customer</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="customer_id" name="customer_id">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="supplier_date" value="<?php echo date('Y-m-d H:i:s');?>" id="supplier_date" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Metode Pembayaran</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="is_cash" name="is_cash">
                        <option value="1" <?php if(!empty($penjualan) && $penjualan[0]->is_cash == true) echo 'selected="selected"';?>>
                          Cash
                        </option>
                        <option value="0" <?php if(!empty($penjualan) && $penjualan[0]->is_cash == false) echo 'selected="selected"';?>>
                          Debit
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Informasi Barang</h3>
                  <div class="content-process">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <!-- <td></td> -->
                          <td style="width: 500px;">Nama Barang</td>
                          <td>Jumlah</td>
                          <td style="width: 500px;">Harga Beli Satuan</td>
                          <td></td>
                          <td>Input Barang</td>
                        </tr>
                      </thead>
                      <tbody id="transaksi-item">
                        <tr>
                          <td style="display: none;">
                            <div style="display: none;">
                            <select class="form-control select2" id="transaksi_category_id" name="category_id">
                              <option value="0">
                                Please select one
                              </option>
                              <?php if(isset($kategoris) && is_array($kategoris)){?>
                                <?php foreach($kategoris as $item){?>
                                  <option value="<?php echo $item->id;?>">
                                    <?php echo $item->category_name;?>
                                  </option>
                                <?php }?>
                              <?php }?>
                            </select>
                            </div>
                          </td>
                          <td>
                            <select class="form-control select2" id="transaksi_product_id" name="product_id" style="width: 200px;">
                            <?php if(isset($produks) && is_array($produks)){?>
                                  <option value="0">Silahkan pilih produk</option>
                                <?php foreach($produks as $item){?>
                                  <?php if ($item->product_qty > 0) { ?>
                                    <option value="<?php echo $item->id;?>">
                                    <?php echo $item->product_name;?> - <?php echo $item->product_qty;?>
                                    </option>
                                  <?php } else {?>
                                    <option value="<?php echo $item->id;?>" disabled>
                                    <?php echo $item->product_name;?> - <?php echo $item->product_qty;?>
                                    </option>
                                    <?php } ?>
                                <?php }?>
                              <?php }?>
                            </select>
                          </td>
                          <td>
                            <input style="width: 200px;" type="number" id="jumlah" class="form-control" name="jumlah" min="1" value="1"/>
                          </td>
                          <td>
                            <select class="form-control" id="sale_price" name="sale_price" style="width: 120px;"></select>
                          </td>
                          <td></td>
                          <td>
                            <a href="#" class="btn btn-primary form-control" id="tambah-barang">Input Barang</a>
                          </td>
                        </tr>
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <!-- <td style="display: none;"></td> -->
                                <!-- <td><?php echo $cart['category_name'];?></td> -->
                                <td style="width: 300px;"><?php echo $cart['name'];?></td>
                                <td><?php echo $cart['qty'];?></td>
                                <td style="width: 300px;">Rp<?php echo number_format($cart['price']);?></td>
                                <td style="width: 300px;"><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Total Penjualan</td>
                          <td id="total-pembelian"><?php echo !empty($carts) ? $carts['total_price'] : '';?></td>
                          <td>Dibayar</td>
                          <td><div id="dibayar" style="width: 200px;"></div><input type="hidden" name="total_pen" id="total_pen"></td>
                          <div id="total-pembelian-hidden" style="display: none;"></div>
                        </tr>
                        <tr>
                          <td>Uang Diterima</td>
                          <td><input type="number" name="dibayar" id="diterima" class="form-control" oninput="ch();" required="required"></td>
                          <td>Kembalian</td>
                          <td><input type="hidden" id="inpt_kembalian" name="kembalian"><span id="kembalian"></span></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('penjualan?page');?>">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right" id="submit-transaksi">Submit</a>
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

    function ch(){
      var x = document.getElementById("diterima").value;
      var tox = Number(x).toLocaleString();

      var h = document.getElementById("total-pembelian-hidden").innerHTML;
      var numberx = h;
      var stringValuex = parseFloat(numberx.replace(/,/g, ""));

      document.getElementById("total_pen").value = stringValuex; 
      if (x){
        var total_h = document.getElementById("total-pembelian-hidden").innerHTML;
        var inp  = document.getElementById("diterima").value;
        var number = total_h;
        var stringValue = parseFloat(number.replace(/,/g, ""));
        
        var result = inp - stringValue;
        var to = result.toLocaleString();
        var rp = "Rp";
        document.getElementById("inpt_kembalian").value = inp - stringValue; 

        document.getElementById("kembalian").innerHTML = rp+to;
        document.getElementById("dibayar").innerHTML = rp+tox;
      } else {
        document.getElementById("dibayar").innerHTML = "";
      }
    }
    </script>
<?php $this->load->view('element/footer');?>