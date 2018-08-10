<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
				<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										
										<th class="hidden-480">Accessories</th>
										<th class="hidden-480">Sub Category</th>
										<th class="hidden-480">Subcategory image</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    
                    				foreach($sub_subcategory as $key => $val)
                    				{
	
							if($val->sub_subcategory_image== "")
							{
								$pic = base_url()."assets/upload/nopic.jpg";
							}
							else
							{
								$pic = $val->sub_subcategory_image;
							}
					
                    				?>
										<tr class="odd gradeX">
					<td><input type="checkbox" class="checkboxes" value="<?php echo $val->sub_subcategory_id;?>" name="accessory[]"/></td>

											<td><?php echo $val->sub_subcategory;?></td>
											
											<td><?php echo getSubCategoryName($val->subcategory_id);?></td>
											<td class="hidden-480">
										
										
								<img src="<?php echo $pic?>" alt="" width="100px;">
												
										
											</td>
											
											<td class="hidden-480">
																				   
										   <div class="controls">
				<select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?php echo $val->sub_subcategory_id;?>" onChange="changestatus(this.value,'<?php echo $val->sub_subcategory_id;?>')">
					<option value="true" <?php if($val->status == 'Yes'){ ?> selected="selected"<?php }?>>On</option>
					<option value="false" <?php if($val->status == 'No'){?> selected="selected"<?php }?>>Off</option>
				</select>
										  </div>
										
										</td>
<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="#popup" onclick="edit('<?php echo $val->sub_subcategory_id;?>')"><i class="icon-edit"></i> Edit</a></td>
	
	<td><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->sub_subcategory_id;?>)"><i class="icon-trash"></i> Delete</a></td>
										<!--	<td ><span class="label label-success">Approved</span></td>-->
										</tr>
									<?php
                    					}
           							?>

									</tbody>
								</table>
