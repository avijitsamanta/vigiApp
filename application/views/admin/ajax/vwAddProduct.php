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
                  <div class="color-panel hidden-phone">
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
                  </div>
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
                        <a href="<?php echo base_url()?>admin/products">Manage Products</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Products</a></li>
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
                      
						<form name="frmpage" class="form-horizontal" action="<?php echo base_url()?>admin/products/updateProduct/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data">

						   
						 <div class="control-group">
                              <label class="control-label">Prodct Cover Image</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <img src="<?php echo base_url()."assets/upload/nopic.jpg";?>" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="cover_image" class="default" id="cover_image" /></span>
                                       <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                 <span class="label label-important"></span>
                                 <span>
                                <?php //if(isset($error)){ echo $error; }?>
                                 </span>
                              </div>
                           </div>

                            <div class="control-group">
                            <label class="control-label">Product Images</label>
                             <div class="controls">
								<input type="file" name="product_images[]" class="default" id="product_image" multiple="multiple" accept="image/*"/>
							 </div>
							</div>

					

	<div class="control-group">
	  <label class="control-label">Category</label>				  
	  <div class="controls">
		<select class="span6 chosen" data-placeholder="Choose a category" tabindex="1" id="product_category_id" name="product_category_id" style="width:427px;" onchange="getSubcat(this.value)">
								   <option value="">Select Category</option>
								   
								  	<?php            
	    								foreach($categoryList as $key => $val)
	    								{
		 							?>
									   
<option value="<?php echo $val->product_category_id;?>"><?php echo $val->product_category;?></option>
										
										<?php
								   	}
								   	?>
								   
		</select>
	  </div><br/>
   </div><br/>

   <div class="control-group" id="subcat_select">
	  <label class="control-label">Sub Category</label>				  
	  <div class="controls" >
		 <select class="span6 chosen" data-placeholder="Choose a category" tabindex="1" id="product_subcategory_id" name="product_subcategory_id" style="width:427px;">
								   <option value="">Select Category First</option>
								   
		</select>
	  </div><br/><br/>
   </div>

			<div class="control-group">
				<label class="control-label">Brands</label>				  
				<div class="controls">
				<select class="span6 chosen" data-placeholder="Choose a brand" tabindex="1" id="brand_id" name="brand_id" style="width:427px;" >
				<option value="">Select Brands</option>

				<?php            
					foreach($brandList as $key => $val)
					{
				?>

					<option value="<?php echo $val->brand_id;?>"><?php echo $val->brand_name;?></option>

				<?php
					}
				?>

				</select>
				</div><br/>
			</div><br/>

					<div class="control-group">
						<label class="control-label">Size</label>				  
						<div class="controls">
						<select class="span6 chosen" data-placeholder="Choose a Size" tabindex="1" id="size" name="size[]" style="width:427px;" multiple>
							<option value="">Select Size</option>

							<?php            
							foreach($sizeList as $key => $val)
							{
							?>

							<option value="<?php echo $val->product_size_id;?>"><?php echo $val->size;?></option>

							<?php
							}
							?>

						</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">color</label>				  
						<div class="controls">
						<select class="span6 chosen" data-placeholder="Choose a color" tabindex="1" id="color" name="color[]" style="width:427px;" multiple>
							<option value="">Select Color</option>

							<?php            
							foreach($colorList as $key => $val)
							{
							?>

							<option value="<?php echo $val->color_id;?>"><?php echo $val->color_code;?></option>

							<?php
							}
							?>

						</select>
						</div>
					</div>
						   
						   <div class="control-group">
							  <label class="control-label">Product Name</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="product_name" id="product_name" value="" />
								 <?php echo form_error("product_name")?>
							  </div>
							  
						   </div>	

						   <div class="control-group">
							  <label class="control-label">Product Description</label>
							  <div class="controls" style="margin-right:15px;">
								 
								  <textarea class="span12 ckeditor m-wrap" name="product_desc" rows="6" id="product_desc"></textarea>
							    <?php echo form_error("product_desc")?>
							  </div>
							
						   </div>

						   
							<div class="control-group">
							  <label class="control-label">Materials</label>
							  <div class="controls" style="margin-right:15px;">
								 
								  <textarea class="span12 ckeditor m-wrap" name="material" rows="6" id="material"></textarea>
							    <?php echo form_error("material")?>
							  </div>
							
						   </div>					  
							
							 <div class="control-group">
							  <label class="control-label">Model Number</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="model_number" id="model_number" value="" />
								 <?php echo form_error("model_number")?>
							  </div>
							  
						   </div>

						    <div class="control-group">
							  <label class="control-label">Quantity</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="quantity" id="quantity" value="" />
								 <?php echo form_error("quantity")?>
							  </div>
							  
						   </div>

						    <div class="control-group">
							  <label class="control-label">Actual Price</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="actual_price" id="actual_price" value="" />
								 <?php echo form_error("actual_price")?>
							  </div>
							  
						   </div>

						    <div class="control-group">
							  <label class="control-label">Offer Percentage</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="offer_percentage" id="offer_percentage" value="" />
								 <?php echo form_error("offer_percentage")?>
							  </div>
						   </div>

						    <div class="control-group">
							  <label class="control-label">Offer Price</label>				  
							  <div class="controls">
								 <input type="text" class="span6 m-wrap" name="offer_price" id="offer_price" value="" />
								 <?php echo form_error("offer_price")?>
							  </div>
							  
						   </div>

						   
						   <div class="form-actions" style="padding-left:10px">
							  <button type="submit" class="btn blue">Submit</button>
							  <button type="button" class="btn" id="cancel" onClick="location.href='<?php echo base_url();?>admin/banners/'">Cancel</button>
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