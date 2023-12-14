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
			<?php echo messages(); ?>
			<div class="portlet-body">
				<?php if (!$isAjax): ?>
				<h1>
					<?php /* echo lang('role_page_name'); */ ?>
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
										Save as PDF </a>
									</li>
									<li>
										<a href="javascript:;">
										Export to Excel </a>
									</li>
									<li>
										<a href="javascript:;">
										Export to CSV </a>
									</li>
									<li>
										<a href="javascript:;">
										Export to XML </a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="javascript:;">
										Print </a>
									</li>
								</ul>
							</div>
						</div>
						-->
					</div>
				</h1>
				<?php /* echo messages(); */ ?>
				<!--<div class="row">
					<div class="col-md-6">-->
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
	<div class="col-md-6">
		<div class="portlet red-pink box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Role Form
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
			<div class="portlet-body">
				<!--<div class="row">-->	
					<!-- Right column -->
					<!--<div class="col-md-6">-->
				<?php endif; ?>
						<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'id' => 'role-form', 'name' => 'role-form')); ?>
							<?php if (validation_errors()): ?>
							<ul class="message error no-margin">
								<?php echo validation_errors(); ?>
							</ul>
							<?php endif; ?>
							<?php 
							echo form_hidden(array('id' => set_value('id', isset($role->id) ? $role->id : '')));
							if (isset($redirect))
								echo form_hidden(array('redirect' => $redirect));
							?>
							<fieldset>
								<legend><?php echo lang('role_page_name'); ?></legend>
								<div class="form-group">
									<?php echo form_label(lang('role_name'), 'name', array('class' => 'col-sm-2 control-label required')); ?>
									<div class="col-sm-10">
										<?php echo form_input(array(
											'name'		=> 'name',
											'id'		=> 'name',
											'value'		=> set_value('name', isset($role->name) ? $role->name : ''),
											'maxlength'	=> '255',
											'class'		=> 'form-control' . (form_error('name') ? ' error' : '')
										)); ?>
									</div>
								</div>
								<?php 
								function generate_options($tree, $sep = '')
								{
									$result = array();
									foreach($tree as $node)
									{
										$result[$node['id']] = $sep . $node['name'];
										if (isset($node['children']))
											$result = $result + generate_options($node['children'], $sep . '&nbsp;&nbsp;');
									}
									return $result;
								}
								$parents = array(0 => '(' . lang('none') . ')') + generate_options($role_tree);
								if (isset($role->id) && isset($parents[$role->id]))
									unset($parents[$role->id]);

								$isLabelEchoed = FALSE;
								if (isset($role->parents))
								{
									foreach($role->parents as $index => $parent)
									{
										echo '<div class="form-group">';
										if (! $isLabelEchoed)
										{
											echo form_label(lang('role_parents'), 'parents[' . $index . ']', array('class' => 'col-sm-2 control-label'));
											$isLabelEchoed = TRUE;
										}
										else
											echo form_label('', 'parents[' . $index . ']', array('class' => 'col-sm-2 control-label'));
										echo '<div class="col-sm-10">'; 
										echo form_dropdown('parents[' . $index . ']', 
											$parents,
											set_value('parents[' . $index . ']', $parent->parent),
											'class="form-control"'
										);
										echo '</div></div>';
									}
								}
								echo '<div class="form-group">';
								if (! $isLabelEchoed)
								{
									echo form_label(lang('role_parents'), 'parents[]', array('class' => 'col-sm-2 control-label'));
									$isLabelEchoed = TRUE;
								}
								else
									echo form_label('', 'parents[]', array('class' => 'col-sm-2 control-label'));
								echo '<div class="col-sm-10">';
								echo form_dropdown('parents[]', $parents, 0, 'class="form-control"');
								echo '</div></div>';
								?>
							</fieldset>
							<?php if (!$isAjax): ?>
							<div class="form-actions">
								<?php
								if($acl->is_allowed('acl/role/edit'))
								{
									echo form_button(array(
										'type' => 'submit',
										'name' => 'save-btn',
										'value' => 'save',
										'content' => lang('save'),
										'class' => 'btn btn-primary'
									));
								}
								?>
								<a href="<?php echo site_url('acl/role'); ?>" class="btn btn-default"><?php echo lang('cancel') ?></a>
							</div>
							<?php endif; ?>
						<?php echo form_close(); ?>
				<?php if (!$isAjax): ?>
					<!--</div>
				</div>-->
				<?php endif; ?>
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
