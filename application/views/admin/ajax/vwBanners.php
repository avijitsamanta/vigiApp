
<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										
										<th class="hidden-480">Category</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    
                    				foreach($cats as $key => $val){
					
                    				?>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="<?php echo $val->id;?>" name="cat[]"/></td>
											<td><?php echo stripslashes($val->cat);?></td>
										
											<td class="hidden-480">
																				   
										   <div class="controls">
											 <select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?php echo $val->id;?>" onChange="changestatus(this.value,'<?php echo $val->id;?>')">
												<option value="true" <?php $val->status == 'Yes' ? 'selected' : ''?>>On</option>
												<option value="false" <?php $val->status == 'No' ? 'selected' : ''?>>Off</option>
											 </select>
										  </div>
										
										</td>
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="#popup" onclick="edit('<?php echo $val->id;?>')"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->id;?>)"><i class="icon-trash"></i> Delete</a></td>
										<!--	<td ><span class="label label-success">Approved</span></td>-->
										</tr>
									<?php
                    					}
           							?>

									</tbody>
								</table>
						
							