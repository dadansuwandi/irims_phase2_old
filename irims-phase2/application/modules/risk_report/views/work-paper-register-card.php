<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Register Card
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Register Card</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN FORM FILTER -->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Filter
		</div>
		<!-- <div class="tools">
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
		<!-- BEGIN FORM-->
		<form action="" method="POST" class="horizontal-form">
			<div class="form-body">
				<h3 class="form-section">Search with :</h3>
				<div class="row">
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Years</label>
							<input type="text" class="form-control" name="tahun" value="<?php echo !empty($tahun) ? $tahun : date('Y')?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Risk Register</label>
							<select class="form-control select2me" name="risk_id" required="required">
								<option value="ALL" <?php echo $risk_id==="ALL"?"selected='selected'":""?>>ALL</option>
								<?php foreach($risk as $key=>$val): ?>
								<?php if($key==$risk_id) { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } else { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Is Top Risk?</label>
							<div class="checkbox-list">
								<label><input type="checkbox" id="top_risk" name="top_risk" value="yes"> Yes </label>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
				<a href="<?php echo site_url('risk_report/work_paper_report/register_card'); ?>" class="btn default">Reset</a> 
				<a href="<?php echo site_url('risk_report/work_paper_report/register_card_pdf?tahun='.$_POST['tahun'].'&risk_id='.$_POST['risk_id']); ?>" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<!-- END FORM FILTER -->

<?php if($search){?>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Register Card
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
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
							<td><a href="<?php echo site_url('risk_report/work_paper_report/register_card_detail?tahun='.$_POST['tahun'].'&risk_item_id='.$d->RISK_ITEM_ID.'&risk_id='.$d->risk_id.'&risk_no='.$d->risk_register_number.'&risk_level='.$this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet); ?>" target="_blank"><font color="blue"><i class="fa fa-search" aria-hidden="true"></i><?php echo 'view'?></font></a></td>
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
