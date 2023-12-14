<?php 
	$CI =& get_instance();
	$CI->load->model('master/risk_item_model');
	$CI->load->model('risk/risk_mitigation_model');
	$CI->load->model('master/risk_probability_model');
   	$CI->load->model('master/risk_impact_model');
   	$CI->load->model('master/risk_pic_model');
    $CI->load->model('master/risk_category_model');
?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Operational Risk <small>Integrated Risk Management System (IRIMS)</small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="#">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('welcome'); ?>">Dashboard</a>
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN DASHBOARD STATS -->
<div class="row">
	<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_OWNER || $this->session->userdata('role_id')==GROUP_RISK_HEADQUARTERS ):?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat grey-salsa" href="<?php echo site_url('risk/risk_identification/index'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $pending_risk;?>
				</div>
				<div class="desc">
					Pending / Draft Risk
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat red-haze" href="<?php echo site_url('risk/risk_assessment/monitored_list'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $onprogress_risk;?>
				</div>
				<div class="desc">
					Monitored Risk
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat green-meadow" href="<?php echo site_url('risk/risk_assessment/mitigated_list'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?= var_dump($done_risk) ?>
					<?php echo $done_risk;?>
				</div>
				<div class="desc">
					Mitigated Risk
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<?php endif;?>

	<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN):?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat grey-salsa" href="<?php echo site_url('risk/risk_evaluation/index'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $assessment_approval;?>
				</div>
				<div class="desc">
					Pending Assessment Approval
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat blue-steel" href="<?php echo site_url('risk/risk_evaluation/mitigated'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $mitigation_approval;?>
				</div>
				<div class="desc">
					Pending Mitigation Approval
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<?php endif;?>

	<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_BOD):?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat red-haze" href="<?php echo site_url('risk/risk_evaluation/event'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $sum_teridentifikasi;?>
				</div>
				<div class="desc">
					Total Risk Event
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat green-meadow" href="<?php echo site_url('risk/risk_assessment/mitigated_list_admin'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $sum_termitigasi;?>
				</div>
				<div class="desc">
					Total Risk Mitigation
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<?php endif;?>

	<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_LEADERS):?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat red-haze" href="<?php echo site_url('risk/risk_evaluation/event_gm'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $sum_teridentifikasi_gm;?>
				</div>
				<div class="desc">
					Total Risk Event
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat green-meadow" href="<?php echo site_url('risk/risk_assessment/mitigated_list_admin'); ?>">
			<div class="visual">
				<i class="fa fa-file-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $sum_termitigasi_gm;?>
				</div>
				<div class="desc">
					Total Risk Mitigation
				</div>
			</div>
			<div class="more">&nbsp;</div>
		</a>
	</div>
	<?php endif;?>	
</div>
<!-- END DASHBOARD STATS -->
<div class="clearfix">
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<h4><b>Tahun Laporan</b></h4>
					</div>
					
					<div class="col-md-3 col-sm-12 col-xs-12">
						<?php
							$tahun_awal = 2014;
							$array_tahun= array();

							for ($i=$tahun_awal; $i <= date('Y')+1 ; $i++) { 
								$array_tahun[] = $i;
							}
						?>
						<select class="form-control" id="tahun_laporan_select">
							<?php 
								foreach($array_tahun as $at){
									if($at==$tahun){
										echo "<option value=".$at." selected='selected'>".$at."</option>";
									}else{
										echo "<option value=".$at.">".$at."</option>";
									}
								}
							?>
						</select>
					</div>
				<!--
					<div class="col-md-2 col-sm-12 col-xs-12">
						<h4><b>Status</b></h4>
					</div>
					
					<div class="col-md-3 col-sm-12 col-xs-12">
						<select class="form-control select2me" id="status_select">
							<option value="">-- Pilih --</option>
							<option value="ALL" <?php //echo $stat==="ALL"?"selected='selected'":""?>>Teridentifikasi</option>
							<option value="N" <?php //echo $stat==="N"?"selected='selected'":""?>>Belum Termitigasi</option>
							<option value="Y" <?php //echo $stat==="Y"?"selected='selected'":""?>>Termitigasi</option>
						</select>
					</div>
				-->
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_LEADERS):?>
<div class="row">
	<div class="row margin-bottom-20">
		<div class="col-md-12">
			<p align="center">
				<font size="5"><b>DIAGRAM PETA RISIKO</b></font> <br>
				<font size="4"><b><?php echo !empty($unit_report) ? $unit_report->name : 'SEMUA CABANG'; ?></b></font> <br>
				<font size="4"><b>Tahun <?php echo $tahun;?></b></font>
			</p>
		</div>
	</div>
	<div class="col-md-6">
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
							<td><font color="blue" onclick="showEventLeader(<?php echo $row['RiskItemiId']?>);"><?php echo $row['Description']; ?></font></td>
							<td><span class="label label-primary"><?php echo $row['RiskProbability']; ?></span></td>
							<td><span class="label label-primary"><?php echo $row['RiskImpact']; ?></span></td>
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
			<div class="portlet-body" style="height: 525px;">
				<!-- BEGIN MAP MATRIX-->
				<!--
				<div ng-app="myApp">
				    <div ng-controller="myCtrl">
				    -->
				        <!-- <div style="width:300px;"> -->
				        <!--
				        <div style="width:29vw;">
				            <risk-matrix data="data.risks" impact="data.impactValues" probability="data.probabilityValues" template="data.riskTemplate"></risk-matrix>
				        </div>
				        <div class="my-data">
				            <div ng-repeat="r in data.risks | orderBy:'Id'">
				            -->
				                <!--
				                <span ng-bind="'Risk: '+r.Id"></span>
				                <select ng-model="r.RiskImpact" ng-options="o as o for o in data.impactValues"></select>
				                <select ng-model="r.RiskProbability" ng-options="o as o for o in data.probabilityValues"></select>
				            	-->
				            	<!--
				            </div>
				        </div>
				    </div>
				</div>
			-->
				<!-- END MAP MATRIX-->
				<!-- BEGIN RISK CHART-->
				<!-- id div wajib diberi nama risk-chart-d3 -->
				<div id="risk-chart-d3" style="height: 500px; width:500px;"></div><!-- widht dan height bisa diatur sesuai kebutuhan, bisa memakai % -->
				<?php
				$i = 1;
				$tmp = array();
				foreach ($rows as $row):
					//echo var_dump(count($rows));
					$keyRisk 					= strtoupper($row['RiskProbability'].$row['RiskImpact']);
					$keyRiskId					= $i;
					$keyRiskName				= $row['Description'];
					$tmp[$keyRisk][$keyRiskId] 	= $keyRiskName;
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
				<div id="risk-chart-d3-temp" style="height: 500px; width:500px;"><canvas id="printCanvas"></canvas></div>
				<!-- END RISK CHART-->
			</div>
		</div>
		<!-- END BORDERED TABLE PORTLET-->
	</div>
</div>

<div class="clearfix">
</div>

<?php $this->load->view('risk-monitoring-modal'); ?>

<style>
	/*RISK MATRIX CSS*/
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
		background-image: url("../assets/img/risk_map/dahsyat.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.besar-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/besar.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.menengah-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/menengah.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.rendah-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/rendah.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.tidak_significant-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/tidak_significant.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.keterangan-risk{
		background:rgba(255,255,255,.8);
		border:0px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/keterangan.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
		height: 100px;
	}
	.risk-box.sangat_kecil-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/sangat_kecil.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.kecil-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/kecil.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.sedang-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/sedang.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.besar2-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/besar2.png");
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	.risk-box.hampir_pasti-risk{
		background:rgba(255,255,255,.8);
		border:1px solid rgba(168,168,168,1);
		background-image: url("../assets/img/risk_map/hampir_pasti.png");
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
		font-size:.9em;
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
</style>

<script>
	// BEGIN MAP MATRIX
	var app = angular.module("myApp", ['riskMatrix']);

	app.controller("myCtrl", function($scope){
	    $scope.data = {};

	    $scope.data.risks = <?php echo $jsonRowsData; ?>
	    
	    $scope.data.impactValues = [
	        '','A','B','C','D','E'
	    ];

	    $scope.data.probabilityValues = [
	        '','1','2','3','4','5'
	    ];
	    
	    $scope.data.riskTemplate = '<div class="closed"><span ng-bind="\'\'+item.Id"></span></div><div class="open"><div class="title" ng-bind="item.Title"></div><div ng-bind="\'#\'+item.Description"></div><div ng-bind="\'#\'+item.RiskValue"></div></div>';
	    
	});
	
	function showEventLeader(risk_item_id){
		$.ajax({
            url: "<?php echo site_url('report/risk_map/get_event_detail');?>",
            type: "POST",
            data: {risk_item_id:risk_item_id,type:"gm",tahun:<?php echo $tahun?>},
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
<?php endif;?>

<?php if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_BOD || $this->session->userdata('role_id')==GROUP_RISK_LEADERS):?>
<div class="row">
	<!-- BEGIN TOP RISK REGISTER DATATABLE -->
	<div class="col-md-6 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-blue-steel bold uppercase">TOP 10</span>
					<span class="caption-helper">Corporate Risk</span>
				</div>
				<div class="tools">
					<!-- <a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a> -->
					<a href="javascript:;" class="fullscreen"></a>
				</div>
			</div>
			<div class="portlet-body" style="height: 535px;">
				<!-- BEGIN CONDENSED TABLE PORTLET-->
				<div>
					<table class="table table-condensed table-hover table-scrollable table-responsive" style="v-align:middle !important">
					<thead>
					<tr>
						<th>
							No
						</th>
						<th>
							Risk Register
						</th>
						<th>
							Risk Number
						</th>
						<th>
							Risk Level
						</th>
						<th>
							Trend
						</th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($top_risk)>0){?>
					<?php $i_top = 1; foreach($top_risk as $risk_item_id=>$val){?>
					<tr>
						<td>
							<?php echo $i_top++;?>
						</td>
						<td>
							<font color="blue" onclick="showEvent(<?php echo $risk_item_id;?>)"><?php echo $val['data']->risk_item_name?></font>
						</td>
						<td>
							<?php echo $val['data']->risk_item_number?>
						</td>
						<td>
							<?php echo $val['data']->level_name?>
						</td>
						<td>
							<img src="<?php echo base_url() ?>assets/img/risk_icon/<?php echo $val['icon']?>" class="" alt="">
						</td>
					</tr>
					<?php if($i_top>10){break;}}?>
					<?php }?>
					</tbody>
					</table>
					
					<div style="text-align:center;">
						<a href="#" class="label label-success" onclick="modal_top_all();">Show All</a>
					</div>
				</div>
				<!-- END CONDENSED TABLE PORTLET-->
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
	<!-- END TOP RISK REGISTER DATATABLE -->
	<!-- BEGIN RADAR CHART -->
	<div class="col-md-6 col-sm-6">
		<!-- BEGIN CHART PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title tabbable-line">
				<div class="caption">
					<span class="caption-subject font-blue-steel bold">TOP RISK</span>
					<span class="caption-helper">by Category</span>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_top_10" data-toggle="tab" aria-expanded="true">TOP 10</a></li>
					<li class=""><a href="#tab_top_corporate" data-toggle="tab" aria-expanded="false">Corporate</a></li>
				</ul>
				<!-- <div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
					<a href="javascript:;" class="fullscreen"></a>
				</div> -->
			</div>
			<div class="portlet-body" style="height: 535px !important;text-align:center;">
				<div class="tab-content">
					<div class="tab-pane active" id="tab_top_10">
						<div class="svg-container" style="font-size:10px !important;">
							<svg version="1.1" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" id="svg-radar-top">
								<!-- circle -->
						        <circle cx="250" cy="250" r="200" fill="#3FC380"/>
							    <circle cx="250" cy="250" r="150" fill="#E9D460"/>
							    <circle cx="250" cy="250" r="100" fill="#E87E04"/>
							    <circle cx="250" cy="250" r="50" fill="#F03434"/>

							    <!-- separator lines -->
							    <line x1="250" y1="250" x2="450" y2="225" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="405" y2="405" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="180" y2="450" style="stroke:white;stroke-width:2" />
								<line x1="250" y1="250" x2="45" y2="270" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="90" y2="90" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="315" y2="45" style="stroke:white;stroke-width:2" />
							   	
							   	<!-- radar legend -->
							   	<text x="443" y="400" fill="black" transform="rotate(285, 443, 400)" style="font-weight:bold;font-size:13px;" opacity="0.9">SAFETY & SECURITY RISK</text>
							    <text x="260" y="475" fill="black" transform="rotate(-10, 260, 475)" style="font-weight:bold;font-size:13px;" opacity="0.9">FINANCE RISK</text>
							    <text x="33" y="335" fill="black" transform="rotate(55, 33, 335)" style="font-weight:bold;font-size:13px;" opacity="0.9">COMPLIANCE RISK</text>
								<text x="34" y="220" fill="black" transform="rotate(290, 34, 220)" style="font-weight:bold;font-size:13px;" opacity="0.9">BUSINESS RISK</text>
							    <text x="145" y="60" fill="black" transform="rotate(343, 145, 60)" style="font-weight:bold;font-size:13px;" opacity="0.9">STRATEGIC RISK</text>
							    <text x="385" y="80" fill="black" transform="rotate(53, 385, 80)" style="font-weight:bold;font-size:13px;" opacity="0.9">OPERATION RISK</text>

							    <!-- data point -->
							   	<?php foreach($risk_radar_top_data as $rr){?> 
							  	<g onclick="showEvent(<?php echo $rr['risk_item_id'];?>)">
							    	<circle cx="<?php echo $rr['x']?>" cy="<?php echo $rr['y']?>" r="<?php echo $rr['radius']?>" fill="#000000" opacity="0.9"/>
							    	<a><text x="<?php echo $rr['x_text']?>" y="<?php echo $rr['y_text']?>" fill="black"><?php echo $rr['number']?></text></a>
								</g>
							   	<?php }?> 				   
							</svg>
						</div>
					</div>
					<div class="tab-pane" id="tab_top_corporate">
						<div class="svg-container">
							<svg version="1.1" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" id="svg-radar">
								<!-- circle -->
						        <circle cx="250" cy="250" r="200" fill="#3FC380"/>
							    <circle cx="250" cy="250" r="150" fill="#E9D460"/>
							    <circle cx="250" cy="250" r="100" fill="#E87E04"/>
							    <circle cx="250" cy="250" r="50" fill="#F03434"/>

							    <!-- separator lines -->
							    <line x1="250" y1="250" x2="450" y2="225" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="405" y2="405" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="180" y2="450" style="stroke:white;stroke-width:2" />
								<line x1="250" y1="250" x2="45" y2="270" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="90" y2="90" style="stroke:white;stroke-width:2" />
							    <line x1="250" y1="250" x2="315" y2="45" style="stroke:white;stroke-width:2" />
							   	
							   	<!-- radar legend -->
							   	<text x="443" y="400" fill="black" transform="rotate(285, 443, 400)" style="font-weight:bold;font-size:13px;" opacity="0.9">SAFETY & SECURITY RISK</text>
							    <text x="260" y="475" fill="black" transform="rotate(-10, 260, 475)" style="font-weight:bold;font-size:13px;" opacity="0.9">FINANCE RISK</text>
							    <text x="33" y="335" fill="black" transform="rotate(55, 33, 335)" style="font-weight:bold;font-size:13px;" opacity="0.9">COMPLIANCE RISK</text>
								<text x="34" y="220" fill="black" transform="rotate(290, 34, 220)" style="font-weight:bold;font-size:13px;" opacity="0.9">BUSINESS RISK</text>
							    <text x="145" y="60" fill="black" transform="rotate(343, 145, 60)" style="font-weight:bold;font-size:13px;" opacity="0.9">STRATEGIC RISK</text>
							    <text x="385" y="80" fill="black" transform="rotate(53, 385, 80)" style="font-weight:bold;font-size:13px;" opacity="0.9">OPERATION RISK</text>

							    <!-- data point -->
							   	<?php foreach($risk_radar as $rr){?> 
							   	<g onclick="open_info('<?php echo $rr['level']?>','<?php echo $rr['alias']?>')">
							    	<circle cx="<?php echo $rr['x']?>" cy="<?php echo $rr['y']?>" r="<?php echo $rr['radius']?>" fill="#000000" opacity="0.9"/>
							    	<a><text x="<?php echo $rr['x_text']?>" y="<?php echo $rr['y_text']?>" fill="black"><?php echo $rr['count']?>n</text></a>
								</g>
							   	<?php }?> 				   
							</svg>
						</div>
						<div style="text-align:center; font-weight:bold">
							<a href="#">n = Total Risiko</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END CHART PORTLET-->
	</div>
	<!-- END RADAR CHART -->
</div>
<div class="clearfix">
</div>

<?php if($this->session->userdata('role_id')!=GROUP_RISK_LEADERS):?>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-share font-blue-steel hide"></i>
					<span class="caption-subject font-blue-steel bold uppercase">Risk</span>
					<span class="caption-helper">by Directorate</span>
				</div>
				<div class="tools">
					<!-- <a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a> -->
					<a href="javascript:;" class="fullscreen"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="task-content">
					<div class="scroller" style="width:100%;height:305px;" id="risk_directorate_pie"></div>
				</div>
				<div class="summary_directorate_pie" style="text-align:center;"></div>
				<div style="font-weight:bold; text-align:center !important;">(On Monitor)</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-share font-blue-steel hide"></i>
					<span class="caption-subject font-blue-steel bold uppercase">Risk</span>
					<span class="caption-helper">by Factors</span>
				</div>
				<div class="tools">
					<!-- <a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a> -->
					<a href="javascript:;" class="fullscreen"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="task-content">
					<div class="scroller" style="height: 305px;" id="risk_function_pie"></div>
				</div>
				<div class="summary_function_pie" style="text-align:center;"></div>
				<div style="font-weight:bold; text-align:center !important;">(On Monitor)</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>

<div class="clearfix">
</div>
<div class="row">
	<!-- BEGIN BAR CHART -->
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN CHART PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title tabbable-line">
				<div class="caption">
					<span class="caption-subject font-blue-steel bold">RISK CHART</span>
					<span class="caption-helper">Identification & Mitigation</span>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_chart" data-toggle="tab" aria-expanded="true">Chart</a></li>
					<li class=""><a href="#tab_rekapitulasi" data-toggle="tab" aria-expanded="false">Table</a></li>
				</ul>

				<!-- <div class="caption">
					<span class="caption-subject font-blue-steel bold uppercase">RISK CHART</span>
					<span class="caption-helper">Identification & Mitigation</span>
				</div> -->
				<!-- <div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
					<a href="javascript:;" class="fullscreen"></a>
				</div> -->
			</div>
			<div class="portlet-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab_chart">
						<canvas id="myChart" style="width:100%;height:500px;"></canvas>
					</div>
					<div class="tab-pane" id="tab_rekapitulasi">
						<center><b><h4>REKAPITULASI RISK ASSESSMENT PT ANGKASA PURA II (PERSERO)</h4></b></center>
						<center><b><h4>TAHUN <?php echo $tahun?></h4></b></center>
						<div class="overFlowTable">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="text-center">
									<th rowspan="3">No</th>
									<th rowspan="3">Branch - Office</th>
									<th rowspan="3">Pelaksanaan</th>
									<th colspan="12" bgcolor="8EA9DB">Hasil Risk Assessment (per Risk Category)</th>
									<th rowspan="2" bgcolor="8EA9DB" colspan="3">RISK ASSESSMENT<br/>(by Risk Register)</th>
									<th rowspan="2" colspan="3" bgcolor="#A9D08E">RISK ASSESSMENT<br/>(by Risk Event)</th>
									<th rowspan="2" colspan="3" bgcolor="#A9D08E">REALISASI MITIGASI<br/>(by Risk Event)</th>
									<th rowspan="2" colspan="2" bgcolor="#FFE699">PROGRES MITIGASI<br/>(by Risk Event)</th>
									<th rowspan="3" bgcolor="#FFE699">Persentase<br/>(%)</th>
								</tr>

								<tr>
									<th colspan="6" bgcolor="8EA9DB">OPSTEK</th>
									<th colspan="6" bgcolor="8EA9DB">ADKOM</th>
								</tr>

								<tr>
									<th bgcolor="8EA9DB">SR</th>
									<th bgcolor="8EA9DB">OR</th>
									<th bgcolor="8EA9DB">SSR</th>
									<th bgcolor="8EA9DB">FR</th>
									<th bgcolor="8EA9DB">CR</th>
									<th bgcolor="8EA9DB">BR</th>
									<th bgcolor="8EA9DB">SR</th>
									<th bgcolor="8EA9DB">OR</th>
									<th bgcolor="8EA9DB">SSR</th>
									<th bgcolor="8EA9DB">FR</th>
									<th bgcolor="8EA9DB">CR</th>
									<th bgcolor="8EA9DB">BR</th>
									<th bgcolor="8EA9DB">OPSTEK</th>
									<th bgcolor="8EA9DB">ADKOM</th>
									<th bgcolor="8EA9DB">TOTAL</th>
									<th bgcolor="#A9D08E">OPSTEK</th>
									<th bgcolor="#A9D08E">ADKOM</th>
									<th bgcolor="#A9D08E">TOTAL</th>
									<th bgcolor="#A9D08E">OPSTEK</th>
									<th bgcolor="#A9D08E">ADKOM</th>
									<th bgcolor="#A9D08E">TOTAL</th>
									<th bgcolor="#FFE699">Termitigasi</th>
									<th bgcolor="#FFE699">Belum Termitigasi</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
								
								$i=1; 
								$OPSTEK_SR 							= 0;
								$OPSTEK_OR 							= 0;
								$OPSTEK_SSR 						= 0;
								$OPSTEK_FR 							= 0;
								$OPSTEK_CR 							= 0;
								$OPSTEK_BR 							= 0;
								$ADKOM_SR 							= 0;
								$ADKOM_OR 							= 0;
								$ADKOM_SSR 							= 0;
								$ADKOM_FR 							= 0;
								$ADKOM_CR 							= 0;
								$ADKOM_BR 							= 0;
								$RISK_REGISTER_OPSTEK 				= 0;
								$RISK_REGISTER_ADKOM 				= 0;
								$RISK_REGISTER_TOTAL 				= 0;
								$RISK_EVENT_TERIDENTIFIKASI_OPSTEK 	= 0;
								$RISK_EVENT_TERIDENTIFIKASI_ADKOM 	= 0;
								$RISK_EVENT_TERIDENTIFIKASI_TOTAL 	= 0;
								$RISK_EVENT_TERMITIGASI_OPSTEK 		= 0;
								$RISK_EVENT_TERMITIGASI_ADKOM 		= 0;
								$RISK_EVENT_TERMITIGASI_TOTAL 		= 0;
								$TERMITIGASI_TOTAL 					= 0;
								$BELUM_TERMITIGASI_TOTAL 			= 0;;

								foreach($rekapitulasi as $rek){
								$presentase 							= 0;
								$total_summary_risk_category 			= $rek['OPSTEK']['summary_risk_category'] + $rek['ADKOM']['summary_risk_category'];
								$total_summary_risk_event_identifikasi 	= $rek['OPSTEK']['summary_risk_event_identifikasi'] + $rek['ADKOM']['summary_risk_event_identifikasi'];
								$total_summary_risk_event_mitigasi 		= $rek['OPSTEK']['summary_risk_event_mitigasi'] + $rek['ADKOM']['summary_risk_event_mitigasi'];
								$total_belum_termitigasi 				= $total_summary_risk_event_identifikasi - $total_summary_risk_event_mitigasi;
								
								if($total_summary_risk_event_mitigasi > 0 AND $total_summary_risk_event_identifikasi > 0){
								$presentase				 				= number_format(($total_summary_risk_event_mitigasi / $total_summary_risk_event_identifikasi) * 100, 2, '.', '');
								}
								
								?>
								<tr>
									<td><?php echo $i++?></td>
									<td><?php echo $rek['code']?></td>
									<td><?php echo date("j F Y", strtotime($rek['start_date']))." - ".date("j F Y", strtotime($rek['end_date']))?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['SR']?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['OR']?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['SSR']?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['FR']?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['CR']?></td>
									<td bgcolor="#C6E0B4"><?php echo $rek['OPSTEK']['per_risk_category']['BR']?></td>

									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['SR']?></td>
									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['OR']?></td>
									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['SSR']?></td>
									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['FR']?></td>
									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['CR']?></td>
									<td bgcolor="#F8CBAD"><?php echo $rek['ADKOM']['per_risk_category']['BR']?></td>

									<td bgcolor="#A9D08E"><?php echo $rek['OPSTEK']['summary_risk_category']?></td>
									<td bgcolor="#F4B084"><?php echo $rek['ADKOM']['summary_risk_category']?></td>
									<td bgcolor="#FFFF00"><b><?php echo $total_summary_risk_category;?></b></td>

									<td bgcolor="#D9D9D9"><?php echo $rek['OPSTEK']['summary_risk_event_identifikasi']?></td>
									<td bgcolor="#D9D9D9"><?php echo $rek['ADKOM']['summary_risk_event_identifikasi']?></td>
									<td bgcolor="#FFFF00"><b><?php echo $total_summary_risk_event_identifikasi?></b></td>

									<td bgcolor="#D9D9D9"><?php echo $rek['OPSTEK']['summary_risk_event_mitigasi']?></td>
									<td bgcolor="#D9D9D9"><?php echo $rek['ADKOM']['summary_risk_event_mitigasi']?></td>
									<td bgcolor="#FFFF00"><b><?php echo $total_summary_risk_event_mitigasi?></b></td>

									<td bgcolor="#D9D9D9"><?php echo $total_summary_risk_event_mitigasi?></td>
									<td bgcolor="#D9D9D9"><?php echo $total_belum_termitigasi?></td>
									<td bgcolor="#D9D9D9"><?php echo $presentase;?></td>
								</tr>
								<?php 
								$OPSTEK_SR 							+= $rek['OPSTEK']['per_risk_category']['SR'];
								$OPSTEK_OR 							+= $rek['OPSTEK']['per_risk_category']['OR'];
								$OPSTEK_SSR 						+= $rek['OPSTEK']['per_risk_category']['SSR'];
								$OPSTEK_FR 							+= $rek['OPSTEK']['per_risk_category']['FR'];
								$OPSTEK_CR 							+= $rek['OPSTEK']['per_risk_category']['CR'];
								$OPSTEK_BR 							+= $rek['OPSTEK']['per_risk_category']['BR'];
								$ADKOM_SR 							+= $rek['ADKOM']['per_risk_category']['SR'];
								$ADKOM_OR 							+= $rek['ADKOM']['per_risk_category']['OR'];
								$ADKOM_SSR 							+= $rek['ADKOM']['per_risk_category']['SSR'];
								$ADKOM_FR 							+= $rek['ADKOM']['per_risk_category']['FR'];
								$ADKOM_CR 							+= $rek['ADKOM']['per_risk_category']['CR'];
								$ADKOM_BR 							+= $rek['ADKOM']['per_risk_category']['BR'];
								$RISK_REGISTER_OPSTEK 				+= $rek['OPSTEK']['summary_risk_category'];
								$RISK_REGISTER_ADKOM 				+= $rek['ADKOM']['summary_risk_category'];
								$RISK_REGISTER_TOTAL 				+= $total_summary_risk_category;
								$RISK_EVENT_TERIDENTIFIKASI_OPSTEK 	+= $rek['OPSTEK']['summary_risk_event_identifikasi'];
								$RISK_EVENT_TERIDENTIFIKASI_ADKOM 	+= $rek['ADKOM']['summary_risk_event_identifikasi'];
								$RISK_EVENT_TERIDENTIFIKASI_TOTAL 	+= $total_summary_risk_event_identifikasi;
								$RISK_EVENT_TERMITIGASI_OPSTEK 		+= $rek['OPSTEK']['summary_risk_event_mitigasi'];
								$RISK_EVENT_TERMITIGASI_ADKOM 		+= $rek['ADKOM']['summary_risk_event_mitigasi'];
								$RISK_EVENT_TERMITIGASI_TOTAL 		+= $total_summary_risk_event_mitigasi;
								$TERMITIGASI_TOTAL 					+= $total_summary_risk_event_mitigasi;
								$BELUM_TERMITIGASI_TOTAL 			+= $total_belum_termitigasi;
								}?>

								<tr>
									<td colspan="25">&nbsp;</td>
								</tr>

								<tr>
									<td colspan="3" class="text-center"><b>Total</b></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_SR?></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_OR?></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_SSR?></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_FR?></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_CR?></td>
									<td bgcolor="#C6E0B4"><?php echo $OPSTEK_BR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_SR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_OR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_SSR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_FR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_CR?></td>
									<td bgcolor="#F8CBAD"><?php echo $ADKOM_BR?></td>
									<td bgcolor="#A9D08E"><?php echo $RISK_REGISTER_OPSTEK?></td>
									<td bgcolor="#F4B084"><?php echo $RISK_REGISTER_ADKOM?></td>
									<td bgcolor="#FFFF00"><b><?php echo $RISK_REGISTER_TOTAL?></b></td>
									<td bgcolor="#D9D9D9"><?php echo $RISK_EVENT_TERIDENTIFIKASI_OPSTEK?></td>
									<td bgcolor="#D9D9D9"><?php echo $RISK_EVENT_TERIDENTIFIKASI_ADKOM?></td>
									<td bgcolor="#FFFF00"><b><?php echo $RISK_EVENT_TERIDENTIFIKASI_TOTAL?></b></td>
									<td bgcolor="#D9D9D9"><?php echo $RISK_EVENT_TERMITIGASI_OPSTEK?></td>
									<td bgcolor="#D9D9D9"><?php echo $RISK_EVENT_TERMITIGASI_ADKOM?></td>
									<td bgcolor="#FFFF00"><b><?php echo $RISK_EVENT_TERMITIGASI_TOTAL?></b></td>
									<td bgcolor="#D9D9D9"><b><?php echo $TERMITIGASI_TOTAL?></b></td>
									<td bgcolor="#D9D9D9"><b><?php echo $BELUM_TERMITIGASI_TOTAL?></b></td>
									<td bgcolor="#D9D9D9"><b><?php echo number_format(($RISK_EVENT_TERMITIGASI_TOTAL / $RISK_EVENT_TERIDENTIFIKASI_TOTAL) * 100, 2, '.', '') ?></b></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<!-- END CHART PORTLET-->
	</div>
	<!-- END BAR CHART -->
<div>
<div class="row">
	<!-- BEGIN PETA RISIKO -->
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN REGIONAL STATS PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-blue-steel bold uppercase">RISK MAP</span>
					<span class="caption-helper">By Area</span>
				</div>
				<div class="tools">
					<!-- <a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a> -->
					<a href="javascript:;" class="fullscreen"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="risk-maps" style="height: 535px;width: 100%;"></div>
				<!-- <div id="risk-vmap-indonesia" class="vmaps" style="height: 535px;width: 100%;"></div> -->
			</div>
		</div>
		<!-- END REGIONAL STATS PORTLET-->
	</div>
	<!-- END PETA RISIKO -->
</div>

<div class="clearfix">
</div>

<div id="risk-radar-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Risk By Category Detail</b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td><b>RISK NUMBER</b></td>
							<td><b>RISK REGISTER</b></td>
							<td><b>RISK LEVEL</b></td>
						</tr>
					</thead>

					<tbody>
						<?php 
						foreach($risk_radar_table as $risk_level => $risk_level_value){
							foreach($risk_level_value as $risk_alias => $risk_alias_value){
								foreach($risk_alias_value['data'] as $val){
						?>
						<div class="<?php echo $risk_level?>" style="display:none;">
						<tr class="<?php echo $risk_alias?>" style="display:none;">
							<td><?php echo $val[1]?></td>
							<td><font color="blue" onclick="showEvent(<?php echo $val[0]?>)"><?php echo $val[2]?></font></td>
							<td><?php echo $risk_level?></td>
						</tr>
						<?php }}}?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<div id="top-risk-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>TOP Corporate Risk</b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-condensed table-hover table-scrollable table-responsive" style="v-align:middle !important">
					<thead>
						<tr>
							<th>
								No
							</th>
							<th>
								Risk Register
							</th>
							<th>
								Risk Number
							</th>
							<th>
								Risk Level
							</th>
							<th>
								Trend
							</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($top_risk)>0){?>
						<?php $i_top = 1; foreach($top_risk as $risk_item_id=>$val){?>
						<tr>
							<td>
								<?php echo $i_top++;?>
							</td>
							<td>
								<font color="blue" onclick="showEvent(<?php echo $risk_item_id;?>)"><?php echo $val['data']->risk_item_name?></font>
							</td>
							<td>
								<?php echo $val['data']->risk_item_number?>
							</td>
							<td>
								<?php echo $val['data']->level_name?>
							</td>
							<td>
								<img src="<?php echo base_url() ?>assets/img/risk_icon/<?php echo $val['icon']?>" class="" alt="">
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<div id="risk-monitoring-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Detail Risk Register : <span id="event_name_detail"></span></b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td width="20px"><b>NO</b></td>
							<td><b>BRANCH / OFFICE</b></td>
							<td><b>PERISTIWA RISIKO</b></td>
							<td><b>PENYEBAB</b></td>
							<td><b>DAMPAK</b></td>
							<td width="40px"><b>K</b></td>
							<td width="40px"><b>D</b></td>
						</tr>
					</thead>

					<tbody id="risk-monitoring-content">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<div id="risk-monitoring-branch-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b id="modal-monitoring-branch"></b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="hidden-xs" rowspan="2">NO</th>
							<th class="hidden-xs" rowspan="2">RISK REGISTER</th>
							<th class="hidden-xs" rowspan="2">PERISTIWA RISIKO</th>
							<th class="hidden-xs" rowspan="2">PENYEBAB</th>
							<th class="hidden-xs" rowspan="2">DAMPAK</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">PENGENDALIAN YANG SUDAH DILAKUKAN</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">RENCANA PENGENDALIAN YANG AKAN DILAKUKAN</th>
							<th class="hidden-xs" rowspan="2">PIC (UNIT KERJA)</th>
							<th class="hidden-xs" rowspan="2">TARGET WAKTU</th>
							<th class="hidden-xs" rowspan="2">REALISASI MITIGASI</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" colspan="2">LEVEL</th>
							<th class="hidden-xs" rowspan="2">JUMLAH RISIKO TER IDENTIFIKASI</th>
							<th class="hidden-xs" rowspan="2">JUMLAH RISIKO TERMITIGASI</th>
							<th class="hidden-xs" rowspan="2">PIC (KANTOR PUSAT)</th>
							<th class="hidden-xs" rowspan="2">KATEGORI RISK</th>
							<th class="hidden-xs" rowspan="2">KATEGORI</th>
						</tr>

						<tr>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
							<th class="hidden-xs">K</th>
							<th class="hidden-xs">D</th>
						</tr>
					</thead>

					<tbody id="risk-monitoring-branch-content">
						<?php foreach($data_maps_table as $unit_id => $data_maps){?>
							<?php
							$teridentifikasi = 0;
							$termitigasi = 0;
							$summary = array();

							$no = 1;
							foreach ($data_maps as $risk_item_id => $row):
								$risk_item = $CI->risk_item_model->get_by_id($risk_item_id);
							?>
							<?php
								$temp = 1;
								foreach($row['data'] as $d){
									$mitigation = $CI->risk_mitigation_model->get_data($d->RISK_IDENTIFICATION_ID);
							?>
							<tr class="unit_maps_<?php echo $unit_id?>" style="display:none;">
								<td><?php echo $no++; ?></td>
								<?php if($temp==1){?>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->name; ?></td>
								<?php } ?>
								<td><a href="<?php echo site_url('report/risk_assessment_report/view/' . $d->RISK_IDENTIFICATION_ID . '/3'); ?>" target="_blank"><font color="blue"><?php echo $d->HAZARD?></font></a></td>
								<td><?php echo $d->PENYEBAB?></td>
								<td><?php echo $d->DAMPAK?></td>
								<td><?php echo $CI->risk_probability_model->get_by_id($d->INHERENT_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $CI->risk_impact_model->get_by_id($d->INHERENT_RISK_D_ID)->alphabet;?></td>
								<td><?php echo $d->PENGENDALIAN_YANG_TELAH_DILAKUKAN; ?></td>
								<td><?php echo $CI->risk_probability_model->get_by_id($d->RESIDUAL_RISK_K_ID)->rating_value;?></td>
								<td><?php echo $CI->risk_impact_model->get_by_id($d->RESIDUAL_RISK_D_ID)->alphabet;?></td>
								<?php 
									if($temp==1){
										$risk_rank_inherent = explode(",", $row['nilai_perlakuan']);
								?>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_rank_inherent[0]; ?></td>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_rank_inherent[1]; ?></td>
								<?php }?>
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
								<td><?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$CI->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name."</li>";
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
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												if($mitigation[$i]->REALISASI_MITIGASI!=""){
													echo "<li>".$mitigation[$i]->REALISASI_MITIGASI."</li>";
												}
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<td><?php echo $CI->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value; ?></td>
								<td><?php echo $CI->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet; ?></td>
								<?php 
									if($temp==1){
										$risk_rank_mitigasi = explode(",", $row['nilai_mitigasi']);
								?>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_rank_mitigasi[0]; ?></td>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_rank_mitigasi[1]; ?></td>
								<?php }?>
								<td><?php echo $d->TERIDENTIFIKASI;?></td>
								<td><?php echo $d->TERMITIGASI;?></td>
								<td>
									<?php
										if($mitigation){
											echo "<ol>";
											for ($i=0; $i <= count($mitigation)-1; $i++) { 
												echo "<li>".$CI->risk_pic_model->get_by_id($mitigation[$i]->PIC_KANTOR_PUSAT_ID)->name."</li>";
											}
											echo "</ol>";
										}else{
											echo "Not Set";
										}
									?>
								</td>
								<?php if($temp==1){?>
								<td rowspan="<?php echo count($row['data'])?>" style="vertical-align:middle !important"><?php echo $risk_item->description; ?></td>
								<?php $temp++;}?>
								<td>
									<?php
										$category_risk = $CI->risk_category_model->get_by_id($d->RISK_CATEGORY_ID)->name;
										echo $category_risk;
									?>
								</td>
							</tr>
							<?php 
									$teridentifikasi += $d->TERIDENTIFIKASI;
									$termitigasi += $d->TERMITIGASI;

									if(array_key_exists($category_risk, $summary)){
										$summary[$category_risk]['teridentifikasi'] += $d->TERIDENTIFIKASI;
										$summary[$category_risk]['termitigasi'] += $d->TERMITIGASI;
									}else{
										$summary[$category_risk]['teridentifikasi'] = $d->TERIDENTIFIKASI;
										$summary[$category_risk]['termitigasi'] = $d->TERMITIGASI;
									}
								}
							?>
							<?php endforeach; ?>
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

<div id="risk-directorate-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Risk Directorate : <span id="directorate_name_detail"></span></b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td width="20px"><b>NO</b></td>
							<td><b>BRANCH / OFFICE</b></td>
							<td><b>RISK REGISTER</b></td>
							<td><b>PERISTIWA RISIKO</b></td>
							<td><b>PENYEBAB</b></td>
							<td><b>DAMPAK</b></td>
							<td width="40px"><b>K</b></td>
							<td width="40px"><b>D</b></td>
						</tr>
					</thead>

					<tbody id="risk-directorate-content">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<div id="risk-function-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Risk Factor : <span id="function_name_detail"></span></b></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr align="center">
							<td width="20px"><b>NO</b></td>
							<td><b>BRANCH / OFFICE</b></td>
							<td><b>RISK REGISTER</b></td>
							<td><b>PERISTIWA RISIKO</b></td>
							<td><b>PENYEBAB</b></td>
							<td><b>DAMPAK</b></td>
							<td width="40px"><b>K</b></td>
							<td width="40px"><b>D</b></td>
						</tr>
					</thead>

					<tbody id="risk-function-content">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/global/plugins/osm/leaflet.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/global/plugins/osm/leaflet.label.css"/>
<script src="<?php echo base_url() ?>assets/global/plugins/osm/leaflet.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/osm/leaflet.label.js"></script>

<style type="text/css">
	.modal-dialog {
		overflow-y: initial !important;
    	overflow-x: initial !important;
	}

	.modal-body{
	    height: 500px;
	    overflow-y: auto;
	    overflow-x: auto;
	}

   .labels {
     color: black;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 11px;
     font-weight: bold;
     text-align: center;
     width: 70px;
     border: 1px solid black;
     white-space: nowrap;
   }

   a[title='JavaScript charts'] { display: none!important; }

   .svg-container { 
		display: inline-block;
		position: relative;
		width: 100%;
		vertical-align: middle; 
		overflow: hidden; 
	}

	@media only screen and (min-width : 1501px) {
		.svg-container { 
			display: inline-block;
			position: relative;
			width: 60%;
			vertical-align: middle; 
			overflow: hidden; 
		}
	}

	.dashboard-stat .more {
		opacity: 0 !important;
	}

	.table > thead > tr > th {
		border-bottom:2px solid #DDDDDD;
		vertical-align:middle;
	}
	th {
		text-align:center;
	}

	.overFlowTable{
		width: 100%;
		overflow: auto; 
	}

	.link_icon a {
	    color: #000000 !important;
	    text-decoration: none;
	}

	.leaflet-container a {
	     color: #000000 !important; 
	}
</style>

<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBUUz2XJq_rXW81MBvAfp84ld_AQPMvE4k"></script> -->
<!-- <script src="<?php //echo base_url() ?>assets/global/plugins/MarkerWithLabel.js"></script> -->

<script type="text/javascript">
var global_unit_id;
function show_monitoring(unit_id)
{
	global_unit_id=unit_id;
	
	$.ajax({
        url: "<?php echo site_url('welcome/get_event_branch_risk');?>",
        type: "POST",
        data: {unit_id:unit_id, tahun:<?php echo $tahun?>},
        dataType  : 'json',
        success: function (branch_name) {
            $("#modal-monitoring-branch").html(branch_name)
            $('.unit_maps_'+unit_id).show();
			$('#risk-monitoring-branch-modal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

$('#risk-monitoring-branch-modal').on('hidden.bs.modal', function () {
    $('.unit_maps_'+global_unit_id).hide();
});

$(document).ready(function () {

	/*BEGIND BAR CHART*/
	var ctx = document.getElementById("myChart");
	var barChartData = {
        labels: <?php echo json_encode($barchart_label)?>,
        datasets: [{
            label: 'Identified Risk',
            backgroundColor: 'rgb(239, 67, 65)',
            data: <?php echo json_encode($barchart_teridentifikasi)?>
        }, 
        {
            label: 'Mitigated Risk',
            backgroundColor: 'rgb(85, 176, 71)',
            data: <?php echo json_encode($barchart_termitigasi)?>
        }]

    };

	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: barChartData,
	    options: {
	    	scales: {
			    yAxes: [{
			        ticks: {
			            beginAtZero: true
			        }
			    }],
			    xAxes: [{
				    ticks: {
				        autoSkip: false,
				        //maxTicksLimit: 20
				    }
				}]
			},
	    	legend: {
		        position: 'bottom',
		    },
	        tooltips: {
	            mode: 'index',
	            intersect: false
	        },
	        responsive: true,
	    }
	});
	/*END STACKED CHART*/

	/*BEGIN RISK MAP*/
	var data_marker = JSON.parse('<?php echo json_encode($map_risiko)?>');
	var osmUrl 		= ' http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
	osmTiles 		= new L.TileLayer(osmUrl, {maxZoom: 18}),
	map 			= new L.Map('risk-maps', {layers: [osmTiles], center: new L.LatLng(-1.616836,113.867503), zoom: 5 });

	for (var i=0; i<=data_marker.length-1; i++) {
    	plotMarker(data_marker[i]);
    }

    function plotMarker(data_marker)
	{	
		var icon = L.divIcon({
            className: 'hidden-icon',
            iconAnchor: [20, 20],
            iconSize: [40, 40]
        });
		
		L.marker([data_marker.lat, data_marker.lon],{icon:icon}).bindLabel('<a class="link_icon" href="javascript:show_monitoring('+data_marker.unit_id+');">'+data_marker.label+'</a>', { noHide: true }).addTo(map);
	}

 //    var position = {lat: -0.175780974247085, lng: 119.8828125};
 //    var map = new google.maps.Map(document.getElementById('risk-maps'), {
 //    	zoom: 5,
 //       	center: new google.maps.LatLng(-0.175780974247085, 119.8828125),
 //       	mapTypeId: google.maps.MapTypeId.ROADMAP
 //    });
    
 //    var data_marker = JSON.parse('<?php //echo json_encode($map_risiko)?>');
 //    var bounds 		= new google.maps.LatLngBounds();

 //    for (var i=0; i<=data_marker.length-1; i++) {
 //    	plotMarker(data_marker[i]);
 //    }
    
 //    function plotMarker(data_marker)
	// {
	// 	var marker = new MarkerWithLabel({
	//        position: new google.maps.LatLng(data_marker.lat, data_marker.lon),
	//        draggable: false,
	//        raiseOnDrag: true,
	//        map: map,
	//        title: data_marker.title,
	//        icon: '<?php //echo base_url() ?>assets/img/transparent.png',
	//        labelContent: data_marker.label,
	//        labelAnchor: new google.maps.Point(35, 0),
	//        labelClass: "labels", // the CSS class for the label
	//        labelStyle: {opacity: 0.75},
	//     });

 //    	google.maps.event.addListener(marker, 'click', function() {
	// 	    show_monitoring(data_marker.unit_id);
 //    	});

	//     bounds.extend(marker.position);
	// }


    //now fit the map to the newly inclusive bounds
	// map.setCenter(bounds.getCenter());
	// map.fitBounds(bounds);
    
	/*END RISK GOOGLE MAP*/

	/*BEGIN PIE CHART DIRECTORATE*/
	function handleClickDirectorate(event)
	{
	    show_event_directorate(event.dataItem.dataContext.directorate_id,1);
	}

	var chartDirectorate = AmCharts.makeChart( "risk_directorate_pie", {
	  "type": "pie",
	  "hideCredits":false,
	  "theme": "light",
	  "dataProvider": <?php echo json_encode($directorate_pie)?>,
	  "valueField": "value",
	  "titleField": "directorate",
	  "outlineAlpha": 0.4,
	  "depth3D": 1,
	  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
	  "angle": 0,
	  "export": {
	    "enabled": true
	  },
	  "colorField": "color",
  	  "labelColorField": "color",
	});

	chartDirectorate.addListener("clickSlice", handleClickDirectorate);

	for(var i = 0; i < chartDirectorate.dataProvider.length; i++) {
		var dp = chartDirectorate.dataProvider[i];
		var legend = "<span onclick='show_event_directorate("+dp.directorate_id+",0)' style='font-weight:bold;color:"+dp.color + "'>" + dp.directorate + " : " + dp.total_monitored + "&nbsp;&nbsp;</span> ";
		$(".summary_directorate_pie").append(legend);
	}

	/*END PIE CHART DIRECTORATE*/

	/*BEGIN PIE CHART FUNCTION*/
	function handleClickFunction(event)
	{
	    show_event_function(event.dataItem.dataContext.function_id,1);
	}

	var chartFunction = AmCharts.makeChart( "risk_function_pie", {
	  "type": "pie",
	  "hideCredits":false,
	  "theme": "light",
	  "dataProvider": <?php echo json_encode($classification_pie)?>,
	  "valueField": "value",
	  "titleField": "function",
	  "outlineAlpha": 0.4,
	  "depth3D": 1,
	  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
	  "angle": 0,
	  "export": {
	    "enabled": true
	  },
	  "colorField": "color",
  	  "labelColorField": "color",
	});

	chartFunction.addListener("clickSlice", handleClickFunction);
	
	for(var i = 0; i < chartFunction.dataProvider.length; i++) {
		var dp = chartFunction.dataProvider[i];
		var legend = "<span onclick='show_event_function("+dp.function_id+",0)' style='font-weight:bold;color:"+dp.color + "'>" + dp.function + " : " + dp.total_monitored + "&nbsp;&nbsp;</span> ";
		$(".summary_function_pie").append(legend);
	}
	/*END PIE CHART FUNCTION*/
});

/*BEGIN RISK RADAR*/
var last_level;
var last_alias;

function open_info(level, alias){
	last_level = level;
	last_alias = alias;
	
	$("."+level).show();
	$("."+alias).show();
	$("#risk-radar-modal").modal('show');
}

$("#risk-radar-modal").on('hidden.bs.modal', function () {
    $("."+last_level).hide();
	$("."+last_alias).hide();
})
/*END RISK RADAR*/

/*BEGIN TOP RISK MODAL*/
function modal_top_all()
{
	$("#top-risk-modal").modal('show');
}

function showEvent(risk_item_id)
{
	$("#unit_maps_"+risk_item_id).show();
	$('#risk-monitoring-modal').modal('show');

	$.ajax({
        url: "<?php echo site_url('welcome/get_event_detail_risk');?>",
        type: "POST",
        data: {risk_item_id:risk_item_id, tahun:<?php echo $tahun?>},
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
            	"<td>"+res.risk_k+"</td>"+
            	"<td>"+res.risk_d+"</td></tr>";

            	event_name_detail = res.risk_name;
            }
            $("#event_name_detail").html(event_name_detail);
            $("#risk-monitoring-content").html(dataTable);
            $('#risk-monitoring-modal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

function show_event_directorate(directorate_id, status_dokumen){
	$.ajax({
        url: "<?php echo site_url('welcome/get_event_directorate');?>",
        type: "POST",
        data: {directorate_id:directorate_id, status_dokumen:status_dokumen, tahun:<?php echo $tahun?>},
        dataType  : 'json',
        success: function (response) {
            var dataTable = "";
            var no = 0;
            var directorate_name = "";
            for (i = 0; i < response.length; ++i) {
            	var res = response[i];
            	no++;

            	dataTable += "<tr>"+
            	"<td>"+no+"</td>"+
            	"<td>"+res.unit_name+"</td>"+
            	"<td>"+res.risk_item_name+"</td>"+
            	"<td>"+res.hazard+"</td>"+
            	"<td>"+res.penyebab+"</td>"+
            	"<td>"+res.dampak+"</td>"+
            	"<td>"+res.risk_k+"</td>"+
            	"<td>"+res.risk_d+"</td></tr>";

            	directorate_name = res.risk_directorate_name;
            }
            $("#directorate_name_detail").html(directorate_name);
            $("#risk-directorate-content").html(dataTable);
            $('#risk-directorate-modal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

function show_event_function(function_id, status_dokumen){
	$.ajax({
        url: "<?php echo site_url('welcome/get_event_function');?>",
        type: "POST",
        data: {function_id:function_id, status_dokumen:status_dokumen, tahun:<?php echo $tahun?>},
        dataType  : 'json',
        success: function (response) {
            var dataTable = "";
            var no = 0;
            var function_name = "";
            for (i = 0; i < response.length; ++i) {
            	var res = response[i];

            	console.log(res);
            	no++;

            	dataTable += "<tr>"+
            	"<td>"+no+"</td>"+
            	"<td>"+res.unit_name+"</td>"+
            	"<td>"+res.risk_item_name+"</td>"+
            	"<td>"+res.hazard+"</td>"+
            	"<td>"+res.penyebab+"</td>"+
            	"<td>"+res.dampak+"</td>"+
            	"<td>"+res.risk_k+"</td>"+
            	"<td>"+res.risk_d+"</td></tr>";

            	function_name = res.risk_classification_name;
            }
            $("#function_name_detail").html(function_name);
            $("#risk-function-content").html(dataTable);
            $('#risk-function-modal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}
/*END TOP RISK MODAL*/
</script>
<?php endif;?>

<script type="text/javascript">
$(document).ready(function () {
	$("#tahun_laporan_select").on('change', function(){
		var url = "<?php echo site_url('welcome/index_corporate').'?tahun='; ?>"+$(this).val();
		window.location.replace(url);
	});

	/* $("#status_select").on('change', function(){
		var url = "<?php //echo site_url('welcome').'?tahun='; ?>"+$('#tahun_laporan_select').val()+"<?php //echo '&stat='; ?>"+$(this).val();
		window.location.replace(url);
	}); */

	//Begin JQuery V Map
	jQuery('#risk-vmap-indonesia').vectorMap(
	{
	    map: 'world_en',
	    backgroundColor: '#a5bfdd',
	    borderColor: '#818181',
	    borderOpacity: 0.25,
	    borderWidth: 1,
	    color: '#f4f3f0',
	    enableZoom: true,
	    hoverColor: '#c9dfaf',
	    hoverOpacity: null,
	    normalizeFunction: 'linear',
	    scaleColors: ['#b6d6ff', '#005ace'],
	    selectedColor: '#c9dfaf',
	    selectedRegions: null,
	    showTooltip: true,
	    onRegionClick: function(element, code, region)
	    {
	        var message = 'You clicked "'
	            + region
	            + '" which has the code: '
	            + code.toUpperCase();
	 
	        alert(message);
	    }
	});
	//End JQuery V Map
});
</script>