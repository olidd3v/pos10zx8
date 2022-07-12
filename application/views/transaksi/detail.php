<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Transaksi Pembelian Detail
                <small>Detail Transaksi</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('transaksi/create');?>">Input Transaksi</a></li>
                        <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                        <li role="presentation" class="active"><a href="<?php echo site_url('transaksi');?>">List Transaksi</a></li>
                        <li role="presentation"><a href="<?php echo site_url('transaksi/confirm_index');?>">List Transaksi PO</a></li>
                        <?php }else{ ?>
                        <li role="presentation"><a href="<?php echo site_url('transaksi');?>">List Transaksi</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('transaksi/confirm_index');?>">List Transaksi PO</a></li>
                        <?php } ?>
                        <li role="presentation"><a href="<?php echo site_url('transaksi/report?search=true&date_from=&date_end=');?>">Report Transaksi</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Transaksi Detail <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?><?php }else{ ?>PO<?php } ?> <?php echo $details[0]->id;?></h3>
                            <div class="pull-right">
                                <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                <span><a href="<?php echo site_url('transaksi');?>" class="btn btn-sm btn-default">Back</a></span>
                                <?php }else{ ?>
                                <span><a href="<?php echo site_url('transaksi/confirm_index');?>" class="btn btn-sm btn-default">Back</a></span>
                                <?php } ?>
                                <span><a href="<?php echo site_url('transaksi/print_now').'/'.$details[0]->id;?>" class="btn btn-sm btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Supplier Name</th>
                                    <th>Total Item</th>
                                    <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                    <?php }else{ ?>
                                    <th>Total</th>
                                    <?php } ?>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $details[0]->id;?></td>
                                        <td><?php echo $details[0]->supplier_name;?></td>
                                        <td><?php echo $details[0]->total_item;?></td>
                                        <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                        <?php }else{ ?>
                                        <td>Rp<?php echo number_format($details[0]->total_price);?></td>
                                        <?php } ?>
                                        <td><?php echo $details[0]->tgl;?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr />
                            <h4>Transaction Data</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                        <?php }else{ ?>
                                        <th>Price/item</th>
                                        <th>Subtotal</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($details) && is_array($details)){ ?>
                                    <?php foreach($details as $transaksi){?>
                                        <tr>
                                            <td><?php echo $transaksi->product_name;?></td>
                                            <td><?php echo $transaksi->category_name;?></td>
                                            <td><?php echo $transaksi->quantity;?></td>
                                            <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                            <?php }else{ ?>
                                            <td>Rp<?php echo number_format($transaksi->price_item);?></td>
                                            <td>Rp<?php echo number_format($transaksi->subtotal);?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                                    <?php }else{ ?>
                                    <tr>
                                        <th colspan="4" align="center">Total</th>
                                        <th>Rp<?php echo number_format($transaksi->total_price);?></th>
                                    </tr>
                                    <?php } ?>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
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