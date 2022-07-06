
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->user_photo;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
       <!-- <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div> -->
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->

      <?php if ($_SESSION['role'] == 1) {?>
        <ul class="sidebar-menu">
      <li class="<?php echo is_menu('home','dashboard');?>"><a href="<?php echo site_url();?>"><i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span></a></li>
          <li class="treeview <?php echo is_menu('supplier');?>">
          <a href="#"><i class="fa fa-users"></i> <span>Supplier</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			    <li class="<?php echo is_menu('supplier');?>"><a href="<?php echo site_url('supplier');?>"><i class="fa fa-users" aria-hidden="true"></i> <span>List Supplier</span></a></li>
			    <li class="<?php echo is_menu('supplier','create');?>"><a href="<?php echo site_url('supplier/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Supplier</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('kategori');?>">
          <a href="#"><i class="fa fa-th-large"></i> <span>Kategori</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('kategori');?>"><a href="<?php echo site_url('kategori');?>"><i class="fa fa-th-large" aria-hidden="true"></i> <span>List Kategori</span></a></li>
            <li class="<?php echo is_menu('kategori','create');?>"><a href="<?php echo site_url('kategori/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Kategori</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('produk');?>">
          <a href="#"><i class="fa fa-shopping-cart"></i> <span>Produk</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('produk');?>"><a href="<?php echo site_url('produk');?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>List Produk</span></a></li>
            <li class="<?php echo is_menu('produk','create');?>"><a href="<?php echo site_url('produk/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Produk</span></a></li>
          </ul>
        </li>
		<li class="treeview <?php echo is_menu('transaksi');?>">
          <a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Pembelian</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			<li class="<?php echo is_menu('transaksi');?>"><a href="<?php echo site_url('transaksi');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Transaksi</span></a></li>
			<li class="<?php echo is_menu('transaksi','create');?>"><a href="<?php echo site_url('transaksi/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Transaction</span></a></li>
			<li class="<?php echo is_menu('transaksi','report');?>"><a href="<?php echo site_url('transaksi/report?search=true&date_from=&date_end=');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Report Transaction</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('penjualan');?>">
          <a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Penjualan</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('penjualan');?>"><a href="<?php echo site_url('penjualan?page');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Penjualan</span></a></li>
            <li class="<?php echo is_menu('penjualan','create');?>"><a href="<?php echo site_url('penjualan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Penjualan</span></a></li>
			      <li class="<?php echo is_menu('penjualan','report');?>"><a href="<?php echo site_url('penjualan/report');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Report Penjualan</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('retur_purchase');?>">
          <a href="#"><i class="fa fa-share"></i> <span>Retur Purhcase</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('retur_purchase');?>"><a href="<?php echo site_url('retur_purchase');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Retur Purchase</span></a></li>
            <li class="<?php echo is_menu('retur_purchase','create');?>"><a href="<?php echo site_url('retur_purchase/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Retur Purchase</span></a></li>
			      <li class="<?php echo is_menu('retur_purchase','report');?>"><a href="<?php echo site_url('retur_purchase/report?search=true&date_from=&date_end=');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Report Retur Purchase</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('user');?>">
          <a href="#"><i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('user');?>"><a href="<?php echo site_url('user');?>"><i class="fa fa-th-large" aria-hidden="true"></i> <span>List User</span></a></li>
            <li class="<?php echo is_menu('user','create');?>"><a href="<?php echo site_url('user/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add User</span></a></li>
          </ul>
        </li>
        <li class="<?php echo is_menu('setting','edit/1');?>"><a href="<?php echo site_url('setting/edit/1');?>"><i class="fa fa-gear" aria-hidden="true"></i> <span>Setting</span></a></li>
      </ul>
      <?php } elseif ($_SESSION['role'] == 0) {?>
      <ul class="sidebar-menu">
      <li class="<?php echo is_menu('home','dashboard');?>"><a href="<?php echo site_url();?>"><i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span></a></li>
        <li class="treeview <?php echo is_menu('penjualan');?>">
          <a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Penjualan</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('penjualan');?>"><a href="<?php echo site_url('penjualan?page');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Penjualan</span></a></li>
            <li class="<?php echo is_menu('penjualan','create');?>"><a href="<?php echo site_url('penjualan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Penjualan</span></a></li>
			      <li class="<?php echo is_menu('penjualan','report');?>"><a href="<?php echo site_url('penjualan/report');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Report Penjualan</span></a></li>
          </ul>
        </li>
      </ul>
      <?php } else {?>
      <?php } ?>
      <br />
      <br />
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
