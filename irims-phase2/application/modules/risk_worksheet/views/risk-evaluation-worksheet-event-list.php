<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Approval
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Approval</a>
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
					<i class="fa fa-list"></i>Risk Approval
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
							<th class="hidden-xs" rowspan="2">KATEGORI RISK</th>
							<th class="hidden-xs" rowspan="2">DESKRIPSI</th>
						</tr>

						<tr>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
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
								<td><a class="btn btn-block <?php echo $this->status_dokumen_model->get_by_id($row->STATUS_DOKUMEN_ID)->CSS_CLASS;?>" href="<?php echo site_url('risk_worksheet/risk_evaluation_worksheet/view/' . $row->RISK_IDENTIFICATION_ID); ?>"><?php echo $this->status_dokumen_model->get_by_id($row->STATUS_DOKUMEN_ID)->STATUS_DOKUMEN_NAMA; ; ?></a></td>
								<td><?php echo $this->unit_model->get_by_id($row->UNIT_ID)->name;?></a></td>
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
								<td><?php echo $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $row->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
								<td>
									<?php
										$kategori_risk = $this->risk_category_model->get_by_id($row->RISK_CATEGORY_ID);
										if ($kategori_risk)
											echo $kategori_risk->name;
										else
											echo 'Not Set';
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
