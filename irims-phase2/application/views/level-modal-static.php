<?php 
	$probability = $this->risk_probability_model->get_all(); 
	$impact 	 = $this->risk_impact_model->get_all();
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
						<?php foreach($probability as $p){?>
						<tr>	
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
						<tr>
							<?php foreach($impact as $i){?>
							<th width="20%" class="center"><?php echo $i->name;?></th>
							<?php }?>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td colspan="5">Dampak Keuangan: Perkiraan kehilangan pendapatan yang ditargetkan</td>
						</tr>

						<tr>
							<?php foreach($impact as $i){?>
							<td><?php echo $i->impact_financial;?></td>
							<?php }?>
						</tr>

						<tr>
							<td colspan="5">Dampak Kepatuhan: Berdampak pada (a) kasus hukum dan (b) gangguan tata kelola</td>
						</tr>

						<tr>
							<?php foreach($impact as $i){?>
							<td><?php echo $i->impact_compliance;?></td>
							<?php }?>
						</tr>

						<tr>
							<td colspan="5">Dampak Reputasi</td>
						</tr>

						<tr>
							<?php foreach($impact as $i){?>
							<td><?php echo $i->impact_reputation;?></td>
							<?php }?>
						</tr>

						<tr>
							<td colspan="5">Dampak Keselamatan</td>
						</tr>

						<tr>
							<?php foreach($impact as $i){?>
							<td><?php echo $i->impact_safety;?></td>
							<?php }?>
						</tr>

						<tr>
							<td colspan="5">Dampak Operasi & Teknik</td>
						</tr>

						<tr>
							<?php foreach($impact as $i){?>
							<td><?php echo $i->impact_operation_technique;?></td>
							<?php }?>
						</tr>


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