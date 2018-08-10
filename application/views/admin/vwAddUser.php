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
                  <!--<div class="color-panel hidden-phone">
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
                        <a href="<?php echo base_url()?>admin/vig_user">Manage User</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add User</a></li>
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
                      
						<form name="frmpage" class="form-horizontal" action="<?php echo base_url()?>admin/vig_user/update_user/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data">

                     <div class="control-group">
                              <label class="control-label">Banner Image</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <img src="<?php echo base_url()."uploads/images/nopic.jpg";?>" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="profileimage" class="default" id="profileimage"/></span>
                                       <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                 <span class="label label-important"></span>
                                 <span>
                                <?php if(isset($error)){ echo $error; }?>
                                 </span>
                              </div>
                           </div>
						 
						   <div class="control-group">
							  <label class="control-label">User Name</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="user_name" id="user_name" value="" />
								 <?php echo form_error("user_name")?>
							  </div>
							  
						   </div>	

                      <div class="control-group">
                       <label class="control-label">Email</label>              
                       <div class="controls">
                         <input type="text" class="span6 m-wrap" name="phoneno" id="phoneno" value="" />
                         <?php echo form_error("phoneno")?>
                       </div>
                       
                     </div>   					  
							
                      <div class="control-group">
                       <label class="control-label">Password</label>              
                       <div class="controls">
                         <input type="text" class="span6 m-wrap" name="crime_name" id="crime_name" value="" />
                         <?php echo form_error("crime_name")?>
                       </div>
                       
                     </div>   
							
					       
                   <div class="control-group">
                       <label class="control-label">Status</label> 
                       <div class="controls" style="margin-right:15px;">             
                     <select class="span6 chosen" tabindex="1" style="width:104px;" name = "status" >
                                       <option value="1" >Active</option>
                                       <option value="0" >Inactive</option>
                     </select>
                     </div>
                    </div>
						   
						   <div class="form-actions" style="padding-left:10px">
							  <button type="submit" class="btn blue">Submit</button>
							  <button type="button" class="btn" id="cancel" onClick="location.href='<?php echo base_url();?>admin/crimes/'">Cancel</button>
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