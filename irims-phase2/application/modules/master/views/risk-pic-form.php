<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk PIC <small><?php echo $this->config->item('page_title'); ?></small>
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
			<a href="<?php echo site_url('master/risk_pic/index'); ?>">Risk PIC</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_pic/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('master/risk_pic/index'); ?>">Risk PIC</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/risk_pic/edit/' . $this->uri->segment(4)); ?>">Edit</a>
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
					<i class="fa fa-table"></i>Risk PIC
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
								<input type="hidden" name="id" value="<?php echo !empty($id) ? $id : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Unit <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="unit_id">
									<?php foreach($unit as $key=>$val): ?>
									<?php if($key==$unit_id) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Name <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="name" value="<?php echo !empty($name) ? $name : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Parent PIC <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="parent_pic_id">
									<?php 
										if(!empty($parent_pic_id)){
											echo $this->risk_pic_model->get_dropdown_pic_unit($parent_pic_id);
										}else{
											echo $this->risk_pic_model->get_dropdown_pic_unit();
										}	
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Sasaran Organisasi <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea name="objective" data-required="1" class="form-control wysihtml5" rows="6"><?php echo !empty($objective) ? $objective : ''; ?></textarea>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="control-label col-md-2">Tahun<span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input class="form-control form-control-inline input-medium" size="16" type="text" name="year" value="<?php /* echo !empty($year) ? $year : ''; */ ?>" id="years-datepicker"/>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-2">Tanggal<span class="required">
							* </span>
							</label>
							<div class="col-md-3">
								<input class="form-control form-control-inline input-medium" size="16" type="text" name="date" value="<?php /* echo !empty($date) ? $date : ''; */ ?>" id="datepicker"/>
							</div>
						</div>
						-->
						<div class="form-group">
							<label class="control-label col-md-2">KPI <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="kpi" value="<?php echo !empty($kpi) ? $kpi : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Program Kerja <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea name="work_program" data-required="1" class="form-control wysihtml5" rows="6"><?php echo !empty($work_program) ? $work_program : ''; ?></textarea>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button>
								<!--<button type="submit" class="btn default" id="cancel-button" value="Cancel" name="cancel-button">Cancel</button>-->
								<a href="<?php echo site_url('master/risk_pic/index'); ?>" title="View" class="btn default">Cancel</i></a>
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

	$("#years-datepicker").datepicker({
		format: "yyyy",
		viewMode: "years",
		minViewMode: "years",
		autoclose:true //to close picker once year is selected
	});

	$("#datepicker").datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true //to close picker once year is selected
	});
</script>
<!-- END JAVASCRIPTS -->
