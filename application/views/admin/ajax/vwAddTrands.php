
<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Add Trend</h3>
</div>



<form name="frmdest" action="<?php echo base_url()?>admin/trends/updateTrend/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data">



					<div class="modal-body">
						<div class="control-group">
							 <label class="control-label" >Category</label>
							 <div class="controls">
								<select class="span12 chosen" data-placeholder="Choose a category" tabindex="1" id="category_id" name="category_id" style="width:427px;">
								   <option value=""></option>
								   
								  	<?php            
    								foreach($categoryList as $key => $val)
    								{
		 								?>
									   
<option value="<?php echo $val->product_category_id;?>"><?php echo $val->product_category;?></option>
										
										<?php
								   	}
								   	?>
								   
								</select>
							 </div>
							 <br/>
						</div>
						<br/>

						            <div class="control-group">
                              <label class="control-label">Banner Image</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <img src="<?php echo base_url()."assets/upload/nopic.jpg";?>" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="trend_image" class="default" id="trend_image"/></span>
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