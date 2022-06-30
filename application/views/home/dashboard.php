<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php if($this->session->flashdata('msg')){?>
		<div class="alert alert-success alert-dismissible">
			<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
			<h4>
				<i class="icon fa fa-check"></i>Login Success!
			</h4>
			<?php echo $this->session->flashdata('msg');?>, <?php echo $this->username;?>!
		</div>
	  <?php } ?>
      <h1>
        Dashboard
        <small>Home Dashboard</small>
      </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Supplier</span>
              <span class="info-box-number"><?php echo $suppliers;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-bars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Category</span>
              <span class="info-box-number"><?php echo $categories;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
  

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Produk</span>
              <span class="info-box-number"><?php echo $products;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-shopping-basket"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pembelian</span>
              <span class="info-box-number"><?php echo $transaksi_model;?></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>


      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-tag"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Penjualan</span>
              <span class="info-box-number"><?php echo $penjualan_model;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-share"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Retur</span>
              <span class="info-box-number"><?php echo $retur_penjualan_model;?></span>
            </div>
          </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>