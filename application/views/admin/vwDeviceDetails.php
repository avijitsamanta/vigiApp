
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
						<div class="color-panel hidden-phone">
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
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							User Details
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo base_url()?>admin/dashboard">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">User Details</a></li>
						</ul>
						<?php if(!empty($msg)){?>
							<div class="alert alert-success">
								<button data-dismiss="alert" class="close"></button>
								<strong>Success!</strong> Notification Sent.
			  				</div>
			  			<?php }?>
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
								<h4><i class="icon-globe"></i>User Details</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
									
									<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
											<li><a onclick="add()" data-toggle="modal" href="#popup">Send Notification</a></li>
										</ul>
									</div>
								</div>
								<div id="tablesec">
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										
			
										<th class="hidden-480">Username</th>
									
									
										<th class="hidden-480">Action</th>
											
										</tr>
									</thead>
									<tbody>
									
									<?php                    
                    				foreach($userDetails as $key => $val)
                    				{
                    				?>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="<?php echo $val->userid;?>" name="users[]"/></td>
										
										
											<td><?php echo $val->username;?></td>
											
										
										<td><a class="btn mini green" data-toggle="modal" href="#popup" onclick="edit(<?php echo $val->userid;?>)"> Send Notification</a></td>
										
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
	function edit(id)
	{
	
		
		$.post('<?php echo base_url();?>admin/product/notificationSend',{ id:id ,mode:'single'},
			function(data)
			{
			
				$('#getpopupdata').html(data);
				$(".chosen").chosen();
			}
		)
	}
	
	function add()
	{
		var cat = document.getElementsByName('users[]');
		
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
		
		$.post('<?php echo base_url();?>admin/product/notificationSend',{id:str,mode:'selected'},
			function(data)
			{

				$('#getpopupdata').html(data);
				$(".chosen").chosen();
			}
		);
	
		
	}


	
	function getSubcat(category_id)
	{
		$.post("<?php echo base_url()?>admin/product/getSubcat",{category_id:category_id},function(data){

			$("#subcat_select").html(data);

		});
	}

	
	function sendNotification(id)
	{	
		var cnf = confirm("Are you sure?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('<?php echo base_url();?>admin/product/sendNotification',{ userid : id,mode : 'single' },
				function(data)
				{
					
					
					
					
				}
			);
		}
	}
	
	function sendNotification()
	{
		var cat = document.getElementsByName('users[]');
		
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
			var cnf = confirm("Are you sure?");
		
			if(cnf)
			{
				$('.portlet .tools a.reload').click();
				$.post('<?php echo base_url();?>admin/product/sendNotification',{ userid : str , mode : 'selected' },
					function(data)
					{
						
					}
				);
			}
		}
		else
		{	
			alert('You must select atleast one item');
		}
	}
	</script>


	<script type="text/javascript">
	function sendData()
	{


		var title = $('#title').val();
		var message = $('#message').val();


		if($.trim(title) == '')
		{
			
			$("#title_error").html('Please provide some title.');
			return false;
		}
		else if($.trim(message) == '')
		{
			$("#message_error").html('Please provide some message.');
			return false;	
		}		
		else
		{
			return true;
		}
		return false;
	}
</script>


