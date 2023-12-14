<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Assessment Evaluation Form
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
			<a href="#">Risk Assessment Evaluation</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Add New</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="#">Risk Assessment Evaluation</a>
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
					<i class="fa fa-table"></i>Risk Assessment Evaluation Input Review
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
							<th class="hidden-xs" rowspan="2">UNIT</th>
							<th class="hidden-xs" rowspan="2">RISK REGISTER</th>
							<th class="hidden-xs" rowspan="2">AKTIVITAS / INSTALASI / PERALATAN</th>
							<th class="hidden-xs" rowspan="2">PENYEBAB</th>
							<th class="hidden-xs" rowspan="2">DAMPAK</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</th>
							<th class="hidden-xs" rowspan="2">TARGET WAKTU</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
						</tr>

						<tr>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($RISK_IDENTIFICATION_ID)){
							$mitigation = $this->risk_mitigation_model->get_data($RISK_IDENTIFICATION_ID);
						?>
							<tr>
								<td><?php echo $this->unit_model->get_by_id($row->UNIT_ID)->name;?></td>
								<td><?php echo $RISK_ITEM_VALUE->name?$RISK_ITEM_VALUE->name:"Not Set"; ?></td>
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
					<i class="fa fa-gift"></i> Risk Assessment Evaluation Form - <span class="step-title">
					Step 1 of 4 </span>
				</div>
				<div class="tools hidden-xs">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="<?php echo site_url('risk/risk_evaluation/saveWizard'); ?>" class="form-horizontal" id="risk_identification_form" data-redirect-url="<?php echo site_url('risk/risk_evaluation/view/')?>" method="POST">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number">
									1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Objective Determination (Penentuan Tujuan)</span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number">
									2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Identification & Analysis (Identifikasi dan Analisa Risiko)</span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">
									<span class="number">
									3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Evaluation (Evaluasi Risiko)</span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<span class="number">
									4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Treatment (Perlakuan Risiko)</span>
									</a>
								</li>
							</ul>

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

								<div class="tab-pane active" id="tab1">
									<div class="form-group">
										<label class="control-label col-md-3">Objective/Tupoksi/Tujuan Kerja Unit</label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" rows="6" readonly="readonly" name="OBJECTIVE"><?php echo !empty($OBJECTIVE) ? $OBJECTIVE : ''; ?></textarea>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="tab2">
									<div class="form-group">
										<label class="control-label col-md-3">Risk Item <span class="required">*</span></label>
										<div class="col-md-6">
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
										<label class="control-label col-md-3">Kategori Risk <span class="required">*</span></label>
										<div class="col-md-6">
											<select class="form-control select2me" name="RISK_CATEGORY_ID">
												<?php foreach($RISK_CATEGORY as $key=>$val): ?>
												<?php if($key==$RISK_CATEGORY_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Klasifikasi Risk <span class="required">*</span></label>
										<div class="col-md-6">
											<select class="form-control select2me" name="RISK_CLASSIFICATION_ID">
												<?php foreach($RISK_CLASSIFICATION as $key=>$val): ?>
												<?php if($key==$RISK_CLASSIFICATION_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Aktifitas/Peralatan/Instalasi <span class="required">
										* </span>
										</label>
										<div class="col-md-6">
											<textarea class="wysihtml5 form-control" rows="6" name="HAZARD" data-error-container="#editor1_error"><?php echo !empty($HAZARD) ? $HAZARD : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>	

									<div class="form-group">
										<label class="control-label col-md-3">Penyebab <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" rows="6" name="PENYEBAB"><?php echo !empty($PENYEBAB) ? $PENYEBAB : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Dampak <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" rows="6" name="DAMPAK"><?php echo !empty($DAMPAK) ? $DAMPAK : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Level Kemungkinan (K) <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="INHERENT_RISK_K_ID">
												<?php foreach($INHERENT_RISK_K as $key=>$val): ?>
												<?php if($key==$INHERENT_RISK_K_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
											<span class="help-block">Level kemungkinan sebelum dilakukan kontrol</span>
										</div>
										<label class="btn blue col-md-1 informasi-kemungkinan">Informasi</label>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Level Dampak (D) <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="INHERENT_RISK_D_ID">
												<?php foreach($INHERENT_RISK_D as $key=>$val): ?>
												<?php if($key==$INHERENT_RISK_D_ID) { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } else { ?>
												<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
												<?php } ?>
												<?php endforeach; ?>
											</select>
											<span class="help-block">Level dampak sebelum dilakukan kontrol</span>
										</div>
										<label class="btn blue col-md-1 informasi-dampak">Informasi</label>
									</div>
								</div>

								<div class="tab-pane" id="tab3">
									<div class="form-group">
										<label class="control-label col-md-3">Pengendalian Yang Sudah Dilakukan <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control wysihtml5" rows="6" name="PENGENDALIAN_YANG_TELAH_DILAKUKAN"><?php echo !empty($PENGENDALIAN_YANG_TELAH_DILAKUKAN) ? $PENGENDALIAN_YANG_TELAH_DILAKUKAN : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Level Kemungkinan (K) <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="RESIDUAL_RISK_K_ID">
												<?php foreach($RESIDUAL_RISK_K as $key=>$val): ?>
												<?php if($key==$RESIDUAL_RISK_K_ID) { ?>
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
											<select class="form-control select2me" name="RESIDUAL_RISK_D_ID">
												<?php foreach($RESIDUAL_RISK_D as $key=>$val): ?>
												<?php if($key==$RESIDUAL_RISK_D_ID) { ?>
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
								</div>

								<div class="tab-pane" id="tab4">
									<div class="clonearea">
										<div class="clone hide">
											<div class="form-group">
												<div class="col-md-9">
													<a class="btn btn-sm btn-danger pull-right remove-btn">Remove</a>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana pengendalian yang akan dilakukan <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control wysihtml5" rows="6" name="RENCANA_PENGENDALIAN[]"><?php //echo !empty($RENCANA_PENGENDALIAN) ? $RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" required="required">
	                                                	<?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit(false, $UNIT_ID, $PIC_ID);	
														?>
		                                            </select>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" required="required">
		                                                <?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit(false, 1, false);	
														?>
		                                            </select>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Target Waktu <span class="required">*</span></label>
												<div class="col-md-6">
													<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php //echo !empty($TARGET_WAKTU) ? $TARGET_WAKTU : ''; ?>"/>
												</div>
											</div>
										</div>

										<?php 
											if($MITIGASI != FALSE && count($MITIGASI)>0){
												$count=1;
												foreach($MITIGASI as $M){
										?>
										<div id="clone_<?php echo $count?>" class="form_list">
											<!-- <div class="form-group">
												<div class="col-md-9">
													<a class="btn btn-sm btn-danger pull-right remove-btn" onclick="hapus(<?php //echo $count?>)">Remove</a>
												</div>
											</div> -->
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana pengendalian yang akan dilakukan <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control wysihtml5" rows="6" name="RENCANA_PENGENDALIAN[]"><?php echo $M->RENCANA_PENGENDALIAN ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" required="required">
		                                              	<?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit($M->PIC_UNIT_KERJA_ID, $UNIT_ID, $PIC_ID);	
														?>
		                                            </select>                                            
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" required="required">
		                                                <?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit($M->PIC_KANTOR_PUSAT_ID, 1, false);	
														?>
		                                            </select>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Target Waktu <span class="required">*</span></label>
												<div class="col-md-6">
													<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php echo $M->TARGET_WAKTU ?>"/>
												</div>
											</div>
										</div>
										<?php 
													$count++;
												}
											}else{
												$count=2;
										?>
										<div id="clone_1" class="form_list">
											<!-- <div class="form-group">
												<div class="col-md-9">
													<a class="btn btn-sm btn-danger pull-right remove-btn" onclick="hapus(1)">Remove</a>
												</div>
											</div> -->
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana pengendalian yang akan dilakukan <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control wysihtml5" rows="6" name="RENCANA_PENGENDALIAN[]"><?php //echo !empty($RENCANA_PENGENDALIAN) ? $RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" required="required">
		                                                <?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit(false, $UNIT_ID, $PIC_ID);	
														?>
		                                            </select>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
		                                            <select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" required="required">
		                                                <?php 
															echo $this->risk_pic_model->get_dropdown_pic_unit(false, 1, false);	
														?>
		                                            </select>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Target Waktu <span class="required">*</span></label>
												<div class="col-md-6">
													<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php //echo !empty($TARGET_WAKTU) ? $TARGET_WAKTU : ''; ?>"/>
												</div>
											</div>
										</div>
										<?php }?>
									</div>

									<!-- <div class="form-group">
										<div class="col-md-9">
											<a class="btn btn-sm blue pull-right" id="tambah-form">Tambah Form Mitigasi</a>
										</div>
									</div> -->
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn default button-previous">
										<i class="m-icon-swapleft"></i> Back 
									</a>

									<a href="javascript:;" class="btn blue button-next">
										Continue <i class="m-icon-swapright m-icon-white"></i>
									</a>

									<a href="javascript:;" class="btn green button-submit">
										Submit <i class="m-icon-swapright m-icon-white"></i>
									</a>
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
		$('body').on("focus", ".date-picker", function(){
			$(this).datepicker({
	            rtl: Metronic.isRTL(),
	            orientation: "left",
	            autoclose: true,
	        });


        });

		$(".wysihtml5").wysihtml5({
            "stylesheets": ["../../assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"],
            "font-styles": false, //Font styling, e.g. h1, h2, etc.
		    "emphasis": true, //Italics, bold, etc.
		    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers.
		    "html": false, //Button which allows you to edit the generated HTML.
		    "link": false, //Button to insert a link.
		    "image": false, //Button to insert an image.
		    "color": false //Button to change color of font
        });
		
		FormWizardIdentification.init(); //init form wizard identification
		TableAdvanced.init();
	});

	var FormWizardIdentification = function () {
	    return {
	        //main function to initiate the module
	        init: function () {
	            if (!jQuery().bootstrapWizard) {
	                return;
	            }

	            var form            = $('#risk_identification_form');
	            var error           = $('.alert-danger', form);
	            var success         = $('.alert-success', form);
	            var redirect_url    = form.attr("data-redirect-url");

	            form.validate({
	                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
	                errorElement: 'span', //default input error message container
	                errorClass: 'help-block help-block-error', // default input error message class
	                focusInvalid: false, // do not focus the last invalid input
	                rules: {
	                	RISK_ITEM_ID: {
	                        required: true
	                    },
	                    RISK_CATEGORY_ID: {
	                        required: true
	                    },
	                    RISK_CLASSIFICATION_ID: {
	                        required: true
	                    },
	                    HAZARD: {
	                        required: true
	                    },
	                    PENYEBAB: {
	                        required: true
	                    },
	                    DAMPAK: {
	                        required: true
	                    },
	                    INHERENT_RISK_K_ID: {
	                        required: true
	                    },
	                    INHERENT_RISK_D_ID: {
	                        required: true
	                    },
	                    PENGENDALIAN_YANG_TELAH_DILAKUKAN: {
	                        required: true
	                    },
	                    RESIDUAL_RISK_K_ID: {
	                        required: true
	                    },
	                    RESIDUAL_RISK_D_ID: {
	                        required: true
	                    },
	                    RENCANA_PENGENDALIAN: {
	                        required: true
	                    },
	                    RISK_PIC_ID_K: {
	                        required: true
	                    },
	                    TARGET_WAKTU: {
	                        required: true
	                    },
	                },

	                messages: { // custom messages for radio buttons and checkboxes
	                },

	                errorPlacement: function (error, element) { // render error placement for each input type
	                    error.insertAfter(element); // for other inputs, just perform default behavior
	                },

	                invalidHandler: function (event, validator) { //display error alert on form submit   
	                    success.hide();
	                    error.show();
	                    Metronic.scrollTo(error, -200);
	                },

	                highlight: function (element) { // hightlight error inputs
	                    $(element)
	                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
	                },

	                unhighlight: function (element) { // revert the change done by hightlight
	                    $(element)
	                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
	                },

	                success: function (label) {
	                    label
	                        .addClass('valid') // mark the current input as valid and display OK icon
	                    .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
	                },

	                submitHandler: function (form) {
	                    success.show();
	                    error.hide();
	                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
	                }

	            });

	            var handleTitle = function(tab, navigation, index) {
	                var total = navigation.find('li').length;
	                var current = index + 1;
	                // set wizard title
	                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
	                // set done steps
	                jQuery('li', $('#form_wizard_1')).removeClass("done");
	                var li_list = navigation.find('li');
	                for (var i = 0; i < index; i++) {
	                    jQuery(li_list[i]).addClass("done");
	                }

	                if (current == 1) {
	                    $('#form_wizard_1').find('.button-previous').hide();
	                } else {
	                    $('#form_wizard_1').find('.button-previous').show();
	                }

	                if (current >= total) {
	                    $('#form_wizard_1').find('.button-next').hide();
	                    $('#form_wizard_1').find('.button-submit').show();
	                } else {
	                    $('#form_wizard_1').find('.button-next').show();
	                    $('#form_wizard_1').find('.button-submit').hide();
	                }
	                //Metronic.scrollTo($('.page-title'));
	            }

	            var ajaxPostData = function(form, redirect){
	                $.ajax({
	                    url: form.attr("action"),
	                    type: "post",
	                    data: form.serialize(),
	                    dataType  : 'json',
	                    success: function (response) {
	                        console.log(response);
	                        if(response.status=="failed"){
	                            return false;
	                        }else{
	                            $("#risk_identification_id").val(response.RISK_IDENTIFICATION_ID);

	                            if(redirect){
	                                window.location.href = redirect_url+"/"+response.RISK_IDENTIFICATION_ID;
	                            }
	                        }         

	                    },
	                    error: function(jqXHR, textStatus, errorThrown) {
	                       console.log(textStatus, errorThrown);
	                    }
	                });
	            }

	            // default form wizard
	            $('#form_wizard_1').bootstrapWizard({
	                'nextSelector': '.button-next',
	                'previousSelector': '.button-previous',
	                onTabClick: function (tab, navigation, index, clickedIndex) {
	                    return false;
	                    /*
	                    success.hide();
	                    error.hide();
	                    if (form.valid() == false) {
	                        return false;
	                    }
	                    handleTitle(tab, navigation, clickedIndex);
	                    */
	                },
	                onNext: function (tab, navigation, index) {
	                    success.hide();
	                    error.hide();

	                    if (form.valid() == false) {
	                        return false;
	                    }

	                    ajaxPostData(form, false);
	                    handleTitle(tab, navigation, index);
	                },
	                onPrevious: function (tab, navigation, index) {
	                    success.hide();
	                    error.hide();

	                    handleTitle(tab, navigation, index);
	                },
	                onTabShow: function (tab, navigation, index) {
	                    var total = navigation.find('li').length;
	                    var current = index + 1;
	                    var $percent = (current / total) * 100;
	                    $('#form_wizard_1').find('.progress-bar').css({
	                        width: $percent + '%'
	                    });
	                }
	            });

	            $('#form_wizard_1').find('.button-previous').hide();
	            $('#form_wizard_1 .button-submit').click(function () {
	                ajaxPostData(form, true);
	            }).hide();

	            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
	          /*  $('#country_list', form).change(function () {
	                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	            });*/
	        }

	    };
	}();

	/*untuk clone form*/
	var count=<?php echo $count;?>;

    $("#tambah-form").on("click",function(){
        var clone = $('.clone').clone();
        clone.attr({
            id: "clone_" + count,
            class: "form_list",
        });
        clone.find(".remove-btn").attr("onclick", "hapus("+count+")");
        //append clone on the end
		$(".clonearea").append(clone);

		/*$(".select2me").select2('destroy');
		$(".select2me").select2();*/


        count++;
    });

	function hapus(id)
	{
		$("#clone_"+id).remove();
	}
</script>
</script>
<!-- END JAVASCRIPTS -->
