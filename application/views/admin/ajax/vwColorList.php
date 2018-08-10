<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										
										<th class="hidden-480">Category</th>
										<th class="hidden-480">Sub Category</th>
										<th class="hidden-480">Color</th>
									
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									
									<?php                    
                    				foreach($colorList as $key => $val)
                    				{
                    				?>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="<?php echo $val->color_id;?>" name="color[]"/></td>
											<td><?php echo getCategoryName($val->product_category_id);?></td>
											<td><?php echo getSubCategoryName($val->product_subcategory_id);?></td>
										
											<td><?php echo $val->color_code;?></td>
											
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="#popup" onclick="edit('<?php echo $val->color_id;?>')"><i class="icon-edit"></i> Edit</a></td>
										<td><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->color_id;?>)"><i class="icon-trash"></i> Delete</a></td>
										
										</tr>
									<?php
                    				}
           							?>

									</tbody>
</table>