
<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										<th class="hidden-480">Blog Image</th>
										<th class="hidden-480">Blog Title</th>
										<th class="hidden-480">Description</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    
                    				foreach($blog as $key => $val){
									
										// Get pic
										if($val->blog_image== "")
										{
											$pic = "nopic.jpg";
										}
										
										else
										{
											$pic = $val->blog_image;
										}
                    				?>
										<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="<?php echo $val->blog_id?>" name="blog[]"/></td>
										<td class="hidden-480">
										
											<div class="tile image double selected">
												<div class="tile-body">
													<img src="<?php echo base_url()."uploads/images/".$pic?>" alt="">
												</div>
											</div>
										
										</td>
										<td class="hidden-480"><?php echo stripslashes($val->blog_title)?></td>
										
										
										<td class="hidden-480"><div style="width:200px;"><?php echo substr(stripslashes($val->blog_description),0,150)?></div></td>
										<td class="hidden-480"><?php echo stripslashes($val->post_date)?></td>										
										<td class="hidden-480">
																				   
										   <div class="controls">
						<select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?php echo $val->blog_id?>" onChange="changestatus(this.value,'<?php echo $val->blog_id?>')">
												<option value="true" <?php $val->status == 'Yes' ? 'selected' : ''?>>On</option>
												<option value="false" <?php $val->status == 'No' ? 'selected' : ''?>>Off</option>
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
						
							