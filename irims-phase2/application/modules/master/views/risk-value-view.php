<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Value <small><?php echo $this->config->item('page_title'); ?></small>
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
			<a href="<?php echo site_url('master/risk_value/index'); ?>">Risk Value</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_value/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('master/risk_value/index'); ?>">Risk Value</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_value/edit/' . $this->uri->segment(4)); ?>">Edit</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'view') {
		?>
		<li>
			<a href="<?php echo site_url('master/risk_value/index'); ?>">Risk Value</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_value/view/' . $this->uri->segment(4)); ?>">View</a>
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
					<i class="fa fa-table"></i>Risk Value
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
							<label class="control-label col-md-2" hidden>Id <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="hidden" name="id" value="<?php echo !empty($row->id) ? $row->id : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Risk Probability <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="risk_probability" value="<?php echo $this->risk_probability_model->get_by_id($row->risk_probability_id)->rating_value; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Risk Impact <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="risk_impact" value="<?php echo $this->risk_impact_model->get_by_id($row->risk_impact_id)->alphabet; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Risk Level <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="risk_level" value="<?php echo $this->risk_level_model->get_by_id($row->risk_level_id)->name; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Rangking <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="rangking" value="<?php echo !empty($row->rangking) ? $row->rangking : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Description <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="description" value="<?php echo !empty($row->description) ? $row->description : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<a href="<?php echo site_url('master/risk_value/index'); ?>" title="View" class="btn green">Back</i></a>
								<a href="<?php echo site_url('master/risk_value/edit/' . $row->id); ?>" title="View" class="btn green">Edit</i></a>
								<a href="<?php echo site_url('master/risk_value/index'); ?>" title="View" class="btn default">Cancel</i></a>
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
