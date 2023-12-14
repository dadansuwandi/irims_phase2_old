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
	background:#fff;
	border:1px solid #000;
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
	font-size:.7em;
	background-image:-ms-linear-gradient(top,#FFF,silver);
	background-image:-webkit-linear-gradient(top,#FFF,silver);
	background-image:linear-gradient(top,#FFF,silver);
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
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Risk Monitoring Map
</h3>
<!-- BEGIN PAGE CONTENT-->
<div class="row margin-bottom-20">
	<div class="col-md-12">
		<p align="center">
			<font size="5"><b>DIAGRAM PETA RISIKO</b></font> <br>
			<font size="4"><b><?php echo !empty($risk_category_report) ? $risk_category_report->description : 'SEMUA KATEGORI'; ?></b></font> <br>
			<font size="4"><b><?php echo !empty($unit_report) ? $unit_report->name : 'SEMUA CABANG'; ?></b></font> <br>
			<font size="4"><b>Tahun <?php echo $tahun;?></b></font>
		</p>
	</div>
</div>
<div class="row">
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
							<td><font color="blue" onclick="showEvent(<?php echo $row['RiskItemiId']?>);"><?php echo $row['Description']; ?></font></td>
							<td><span class="label label-success"><?php echo $row['RiskProbability']; ?></span></td>
							<td><span class="label label-warning"><?php echo $row['RiskImpact']; ?></span></td>
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
				<div ng-app="myApp">
				    <div ng-controller="myCtrl">
				        <!-- <div style="width:300px;"> -->
				        <div style="width:29vw;">
				            <risk-matrix data="data.risks" impact="data.impactValues" probability="data.probabilityValues" template="data.riskTemplate"></risk-matrix>
				        </div>
				        <div class="my-data">
				            <div ng-repeat="r in data.risks | orderBy:'Id'">
				                <!--
				                <span ng-bind="'Risk: '+r.Id"></span>
				                <select ng-model="r.RiskImpact" ng-options="o as o for o in data.impactValues"></select>
				                <select ng-model="r.RiskProbability" ng-options="o as o for o in data.probabilityValues"></select>
				            	-->
				            </div>
				        </div>
				    </div>
				</div>
				<!-- END MAP MATRIX-->
			</div>
		</div>
		<!-- END BORDERED TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('risk-monitoring-modal'); ?>

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

	// BEGIN MAP MATRIX
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

	    $scope.data.riskTemplate = '<div class="closed"><span ng-bind="\'\'+item.Id"></span></div><div class="open"><div class="title" ng-bind="item.Title"></div><div ng-bind="\'#\'+item.Description"></div><div ng-bind="\'#\'+item.RiskValue"></div></div>';
	    
	});
	// BEGIN MAP MATRIX

	function showEvent(risk_item_id){
		$.ajax({
            url: "<?php echo site_url('report/risk_map/get_event_detail');?>",
            type: "POST",
            data: {risk_item_id:risk_item_id,type:"risk-admin"},
            dataType  : 'json',
            success: function (response) {
                var dataTable = "";
                var no = 0;
                for (i = 0; i < response.length; ++i) {
                	var res = response[i];

                	no++;

                	dataTable += "<tr>"+
                	"<td>"+no+"</td>"+
                	"<td>"+res.branch+"</td>"+
                	"<td>"+res.event+"</td>"+
                	"<td>"+res.risk_k+"</td>"+
                	"<td>"+res.risk_d+"</td></tr>";
                }

                $("#risk-monitoring-content").html(dataTable);
                $('#risk-monitoring-modal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
	}
</script>
<!-- END JAVASCRIPTS -->
