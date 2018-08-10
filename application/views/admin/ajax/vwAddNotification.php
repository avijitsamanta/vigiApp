
<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> Notification Details</h3>
</div>



<form name="frmdest" action="<?php echo base_url();?>admin/product/notifyUser" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return sendData()">



<div class="modal-body">

<input type="hidden" name="userid" id="userid" value="<?php echo $userid?>">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode?>">	

	<?php 
	if($userid!='')
	{
		?>
   <div class="control-group">
	  <label class="control-label">Title</label>				  
	  <div class="controls">
		 <input type="text" class="span6 m-wrap" name="title" id="title" value="" style="width:500px"/>
	  </div>
	  <p id="title_error" style="color:red;"></p>
   </div>


    <div class="control-group">
	  <label class="control-label">Message</label>				  
	  <div class="controls">
		 <textarea class="span6 m-wrap" name="message" id="message" value="" style="width:500px" cols="20" rows="10" /></textarea>
	  </div>
	  <p id="message_error" style="color:red;"></p>
   	</div>
   	<?php 
	}
	else
	{
		?>
		<p>Please select Atleast one checkbox.</p> 
		<?php
   		}
   	?>

</div>


<div class="modal-footer">
  <button class="btn" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" type="submit" id="affbtn1">Send</button>
</div>

</form>




