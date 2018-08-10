	<!-- BEGIN HEADER -->
	<?php
	$this->load->view('admin/vwHeader');
	
	$page_id=$this->uri->segment(4);
	?>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
	<?php
	$this->load->view('admin/vwSidebar');
	?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <div id="portlet-config" class="modal hide">
            <div class="modal-header">
               <button data-dismiss="modal" class="close" type="button"></button>
               <h3>portlet Settings</h3>
            </div>
            <div class="modal-body">
               <p>Here will be a configuration form</p>
            </div>
         </div>
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN STYLE CUSTOMIZER -->
                 <!-- <div class="color-panel hidden-phone">
                     <div class="color-mode-icons icon-color"></div>
                     <div class="color-mode-icons icon-color-close"></div>
                     <div class="color-mode">
                        <p>THEME COLOR</p>
                        <ul class="inline">
                           <li class="color-black current color-default" data-style="default"></li>
                           <li class="color-blue" data-style="blue"></li>
                           <li class="color-brown" data-style="brown"></li>
                           <li class="color-purple" data-style="purple"></li>
                           <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label class="hidden-phone">
                        <input type="checkbox" class="header" checked value="" />
                        <span class="color-mode-label">Fixed Header</span>
                        </label>                    
                     </div>
                  </div>-->
                  <!-- END BEGIN STYLE CUSTOMIZER -->   
                  <h3 class="page-title">
                     Change Password
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                    
                     <li><a href="#">Change Password</a></li>
                  </ul>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Sample Form</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>

					<?php 
						if(isset($error) && $error !='')
						{
					?>
						<div class="alert alert-error">
						<button class="close" data-dismiss="alert"></button>
						<span><?php echo $error;?></span>
						</div>
					<?php 
					}
					if(isset($success) && $success !='')
						{
					?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert"></button>
						<span><?php echo $success;?></span>
						</div>
					<?php } ?>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      <form name="frmpage" class="form-horizontal" action="<?php echo base_url()?>admin/dashboard/update_password" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return validateForm()">
						 <div class="control-group">
							  <label class="control-label">Old Password</label>				  
							  <div class="controls">
								 <input type="password" class="span6 m-wrap" name="old_password" id="old_password" value="" />
								
							  </div>
							<p style="color:red;" id="old_pass_error"></p>
							  
						   </div>

						   <div class="control-group">
							  <label class="control-label">New Password</label>				  
							  <div class="controls">
								 <input type="password" class="span6 m-wrap" name="new_password" id="new_password" value="" />
								
							  </div>
							  <p style="color:red;" id="new_pass_error"></p>
						   </div>

  						
						   <div class="control-group">
							  <label class="control-label">Repeat Password</label>				  
							  <div class="controls">
								 <input type="password" class="span6 m-wrap" name="repeat_password" id="repeat_password" value="" />
								
							  </div>
							  <p style="color:red;" id="repeat_pass_error"></p>
						   </div>
                          


						 


                           <div class="form-actions">
                              <input type="submit" class="btn blue" value="Submit">
                              <button type="button" class="btn">Cancel</button>
                           </div>
                        
						
						</form>
					
						
                        <!-- END FORM-->
                     </div>
                  </div>
                  <!-- END EXTRAS PORTLET-->
               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
			<!-- END PAGE CONTAINER-->		
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->

	<?php
	$this->load->view('admin/vwFooter');
	?>

	<!-- END FOOTER -->	



<script type="text/javascript">

function validateForm()
{


	var old_password = $('#old_password').val();
	var new_password = $('#new_password').val();
	var repeat_password = $('#repeat_password').val();

	var error = 1;
	if(old_password == '')
	{
		
		$("#old_pass_error").html('Please enter your old password.');
		error = 0;
	}
	else
	{
		$.post('<?php echo base_url();?>admin/dashboard/checkPassword',{'old_password':old_password},function(data){

			if(data=='1')
			{
				return true;
			}
			else
			{
				
				$("#old_pass_error").html('Wrong old password.');
				return false;
			}
		});
	}
	
	if(new_password == '')
	{
		
		$("#new_pass_error").html('Please enter your new password.');
		error = 0;
	} 
	else if(repeat_password == '')
	{
		
		$("#repeat_pass_error").html('Please repeat your new password.');
		error = 0;
	}
	else if(new_password != repeat_password)
	{
			
		$("#repeat_pass_error").html('Password missmatch.');	
		error = 0;
	}

	if(error)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
</script>
