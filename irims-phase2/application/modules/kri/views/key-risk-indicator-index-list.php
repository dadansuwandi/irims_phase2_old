<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Key Risk Indicator (KRI) <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('kri/key_risk_indicator/index'); ?>">Key Risk Indicator (KRI)</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
	<!--
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
			Actions <i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="#">Action</a>
				</li>
				<li>
					<a href="#">Another action</a>
				</li>
				<li>
					<a href="#">Something else here</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="#">Separated link</a>
				</li>
			</ul>
		</div>
	</div>
	-->
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-list"></i>Key Risk Indicator (KRI)
				</div>
				<!--
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
				-->
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<!-- <div class="col-md-6">
							<div class="btn-group">
								<a href="<?php //echo site_url('kri/key_risk_indicator/add'); ?>" class="btn green">Buat KRI <i class="fa fa-plus"></i></a>
							</div>
						</div> -->
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
				<table class="table table-striped table-bordered table-hover" id="sample_6">
					<thead>
						<tr>
                            <th class="hidden-xs">INPUT MEASURE VALUE</th>
							<th class="hidden-xs">No</th>
							<!-- <th class="hidden-xs">Code</th> -->
							<th class="hidden-xs">Urutan Top Risk</th>
							<th class="hidden-xs">For User</th>
							<th class="hidden-xs">KPI</th>
							<th class="hidden-xs">Risk Register</th>
							<th class="hidden-xs">Risk Event</th>
							<th class="hidden-xs">Basic Event</th>
							<!-- <th class="hidden-xs">Penyebab Utama</th> -->
							<th>No KRI</th>
							<th>Key Risk Indicator (KRI)</th>
							<th class="hidden-xs">Dashboard Description</th>
							<th>KRI Threshold</th>
							<!-- <th class="hidden-xs">Nilai Threshold</th> -->
							<th>Leading / Lagging</th>
							<!-- <th>Traking Frequency</th> -->
							<!-- <th>Threshold Batas Bawah</th> -->
							<!-- <th>Threshold Batas Atas</th> -->
							<!-- <th>Data Source</th> -->
							<!-- <th>Indicator</th> -->
							<th>Status</th>
							<!-- <th style="width: 14%; align=center;">Actions</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($rows as $row):
							$i++;
							?>
							<tr>
								<?php
									$is_input_threshold_value = $this->key_risk_indicator_model->get_by_id($row->KEY_RISK_INDICATOR_ID);
									//if ($is_input_threshold_value->is_input_threshold_value == 0) {
								?>
								<td style="align=center;"><a class="btn btn-circle btn-block green" href="<?php echo site_url('kri/key_risk_indicator/view/' . $row->KEY_RISK_INDICATOR_ID); ?>"><?php echo 'INPUT MEASURE VALUE'; ?></a></td>
								<?php	
									//} else {
								?>
								<!-- <td style="align=center;"><a class="btn btn-circle btn-block blue" href="<?php //echo site_url('kri/key_risk_indicator/view/' . $row->KEY_RISK_INDICATOR_ID); ?>"><?php //echo 'EDIT'; ?></a></td> -->
								<?php
									//}
								?>
								
								<td><?php echo $i; ?></td>
								<!-- <td><?php // echo $row->CODE; ?></td> -->
								<td><?php echo $row->TOP_RISK_NUMBER; ?></td>
								<td>
									<?php
									$user = $this->user_model->get_by_id($row->auth_user_id);
									if ($user)
										echo $user->first_name." ".$user->last_name." (".$user->username.")";
									else
										echo '-';
									?>								
								</td>
								<td>
									<?php
									$riskKpi = $this->risk_kpi_model->get_by_id($row->risk_kpi_id);
									if ($riskKpi)
										echo $riskKpi->name;
									else
										echo '-';
									?>								
								</td>
								<td>
									<?php
									$riskItem = $this->risk_item_model->get_by_id($row->RISK_ITEM_ID);
									if ($riskItem)
										echo $riskItem->name;
									else
										echo '-';
									?>								
								</td>
								<td><?php echo $row->HAZARD; ?></td>
								<td><?php echo $row->BASIC_EVENT; ?></td>
								<!-- <td><?php // echo $row->PENYEBAB; ?></td> -->
								<td><?php echo $row->INDICATOR_NUMBER; ?></td>
								<td>
									<?php
									$Indicator = $this->indicator_model->get_by_id($row->INDICATOR_ID);
									if ($Indicator)
										echo $Indicator->name;
									else
										echo '-';
									?>								
								</td>
								<td><?php echo $row->DASHBOARD_DESCRIPTION; ?></td>
								<td>
									<?php
									$IndicatorThreshold = $this->key_risk_indicator_threshold_model->get_by_id($row->key_risk_indicator_threshold_id);
									if ($IndicatorThreshold)
										echo $IndicatorThreshold->name;
									else
										echo '-';
									?>								
								</td>
								<!-- <td><?php //echo $row->THRESHOLD_VALUE; ?></td> -->
								<td><?php echo $row->LEADING_LAGGING==1?"Leading":"Lagging"; ?></td>
								<!-- <td><?php // echo $row->TRAKING_FREQUENCY; ?></td> -->
								<!-- <td><?php // echo $row->THRESHOLD_BAWAH; ?></td> -->
								<!-- <td><?php // echo $row->THRESHOLD_ATAS; ?></td> -->
								<!-- <td><?php // echo $row->DATA_SOURCE; ?></td> -->
								<!-- <td><?php // echo $row->INDICATOR_RANGKING; ?></td> -->
								<td><?php echo $row->STATUS==1?"Aktif":"Non Aktif"; ?></td>
								<!-- <td style="width: 14%; align=center;"> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/view/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="View" class="btn btn-xs grey-cascade"><i class="fa fa-search"></i></a> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/edit/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="Edit" class="btn btn-xs blue"><i class="fa fa-edit"></i></a> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/delete/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="Delete" class="btn btn-xs red" data-button="delete"> <i class="fa fa-times"></i></a> -->
									<!--<a href="#portlet-config" data-toggle="modal" class="btn btn-xs purple"><i class="fa fa-search"></i></a>-->
								<!-- </td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('delete-modal'); ?>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		TableAdvanced.init();
	});
</script>
<!-- END JAVASCRIPTS -->
