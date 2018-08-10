
<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										<th class="hidden-480">Sender Image</th>
										<th class="hidden-480">Sender Name</th>
										<th class="hidden-480">Email</th>
										<th class="hidden-480">Phone</th>
										<!--<th class="hidden-480">Review</th>-->
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    
                    				foreach($testimonial as $key => $val){
									
										// Get pic
										if($val->sender_image== "")
										{
											$pic = "nopic.jpg";
										}
										
										else
										{
											$pic = $val->sender_image;
										}
                    				?>
										<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="<?php echo $val->testimonial_id?>" name="test[]"/></td>
										<td class="hidden-480">
										
											<div class="tile image double selected">
												<div class="tile-body">
													<img src="<?php echo base_url()."uploads/images/".$pic?>" alt="">
												</div>
											</div>
										
										</td>
										<td class="hidden-480"><?php echo stripslashes($val->sender_name)?></td>
										<td class="hidden-480"><?php echo stripslashes($val->sender_email)?></td>
										<td class="hidden-480"><?php echo stripslashes($val->sender_phone)?></td>
								<!--		<td class="hidden-480"><div style="width:200px;"><?php //echo substr(stripslashes($val->review),0,150)?></div></td>-->
																				
										<td class="hidden-480">
																			   
										   <div class="controls">
<select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?php echo $val->testimonial_id?>" onChange="changestatus(this.value,'<?php echo $val->testimonial_id?>')">
												<option value="true" <?php if($val->status == 'Yes'){ ?> selected="selected"<?php }?>>On</option>
												<option value="false" <?php if($val->status == 'No'){?> selected="selected"<?php }?>>Off</option>
						</select>
										  </div>
										
										</td>
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="<?php echo base_url()?>admin/testimonial/edittestimonial/<?php echo $val->testimonial_id;?>"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?php echo $val->testimonial_id?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									<?php
                    					}
           							?>

									</tbody>
								</table>
						
							