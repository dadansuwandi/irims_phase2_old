<!-- BEGIN DEFINE VARIABLE -->
<?php 
	$module 	= $this->uri->segment(1);
	$page   	= $this->uri->segment(2);
	$action 	= 'index';
	$actionTmp 	= $this->uri->segment(3);
	if($actionTmp != ''){
		$action =  $this->uri->segment(3);
	}
	$actionId 	= $this->uri->segment(4);
?>
<!-- END DEFINE VARIABLE -->
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
User <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<?php
		if($action == 'add'){
		?>
		<li>
			<a href="<?php echo site_url('auth/user/index'); ?>">User</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('auth/user/add'); ?>">Add</a>
		</li>
		<?php
		} else {
		?>
		<li>
			<a href="<?php echo site_url('auth/user/index'); ?>">User</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('auth/user/edit/' . $actionId); ?>">Edit</a>
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
					<i class="fa fa-user"></i>User
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
						<!--<h3 class="form-section">Advance validation. <small>Custom radio buttons, checkboxes and Select2 dropdowns</small></h3>-->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Is LDAP</label>
							<div class="col-md-10">
								<div class="radio-list">
									<label class="radio-inline">
									<input type="radio" name="ldap" id="ldapNo" value="0" checked> No </label>

									<label class="radio-inline">
									<input type="radio" name="ldap" id="ldapYes" value="1"> Yes </label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Search By NIP/Name/Position </label>
							<div class="col-md-10">
								<input type="text" name="search" id="search" class="form-control"/>
							</div>
						</div>

						<hr>

						<?php echo $form->fields(); ?>
						
						<div class="form-group">
							<label class="control-label col-md-2">Photo</label>
							<div class="col-md-10" id="photo-temp">
								<?php
                                    $photo = '';
                                    if(!empty($user->photo)){
                                        $photo = base_url().'uploads/user/'. $user->photo;
                                    }else{
                                        $photo = base_url().'assets/img/admin.jpg';
                                    }
                                ?>
                                <img src="<?php echo $photo ?>" width="120" id="previewimgprofile" />
                                <br/>
                                <br/>
								<input type="file" value="" id="userfile" name="userfile" accept="image/*"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">PIC <span class="required">
							* </span>
							</label>
							<div class="col-md-10">
								<select class="form-control select2me" name="pic_id">
									<?php 
										if(!empty($user->pic_id)){
											echo $this->risk_pic_model->get_dropdown_pic_unit($user->pic_id);
										}else{
											echo $this->risk_pic_model->get_dropdown_pic_unit();
										}	
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<?php echo form_actions(array(
									array(
										'id'	=> 'save-button',
										'value' => lang('save'),
										'class' => 'btn-primary'
									),
									array(
										'id'	=> 'cancel-button',
										'value'	=> lang('cancel')
									)
								)); ?>
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

		//default search readonly
		$('#search').prop('readonly', true);
		// on click
		$('#ldapYes').on('click', function(e) {
			if ($('#ldapYes').is(':checked')) { 
				$('#search').prop('readonly', false);
				$('#first_name').prop('readonly', true);
				$('#last_name').prop('readonly', true);
				$('label[for=last_name]').remove();
				$("#last_name").hide();
				$('#username').prop('readonly', true);
				$('#email').prop('readonly', true);
				$('#password').prop('readonly', true);
				$('label[for=password]').remove();
				$('#password').val('B@njarsari04');
				$("#password").hide();
				$('#confirm-password').prop('readonly', true);
				$('label[for=confirm-password]').remove();
				$('#confirm-password').val('B@njarsari04');
				$("#confirm-password").hide();
			} 
		});
		$('#ldapNo').on('click', function(e) {
			if ($('#ldapNo').is(':checked')) { 
				$('#search').prop('readonly', true);
				$('#first_name').prop('readonly', false);
				$('#last_name').prop('readonly', false);
				$('#username').prop('readonly', false);
				$('#email').prop('readonly', false);
				$('#password').prop('readonly', false);
				$('#confirm-password').prop('readonly', false);
			} 
		});
		// Initialize 
		var base_url = '<?php echo base_url() ?>';
		var API_HOST_DEV_AP2 = '<?php echo getenv('API_HOST_DEV_AP2');?>'
		var API_HOST_USER_AP2 = '<?php echo getenv('API_HOST_USER_AP2');?>'
		var API_HOST_PASS_AP2 = '<?php echo getenv('API_HOST_PASS_AP2');?>'
		var urlUser = '<?php echo '/mobile/employee/getEmployeeDataSidoelbyfilter';?>'
		var urlPhoto = '<?php echo '/mobile/Photo/index/';?>'
		$("#search").autocomplete({
        	source: function( request, response ) {
				if (request.term != "") {
					// Fetch data
					$.ajax({
						url: API_HOST_DEV_AP2 + urlUser,
						type: 'post',
						dataType: "json",
						data: {
							username: API_HOST_USER_AP2,
							password: API_HOST_PASS_AP2,
							params: request.term, // by Nip/PeopleName/PeoplePosition
							submit: 1
						},
						async: true,
						success: function( data ) {
							if (data != "") {
								//response( data );
								var resp = $.map(data,function(obj){
									var name = obj.PeopleName;
                                    return {
                                        label: name,
                                        value: name,
                                        data: obj
                                    }
								}); 
								response(resp);
								console.log("Connection LDAP is Ok.");
							}
						},
						error: function (jqXHR, exception) {
							var error_msg = '';
							if (jqXHR.status === 0) {
								error_msg = 'Not connect.\n Verify Network.';
							} else if (jqXHR.status == 404) {
								// 404 page error
								error_msg = 'Requested page not found. [404]';
							} else if (jqXHR.status == 500) {
								// 500 Internal Server error
								error_msg = 'Internal Server Error [500].';
							} else if (exception === 'parsererror') {
								// Requested JSON parse
								error_msg = 'Requested JSON parse failed.';
							} else if (exception === 'timeout') {
								// Time out error
								error_msg = 'Time out error.';
							} else if (exception === 'abort') {
								// request aborte
								error_msg = 'Ajax request aborted.';
							} else {
								error_msg = 'Uncaught Error.\n' + jqXHR.responseText;
							}
							// error alert message
							alert('error :: ' + error_msg);
						}
					});
				}
        	},
        	select: function (event, ui) {
				// Call removeCookie function with name of Cookie that you want to remove
				removeCookie('nip');
          		
				// Set selection
				var data = ui.item.data;
          		$('#first_name').val(data.PeopleName);
          		$('#username').val(data.PeopleUsername);
				$('#email').val(data.PeopleUsername + '<?php echo getenv('HOST_DOMAIN_AP2');?>');
				
				// To create cookie, call setCookie with three params: name of cookie, value of cookie, expired time (days)
				setCookie('nip', data.Nip, 0);
				var nip = data.Nip;
				var desc = data.PeopleName;
				var saveCookieName = $.ajax({
					url: 'save_cookie_temp',
					type: "post",
					data: { name: nip, description: desc },
					success: function (data) {
						var dataParsed = JSON.parse(data);
						//console.log(dataParsed);
					},
					error: function (jqXHR, exception) {
						var error_msg = '';
						if (jqXHR.status === 0) {
							error_msg = 'Not connect.\n Verify Network.';
						} else if (jqXHR.status == 404) {
							// 404 page error
							error_msg = 'Requested page not found. [404]';
						} else if (jqXHR.status == 500) {
							// 500 Internal Server error
							error_msg = 'Internal Server Error [500].';
						} else if (exception === 'parsererror') {
							// Requested JSON parse
							error_msg = 'Requested JSON parse failed.';
						} else if (exception === 'timeout') {
							// Time out error
							error_msg = 'Time out error.';
						} else if (exception === 'abort') {
							// request aborte
							error_msg = 'Ajax request aborted.';
						} else {
							error_msg = 'Uncaught Error.\n' + jqXHR.responseText;
						}
						// error alert message
						alert('error :: ' + error_msg);
					}
				});

				var img = $("#previewimgprofile").attr('src', API_HOST_DEV_AP2 + urlPhoto + data.Nip)
				.on('load', function() {
					if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
						alert('broken image!');
					} else {
						if (saveCookieName.status == 200) {
							<?php
								// $nipData = $this->curl->simple_get(base_url() .'my_api/get_cookie_name');
								// $getNip = json_decode($nipData, TRUE);
								// $getNip['nip'];
							?>	

							// Remote image URL
							<?php 
								/* $url = getenv('API_HOST_DEV_AP2').'/mobile/Photo/index/'.$getNip['nip'];
								// Image path
								$imgDownload = 'uploads/user/' . date('Ymd') . '-ldap-'.$getNip['nip'].'.jpg';
								// Save image
								$ch = curl_init($url);
								$fp = fopen($imgDownload, 'wb');
								curl_setopt($ch, CURLOPT_FILE, $fp);
								curl_setopt($ch, CURLOPT_HEADER, 0);
								curl_exec($ch);
								curl_close($ch);
								fclose($fp); */
							?>
						}
					}
				});
				
				//clear a file input with jQuery 
				$("#userfile").val("");
				$("#userfile").remove();
				// redeclare file input
				var base_url = '<?php echo base_url();?>'
				var imgDownload = '<?php echo 'uploads/user/' . date('Ymd') . '-ldap-';?>' + nip + '<?php echo '.jpg';?>';
				var urlImage = base_url + imgDownload;
				var input =  $('<input>').attr({
					type: 'hidden',
					value: '',
					id: 'photo',
					name: 'photo',
				});
				$('#photo-temp').append(input);
				//insert to value input file
				var filename = urlImage.substring(urlImage.lastIndexOf('/')+1);
				$('#photo').val(filename);
				console.log(filename);

				// Call removeCookie function with name of Cookie that you want to remove
				removeCookie('nip');

				// clear search input after selection
				$("#search").load(location.href + " #search");
				$('#search').val('').trigger('change');
				
          		return false;
        	},
			minLength: 1,
			autoFocus: true,
			classes: {
				"ui-autocomplete": "highlight"
			}
      	});
	});

	//Preview an image before it is uploaded
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewimgprofile').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userfile").change(function(){
        readURL(this);
    });

	// function to create cookie
	function setCookie(cname, cvalue, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        const expires = 'expires=' + d.toUTCString();
        document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
    }

	// function to get cookie
	function getCookie(cname) {
        const name = cname + '=';
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return '';
    }

	// function to remove your cookie
	function removeCookie(cname) {
        var d = new Date();
        d.setTime(d.getTime() - 1000 * 60 * 60 * 24);
        var expires = 'expires=' + d.toGMTString();
        window.document.cookie = cname + '=' + '; ' + expires;
    }
</script>
<!-- File Saver js -->
<!-- saveAs("https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/", "image-sample.jpg"); -->
<!-- <script src="http://localhost/irims-phase2/assets/filesaver/src/FileSaver.js"></script> -->
<!-- END JAVASCRIPTS -->
