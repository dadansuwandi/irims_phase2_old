<style type="text/css">
.table th, .table td {
   border: 1px solid black;
   vertical-align: top;
}
</style>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Register Card Detail
</h3>
<!-- END PAGE HEADER-->
<div class="portlet box red">
	<!-- <div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Register Card Detail
		</div>
	</div> -->
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
				<!-- <thead>
					<tr>
						<th class="hidden-xs">NO</th>
						<th class="hidden-xs">KODE BANDARA</th>
						<th class="hidden-xs">HAZARD</th>
						<th class="hidden-xs">PENYEBAB</th>
						<th class="hidden-xs">DAMPAK</th>
						<th class="hidden-xs">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
						<th class="hidden-xs">RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</th>
						<th class="hidden-xs">REALISASI MITIGASI</th>
					</tr>
				</thead> -->
				<tbody>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs" rowspan="4" colspan="3"><b><i><?php echo !empty($risk_report) ? strtoupper($risk_report->name) : 'SEMUA KATEGORI'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>RISK REGISTER</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_register_report) ? strtoupper($risk_register_report->name) : 'SEMUA REGISTER'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>NO RISK RADAR</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_register_no_report) ? strtoupper($risk_register_no_report) : 'SEMUA REGISTER NUMBER'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>LEVEL RISIKO</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_level_report) ? strtoupper($risk_level_report) : 'SEMUA LEVEL'; ?></i></b></td>
					</tr
					<tr>
						<td style="background-color:#0080ff" class="hidden-xs"><b>N0</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>KODE BANDARA</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>HAZARD</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>PENYEBAB</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>DAMPAK</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>PENGENDALIAN YANG SUDAH DILAKUKAN</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>REALISASI MITIGASI</b></td>
					</tr>
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
								$unit = $this->risk_model->get_by_unit_report($d->UNIT_ID);
								$mitigation = $this->risk_mitigation_model->get_data($d->RISK_IDENTIFICATION_ID);
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $unit->code?></td>
							<td><a href="<?php echo site_url('report/risk_assessment_report/view/' . $d->RISK_IDENTIFICATION_ID .'/1'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
							<td><?php echo $d->PENYEBAB?></td>
							<td><?php echo $d->DAMPAK?></td>
							<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
							<td>
								<?php
									if($mitigation){
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											echo $mitigation[$i]->RENCANA_PENGENDALIAN;
										}
									}else{
										echo "Not Set";
									}
								?>
							</td>
							<td>
								<?php
									if($mitigation){
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											if($mitigation[$i]->REALISASI_MITIGASI!=""){
												echo $mitigation[$i]->REALISASI_MITIGASI;
											}
										}
									}else{
										echo "Not Set";
									}
								?>
							</td>
						</tr>
						<?php 
							}
						?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>
