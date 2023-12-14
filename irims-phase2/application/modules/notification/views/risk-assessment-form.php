<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Assessment
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
			<a href="#">Risk Assessment</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Add New</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="#">Risk Assessment</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Edit</a>
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
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-table"></i>Risk Assessment Input Review
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
				<div class="overFlowTable">
				<table class="table table-striped table-bordered table-hover" id="sample_6">
					<thead>
						<tr>
							<th class="hidden-xs" rowspan="2">AKTIVITAS / INSTALASI / PERALATAN</th>
							<th class="hidden-xs" rowspan="2">PENYEBAB</th>
							<th class="hidden-xs" rowspan="2">DAMPAK</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
							<th class="hidden-xs" rowspan="2">TARGET WAKTU</th>
							<th class="hidden-xs" rowspan="2">REALISASI MITIGASI</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
						</tr>

						<tr>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($RISK_IDENTIFICATION_ID)){
						?>
							<tr>
								<td><?php echo $HAZARD; ?></td>
								<td><?php echo $PENYEBAB; ?></td>
								<td><?php echo $DAMPAK; ?></td>
								<td><?php echo $INHERENT_RISK_K_VALUE->rating_value; ?></td>
								<td><?php echo $INHERENT_RISK_D_VALUE->alphabet; ?></td>
								<td><?php echo $PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $RESIDUAL_RISK_K_VALUE->rating_value; ?></td>
								<td><?php echo $RESIDUAL_RISK_D_VALUE->alphabet; ?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->RENCANA_PENGENDALIAN."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$this->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->TARGET_WAKTU."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												if($mitigation[$i]->REALISASI_MITIGASI!=""){
													echo "<li>".$mitigation[$i]->REALISASI_MITIGASI."</li>";
												}
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php echo $MITIGASI_RISK_K_VALUE->rating_value; ?></td>
								<td><?php echo $MITIGASI_RISK_D_VALUE->alphabet; ?></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->


<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i> Risk Assessment Form - <span class="step-title">
					Realisasi Mitigasi</span>
				</div>
				<!-- <div class="tools hidden-xs">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div> -->
			</div>
			<div class="portlet-body form">
				<form  class="form-horizontal" id="risk_identification_form" method="POST">
					<div class="form-wizard">
						<div class="form-body">
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>
							
							<div class="tab-content">
								<div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									Your form validation is successful!
								</div>

								<input type="hidden" class="form-control" name="RISK_IDENTIFICATION_ID" id="risk_identification_id" value="<?php echo !empty($RISK_IDENTIFICATION_ID) ? $RISK_IDENTIFICATION_ID : ''; ?>"/>
									<?php foreach($mitigation as $m){?>
									<div class="form-group">
										<label class="control-label col-md-3">Rencana pengendalian yang akan dilakukan <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" disabled="disabled" rows="6"><?php echo $m->RENCANA_PENGENDALIAN ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">PIC <span class="required">*</span></label>
										<div class="col-md-6">
											<input class="form-control" disabled="disabled" value="<?php echo $this->risk_pic_model->get_by_id($m->PIC_UNIT_KERJA_ID)->name?>"></input>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Realisasi Mitigasi <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" rows="6" required="required" name="REALISASI_MITIGASI[<?php echo $m->RISK_MITIGATION_ID;?>]"><?php echo !empty($m->REALISASI_MITIGASI) ? $m->REALISASI_MITIGASI : ''; ?></textarea>
										</div>
									</div>

									<hr/>
									<?php }?>

									<div class="form-group">
										<label class="control-label col-md-3">Level Kemungkinan (K) <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="MITIGASI_RISK_K_ID" required="required">
												<?php foreach($MITIGASI_RISK_K as $key=>$val): ?>
												<?php if($key==$MITIGASI_RISK_K_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
											<span class="help-block">Level kemungkinan setelah dilakukan kontrol</span>
										</div>
										<label class="btn blue col-md-1 informasi-kemungkinan">Informasi</label>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Level Dampak (D) <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="MITIGASI_RISK_D_ID" required="required">
												<?php foreach($MITIGASI_RISK_D as $key=>$val): ?>
												<?php if($key==$MITIGASI_RISK_D_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
											<span class="help-block">Level dampak setelah dilakukan kontrol</span>
										</div>
										<label class="btn blue col-md-1 informasi-dampak">Informasi</label>
									</div>

									<!-- BEGIN PAGE CONTENT FILE UPLOAD-->
									<div class="row">
										<div class="col-md-12">
											<!--
											<blockquote>
												<p style="font-size:16px">
													 File Upload widget with multiple file selection, drag&amp;drop support, progress bars and preview images for jQuery.<br>
													 Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
													 Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.
												</p>
											</blockquote>
											<br>
											-->
											<label class="control-label col-md-3">Upload File </label>
											<form >
												<!-- Form here! -->
											</form>
											<form id="fileupload" action="<?php echo site_url('risk/risk_assessment/do_upload/'.$RISK_IDENTIFICATION_ID); ?>" method="POST" enctype="multipart/form-data">
												<input type="hidden" class="form-control" name="RISK_IDENTIFICATION_ID" id="risk_identification_id" value="<?php echo !empty($RISK_IDENTIFICATION_ID) ? $RISK_IDENTIFICATION_ID : ''; ?>"/>
												<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
												<div class="row fileupload-buttonbar">
													<div class="col-lg-7">
														<!-- The fileinput-button span is used to style the file input field as button -->
														<span class="btn green fileinput-button">
														<i class="fa fa-plus"></i>
														<span>
														Add files... </span>
														<input type="file" name="userfile" multiple="">
														</span>
														<button type="submit" class="btn blue start">
														<i class="fa fa-upload"></i>
														<span>
														Start upload </span>
														</button>
														<!--
														<button type="reset" class="btn warning cancel">
														<i class="fa fa-ban-circle"></i>
														<span>
														Cancel upload </span>
														</button>
														<button type="button" class="btn red delete">
														<i class="fa fa-trash"></i>
														<span>
														Delete </span>
														</button>
														<input type="checkbox" class="toggle">
														-->
														<!-- The global file processing state -->
														<span class="fileupload-process">
														</span>
													</div>
													<!-- The global progress information -->
													<div class="col-lg-5 fileupload-progress fade">
														<!-- The global progress bar -->
														<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
															<div class="progress-bar progress-bar-success" style="width:0%;">
															</div>
														</div>
														<!-- The extended global progress information -->
														<div class="progress-extended">
															 &nbsp;
														</div>
													</div>
												</div>
												<!-- The table listing the files available for upload/download -->
												<table role="presentation" class="table table-striped clearfix">
												<tbody class="files">
												</tbody>
												</table>
											</form>
											<!-- The blueimp Gallery widget -->
											<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
												<div class="slides">
												</div>
												<h3 class="title"></h3>
												<a class="prev">
												‹ </a>
												<a class="next">
												› </a>
												<a class="close white">
												</a>
												<a class="play-pause">
												</a>
												<ol class="indicator">
												</ol>
											</div>
											<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
											<script id="template-upload" type="text/x-tmpl">
												{% for (var i=0, file; file=o.files[i]; i++) { %}
												    <tr class="template-upload fade">
												        <td>
												            <span class="preview"></span>
												        </td>
												        <td>
												            <p class="name">{%=file.name%}</p>
												            <strong class="error text-danger label label-danger"></strong>
												        </td>
												        <td>
												            <p class="size">Processing...</p>
												            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
												            </div>
												        </td>
												        <td>
												            {% if (!i && !o.options.autoUpload) { %}
												                <button class="btn blue start" disabled>
												                    <i class="fa fa-upload"></i>
												                    <span>Start</span>
												                </button>
												            {% } %}
												            {% if (!i) { %}
												                <button class="btn red cancel">
												                    <i class="fa fa-ban"></i>
												                    <span>Cancel</span>
												                </button>
												            {% } %}
												        </td>
												    </tr>
												{% } %}
											</script>
											<!-- The template to display files available for download -->
											<script id="template-download" type="text/x-tmpl">
										        {% for (var i=0, file; file=o.files[i]; i++) { %}
										            <tr class="template-download fade">
										            	<td>
										                    <span class="size">
										                    {% var j = i+1; %}	
										                    {%=j%}
															</span>
										                </td>
										                <td>
										                    <span class="size">
										                    <a href="{%=file.url%}" class="btn btn-icon-only grey-cascade" download>
															<i class="fa fa-link"/>
															</a>
															</span>
										                </td>
										                <td>
										                    <span class="preview">
										                        {% if (file.thumbnailUrl) { %}
										                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
										                        {% } %}
										                    </span>
										                </td>
										                <td>
										                    <p class="name">
										                        {% if (file.url) { %}
										                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
										                        {% } else { %}
										                            <span>{%=file.name%}</span>
										                        {% } %}
										                    </p>
										                    {% if (file.error) { %}
										                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
										                    {% } %}
										                </td>
										                <td>
										                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
										                </td>
										                <td>
										                    {% if (file.deleteUrl) { %}
										                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
										                            <i class="fa fa-trash-o"></i>
										                            <span>Delete</span>
										                        </button>
										                        <input type="checkbox" name="delete" value="1" class="toggle">
										                    {% } else { %}
										                        <button class="btn yellow cancel btn-sm">
										                            <i class="fa fa-ban"></i>
										                            <span>Cancel</span>
										                        </button>
										                    {% } %}
										                </td>
										            </tr>
										        {% } %}
										    </script>
											<!--
											<div class="panel panel-success">
												<div class="panel-heading">
													<h3 class="panel-title">Demo Notes</h3>
												</div>
												<div class="panel-body">
													<ul>
														<li>
															 The maximum file size for uploads in this demo is <strong>5 MB</strong> (default file size is unlimited).
														</li>
														<li>
															 Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).
														</li>
														<li>
															 Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo setting).
														</li>
													</ul>
												</div>
											</div>
											-->
										</div>
									</div>
									<!-- END PAGE CONTENT FILE UPLOAD-->

									<div class="form-group">
										<div class="col-md-3">&nbsp;</div>
										<div class="col-md-6">
											<button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('level-modal'); ?>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		/*TableAdvanced.init();*/
		ComponentsEditors.init();
		FormFileUpload.init();
	});

	var ComponentsEditors = function () {
	    var handleWysihtml5 = function () {
	        if (!jQuery().wysihtml5) {
	            return;
	        }

	        if ($('.wysihtml5').size() > 0) {
	            $('.wysihtml5').wysihtml5({
	                "stylesheets": ["<?php echo base_url() ?>assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"],
	                "font-styles": false, //Font styling, e.g. h1, h2, etc.
				    "emphasis": true, //Italics, bold, etc.
				    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers.
				    "html": false, //Button which allows you to edit the generated HTML.
				    "link": false, //Button to insert a link.
				    "image": false, //Button to insert an image.
				    "color": false //Button to change color of font
	            });
	        }
	    }

	    return {
	        //main function to initiate the module
	        init: function () {
	            handleWysihtml5();
	        }
	    };

	}();
</script>
<!-- END JAVASCRIPTS -->
