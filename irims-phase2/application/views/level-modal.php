<?php 
	$probability 			= $this->risk_probability_model->get_all(); 
	$risk_impact_categories = $this->risk_impact_indicator_model->get_by_group_risk_impact_category();
?>
<div id="kemungkinan-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Informasi Level Kemungkinan</b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td rowspan="2"><b>NO</b></td>
							<td rowspan="2"><b>FREKUENSI</b></td>
							<td rowspan="2"><b>KRITERIA KUANTITATIF</b></td>
							<td rowspan="2"><b>KRITERIA KUALITATIF</b></td>
							<td colspan="3"><b>RATING</b></td>
						</tr>
						<tr align="center">
							<td><b>SEBUTAN</b></td>
							<td><b>KODE</b></td>
							<td><b>NILAI</b></td>
						</tr>
					</thead>

					<tbody>
						<?php $no = 1;?>
						<?php foreach($probability as $p){?>
						<tr>
							<td><?php echo $no++?></td>	
							<td><?php echo $p->frequency?></td>
							<td><?php echo $p->quantitative_criteria?></td>
							<td><?php echo $p->qualitative_criteria?></td>
							<td><?php echo $p->rating_mentions?></td>
							<td><?php echo $p->rating_code?></td>
							<td><?php echo $p->rating_value?></td>
						</tr>	
						<?php }?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<div id="dampak-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Informasi Level Dampak</b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td rowspan="2"><b>INDIKATOR KRITERIA DAMPAK</b></td>
							<td rowspan="2"><b>INSIGNIFICANT (A)</b></td>
							<td rowspan="2"><b>MINOR (B)</b></td>
							<td rowspan="2"><b>MODERATE (C)</b></td>
							<td rowspan="2"><b>MAJOR (D)</b></td>
							<td rowspan="2"><b>CATASROPHIC (E)</b></td>
						</tr>
					</thead>

					<tbody>
						<?php foreach($risk_impact_categories as $risk_impact_category){?>
						<tr>
							<td colspan="6" align="center"><b><?php echo strtoupper($risk_impact_category["name"]);?></b></td>
						</tr>
						<tr>
							<?php foreach($risk_impact_category["mst_risk_impact_indicators"] as $risk_impact_indicator){?>
							<td><?php echo $risk_impact_indicator["name"];?></td>
							<td><?php echo $risk_impact_indicator["indicator_A"];?></td>
							<td><?php echo $risk_impact_indicator["indicator_B"];?></td>
							<td><?php echo $risk_impact_indicator["indicator_C"];?></td>
							<td><?php echo $risk_impact_indicator["indicator_D"];?></td>
							<td><?php echo $risk_impact_indicator["indicator_E"];?></td>
						</tr>
							<?php }?>
						<?php }?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<script>
$('.informasi-kemungkinan').on('click', function(e) {
	$('#kemungkinan-modal').modal('show');
	e.preventDefault();
});

$('.informasi-dampak').on('click', function(e) {
	$('#dampak-modal').modal('show');
	e.preventDefault();
});
</script>