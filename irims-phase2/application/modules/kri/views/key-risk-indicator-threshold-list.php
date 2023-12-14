<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Function <small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('kri/key_risk_indicator_threshold/index'); ?>">Risk Function</a>
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
					<i class="fa fa-list"></i>Risk Function
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
						<div class="col-md-6">
							<div class="btn-group">
								<a href="<?php echo site_url('kri/key_risk_indicator_threshold/add'); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
							</div>
						</div>
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
							<th class="hidden-xs">No.</th>
							<!--<th class="hidden-xs">Id</th>-->
							<th class="hidden-xs">Code</th>
							<th class="hidden-xs">Key Risk Indicator</th>
							<th class="hidden-xs">Name</th>
							<th class="hidden-xs">Threshold Acceptable</th>
							<th class="hidden-xs">Threshold Tolerable</th>
							<th class="hidden-xs">Threshold Unacceptable</th>
                            <th class="hidden-xs">Nilai Awal</th>
							<th class="hidden-xs">Simbol</th>
                            <th class="hidden-xs">Nilai Akhir</th>
							<!-- <th>Description</th> -->
							<!--<th>Status</th>-->
							<!--<th>Unit_id</th>-->
							<!--<th>Created_by</th>-->
							<!--<th>Created_date</th>-->
							<!--<th>Updated_by</th>-->
							<!--<th>Updated_date</th>-->
							<th style="width: 14%; align=center;">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($rows as $row):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<!--<td><?php /* echo $row->id; */ ?></td>-->
								<td><?php echo $row->code; ?></td>
								<td>
									<?php
									$indicator = $this->indicator_model->get_by_id($row->INDICATOR_ID);
									if ($indicator)
										echo $indicator->name;
									else
										echo '-';
									?>								
								</td>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->threshold_acceptable; ?></td>
								<td><?php echo $row->threshold_tolerable; ?></td>
								<td><?php echo $row->threshold_unacceptable; ?></td>
                                <td><?php echo $row->nilai_awal; ?></td>
								<td><?php echo $row->simbol; ?></td>
                                <td><?php echo $row->nilai_akhir; ?></td>
								<!-- <td><?php //echo $row->description; ?></td> -->
								<!--<td><?php /* echo $row->status; */ ?></td>-->
								<!--<td><?php /* echo $row->unit_id; */ ?></td>-->
								<!--<td><?php /* echo $row->created_by; */ ?></td>-->
								<!--<td><?php /* echo $row->created_date; */ ?></td>-->
								<!--<td><?php /* echo $row->updated_by; */ ?></td>-->
								<!--<td><?php /* echo $row->updated_date; */ ?></td>-->
								<td style="width: 14%; align=center;">
									<a href="<?php echo site_url('kri/key_risk_indicator_threshold/view/' . $row->id); ?>" title="View" class="btn btn-xs grey-cascade"><i class="fa fa-search"></i></a>
									<a href="<?php echo site_url('kri/key_risk_indicator_threshold/edit/' . $row->id); ?>" title="Edit" class="btn btn-xs blue"><i class="fa fa-edit"></i></a>
									<a href="<?php echo site_url('kri/key_risk_indicator_threshold/delete/' . $row->id); ?>" title="Delete" class="btn btn-xs red" data-button="delete"> <i class="fa fa-times"></i></a>
									<!--<a href="#portlet-config" data-toggle="modal" class="btn btn-xs purple"><i class="fa fa-search"></i></a>-->
								</td>
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
