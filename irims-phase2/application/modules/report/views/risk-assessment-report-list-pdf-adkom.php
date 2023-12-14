<style type="text/css">
.table th, .table td {
   border: 1px solid black;
   vertical-align: top;
   font-size: 16px;
}
</style>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Progress
</h3>
<div class="row margin-bottom-20">
	<div class="col-md-12">
		<p align="center">
			<font size="5"><b>TINGKAT PENGENDALIAN RISIKO</b></font> <br>
			<font size="4"><b><?php echo !empty($risk_category_report) ? strtoupper($risk_category_report->description) : 'SEMUA KATEGORI'; ?></b></font> <br>
			<font size="4"><b><?php echo !empty($unit_report) ? strtoupper($unit_report->name) : 'SEMUA CABANG'; ?></b></font> <br>
			<font size="4"><b>TAHUN <?php echo strtoupper($tahun);?></b></font>
		</p>
	</div>
</div>
<?php if($search){?>
<div class="portlet box red">
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="hidden-xs" rowspan="2">NO</th>
						<th class="hidden-xs" rowspan="2">RISK REGISTER</th>
						<th class="hidden-xs" rowspan="2">PERISTIWA RISIKO</th>
						<th class="hidden-xs" rowspan="2">PENYEBAB</th>
						<th class="hidden-xs" rowspan="2">DAMPAK</th>
						<th class="hidden-xs" colspan="2">LEVEL</th>
						<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
						<th class="hidden-xs" colspan="2">LEVEL</th>
						<th class="hidden-xs" colspan="2">LEVEL</th>
						<th class="hidden-xs" colspan="2">RENCANA PERLAKUAN RISIKO</th>
						<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
						<th class="hidden-xs" rowspan="2">TARGET WAKTU</th>
						<?php if($status=="Y"):?>
						<th class="hidden-xs" rowspan="2">REALISASI MITIGASI</th>
						<th class="hidden-xs" colspan="2">LEVEL</th>
						<th class="hidden-xs" colspan="2">LEVEL</th>
						<?php endif;?>
						<th class="hidden-xs" rowspan="2">JUMLAH RISIKO TER IDENTIFIKASI</th>
						<th class="hidden-xs" rowspan="2">JUMLAH RISIKO TERMITIGASI</th>
						<th class="hidden-xs" rowspan="2">PIC (KANTOR PUSAT)</th>
						<th class="hidden-xs" rowspan="2">KATEGORI RISK</th>
						<th class="hidden-xs" rowspan="2">KATEGORI</th>
					</tr>

					<tr>
						<th class="hidden-xs">K</th>
						<th class="hidden-xs">D</th>
						<th class="hidden-xs">K</th>
						<th class="hidden-xs">D</th>
						<th class="hidden-xs">K</th>
						<th class="hidden-xs">D</th>
						<th class="hidden-xs">KEMUNGKINAN</th>
						<th class="hidden-xs">DAMPAK</th>
						<?php if($status=="Y"):?>
						<th class="hidden-xs">K</th>
						<th class="hidden-xs">D</th>
						<th class="hidden-xs">K</th>
						<th class="hidden-xs">D</th>
						<?php endif;?>
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
						<tr>
							<td><?php echo $no++; ?></td>
							<?php if($temp==1){?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:top !important"><?php echo $risk_item->name; ?></td>
							<?php } ?>
							<td><a href="<?php echo site_url('report/risk_assessment_report/view/' . $d->RISK_IDENTIFICATION_ID .'/1'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
							<td><?php echo $d->PENYEBAB?></td>
							<td><?php echo $d->DAMPAK?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->INHERENT_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->INHERENT_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<?php 
								if($temp==1){
									$risk_rank_inherent = explode(",", $row['nilai_perlakuan']);
							?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:top !important"><?php echo $risk_rank_inherent[0]; ?></td>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:top !important"><?php echo $risk_rank_inherent[1]; ?></td>
							<?php }?>
							<td>
								<?php
									if($mitigation){
										//echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											// echo "<li>".$mitigation[$i]->RENCANA_PENGENDALIAN."</li>";
											echo $mitigation[$i]->RENCANA_PENGENDALIAN;
										}
										//echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
							<td>
								<?php
									if($mitigation){
										//echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											//echo "<li>".$mitigation[$i]->DAMPAK_RENCANA_PENGENDALIAN."</li>";
											echo $mitigation[$i]->DAMPAK_RENCANA_PENGENDALIAN;
										}
										//echo "</ol>";
									}else{
										//echo "Not Set";
									}
								?>
							</td>
							<td><?php
									if($mitigation){
										//echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											// echo "<li>".$this->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name."</li>";
											echo $this->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name;
										}
										//echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
							<td>
								<?php
									if($mitigation){
										//echo "<ol>";
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											// echo "<li>".$mitigation[$i]->TARGET_WAKTU."</li>";
											echo $mitigation[$i]->TARGET_WAKTU;
										}
										//echo "</ol>";
									}else{
										echo "Not Set";
									}
								?>
							</td>
							<td><?php echo $d->TERIDENTIFIKASI;?></td>
							<td><?php echo $d->TERMITIGASI;?></td>
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
							<?php if($temp==1){?>
							<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->description; ?></td>
							<?php $temp++;}?>
							<td>
								<?php
									$category_risk = $this->risk_category_model->get_by_id($d->RISK_CATEGORY_ID)->name;
									echo $category_risk;
								?>
							</td>
						</tr>
						<?php 
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
						<!-- <tr>
							<td colspan="21" align="center"><b>JUMLAH</b></td>
							<td><b><?php echo $teridentifikasi?></b></td>
							<td><b><?php echo $termitigasi?></b></td>
							<td colspan="3">&nbsp;</td>
						</tr> -->
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
