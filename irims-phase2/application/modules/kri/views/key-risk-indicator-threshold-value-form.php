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
		<div class="portlet box red">
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
                            <!-- <th class="hidden-xs">INPUT MEASURE VALUE</th> -->
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
							<!-- <th>KRI Measure Value</th> -->
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
						$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_data($KEY_RISK_INDICATOR_ID);
						//foreach ($rows as $row):
							$i++;
							?>
							<tr>
                                <!-- <td style="align=center;"><a class="btn btn-circle btn-block green" href="<?php //echo site_url('kri/key_risk_indicator/view/' . $row->KEY_RISK_INDICATOR_ID); ?>"><?php //echo 'INPUT'; ?></a></td> -->
								<td><?php echo $i; ?></td>
								<!-- <td><?php // echo $CODE; ?></td> -->
								<td><?php echo $TOP_RISK_NUMBER; ?></td>
								<td>
									<?php
									$user = $this->user_model->get_by_id($auth_user_id);
									if ($user)
										echo $user->first_name." ".$user->last_name." (".$user->username.")";
									else
										echo '-';
									?>								
								</td>
								<td>
									<?php
									$riskKpi = $this->risk_kpi_model->get_by_id($risk_kpi_id);
									if ($riskKpi)
										echo $riskKpi->name;
									else
										echo '-';
									?>								
								</td>
								<td>
									<?php
									$riskItem = $this->risk_item_model->get_by_id($RISK_ITEM_ID);
									if ($riskItem)
										echo $riskItem->name;
									else
										echo '-';
									?>								
								</td>
								<td><?php echo $HAZARD; ?></td>
								<td><?php echo $BASIC_EVENT; ?></td>
								<!-- <td><?php // echo $row->PENYEBAB; ?></td> -->
								<td><?php echo $INDICATOR_NUMBER; ?></td>
								<td>
									<?php
									$Indicator = $this->indicator_model->get_by_id($INDICATOR_ID);
									if ($Indicator)
										echo $Indicator->name;
									else
										echo '-';
									?>								
								</td>
								<td><?php echo $DASHBOARD_DESCRIPTION; ?></td>
								<td>
									<?php
									$IndicatorThreshold = $this->key_risk_indicator_threshold_model->get_by_id($key_risk_indicator_threshold_id);
									if ($IndicatorThreshold)
										echo $IndicatorThreshold->name;
									else
										echo '-';
									?>								
								</td>
								<!-- <td>
									<?php
										//if($key_risk_indicator_threshold_value){
											//echo "<ol>";
										//	for ($i=0; $i <= count($key_risk_indicator_threshold_value)-1; $i++) {
												//echo "<li>".$key_risk_indicator_threshold_value[$i]->threshold_value."</li>";
										//		echo number_format($key_risk_indicator_threshold_value[$i]->threshold_value,0,",",".");
										//	}
											//echo "</ol>";
										//}else{
										//	echo "Not Set";
										//}
									?>
								</td> -->
								<!-- <td><?php //echo $THRESHOLD_VALUE; ?></td> -->
								<td><?php echo $LEADING_LAGGING==1?"Leading":"Lagging"; ?></td>
								<!-- <td><?php // echo $TRAKING_FREQUENCY; ?></td> -->
								<!-- <td><?php // echo $THRESHOLD_BAWAH; ?></td> -->
								<!-- <td><?php // echo $THRESHOLD_ATAS; ?></td> -->
								<!-- <td><?php // echo $DATA_SOURCE; ?></td> -->
								<!-- <td><?php // echo $INDICATOR_RANGKING; ?></td> -->
								<td><?php echo $STATUS_ID==1?"Aktif":"Non Aktif"; ?></td>
								<!-- <td style="width: 14%; align=center;"> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/view/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="View" class="btn btn-xs grey-cascade"><i class="fa fa-search"></i></a> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/edit/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="Edit" class="btn btn-xs blue"><i class="fa fa-edit"></i></a> -->
									<!-- <a href="<?php //echo site_url('kri/key_risk_indicator/delete/' . $row->KEY_RISK_INDICATOR_ID); ?>" title="Delete" class="btn btn-xs red" data-button="delete"> <i class="fa fa-times"></i></a> -->
									<!--<a href="#portlet-config" data-toggle="modal" class="btn btn-xs purple"><i class="fa fa-search"></i></a>-->
								<!-- </td> -->
							</tr>
						<?php //endforeach; ?>
					</tbody>
				</table>
                <!-- <div class="row">
                    <div class="col-md-12"> -->
                        <!-- BUTTON FORM INPUT VALUE -->
                        <!-- <a href="<?php //echo site_url('kri/key_risk_indicator/index_list'); ?>" class="btn blue"><i class="fa fa-chevron-left"></i> KEMBALI</a>  -->
                        <!-- <a href="<?php //echo site_url('kri/key_risk_indicator/measure_value/'.$row->KEY_RISK_INDICATOR_ID); ?>" class="btn green">INPUT MEASURE VALUE<i class="fa fa-pencil"></i></a> -->
                    <!-- </div>
                </div> -->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i> Measure Value Form
				</div>
				<!-- <div class="tools hidden-xs">
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
				<form  class="form-horizontal" id="risk_identification_form" method="POST">
					<div class="form-wizard">
						<div class="form-body">
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>
							
							<div class="tab-content">
								<div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									Your form validation is successful!
								</div>

								<input type="hidden" class="form-control" name="KEY_RISK_INDICATOR_ID" id="KEY_RISK_INDICATOR_ID" value="<?php echo !empty($KEY_RISK_INDICATOR_ID) ? $KEY_RISK_INDICATOR_ID : ''; ?>"/>
                                    <h3 class="form-section">Realisasi Threshold</h3>
									
									<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN):?>
									<div class="form-group">
										<label class="control-label col-md-3">Tanggal Input (Tahun-Bulan-Tanggal) <span class="required">*</span></label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="INPUT_DATE" name="INPUT_DATE" value="<?php echo !empty($INPUT_DATE) ? date('Y-m-d', strtotime($INPUT_DATE)) : ''; ?>" data-required="1"/>
											</div>
										</div>
									</div>
									<?php endif;?>

									<div class="form-group">
										<label class="control-label col-md-3">Measure Value <span class="required">*</span></label>
										<div class="col-md-3">
											<input type="number" step="any" name="THRESHOLD_VALUE" value="<?php echo !empty($THRESHOLD_VALUE) ? $THRESHOLD_VALUE : ''; ?>" data-required="1" class="form-control"/>
										</div>
										<span class="label label-sm label-info"><label><strong>Info Satuan</strong></label></span>
										<span class="help-block"><?php echo $measure_unit; ?></span>
									</div>
                                    
									<div class="form-group">
										<div class="col-md-3">&nbsp;</div>
										<div class="col-md-6">
											<button type="submit" class="btn btn-circle green" id="save-button" value="Save" name="save-button">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('delete-modal'); ?>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		TableAdvanced.init();
	});

	$("#INPUT_DATE").datepicker({
		format: "yyyy-mm-dd",
		autoclose:true //to close picker once year is selected
	});
</script>
<!-- END JAVASCRIPTS -->
