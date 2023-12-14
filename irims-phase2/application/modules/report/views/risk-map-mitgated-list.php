<!-- BEGIN CSS MATRIX -->
<style type="text/css">
.risk-matrix{
	position:relative;
	width:100%;
	margin-left:22px;
	margin-bottom:20px;
}
.risk-matrix .left-label{
	position:absolute;
	font-size:1.2em;
	font-weight:700;
	bottom:0;
	transform:rotate(270deg);
	-webkit-transform:rotate(270deg);
	-ms-transform:rotate(270deg);
	transform-origin:left bottom 0;
	-webkit-transform-origin:left bottom 0;
	-ms-transform-origin:left bottom 0;
}
.risk-matrix .bottom-label{
	position:absolute;
	font-size:1.2em;
	font-weight:700;
	bottom:-100px;
	padding-left: 78px;
}
.risk-matrix .risk-box{
	position:absolute;
	width:19%;
	height:19%;
	margin-right:1%;
	margin-top:1%;
}
.risk-box.low-risk{
	background:rgba(153,255,51,.8);
	border:1px solid rgba(153,255,51,1);
}.risk-box.medium-risk{
	background:rgba(255,255,51,.8);
	border:1px solid rgba(255,255,51,1);
}
.risk-box.high-risk{
	background:rgba(255,153,51,.8);
	border:1px solid rgba(255,153,51,1);
}
.risk-box.extreme-risk{
	background:rgba(255,51,51,.8);
	border:1px solid rgba(255,51,51,1);
}
.risk-box.dahsyat-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/dahsyat.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.besar-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/besar.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.menengah-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/menengah.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.rendah-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/rendah.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.tidak_significant-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/tidak_significant.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.keterangan-risk{
	background:rgba(255,255,255,.8);
	border:0px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/keterangan.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
	height: 100px;
}
.risk-box.sangat_kecil-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/sangat_kecil.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.kecil-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/kecil.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.sedang-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/sedang.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.besar2-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/besar2.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.hampir_pasti-risk{
	background:rgba(255,255,255,.8);
	border:1px solid rgba(168,168,168,1);
	background-image: url("../../../assets/img/risk_map/hampir_pasti.png");
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.risk-box.col-0{
	left:0;
}
.risk-box.col-1{
	left:20%;
}
.risk-box.col-2{
	left:40%;
}
.risk-box.col-3{
	left:60%;
}
.risk-box.col-4{
	left:80%;
}
.risk-box.col-5{
	left:100%;
}
.risk-box.row-0{
	top:0;
}
.risk-box.row-1{
	top:20%;
}
.risk-box.row-2{
	top:40%;
}
.risk-box.row-3{
	top:60%;
}
.risk-box.row-4{
	top:80%;
}
.risk-box.row-5{
	top:100%;
}
.risk-matrix .risk-matrix-item{
	border-radius:50%;
	width:8%;
	height:8%;
	margin-left:-4%;
	margin-bottom:-24%;
	z-index:1000;
	/*background:#fff;
	border:1px solid #000;*/
	cursor:pointer;
	overflow:hidden;
	-ms-transition:all 1s ease;
	-webkit-transition:all 1s ease;
	transition:all 1s ease;
}
.risk-matrix .risk-matrix-item:hover{
	width:50%;
	height:50%;
	margin-left:-25%;
	margin-bottom:-25%;
	z-index:2000;
	border-radius:0;
	border:1px solid #ddd;
	background:#fff;
}
.risk-matrix .risk-matrix-item>div.open{
	padding:5px;
	visibility:hidden;
	opacity:0;
}
.risk-matrix .risk-matrix-item:hover>div.open{
	visibility:visible;
	opacity:1;
	-ms-transition:visibility 0s linear .5s,opacity .5s linear;
	-webkit-transition:visibility 0s linear .5s,opacity .5s linear;
	transition:visibility 0s linear .5s,opacity .5s linear;
	-ms-transition-delay:.5s;
	-webkit-transition-delay:.5s;
	transition-delay:.5s;
}
.risk-matrix .risk-matrix-item>div.closed{
	display:table;
	width:100%;
	height:100%;
	font-size:.8em;
	/*background-image:-ms-linear-gradient(top,#FFF,silver);
	background-image:-webkit-linear-gradient(top,#FFF,silver);
	background-image:linear-gradient(top,#FFF,silver);*/
}
.risk-matrix .risk-matrix-item>div.closed>span{
	display:table-cell;
	text-align:center;
	vertical-align:middle;
}
.risk-matrix .risk-matrix-item:hover>div.closed{
	display:none;
	-ms-transition-delay:1s;
	-webkit-transition-delay:1s;
	transition-delay:1s;
}
.risk-matrix .risk-matrix-item .title{
	font-size:1.1em;
	font-weight:700;
	margin-bottom:5px;
	padding-bottom:5px;
	border-bottom:1px solid #ddd;
}

.my-data{
    margin-top:110px;
    margin-left:75px;
}
</style>
<!-- END CSS MATRIX -->
<!-- BEGIN CSS MATRIX BEFORE and AFTER -->
<style type="text/css">
.BEFORE {
    /*background-color: #FFF;*/
}
.AFTER {
    /*background-color: #89C4F4;*/
}
</style>
<!-- END CSS MATRIX BEFORE and AFTER -->
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Mitigation Map
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Risk Mitigation Map</a>
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
			<i class="fa fa-gift"></i>Risk Filter
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
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Branch</label>
							<select class="form-control select2me" name="unit_id">
								<?php foreach($unit as $key=>$val): ?>
								<?php if($key==$unit_id) { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } else { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!--/span-->

					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Risk Function</label>
							<select class="form-control select2me" name="risk_category_id">
								<?php foreach($risk_category as $key=>$val): ?>
								<?php if($key==$risk_category_id) { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>" selected="selected"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } else { ?>
								<option value="<?php echo !empty($key) ? $key : ''; ?>"><?php echo !empty($val) ? $val : ''; ?></option>
								<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Years</label>
							<input type="text" class="form-control" name="tahun" value="<?php echo !empty($tahun) ? $tahun : date('Y')?>">
						</div>
					</div>
				</div>
				<!--/row-->
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
				<a href="<?php echo site_url('report/risk_map/index_mitigated'); ?>" class="btn default">Reset</a> 
				<!-- <a href="<?php //echo site_url('report/risk_map/index_mitigated_pdf?tahun='.$_POST['tahun']); ?>" class="btn red">Export to PDF<i class="fa fa-file-pdf-o"></i></a>  -->
				<button type="button" class="btn red" id="pdfDownloader">Export to PDF<i class="fa fa-file-pdf-o"></i></button>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<!-- END FORM FILTER -->
<!-- BEGIN PAGE CONTENT-->
<div id="printDiv" class="row">
	<div class="row margin-bottom-20">
		<div class="col-md-12">
			<p align="center">
				<font size="5"><b>DIAGRAM PETA RISIKO</b></font> <br>
				<font size="4"><b><?php echo !empty($risk_category_report) ? $risk_category_report->description : 'SEMUA UNIT'; ?></b></font> <br>
				<font size="4"><b><?php echo !empty($unit_report) ? $unit_report->name : 'SEMUA CABANG'; ?></b></font> <br>
				<font size="4"><b>Tahun <?php echo $tahun;?></b></font>
			</p>
		</div>
	</div>
	<div class="col-md-6">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-table"></i>Risk List
				</div>
				<!-- <div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="" class="fullscreen">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div> -->
			</div>
			<div class="portlet-body">
				<table class="table table-hover">
				<thead>
				<tr>
					<th>
						NO
					</th>
					<th>
						NAMA RISIKO
					</th>
					<th>
						K
					</th>
					<th>
						D
					</th>
					<th>
						K
					</th>
					<th>
						D
					</th>
				</tr>
				<tr>
					<th>
						#
					</th>
					<th>
						RENCANA MITIGASI
					</th>
					<th colspan="2">
						SEBELUM
					</th>
					<th colspan="2">
						SESUDAH
					</th>
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
							<td><font color="blue" onclick="showEvent(<?php echo $row['risk_item_id']?>);"><?php echo $row['description']; ?></font></td>
							<td><span class="label label-primary"><?php echo $row['risk_k_monitoring']; ?></span></td>
							<td><span class="label label-primary"><?php echo $row['risk_d_monitoring']; ?></span></td>
							<td><span class="label label-default"><?php echo $row['risk_k_mitigated']; ?></span></td>
							<td><span class="label label-default"><?php echo $row['risk_d_mitigated']; ?></span></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
	<div class="col-md-6">
		<!-- BEGIN BORDERED TABLE PORTLET-->
		<div class="portlet box yellow">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-bar-chart-o"></i>Risk Map
				</div>
				<!-- <div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="" class="fullscreen">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div> -->
			</div>
			<div class="portlet-body">
				<!-- BEGIN MAP MATRIX-->
				<!-- <div ng-app="myApp">
				    <div ng-controller="myCtrl"> -->
				        <!-- <div style="width:300px;"> -->
				        <!-- <div style="width:29vw;">
				            <risk-matrix data="data.risks" impact="data.impactValues" probability="data.probabilityValues" template="data.riskTemplate"></risk-matrix>
				        </div>
				        <div class="my-data">
				            <div ng-repeat="r in data.risks | orderBy:'Id'"> -->
				                <!--
				                <span ng-bind="'Risk: '+r.Id"></span>
				                <select ng-model="r.RiskImpact" ng-options="o as o for o in data.impactValues"></select>
				                <select ng-model="r.RiskProbability" ng-options="o as o for o in data.probabilityValues"></select>
				            	-->
				            <!-- </div>
				        </div>
				    </div>
				</div> -->
				<!-- END MAP MATRIX-->
				<!-- BEGIN RISK CHART-->
				<!-- id div wajib diberi nama risk-chart-d3 -->
				<div id="risk-chart-d3" style="height: 100%; width:100%;"></div><!-- widht dan height bisa diatur sesuai kebutuhan, bisa memakai % -->
				<?php
				$i = 1;
				$tmp = array();
				foreach ($rows as $row):
					//echo var_dump(count($rows));

					$keyRiskMonitoring			= array('x' => strtoupper($row['risk_k_monitoring'].$row['risk_d_monitoring']));
					$keyRiskMitigated			= array('y' => strtoupper($row['risk_k_mitigated'].$row['risk_d_mitigated']));
					$keyRiskArrayMerges			= array_merge($keyRiskMonitoring, $keyRiskMitigated);
					foreach ($keyRiskArrayMerges as $key => $keyRiskArrayMerge) {
						//begin menambahkan aksen pada nomor risk
						if ($key == 'y') {
							$ii = $i."'";
						} else {
							$ii = $i;
						}
						//end menambahkan aksen pada nomor risk
						$keyRisk 					= $keyRiskArrayMerge;
						$keyRiskId					= $ii;
						$keyRiskName				= $row['description'];
						$tmp[$keyRisk][$keyRiskId] 	= $keyRiskName;
						//$i++;
					}

					//$keyRisk 					= strtoupper($row['risk_k_monitoring'].$row['risk_d_monitoring']);
					//$keyRiskId					= $i;
					//$keyRiskName				= $row['description'];
					//$tmp[$keyRisk][$keyRiskId] 	= $keyRiskName;
					$i++;
				endforeach;

				$output = array();
				foreach ($tmp as $keyRisk => $keyRiskId):
					//$output[] = array('keyRiskName' => $keyRisk, 'keyRiskId' => $keyRiskId);
					$output[$keyRisk] = $keyRiskId;
				endforeach;
				?>
				<script>
					drawRiskChart(<?php echo json_encode($output)?>);
				</script>
				<div id="risk-chart-d3-temp" style="height: 100%; width:100%;"><canvas id="printCanvas"></canvas></div>
				<!-- END RISK CHART-->
				<!-- BEGIN MAP RISK INFORMATION -->
				<hr>
				<div class="portlet-body flip-scroll">
					<table class="table table-bordered table-striped table-condensed flip-content">
						<thead class="flip-content">
						<tr>
							<th class="hidden-xs" colspan="2" style="text-align:center">Tingkat Risiko</th>
							<th class="hidden-xs" style="text-align:center">Nilai Risiko</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td width="20%" bgcolor="#92D14F">&nbsp;</td>
							<td>Risiko Sangat Rendah (<i>Very Low)</i></td>
							<td>1A, 2A</td>
						</tr>
						<tr>
							<td width="20%" bgcolor="#51D14F">&nbsp;</td>
							<td>Risiko Rendah (<i>Low)</i></td>
							<td>1B, 2B, 3A</td>
						</tr>
						<tr>
							<td width="20%" bgcolor="#FFFF00">&nbsp;</td>
							<td>Risiko Sedang (<i>Medium)</i></td>
							<td>1C, 2C, 3C, 3B, 4A, 4B, 5A</td>
						</tr>
						<tr>
							<td width="20%" bgcolor="#FFC000">&nbsp;</td>
							<td>Risiko Tinggi (<i>High)</i></td>
							<td>1D, 2D, 3D, 4C, 5B, 5C</td>
						</tr>
						<tr>
							<td width="20%" bgcolor="#FE0000">&nbsp;</td>
							<td>Risiko Sangat Tinggi (<i>Very High)</i></td>
							<td>3E, 4D, 4E, 5D, 5E</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!-- END MAP RISK INFORMATION -->
			</div>
		</div>
		<!-- END BORDERED TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php //$this->load->view('risk-mitigation-modal'); ?>
<div id="risk-mitigation-modal" class="modal container fade">
	<!-- <div class="modal-dialog modal-lg">
		<div class="modal-content"> -->
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Detail Risk Register : <span id="event_name_detail"></span></b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td width="20px" rowspan="2"><b>NO</b></td>
							<td rowspan="2"><b>BRANCH</b></td>
							<td rowspan="2"><b>RISK EVENT</b></td>
							<td rowspan="2"><b>PENYEBAB</b></td>
							<td rowspan="2"><b>DAMPAK</b></td>
							<td colspan="2"><b>RESIDUAL</b></td>
							<td colspan="2"><b>MITIGATION</b></td>
							<td rowspan="2"><b>PENGENDALIAN YANG SUDAH DILAKUKAN</b></td>
							<td rowspan="2"><b>RENCANA MITIGASI</b></td>
							<td rowspan="2"><b>PIC (UNIT KERJA)</b></td>
							<td rowspan="2"><b>TARGET WAKTU</b></td>
						</tr>
						<tr>
							<td width="20px"><b>K</b></td>
							<td width="20px"><b>D</b></td>
							<td width="20px"><b>K</b></td>
							<td width="20px"><b>D</b></td>
						</tr>
					</thead>

					<tbody id="risk-mitigation-content">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		<!-- </div>
	</div> -->
</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	jQuery(document).ready(function() {
		// TableAdvanced.init();

		$('body').on("focus", ".date-picker", function(){
			$(this).datepicker({
	            rtl: Metronic.isRTL(),
	            orientation: "left",
	            autoclose: true,
	        });


        });
	});

	// BEGIN MAP MATRIX BEFORE MITIGATED
	var app = angular.module("myApp", ['riskMatrix']);

	app.controller("myCtrl", function($scope){
	    $scope.data = {};

	    $scope.data.risks = <?php echo $jsonRowsData; ?>
	    
	    /*$scope.data.risks = [
	        {
	            Id: 1,
	            Title: 'Risk 1',
	            Description: 'Some description 1',
	            RiskImpact: 'B',
	            RiskProbability: '2'
	        },
	        {
	            Id: 2,
	            Title: 'Risk 2',
	            Description: 'Some description 2',
	            RiskImpact: 'C',
	            RiskProbability: '3'
	        },
	        {
	            Id: 3,
	            Title: 'Risk 3',
	            Description: 'Some description 3',
	            RiskImpact: 'C',
	            RiskProbability: '4'
	        },
	        {
	            Id: 4,
	            Title: 'Risk 4',
	            Description: 'Some description 4',
	            RiskImpact: 'E',
	            RiskProbability: '1'
	        },
	        {
	            Id: 5,
	            Title: 'Risk 5',
	            Description: 'Some description 5',
	            RiskImpact: 'E',
	            RiskProbability: '1'
	        }
	    ];*/
	    
	    $scope.data.impactValues = [
	        '','A','B','C','D','E'
	    ];

	    $scope.data.probabilityValues = [
	        '','1','2','3','4','5'
	    ];
	    
	    /*$scope.data.riskTemplate = '<div class="closed"><span ng-bind="\'R\'+item.Id"></span></div><div class="open"><div class="title" ng-bind="item.Title"></div><div ng-bind="\'Risk Register: \'+item.Description"></div><div ng-bind="\'Impact: \'+item.RiskImpact"></div><div ng-bind="\'Probability: \'+item.RiskProbability"></div></div>';*/

	    $scope.data.riskTemplate = '<div class="closed"><span ng-class="\'\'+item.RiskCSSColor"><span ng-bind="\'\'+item.Id"></span></span></div><div class="open"><div class="title" ng-bind="item.Title"></div><div ng-bind="\'#\'+item.Description"></div><div ng-bind="\'#\'+item.RiskValue"></div></div>';
	    
	});
	// END MAP MATRIX BEFORE MITIGATED

	function showEvent(risk_item_id)
	{
		$("#unit_maps_"+risk_item_id).show();
		$('#risk-mitigation-modal').modal('show');

		$.ajax({
	        url: "<?php echo site_url('report/risk_map/get_event_detail_mitigation');?>",
	        type: "POST",
	        data: {risk_item_id:risk_item_id, tahun:<?php echo $tahun?>, type:"risk-admin"},
	        dataType  : 'json',
	        success: function (response) {
	            var dataTable = "";
	            var no = 0;
	            var event_name_detail = "";
	            for (i = 0; i < response.length; ++i) {
	            	var res = response[i];

	            	no++;

	            	dataTable += "<tr>"+
	            	"<td>"+no+"</td>"+
	            	"<td>"+res.branch+"</td>"+
	            	"<td>"+res.event+"</td>"+
	            	"<td>"+res.penyebab+"</td>"+
	            	"<td>"+res.dampak+"</td>"+
	            	"<td>"+res.risk_k_monitoring+"</td>"+
                	"<td>"+res.risk_d_monitoring+"</td>"+
                	"<td>"+res.risk_k_mitigated+"</td>"+
                	"<td>"+res.risk_d_mitigated+"</td>"+
	            	"<td>"+res.sudah_pengendalian+"</td>"+
	            	"<td>"+res.rencana_mitigasi+"</td>"+
	            	"<td>"+res.pic+"</td>"+
	            	"<td>"+res.target_waktu+"</td></tr>";

	            	event_name_detail = res.risk_name;
	            }
	            $("#event_name_detail").html(event_name_detail);
	            $("#risk-mitigation-content").html(dataTable);
	            $('#risk-mitigation-modal').modal('show');
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	           console.log(textStatus, errorThrown);
	        }
	    });
	}

	// Begin Export To PDF
	//hide div before canvas will be generated
	$("#risk-chart-d3-temp").hide();
	$("#pdfDownloader").click(function(){
		//show div before canvas will be generated
		$("#risk-chart-d3-temp").show();

		var canvas = document.getElementById("printCanvas");
		
		//Get svg markup as string
		var svg = document.getElementById('risk-chart-d3').innerHTML;

		if (svg)
			svg = svg.replace(/\r?\n|\r/g, '').trim();

		canvg(canvas, svg);

		//hide div after canvas has been generated
		$("#risk-chart-d3").hide();
    
        html2canvas(document.getElementById("printDiv"), {
            onrendered: function(canvas) {

                var imgData = canvas.toDataURL('image/png');
                console.log('Report Image URL: '+imgData);
                var doc = new jsPDF('l', 'mm', 'letter');

                var imgWidth = (canvas.width * 41) / 240;
                var imgHeight = (canvas.height * 41) / 240;
                
                doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                doc.save($.now()+'_risk_map_mitigated_list.pdf');
            }
        });

    });
	// End Export To PDF
	var table = $('.table').DataTable({
		
      
    });
</script>
<!-- END JAVASCRIPTS -->
