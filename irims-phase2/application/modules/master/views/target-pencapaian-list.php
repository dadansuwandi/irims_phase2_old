<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Target
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Target</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
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
					<div class="col-md-5">
						<div class="form-group">
							<label class="control-label">Years</label>
							<input type="text" class="form-control" name="tahun" value="<?php echo !empty($tahun) ? $tahun : date('Y')?>">
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Target
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="hidden-xs">NO</th>
						<th class="hidden-xs">BRANCH</th>
						<th class="hidden-xs">ACHIEVEMENT TARGET (%)</th>
						<th class="hidden-xs">IMPLEMENTATION DATE START</th>
						<th class="hidden-xs">IMPLEMENTATION DATE END</th>
						<th class="hidden-xs">YEAR</th>
						<th style="width: 14%; align=center;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($rows as $row){?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $this->unit_model->get_by_id($row->unit_id)->name; ?></td>
						<td><?php echo $row->target;?></td>
						<td><?php echo $row->start_date;?></td>
						<td><?php echo $row->end_date;?></td>
						<td><?php echo $row->tahun;?></td>
						<td style="width: 14%; align=center;">
							<a href="<?php echo site_url('master/target_pencapaian/edit/' . $row->id); ?>" title="Edit" class="btn btn-xs blue"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
					<?php }?>
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
