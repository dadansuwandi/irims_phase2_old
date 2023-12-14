<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Progress View
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Progress View</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Progress
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
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
						<th class="hidden-xs" rowspan="2">TANGGAL REGISTER</th>
						<th class="hidden-xs" rowspan="2">WAKTU PELAKSANAAN</th>
						<th class="hidden-xs" rowspan="2">REALISASI MITIGASI</th>
						<th class="hidden-xs" colspan="3">NILAI ACTUAL RISK</th>
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
					<?php if(isset($d->RISK_IDENTIFICATION_ID)){
						$mitigation = $this->risk_mitigation_model->get_data($d->RISK_IDENTIFICATION_ID);
					?>
						<tr>
							<td><?php echo $d->OBJECTIVE; ?></td>
							<td>
								<?php
									$risk_item = $this->risk_item_model->get_by_id($d->RISK_ITEM_ID);
									if ($risk_item)
										echo $risk_item->name;
									else
										echo 'Not Set';
								?>
							</td>
							<td><?php echo $d->HAZARD; ?></td>
							<td><?php echo $d->PENYEBAB; ?></td>
							<td><?php echo $d->DAMPAK; ?></td>
							<td>
								<?php
									$risk_category = $this->risk_category_model->get_by_id($d->RISK_CATEGORY_ID);
									if ($risk_category)
										echo $risk_category->name;
									else
										echo 'Not Set';
								?>
							</td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->INHERENT_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->INHERENT_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->INHERENT_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->INHERENT_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
							<td><?php echo $d->EXCO_EFFECTIVENESS_VALUE_K_ID;?></td>
							<td><?php echo $d->EXCO_EFFECTIVENESS_VALUE_D_ID;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
							<td><?php echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
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
							<td><?php echo date("d-m-Y", strtotime($d->INSTERTED_TIME)); ?></td>
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
							<td><?php echo $this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value; ?></td>
							<td><?php echo $this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet; ?></td>
							<td><?php echo $this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet; ?></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php if($type==1){?>
				<a href="<?php echo site_url('risk_report/work_paper_report/index'); ?>" class="btn green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
				<?php }?>

				<?php if($type==2){?>
				<a href="<?php echo site_url('risk_report/work_paper_report/owner'); ?>" class="btn green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
				<?php }?>

				<?php if($type==3){?>
				<a href="<?php echo site_url('risk_report/work_paper_report/gm'); ?>" class="btn green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
				<?php }?>

				<?php if($type==4){?>
				<a href="<?php echo site_url('risk_report/work_paper_report/officer'); ?>" class="btn green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
				<?php }?>

				<?php if($type==5){?>
				<a href="<?php echo site_url('risk_report/work_paper_report/head'); ?>" class="btn green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
				<?php }?>

				<?php if($d->STATUS_DOKUMEN_ID==STATUS_ON_MONITORING && $this->session->userdata('role_id')==GROUP_RISK_ADMIN){?>
				<a href="<?php echo site_url('risk/risk_backdate/edit/' . $d->RISK_IDENTIFICATION_ID); ?>" class="btn blue">UPDATE <i class="fa fa-pencil"></i></a>
				<?php }?>

				<?php if($this->session->userdata('role_id')==GROUP_RISK_ADMIN){?>
				<a href="<?php echo site_url('risk/risk_backdate/delete/' . $d->RISK_IDENTIFICATION_ID); ?>" class="btn red" data-button="delete">DELETE <i class="fa fa-times"></i></a> 
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('delete-modal'); ?>
<!-- BEGIN DOCUMENT FILES-->
<div class="portlet box purple">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-file-code-o"></i>Mitigation Documents
		</div>
	</div>
	<div class="portlet-body">
		<h3>File -file dokumen bahwa telah melakukan mitigasi :</h3>
		<!-- <div class="row margin-bottom-20">
			<?php 
	        //$i = 1;
	        //foreach ($risk_mitigation_files as $risk_mitigation_file) {
	        	//$image = $this->risk_mitigation_file_model->get_icon($risk_mitigation_file->FILE_EXT);
	        ?>
			<div class="fa-item col-md-3 col-sm-4"> -->
				<!--<i class="fa fa-adjust"></i> fa-adjust-->
				<!-- <?php //echo $i.'. '; ?><a href="<?php //echo base_url() . 'uploads/risk_mitigation/' . $risk_mitigation_file->FILE_NAME; ?>" download>
					<?php //echo $image; ?>
				</a><br><font size="1"><?php //echo $risk_mitigation_file->FILE_NAME; ?></font>
			</div>
			 <?php
			 //$i++; 
	    	//} 
	    	?>
		</div> -->
		<div class="overFlowTable">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="hidden-xs" rowspan="2">NO</th>
					<th class="hidden-xs" rowspan="2">VIEW FILE</th>
					<th class="hidden-xs" rowspan="2">FILE NAME</th>
					<th class="hidden-xs" rowspan="2">BRANCH</th>
					<th class="hidden-xs" rowspan="2">UPLOAD BY</th>
					<th class="hidden-xs" rowspan="2">UPLOAD TIME</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				 $i = 1;
		        foreach ($risk_mitigation_files as $risk_mitigation_file) {
		        	$image = $this->risk_mitigation_file_model->get_icon($risk_mitigation_file->FILE_EXT);
				?>
				<tr>
					<td><?php echo $i ?></td>
					<td><a href="<?php echo base_url() . 'uploads/risk_mitigation/' . $risk_mitigation_file->FILE_NAME; ?>" download><?php echo $image; ?></a></td>
					<td><a href="<?php echo base_url() . 'uploads/risk_mitigation/' . $risk_mitigation_file->FILE_NAME; ?>" download><font color="blue"><?php echo $risk_mitigation_file->FILE_NAME; ?></font></a></td>
					<td>
						<?php
						$unit = $this->unit_model->get_by_id($risk_mitigation_file->UNIT_ID);
						if ($unit)
							echo $unit->name;
						else
							echo '-';
						?>
					</td>
					<td>
						<?php
						$user = $this->user_model->get_by_id($risk_mitigation_file->INSERTED_BY);
						if ($user)
							echo $user->username;
						else
							echo '-';
						?>
					</td>
					<td>
						<?php
						echo $risk_mitigation_file->INSTERTED_TIME?$risk_mitigation_file->INSTERTED_TIME:'-';
						?>
					</td>
				</tr>
				<?php
					$i++; 
		    	} 
		    	?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<!-- END DOCUMENT FILES-->

<!-- HISTORY PANEL -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-clock-o"></i>History Logs
				</div>
			</div>
			<div class="portlet-body">
				<ul class="timeline">
		          <?php 
		          $num = 0;
		          foreach($logs as $log){
		          ?>
		          <li <?php if($num++%2!=0){echo 'class="timeline-inverted"';}?>>
		            <div class="timeline-badge danger"><i class="glyphicon glyphicon-time"></i></div>
		            <div class="timeline-panel ">
		              <div class="timeline-heading">
		                <?php $author = $this->user_model->get_by_id($log->user_id)?>
		                <h4 class="timeline-title"><?php echo $author->first_name." ".$author->last_name?></h4>
		                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $log->created_date?></small></p>
		              </div>
		              <div class="timeline-body">
		                <p><?php echo $log->keterangan?></p>
		              </div>
		            </div>
		          </li>
		          <?php }?>
		        </ul>
			</div>
		</div>
	</div>
</div>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>
