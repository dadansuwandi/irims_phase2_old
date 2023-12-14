<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk KPI <small><?php echo $this->config->item('page_title'); ?></small>
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
			<a href="<?php echo site_url('master/risk_kpi/index'); ?>">Risk KPI</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_kpi/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('master/risk_kpi/index'); ?>">Risk KPI</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_kpi/edit/' . $this->uri->segment(4)); ?>">Edit</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'view') {
		?>
		<li>
			<a href="<?php echo site_url('master/risk_kpi/index'); ?>">Risk KPI</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_kpi/view/' . $this->uri->segment(4)); ?>">View</a>
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
					<i class="fa fa-table"></i>Risk KPI
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
							<label class="control-label col-md-2">Code <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="code" value="<?php echo !empty($row->code) ? $row->code : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Name <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="name" value="<?php echo !empty($row->name) ? $row->name : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Target <span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input type="number" name="TARGET" value="<?php echo !empty($row->TARGET) ? $row->TARGET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Satuan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TARGET_SATUAN" value="<?php echo !empty($row->TARGET_SATUAN) ? $row->TARGET_SATUAN : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Keterangan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TARGET_KET" value="<?php echo !empty($row->TARGET_KET) ? $row->TARGET_KET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Target Revisi <span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input type="number" name="TARGET_REVISI" value="<?php echo !empty($row->TARGET_REVISI) ? $row->TARGET_REVISI : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Satuan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TARGET_REVISI_SATUAN" value="<?php echo !empty($row->TARGET_REVISI_SATUAN) ? $row->TARGET_REVISI_SATUAN : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Keterangan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TARGET_REVISI_KET" value="<?php echo !empty($row->TARGET_REVISI_KET) ? $row->TARGET_REVISI_KET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Acceptable <span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input type="number" name="ACCEPTABLE" value="<?php echo !empty($row->ACCEPTABLE) ? $row->ACCEPTABLE : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Satuan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="ACCEPTABLE_SATUAN" value="<?php echo !empty($row->ACCEPTABLE_SATUAN) ? $row->ACCEPTABLE_SATUAN : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Keterangan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="ACCEPTABLE_KET" value="<?php echo !empty($row->ACCEPTABLE_KET) ? $row->ACCEPTABLE_KET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Torelable <span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input type="number" name="TORELABLE" value="<?php echo !empty($row->TORELABLE) ? $row->TORELABLE : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Satuan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TORELABLE_SATUAN" value="<?php echo !empty($row->TORELABLE_SATUAN) ? $row->TORELABLE_SATUAN : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Keterangan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="TORELABLE_KET" value="<?php echo !empty($row->TORELABLE_KET) ? $row->TORELABLE_KET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Unacceptable <span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input type="number" name="UNACCEPTABLE" value="<?php echo !empty($row->UNACCEPTABLE) ? $row->UNACCEPTABLE : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Satuan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="UNACCEPTABLE_SATUAN" value="<?php echo !empty($row->UNACCEPTABLE_SATUAN) ? $row->UNACCEPTABLE_SATUAN : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
							<label class="control-label col-md-1">Keterangan <span class="required">
							* </span>
							</label>
							<div class="col-md-2">
								<input type="text" name="UNACCEPTABLE_KET" value="<?php echo !empty($row->UNACCEPTABLE_KET) ? $row->UNACCEPTABLE_KET : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
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
								<!--<a href="<?php /*echo site_url('master/risk_kpi/edit/' . $row->id);*/ ?>" title="View" class="btn green">Edit</i></a>-->
								<a href="<?php echo site_url('master/risk_kpi/index'); ?>" title="View" class="btn green">Back</i></a>
								<a href="<?php echo site_url('master/risk_kpi/index'); ?>" title="View" class="btn default">Cancel</i></a>
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
