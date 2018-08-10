<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<!--<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>-->
										<th class="hidden-380" style="width: 400px;">Post Desc</th>
										<th class="hidden-480">Posted By</th>
										<th width= "hidden-180">Posted Date</th>
										<th class="hidden-480">Is Report</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    				//print_r($reports);
                    				foreach($posts as $key => $val){
									
										
                    				?>
										<tr class="odd gradeX">
										
											<td width = "hidden-180"><?php echo ($val->post_desc) ;?></td>
											

											<td><?php echo $val->first_name.' '.$val->last_name;?></td>

											<td><?php echo date('Y-m-d',strtotime($val->posted_date));?></td>
										
										<td class="hidden-480">
																				   
										   <div class="controls">
										   
						<select class="span6 chosen" tabindex="1" style="width:104px;" id="stat<?php echo $val->post_id?>" onChange="changestatus(this.value,'<?php echo $val->post_id?>')">
												<option value="1" <?php if($val->is_report == '1'){ ?> selected="selected"<?php }?>>Yes</option>
												<option value="0" <?php if($val->is_report == '0'){?> selected="selected"<?php }?>>No</option>
						</select>
										  </div>
										
										</td>
										
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->post_id?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									<?php
                    					}
           							?>

									</tbody>
								</table>