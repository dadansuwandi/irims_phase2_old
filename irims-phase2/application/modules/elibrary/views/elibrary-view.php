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
		<?php
		if($this->uri->segment(3) == 'add') {
		?>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/index'); ?>">E-library</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/index'); ?>">E-library</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/edit/' . $this->uri->segment(4)); ?>">Edit</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'view') {
		?>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/index'); ?>">E-library</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('elibrary/elibrary/view/' . $this->uri->segment(4)); ?>">View</a>
		</li>
		<?php
		}
		?>
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
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-table"></i>E-library
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
			<div class="portlet-body form">
				<?php echo messages(); ?>
				<!-- BEGIN FORM-->
				<form id="form_sample_3" class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="form-body">
						<!-- <h3 class="form-section">Advance validation. <small>Custom radio buttons, checkboxes and Select2 dropdowns</small></h3> -->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<?php /* echo $form->fields(); */ ?>
						<div class="form-group" hidden>
							<label class="control-label col-md-2" hidden>TX_ELIBRARY_ID <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="hidden" name="TX_ELIBRARY_ID" value="<?php echo !empty($row->TX_ELIBRARY_ID) ? $row->TX_ELIBRARY_ID : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">FILE_NAME <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="FILE_NAME" value="<?php echo !empty($row->FILE_NAME) ? $row->FILE_NAME : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">FILE_PATH <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="FILE_PATH" value="<?php echo !empty($row->FILE_PATH) ? $row->FILE_PATH : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="control-label col-md-2">Status <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="status" value="<?php echo !empty($status->name) ? $status->name : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Unit <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="unit" value="<?php echo !empty($unit->name) ? $unit->name : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						-->
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<a href="<?php echo site_url('elibrary/elibrary/index'); ?>" title="View" class="btn green">Back</i></a>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		FormValidation.init();
	});
</script>
<!-- END JAVASCRIPTS -->
