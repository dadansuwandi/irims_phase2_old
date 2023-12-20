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
							<input type="text" id ="txtTahun" class="form-control" name="tahun" value="<?php echo !empty($tahun) ? $tahun : date('Y')?>">
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Risk Register</label>
							<select class="form-control select2me" id="risk_id" name="risk_id" required="required">
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
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			
		</form>
		<div class="form-actions">
				<button id="btnFilter"  type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
				<a href="<?php echo site_url('report/risk_assessment_report/register_card'); ?>" class="btn default">Reset</a> 
				<a href="<?php echo site_url('report/risk_assessment_report/register_card_pdf?tahun='.$_POST['tahun'].'&risk_id='.$_POST['risk_id']); ?>" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>
			</div>
		<!-- END FORM-->
	</div>
</div>
<!-- END FORM FILTER -->


<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-list"></i>Risk Register Card
		</div>
	</div>
	<div class="portlet-body">
		<div class="overFlowTable">
			
			<table class="table table-striped table-bordered table-hover" id="test" >
				<thead>
					<tr>
						<th class="hidden-xs">No</th>
						<th class="hidden-xs">Risk Number</th>
						 <th class="hidden-xs">Risk Register</th>
						<th class="hidden-xs">Risk Level</th>
						<th class="hidden-xs">Rincian</th> 
					</tr>
				</thead>
				<!-- <tbody>
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
							<td><a href="<?php echo site_url('report/risk_assessment_report/register_card_detail?tahun='.$_POST['tahun'].'&risk_item_id='.$d->RISK_ITEM_ID.'&risk_id='.$d->risk_id.'&risk_no='.$d->risk_register_number.'&risk_level='.$this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet); ?>" target="_blank"><font color="blue"><i class="fa fa-search" aria-hidden="true"></i><?php echo 'view'?></font></a></td>
						</tr>
						<?php
							}
						?>
					<?php endforeach; ?>
				</tbody> -->
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
  $("#btnFilter").click(function (){
	var tahun = $("#txtTahun").val();
	var risk_id = $("#risk_id").val();


	$.ajax({
                type: "POST",
                url: "<?php echo site_url('report/risk_assessment_register_card/filter');?>",
                data: {tahun:  tahun,risk_id:risk_id},
                dataType: "json",
                success: function (data) {
				var dtRisk = new Object();
				for (var i = 0; i < data.length; i++) {
					dtRisk.No = i+1;
					dtRisk.risk_register_number = data[i]["risk_register_number"];
					dtRisk.risk_register = data[i]["risk_register"];
					dtRisk.level_name = data[i]["level_name"];
					dtRisk.rincian = '<a href="<?php echo site_url('report/risk_assessment_report/register_card_detail?tahun='.$_POST['tahun'].'&risk_item_id='.$d->RISK_ITEM_ID.'&risk_id='.$d->risk_id.'&risk_no='.$d->risk_register_number.'&risk_level='.$this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet); ?>" target="_blank"><font color="blue"><i class="fa fa-search" aria-hidden="true"></i><?php echo 'view'?></font></a>';
					$('.table').dataTable().fnAddData(dtRisk);
					//table.fnAddData(Kelas);
				}
                },
                error: function (xhr) {
					//alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
                }
            });
  });

	
		$('.table  thead tr')
        .addClass('filters')
        //.appendTo('#example thead');
 
    var table = $('.table ').DataTable({
		
        orderCellsTop: true,
		dom: 'Bfrtip',
		
        buttons: [
             'csv', 'excel', 'pdf'
        ],
		"aoColumns": [
		{ "mDataProp" : "No"},
        { "mDataProp" : "risk_register_number"},
		{ "mDataProp" : "risk_register"},
        { "mDataProp" : "level_name"},
        { "mDataProp" : "rincian"}
        ],
        initComplete: function () {
            var api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
					if (colIdx == 0 || colIdx == 4 ) return;
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
