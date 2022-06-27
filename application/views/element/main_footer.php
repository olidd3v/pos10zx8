
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    <?php foreach ($judul_app as $key) {echo $key['deskripsi_toko'];}?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y") ?> <a href="#"><?php foreach ($judul_app as $key) {echo $key['judul_app'];}?></a>.</strong> All rights reserved.
  </footer>