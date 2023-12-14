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
					<i class="fa fa-cogs"></i>Rule Form
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
				<!--<h1>
					<?php /* echo lang('rule_page_name'); */ ?>
				</h1>-->
				<?php /* echo messages(); */ ?>
				<?php if (!$isAjax): ?>
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
	<div class="col-md-6">
		<div class="portlet green-meadow box">
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
				<!--<div class="row">	
					<div class="col-sm-6">-->
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
								<?php echo form_uneditable(lang('role_name'), '<a href="' . site_url('acl/role/edit') . '/' . $role->id . '">' . $role->name . '</a>'); ?>
								<?php
								$parents_value = '';
								if (isset($role->parents) && count($role->parents) > 0)
								{
									foreach($role->parents as $index => $parent)
									{
										$parents_value .= '<a href="' . site_url('acl/rule/edit/') . '/' . $parent->parent . '" style="display: block; padding: 0 0 .5em 20px;">';
										$parents_value .= '<img src="' . image_url('fugue/users.png') .'" width="16" height="16" style="float: left; margin: 2px 0 0 -20px"/>';
										$parents_value .= $parent->parent_name;
										$parents_value .= '</a>';
									}
								}
								else
									$parents_value = '-';
								?>
								<?php echo form_uneditable(lang('role_parents'), $parents_value); ?>
							</fieldset>
							<fieldset>
								<legend><?php echo lang('rule_page_name'); ?></legend>
								<table class="table table-bordered table-striped table-hover" id="table_resources">
									<thead>
										<tr>
											<th>Resource</th>
											<th style="width: 5em; text-align: center;"><?php echo lang('rule_allow'); ?></th>
											<th style="width: 5em; text-align: center;"><?php echo lang('rule_deny'); ?></th>
											<th style="width: 5em; text-align: center;"><?php echo lang('rule_inherited'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										function display_resource($role, $tree, $values, $acl, $sep, $iParent)
										{
											$i = 0;
											foreach($tree as $node):
												$i++;
										?>
										<tr>
											<?php
											$icon = 'document';
											switch($node['type'])
											{
												case 'module':
													$icon = 'application-block';
													break;
												case 'controller':
													$icon = 'application-icon-large';
													break;
												case 'action':
													$icon = 'application-dialog';
													break;
											}
											?>
											<td>
												<?php echo $sep ?><img src="<?php echo image_url('fugue/' . $icon . '.png'); ?>" width="16" height="16" />&nbsp;<?php echo $node['name'] ?>
											</td>
											<?php 
												$checkname = 'rule_resource[' . $node['id'] . ']'; 
												$value = TRUE;
												if (isset($values[$node['id']]))
													$value = $values[$node['id']]->access;
											?>
											<td style="text-align: center">
												<input type="radio" id="allow<?php echo $iParent.'_'.$i?>" name="<?php echo $checkname ?>" value="allow" <?php echo set_radio($checkname, 'allow', ($value == 'allow')); ?> />
											</td>
											<td style="text-align: center">
												<input type="radio" id="deny<?php echo $iParent.'_'.$i?>" name="<?php echo $checkname ?>" value="deny" <?php echo set_radio($checkname, 'deny', ($value == 'deny')); ?> />
											</td>
											<td style="text-align: center">
												<?php
												if ($value == 'allow')
													$acl->removeAllow($role, $node['name']);
												elseif ($value == 'deny')
													$acl->removeDeny($role, $node['name']);
												?>
												<input type="radio" name="<?php echo $checkname ?>" value="" <?php echo set_radio($checkname, '', ($value)); ?> /> 
												<?php if ($acl->isAllowed($role, $node['name'])): ?>
												<em style="color: green;">Allow</em>
												<?php else: ?>
												<em style="color: #999;">Deny</em>
												<?php endif; ?>
											</td>
										</tr>
										<?php	
												if (isset($node['children']))
													display_resource($role, $node['children'], $values, $acl, $sep . '&nbsp;&nbsp;&nbsp;&nbsp;', $iParent.'_'.$i);
											endforeach;
										}
										$sep = '';
										display_resource($role->name, $resources, $rules, $acl->acl, $sep, '');
										?>
									</tbody>
								</table>
							</fieldset>
							<?php if (!$isAjax): ?>
							<div class="form-actions" style="padding-left: 20px;">
								<?php 
								if($acl->is_allowed('acl/rule/edit'))
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
							</div>
							<?php endif; ?>
						<?php echo form_close(); ?>
				<?php if (!$isAjax): ?>
					<!--</div>
				</div>-->

								<!-- Right column -->
								<div class="content-right"><div>

							</div>
						</div>
					</div>
				</section>
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

<script>
    $('table#table_resources input[type="radio"]').change(function(){
        var $this = $(this);
        var id    = $this.attr('id');
        $('input[id^="'+id+'"]').attr('checked', true);

    })
</script>