<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Approval Form
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
			<a href="#">Risk Approval</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Add New</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="#">Risk Approval</a>
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
					<i class="fa fa-table"></i>Risk Approval Input Review
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
							<th class="hidden-xs" rowspan="2">SASARAN ORGANISASI / PROSES BISNIS</th>
							<th class="hidden-xs" colspan="2">RISIKO</th>
							<th class="hidden-xs" rowspan="2">PENYEBAB</th>
							<th class="hidden-xs" rowspan="2">DAMPAK</th>
							<th class="hidden-xs" rowspan="2">JENIS RISIKO</th>
							<th class="hidden-xs" colspan="3">INHERENT RISK</th>
							<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN (EXISTING CONTROL)</th>
							<th class="hidden-xs" colspan="2">NILAI EFEKTIVITAS EXCO</th>
							<th class="hidden-xs" colspan="3">CURRENT RISK</th>
							<th class="hidden-xs" colspan="2">RENCANA PERLAKUAN RISIKO</th>
							<th class="hidden-xs" colspan="3">TARGET RESIDUAL RISK</th>
							<th class="hidden-xs" rowspan="2">BIAYA MITIGASI</th>
							<th class="hidden-xs" colspan="2">REANCANA JADWAL PENANGANAN RISIKO</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
							<th class="hidden-xs" rowspan="2">DESKRIPSI</th>
							<th class="hidden-xs" rowspan="2">TANGGAL REGISTER</th>
						</tr>

						<tr>
							<th class="hidden-xs">RISK REGISTER</th>
							<th class="hidden-xs">RISK EVENT</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">KEMUNGKINAN</th>
							<th class="hidden-xs">DAMPAK</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">MULAI</th>
							<th class="hidden-xs">SELESAI</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($RISK_IDENTIFICATION_ID)){
							$mitigation = $this->risk_mitigation_model->get_data($RISK_IDENTIFICATION_ID);
						?>
							<tr>
								<td><?php echo $this->unit_model->get_by_id($UNIT_ID)->name;?></a></td>
								<td><?php echo $OBJECTIVE; ?></td>
								<td>
									<?php
										$risk_item = $this->risk_item_model->get_by_id($RISK_ITEM_ID);
										if ($risk_item)
											echo $risk_item->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $HAZARD; ?></td>
								<td><?php echo $PENYEBAB; ?></td>
								<td><?php echo $DAMPAK; ?></td>
								<td>
									<?php
										$risk_category = $this->risk_category_model->get_by_id($RISK_CATEGORY_ID);
										if ($risk_category)
											echo $risk_category->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($INHERENT_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($INHERENT_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $EXCO_EFFECTIVENESS_VALUE_K_ID;?></td>
								<td><?php echo $EXCO_EFFECTIVENESS_VALUE_D_ID;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
												echo "<li>".$mitigation[$i]->DAMPAK_RENCANA_PENGENDALIAN."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($TARGET_RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>"."Rp. ".number_format($mitigation[$i]->MITIGATION_COSTS,0,",",".")."</li>";
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
												echo "<li>".$mitigation[$i]->MULAI_WAKTU."</li>";
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
								<td>
									<?php
										if ($risk_item)
											echo $risk_item->description;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo date("d-m-Y", strtotime($INSTERTED_TIME)); ?></td>
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
					<i class="fa fa-gift"></i> Risk Approval Form - <span class="step-title">
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
				<form action="<?php echo site_url('risk_worksheet/risk_evaluation_worksheet/saveWizard'); ?>" class="form-horizontal" id="risk_identification_form" data-redirect-url="<?php echo site_url('risk_worksheet/risk_evaluation_worksheet/view/')?>" method="POST">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number">
									1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Penetapan Lingkup, Konteks, & Kriteria</span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number">
									2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Assessment</span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">
									<span class="number">
									3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Treatment</span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<span class="number">
									4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Risk Monitoring & Review</span>
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

								<input type="hidden" class="form-horizontal" name="RISK_IDENTIFICATION_ID" id="risk_identification_id" value="<?php echo !empty($RISK_IDENTIFICATION_ID) ? $RISK_IDENTIFICATION_ID : ''; ?>"/>

								<div class="tab-pane active" id="tab1">
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Unit Kerja<span class="required">*</span></label>
										<div class="col-md-6">
											<input type="text" name="USER_LAST_NAME" value="<?php // echo !empty($USER_LAST_NAME) ? $USER_LAST_NAME : ''; ?>" class="form-control input-circle" readonly="readonly"/>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Tahun<span class="required">*</span></label>
										<div class="col-md-6">
											<input type="text" name="CREATED_AT_YEAR" value="<?php // echo !empty($CREATED_AT_YEAR) ? $CREATED_AT_YEAR : ''; ?>" class="form-control input-circle" readonly="readonly"/>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Tanggal<span class="required">*</span></label>
										<div class="col-md-6">
											<input type="text" name="CREATED_AT_DATE" value="<?php // echo !empty($CREATED_AT_DATE) ? $CREATED_AT_DATE : ''; ?>" class="form-control input-circle" readonly="readonly"/>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Sasaran Organisasi<span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="OBJECTIVE"><?php // echo !empty($OBJECTIVE) ? $OBJECTIVE : ''; ?></textarea>
										</div>
									</div> -->
									<div class="form-group">
										<label class="control-label col-md-3">KPI<span class="required">*</span></label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon input-circle-left"><i class="fa fa-database"></i></span>
												<select class="form-control select2me" id="KPI" name="KPI">
													<?php foreach($KPI_DATA as $key=>$val): ?>
													<?php if($key==$KPI) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Program Kerja<span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="WORK_PROGRAM"><?php // echo !empty($WORK_PROGRAM) ? $WORK_PROGRAM : ''; ?></textarea>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Aktivitas</label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="ACTIVITY"><?php // echo !empty($ACTIVITY) ? $ACTIVITY : ''; ?></textarea>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Lingkup</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="SCOPE"><?php // echo !empty($SCOPE) ? $SCOPE : ''; ?></textarea>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Kriteria</label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="CRITERIA"><?php // echo !empty($CRITERIA) ? $CRITERIA : ''; ?></textarea>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Konteks Eksternal</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="EXTERNAL_CONTEXT"><?php // echo !empty($EXTERNAL_CONTEXT) ? $EXTERNAL_CONTEXT : ''; ?></textarea>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Konteks Internal</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="INTERNAL_CONTEXT"><?php // echo !empty($INTERNAL_CONTEXT) ? $INTERNAL_CONTEXT : ''; ?></textarea>
										</div>
									</div> -->
								</div>

								<div class="tab-pane" id="tab2">
									<div class="form-group">
										<label class="control-label col-md-3">Risk Register <span class="required">*</span></label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon input-circle-left"><i class="fa fa-list"></i></span>
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
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Jenis Risiko <span class="required">*</span></label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon input-circle-left"><i class="fa fa-list-ol"></i></span>
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
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Klasifikasi Risk <span class="required">*</span></label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon input-circle-left"><i class="fa fa-list-ul"></i></span>
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
									</div>

									<!-- <div class="form-group">
										<label class="control-label col-md-3">Sasaran Organisasi / Proses Bisnis</label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="OBJECTIVE"><?php // echo !empty($OBJECTIVE) ? $OBJECTIVE : ''; ?></textarea>
										</div>
									</div> -->

									<div class="form-group">
										<label class="control-label col-md-3">Risk Event<span class="required">* </span></label>
										<div class="col-md-6">
											<textarea class="wysihtml5 form-control input-circle" rows="6" name="HAZARD" data-error-container="#editor1_error"><?php echo !empty($HAZARD) ? $HAZARD : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Kuantifikasi<span class="required">* </span></label>
										<div class="col-md-6">
											<textarea class="wysihtml5 form-control input-circle" rows="6" name="QUANTIFICATION" data-error-container="#editor1_error"><?php echo !empty($QUANTIFICATION) ? $QUANTIFICATION : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Penyebab <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="PENYEBAB"><?php echo !empty($PENYEBAB) ? $PENYEBAB : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Dampak <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="DAMPAK"><?php echo !empty($DAMPAK) ? $DAMPAK : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Inherent Risk <span class="required">*</span></label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" id="INHERENT_RISK_K_ID" name="INHERENT_RISK_K_ID">
													<?php foreach($INHERENT_RISK_K as $key=>$val): ?>
													<?php if($key==$INHERENT_RISK_K_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level kemungkinan sebelum dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-kemungkinan">Informasi</label>

										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">D</span>
												<select class="form-control select2me" id="INHERENT_RISK_D_ID" name="INHERENT_RISK_D_ID">
													<?php foreach($INHERENT_RISK_D as $key=>$val): ?>
													<?php if($key==$INHERENT_RISK_D_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level dampak sebelum dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-dampak">Informasi</label>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Pengendalian Yang Sudah Dilakukan (Existing Control) <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="PENGENDALIAN_YANG_TELAH_DILAKUKAN"><?php echo !empty($PENGENDALIAN_YANG_TELAH_DILAKUKAN) ? $PENGENDALIAN_YANG_TELAH_DILAKUKAN : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Nilai Efektivitas Existing Control <span class="required">*</span></label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<input type="text" id="EXCO_EFFECTIVENESS_VALUE_K_ID" name="EXCO_EFFECTIVENESS_VALUE_K_ID" value="<?php echo !empty($EXCO_EFFECTIVENESS_VALUE_K_ID) ? $EXCO_EFFECTIVENESS_VALUE_K_ID : 0; ?>" data-required="1" class="form-control input-circle-right" placeholder="Otomatis" readonly="readonly"/>
											</div>
											<span class="help-block">Skor exco kemungkinan </span>
											<div class="alert alert-success" id="EXCO_EFFECTIVENESS_VALUE_K_ID_INFO">
												<span class="label label-sm label-info"><label id="EXCO_EFFECTIVENESS_VALUE_K_ID_TINGKAT"><strong></strong></label></span>
												<label id="EXCO_EFFECTIVENESS_VALUE_K_ID_DESCRIPTION"></label>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">D</span>
												<input type="text" id="EXCO_EFFECTIVENESS_VALUE_D_ID" name="EXCO_EFFECTIVENESS_VALUE_D_ID" value="<?php echo !empty($EXCO_EFFECTIVENESS_VALUE_D_ID) ? $EXCO_EFFECTIVENESS_VALUE_D_ID : 0; ?>" data-required="1" class="form-control input-circle-right" placeholder="Otomatis" readonly="readonly"/>
											</div>
											<span class="help-block">Skor exco dampak </span>
											<div class="alert alert-success" id="EXCO_EFFECTIVENESS_VALUE_D_ID_INFO">
												<span class="label label-sm label-info"><label id="EXCO_EFFECTIVENESS_VALUE_D_ID_TINGKAT"><strong></strong></label></span>
												<label id="EXCO_EFFECTIVENESS_VALUE_D_ID_DESCRIPTION"></label>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-2">
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-circle purple dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
												<i class="fa fa-question-circle"></i> Hitung Nilai EXCO <i class="fa fa-angle-down"></i>
												</button>
												<ul class="dropdown-menu pull-right" role="menu">
													<li>
														<a href="#" class="nilai-skor-kemungkinan">Skor Kemungkinan</a>
													</li>
													<li class="divider"></li>
													<li>
														<a href="#" class="nilai-skor-dampak">Skor Dampak</a>
													</li>
													<li class="divider"></li>
													<li>
														<a href="#" class="nilai-skor-k-d">Skor Kemungkinan dan Dampak</a>
													</li>
												</ul>
											</div>
										</div>
										<!--/span-->
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Current Risk <span class="required">*</span></label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" id="RESIDUAL_RISK_K_ID" name="RESIDUAL_RISK_K_ID">
													<?php foreach($RESIDUAL_RISK_K as $key=>$val): ?>
													<?php if($key==$RESIDUAL_RISK_K_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level kemungkinan setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-kemungkinan">Informasi</label>

										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">D</span>
												<select class="form-control select2me" id="RESIDUAL_RISK_D_ID" name="RESIDUAL_RISK_D_ID">
													<?php foreach($RESIDUAL_RISK_D as $key=>$val): ?>
													<?php if($key==$RESIDUAL_RISK_D_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level dampak setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-dampak">Informasi</label>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Notes<span class="required">* </span></label>
										<div class="col-md-3">
											<textarea class="form-control input-circle" rows="3" name="NOTES_CURRENT_RISK_K" data-error-container="#editor1_error"><?php echo !empty($NOTES_CURRENT_RISK_K) ? $NOTES_CURRENT_RISK_K : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
										<div class="col-md-3">
											<textarea class="form-control input-circle" rows="3" name="NOTES_CURRENT_RISK_D" data-error-container="#editor1_error"><?php echo !empty($NOTES_CURRENT_RISK_D) ? $NOTES_CURRENT_RISK_D : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>

									<!-- <div class="form-group">
										<label class="control-label col-md-3">Kategori Pertimbangan Keputusan Penanganan </label>
										<div class="col-md-6">
											<input type="text" name="TREATMENT_DECISION_CATEGORY" value="<?php // echo !empty($TREATMENT_DECISION_CATEGORY) ? $TREATMENT_DECISION_CATEGORY : ''; ?>" data-required="1" class="form-control input-circle"/>
										</div>
									</div> -->

									<div class="form-group">
										<label class="control-label col-md-3">Keterangan </label>
										<div class="col-md-6">
											<textarea class="form-control input-circle wysihtml5" rows="6" name="TREATMENT_DECISION_DESCRIPTION"><?php // echo !empty($TREATMENT_DECISION_DESCRIPTION) ? $TREATMENT_DECISION_DESCRIPTION : ''; ?></textarea>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="tab3">
									<div class="clonearea">
										<hr>
										<div class="clone hide">
											<div class="form-group">
												<div class="col-md-9">
													<a class="btn btn-circle btn-sm btn-danger pull-right remove-btn">Remove</a>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Kemungkinan) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5hidden" rows="6" name="RENCANA_PENGENDALIAN[]" data-required="1"><?php //echo !empty($RENCANA_PENGENDALIAN) ? $RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Dampak) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5hidden" rows="6" name="DAMPAK_RENCANA_PENGENDALIAN[]" data-required="1"><?php //echo !empty($DAMPAK_RENCANA_PENGENDALIAN) ? $DAMPAK_RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_unit(false, $UNIT_ID, $PIC_ID);	
															?>
														</select>
													</div>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_kp();	
															?>
														</select>
													</div>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Mulai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="MULAI_WAKTU[]" value="<?php //echo !empty($MULAI_WAKTU) ? $MULAI_WAKTU : ''; ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Selesai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php //echo !empty($TARGET_WAKTU) ? $TARGET_WAKTU : ''; ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<!-- <div class="form-group">
												<label class="control-label col-md-3">Biaya Mitigasi <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-money"></i></span>
														<input type="text" class="form-control format-rupiah" id="MITIGATION_COSTS[<?php echo '0' ?>]" name="MITIGATION_COSTS[]" value="<?php //echo !empty($MITIGATION_COSTS) ? "Rp. ".number_format($MITIGATION_COSTS,0,",",".") : ''; ?>" data-required="1"/>
													</div>
													<span class="help-block">Input format ( Rp. xxx.xxx.xxx )</span>
												</div>
											</div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Realisasi Mitigasi <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control input-circle wysihtml5" rows="6" required="required" name="REALISASI_MITIGASI[]"><?php //echo !empty($m->REALISASI_MITIGASI) ? $m->REALISASI_MITIGASI : ''; ?></textarea>
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Waktu Pelaksanaan (Tahun-Bulan-Tanggal) <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="EXECUTION_TIME[]" name="EXECUTION_TIME[]" value="<?php //echo !empty($m->EXECUTION_TIME) ? date('Y-m-d', strtotime($m->EXECUTION_TIME)) : ''; ?>" data-required="1"/>
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Year <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="YEAR[]" name="YEAR[]" readonly="readonly" value="<?php //echo !empty($m->YEAR) ? $m->YEAR : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Month <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="MONTH[]" name="MONTH[]" readonly="readonly" value="<?php //echo !empty($m->MONTH) ? $m->MONTH : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Day <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="DAY[]" name="DAY[]" readonly="readonly" value="<?php //echo !empty($m->DAY) ? $m->DAY : ''; ?>"></input>
                                                    </div>
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
													<a class="btn btn-circle btn-sm btn-danger pull-right remove-btn" onclick="hapus(<?php //echo $count?>)">Remove</a>
												</div>
											</div> -->
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Kemungkinan) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5" rows="6" name="RENCANA_PENGENDALIAN[]" data-required="1"><?php echo $M->RENCANA_PENGENDALIAN ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Dampak) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5" rows="6" name="DAMPAK_RENCANA_PENGENDALIAN[]" data-required="1"><?php echo $M->DAMPAK_RENCANA_PENGENDALIAN ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_unit($M->PIC_UNIT_KERJA_ID, $UNIT_ID, $PIC_ID);	
															?>
														</select>
													</div>                                     
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_kp($M->PIC_KANTOR_PUSAT_ID);	
															?>
														</select>
													</div>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Mulai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="MULAI_WAKTU[]" value="<?php echo $M->MULAI_WAKTU ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Selesai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php echo $M->TARGET_WAKTU ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<!-- <div class="form-group">
												<label class="control-label col-md-3">Biaya Mitigasi <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-money"></i></span>
														<input type="text" class="form-control" id="MITIGATION_COSTS[<?php echo $count ?>]" name="MITIGATION_COSTS[]" value="<?php echo "Rp. ".number_format($M->MITIGATION_COSTS,0,",",".") ?>" data-required="1"/>
													</div>
													<span class="help-block">Input format ( Rp. xxx.xxx.xxx )</span>
												</div>
											</div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Realisasi Mitigasi <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control input-circle wysihtml5" rows="6" required="required" name="REALISASI_MITIGASI[<?php echo $m->RISK_MITIGATION_ID;?>]"><?php echo !empty($m->REALISASI_MITIGASI) ? $m->REALISASI_MITIGASI : ''; ?></textarea>
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Waktu Pelaksanaan (Tahun-Bulan-Tanggal) <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="EXECUTION_TIME[<?php // echo $m->RISK_MITIGATION_ID;?>]" name="EXECUTION_TIME[<?php // echo $m->RISK_MITIGATION_ID;?>]" value="<?php // echo !empty($m->EXECUTION_TIME) ? date('Y-m-d', strtotime($m->EXECUTION_TIME)) : ''; ?>" data-required="1"/>
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Year <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="YEAR[<?php echo $m->RISK_MITIGATION_ID;?>]" name="YEAR[<?php echo $m->RISK_MITIGATION_ID;?>]" readonly="readonly" value="<?php echo !empty($m->YEAR) ? $m->YEAR : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Month <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="MONTH[<?php echo $m->RISK_MITIGATION_ID;?>]" name="MONTH[<?php echo $m->RISK_MITIGATION_ID;?>]" readonly="readonly" value="<?php echo !empty($m->MONTH) ? $m->MONTH : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Day <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="DAY[<?php echo $m->RISK_MITIGATION_ID;?>]" name="DAY[<?php echo $m->RISK_MITIGATION_ID;?>]" readonly="readonly" value="<?php echo !empty($m->DAY) ? $m->DAY : ''; ?>"></input>
                                                    </div>
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
													<a class="btn btn-circle btn-sm btn-danger pull-right remove-btn" onclick="hapus(1)">Remove</a>
												</div>
											</div> -->
											
											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Kemungkinan) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5" rows="6" name="RENCANA_PENGENDALIAN[]" data-required="1"><?php //echo !empty($RENCANA_PENGENDALIAN) ? $RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Rencana Perlakuan Risiko (Dampak) <span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control input-circle wysihtml5" rows="6" name="DAMPAK_RENCANA_PENGENDALIAN[]" data-required="1"><?php //echo !empty($DAMPAK_RENCANA_PENGENDALIAN) ? $DAMPAK_RENCANA_PENGENDALIAN : ''; ?></textarea>
												</div>
											</div>

											<div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Unit Kerja) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_UNIT_KERJA_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_unit(false, $UNIT_ID, $PIC_ID);	
															?>
														</select>
													</div>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label class="control-label col-md-3">PIC (Kantor Pusat) <span class="required">*</span></label>
		                                        <div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-user"></i></span>
														<select class="form-control select2me" name="PIC_KANTOR_PUSAT_ID[]" data-required="1">
															<?php 
																echo $this->risk_pic_model->get_dropdown_pic_kp();	
															?>
														</select>
													</div>
		                                        </div>
		                                    </div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Mulai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="MULAI_WAKTU[]" value="<?php //echo !empty($MULAI_WAKTU) ? $MULAI_WAKTU : ''; ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Selesai <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="TARGET_WAKTU[]" value="<?php //echo !empty($TARGET_WAKTU) ? $TARGET_WAKTU : ''; ?>" data-required="1"/>
													</div>
												</div>
											</div>

											<!-- <div class="form-group">
												<label class="control-label col-md-3">Biaya Mitigasi <span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon input-circle-left"><i class="fa fa-money"></i></span>
														<input type="text" class="form-control" id="MITIGATION_COSTS[<?php echo '1' ?>]" name="MITIGATION_COSTS[]" value="<?php //echo !empty($MITIGATION_COSTS) ? "Rp. ".number_format($MITIGATION_COSTS,0,",",".") : ''; ?>" data-required="1"/>
													</div>
													<span class="help-block">Input format ( Rp. xxx.xxx.xxx )</span>
												</div>
											</div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Realisasi Mitigasi <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control input-circle wysihtml5" rows="6" required="required" name="REALISASI_MITIGASI[]"><?php //echo !empty($m->REALISASI_MITIGASI) ? $m->REALISASI_MITIGASI : ''; ?></textarea>
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Waktu Pelaksanaan (Tahun-Bulan-Tanggal) <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="EXECUTION_TIME[]" name="EXECUTION_TIME[]" value="<?php //echo !empty($m->EXECUTION_TIME) ? date('Y-m-d', strtotime($m->EXECUTION_TIME)) : ''; ?>" data-required="1"/>
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Year <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="YEAR[]" name="YEAR[]" readonly="readonly" value="<?php //echo !empty($m->YEAR) ? $m->YEAR : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Month <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="MONTH[]" name="MONTH[]" readonly="readonly" value="<?php //echo !empty($m->MONTH) ? $m->MONTH : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-3">Day <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left"><i class="fa fa-calendar"></i></span>
                                                        <input class="form-control input-circle-right" id="DAY[]" name="DAY[]" readonly="readonly" value="<?php //echo !empty($m->DAY) ? $m->DAY : ''; ?>"></input>
                                                    </div>
                                                </div>
                                            </div>
										</div>
										<?php }?>
										<hr>
									</div>

									<!-- <div class="form-group">
										<div class="col-md-9">
											<a class="btn btn-sm blue pull-right" id="tambah-form">Tambah Form Mitigasi</a>
										</div>
									</div> -->

									<hr>

									<div class="form-group">
										<label class="control-label col-md-3">Target Residual Risk <span class="required">*</span></label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" name="TARGET_RESIDUAL_RISK_K_ID">
													<?php foreach($TARGET_RESIDUAL_RISK_K as $key=>$val): ?>
													<?php if($key==$TARGET_RESIDUAL_RISK_K_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Target level kemungkinan setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-kemungkinan">Informasi</label>

										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" name="TARGET_RESIDUAL_RISK_D_ID">
													<?php foreach($TARGET_RESIDUAL_RISK_D as $key=>$val): ?>
													<?php if($key==$TARGET_RESIDUAL_RISK_D_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Target level dampak setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-dampak">Informasi</label>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Notes<span class="required">* </span></label>
										<div class="col-md-3">
											<textarea class="form-control input-circle" rows="3" name="NOTES_TARGET_RESIDUAL_RISK_K" data-error-container="#editor1_error"><?php echo !empty($NOTES_TARGET_RESIDUAL_RISK_K) ? $NOTES_TARGET_RESIDUAL_RISK_K : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
										<div class="col-md-3">
											<textarea class="form-control input-circle" rows="3" name="NOTES_TARGET_RESIDUAL_RISK_D" data-error-container="#editor1_error"><?php echo !empty($NOTES_TARGET_RESIDUAL_RISK_D) ? $NOTES_TARGET_RESIDUAL_RISK_D : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Kuantifikasi<span class="required">* </span></label>
										<div class="col-md-6">
											<textarea class="wysihtml5 form-control input-circle" rows="6" name="QUANTIFICATION_ANALISYS" data-error-container="#editor1_error"><?php echo !empty($QUANTIFICATION_ANALISYS) ? $QUANTIFICATION_ANALISYS : ''; ?></textarea>
											<div id="editor1_error">
											</div>
										</div>
									</div>

								</div>

								<div class="tab-pane" id="tab4">
                                    <!-- <h3 class="form-section">Nilai Actual &nbsp;<?php echo '#'.$ii++;?></h3>
									<div class="form-group">
										<label class="control-label col-md-3">Nilai Actual Risk <span class="required">*</span></label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" name="MITIGASI_RISK_K_ID" required="required">
													<?php foreach($MITIGASI_RISK_K as $key=>$val): ?>
													<?php if($key==$MITIGASI_RISK_K_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level kemungkinan setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-kemungkinan">Informasi</label>

										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon input-circle-left">K</span>
												<select class="form-control select2me" name="MITIGASI_RISK_D_ID" required="required">
													<?php foreach($MITIGASI_RISK_D as $key=>$val): ?>
													<?php if($key==$MITIGASI_RISK_D_ID) { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } else { ?>
													<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
													<?php } ?>
													<?php endforeach; ?>
												</select>
											</div>
											<span class="help-block">Level dampak setelah dilakukan kontrol</span>
										</div>
										<label class="btn btn-circle blue col-md-1 informasi-dampak">Informasi</label>
									</div> -->
                                    <div class="form-group">
										<label class="control-label col-md-3">Status Dokumen <span class="required">*</span></label>
										<div class="col-md-5">
											<select class="form-control select2me" name="STATUS_DOKUMEN_ID" required="required">
												<option value="">-- Pilih Status Dokumen Assessment --</option>
												<option value="<?php echo STATUS_ON_MONITORING;?>">On Monitoring</option>
												<!-- <option value="<?php // echo STATUS_MITIGATED;?>">Mitigated</option> -->
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn btn-circle default button-previous">
										<i class="m-icon-swapleft"></i> Back 
									</a>

									<a href="javascript:;" class="btn btn-circle blue button-next">
										Continue <i class="m-icon-swapright m-icon-white"></i>
									</a>

									<a href="javascript:;" class="btn btn-circle green button-submit">
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
<?php $this->load->view('exco-effectiveness-modal-admin'); ?>

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
            "stylesheets": ["<?php echo base_url() ?>assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"],
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
						QUANTIFICATION: {
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
						EXCO_EFFECTIVENESS_VALUE_K_ID: {
	                        required: true
	                    },
						EXCO_EFFECTIVENESS_VALUE_D_ID: {
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
						DAMPAK_RENCANA_PENGENDALIAN: {
	                        required: true
	                    },
	                    RISK_PIC_ID_K: {
	                        required: true
	                    },
						PIC_UNIT_KERJA_ID: {
	                        required: true
	                    },
						PIC_KANTOR_PUSAT_ID: {
	                        required: true
	                    },
	                    MULAI_WAKTU: {
	                        required: true
	                    },
	                    TARGET_WAKTU: {
	                        required: true
	                    },
						MITIGATION_COSTS: {
	                        required: true,
							digits: true
	                    },
						TARGET_RESIDUAL_RISK_K_ID: {
	                        required: true
	                    },
						TARGET_RESIDUAL_RISK_D_ID: {
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
	            	$.blockUI();
	            	
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

	                            $.unblockUI();
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
		clone.find(".format-rupiah").attr("id", "MITIGATION_COSTS[" + count + "]");
        //append clone on the end
		$(".clonearea").append(clone);

		/*$(".select2me").select2('destroy');
		$(".select2me").select2();*/

		var rupiah = document.getElementById("MITIGATION_COSTS[" + count + "]");
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});


        count++;
    });

	function hapus(id)
	{
		$("#clone_"+id).remove();
	}

	//MITIGATION_COSTS format rupiah
	<?php if($MITIGASI != FALSE){ ?>
		var arrayFromPHP = <?php echo json_encode($MITIGASI) ?>;
		$.each(arrayFromPHP, function (i, elem) {
			//var RISK_MITIGATION_ID = elem.RISK_MITIGATION_ID;
			var count = i + 1;
			var rupiah = document.getElementById("MITIGATION_COSTS[" + count + "]");
			rupiah.addEventListener('keyup', function(e){
				// tambahkan 'Rp.' pada saat form di ketik
				// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
				rupiah.value = formatRupiah(this.value, 'Rp. ');
			});
		});
	<?php } else { ?>
		var count = 1;
		var rupiah = document.getElementById("MITIGATION_COSTS[" + count + "]");
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
		
	<?php } ?>

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	
</script>
</script>
<!-- END JAVASCRIPTS -->
