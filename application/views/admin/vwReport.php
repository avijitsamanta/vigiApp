
	<!-- BEGIN HEADER -->
	<?php
	$this->load->view('admin/vwHeader');
	?>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
	<?php
	$this->load->view('admin/vwSidebar');
	?>
	
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>

					 <p><?php echo $this->session->flashdata('statusMsg'); ?></p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- START MODAL -->

			<div id="popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div id="getpopupdata"></div>

			</div>

			<!-- END MODAL -->
			<!-- BEGIN PAGE CONTAINER-->			
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<!--<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label class="hidden-phone">
								<input type="checkbox" class="header" checked value="" />
								<span class="color-mode-label">Fixed Header</span>
								</label>							
							</div>
						</div>-->
						<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							Manage Crime
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo base_url()?>admin/dashboard">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
						
							<li><a href="#">Manage Crime</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box light-grey">
							<div class="portlet-title">
								<h4><i class="icon-globe"></i>Managed Crime</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
									<div class="btn-group">
										<a class="btn mini green" href="<?php echo base_url();?>admin/report/add_report">Add New <i class="icon-plus"></i></a>
									</div>

									<div class="btn-group">
										<a class="btn mini green" href="<?php echo base_url();?>admin/report/get_reported_crime">Get Reported Crime</a>
									</div>

									<div class="btn-group">
										<a class="btn mini green" href="<?php echo base_url();?>admin/report/">Get All Crime</a>
									</div>
									<!--<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#" onclick="delselected()">Delete Selected</a></li>
										</ul>
									</div>-->
								</div>
								<div id="tablesec">
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<!--<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>-->
										<th class="hidden-480">Name</th>

										<th class="hidden-480">Crime Name</th>

										<th width= "260px">Location</th>
		
										<th class="hidden-480">Date</th>

										<th class="hidden-480">Is Reported</th>

										<th class="hidden-480">View Details</th>
										
										<!--<th class="hidden-480">Status</th>-->
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
                    				//print_r($reports);exit;
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

											<td class="hidden-480">
											<div class="controls">

												<?php if($val->is_reported == '1'){ ?> Yes <?php } else{ ?> No<?php } ?>
 
											</div>

											</td>

											<td><?php if($val->is_reported == '1'){ ?><a class="btn mini green" data-toggle="modal" href="#popup" onclick="details(<?php echo $val->report_id; ?>)">View Details </a><?php } ?></td>
										
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
								</div>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
				
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	
	<!-- BEGIN FOOTER -->
	<?php
	$this->load->view('admin/vwFooter');
	?>
	<!-- END FOOTER -->
	<script>
	
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('<?php echo base_url();?>admin/report/delete_report',{ reportid : id,mode : 'single' },
				function(data)
				{
					$('#tablesec').html(data);
					
					/************************************ Table JS ************************************/
								
					$('#sample_1').dataTable({
						"aLengthMenu": [
							[5, 15, 20, -1],
							[5, 15, 20, "All"]
						],
						// set the initial value
						"iDisplayLength": 15,
						"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sPaginationType": "bootstrap",
						"oLanguage": {
							"sLengthMenu": "_MENU_ records per page",
							"oPaginate": {
								"sPrevious": "Prev",
								"sNext": "Next"
							}
						},
						"aoColumnDefs": [{
							'bSortable': false,
							'aTargets': [0]
						}]
					});
					
					jQuery('#sample_1 .group-checkable').change(function () {
						var set = jQuery(this).attr("data-set");
						var checked = jQuery(this).is(":checked");
						jQuery(set).each(function () {
							if (checked) {
								$(this).attr("checked", true);
							} else {
								$(this).attr("checked", false);
							}
						});
						jQuery.uniform.update(set);
					});
					
					var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
					if (test) {
						test.uniform();
					}
					
					$(".chosen").chosen();
					
					/************************************ Table JS ************************************/
				}
			);
		}
	}
	
	function delselected()
	{
		var cat = document.getElementsByName('crime[]');
		
		var ln = cat.length;
		
		var flag = 0;
		var str = "";
		
		for(i=0;i<ln;i++)
		{
			if(cat[i].checked)
			{
				str = str + cat[i].value + ',';
			}
		}
		
		if(str != "")
		{
			var cnf = confirm("Are you sure to delete?");
		
			if(cnf)
			{
				$('.portlet .tools a.reload').click();
				$.post('<?php echo base_url();?>admin/crimes/deleteCrime',{ type_id : str , mode : 'selected' },
					function(data)
					{
						$('#tablesec').html(data);
						
						/************************************ Table JS ************************************/
								
						$('#sample_1').dataTable({
							"aLengthMenu": [
								[5, 15, 20, -1],
								[5, 15, 20, "All"]
							],
							// set the initial value
							"iDisplayLength": 15,
							"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
							"sPaginationType": "bootstrap",
							"oLanguage": {
								"sLengthMenu": "_MENU_ records per page",
								"oPaginate": {
									"sPrevious": "Prev",
									"sNext": "Next"
								}
							},
							"aoColumnDefs": [{
								'bSortable': false,
								'aTargets': [0]
							}]
						});
						
						jQuery('#sample_1 .group-checkable').change(function () {
							var set = jQuery(this).attr("data-set");
							var checked = jQuery(this).is(":checked");
							jQuery(set).each(function () {
								if (checked) {
									$(this).attr("checked", true);
								} else {
									$(this).attr("checked", false);
								}
							});
							jQuery.uniform.update(set);
						});
						
						var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
						if (test) {
							test.uniform();
						}
						
						$(".chosen").chosen();
						
						/************************************ Table JS ************************************/
					}
				);
			}
		}
		else
		{	
			alert('You must select atleast one item');
		}
	}
		function changestatus(stat,id)
	{
		//alert('ok');
		$.post('<?php echo base_url();?>admin/crimes/crimestatus',{ stat : stat , id : id });
	}

	function details(id)
	{
		//alert(id);
			$.post('<?php echo base_url();?>admin/report/detailsCrime',{ id : id },
				
			function(data)
			{
				//alert(data);

				$('#getpopupdata').html(data);
				$(".chosen").chosen();
			}
		)
	}
	</script>