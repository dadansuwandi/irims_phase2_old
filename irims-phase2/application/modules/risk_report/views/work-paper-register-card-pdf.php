<style type="text/css">
.table th, .table td {
   border: 1px solid black;
   vertical-align: top;
}
</style>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Register Card
</h3>
<!-- END PAGE HEADER-->
<div class="row margin-bottom-20">
	<div class="col-md-12">
		<p align="center">
			<font size="5"><b>RISK REGISTER CARD</b></font> <br>
			<font size="4"><b><?php echo !empty($risk_report) ? strtoupper($risk_report->name) : 'SEMUA KATEGORI'; ?></b></font> <br>
			<font size="4"><b>TAHUN <?php echo strtoupper($tahun);?></b></font>
		</p>
	</div>
</div>
<?php if($search){?>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Register Card
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover" style="page-break-after:always;">
				<thead>
					<tr>
						<th class="hidden-xs">No</th>
						<th class="hidden-xs">Risk Number</th>
						<th class="hidden-xs">Risk Register</th>
						<th class="hidden-xs">Risk Level</th>
						<th class="hidden-xs">Rincian</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($rows as $risk_item_id => $row):
						$risk_item = $this->risk_item_model->get_by_id($risk_item_id);
					?>
						<?php
							foreach($row['data'] as $d){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d->risk_register_number?></td>
							<td><?php echo $risk_item->name;?></td>
							<td><?php echo $d->level_name?></td>
							<td><a href="<?php echo site_url('risk_report/work_paper_report/register_card_detail/' . $d->RISK_ITEM_ID); ?>" target="_blank"><font color="blue"><i class="fa fa-search" aria-hidden="true"></i><?php echo 'view'?></font></a></td>
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
<?php }?>

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>
