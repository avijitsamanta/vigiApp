<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										
										<th class="hidden-480">City</th>
										<th class="hidden-480">Region</th>
										<!--<th class="hidden-480">Status</th>-->
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php                    
                    				foreach($city as $key => $val)
                    				{
                    				?>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="<?php echo $val->id;?>" name="city[]"/></td>
											<td><?php echo stripslashes($val->city_name);?></td>
											<td><?php echo stripslashes($val->region);?></td>
										
											

										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="#popup" onclick="edit('<?php echo $val->id;?>')"><i class="icon-edit"></i> Edit</a></td>
										<td><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->id;?>)"><i class="icon-trash"></i> Delete</a></td>
										
										</tr>
									<?php
                    				}
           							?>

									</tbody>
</table>
								
