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
				<?php //echo messages(); ?>
				<!-- BEGIN FORM-->
				<form id="form" class="form-horizontal" method="post">
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
								<input type="hidden" name="TX_ELIBRARY_ID" value="<?php echo !empty($TX_ELIBRARY_ID) ? $TX_ELIBRARY_ID : ''; ?>" data-required="1" class="form-control"/>
							</div>
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
								<form id="fileupload" action="<?php echo site_url('elibrary/elibrary/do_upload/'.$TX_ELIBRARY_ID); ?>" method="POST" enctype="multipart/form-data">
									<input type="hidden" class="form-control" name="TX_ELIBRARY_ID" id="TX_ELIBRARY_ID" value="<?php echo !empty($TX_ELIBRARY_ID) ? $TX_ELIBRARY_ID : ''; ?>"/>
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

						<!-- <div class="form-group">
							<label class="control-label col-md-2">FILE_NAME <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="FILE_NAME" value="<?php echo !empty($FILE_NAME) ? $FILE_NAME : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">FILE_PATH <span class="required">
							* </span>
							</label>
							<div class="col-md-9">
								<input type="text" name="FILE_PATH" value="<?php echo !empty($FILE_PATH) ? $FILE_PATH : ''; ?>" data-required="1" class="form-control"/>
							</div>
						</div> -->
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
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<!-- <button type="submit" class="btn green" id="save-button" value="Save" name="save-button">Save</button> -->
								<!-- <button type="submit" class="btn default" id="cancel-button" value="Cancel" name="cancel-button">Cancel</button> -->
								<!-- <button type="submit" class="btn green">Submit</button> -->
								<!-- <button type="button" class="btn default">Cancel</button> -->
								<a href="<?php echo site_url('elibrary/elibrary/index'); ?>" class="btn purple">Back to home</a> 
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
		FormFileUpload.init();
	});
</script>
<!-- END JAVASCRIPTS -->
