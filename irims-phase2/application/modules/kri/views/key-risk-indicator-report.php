<?php 
	$CI =& get_instance();
	$CI->load->model('master/risk_item_model');
	$CI->load->model('risk/risk_mitigation_model');
	$CI->load->model('master/risk_probability_model');
   	$CI->load->model('master/risk_impact_model');
   	$CI->load->model('master/risk_pic_model');
    $CI->load->model('master/risk_category_model');
	$CI->load->model('auth/user_model');
?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Key Risk Indicator <small>Integrated Risk Management System (IRIMS)</small>
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
			<i class="fa fa-list"></i>Worksheet KRI
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
					<tr>
						<!-- <th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">NO</th> -->
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Urutan Top Risk</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Risk Register</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Risk Event</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Risk Owner</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Basic Event</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Key Risk Indicator <br> (Long Description From Risk Owner)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Bobot Rata-Rata <br> per Penyebab Risiko</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Justifikasi Pilihan</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Penyederhanaan Deskripsi KRI <br> untuk Dashboard</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Satuan</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">Sifat KRI <br> (Lagging/Leading)</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#51D14F; text-align: center; vertical-align: middle;">Threshold Acceptable</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">Threshold Tolerable</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#FE0000; text-align: center; vertical-align: middle;">Threshold Unacceptable</th>
						<th class="hidden-xs" colspan="12" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;"><?php echo $tahun;?></th>
					</tr>

					<tr>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">January</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">February</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">March</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">April</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">May</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">June</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">July</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">August</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">September</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">October</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">November</th>
						<th class="hidden-xs" style="background-color:#F5F0F0; text-align: center; vertical-align: middle;">December</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($rows as $row):
						//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
						$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_report($row->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
					?>
						<!-- Begin Row -->
						<tr>
							<!-- <td><?php // echo $no++; ?></td> -->
							<td><?php echo $row->TOP_RISK_NUMBER; ?></td>
							<td>
								<?php
								$risk_item = $this->risk_item_model->get_by_id($row->RISK_ITEM_ID);
								if ($risk_item)
									echo $risk_item->name;
								else
									echo '-';
								?>								
							</td>
							<td><?php echo $row->HAZARD; ?></td>
							<td>
								<?php
								$user = $this->user_model->get_by_id($row->auth_user_id);
								if ($user)
									echo $user->first_name." ".$user->last_name." (".$user->username.")";
								else
									echo '-';
								?>								
							</td>
							<td><?php echo $row->BASIC_EVENT; ?></td>
							<td>
								<?php
								$indicator = $this->indicator_model->get_by_id($row->INDICATOR_ID);
								if ($indicator)
									echo $indicator->name;
								else
									echo '-';
								?>								
							</td>
							<td><?php echo '-' ?></td>
							<td><?php echo '-' ?></td>
							<td><?php echo $row->DASHBOARD_DESCRIPTION; ?></td>
							<td><?php echo '-' ?></td>
							<td>
								<?php 
								if ($row->LEADING_LAGGING == '1') {
									echo 'LEADING';
								} elseif ($row->LEADING_LAGGING == '2') {
									echo 'LAGGING';
								}
								?>
							</td>
							<td>
								<?php
								$indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($row->key_risk_indicator_threshold_id);
								if ($indicator_threshold)
									echo $indicator_threshold->threshold_acceptable;
								else
									echo '-';
								?>								
							</td>
							<td>
								<?php
								$indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($row->key_risk_indicator_threshold_id);
								if ($indicator_threshold)
									echo $indicator_threshold->threshold_tolerable;
								else
									echo '-';
								?>								
							</td>
							<td>
								<?php
								$indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($row->key_risk_indicator_threshold_id);
								if ($indicator_threshold)
									echo $indicator_threshold->threshold_unacceptable;
								else
									echo '-';
								?>								
							</td>

							<!-- <td>
								<?php
									if($key_risk_indicator_threshold_value){
										echo "<ol>";
										for ($i=0; $i <= count($key_risk_indicator_threshold_value)-1; $i++) { 
											if($key_risk_indicator_threshold_value[$i]->threshold_value!=""){
												echo "<li>".$key_risk_indicator_threshold_value[$i]->threshold_value."</li>";
											}
										}
										echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td> -->

							<?php
								if($key_risk_indicator_threshold_value){
									$monthlyReport = array();

									foreach ($key_risk_indicator_threshold_value as $rowValue) {
										$monthlyReport = $rowValue;
									}

									//get key indicator_threshold
									$indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($row->key_risk_indicator_threshold_id);
									//echo "<pre>";
									//var_dump($indicator_threshold->nilai_awal);
									//var_dump($indicator_threshold->simbol);
									//var_dump($indicator_threshold->nilai_akhir);
									
							?>

									<td 
										<?php 
											if ((($monthlyReport->January < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->January > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->January) && ($monthlyReport->January <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->January) && ($monthlyReport->January >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->January > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->January < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->January, 2, '.', ''); ?>
									</td>
							
									<td 
										<?php 
											if ((($monthlyReport->February < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->February > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->February) && ($monthlyReport->February <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->February) && ($monthlyReport->February >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->February > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->February < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->February, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->March < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->March > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->March) && ($monthlyReport->March <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->March) && ($monthlyReport->March >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->March > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->March < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->March, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->April < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->April > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->April) && ($monthlyReport->April <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->April) && ($monthlyReport->April >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->April > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->April < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->April, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->May < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->May > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->May) && ($monthlyReport->May <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->May) && ($monthlyReport->May >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->May > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->May < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->May, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->June < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->June > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->June) && ($monthlyReport->June <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->June) && ($monthlyReport->June >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->June > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->June < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->June, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->July < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->July > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->July) && ($monthlyReport->July <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->July) && ($monthlyReport->July >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->July > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->July < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->July, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->August < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->August > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->August) && ($monthlyReport->August <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->August) && ($monthlyReport->August >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->August > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->August < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->August, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->September < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->September > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->September) && ($monthlyReport->September <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->September) && ($monthlyReport->September >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->September > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->September < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->September, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->October < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->October > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->October) && ($monthlyReport->October <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->October) && ($monthlyReport->October >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->October > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->October < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->October, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->November < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->November > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->November) && ($monthlyReport->November <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->November) && ($monthlyReport->November >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->November > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->November < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->November, 2, '.', ''); ?>
									</td>

									<td 
										<?php 
											if ((($monthlyReport->December < $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->December > $indicator_threshold->nilai_awal) && ($indicator_threshold->simbol == "&gt;"))) { 
												echo 'style="background-color:#51D14F;"'; //green
											} else if ((($indicator_threshold->nilai_awal <= $monthlyReport->December) && ($monthlyReport->December <= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($indicator_threshold->nilai_awal >= $monthlyReport->December) && ($monthlyReport->December >= $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FFFF00;"'; //yellow
											} else if ((($monthlyReport->December > $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&lt;")) || (($monthlyReport->December < $indicator_threshold->nilai_akhir) && ($indicator_threshold->simbol == "&gt;"))) {
												echo 'style="background-color:#FE0000;"'; //red
											} 
										?> 
									>
										<?php echo number_format((float)$monthlyReport->December, 2, '.', ''); ?>
									</td>
							<?php
								}else{
									echo "";
								}
							?>


							<!-- <td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td>
							<td <?php 
									$nilai = rand(1,2000); 
									if ($nilai < 100) { 
										echo 'style="background-color:#51D14F;"'; 
									} else if ($nilai >= 100 and $nilai <= 1000) { 
										echo 'style="background-color:#FFFF00;"'; 
									} else {
										echo 'style="background-color:#FE0000;"';
									}
								?> ><?php echo $nilai; ?></td> -->
						</tr>
						<!-- End Row -->
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
			var url = "<?php echo site_url('/kri/key_risk_indicator/index_kri_report').'?tahun='; ?>"+$(this).val();
			window.location.replace(url);
		});
	});
</script>
<!-- END JAVASCRIPTS -->