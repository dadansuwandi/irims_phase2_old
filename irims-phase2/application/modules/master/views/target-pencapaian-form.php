<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Target
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Target</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-table"></i>Risk Target
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

						<input type="hidden" name="id" value="<?php echo !empty($id) ? $id : ''; ?>"/>
						<input type="hidden" name="unit_id" value="<?php echo !empty($unit_id) ? $unit_id : ''; ?>"/>
							
						<div class="form-group">
							<label class="control-label col-md-2">Branch <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" value="<?php echo !empty($unit) ? $unit : ''; ?>" class="form-control" readonly="readonly"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Year <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" readonly="readonly" name="tahun" value="<?php echo !empty($tahun) ? $tahun : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Target <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="target" value="<?php echo !empty($target) ? $target : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Implementation Date Sart <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="start_date" value="<?php echo !empty($start_date) ? $start_date : ''; ?>" data-required="1" class="form-control date-picker" data-date-format="yyyy-mm-dd"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Implementation Date End <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="end_date" value="<?php echo !empty($end_date) ? $end_date : ''; ?>" data-required="1" class="form-control date-picker" data-date-format="yyyy-mm-dd"/>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button>
								<a href="<?php echo site_url('master/target_pencapaian/index'); ?>" title="View" class="btn default">Cancel</i></a>
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

		$('body').on("focus", ".date-picker", function(){
			$(this).datepicker({
	            rtl: Metronic.isRTL(),
	            orientation: "left",
	            autoclose: true,
	        });
        });
	});
</script>
<!-- END JAVASCRIPTS -->
