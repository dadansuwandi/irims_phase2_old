<style>
	.RISIKO_SANGAT_TINGGI {
    	background: #FE0000;
	}
	.RISIKO_TINGGI {
    	background: #FFFF00;
	}
	.RISIKO_SEDANG {
    	background: #72DAD7;
	}
	.RISIKO_RENDAH {
    	background: #51D14F;
	}
	.RISIKO_SANGAT_RENDAH {
    	background: #92D14F;
	}
</style>

<?php 
	$CI =& get_instance();
	$CI->load->model('master/risk_item_model');
	$CI->load->model('risk/risk_mitigation_model');
	$CI->load->model('master/risk_probability_model');
   	$CI->load->model('master/risk_impact_model');
   	$CI->load->model('master/risk_pic_model');
    $CI->load->model('master/risk_category_model');
?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Profile <small>Integrated Risk Management System (IRIMS)</small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="#">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('welcome'); ?>">Dashboard</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<h4><b>Tahun Laporan</b></h4>
					</div>
					
					<div class="col-md-3 col-sm-12 col-xs-12">
						<?php
							$tahun_awal = 2014;
							$array_tahun= array();

							for ($i=$tahun_awal; $i <= date('Y')+1 ; $i++) { 
								$array_tahun[] = $i;
							}
						?>
						<select class="form-control" id="tahun_laporan_select">
							<?php 
								foreach($array_tahun as $at){
									if($at==$tahun){
										echo "<option value=".$at." selected='selected'>".$at."</option>";
									}else{
										echo "<option value=".$at.">".$at."</option>";
									}
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($search){?>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Profile Corporate
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
					<tr>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">No</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Risk Register</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Kategori Risiko</th>
						<th class="hidden-xs" colspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Q1</th>
                        <th class="hidden-xs" colspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Q2</th>
                        <th class="hidden-xs" colspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Q3</th>
                        <th class="hidden-xs" colspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Q4</th>
					</tr>

					<tr>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Potential Risk</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Monev</th>
                        <th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Potential Risk</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Monev</th>
                        <th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Potential Risk</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Monev</th>
                        <th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Potential Risk</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Monev</th>
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

								//cek quarter
								if($mitigation){
									for ($i=0; $i <= count($mitigation)-1; $i++) { 
										//get quarter
										$getQuarterMonitoring = get_quarter_from_date($mitigation[$i]->TARGET_WAKTU);
										$getQuarterMitigated = get_quarter_from_date($mitigation[$i]->EXECUTION_TIME);
									}
								}else{
									echo "";
								}
						?>
						<!-- Begin Row -->
						<tr>
							<?php if($temp==1){?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $no++; ?></td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->name?></td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php
									$risk = $this->risk_model->get_by_id($risk_item->risk_id)->name;
									echo $risk;
								?>
							</td>
							
							<!-- grouping data -->
							<?php
								if ($getQuarterMonitoring == "Q1") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->RESIDUAL_RISK_K_ID, $d->RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$potentialRiskQ1 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$potentialRiskQ1 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$potentialRiskQ1 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$potentialRiskQ1 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$potentialRiskQ1 = strtoupper("Sangat Rendah");
											break;
										default:
											$potentialRiskQ1 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMitigated == "Q1") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->MITIGASI_RISK_K_ID, $d->MITIGASI_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$monevQ1 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$monevQ1 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$monevQ1 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$monevQ1 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$monevQ1 = strtoupper("Sangat Rendah");
											break;
										default:
											$monevQ1 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMonitoring == "Q2") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->RESIDUAL_RISK_K_ID, $d->RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$potentialRiskQ2 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$potentialRiskQ2 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$potentialRiskQ2 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$potentialRiskQ2 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$potentialRiskQ2 = strtoupper("Sangat Rendah");
											break;
										default:
											$potentialRiskQ2 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMitigated == "Q2") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->MITIGASI_RISK_K_ID, $d->MITIGASI_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$monevQ2 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$monevQ2 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$monevQ2 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$monevQ2 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$monevQ2 = strtoupper("Sangat Rendah");
											break;
										default:
											$monevQ2 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMonitoring == "Q3") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->RESIDUAL_RISK_K_ID, $d->RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$potentialRiskQ3 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$potentialRiskQ3 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$potentialRiskQ3 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$potentialRiskQ3 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$potentialRiskQ3 = strtoupper("Sangat Rendah");
											break;
										default:
											$potentialRiskQ3 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMitigated == "Q3") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->MITIGASI_RISK_K_ID, $d->MITIGASI_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$monevQ3 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$monevQ3 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$monevQ3 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$monevQ3 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$monevQ3 = strtoupper("Sangat Rendah");
											break;
										default:
											$monevQ3 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMonitoring == "Q4") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->RESIDUAL_RISK_K_ID, $d->RESIDUAL_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$potentialRiskQ4 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$potentialRiskQ4 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$potentialRiskQ4 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$potentialRiskQ4 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$potentialRiskQ4 = strtoupper("Sangat Rendah");
											break;
										default:
											$potentialRiskQ4 = "";
									}
								}
							?>
							<?php
								if ($getQuarterMitigated == "Q4") {
									$risk_level_id = $this->risk_value_model->get_risk_level($d->MITIGASI_RISK_K_ID, $d->MITIGASI_RISK_D_ID);
									$risk_level_name = $this->risk_level_model->get_by_id($risk_level_id)->name;
									switch ($risk_level_id) {
										case RISIKO_SANGAT_TINGGI:
											$monevQ4 = strtoupper("Ekstrem");
											break;
										case RISIKO_TINGGI:
											$monevQ4 = strtoupper("Tinggi");
											break;
										case RISIKO_SEDANG:
											$monevQ4 = strtoupper("Menengah");
											break;
										case RISIKO_RENDAH:
											$monevQ4 = strtoupper("Rendah");
											break;
										case RISIKO_SANGAT_RENDAH:
											$monevQ4 = strtoupper("Sangat Rendah");
											break;
										default:
											$monevQ4 = "";
									}
								}
							?>

							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $potentialRiskQ1 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $monevQ1 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $potentialRiskQ2 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $monevQ2 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $potentialRiskQ3 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $monevQ3 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $potentialRiskQ4 ?>
							</td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important">
								<?php echo $monevQ4 ?>
							</td>
							<?php $temp++;} ?>
						</tr>
						<!-- End Row -->
						<?php 
							}
						?>
					<?php endforeach; ?>
				</tbody>
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
		$("#tahun_laporan_select").on('change', function(){
			var url = "<?php echo site_url('welcome/index_profile_kri').'?tahun='; ?>"+$(this).val();
			window.location.replace(url);
		});
	});

	// fill color in td cell
	$("td:contains('EKSTREM')").addClass('RISIKO_SANGAT_TINGGI');
	$("td:contains('TINGGI')").addClass('RISIKO_TINGGI');
	$("td:contains('MENENGAH')").addClass('RISIKO_SEDANG');
	$("td:contains('RENDAH')").addClass('RISIKO_RENDAH');
	$("td:contains('SANGAT RENDAG')").addClass('RISIKO_SANGAT_RENDAH');
</script>
<!-- END JAVASCRIPTS -->
<?php
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