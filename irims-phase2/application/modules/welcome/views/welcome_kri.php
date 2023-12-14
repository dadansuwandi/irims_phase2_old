<?php 
	$CI =& get_instance();
	$CI->load->model('master/risk_item_model');
	$CI->load->model('risk/risk_mitigation_model');
	$CI->load->model('master/risk_probability_model');
   	$CI->load->model('master/risk_impact_model');
   	$CI->load->model('master/risk_pic_model');
    $CI->load->model('master/risk_category_model');
	$CI->load->model('kri/key_risk_indicator_model');
	$CI->load->model('kri/key_risk_indicator_threshold_model');
	$CI->load->model('kri/key_risk_indicator_threshold_value_model');
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
							$tahun_awal = 2022;
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
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Key Risk Indicators (KRIs) - Top Risk
		</div>
	</div>
	<div class="portlet-body">
		<!--
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
					<tr>
						<th class="hidden-xs" rowspan="2" style="background-color:#836953; text-align: center; vertical-align: middle;">NO</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#836953; text-align: center; vertical-align: middle;">KPI Kontrak Manajemen</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#836953; text-align: center; vertical-align: middle;">KRI</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#836953; text-align: center; vertical-align: middle;">Target</th>
						<th class="hidden-xs" rowspan="2" style="background-color:#836953; text-align: center; vertical-align: middle;">Target Revisi</th>
						<th class="hidden-xs" colspan="3" style="background-color:#836953; text-align: center; vertical-align: middle;">Keterangan</th>
					</tr>

					<tr>
						<th class="hidden-xs" style="background-color:#51D14F; text-align: center; vertical-align: middle;">Acceptable*</th>
						<th class="hidden-xs" style="background-color:#FFFF00; text-align: center; vertical-align: middle;">Torelable*</th>
						<th class="hidden-xs" style="background-color:#FE0000; text-align: center; vertical-align: middle;">Unacceptable</th>
					</tr>
				</thead>
				<tbody> -->
					<?php
					// $no = 1;
					// foreach ($rows as $row):
					?>
						<!-- Begin Row -->
						<!--
						<tr>
							<td><?php // echo $no++; ?></td>
							<td><?php // echo $row->name; ?></td>
							<td><?php // echo $row->INDICATOR_NUMBER; ?></td>
							<td><?php // echo $row->TARGET.'  '.$row->TARGET_SATUAN; ?></td>
							<td><?php // echo $row->TARGET_REVISI.'  '.$row->TARGET_REVISI_SATUAN; ?></td>
							<td><?php // echo $row->ACCEPTABLE.'  '.$row->ACCEPTABLE_SATUAN; ?></td>
							<td><?php // echo $row->TORELABLE.'  '.$row->TORELABLE_SATUAN; ?></td>
							<td><?php // echo $row->UNACCEPTABLE.'  '.$row->UNACCEPTABLE_SATUAN; ?></td>
						</tr>
						-->
						<!-- End Row -->
					<?php // endforeach; ?>
				<!-- </tbody>
			</table>
		</div>
		-->
<!-- ====================================================== Traffic Ligh and Chart array[0] ====================================================== -->
		<?php
		//$no = 1;
		//foreach ($rows as $row):
			//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
			//$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($row->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
			
			$risk_item = $this->risk_item_model->get_by_id($rows[0]->RISK_ITEM_ID);

			$key_risk_indicators = $this->key_risk_indicator_model->get_kri($rows[0]->RISK_ITEM_ID, $_GET['tahun']);
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="portlet light" style="height: 900px;">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase"><?php echo /* $no++ .  */"1."; ?></span>
							<span class="caption-helper"><?php echo 'RR: ' . $risk_item->name; ?></span>
						</div>
					</div>
					<?php
					$i = 1;
					$ii = 1;
					foreach ($key_risk_indicators as $key1 => $key_risk_indicator):
						$keyArray1 = $key1+1;
						$key_risk_indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($key_risk_indicator->key_risk_indicator_threshold_id);
						
						///////////////////////////////////////////////////////////
						//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
						$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($key_risk_indicator->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
						$monthlyReport = array();
						foreach ($key_risk_indicator_threshold_value as $rowValue) {
							$monthlyReport[$keyArray1] = $rowValue;
						}
						
						//get value threshold value (average/month)
						$January 	= number_format((float)$monthlyReport[$keyArray1]->January, 2, '.', '');  
						$February 	= number_format((float)$monthlyReport[$keyArray1]->February, 2, '.', ''); 
						$March 		= number_format((float)$monthlyReport[$keyArray1]->March, 2, '.', ''); 
						$April 		= number_format((float)$monthlyReport[$keyArray1]->April, 2, '.', ''); 
						$May 		= number_format((float)$monthlyReport[$keyArray1]->May, 2, '.', ''); 
						$June 		= number_format((float)$monthlyReport[$keyArray1]->June, 2, '.', ''); 
						$July 		= number_format((float)$monthlyReport[$keyArray1]->July, 2, '.', ''); 
						$August 	= number_format((float)$monthlyReport[$keyArray1]->August, 2, '.', ''); 
						$September 	= number_format((float)$monthlyReport[$keyArray1]->September, 2, '.', ''); 
						$October 	= number_format((float)$monthlyReport[$keyArray1]->October, 2, '.', ''); 
						$November 	= number_format((float)$monthlyReport[$keyArray1]->November, 2, '.', ''); 
						$December 	= number_format((float)$monthlyReport[$keyArray1]->December, 2, '.', '');

						//get key_risk_indicator_threshold
						//var_dump($key_risk_indicator_threshold->nilai_awal);
						//var_dump($key_risk_indicator_threshold->simbol);
						//var_dump($key_risk_indicator_threshold->nilai_akhir);

						if ((($January < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJanuary 		= $January;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $January) && ($January <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $January) && ($January >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= $January;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($January > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= $January;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						}

						if ((($February < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableFebruary 	= $February;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $February) && ($February <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $February) && ($February >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= $February;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($February > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= $February;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($March < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMarch 		= $March;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $March) && ($March <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $March) && ($March >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= $March;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($March > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= $March;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($April < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableApril 		= $April;
							$tolerableApril 		= 0;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $April) && ($April <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $April) && ($April >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= $April;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($April > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= 0;
							$unacceptableApril 		= $April;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($May < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMay 			= $May;
							$tolerableMay 			= 0;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $May) && ($May <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $May) && ($May >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= $May;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($May > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= 0;
							$unacceptableMay 		= $May;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($June < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptablejune 		= $June;
							$tolerableJune 			= 0;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $June) && ($June <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $June) && ($June >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= $June;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($June > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= 0;
							$unacceptableJune 		= $June;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($July < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJuly 		= $July;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $July) && ($July <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $July) && ($July >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= $July;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($July > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= $July;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($August < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableAugust 		= $August;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $August) && ($August <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $August) && ($August >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= $August;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($August > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= $August;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($September < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableSeptember 	= $September;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $September) && ($September <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $September) && ($September >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= $September;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($September > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= $September;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($October < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableOctober 		= $October;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $October) && ($October <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $October) && ($October >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= $October;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($October > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= $October;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($November < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableNovember 	= $November;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $November) && ($November <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $November) && ($November >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= $November;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($November > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= $November;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($December < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableDecember 	= $December;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $December) && ($December <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $December) && ($December >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= $December;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($December > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= $December;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						//Array Temporary
						$arrTemp1[$keyArray1] = [
							'acceptable' => "['$acceptableJanuary', '$acceptableFebruary', '$acceptableMarch', '$acceptableApril', '$acceptableMay', '$acceptableJune', '$acceptableJuly', '$acceptableAugust', '$acceptableSeptember', '$acceptableOctober', '$acceptableNovember', '$acceptableDecember']", 
							'tolerable' => "['$tolerableJanuary', '$tolerableFebruary', '$tolerableMarch', '$tolerableApril', '$tolerableMay', '$tolerableJune', '$tolerableJuly', '$tolerableAugust', '$tolerableSeptember', '$tolerableOctober', '$tolerableNovember', '$tolerableDecember']",
							'unacceptable' => "['$unacceptableJanuary', '$unacceptableFebruary', '$unacceptableMarch', '$unacceptableApril', '$unacceptableMay', '$unacceptableJune', '$unacceptableJuly', '$unacceptableAugust', '$unacceptableSeptember', '$unacceptableOctober', '$unacceptableNovember', '$unacceptableDecember']"
						];
						
						///////////////////////////////////////////////////////////
						
					?>
					<div class="col-md-4">
						<div class="portlet light">
							<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
								<a class="dashboard-stat grey-salsa" href="#">
									<div class="visual">
										<i class="fa fa-file-o"></i>
									</div>
									<div class="details">
										<div class="number">
											<?php echo 'Deskripsi KRI-' . $i++?>
										</div>
										<div class="desc">
											<?php echo $key_risk_indicator_threshold->name; ?>
										</div>
									</div>
								</a>
							</div>
							<div class="portlet-body" style="text-align:center;width: 75px;margin: 0 auto;">
								<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
									<!-- traffic light -->
									<div hidden id="controlPanel<?php echo $keyArray1; ?>">
										<h1 id="stopButton<?php echo $keyArray1; ?>" class="button<?php echo $keyArray1; ?>">Stop</h1>
										<h1 id="slowButton<?php echo $keyArray1; ?>" class="button<?php echo $keyArray1; ?>">Slow</h1>
										<h1 id="goButton<?php echo $keyArray1; ?>" class="button<?php echo $keyArray1; ?>">Go</h1>
									</div>
									<div id="traffic-light<?php echo $keyArray1; ?>">
										<div id="stopLight<?php echo $keyArray1; ?>" class="bulb<?php echo $keyArray1; ?>" style="background-color:<?php echo $red; ?>;"></div>
										<div id="slowLight<?php echo $keyArray1; ?>" class="bulb<?php echo $keyArray1; ?>" style="background-color:<?php echo $yellow; ?>;"></div>
										<div id="goLight<?php echo $keyArray1; ?>" class="bulb<?php echo $keyArray1; ?>" style="background-color:<?php echo $green; ?>;"></div>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
									<!-- chart -->
									<canvas id="myChart<?php echo $keyArray1; ?>"></canvas>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php //endforeach; ?>

<!-- ====================================================== Traffic Ligh and Chart array[1] ====================================================== -->
<?php
		//$no = 1;
		//foreach ($rows as $row):
			//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
			//$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($row->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
			
			$risk_item = $this->risk_item_model->get_by_id($rows[1]->RISK_ITEM_ID);

			$key_risk_indicators = $this->key_risk_indicator_model->get_kri($rows[1]->RISK_ITEM_ID, $_GET['tahun']);
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="portlet light" style="height: 900px;">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase"><?php echo /* $no++ .  */"2."; ?></span>
							<span class="caption-helper"><?php echo 'RR: ' . $risk_item->name; ?></span>
						</div>
					</div>
					<?php
					$i = 1;
					$ii = 1;
					foreach ($key_risk_indicators as $key2 => $key_risk_indicator):
						$keyArray2 = $key2+4;
						$key_risk_indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($key_risk_indicator->key_risk_indicator_threshold_id);

						///////////////////////////////////////////////////////////
						//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
						$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($key_risk_indicator->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
						$monthlyReport = array();
						foreach ($key_risk_indicator_threshold_value as $rowValue) {
							$monthlyReport[$keyArray2] = $rowValue;
						}
						
						//get value threshold value (average/month)
						$January 	= number_format((float)$monthlyReport[$keyArray2]->January, 2, '.', '');  
						$February 	= number_format((float)$monthlyReport[$keyArray2]->February, 2, '.', ''); 
						$March 		= number_format((float)$monthlyReport[$keyArray2]->March, 2, '.', ''); 
						$April 		= number_format((float)$monthlyReport[$keyArray2]->April, 2, '.', ''); 
						$May 		= number_format((float)$monthlyReport[$keyArray2]->May, 2, '.', ''); 
						$June 		= number_format((float)$monthlyReport[$keyArray2]->June, 2, '.', ''); 
						$July 		= number_format((float)$monthlyReport[$keyArray2]->July, 2, '.', ''); 
						$August 	= number_format((float)$monthlyReport[$keyArray2]->August, 2, '.', ''); 
						$September 	= number_format((float)$monthlyReport[$keyArray2]->September, 2, '.', ''); 
						$October 	= number_format((float)$monthlyReport[$keyArray2]->October, 2, '.', ''); 
						$November 	= number_format((float)$monthlyReport[$keyArray2]->November, 2, '.', ''); 
						$December 	= number_format((float)$monthlyReport[$keyArray2]->December, 2, '.', '');

						//get key_risk_indicator_threshold
						//var_dump($key_risk_indicator_threshold->nilai_awal);
						//var_dump($key_risk_indicator_threshold->simbol);
						//var_dump($key_risk_indicator_threshold->nilai_akhir);

						if ((($January < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJanuary 		= $January;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $January) && ($January <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $January) && ($January >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= $January;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($January > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= $January;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						}

						if ((($February < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableFebruary 	= $February;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $February) && ($February <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $February) && ($February >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= $February;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($February > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= $February;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($March < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMarch 		= $March;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $March) && ($March <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $March) && ($March >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= $March;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($March > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= $March;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($April < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableApril 		= $April;
							$tolerableApril 		= 0;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $April) && ($April <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $April) && ($April >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= $April;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($April > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= 0;
							$unacceptableApril 		= $April;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($May < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMay 			= $May;
							$tolerableMay 			= 0;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $May) && ($May <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $May) && ($May >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= $May;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($May > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= 0;
							$unacceptableMay 		= $May;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($June < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptablejune 		= $June;
							$tolerableJune 			= 0;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $June) && ($June <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $June) && ($June >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= $June;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($June > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= 0;
							$unacceptableJune 		= $June;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($July < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJuly 		= $July;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $July) && ($July <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $July) && ($July >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= $July;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($July > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= $July;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($August < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableAugust 		= $August;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $August) && ($August <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $August) && ($August >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= $August;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($August > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= $August;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($September < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableSeptember 	= $September;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $September) && ($September <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $September) && ($September >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= $September;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($September > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= $September;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($October < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableOctober 		= $October;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $October) && ($October <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $October) && ($October >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= $October;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($October > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= $October;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($November < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableNovember 	= $November;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $November) && ($November <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $November) && ($November >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= $November;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($November > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= $November;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($December < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableDecember 	= $December;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $December) && ($December <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $December) && ($December >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= $December;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($December > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= $December;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						//Array Temporary
						$arrTemp2[$keyArray2] = [
							'acceptable' => "['$acceptableJanuary', '$acceptableFebruary', '$acceptableMarch', '$acceptableApril', '$acceptableMay', '$acceptableJune', '$acceptableJuly', '$acceptableAugust', '$acceptableSeptember', '$acceptableOctober', '$acceptableNovember', '$acceptableDecember']", 
							'tolerable' => "['$tolerableJanuary', '$tolerableFebruary', '$tolerableMarch', '$tolerableApril', '$tolerableMay', '$tolerableJune', '$tolerableJuly', '$tolerableAugust', '$tolerableSeptember', '$tolerableOctober', '$tolerableNovember', '$tolerableDecember']",
							'unacceptable' => "['$unacceptableJanuary', '$unacceptableFebruary', '$unacceptableMarch', '$unacceptableApril', '$unacceptableMay', '$unacceptableJune', '$unacceptableJuly', '$unacceptableAugust', '$unacceptableSeptember', '$unacceptableOctober', '$unacceptableNovember', '$unacceptableDecember']"
						];
						//var_dump($arrTemp2);
						
						///////////////////////////////////////////////////////////

					?>
					<div class="col-md-4">
						<div class="portlet light">
							<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
								<a class="dashboard-stat grey-salsa" href="#">
									<div class="visual">
										<i class="fa fa-file-o"></i>
									</div>
									<div class="details">
										<div class="number">
											<?php echo 'Deskripsi KRI-' . $i++?>
										</div>
										<div class="desc">
											<?php echo $key_risk_indicator_threshold->name; ?>
										</div>
									</div>
								</a>
							</div>
							<div class="portlet-body" style="text-align:center;width: 75px;margin: 0 auto;">
								<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
									<!-- traffic light -->
									<div hidden id="controlPanel<?php echo $keyArray2; ?>">
										<h1 id="stopButton<?php echo $keyArray2; ?>" class="button<?php echo $keyArray2; ?>">Stop</h1>
										<h1 id="slowButton<?php echo $keyArray2; ?>" class="button<?php echo $keyArray2; ?>">Slow</h1>
										<h1 id="goButton<?php echo $keyArray2; ?>" class="button<?php echo $keyArray2; ?>">Go</h1>
									</div>
									<div id="traffic-light<?php echo $keyArray2; ?>">
										<div id="stopLight<?php echo $keyArray2; ?>" class="bulb<?php echo $keyArray2; ?>" style="background-color:<?php echo $red; ?>;"></div>
										<div id="slowLight<?php echo $keyArray2; ?>" class="bulb<?php echo $keyArray2; ?>" style="background-color:<?php echo $yellow; ?>;"></div>
										<div id="goLight<?php echo $keyArray2; ?>" class="bulb<?php echo $keyArray2; ?>" style="background-color:<?php echo $green; ?>;"></div>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
									<!-- chart -->
									<canvas id="myChart<?php echo $keyArray2; ?>"></canvas>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php //endforeach; ?>

<!-- ====================================================== Traffic Ligh and Chart array[2] ====================================================== -->
<?php
		//$no = 1;
		//foreach ($rows as $row):
			//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
			//$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($row->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
			
			$risk_item = $this->risk_item_model->get_by_id($rows[2]->RISK_ITEM_ID);

			$key_risk_indicators = $this->key_risk_indicator_model->get_kri($rows[2]->RISK_ITEM_ID, $_GET['tahun']);
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="portlet light" style="height: 900px;">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase"><?php echo /* $no++ .  */"3."; ?></span>
							<span class="caption-helper"><?php echo 'RR: ' . $risk_item->name; ?></span>
						</div>
					</div>
					<?php
					$i = 1;
					$ii = 1;
					foreach ($key_risk_indicators as $key3 => $key_risk_indicator):
						$keyArray3 = $key3+7;
						$key_risk_indicator_threshold = $this->key_risk_indicator_threshold_model->get_by_id($key_risk_indicator->key_risk_indicator_threshold_id);

						///////////////////////////////////////////////////////////
						//get data key_risk_indicator_threshold_value by KEY_RISK_INDICATOR_ID
						$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data_dashboard($key_risk_indicator->KEY_RISK_INDICATOR_ID, $_GET['tahun']);
						$monthlyReport = array();
						foreach ($key_risk_indicator_threshold_value as $rowValue) {
							$monthlyReport[$keyArray3] = $rowValue;
						}
						
						//get value threshold value (average/month)
						$January 	= number_format((float)$monthlyReport[$keyArray3]->January, 2, '.', '');  
						$February 	= number_format((float)$monthlyReport[$keyArray3]->February, 2, '.', ''); 
						$March 		= number_format((float)$monthlyReport[$keyArray3]->March, 2, '.', ''); 
						$April 		= number_format((float)$monthlyReport[$keyArray3]->April, 2, '.', ''); 
						$May 		= number_format((float)$monthlyReport[$keyArray3]->May, 2, '.', ''); 
						$June 		= number_format((float)$monthlyReport[$keyArray3]->June, 2, '.', ''); 
						$July 		= number_format((float)$monthlyReport[$keyArray3]->July, 2, '.', ''); 
						$August 	= number_format((float)$monthlyReport[$keyArray3]->August, 2, '.', ''); 
						$September 	= number_format((float)$monthlyReport[$keyArray3]->September, 2, '.', ''); 
						$October 	= number_format((float)$monthlyReport[$keyArray3]->October, 2, '.', ''); 
						$November 	= number_format((float)$monthlyReport[$keyArray3]->November, 2, '.', ''); 
						$December 	= number_format((float)$monthlyReport[$keyArray3]->December, 2, '.', '');

						//get key_risk_indicator_threshold
						//var_dump($key_risk_indicator_threshold->nilai_awal);
						//var_dump($key_risk_indicator_threshold->simbol);
						//var_dump($key_risk_indicator_threshold->nilai_akhir);

						if ((($January < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJanuary 		= $January;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $January) && ($January <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $January) && ($January >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= $January;
							$unacceptableJanuary 	= 0;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($January > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($January < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJanuary 		= 0;
							$tolerableJanuary 		= 0;
							$unacceptableJanuary 	= $January;
							if ((date('m') == 1)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						}

						if ((($February < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableFebruary 	= $February;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $February) && ($February <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $February) && ($February >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= $February;
							$unacceptableFebruary 	= 0;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($February > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($February < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableFebruary 	= 0;
							$tolerableFebruary 		= 0;
							$unacceptableFebruary 	= $February;
							if ((date('m') == 2)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($March < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMarch 		= $March;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $March) && ($March <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $March) && ($March >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= $March;
							$unacceptableMarch 		= 0;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($March > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($March < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMarch 		= 0;
							$tolerableMarch 		= 0;
							$unacceptableMarch 		= $March;
							if ((date('m') == 3)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($April < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableApril 		= $April;
							$tolerableApril 		= 0;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $April) && ($April <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $April) && ($April >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= $April;
							$unacceptableApril 		= 0;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($April > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($April < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableApril 		= 0;
							$tolerableApril 		= 0;
							$unacceptableApril 		= $April;
							if ((date('m') == 4)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($May < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableMay 			= $May;
							$tolerableMay 			= 0;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $May) && ($May <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $May) && ($May >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= $May;
							$unacceptableMay 		= 0;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($May > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($May < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableMay 			= 0;
							$tolerableMay 			= 0;
							$unacceptableMay 		= $May;
							if ((date('m') == 5)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($June < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptablejune 		= $June;
							$tolerableJune 			= 0;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $June) && ($June <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $June) && ($June >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= $June;
							$unacceptableJune 		= 0;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($June > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($June < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptablejune 		= 0;
							$tolerableJune 			= 0;
							$unacceptableJune 		= $June;
							if ((date('m') == 6)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($July < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableJuly 		= $July;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $July) && ($July <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $July) && ($July >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= $July;
							$unacceptableJuly 		= 0;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($July > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($July < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableJuly 		= 0;
							$tolerableJuly 			= 0;
							$unacceptableJuly 		= $July;
							if ((date('m') == 7)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($August < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableAugust 		= $August;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $August) && ($August <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $August) && ($August >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= $August;
							$unacceptableAugust 	= 0;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($August > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($August < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableAugust 		= 0;
							$tolerableAugust 		= 0;
							$unacceptableAugust 	= $August;
							if ((date('m') == 8)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($September < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableSeptember 	= $September;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $September) && ($September <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $September) && ($September >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= $September;
							$unacceptableSeptember 	= 0;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($September > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($September < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableSeptember 	= 0;
							$tolerableSeptember 	= 0;
							$unacceptableSeptember 	= $September;
							if ((date('m') == 9)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($October < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableOctober 		= $October;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $October) && ($October <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $October) && ($October >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= $October;
							$unacceptableOctober 	= 0;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($October > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($October < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableOctober 		= 0;
							$tolerableOctober 		= 0;
							$unacceptableOctober 	= $October;
							if ((date('m') == 10)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($November < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableNovember 	= $November;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $November) && ($November <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $November) && ($November >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= $November;
							$unacceptableNovember 	= 0;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($November > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($November < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableNovember 	= 0;
							$tolerableNovember 		= 0;
							$unacceptableNovember 	= $November;
							if ((date('m') == 11)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						if ((($December < $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December > $key_risk_indicator_threshold->nilai_awal) && ($key_risk_indicator_threshold->simbol == "&gt;"))) { 
							$acceptableDecember 	= $December;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#51D14F';
							$yellow = '#808080';
							$red 	= '#808080'; }
						} else if ((($key_risk_indicator_threshold->nilai_awal <= $December) && ($December <= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($key_risk_indicator_threshold->nilai_awal >= $December) && ($December >= $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= $December;
							$unacceptableDecember 	= 0;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#FFFF00';
							$red 	= '#808080'; }
						} else if ((($December > $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&lt;")) || (($December < $key_risk_indicator_threshold->nilai_akhir) && ($key_risk_indicator_threshold->simbol == "&gt;"))) {
							$acceptableDecember 	= 0;
							$tolerableDecember 		= 0;
							$unacceptableDecember 	= $December;
							if ((date('m') == 12)) {
							$green 	= '#808080';
							$yellow = '#808080';
							$red 	= '#FE0000'; }
						} 

						//Array Temporary
						$arrTemp3[$keyArray3] = [
							'acceptable' => "['$acceptableJanuary', '$acceptableFebruary', '$acceptableMarch', '$acceptableApril', '$acceptableMay', '$acceptableJune', '$acceptableJuly', '$acceptableAugust', '$acceptableSeptember', '$acceptableOctober', '$acceptableNovember', '$acceptableDecember']", 
							'tolerable' => "['$tolerableJanuary', '$tolerableFebruary', '$tolerableMarch', '$tolerableApril', '$tolerableMay', '$tolerableJune', '$tolerableJuly', '$tolerableAugust', '$tolerableSeptember', '$tolerableOctober', '$tolerableNovember', '$tolerableDecember']",
							'unacceptable' => "['$unacceptableJanuary', '$unacceptableFebruary', '$unacceptableMarch', '$unacceptableApril', '$unacceptableMay', '$unacceptableJune', '$unacceptableJuly', '$unacceptableAugust', '$unacceptableSeptember', '$unacceptableOctober', '$unacceptableNovember', '$unacceptableDecember']"
						];
						//var_dump($arrTemp3);
						
						///////////////////////////////////////////////////////////

					?>
					<div class="col-md-4">
						<div class="portlet light">
							<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
								<a class="dashboard-stat grey-salsa" href="#">
									<div class="visual">
										<i class="fa fa-file-o"></i>
									</div>
									<div class="details">
										<div class="number">
											<?php echo 'Deskripsi KRI-' . $i++?>
										</div>
										<div class="desc">
											<?php echo $key_risk_indicator_threshold->name; ?>
										</div>
									</div>
								</a>
							</div>
							<div class="portlet-body" style="text-align:center;width: 75px;margin: 0 auto;">
								<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
									<!-- traffic light -->
									<div hidden id="controlPanel<?php echo $keyArray3; ?>">
										<h1 id="stopButton<?php echo $keyArray3; ?>" class="button<?php echo $keyArray3; ?>">Stop</h1>
										<h1 id="slowButton<?php echo $keyArray3; ?>" class="button<?php echo $keyArray3; ?>">Slow</h1>
										<h1 id="goButton<?php echo $keyArray3; ?>" class="button<?php echo $keyArray3; ?>">Go</h1>
									</div>
									<div id="traffic-light<?php echo $keyArray3; ?>">
										<div id="stopLight<?php echo $keyArray3; ?>" class="bulb<?php echo $keyArray3; ?>" style="background-color:<?php echo $red; ?>;"></div>
										<div id="slowLight<?php echo $keyArray3; ?>" class="bulb<?php echo $keyArray3; ?>" style="background-color:<?php echo $yellow; ?>;"></div>
										<div id="goLight<?php echo $keyArray3; ?>" class="bulb<?php echo $keyArray3; ?>" style="background-color:<?php echo $green; ?>;"></div>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
									<!-- chart -->
									<canvas id="myChart<?php echo $keyArray3; ?>"></canvas>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php //endforeach; ?>

		<!-- <div class="row">
			<div class="col-md-4">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase">KRI Chart</span>
							<span class="caption-helper">indicator summary</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
							//traffic light
							<div id="controlPanel1">
								<h1 id="stopButton1" class="button1">Stop</h1>
								<h1 id="slowButton1" class="button1">Slow</h1>
								<h1 id="goButton1" class="button1">Go</h1>
							</div>
							<div id="traffic-light1">
								<div id="stopLight1" class="bulb1"></div>
								<div id="slowLight1" class="bulb1"></div>
								<div id="goLight1" class="bulb1"></div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
							//chart
							<canvas id="myChart1"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase">KRI Chart</span>
							<span class="caption-helper">indicator summary</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
							//traffic light
							<div id="controlPanel2">
								<h1 id="stopButton2" class="button2">Stop</h1>
								<h1 id="slowButton2" class="button2">Slow</h1>
								<h1 id="goButton2" class="button2">Go</h1>
							</div>
							<div id="traffic-light2">
								<div id="stopLight2" class="bulb2"></div>
								<div id="slowLight2" class="bulb2"></div>
								<div id="goLight2" class="bulb2"></div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
							//chart
							<canvas id="myChart2"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-blue-steel hide"></i>
							<span class="caption-subject font-blue-steel bold uppercase">KRI Chart</span>
							<span class="caption-helper">indicator summary</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 275px;" data-always-visible="1" data-rail-visible="0">
							//traffic light
							<div id="controlPanel3">
								<h1 id="stopButton3" class="button3">Stop</h1>
								<h1 id="slowButton3" class="button3">Slow</h1>
								<h1 id="goButton3" class="button3">Go</h1>
							</div>
							<div id="traffic-light3">
								<div id="stopLight3" class="bulb3"></div>
								<div id="slowLight3" class="bulb3"></div>
								<div id="goLight3" class="bulb3"></div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
							//chart
							<canvas id="myChart3"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div> -->

	</div>
	
</div>
<?php }?>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}

	/* begin css traffic light */
	#controlPanel1 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button1 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light1 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb1 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel2 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button2 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light2 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb2 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel3 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button3 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light3 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb3 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel4 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button4 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light4 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb4 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel5 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button5 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light5 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb5 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel6 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button6 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light6 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb6 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel7 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button7 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light7 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb7 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel8 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button8 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light8 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb8 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}

	/* ////////////////////////////////////////////////////// */

	#controlPanel9 {
		float: left;
		padding-top: 45px;
		padding-left:45%;
	}

	.button9 {
		background: #e2e2e2; /* Old browsers */
		background: -moz-linear-gradient(top, #e2e2e2 0%, #dbdbdb 50%, #d1d1d1 51%, #fefefe 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, #e2e2e2 0%,#dbdbdb 50%,#d1d1d1 51%,#fefefe 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
		color: black;
		border-radius: 25px;
		border-style: solid;
		padding: 20px;
		text-align: center;
		margin: 90px 40px;
		cursor: pointer;
	}

	#traffic-light9 {
		height: 200px;
		width: 60px;
		float: left;
		background-color:#5B5B5B;
		border-radius: 40px;
		border-style: solid;
		border-color: #836953;
		margin: 30px 0;
		padding: 20px;
	}
	/* Added a border style to highlight the bulb edge*/
	.bulb9 {
		height: 45px;
		width: 45px;
		background-color: #111;
		border-radius: 50%;
		border-style: solid;
		border-color: #836953;
		margin: 5px -15px;
		transition: background 500ms;
	}
	/* end css traffic light */
</style>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {       
		$("#tahun_laporan_select").on('change', function(){
			var url = "<?php echo site_url('welcome/index_kri').'?tahun='; ?>"+$(this).val();
			window.location.replace(url);
		});
	});

	/* begin traffic light */
	/* document.getElementById('stopLight1').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight1').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight1').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton1').onclick = illuminateRed1;
	document.getElementById('slowButton1').onclick = illuminateYellow1;
	document.getElementById('goButton1').onclick = illuminateGreen1;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed1() {
		clearLights1();
		document.getElementById('stopLight1').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow1() {
		clearLights1();
		document.getElementById('slowLight1').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen1() {
		clearLights1();
		document.getElementById('goLight1').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights1() {
		document.getElementById('stopLight1').style.backgroundColor = "grey";
		document.getElementById('slowLight1').style.backgroundColor = "grey";
		document.getElementById('goLight1').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight2').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight2').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight2').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton2').onclick = illuminateRed2;
	document.getElementById('slowButton2').onclick = illuminateYellow2;
	document.getElementById('goButton2').onclick = illuminateGreen2;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed2() {
		clearLights2();
		document.getElementById('stopLight2').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow2() {
		clearLights2();
		document.getElementById('slowLight2').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen2() {
		clearLights2();
		document.getElementById('goLight2').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights2() {
		document.getElementById('stopLight2').style.backgroundColor = "grey";
		document.getElementById('slowLight2').style.backgroundColor = "grey";
		document.getElementById('goLight2').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight3').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight3').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight3').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton3').onclick = illuminateRed3;
	document.getElementById('slowButton3').onclick = illuminateYellow3;
	document.getElementById('goButton3').onclick = illuminateGreen3;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed3() {
		clearLights3();
		document.getElementById('stopLight3').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow3() {
		clearLights3();
		document.getElementById('slowLight3').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen3() {
		clearLights3();
		document.getElementById('goLight3').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights3() {
		document.getElementById('stopLight3').style.backgroundColor = "grey";
		document.getElementById('slowLight3').style.backgroundColor = "grey";
		document.getElementById('goLight3').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight4').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight4').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight4').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton4').onclick = illuminateRed4;
	document.getElementById('slowButton4').onclick = illuminateYellow4;
	document.getElementById('goButton4').onclick = illuminateGreen4;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed4() {
		clearLights4();
		document.getElementById('stopLight4').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow4() {
		clearLights4();
		document.getElementById('slowLight4').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen4() {
		clearLights4();
		document.getElementById('goLight4').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights4() {
		document.getElementById('stopLight4').style.backgroundColor = "grey";
		document.getElementById('slowLight4').style.backgroundColor = "grey";
		document.getElementById('goLight4').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight5').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight5').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight5').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton5').onclick = illuminateRed5;
	document.getElementById('slowButton5').onclick = illuminateYellow5;
	document.getElementById('goButton5').onclick = illuminateGreen5;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed5() {
		clearLights5();
		document.getElementById('stopLight5').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow5() {
		clearLights5();
		document.getElementById('slowLight5').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen5() {
		clearLights5();
		document.getElementById('goLight5').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights5() {
		document.getElementById('stopLight5').style.backgroundColor = "grey";
		document.getElementById('slowLight5').style.backgroundColor = "grey";
		document.getElementById('goLight5').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight6').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight6').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight6').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton6').onclick = illuminateRed6;
	document.getElementById('slowButton6').onclick = illuminateYellow6;
	document.getElementById('goButton6').onclick = illuminateGreen6;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed6() {
		clearLights6();
		document.getElementById('stopLight6').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow6() {
		clearLights6();
		document.getElementById('slowLight6').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen6() {
		clearLights6();
		document.getElementById('goLight6').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights6() {
		document.getElementById('stopLight6').style.backgroundColor = "grey";
		document.getElementById('slowLight6').style.backgroundColor = "grey";
		document.getElementById('goLight6').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight7').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight7').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight7').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton7').onclick = illuminateRed7;
	document.getElementById('slowButton7').onclick = illuminateYellow7;
	document.getElementById('goButton7').onclick = illuminateGreen7;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed7() {
		clearLights7();
		document.getElementById('stopLight7').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow7() {
		clearLights7();
		document.getElementById('slowLight7').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen7() {
		clearLights7();
		document.getElementById('goLight7').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights7() {
		document.getElementById('stopLight7').style.backgroundColor = "grey";
		document.getElementById('slowLight7').style.backgroundColor = "grey";
		document.getElementById('goLight7').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight8').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight8').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight8').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton8').onclick = illuminateRed8;
	document.getElementById('slowButton8').onclick = illuminateYellow8;
	document.getElementById('goButton8').onclick = illuminateGreen8;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed8() {
		clearLights8();
		document.getElementById('stopLight8').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow8() {
		clearLights8();
		document.getElementById('slowLight8').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen8() {
		clearLights8();
		document.getElementById('goLight8').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights8() {
		document.getElementById('stopLight8').style.backgroundColor = "grey";
		document.getElementById('slowLight8').style.backgroundColor = "grey";
		document.getElementById('goLight8').style.backgroundColor = "grey";
	} */

	///////////////////////////////////////////////////////////////////////

	/* document.getElementById('stopLight9').style.backgroundColor = "#FE0000";
	document.getElementById('slowLight9').style.backgroundColor = "#FFFF00";
	document.getElementById('goLight9').style.backgroundColor = "#51D14F";
	document.getElementById('stopButton9').onclick = illuminateRed9;
	document.getElementById('slowButton9').onclick = illuminateYellow9;
	document.getElementById('goButton9').onclick = illuminateGreen9;

	// added a new line of code for the final button 
	//red light button function 
	function illuminateRed9() {
		clearLights9();
		document.getElementById('stopLight9').style.backgroundColor = "#FE0000";
	}

	//yellow light button function
	function illuminateYellow9() {
		clearLights9();
		document.getElementById('slowLight9').style.backgroundColor = "#FFFF00";
	}

	//green light button function
	function illuminateGreen9() {
		clearLights9();
		document.getElementById('goLight9').style.backgroundColor = "#51D14F";
	}

	//this function will run after another button is pressed changing the original light back to black
	function clearLights9() {
		document.getElementById('stopLight9').style.backgroundColor = "grey";
		document.getElementById('slowLight9').style.backgroundColor = "grey";
		document.getElementById('goLight9').style.backgroundColor = "grey";
	} */
	/* end traffic light */
</script>

<!-- Resources -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>
	/* begin chart */
	var ctx = document.getElementById("myChart1").getContext('2d');

	var myChart1 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp1[1]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp1[1]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp1[1]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart2").getContext('2d');

	var myChart2 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp1[2]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp1[2]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp1[2]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart3").getContext('2d');

	var myChart3 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp1[3]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp1[3]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp1[3]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart4").getContext('2d');

	var myChart4 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp2[4]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp2[4]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp2[4]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart5").getContext('2d');

	var myChart5 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp2[5]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp2[5]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp2[5]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart6").getContext('2d');

	var myChart6 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp2[6]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp2[6]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp2[6]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart7").getContext('2d');

	var myChart7 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp3[7]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp3[7]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp3[7]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart8").getContext('2d');

	var myChart8 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp3[8]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp3[8]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp3[8]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});

	///////////////////////////////////////////////////////////////////////

	var ctx = document.getElementById("myChart9").getContext('2d');

	var myChart9 = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DES"],
			datasets: [{
				label: 'Acceptable', // Name the series
				data: <?php echo $arrTemp3[9]['acceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#51D14F', // Add custom color border (Line)
				backgroundColor: '#51D14F', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Tolerable', // Name the series
				data: <?php echo $arrTemp3[9]['tolerable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FFFF00', // Add custom color border (Line)
				backgroundColor: '#FFFF00', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			},
			{
				label: 'Unacceptable', // Name the series
				data: <?php echo $arrTemp3[9]['unacceptable']; ?>, // Specify the data values array
				fill: false,
				borderColor: '#FE0000', // Add custom color border (Line)
				backgroundColor: '#FE0000', // Add custom color background (Points and Fill)
				borderWidth: 1 // Specify bar border width
			}]
		},
		options: {
		responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		}
	});
	/* end chart */
</script>
<!-- END JAVASCRIPTS -->
