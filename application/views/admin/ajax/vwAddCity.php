
<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Add City</h3>
</div>



<form name="frmdest" action="<?php echo base_url();?>admin/city/updateCity/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data" >



<div class="modal-body">

	<div class="control-group">
	  <label class="control-label">Category</label>				  
	  <div class="controls">
		<select class="span6 chosen" data-placeholder="Choose a category" tabindex="1" id="region_id" name="region_id" style="width:427px;">
								   <option value="">Select Region</option>
								   
								  	<?php            
    								foreach($regionList as $key => $val)
    								{
		 								?>
									   
<option value="<?php echo $val->id;?>"><?php echo $val->region;?></option>
										
										<?php
								   	}
								   	?>
								   
		</select>
	  </div><br/>
   </div><br/>


   <div class="control-group">
	  <label class="control-label">City</label>				  
	  <div class="controls">
		 <input type="text" class="span6 m-wrap" name="city_name" id="city_name" value="" style="width:500px" required/>
	  </div>
	   <p id="size_error" style="color:red;"></p>
   </div>
   

</div>


<div class="modal-footer">
  <button class="btn" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" type="submit" id="affbtn1">Add</button>
</div>

</form>




