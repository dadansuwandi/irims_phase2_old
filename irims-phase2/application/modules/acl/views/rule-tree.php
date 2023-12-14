<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Rule <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('acl/rule/index'); ?>">Rule</a>
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
		<div class="portlet blue-hoki box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Rule
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
			<?php echo messages(); ?>
			<div class="portlet-body">
				<!--<div class="row">
					<div class="col-sm-6">-->
						<?php
							function display_tree($tree, $acl)
							{
								foreach($tree as $node)
								{
									echo '<li>';
									if (isset($node['children']))
										echo '<span class="toggle"></span>';
										if($acl->is_allowed('acl/rule/edit'))
										{
											echo '<a href="' . site_url('acl/rule/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
											echo '<span>' . $node['name'] . '</span>';
											echo '</a>';
										} else {
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
