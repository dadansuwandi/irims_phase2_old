<!-- BEGIN LOAD MODEL-->
<?php
$this->load->model('acl/role_model');
?>
<!-- END LOAD MODEL-->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Users <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('auth/user/index'); ?>">User</a>
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
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-users"></i>Users
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
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="<?php echo site_url('auth/user/add'); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
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
				</div>
				<table class="table table-striped table-bordered table-hover" id="sample_6">
					<thead>
						<tr>
							<th>No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th class="hidden-xs">Username</th>
							<th class="hidden-xs">Email</th>
							<th class="hidden-xs">Role</th>
							<th class="hidden-xs">Unit</th>
							<th class="hidden-xs">PIC</th>
							<th class="hidden-xs">LDAP</th>
							<th style="width: 120px;">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($users as $user):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $user->first_name; ?></td>
								<td><?php echo $user->last_name; ?></td>
								<td><a href="<?php echo site_url('auth/user/edit/' . $user->id); ?>"><font color="blue"><?php echo $user->username; ?></font></a></td>
								<td><?php echo $user->email; ?></td>
								<td>
									<?php
									$role = $this->role_model->get_by_id($user->role_id);
									if ($role)
										echo $role->name;
									else
										echo '-';
									?>
								</td>
								<td>
									<?php
									$unit = $this->unit_model->get_by_id($user->unit_id);
									if ($unit)
										echo $unit->name;
									else
										echo '-';
									?>
								</td>
								<td>
									<?php
									$pic = $this->risk_pic_model->get_by_id($user->pic_id);
									if ($pic)
										echo $pic->name;
									else
										echo '-';
									?>
								</td>
								<td>
									<?php
									if ($user->LDAP == '1')
										echo 'Yes';
									else
										echo 'No';
									?>
								</td>
								<td>
									<a href="<?php echo site_url('auth/user/edit/' . $user->id); ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a>
									<a href="<?php echo site_url('auth/user/delete/' . $user->id); ?>" class="btn btn-xs red" data-button="delete"> <i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('delete-modal'); ?>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		TableAdvanced.init();
	});
</script>
<!-- END JAVASCRIPTS -->
