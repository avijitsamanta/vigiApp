<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<!--<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>-->
										<th class="hidden-480">Name</th>
										<th class="hidden-480">Crime Name</th>
										<th width= "260px">Location</th>
										<th class="hidden-480">Date</th>
										<!--<th class="hidden-480">Status</th>-->
										<th class="hidden-480">View</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    				//print_r($reports);
                    				foreach($reports as $key => $val){
									
										
                    				?>
										<tr class="odd gradeX">
										<!--<td><input type="checkbox" class="checkboxes" value="<?php echo $val->report_id;?>" name="report[]"/></td>-->
											<td><?php if($val->user_type == 'admin'){echo "Admin User";}else{
												echo ($val->username) ;
											} ?></td>
											<td><?php echo ($val->crime_name) ;?></td>
											

											<td><?php echo $val->crime_location;?></td>

											<td><?php echo stripslashes($val->crime_date);?></td>
										
										<!--<td class="hidden-480">
																				   
										   <div class="controls">
										   
						<select class="span6 chosen" tabindex="1" style="width:104px;" id="stat<?php echo $val->type_id?>" onChange="changestatus(this.value,'<?php echo $val->type_id?>')">
												<option value="active" <?php if($val->status == '1'){ ?> selected="selected"<?php }?>>Active</option>
												<option value="inactive" <?php if($val->status == '0'){?> selected="selected"<?php }?>>Inactive</option>
						</select>
										  </div>
										
										</td>-->
										
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="<?php echo base_url()?>admin/report/edit_report/<?php echo $val->report_id;?>"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->report_id?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									<?php
                    					}
           							?>

									</tbody>
								</table>