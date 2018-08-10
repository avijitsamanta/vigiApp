
<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Add Size</h3>
</div>



<form name="frmdest" action="<?php echo base_url();?>admin/product/updateSize/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return validateForm()">



<div class="modal-body">

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

   <!--<div class="control-group" id="subsubcat_select">
	  <label class="control-label">Sub Category</label>				  
	  <div class="controls" >
		 <select class="span6 chosen" data-placeholder="Choose a category" tabindex="1" id="sub_subcategory_id" name="sub_subcategory_id" style="width:427px;">
								   <option value="">Select Sub Category First</option>
								   
		</select>
	  </div><br/><br/>
   </div>-->

   <div class="control-group">
	  <label class="control-label">Size</label>				  
	  <div class="controls">
		 <input type="text" class="span6 m-wrap" name="size" id="size" value="" style="width:500px" required/>
	  </div>
	   <p id="size_error" style="color:red;"></p>
   </div>
   

</div>


<div class="modal-footer">
  <button class="btn" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" type="submit" id="affbtn1">Add</button>
</div>

</form>



<script type="text/javascript">
	function validateForm()
	{
		var size = $("#size").val();
		
		if(size.length > 15)
		{
			$("#size_error").html("Please provide maximum 15 characters as size.");
			return false;
		}
		return true;
	}
</script>


