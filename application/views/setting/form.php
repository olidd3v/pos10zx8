<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting Form
        <small>Setting App</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('setting/edit/1');?>">Input Setting App</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">setting</h3> -->
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo site_url('setting/save').'/'.$setting['id'];?>" enctype="multipart/form-data;charset=utf-8">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Judul App</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($setting) ? $setting['judul_app'] : '';?>" name="judul_app" placeholder="Judul App" id="judul_app" class="form-control" required/>
                      <input type="hidden" value="<?php echo !empty($setting) ? $setting['id'] : '';?>" name="id" id="id" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Alamat</label>
                    <div class="col-sm-8">
                      <textarea name="alamat" placeholder="Alamat" id="alamat" class="form-control"/><?php echo !empty($setting) ? $setting['alamat'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="no_telp">No. Telp</label>
                    <div class="col-sm-8">
                    <input type="number" value="<?php echo !empty($setting) ? $setting['no_telp'] : '';?>" name="no_telp" placeholder="No. Telp" id="no_telp" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="deskripsi_toko">Deskripsi Toko</label>
                    <div class="col-sm-8">
                      <textarea name="deskripsi_toko" placeholder="Deskripsi Toko" id="deskripsi_toko" class="form-control"/><?php echo !empty($setting) ? $setting['deskripsi_toko'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6" style="display: none;">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="foto">Logo</label>
                    <div class="col-sm-8">
                    <input type="file" name="foto" id="foto" class="form-control"/>
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3">
                  <button class="btn btn-info pull-right" type="submit" name="submit">Save</button>
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
<?php $this->load->view('element/footer');?>