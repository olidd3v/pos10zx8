<?php if($this->is_login){?>
	<?php $this->load->view('element/main_footer');?>
	<?php $this->load->view('element/control_bar');?>
<?php } ?>
	</body>
	<footer>
		<!-- ./wrapper -->

		<!-- jQuery 2.2.0 -->
		<script src="<?php echo base_url('public');?>/plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="<?php echo base_url('public');?>/js/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?php echo base_url('public');?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('public');?>/bootstrap/js/select2.full.min.js"></script>
		<!-- Morris.js charts -->
		<script src="<?php echo base_url('public');?>/plugins/raphael/raphael-min.js"></script>
		<!-- script src="<?php echo base_url('public');?>/plugins/morris/morris.min.js"></script -->
		<!-- Sparkline -->
		<script src="<?php echo base_url('public');?>/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="<?php echo base_url('public');?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo base_url('public');?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="<?php echo base_url('public');?>/plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker -->
		<script src="<?php echo base_url('public');?>/plugins/moment/moment.min.js"></script>
		<script src="<?php echo base_url('public');?>/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- datepicker -->
		<script src="<?php echo base_url('public');?>/plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="<?php echo base_url('public');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="<?php echo base_url('public');?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url('public');?>/plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url('public');?>/dist/js/app.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<!-- script src="<?php echo base_url('public');?>/dist/js/pages/dashboard.js"></script -->
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo base_url('public');?>/dist/js/demo.js"></script>		
		<!-- iCheck -->
		<script src="<?php echo base_url('public');?>/plugins/iCheck/icheck.min.js"></script>
		<script src="<?php echo base_url('public');?>/js/fa-loading.js"></script>
		<script src="<?php echo base_url('public');?>/js/jquery.printPage.js"></script>
		<script src="<?php echo base_url('public');?>/plugins/jquery-price-format/jquery.price_format.2.0.min.js"></script>
		<!-- main JS -->
		<script src="<?php echo base_url('public');?>/js/re-5-main.js"></script>
		<!-- <script src="<?php echo base_url('public');?>/js/re-4-main.js"></script> -->
		<!-- <script src="<?php echo base_url('public');?>/js/re-main.js"></script> -->
		<!-- <script src="<?php echo base_url('public');?>/js/main.js"></script> -->
		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
		<script>
  (function($) {

var Defaults = $.fn.select2.amd.require('select2/defaults');

$.extend(Defaults.defaults, {
	dropdownPosition: 'auto'
});

 var AttachBody = $.fn.select2.amd.require('select2/dropdown/attachBody');

var _positionDropdown = AttachBody.prototype._positionDropdown;

AttachBody.prototype._positionDropdown = function() {
 
	var $window = $(window);
 
	var isCurrentlyAbove = this.$dropdown.hasClass('select2-dropdown--above');
	var isCurrentlyBelow = this.$dropdown.hasClass('select2-dropdown--below');
 
	var newDirection = null;
 
	var offset = this.$container.offset();
 
	offset.bottom = offset.top + this.$container.outerHeight(false);
	
	var container = {
			height: this.$container.outerHeight(false)
	};
	
	container.top = offset.top;
	container.bottom = offset.top + container.height;

	var dropdown = {
		height: this.$dropdown.outerHeight(false)
	};

	var viewport = {
		top: $window.scrollTop(),
		bottom: $window.scrollTop() + $window.height()
	};

	var enoughRoomAbove = viewport.top < (offset.top - dropdown.height);
	var enoughRoomBelow = viewport.bottom > (offset.bottom + dropdown.height);
	
	var css = {
		left: offset.left,
		top: container.bottom
	};

	// Determine what the parent element is to use for calciulating the offset
	var $offsetParent = this.$dropdownParent;

	// For statically positoned elements, we need to get the element
	// that is determining the offset
	if ($offsetParent.css('position') === 'static') {
		$offsetParent = $offsetParent.offsetParent();
	}

	var parentOffset = $offsetParent.offset();

	css.top -= parentOffset.top
	css.left -= parentOffset.left;
	
	var dropdownPositionOption = this.options.get('dropdownPosition');
	
	if (dropdownPositionOption === 'above' || dropdownPositionOption === 'below') {
	
			newDirection = dropdownPositionOption;
	
	} else {
			
			if (!isCurrentlyAbove && !isCurrentlyBelow) {
					newDirection = 'below';
			}

			if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
				newDirection = 'above';
			} else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
				newDirection = 'below';
			}
	
	}

	if (newDirection == 'above' ||
			(isCurrentlyAbove && newDirection !== 'below')) {
		css.top = container.top - parentOffset.top - dropdown.height;
	}

	if (newDirection != null) {
		this.$dropdown
			.removeClass('select2-dropdown--below select2-dropdown--above')
			.addClass('select2-dropdown--' + newDirection);
		this.$container
			.removeClass('select2-container--below select2-container--above')
			.addClass('select2-container--' + newDirection);
	}

	this.$dropdownContainer.css(css);
 
};

})(window.jQuery);


$(document).ready(function() {
$(".select2").select2({
	dropdownPosition: 'below'
});
});

</script>
	</footer>
</html>