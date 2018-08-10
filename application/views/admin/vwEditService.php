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
                     Form Components
                     <small>form components and widgets</small>
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="<?php echo base_url()?>admin/services">Manage Services</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Edit Service</a></li>
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
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      
						<form name="frmpage" class="form-horizontal" action="<?php echo base_url()?>admin/services/updateservice/edit/<?php echo $page_id;?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">
                          
						
						<?php
                    
                    				foreach($serviceDetails as $key => $val){
									
								
					
                    			?>
							 
						   
						   
						   <div class="control-group">
							  <label class="control-label">service Title</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="service_title" id="sender_title" value="<?php echo $val->service_title?>" />
								 <?php echo form_error("service_title")?>
							  </div>
							  
						   </div>						  
							
							<div class="control-group">
							  <label class="control-label">service Description</label>
							  <div class="controls" style="margin-right:15px;">
								 
								  <textarea class="span12 ckeditor m-wrap" name="service_description" rows="6" id="service_description"><?php echo $val->service_description?></textarea>
							    <?php echo form_error("service_description")?>
							  </div>
							
						   </div>
						   
						    
                           <div class="form-actions">
                              <input type="submit" class="btn blue" value="Submit">
                              <button type="button" class="btn">Cancel</button>
                           </div>
                        
						<?php
                    
                    				}
					
                    				?>
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