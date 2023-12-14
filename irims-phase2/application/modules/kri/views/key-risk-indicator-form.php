<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Key Risk Indicator (KRI) <small><?php echo $this->config->item('page_title'); ?></small>
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
			<a href="<?php echo site_url('kri/key_risk_indicator/index'); ?>">Key Risk Indicator (KRI)</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('kri/key_risk_indicator/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('kri/key_risk_indicator/index'); ?>">Key Risk Indicator (KRI)</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('kri/key_risk_indicator/edit/' . $this->uri->segment(4)); ?>">Edit</a>
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
					<i class="fa fa-table"></i>Key Risk Indicator (KRI)
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
								<input type="hidden" name="KEY_RISK_INDICATOR_ID" value="<?php echo !empty($KEY_RISK_INDICATOR_ID) ? $KEY_RISK_INDICATOR_ID : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Code <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="CODE" value="<?php echo !empty($CODE) ? $CODE : ''; ?>" data-required="1" class="form-control" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">User Risk Owner <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="auth_user_id">
									<?php foreach($auth_users as $key=>$val): ?>
									<?php if($key==$auth_user_id) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">KPI <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="risk_kpi_id">
									<?php foreach($risk_kpi as $key=>$val): ?>
									<?php if($key==$risk_kpi_id) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Risk Register <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="RISK_ITEM_ID">
									<?php foreach($RISK_ITEM as $key=>$val): ?>
									<?php if($key==$RISK_ITEM_ID) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Urutan Top Risk <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="number" name="TOP_RISK_NUMBER" value="<?php echo !empty($TOP_RISK_NUMBER) ? $TOP_RISK_NUMBER : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Risk Event<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="HAZARD" data-error-container="#editor1_error"><?php echo !empty($HAZARD) ? $HAZARD : ''; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Basic Event<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="BASIC_EVENT" data-error-container="#editor1_error"><?php echo !empty($BASIC_EVENT) ? $BASIC_EVENT : ''; ?></textarea>
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Penyebab Utama<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="PENYEBAB" data-error-container="#editor1_error"><?php // echo !empty($PENYEBAB) ? $PENYEBAB : ''; ?></textarea>
							</div>
						</div> -->
						<div class="form-group">
							<label class="control-label col-md-2">Indicator Number <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="INDICATOR_NUMBER" value="<?php echo !empty($INDICATOR_NUMBER) ? $INDICATOR_NUMBER : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Key Risk Indicator <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="INDICATOR_ID">
									<?php foreach($INDICATOR as $key=>$val): ?>
									<?php if($key==$INDICATOR_ID) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Dashboard Description<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="DASHBOARD_DESCRIPTION" data-error-container="#editor1_error"><?php echo !empty($DASHBOARD_DESCRIPTION) ? $DASHBOARD_DESCRIPTION : ''; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">KRI Threshold <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="key_risk_indicator_threshold_id">
									<?php foreach($INDICATOR_THRESHOLD as $key=>$val): ?>
									<?php if($key==$key_risk_indicator_threshold_id) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Nilai Threshold <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="number" name="THRESHOLD_VALUE" value="<?php //echo !empty($THRESHOLD_VALUE) ? $THRESHOLD_VALUE : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div> -->
						<div class="form-group">
							<label class="control-label col-md-2">Measure Unit <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="measure_unit" value="<?php echo !empty($measure_unit) ? $measure_unit : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Leading / Lagging <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="LEADING_LAGGING">
									<?php foreach($LEADING_LAGGING_VALUE as $key=>$val): ?>
									<?php if($key==$LEADING_LAGGING) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Traking Frequency <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="TRAKING_FREQUENCY" value="<?php // echo !empty($TRAKING_FREQUENCY) ? $TRAKING_FREQUENCY : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div> -->
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Threshold Batas Bawah<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="THRESHOLD_BAWAH" data-error-container="#editor1_error"><?php // echo !empty($THRESHOLD_BAWAH) ? $THRESHOLD_BAWAH : ''; ?></textarea>
							</div>
						</div> -->
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Threshold Batas Atas<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="THRESHOLD_ATAS" data-error-container="#editor1_error"><?php // echo !empty($THRESHOLD_ATAS) ? $THRESHOLD_ATAS : ''; ?></textarea>
							</div>
						</div> -->
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Data Source<span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="DATA_SOURCE" data-error-container="#editor1_error"><?php // echo !empty($DATA_SOURCE) ? $DATA_SOURCE : ''; ?></textarea>
							</div>
						</div> -->
						<!-- <div class="form-group">
							<label class="control-label col-md-2">Indicator <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="INDICATOR_RANGKING" value="<?php // echo !empty($INDICATOR_RANGKING) ? $INDICATOR_RANGKING : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div> -->
						<div class="form-group">
							<label class="control-label col-md-2">Status <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="STATUS">
									<?php foreach($STATUS as $key=>$val): ?>
									<?php if($key==$STATUS_ID) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button>
								<!--<button type="submit" class="btn default" id="cancel-button" value="Cancel" name="cancel-button">Cancel</button>-->
								<a href="<?php echo site_url('kri/key_risk_indicator/index'); ?>" title="View" class="btn default">Cancel</i></a>
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
