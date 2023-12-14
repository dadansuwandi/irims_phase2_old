<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Progress
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Progress</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN FORM FILTER -->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Filter
		</div>
		<!-- <div class="tools">
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
		<!-- BEGIN FORM-->
		<form action="" method="POST" class="horizontal-form">
			<div class="form-body">
				<h3 class="form-section">Search with :</h3>
				<div class="row">
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Branch</label>
							<select class="form-control select2me" name="unit_id" required="required">
								<?php foreach($unit as $key=>$val): ?>
								<?php if($key==$unit_id) { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } else { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Years</label>
							<input type="text" class="form-control" name="tahun" value="<?php echo !empty($tahun) ? $tahun : date('Y')?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Risk Function</label>
							<select class="form-control select2me" name="risk_category_id" required="required">
								<option value="ALL" <?php echo $risk_category_id==="ALL"?"selected='selected'":""?>>ALL</option>
								<?php foreach($risk_category as $key=>$val): ?>
								<?php if($key==$risk_category_id) { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } else { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">State</label>
							<select class="form-control select2me" name="status" required="required">
								<option value="">-- Pilih --</option>
								<option value="ALL" <?php echo $status==="ALL"?"selected='selected'":""?>>Teridentifikasi</option>
								<option value="N" <?php echo $status==="N"?"selected='selected'":""?>>Belum Termitigasi</option>
								<option value="Y" <?php echo $status==="Y"?"selected='selected'":""?>>Termitigasi</option>
							</select>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Is Top Risk?</label>
							<div class="checkbox-list">
								<label><input type="checkbox" id="top_risk" name="top_risk" value="yes"> Yes </label>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
				<a href="<?php echo site_url('risk_report/work_paper_report/index'); ?>" class="btn default">Reset</a> 
				<a id="selectedPrintPDF" href="#" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<!-- END FORM FILTER -->

<?php if($search){?>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Assessment
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
                    <tr>
						<th class="hidden-xs" colspan="1" style="background-color:#8E5FA2; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">&nbsp;</th>
						<th class="hidden-xs" colspan="4" style="background-color:#FFC000; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">&nbsp;</th>
						<th class="hidden-xs" colspan="5" style="background-color:#92D14F; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">&nbsp;</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">Q1</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">Q2</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">Q3</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">Q4</th>
					</tr>
					<tr>
						<th class="hidden-xs" colspan="1" style="background-color:#8E5FA2; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">SELECT ALL</th>
						<th class="hidden-xs" colspan="4" style="background-color:#FFC000; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">IDENTIFIKASI RISIKO</th>
						<th class="hidden-xs" colspan="5" style="background-color:#92D14F; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">RENCANA PENANGANAN RISIKO</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">MONITORING & EVALUASI</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">MONITORING & EVALUASI</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">MONITORING & EVALUASI</th>
						<th class="hidden-xs" colspan="7" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">MONITORING & EVALUASI</th>
					</tr>

					<tr>
						<th class="table-checkbox" rowspan="2" style="background-color:#8E5FA2; text-align: center; vertical-align: middle;"><input type="checkbox" name="select_all_for_pdf[]"  class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">NO</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">TARGET / SASARAN</th>
						<th class="hidden-xs" colspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">DESKRIPSI RISIKO</th>
						<th class="hidden-xs" colspan="2" style="background-color:#92D14F; text-align: center; vertical-align: middle;">RENCANA PENANGANAN RISIKO (Pencegahan dan/ atau Pemulihan)</th>
						<th class="hidden-xs" colspan="2" style="background-color:#92D14F; text-align: center; vertical-align: middle;">TARGET WAKTU</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#92D14F; text-align: center; vertical-align: middle;">PIC</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">WAKTU PELAKSANAAN</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KETERANGAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">WAKTU PELAKSANAAN</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KETERANGAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">WAKTU PELAKSANAAN</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KETERANGAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">WAKTU PELAKSANAAN</th>
                        <th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KETERANGAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
					</tr>

					<tr>
						<th class="hidden-xs" style="background-color:#FFC000; text-align: center; vertical-align: middle;">RISK REGISTER</th>
						<th class="hidden-xs" style="background-color:#FFC000; text-align: center; vertical-align: middle;">RISK EVENT</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">KEMUNGKINAN</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">DAMPAK</th>
                        <th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">TANGGAL MULAI</th>
                        <th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">TANGGAL SELESAI</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$teridentifikasi = 0;
					$termitigasi = 0;
					$summary = array();

					$no = 1;
					foreach ($rows as $risk_item_id => $row):
						$risk_item = $this->risk_item_model->get_by_id($risk_item_id);
					?>
						<?php
							$temp = 1;
							foreach($row['data'] as $d){
								$mitigation = $this->risk_mitigation_model->get_data($d->RISK_IDENTIFICATION_ID);
						?>
						<!-- Begin Row -->
						<tr>
							<td><input type="checkbox" class="checkboxes" name="select_for_pdf[]" value="<?php echo $d->RISK_IDENTIFICATION_ID?>"/></td>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d->KPI?></td>
							<?php if($temp==1){?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->name; ?></td>
							<?php $temp++;} ?>
							<td><a href="<?php echo site_url('risk_report/work_paper_report/view/' . $d->RISK_IDENTIFICATION_ID .'/1'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
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
                            <td>
								<?php
									if($mitigation){
										echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											echo "<li>".$this->risk_pic_model->get_by_id($mitigation[$i]->PIC_KANTOR_PUSAT_ID)->name."</li>";
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
											
											//get quarter
											$getQ1 = get_quarter_from_date($mitigation[$i]->EXECUTION_TIME);
											if ($getQ1 == "Q1") {
											echo "<li>".$mitigation[$i]->EXECUTION_TIME."</li>";
											}
										}
										echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
                            <td><?php if ($getQ1 == "Q1") { echo $d->TREATMENT_DECISION_DESCRIPTION; } ?></td>
							<td><?php if ($getQ1 == "Q1") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_K; } ?></td>
							<td><?php if ($getQ1 == "Q1") { echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_D; } ?></td>
							<td><?php if ($getQ1 == "Q1") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet; } ?></td>
							<td>
								<?php
									if ($getQ1 == "Q1") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->TARGET_RESIDUAL_RISK_K_ID, $d->TARGET_RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											echo "Ekstrem";
											break;
										case RISIKO_TINGGI:
											echo "Tinggi";
											break;
										case RISIKO_SEDANG:
											echo "Menengah";
											break;
										case RISIKO_RENDAH:
											echo "Rendah";
											break;
										case RISIKO_SANGAT_RENDAH:
											echo "Sangat Rendah";
											break;
										default:
											echo "Not Set";
									}
									}
								?>
							</td>
							<td><?php if ($getQ1 == "Q1") { echo $d->QUANTIFICATION_ANALISYS; } ?></td>
							<td>
								<?php
									if($mitigation){
										echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											if ($getQ1 == "Q2") {
											echo "<li>".$mitigation[$i]->EXECUTION_TIME."</li>";
											}
										}
										echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
                            <td><?php if ($getQ1 == "Q2") { echo $d->TREATMENT_DECISION_DESCRIPTION; } ?></td>
							<td><?php if ($getQ1 == "Q2") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_K; } ?></td>
							<td><?php if ($getQ1 == "Q2") { echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_D; } ?></td>
							<td><?php if ($getQ1 == "Q2") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet; } ?></td>
							<td>
								<?php
									if ($getQ1 == "Q2") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->TARGET_RESIDUAL_RISK_K_ID, $d->TARGET_RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											echo "Ekstrem";
											break;
										case RISIKO_TINGGI:
											echo "Tinggi";
											break;
										case RISIKO_SEDANG:
											echo "Menengah";
											break;
										case RISIKO_RENDAH:
											echo "Rendah";
											break;
										case RISIKO_SANGAT_RENDAH:
											echo "Sangat Rendah";
											break;
										default:
											echo "Not Set";
									}
									}
								?>
							</td>
							<td><?php if ($getQ1 == "Q2") { echo $d->QUANTIFICATION_ANALISYS; } ?></td>
							<td>
								<?php
									if($mitigation){
										echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											if ($getQ1 == "Q3") {
											echo "<li>".$mitigation[$i]->EXECUTION_TIME."</li>";
											}
										}
										echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
                            <td><?php if ($getQ1 == "Q3") { echo $d->TREATMENT_DECISION_DESCRIPTION; } ?></td>
							<td><?php if ($getQ1 == "Q3") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_K; } ?></td>
							<td><?php if ($getQ1 == "Q3") { echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_D; } ?></td>
							<td><?php if ($getQ1 == "Q3") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet; } ?></td>
							<td>
								<?php
									if ($getQ1 == "Q3") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->TARGET_RESIDUAL_RISK_K_ID, $d->TARGET_RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											echo "Ekstrem";
											break;
										case RISIKO_TINGGI:
											echo "Tinggi";
											break;
										case RISIKO_SEDANG:
											echo "Menengah";
											break;
										case RISIKO_RENDAH:
											echo "Rendah";
											break;
										case RISIKO_SANGAT_RENDAH:
											echo "Sangat Rendah";
											break;
										default:
											echo "Not Set";
									}
									}
								?>
							</td>
							<td><?php if ($getQ1 == "Q3") { echo $d->QUANTIFICATION_ANALISYS; } ?></td>
							<td>
								<?php
									if($mitigation){
										echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											if ($getQ1 == "Q4") {
											echo "<li>".$mitigation[$i]->EXECUTION_TIME."</li>";
											}
										}
										echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
                            <td><?php if ($getQ1 == "Q4") { echo $d->TREATMENT_DECISION_DESCRIPTION; } ?></td>
							<td><?php if ($getQ1 == "Q4") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_K; } ?></td>
							<td><?php if ($getQ1 == "Q4") { echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?> <br> <?php echo $d->NOTES_TARGET_RESIDUAL_RISK_D; } ?></td>
							<td><?php if ($getQ1 == "Q4") { echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet; } ?></td>
							<td>
								<?php
									if ($getQ1 == "Q4") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->TARGET_RESIDUAL_RISK_K_ID, $d->TARGET_RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											echo "Ekstrem";
											break;
										case RISIKO_TINGGI:
											echo "Tinggi";
											break;
										case RISIKO_SEDANG:
											echo "Menengah";
											break;
										case RISIKO_RENDAH:
											echo "Rendah";
											break;
										case RISIKO_SANGAT_RENDAH:
											echo "Sangat Rendah";
											break;
										default:
											echo "Not Set";
									}
									}
								?>
							</td>
							<td><?php if ($getQ1 == "Q4") { echo $d->QUANTIFICATION_ANALISYS; } ?></td>
						</tr>
						<!-- End Row -->
						<?php 
								$category_risk = $this->risk_category_model->get_by_id($d->RISK_CATEGORY_ID)->name;
								$teridentifikasi += $d->TERIDENTIFIKASI;
								$termitigasi += $d->TERMITIGASI;

								if(array_key_exists($category_risk, $summary)){
									$summary[$category_risk]['teridentifikasi'] += $d->TERIDENTIFIKASI;
									$summary[$category_risk]['termitigasi'] += $d->TERMITIGASI;
								}else{
									$summary[$category_risk]['teridentifikasi'] = $d->TERIDENTIFIKASI;
									$summary[$category_risk]['termitigasi'] = $d->TERMITIGASI;
								}
							}
						?>
					<?php endforeach; ?>
						<tr>
							<td colspan="4" align="center"><b>JUMLAH</b></td>
							<td colspan="2"><b><?php echo "TERIDENTIFIKASI: ".$teridentifikasi?></b></td>
							<td colspan="2"><b><?php echo "TERMITIGASI: ".$termitigasi?></b></td>
							<td colspan="16">&nbsp;</td>
						</tr>
				</tbody>
			</table>

			<table style="width:400px !important" class="table table-striped table-bordered table-hover">
				<tr align="center">
					<td colspan="3"><b>CAPAIAN TARGET</b></td>
				</tr>

				<tr align="center">
					<td>&nbsp</td>
					<td><b>TERIDENTIFIKASI</b></td>
					<td><b>TERMITIGASI</b></td>
				</tr>

				<?php 
				if(array_key_exists('OPSTEK',$summary)){
				?>
				<tr>
					<td>OPSTEK</td>
					<td><?php echo $summary['OPSTEK']['teridentifikasi']?></td>
					<td><?php echo $summary['OPSTEK']['termitigasi']?></td>
				</tr>
				<?php }else{ ?>
				<tr>
					<td>OPSTEK</td>
					<td><?php echo "0"?></td>
					<td><?php echo "0"?></td>
				</tr>
				<?php }?>

				<?php 
				if(array_key_exists('ADKOM',$summary)){
				?>
				<tr>
					<td>ADKOM</td>
					<td><?php echo $summary['ADKOM']['teridentifikasi']?></td>
					<td><?php echo $summary['ADKOM']['termitigasi']?></td>
				</tr>
				<?php }else{ ?>
				<tr>
					<td>ADKOM</td>
					<td><?php echo "0"?></td>
					<td><?php echo "0"?></td>
				</tr>
				<?php }?>

				<tr>
					<td>TOTAL</td>
					<td><?php echo $teridentifikasi?></td>
					<td><?php echo $termitigasi?></td>
				</tr>

				<tr align="center">
					<td><h4><b>TARGET PENCAPAIAN (%)</b></h4></td>
					<td colspan="2"><h2><b>
						<?php
							echo $this->target_pencapaian_model->get_target($unit_id, $tahun);
						?>
					</b></h2></td>
				</tr>
				<tr align="center">
					<td><h4><b>PENCAPAIAN (%)</b></h4></td>
					<td colspan="2"><h2><b>
						<?php
							if($teridentifikasi == 0){
								echo "0";
							}else{
								echo round(($termitigasi/$teridentifikasi)*100, 2);
							} 
						?>
					</b></h2></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php }?>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {       
		//Begin table checkbox
		var table = $('#sample_1');

        // begin first table
        /* table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing1 _START_ to _END_ of _TOTAL_ entries1",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "My search: ",
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        }); */

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
		//End table checkbox
	});


	//begin print selected pdf
	$('input[name="select_all_for_pdf[]"]').prop('checked',true);
	$('input[name="select_for_pdf[]"]').prop('checked',true);

	var url = "<?php echo site_url('risk_report/work_paper_report/index_pdf?tahun='.$_POST['tahun'].'&status='.$_POST['status'].'&risk_category_id='.$_POST['risk_category_id'].'&unit_id='.$_POST['unit_id']); ?>";
	$('#selectedPrintPDF').click(function(){
		var first = 0;
		$('input[name="select_for_pdf[]"]').each(function(i){
			//console.log($(this).is(':checked'));
			if( $(this).is(':checked')){
				url += ((first==0) ? "&" : "&") + 'selected_print=' + $(this).attr('value');
				first = 1;
			}	
		});
	//console.log(url);
	//this will print pdf link
	document.location.href = url;
	});
	//end print selected pdf
</script>
<!-- END JAVASCRIPTS -->

<?php 
// get month name from number
function month_name($month_number){
	return date('F', mktime(0, 0, 0, $month_number, 10));
}


// get get last date of given month (of year)
function month_end_date($year, $month_number){
	return date("t", strtotime("$year-$month_number-0"));
}

// return two digit month or day, e.g. 04 - April
function zero_pad($number){
	if($number < 10)
		return "0$number";
	
	return "$number";
}

// Return quarters between tow dates. Array of objects
function get_quarters($start_date, $end_date){
	
	$quarters = array();
	
	$start_month = date( 'm', strtotime($start_date) );
	$start_year = date( 'Y', strtotime($start_date) );
	
	$end_month = date( 'm', strtotime($end_date) );
	$end_year = date( 'Y', strtotime($end_date) );
	
	$start_quarter = ceil($start_month/3);
	$end_quarter = ceil($end_month/3);

	$quarter = $start_quarter; // variable to track current quarter
	
	// Loop over years and quarters to create array
	for( $y = $start_year; $y <= $end_year; $y++ ){
		if($y == $end_year)
			$max_qtr = $end_quarter;
		else
			$max_qtr = 4;
		
		for($q=$quarter; $q<=$max_qtr; $q++){
			
			$current_quarter = new stdClass();
			
			$end_month_num = zero_pad($q * 3);
			$start_month_num = ($end_month_num - 2);

			$q_start_month = month_name($start_month_num);
			$q_end_month = month_name($end_month_num);
			
			$current_quarter->period = "Qtr $q ($q_start_month - $q_end_month) $y";
			$current_quarter->period_start = "$y-$start_month_num-01";      // yyyy-mm-dd    
			$current_quarter->period_end = "$y-$end_month_num-" . month_end_date($y, $end_month_num);
			
			$quarters[] = $current_quarter;
			unset($current_quarter);
		}

		$quarter = 1; // reset to 1 for next year
	}
	
	return $quarters;
	
}

//$quarters = get_quarters('2010-04-05', '2015-05-01');
       

// Test	   
//echo '<pre>';
//print_r($quarters);
//echo '</pre>';

function get_quarter_from_date($date){
	//Our date.
	$dateStr = $date;

	//Get the month number of the date
	//in question.
	$month = date("n", strtotime($dateStr));

	//Divide that month number by 3 and round up
	//using ceil.
	$yearQuarter = ceil($month / 3);

	//Print it out
	return 'Q'.$yearQuarter;
}
?>
