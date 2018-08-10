
<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Add Accessories</h3>
</div>



<form name="frmdest" action="<?php echo base_url()?>admin/accessory/updateAccessory/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data">



					<div class="modal-body">


						<div class="control-group">
							 <label class="control-label">Sub Category</label>
							 <div class="controls">
	<select class="span12 chosen" data-placeholder="Choose a sub category" tabindex="1" id="subcategory_id" name="subcategory_id" style="width:427px;">
								   <option value=""></option>
								   
								<?php            
    								foreach($subcategoryList as $key => $val)
    								{
		 							?>
									   
	<option value="<?php echo $val->subcategory_id;?>"><?php echo getCategoryName($val->category_id)." ".$val->subcategory;?></option>
										
								<?php
								}
									?>
								   
								</select>
							 </div>
							 <br/>
						</div>
						<br/>


						<div class="control-group">
	  						<label class="control-label">Accessory Name</label>				  
	  						<div class="controls">
		 	<input type="text" class="span6 m-wrap" name="sub_subcategory" id="sub_subcategory" value="" style="width:500px" required/>
	  						</div>
   						</div>




					<div class="control-group">
                              <label class="control-label">Sub Category Image</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <img src="<?php echo base_url()."assets/upload/nopic.jpg";?>" alt="" />
                                    </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="sub_subcategory_image" class="default" id="sub_subcategory_image"/></span>
                                       <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                 <span class="label label-important"></span>
                                 <span>
                                <?php if(isset($error)){ echo $error; }?>
                                 </span>
                              </div>
                        </div>

					</div>


					<div class="modal-footer">
					  <button class="btn" data-dismiss="modal">Close</button>
					  <button class="btn btn-primary" type="submit" id="affbtn1">Add</button>
					</div>

</form>
