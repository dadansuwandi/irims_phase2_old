<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Role <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('acl/role/index'); ?>">Role</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
	<!--
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
			Actions <i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="#">Action</a>
				</li>
				<li>
					<a href="#">Another action</a>
				</li>
				<li>
					<a href="#">Something else here</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="#">Separated link</a>
				</li>
			</ul>
		</div>
	</div>
	-->
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-6">
		<div class="portlet green-meadow box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Role
				</div>
				<!--
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
				-->
			</div>
			<?php /* echo messages(); */ ?>
			<div class="portlet-body">
				<h1>
					<?php /*echo lang('role_page_name'); echo 'Add Role';*/ ?>
					<?php /* if($acl->is_allowed('acl/role/add')){ */ ?>
					<!--<a href="<?php /* echo site_url('acl/role/add') */ ?>?redirect=<?php /* echo urlencode(current_url_params()); */ ?>" class="btn" title="<?php /* echo lang('role_add_title'); */ ?>">
						<i class="icon-plus"></i>
					</a>-->
					<?php /* } */ ?>
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<?php if($acl->is_allowed('acl/role/add')){ ?>
								<a href="<?php echo site_url('acl/role/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
								<?php } ?>
							</div>
						</div>
						<!--
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button class="btn yellow dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								Tools <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-pdf-o"></i>
										Save as PDF </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-excel-o"></i>
										Export to Excel </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-text-o"></i>
										Export to CSV </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-code-o"></i>
										Export to XML </a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-print"></i>
										Print </a>
									</li>
								</ul>
							</div>
						</div>
						-->
					</div>
				</h1>
				<?php echo messages(); ?>
				<!--<div class="row">
					<div class="col-md-12">-->
						<?php
							function display_tree($tree, $acl)
							{
								foreach($tree as $node)
								{
									echo '<li>';
									if (isset($node['children']))
										echo '<span class="toggle"></span>';
										if($acl->is_allowed('acl/role/edit')){
											echo '<a href="' . site_url('acl/role/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
											echo '<span>' . $node['name'] . '</span>';
											echo '</a>';
										}else{
											echo '<span>' . $node['name'] . '</span>';
										}
									if (isset($node['children']))
									{
										echo '<ul>';
										display_tree($node['children'], $acl);
										echo '</ul>';
									}
									echo '</li>';
								}
							}
							?>
							<ul class="arbo">
								<?php display_tree($role_tree, $acl); ?>
							</ul>
					<!--</div>
				</div>-->
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {    
		UITree.init();
	});
</script>
<!-- END JAVASCRIPTS -->

<!-- ------------------------ -->
