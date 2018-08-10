<div class="footer">
		<!--<?=date('Y')?> &copy; <?=PROJECT_NAME?>-->
		2016 c vigilant.
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>

	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/jquery-1.8.3.min.js"></script>	
	  <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>ckeditor/ckeditor.js"></script> 
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>breakpoints/breakpoints.js"></script>	
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap/js/bootstrap.min.js"></script>	
	  <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-fileupload/bootstrap-fileupload.js"></script>	
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/jquery.blockui.js"></script>
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/jquery.cookie.js"></script>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/excanvas.js"></script>
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/respond.js"></script>
	<![endif]-->	
	  <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>data-tables/jquery.dataTables.js"></script>
	   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>clockface/js/clockface.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>data-tables/DT_bootstrap.js"></script>
	<script src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/app.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN?>js/jquery.fancybox.js?v=2.1.5"></script>		
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
		});
		
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
