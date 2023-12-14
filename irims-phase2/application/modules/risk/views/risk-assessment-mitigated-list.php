<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Review
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Review</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-list"></i>Risk Review
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<!--
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button class="btn yellow dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								Tools <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-pdf-o"></i>
										Save as PDF </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-excel-o"></i>
										Export to Excel </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-text-o"></i>
										Export to CSV </a>
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-file-code-o"></i>
										Export to XML </a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="javascript:;">
										<i class="fa fa-print"></i>
										Print </a>
									</li>
								</ul>
							</div>
						</div>
						-->
					</div>
				</div>
				<div class="overFlowTable">
				<table class="table table-striped table-bordered table-hover" id="sample_6">
					<thead>
						<tr>
							<th class="hidden-xs" rowspan="2">NO</th>
							<th class="hidden-xs" rowspan="2">STATUS</th>
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
							<th class="hidden-xs" colspan="2">RENCANA JADWAL PENANGANAN RISIKO</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
							<th class="hidden-xs" rowspan="2">TANGGAL REGISTER</th>
							<th class="hidden-xs" rowspan="2">WAKTU PELAKSANAAN</th>
							<th class="hidden-xs" rowspan="2">REALISASI MITIGASI</th>
							<th class="hidden-xs" colspan="3">NILAI ACTUAL RISK</th>
							<th class="hidden-xs" rowspan="2">TRENDS</th>
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
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K x D</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($rows as $row):
							$mitigation = $this->risk_mitigation_model->get_data($row->RISK_IDENTIFICATION_ID);
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><a class="btn btn-circle btn-block <?php echo $this->status_dokumen_model->get_by_id($row->STATUS_DOKUMEN_ID)->CSS_CLASS;?>" href="<?php echo site_url('risk/risk_evaluation/view_mitigated/' . $row->RISK_IDENTIFICATION_ID); ?>"><?php echo $this->status_dokumen_model->get_by_id($row->STATUS_DOKUMEN_ID)->STATUS_DOKUMEN_NAMA; ; ?></a></td>
								<td><?php echo $row->OBJECTIVE; ?></td>
								<td>
									<?php
										$risk_item = $this->risk_item_model->get_by_id($row->RISK_ITEM_ID);
										if ($risk_item)
											echo $risk_item->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $row->HAZARD; ?></td>
								<td><?php echo $row->PENYEBAB; ?></td>
								<td><?php echo $row->DAMPAK; ?></td>
								<td>
									<?php
										$risk_category = $this->risk_category_model->get_by_id($row->RISK_CATEGORY_ID);
										if ($risk_category)
											echo $risk_category->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $row->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $row->EXCO_EFFECTIVENESS_VALUE_K_ID;?></td>
								<td><?php echo $row->EXCO_EFFECTIVENESS_VALUE_D_ID;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
								<td><?php echo $this->risk_probability_model->get_by_id($row->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
								<td><?php echo date("d-m-Y", strtotime($row->INSTERTED_TIME)); ?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												if($mitigation[$i]->REALISASI_MITIGASI!=""){
													echo "<li>".date("d-m-Y", strtotime($mitigation[$i]->EXECUTION_TIME))."</li>";
												}
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
												if($mitigation[$i]->REALISASI_MITIGASI!=""){
													echo "<li>".$mitigation[$i]->REALISASI_MITIGASI."</li>";
												}
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID)->rating_value; ?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID)->alphabet; ?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID)->alphabet; ?></td>
								<td>
									<?php 
										/* BEGIN GET TRENDS */
										if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
											/*BEGIN TOP RISK REGISTER*/
											$top_risk   = array();
											$tahun      = date('Y', strtotime('-1 years'));
								
											$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
											->from('tx_risk_identification as tri')
											->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
											->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
											   ->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
											   ->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
											   ->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
											   ->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
											   ->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TAHUN = "'.$tahun.'" AND tri.RISK_ITEM_ID = '.$row->RISK_ITEM_ID)
											   //->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
											->order_by('rangking','asc')
											->get();
								
											if($query->num_rows() > 0){
												foreach($query->result() as $top){
													if($top->status_dokumen != 6){
														if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI){
															if(!array_key_exists($top->risk_item_id, $top_risk)){
																$top_risk[$top->risk_item_id]['data'] = $top;
																$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
															}else{
																if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
																	$top_risk[$top->risk_item_id]['data'] = $top;
																	$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
																}
															}
														}
													}
												}
											}
										   
											//$this->data['top_risk'] = $top_risk;

											if(count($top_risk)>0){
												foreach($top_risk as $risk_item_id=>$val){
													?><img src="<?php echo base_url() ?>assets/img/risk_icon/<?php echo $val['icon']?>" class="" alt=""><?php
											}} else {
												echo "Not Set";
											}

										}
										/* END GET TRENDS */
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	/*jQuery(document).ready(function() {
		TableAdvanced.init();
	});*/
</script>
<!-- END JAVASCRIPTS -->
