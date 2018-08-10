<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Add Region</h3>
</div>



<form name="frmdest" action="<?php echo base_url();?>admin/region/updateRegion/add" method="post" style="margin:0; padding:0" enctype="multipart/form-data">

<div class="modal-body">

	<div class="control-group">
	  <label class="control-label">Region</label>				  
	  <div class="controls">
		 <input type="text" class="span6 m-wrap" name="region" id="region_name" value="" style="width:500px" required/>
	  </div>
   </div>

</div>


<div class="modal-footer">
  <button class="btn" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" type="submit" id="affbtn1">Add</button>
</div>

</form>