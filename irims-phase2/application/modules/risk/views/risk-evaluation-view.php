<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Approval
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<?php
		if($this->uri->segment(3) == 'add') {
		?>
		<li>
			<a href="#">Risk Approval</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Add</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'edit') {
		?>
		<li>
			<a href="#">Risk Approval</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Edit</a>
		</li>
		<?php
		} else if($this->uri->segment(3) == 'view') {
		?>
		<li>
			<a href="#">Risk Approval</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">View</a>
		</li>
		<?php
		}
		?>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-table"></i>Risk Approval
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
				<div class="overFlowTable">
				<table class="table table-striped table-bordered table-hover" id="risk_identification_view">
					<thead>
						<tr>
							<th class="hidden-xs" rowspan="2">UNIT</th>
							<th class="hidden-xs" rowspan="2">SASARAN ORGANISASI / PROSES BISNIS</th>
							<th class="hidden-xs" colspan="2">RISIKO</th>
							<th class="hidden-xs" rowspan="2">PENYEBAB</th>
							<th class="hidden-xs" rowspan="2">DAMPAK</th>
							<th class="hidden-xs" rowspan="2">JENIS RISIKO</th>
							<th class="hidden-xs" colspan="3">INHERENT RISK</th>
							<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN (EXISTING CONTROL)</th>
							<th class="hidden-xs" colspan="2">NILAI EFEKTIVITAS EXCO</th>
							<th class="hidden-xs" colspan="3">CURRENT RISK</th>
							<th class="hidden-xs" colspan="2">RENCANA PERLAKUAN RISIKO</th>
							<th class="hidden-xs" colspan="3">TARGET RESIDUAL RISK</th>
							<th class="hidden-xs" rowspan="2">BIAYA MITIGASI</th>
							<th class="hidden-xs" colspan="2">REANCANA JADWAL PENANGANAN RISIKO</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
							<th class="hidden-xs" rowspan="2">DESKRIPSI</th>
							<th class="hidden-xs" rowspan="2">TANGGAL REGISTER</th>
						</tr>

						<tr>
							<th class="hidden-xs">RISK REGISTER</th>
							<th class="hidden-xs">RISK EVENT</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">KEMUNGKINAN</th>
							<th class="hidden-xs">DAMPAK</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">NILAI (K x D)</th>
							<th class="hidden-xs">MULAI</th>
							<th class="hidden-xs">SELESAI</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($row->RISK_IDENTIFICATION_ID)){
							$mitigation = $this->risk_mitigation_model->get_data($row->RISK_IDENTIFICATION_ID);
						?>
							<tr>
								<td><?php echo $this->unit_model->get_by_id($row->UNIT_ID)->name;?></a></td>
								<td><?php echo $row->OBJECTIVE; ?></td>
								<td>
									<?php
										$risk_item = $this->risk_item_model->get_by_id($row->RISK_ITEM_ID);
										if ($risk_item)
											echo $risk_item->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $row->HAZARD; ?></td>
								<td><?php echo $row->PENYEBAB; ?></td>
								<td><?php echo $row->DAMPAK; ?></td>
								<td>
									<?php
										$risk_category = $this->risk_category_model->get_by_id($row->RISK_CATEGORY_ID);
										if ($risk_category)
											echo $risk_category->name;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $row->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $row->EXCO_EFFECTIVENESS_VALUE_K_ID;?></td>
								<td><?php echo $row->EXCO_EFFECTIVENESS_VALUE_D_ID;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->RENCANA_PENGENDALIAN."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->DAMPAK_RENCANA_PENGENDALIAN."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->TARGET_RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $this->risk_impact_model->get_by_id($row->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $this->risk_probability_model->get_by_id($row->TARGET_RESIDUAL_RISK_K_ID)->rating_value.$this->risk_impact_model->get_by_id($row->TARGET_RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>"."Rp. ".number_format($mitigation[$i]->MITIGATION_COSTS,0,",",".")."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->MULAI_WAKTU."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$mitigation[$i]->TARGET_WAKTU."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$this->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td>
									<?php
										if ($risk_item)
											echo $risk_item->description;
										else
											echo 'Not Set';
									?>
								</td>
								<td><?php echo date("d-m-Y", strtotime($row->INSTERTED_TIME)); ?></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>

				<div class="row">
					<div class="col-md-12">
						<!-- BUTTON STATUS VALIDATE -->
						<?php if($row->STATUS_DOKUMEN_ID==2){?>
						<a href="<?php echo site_url('risk/risk_evaluation/index'); ?>" class="btn btn-circle green"><i class="fa fa-chevron-left"></i> KEMBALI</a> 
						<a href="<?php echo site_url('risk/risk_evaluation/edit/' . $row->RISK_IDENTIFICATION_ID); ?>" class="btn btn-circle green">UPDATE <i class="fa fa-pencil"></i></a> 
						<?php if(isset($row->RISK_ITEM_ID) AND $row->RISK_ITEM_ID > 0){?>
						<a href="<?php echo site_url('risk/risk_evaluation/change_status?id='.$row->RISK_IDENTIFICATION_ID.'&status=3'); ?>" class="btn btn-circle red">KONFIRMASI DAN KIRIM DOKUMEN KE RISK OWNER<i class="fa fa-send"></i></a>
						<?php }?>
						<?php }?>
					</div>
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- HISTORY PANEL -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-clock-o"></i>History Logs
				</div>
			</div>
			<div class="portlet-body">
				<ul class="timeline">
          <?php 
          $num = 0;
          foreach($logs as $log){
          ?>
          <li <?php if($num++%2!=0){echo 'class="timeline-inverted"';}?>>
            <div class="timeline-badge danger"><i class="glyphicon glyphicon-time"></i></div>
            <div class="timeline-panel ">
              <div class="timeline-heading">
                <?php $author = $this->user_model->get_by_id($log->user_id)?>
                <h4 class="timeline-title"><?php echo $author->first_name." ".$author->last_name?></h4>
                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $log->created_date?></small></p>
              </div>
              <div class="timeline-body">
                <p><?php echo $log->keterangan?></p>
              </div>
            </div>
          </li>
          <?php }?>
        </ul>
			</div>
		</div>
	</div>
</div>

<style>
	.timeline {
	    list-style: none;
	    padding: 20px 0 20px;
	    position: relative;
	}

    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li > .timeline-panel {
        width: 46%;
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        padding: 20px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }

    .timeline > li > .timeline-panel:before {
        position: absolute;
        top: 26px;
        right: -15px;
        display: inline-block;
        border-top: 15px solid transparent;
        border-left: 15px solid #ccc;
        border-right: 0 solid #ccc;
        border-bottom: 15px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-panel:after {
        position: absolute;
        top: 27px;
        right: -14px;
        display: inline-block;
        border-top: 14px solid transparent;
        border-left: 14px solid #fff;
        border-right: 0 solid #fff;
        border-bottom: 14px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-badge {
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 1.4em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 50%;
        margin-left: -25px;
        background-color: #999999;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }

    .timeline > li.timeline-inverted > .timeline-panel {
        float: right;
    }

    .timeline > li.timeline-inverted > .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        left: -15px;
        right: auto;
    }

    .timeline > li.timeline-inverted > .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }

	.timeline-badge.primary {
	    background-color: #2e6da4 !important;
	}

	.timeline-badge.success {
	    background-color: #3f903f !important;
	}

	.timeline-badge.warning {
	    background-color: #f0ad4e !important;
	}

	.timeline-badge.danger {
	    background-color: #d9534f !important;
	}

	.timeline-badge.info {
	    background-color: #5bc0de !important;
	}

	.timeline-title {
	    margin-top: 0;
	    color: inherit;
	}

	.timeline-body > p,
	.timeline-body > ul {
	    margin-bottom: 0;
	}

  .timeline-body > p + p {
      margin-top: 5px;
  }

	@media (max-width: 767px) {
	    ul.timeline:before {
	        left: 40px;
	    }

	    ul.timeline > li > .timeline-panel {
	        width: calc(100% - 90px);
	        width: -moz-calc(100% - 90px);
	        width: -webkit-calc(100% - 90px);
	    }

	    ul.timeline > li > .timeline-badge {
	        left: 15px;
	        margin-left: 0;
	        top: 16px;
	    }

	    ul.timeline > li > .timeline-panel {
	        float: right;
	    }

        ul.timeline > li > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }

        ul.timeline > li > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }
	}

	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}
</style>

<?php $this->load->view('delete-modal'); ?>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		/*FormValidation.init();*/
		/*TableAdvancedView.init();*/
	});

	var TableAdvancedView = function () {
	    var initView = function () {

	        var table = $('#risk_identification_view');

	        var oTable = table.dataTable({
	            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
	            "language": {
	                "aria": {
	                    "sortAscending": ": activate to sort column ascending",
	                    "sortDescending": ": activate to sort column descending"
	                },
	                "emptyTable": "No data available in table",
	                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	                "infoEmpty": "No entries found",
	                "infoFiltered": "(filtered1 from _MAX_ total entries)",
	                "lengthMenu": "Show _MENU_ entries",
	                "search": "Search:",
	                "zeroRecords": "No matching records found"
	            },
	            "order": [
	                [0, 'asc']
	            ],
	            "lengthMenu": [
	                [5, 15, 20, 25, 50, 100, -1],
	                [5, 15, 20, 25, 50, 100, "All"] // change per page values here
	            ],
	            "columnDefs": [{  // set default column settings
	                'orderable': false,
	                'targets': [0]
	            }, {
	                "searchable": false,
	                "targets": [0]
	            }]
	        });

	        var oTableColReorder = new $.fn.dataTable.ColReorder( oTable );

	        var tableWrapper = $('#risk_identification_view_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
	    }

	    return {

	        //main function to initiate the module
	        init: function () {

	            if (!jQuery().dataTable) {
	                return;
	            }
	            initView();
	        }

	    };

	}();
</script>
<!-- END JAVASCRIPTS -->
