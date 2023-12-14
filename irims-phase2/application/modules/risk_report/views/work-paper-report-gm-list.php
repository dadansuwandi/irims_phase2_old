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
				</div>

				<div class="row">	
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
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
				<a href="<?php echo site_url('risk_report/work_paper_report/gm'); ?>" class="btn default">Reset</a> 
				<a href="<?php echo site_url('risk_report/work_paper_report/gm_pdf?tahun='.$_POST['tahun'].'&status='.$_POST['status'].'&risk_category_id='.$_POST['risk_category_id']); ?>" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>
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
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="hidden-xs" colspan="7" style="background-color:#FFC000; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">IDENTIFIKASI RISIKO</th>
						<th class="hidden-xs" colspan="8" style="background-color:#3BA0FF; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">ANALISIS RISIKO SAAT INI (Current Risk)</th>
						<th class="hidden-xs" colspan="4" style="background-color:#92D14F; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">RENCANA PENANGANAN RISIKO</th>
						<th class="hidden-xs" colspan="5" style="background-color:#FFFF00; text-align: center; vertical-align: middle; border-bottom: 1px solid black;">ANALISIS RISIKO RESIDUAL (Residual Risk)</th>
					</tr>

					<tr>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">NO</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">TARGET KPI</th>
						<th class="hidden-xs" colspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">DESKRIPSI RISIKO</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">KATEGORI RISIKO</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">PENYEBAB RISIKO (Controllable & Uncontrollable)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFC000; text-align: center; vertical-align: middle;">DAMPAK RISIKO (Dampak pada aspek Produk & Layanan, Pelanggan, Keuangan & Pasar, SDM, Bisnis Internal, Kepemimpinan)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">KONTROL EKSISTING (Kontrol Pencegahan dan/ atau Pemulihan</th>
						<th class="hidden-xs" colspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">EFEKTIFITAS KONTROL (Overall)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
						<th class="hidden-xs" colspan="2" style="background-color:#92D14F; text-align: center; vertical-align: middle;">RENCANA PENANGANAN RISIKO (Pencegahan dan/ atau Pemulihan)</th>
						<th class="hidden-xs" colspan="2" style="background-color:#92D14F; text-align: center; vertical-align: middle;">TARGET WAKTU</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT KEMUNGKINAN</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">TARGET TINGKAT DAMPAK</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">LEVEL</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">R/M/T/E (Rendah/Menengah/Tinggi/Ekstrem)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">KUANTIFIKASI</th>
					</tr>

					<tr>
						<th class="hidden-xs" style="background-color:#FFC000; text-align: center; vertical-align: middle;">RISK REGISTER</th>
						<th class="hidden-xs" style="background-color:#FFC000; text-align: center; vertical-align: middle;">RISK EVENT</th>
						<th class="hidden-xs" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">K</th>
						<th class="hidden-xs" style="background-color:#3BA0FF; text-align: center; vertical-align: middle;">D</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">KEMUNGKINAN</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">DAMPAK</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">MULAI</th>
						<th class="hidden-xs" style="background-color:#92D14F; text-align: center; vertical-align: middle;">SELESAI</th>
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
							<td><?php echo $no++; ?></td>
							<td><?php echo $d->KPI?></td>
							<?php if($temp==1){?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->name; ?></td>
							<?php $temp++;} ?>
							<td><a href="<?php echo site_url('risk_report/work_paper_report/view/' . $d->RISK_IDENTIFICATION_ID .'/3'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
							<td>
								<?php
									$risk = $this->risk_model->get_by_id($risk_item->risk_id)->name;
									echo $risk;
								?>
							</td>
							<td><?php echo $d->PENYEBAB?></td>
							<td><?php echo $d->DAMPAK?></td>
							<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
							<td><?php echo $d->EXCO_EFFECTIVENESS_VALUE_K_ID!=0?$d->EXCO_EFFECTIVENESS_VALUE_K_ID:'Not Set'; ?></td>
							<td><?php echo $d->EXCO_EFFECTIVENESS_VALUE_D_ID!=0?$d->EXCO_EFFECTIVENESS_VALUE_D_ID:'Not Set'; ?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td>
								<?php
									$risk_level_id = $this->risk_value_model->get_risk_level($d->RESIDUAL_RISK_K_ID, $d->RESIDUAL_RISK_D_ID);
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
								?>
							</td>
							<td><?php echo $d->QUANTIFICATION?></td>
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
							<td><?php echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td>
								<?php
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
								?>
							</td>
							<td><?php echo $d->QUANTIFICATION?></td>
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
