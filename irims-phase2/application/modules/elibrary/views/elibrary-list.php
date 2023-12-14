<!-- BEGIN LOAD MODEL-->
<?php
$this->load->model('acl/role_model');
?>
<!-- END LOAD MODEL-->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
E-library <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/index'); ?>">E-library</a>
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
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-list"></i>E-library
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
						<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN):?>
						<div class="col-md-6">
							<div class="btn-group">
								<a href="<?php echo site_url('elibrary/elibrary/add'); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
							</div>
							<div class="btn-group">
								<a href="<?php echo site_url('elibrary/elibrary/delete_file'); ?>" class="btn green">View / Delete <i class="fa fa-minus"></i></a>
							</div>
						</div>
						<?php endif;?>
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
							<th class="hidden-xs">No.</th>
							<?php if ($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN) { ?>
							<th>IS ADMIN ?</th>
							<?php } ?>
							<th>DOWNLOAD FILE</th>
							<th>VIEW FILE</th>
							<th>NAMA FILE</th>
							<th>TANGGAL UPLOAD</th>
							<!-- <th style="width: 14%; align=center;">Actions</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($rows as $row):
							$i++;
							$image = $this->elibrary_model->get_icon($row->FILE_EXT);
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<?php if ($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN) { ?>
								<td><a href="<?php echo site_url('elibrary/elibrary/edit_role/' . $row->TX_ELIBRARY_ID); ?>"><font color="blue"><?php if ($row->ROLE_ID == '1') {echo 'ALLOW';} else {echo 'DENY';}; ?></font></a></td>
								<?php } ?>
								<td><a href="<?php echo base_url() . 'uploads/risk_elibrary/' . $row->FILE_NAME; ?>" download>
									<?php echo $image; ?>
								</a>
								</td>
								<td><a href="<?php echo base_url() . 'uploads/risk_elibrary/' . $row->FILE_NAME; ?>" target="_blank">
									<?php echo $image; ?>
								</a>
								</td>
								<td><?php echo $row->FILE_NAME; ?></td>
								<td><?php echo $row->CREATED_DATE; ?></td>
								<!-- <td style="width: 14%; align=center;">
									<a href="<?php //echo site_url('elibrary/elibrary/view/' . $row->id); ?>" title="View" class="btn btn-xs grey-cascade"><i class="fa fa-search"></i></a>
									<a href="<?php //echo site_url('elibrary/elibrary/edit/' . $row->id); ?>" title="Edit" class="btn btn-xs blue"><i class="fa fa-edit"></i></a>
									<a href="<?php //echo site_url('elibrary/elibrary/delete/' . $row->id); ?>" title="Delete" class="btn btn-xs red" data-button="delete"> <i class="fa fa-times"></i></a> -->
									<!--<a href="#portlet-config" data-toggle="modal" class="btn btn-xs purple"><i class="fa fa-search"></i></a>-->
								<!-- </td> -->
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
