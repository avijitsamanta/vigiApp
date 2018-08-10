<div class="modal-header">
<button class="close" type="button" data-dismiss="modal"></button>
  <h3 id="myModalLabel1"> View Reported Details</h3>
</div>


<div class="modal-body">

<div class="control-group">		  
		<div class="controls">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
					<tr>
						<th class="hidden-480" >Reported By</th>
						<th class="hidden-480">Reason</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//print_r($reportedPosts);
					foreach($reportedPosts as $key => $val){

					?>
					<tr class="odd gradeX">
						<td ><a data-toggle="modal" href="<?php echo base_url()?>admin/vig_user/edit_user/<?php echo  $val->reported_by; ?>" ><?php echo $val->first_name.' '.$val->last_name ;?></a></td>
						<td><?php echo ($val->reason) ;?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

</div>


<div class="modal-footer">
  <button class="btn" data-dismiss="modal">Close</button>
</div>
