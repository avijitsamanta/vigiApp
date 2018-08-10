<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
									<tr>
					<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										<th class="hidden-480">Blog Description</th>
										<th class="hidden-480">Product Category</th>
										<th class="hidden-480">Post Date</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>	
									</tr>
									</thead>
									<tbody>
							<?php
                    		foreach($blog as $key => $val)
							{

								
                    		?>
							<tr class="odd gradeX">
			<td><input type="checkbox" class="checkboxes" value="<?php echo $val->blog_id?>" name="blog[]"/></td>							
			<td class="hidden-480"><div style="width:200px;"><?php echo substr(stripslashes($val->blog_description),0,150)?></div></td>
			<td class="hidden-480"><?php echo getCategoryName($val->category_id);?></td>
			<td class="hidden-480"><?php echo $val->post_date;?></td>	
												
										<td class="hidden-480">
																				   
										   <div class="controls">
			<select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?php echo $val->blog_id?>" onChange="changestatus(this.value,'<?php echo $val->blog_id?>')">
				<option value="true" <?php if($val->status == 'Yes'){ ?> selected="selected"<?php }?>>On</option>
				<option value="false" <?php if($val->status == 'No'){?> selected="selected"<?php }?>>Off</option>
			</select>
										  </div>
										
										</td>
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="<?php echo base_url()?>admin/blogs/editBlog/<?php echo $val->blog_id;?>"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->blog_id?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
							<?php
                    					}
           						?>

									</tbody>
								</table>