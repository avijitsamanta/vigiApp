<?php 
$page = $this->uri->segment(2);
?>
<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        	
			<ul>
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!--<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />				
							<input type="button" class="submit" value=" " />
						</div>
					</form>-->
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?php echo  $page =='dashboard' ? 'active' : '' ?>">
					<a href="<?php echo base_url()?>admin/dashboard">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>

				<li class="has-sub <?php echo  $page =='vig_user' ? 'active' : '' ?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">User</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url();?>admin/vig_user">Manage User</a></li>
					</ul>
				</li>

				<li class="has-sub <?php echo  $page =='report' ? 'active' : '' ?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Crime</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url();?>admin/report">Manage Crime</a></li>
					</ul>
				</li>
				
				<li class="has-sub <?php echo  $page =='crimes' ? 'active' : '' ?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Crime Type</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url();?>admin/crimes">Manage Crime Type</a></li>
					</ul>
				</li>

				<li class="has-sub <?php echo  $page =='post' ? 'active' : '' ?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Post</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url();?>admin/post">Manage Post</a></li>
					</ul>
				</li>

				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
