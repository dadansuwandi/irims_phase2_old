<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Branch <small><?php echo $this->config->item('page_title'); ?></small>
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
			<a href="<?php echo site_url('master/unit/index'); ?>">Branch</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/unit/add'); ?>">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="<?php echo site_url('master/unit/index'); ?>">Branch</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('master/unit/edit/' . $this->uri->segment(4)); ?>">Edit</a>
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
					<i class="fa fa-table"></i>Branch
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
				<form id="form_sample_3" class="form-horizontal" method="post">
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
							<label class="control-label col-md-2">Code <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="code" value="<?php echo !empty($code) ? $code : ''; ?>" data-required="1" class="form-control"/>
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
							<label class="control-label col-md-2">Address <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="address" value="<?php echo !empty($address) ? $address : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Village <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="village" value="<?php echo !empty($village) ? $village : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">District <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="district" value="<?php echo !empty($district) ? $district : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">City <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="city" value="<?php echo !empty($city) ? $city : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Province <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="province" value="<?php echo !empty($province) ? $province : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Country <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="country" value="<?php echo !empty($country) ? $country : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Phone <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="phone" value="<?php echo !empty($phone) ? $phone : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Fax <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="fax" value="<?php echo !empty($fax) ? $fax : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Mobile Phone <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="mobile_phone" value="<?php echo !empty($mobile_phone) ? $mobile_phone : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Email <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="email" value="<?php echo !empty($email) ? $email : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Is Head Office? <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="checkbox" name="is_kantor_pusat" value="1" <?php echo !empty($is_kantor_pusat) ? "checked='checked'" : ''; ?> data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Show in dashboard? <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="checkbox" name="showin_dashboard" value="1" <?php echo !empty($showin_dashboard) ? "checked='checked'" : ''; ?> data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Sorting <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="sorting" value="<?php echo !empty($sorting) ? $sorting : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Latitude <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="lat" value="<?php echo !empty($lat) ? $lat : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Longitude <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="lon" value="<?php echo !empty($lon) ? $lon : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Description <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="description" value="<?php echo !empty($description) ? $description : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="control-label col-md-2">Status <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="options2">
									<?php foreach($status as $key=>$val): ?>
									<?php if($key==$status_id) { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } else { ?>
									<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Unit <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<select class="form-control select2me" name="options2">
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
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Name <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<input type="text" name="name" data-required="1" class="form-control"/>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="col-md-3 control-label">Email Address <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
									</span>
									<input type="email" name="email" class="form-control" placeholder="Email Address">
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Occupation&nbsp;&nbsp;</label>
							<div class="col-md-4">
								<input name="occupation" type="text" class="form-control"/>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Select2 Dropdown <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<select class="form-control select2me" name="options2">
									<option value="">Select...</option>
									<option value="Option 1">Option 1</option>
									<option value="Option 2">Option 2</option>
									<option value="Option 3">Option 3</option>
									<option value="Option 4">Option 4</option>
								</select>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Select2 Tags <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<input type="hidden" class="form-control" id="select2_tags" value="" name="select2tags">
								<span class="help-block">
								select tags </span>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Datepicker</label>
							<div class="col-md-4">
								<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" readonly name="datepicker">
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								-->
								<!-- /input-group -->
								<!--
								<span class="help-block">
								select a date </span>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Membership <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<div class="radio-list" data-error-container="#form_2_membership_error">
									<label>
									<input type="radio" name="membership" value="1"/>
									Fee </label>
									<label>
									<input type="radio" name="membership" value="2"/>
									Professional </label>
								</div>
								<div id="form_2_membership_error">
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Services <span class="required">
							* </span>
							</label>
							<div class="col-md-4">
								<div class="checkbox-list" data-error-container="#form_2_services_error">
									<label>
									<input type="checkbox" value="1" name="service"/> Service 1 </label>
									<label>
									<input type="checkbox" value="2" name="service"/> Service 2 </label>
									<label>
									<input type="checkbox" value="3" name="service"/> Service 3 </label>
								</div>
								<span class="help-block">
								(select at least two) </span>
								<div id="form_2_services_error">
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Markdown</label>
							<div class="col-md-9">
								<textarea name="markdown" data-provide="markdown" rows="10" data-error-container="#editor_error"></textarea>
								<div id="editor_error">
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">WYSIHTML5 Editor <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="wysihtml5 form-control" rows="6" name="editor1" data-error-container="#editor1_error"></textarea>
								<div id="editor1_error">
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="form-group last">
							<label class="control-label col-md-3">CKEditor <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>
								<div id="editor2_error">
								</div>
							</div>
						</div>
						-->
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button>
								<button type="submit" class="btn default" id="cancel-button" value="Cancel" name="cancel-button">Cancel</button>
								<!-- <button type="submit" class="btn green">Submit</button> -->
								<!-- <button type="button" class="btn default">Cancel</button> -->
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
