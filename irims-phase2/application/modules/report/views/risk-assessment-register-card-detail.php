<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Register Card Detail
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Register Card Detail</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<div class="row margin-bottom-20">
	<div class="form-actions">
		<a href="<?php echo site_url('report/risk_assessment_report/register_card_detail_pdf?tahun='.$_GET['tahun'].'&risk_item_id='.$_GET['risk_item_id'].'&risk_id='.$_GET['risk_id'].'&risk_no='.$_GET['risk_no'].'&risk_level='.$_GET['risk_level']); ?>" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>
	</div> 
</div>
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Register Card Detail
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			<table class="table table-striped table-bordered table-hover">
				<!-- <thead>
					<tr>
						<th class="hidden-xs">NO</th>
						<th class="hidden-xs">KODE BANDARA</th>
						<th class="hidden-xs">HAZARD</th>
						<th class="hidden-xs">PENYEBAB</th>
						<th class="hidden-xs">DAMPAK</th>
						<th class="hidden-xs">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
						<th class="hidden-xs">RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</th>
						<th class="hidden-xs">REALISASI MITIGASI</th>
					</tr>
				</thead> -->
				<tbody>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs" rowspan="4" colspan="3"><b><i><?php echo !empty($risk_report) ? strtoupper($risk_report->name) : 'SEMUA KATEGORI'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>RISK REGISTER</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_register_report) ? strtoupper($risk_register_report->name) : 'SEMUA REGISTER'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>NO RISK RADAR</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_register_no_report) ? strtoupper($risk_register_no_report) : 'SEMUA REGISTER NUMBER'; ?></i></b></td>
					</tr>
					<tr>
						<td style="background-color:#ffcc00" class="hidden-xs"><b>LEVEL RISIKO</b></td>
						<td style="background-color:#ffcc00" class="hidden-xs" colspan="4"><b><i><?php echo !empty($risk_level_report) ? strtoupper($risk_level_report) : 'SEMUA LEVEL'; ?></i></b></td>
					</tr
					<tr>
						<td style="background-color:#0080ff" class="hidden-xs"><b>N0</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>KODE BANDARA</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>HAZARD</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>PENYEBAB</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>DAMPAK</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>PENGENDALIAN YANG SUDAH DILAKUKAN</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</b></td>
						<td style="background-color:#0080ff" class="hidden-xs"><b>REALISASI MITIGASI</b></td>
					</tr>
					<?php
					$teridentifikasi = 0;
					$termitigasi = 0;
					$summary = array();

					$no = 1;
					foreach ($rows as $risk_item_id => $row):
						$risk_item = $this->risk_item_model->get_by_id($risk_item_id);
					?>
						<?php
							$temp = 1;
							foreach($row['data'] as $d){
								$unit = $this->risk_model->get_by_unit_report($d->UNIT_ID);
								$mitigation = $this->risk_mitigation_model->get_data($d->RISK_IDENTIFICATION_ID);
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $unit->code?></td>
							<td><a href="<?php echo site_url('report/risk_assessment_report/view/' . $d->RISK_IDENTIFICATION_ID .'/1'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
							<td><?php echo $d->PENYEBAB?></td>
							<td><?php echo $d->DAMPAK?></td>
							<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
							<td>
								<?php
									if($mitigation){
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											echo $mitigation[$i]->RENCANA_PENGENDALIAN;
										}
									}else{
										echo "Not Set";
									}
								?>
							</td>
							<td>
								<?php
									if($mitigation){
										for ($i=0; $i <= count($mitigation)-1; $i++) { 
											if($mitigation[$i]->REALISASI_MITIGASI!=""){
												echo $mitigation[$i]->REALISASI_MITIGASI;
											}
										}
									}else{
										echo "Not Set";
									}
								?>
							</td>
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

<style>
	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/cr-1.5.4/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>



<script type="text/javascript" charset="utf-8">
	
	//	$('.table  thead tr')
      //  .addClass('filters')
        //.appendTo('#example thead');
 
    var table = $('.table ').DataTable({
		
        orderCellsTop: true,
		dom: 'Bfrtip',
		
        buttons: [
             'csv', 'excel', 'pdf'
        ],
        initComplete: function () {
            var api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
		</script>