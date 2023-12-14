<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Resource <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('acl/resource/index'); ?>">Resource</a>
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
		<div class="portlet red-pink box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Resource
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
			<!-- <h1> -->
				<?php //echo lang('rule_page_name'); ?>
			<!-- </h1> -->
			<?php /* echo messages(); */ ?>
			<div class="portlet-body">
				<h1>
					<?php /*echo lang('resource_page_name'); echo 'Add';*/ ?>
					<?php /* if($acl->is_allowed('acl/resource/add')){ */ ?>
					<!--<a href="<?php /* echo site_url('acl/resource/add') */ ?>?redirect=<?php /* echo urlencode(current_url_params()); */ ?>" class="btn" title="<?php /* echo lang('resource_add_title'); */ ?>">
						<i class="icon-plus"></i>
					</a>-->
					<?php /* } */ ?>
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<?php if($acl->is_allowed('acl/resource/add')){ ?>
								<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
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
						function display_tree($tree, $curr_id = 0, $acl)
						{
							foreach($tree as $node)
							{
								echo '<li>';
								if (isset($node['children']))
									echo '<span class="toggle"></span>';
								$class = $node['type'];
								if ($node['id'] == $curr_id)
									$class .= ' current';
									if($acl->is_allowed('acl/resource/edit')){
										echo '<a href="' . site_url('acl/resource/edit') . '/' . $node['id'] . '?redirect=' . urlencode(site_url('acl/resource')) . '" class="' . $class . '">';
										echo '<span>' . $node['name'] . '</span>';
										echo '</a>';
									}else{
										echo '<span>' . $node['name'] . '</span>';
									}
								if (isset($node['children']))
								{
									echo '<ul>';
									display_tree($node['children'], $curr_id, $acl);
									echo '</ul>';
								}
								echo '</li>';
							}
						}
						?>
						<ul class="arbo">
							<?php display_tree($resource_tree, (isset($resource->id) ? $resource->id : 0), $acl); ?>
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
