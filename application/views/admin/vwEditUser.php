<style>
.error{
  color:red;
 
}
</style>
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
                    Edit User
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
                     <li><a href="#">Edit User</a></li>
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
                        <h4><i class="icon-reorder"></i>Manage User</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      
						<form name="frmpage" class="form-horizontal" action="<?php echo base_url()?>admin/vig_user/update_user/edit/<?php echo $page_id;?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">
                          
						
						<?php
                    
                  foreach($users as $key => $val){
                              
                              if($val->profileimage!= "" && $val->upload_path!= "")
                              {
                                $pic = base_url().$val->upload_path.$val->profileimage;
                              }
                              else if ($val->profileimage!= "" && $val->upload_path== "")
                              {
                                $pic = $val->profileimage;
                              }
                              else
                              {
                                $pic = base_url().'upload/nopic.png';
                              }
          
                          ?>
               
               <div class="control-group">
                              <label class="control-label">User image</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <img src="<?php echo $pic;?>" alt="" />
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
                         <input type="text" class="span6 m-wrap" name="username" id="username" value="<?php echo $val->username?>" />
                         <?php echo form_error("username")?>
                        </div>
                        
                       </div> 

                       <div class="control-group">
                        <label class="control-label">password</label>         
                        <div class="controls">
                         <input type="password" class="span6 m-wrap" name="password" id="password" value="" />
                         <?php echo form_error("password")?>
                        </div>
                        
                       </div>
             
						 
						   
                     <div class="control-group">
                       <label class="control-label">First Name</label>             
                       <div class="controls">
                         <input type="text" class="span6 m-wrap" name="first_name" id="first_name" value="<?php echo $val->first_name?>" />
                         <?php echo form_error("first_name")?>
                      </div>
                     </div>

                      <div class="control-group">
                       <label class="control-label">Last Name</label>             
                       <div class="controls">
                         <input type="text" class="span6 m-wrap" name="last_name" id="last_name" value="<?php echo $val->last_name;?>" />
                         <?php echo form_error("last_name")?>
                      
                     </div>
                     </div>

                    <div class="control-group">
                       <label class="control-label">Mobile no</label>             
                       <div class="controls">
                         <input type="text" class="span6 m-wrap" name="phoneno" id="phoneno" value="<?php echo $val->mobile_no?>" />
                         <?php echo form_error("phoneno")?>
                      
                     </div>
                     </div>

                     <div class="control-group">
                       <label class="control-label">Is Premium ?</label> 
                       <div class="controls" style="margin-right:15px;">             
                     <select class="span6 chosen" tabindex="1" style="width:104px;" name = "is_premium" >
                                       <option value="1" <?php if($val->is_premium==1) echo "selected='selected'"; ?>>Yes</option>
                                       <option value="0" <?php if($val->is_premium==0) echo "selected='selected'"; ?>>No</option>
                     </select>
                     </div>
                    </div>
                     
                     <div class="form-actions" style="padding-left:10px">
                       <button type="submit" class="btn blue">Submit</button>
                       <button type="button" class="btn" id="cancel" onClick="location.href='<?php echo base_url();?>admin/vig_user/'">Cancel</button>
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

  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>  <!-- END FOOTER --> 
<script type="text/javascript">

 $( function() {
   
      $("form[name='frmpage']").validate({
        // Specify validation rules
        rules: {

        username: "required",
        first_name: "required",
        last_name: "required"

        },


        // Specify validation error messages
        messages: {

        username: "Please enter your Latitude",
        first_name: "Please enter your Longitude",
        last_name: "Please enter your Longitude"

        },
        errorElement : 'span',
        errorLabelContainer: '.error'
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid

      });
 } );

   
</script>
