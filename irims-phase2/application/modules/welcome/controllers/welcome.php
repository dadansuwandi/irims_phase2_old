<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Show welcome message.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class Welcome extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('risk/risk_identification_model');
        $this->load->model('report/risk_map_model');
        $this->load->model('master/unit_model');
        $this->load->model('master/risk_directorate_model');
        $this->load->model('master/risk_classification_model');
        $this->load->model('master/target_pencapaian_model');
        $this->load->model('master/risk_category_model');
        $this->load->model('master/risk_model');
        $this->load->model('master/risk_value_model');
        $this->load->model('master/risk_pic_model');
        $this->load->model('master/risk_probability_model');
    	$this->load->model('master/risk_impact_model');
    	//$this->load->model('master/risk_item_model');

		$this->load->model('risk/risk_identification_pic_model');
		$this->load->model('risk/risk_mitigation_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_dokumen_model');
		$this->load->model('master/risk_item_model');
		$this->load->model('master/risk_kpi_model');
		$this->load->model('master/risk_level_model');
		$this->load->model('risk/log_model');
		$this->load->model('master/indicator_model');
		$this->load->model('kri/key_risk_indicator_model');
		$this->load->model('kri/key_risk_indicator_threshold_model');
        $this->load->model('kri/key_risk_indicator_threshold_value_model');

		$this->load->language('welcome');
	}

	private function generateDot($level, $alias)
	{
		$coordinate_array = array(
			'Very High'=>array(
				'XR'=>array('X'=>290,'Y'=>270),
				'FR'=>array('X'=>255,'Y'=>283),
				'CR'=>array('X'=>233,'Y'=>263),
				'SR'=>array('X'=>249,'Y'=>223),
				'OR'=>array('X'=>287,'Y'=>235),
				'BR'=>array('X'=>215,'Y'=>235),
			),
			'High'=>array(
				'XR'=>array('X'=>321,'Y'=>294),
				'FR'=>array('X'=>236,'Y'=>324),
				'CR'=>array('X'=>190,'Y'=>253),
				'SR'=>array('X'=>238,'Y'=>184),
				'OR'=>array('X'=>318,'Y'=>207),
				'BR'=>array('X'=>245,'Y'=>205),
			),
			'Medium'=>array(
				'XR'=>array('X'=>362,'Y'=>326),
				'FR'=>array('X'=>221,'Y'=>371),
				'CR'=>array('X'=>136,'Y'=>252),
				'SR'=>array('X'=>221,'Y'=>134),
				'OR'=>array('X'=>354,'Y'=>172),
				'BR'=>array('X'=>277,'Y'=>173),
			),
			'Low'=>array(
				'XR'=>array('X'=>404,'Y'=>353),
				'FR'=>array('X'=>205,'Y'=>417),
				'CR'=>array('X'=>86,'Y'=>251),
				'SR'=>array('X'=>202,'Y'=>93),
				'OR'=>array('X'=>393,'Y'=>135),
				'BR'=>array('X'=>311,'Y'=>139),
			)
		);

		$coordinate = $coordinate_array[$level][$alias];

		return array($coordinate['X'], $coordinate['Y']);
	}

	private function generateDotTop($level, $alias, $temp)
	{
		$coordinate_array = array(
			'Very High'=>array(
				'XR'=>array(
					array('X'=>295,'Y'=>261),
					array('X'=>292,'Y'=>276),
					array('X'=>269,'Y'=>255),
					array('X'=>279,'Y'=>284),
					array('X'=>274,'Y'=>268),
				),
				'FR'=>array(
					array('X'=>254,'Y'=>278),
					array('X'=>232,'Y'=>281),
					array('X'=>257,'Y'=>262),
					array('X'=>250,'Y'=>290),
					array('X'=>245,'Y'=>268),
				),
				'CR'=>array(
					array('X'=>231,'Y'=>259),
					array('X'=>210,'Y'=>243),
					array('X'=>215,'Y'=>252),
					array('X'=>211,'Y'=>262),
					array('X'=>213,'Y'=>274),
				),
				'SR'=>array(
					array('X'=>249,'Y'=>224),
					array('X'=>249,'Y'=>205),
					array('X'=>253,'Y'=>213),
					array('X'=>232,'Y'=>219),
					array('X'=>251,'Y'=>233),
				),
				'OR'=>array(
					array('X'=>272,'Y'=>236),
					array('X'=>297,'Y'=>235),
					array('X'=>277,'Y'=>223),
					array('X'=>299,'Y'=>223),
					array('X'=>282,'Y'=>209),
				),
				'BR'=>array(
					array('X'=>215,'Y'=>240),
					array('X'=>230,'Y'=>255),
					array('X'=>245,'Y'=>270),
					array('X'=>260,'Y'=>285),
					array('X'=>275,'Y'=>300),
				),
			),
			'High'=>array(
				'XR'=>array(
					array('X'=>331,'Y'=>256),
					array('X'=>321,'Y'=>270),
					array('X'=>312,'Y'=>288),
					array('X'=>293,'Y'=>301),
					array('X'=>298,'Y'=>318),
					array('X'=>323,'Y'=>279),
					array('X'=>325,'Y'=>301),
					array('X'=>300,'Y'=>329)
				),
				'FR'=>array(
					array('X'=>235,'Y'=>307),
					array('X'=>254,'Y'=>319),
					array('X'=>262,'Y'=>333),
					array('X'=>225,'Y'=>323),
					array('X'=>201,'Y'=>307),
					array('X'=>213,'Y'=>295),
					array('X'=>229,'Y'=>335),
					array('X'=>261,'Y'=>306)
				),
				'CR'=>array(
					array('X'=>178,'Y'=>213),
					array('X'=>184,'Y'=>226),
					array('X'=>185,'Y'=>242),
					array('X'=>174,'Y'=>262),
					array('X'=>187,'Y'=>279),
					array('X'=>191,'Y'=>268),
					array('X'=>189,'Y'=>250),
					array('X'=>204,'Y'=>218)
				),
				'SR'=>array(
					array('X'=>240,'Y'=>160),
					array('X'=>212,'Y'=>174),
					array('X'=>250,'Y'=>174),
					array('X'=>235,'Y'=>186),
					array('X'=>206,'Y'=>195),
					array('X'=>218,'Y'=>205),
					array('X'=>254,'Y'=>194),
					array('X'=>265,'Y'=>162)
				),
				'OR'=>array(
					array('X'=>295,'Y'=>178),
					array('X'=>322,'Y'=>198),
					array('X'=>326,'Y'=>233),
					array('X'=>316,'Y'=>215),
					array('X'=>289,'Y'=>195),
					array('X'=>300,'Y'=>163),
					array('X'=>313,'Y'=>186),
					array('X'=>337,'Y'=>221)
				),
				'BR'=>array(
					array('X'=>170,'Y'=>240),
					array('X'=>150,'Y'=>255),
					array('X'=>130,'Y'=>270),
					array('X'=>110,'Y'=>285),
					array('X'=>90,'Y'=>300),
					array('X'=>70,'Y'=>315),
					array('X'=>50,'Y'=>330),
					array('X'=>30,'Y'=>345)
				),
			),
		);
	
		if(empty($temp)){
			$coordinate = $coordinate_array[$level][$alias][0];
			return array($coordinate['X'], $coordinate['Y']);
		}else{
			$coordinate = $coordinate_array[$level][$alias];
			
			foreach($coordinate as $coor){
				$check = false;

				foreach($temp as $t){
					if($t['x']==$coor['X'] && $t['y']==$coor['Y']){
						$check = true;
						break;
					}
				}

				if(!$check){
					return array($coor['X'], $coor['Y']);
				}
			}
		} 
	}

	private function generateDotTopBUMN($level, $alias, $temp)
	{
		$coordinate_array = array(
			'Very High'=>array(
				'XR'=>array(
					array('X'=>295,'Y'=>261),
					array('X'=>292,'Y'=>276),
					array('X'=>269,'Y'=>255),
					array('X'=>279,'Y'=>284),
					array('X'=>274,'Y'=>268),
				),
				'FR'=>array(
					array('X'=>254,'Y'=>278),
					array('X'=>232,'Y'=>281),
					array('X'=>257,'Y'=>262),
					array('X'=>250,'Y'=>290),
					array('X'=>245,'Y'=>268),
				),
				'CR'=>array(
					array('X'=>231,'Y'=>259),
					array('X'=>210,'Y'=>243),
					array('X'=>215,'Y'=>252),
					array('X'=>211,'Y'=>262),
					array('X'=>213,'Y'=>274),
				),
				'SR'=>array(
					array('X'=>249,'Y'=>224),
					array('X'=>249,'Y'=>205),
					array('X'=>253,'Y'=>213),
					array('X'=>232,'Y'=>219),
					array('X'=>251,'Y'=>233),
				),
				'OR'=>array(
					array('X'=>272,'Y'=>236),
					array('X'=>297,'Y'=>235),
					array('X'=>277,'Y'=>223),
					array('X'=>299,'Y'=>223),
					array('X'=>282,'Y'=>209),
				),
				'BR'=>array(
					array('X'=>215,'Y'=>240),
					array('X'=>230,'Y'=>255),
					array('X'=>245,'Y'=>270),
					array('X'=>260,'Y'=>285),
					array('X'=>275,'Y'=>300),
				),
			),
			'High'=>array(
				'XR'=>array(
					array('X'=>331,'Y'=>256),
					array('X'=>321,'Y'=>270),
					array('X'=>312,'Y'=>288),
					array('X'=>293,'Y'=>301),
					array('X'=>298,'Y'=>318),
					array('X'=>323,'Y'=>279),
					array('X'=>325,'Y'=>301),
					array('X'=>300,'Y'=>329)
				),
				'FR'=>array(
					array('X'=>235,'Y'=>307),
					array('X'=>254,'Y'=>319),
					array('X'=>262,'Y'=>333),
					array('X'=>225,'Y'=>323),
					array('X'=>201,'Y'=>307),
					array('X'=>213,'Y'=>295),
					array('X'=>229,'Y'=>335),
					array('X'=>261,'Y'=>306)
				),
				'CR'=>array(
					array('X'=>178,'Y'=>213),
					array('X'=>184,'Y'=>226),
					array('X'=>185,'Y'=>242),
					array('X'=>174,'Y'=>262),
					array('X'=>187,'Y'=>279),
					array('X'=>191,'Y'=>268),
					array('X'=>189,'Y'=>250),
					array('X'=>204,'Y'=>218)
				),
				'SR'=>array(
					array('X'=>240,'Y'=>160),
					array('X'=>212,'Y'=>174),
					array('X'=>250,'Y'=>174),
					array('X'=>235,'Y'=>186),
					array('X'=>206,'Y'=>195),
					array('X'=>218,'Y'=>205),
					array('X'=>254,'Y'=>194),
					array('X'=>265,'Y'=>162)
				),
				'OR'=>array(
					array('X'=>295,'Y'=>178),
					array('X'=>322,'Y'=>198),
					array('X'=>326,'Y'=>233),
					array('X'=>316,'Y'=>215),
					array('X'=>289,'Y'=>195),
					array('X'=>300,'Y'=>163),
					array('X'=>313,'Y'=>186),
					array('X'=>337,'Y'=>221)
				),
				'BR'=>array(
					array('X'=>170,'Y'=>240),
					array('X'=>150,'Y'=>255),
					array('X'=>130,'Y'=>270),
					array('X'=>110,'Y'=>285),
					array('X'=>90,'Y'=>300),
					array('X'=>70,'Y'=>315),
					array('X'=>50,'Y'=>330),
					array('X'=>30,'Y'=>345)
				),
			),
			'Medium'=>array(
				'XR'=>array(
					array('X'=>351,'Y'=>256),
					array('X'=>341,'Y'=>270),
					array('X'=>332,'Y'=>288),
					array('X'=>313,'Y'=>301),
					array('X'=>318,'Y'=>318)
				),
				'FR'=>array(
					array('X'=>235,'Y'=>357),
					array('X'=>254,'Y'=>369),
					array('X'=>262,'Y'=>383),
					array('X'=>225,'Y'=>373),
					array('X'=>201,'Y'=>357)
				),
				'CR'=>array(
					array('X'=>168,'Y'=>213),
					array('X'=>164,'Y'=>226),
					array('X'=>165,'Y'=>242),
					array('X'=>154,'Y'=>262),
					array('X'=>167,'Y'=>279)
				),
				'SR'=>array(
					array('X'=>240,'Y'=>140),
					array('X'=>212,'Y'=>154),
					array('X'=>250,'Y'=>154),
					array('X'=>235,'Y'=>166),
					array('X'=>206,'Y'=>175)
				),
				'OR'=>array(
					array('X'=>315,'Y'=>178),
					array('X'=>342,'Y'=>198),
					array('X'=>346,'Y'=>233),
					array('X'=>336,'Y'=>215),
					array('X'=>309,'Y'=>195)
				),
				'BR'=>array(
					array('X'=>140,'Y'=>240),
					array('X'=>130,'Y'=>255),
					array('X'=>110,'Y'=>270),
					array('X'=>90,'Y'=>285),
					array('X'=>70,'Y'=>300)
				),
			),
			'Low'=>array(
				'XR'=>array(
					array('X'=>371,'Y'=>256),
					array('X'=>361,'Y'=>270),
					array('X'=>352,'Y'=>288),
					array('X'=>333,'Y'=>301),
					array('X'=>338,'Y'=>318)
				),
				'FR'=>array(
					array('X'=>235,'Y'=>407),
					array('X'=>254,'Y'=>419),
					array('X'=>262,'Y'=>433),
					array('X'=>225,'Y'=>423),
					array('X'=>201,'Y'=>407)
				),
				'CR'=>array(
					array('X'=>148,'Y'=>213),
					array('X'=>144,'Y'=>226),
					array('X'=>145,'Y'=>242),
					array('X'=>134,'Y'=>262),
					array('X'=>147,'Y'=>279)
				),
				'SR'=>array(
					array('X'=>240,'Y'=>120),
					array('X'=>212,'Y'=>134),
					array('X'=>250,'Y'=>134),
					array('X'=>235,'Y'=>146),
					array('X'=>206,'Y'=>155)
				),
				'OR'=>array(
					array('X'=>335,'Y'=>178),
					array('X'=>362,'Y'=>198),
					array('X'=>366,'Y'=>233),
					array('X'=>356,'Y'=>215),
					array('X'=>329,'Y'=>195)
				),
				'BR'=>array(
					array('X'=>120,'Y'=>240),
					array('X'=>110,'Y'=>255),
					array('X'=>90,'Y'=>270),
					array('X'=>70,'Y'=>285),
					array('X'=>50,'Y'=>300)
				),
			),
		);
	
		if(empty($temp)){
			$coordinate = $coordinate_array[$level][$alias][0];
			return array($coordinate['X'], $coordinate['Y']);
		}else{
			$coordinate = $coordinate_array[$level][$alias];
			
			foreach($coordinate as $coor){
				$check = false;

				foreach($temp as $t){
					if($t['x']==$coor['X'] && $t['y']==$coor['Y']){
						$check = true;
						break;
					}
				}

				if(!$check){
					return array($coor['X'], $coor['Y']);
				}
			}
		} 
	}

	private function check_rangking($risk_item_id, $rangking, $rowTemp)
    {
        if($rowTemp == array()){
            return array(false, false, false);
        }else{
            foreach ($rowTemp as $key => $val) {
                if(intval($val['RiskItemiId']) == intval($risk_item_id)){
                    if(intval($rangking) < intval($val['Rangking'])){
                        return array(true, true, $key);
                    }else{
                        return array(true, false, false);
                    }
                }
            }
            return array(false, false, false);
        }
    }

	public function index()
	{
		/***********************************
		***		 DASHBOARD FUNCTION      ***
		***********************************/
		$tahun = date('Y');
		if(isset($_GET['tahun'])){
			$tahun = $_GET['tahun'];
		}

		$this->data['tahun'] = $tahun;

		/* if($_GET['stat']=="Y"){
            $stat = 1;
        }elseif($_GET['stat']=="N") {
            $stat = 0;
        }else{
            $stat = "";
        }

        $this->data['stat'] = $stat; */

		/*BEGIN NOTIFICATIONS*/
		$this->data['pending_risk']    		= $this->risk_identification_model->count_by_status(array(STATUS_DRAFT,STATUS_APPROVE_ASSESSMENT,STATUS_CONFIRM));
		$this->data['onprogress_risk'] 		= $this->risk_identification_model->count_by_status(array(STATUS_ON_MONITORING,STATUS_MITIGATION));
		$this->data['done_risk'] 	   		= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATED));
		$this->data['assessment_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_APPROVE_ASSESSMENT), true);
		$this->data['mitigation_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATION), true);
		/*END NOTIFICATIONS*/

		if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
			/*BEGIN TOP RISK REGISTER*/
			$top_risk 		  	 = array();
			$risk_radar 	  	 = array();
			$risk_directorate 	 = array();
			$risk_classification = array();
			$sum_teridentifikasi = 0;
			$sum_termitigasi  	 = 0;
			$rekapitulasi 		 = null;

			$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TAHUN = '.$tahun)
	       	//->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
	        ->order_by('rangking','asc')
	        ->get();
			// echo $this->db->last_query();exit;

	        if($query->num_rows() > 0){
	        	$rekapitulasi = $query->result();

	        	foreach($query->result() as $top){
	        		if($top->status_dokumen != 6){
		        		if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI){
			        		if(!array_key_exists($top->risk_item_id, $top_risk)){
			        			$top_risk[$top->risk_item_id]['data'] = $top;
			        			$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        		}else{
			        			if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
			        				$top_risk[$top->risk_item_id]['data'] = $top;
			        				$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        			}
			        		}
		        		}
	        		}

	    			/*populate data for pie chart directorate*/
	        		if(!array_key_exists($top->risk_directorate_id, $risk_directorate)){
	        			$risk_directorate[$top->risk_directorate_id]['total'] = 1;
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] = 0;
	        		}else{
	        			$risk_directorate[$top->risk_directorate_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] += 1;
	        		}

	        		/*populate data for pie chart classification*/
	        		if(!array_key_exists($top->risk_classification_id, $risk_classification)){
	        			$risk_classification[$top->risk_classification_id]['total'] = 1;
	        			$risk_classification[$top->risk_classification_id]['monitored'] = 0;
	        		}else{
	        			$risk_classification[$top->risk_classification_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_classification[$top->risk_classification_id]['monitored'] += 1;
	        		}
	     
	        		/*sum data*/
	    			$sum_teridentifikasi +=$top->teridentifikasi;
	    			$sum_termitigasi +=$top->termitigasi;
	        	}
	        	$risk_radar = $top_risk;
	        }
	       
	        $this->data['top_risk'] = $top_risk;
	        $this->data['sum_teridentifikasi'] = $sum_teridentifikasi;
	        $this->data['sum_termitigasi'] = $sum_termitigasi;
			/*END TOP RISK REGISTER*/

			/*BEGIN BAR CHART AND MAP RISIKO*/
			$label 			 = array();
			$teridentifikasi = array();
			$termitigasi 	 = array();

			$data_map_risk = array();

			$units = $this->unit_model->get_all_dashboard();

			foreach($units as $u){
				$label[] = $u->code;

				$query = $this->db->select("SUM(TERIDENTIFIKASI) AS total_teridentifikasi, SUM(TERMITIGASI) AS total_termitigasi")
		        ->from('tx_risk_identification')
		       	->where('STATUS_DOKUMEN_ID >= 4 AND TAHUN = '.$tahun.' AND UNIT_ID = '.$u->id)
		        ->get();

		        if($query->num_rows() > 0){
		        	$result = $query->result();
		        	
		        	$teridentifikasi[] = $result[0]->total_teridentifikasi;
		        	$termitigasi[] 	   = $result[0]->total_termitigasi;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi > 0){
			        		$pencapaian = round(($result[0]->total_termitigasi/$result[0]->total_teridentifikasi)*100, 2);
			        	}else if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi == 0){
			        		$pencapaian = 100;
			        	}else{
			        		$pencapaian = 0;
			        	}
			        	
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : '.$pencapaian.'%',
				        );
			        }
		        }else{
		        	$teridentifikasi[] = 0;
		        	$termitigasi[] 	   = 0;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : 0%',
				        );
			        }
		        }
			}

			$this->data['barchart_label'] 			= $label;
			$this->data['barchart_teridentifikasi'] = $teridentifikasi;
			$this->data['barchart_termitigasi'] 	= $termitigasi;

			$this->data['map_risiko'] = $data_map_risk;
			/*END BAR CHART*/

			/*BEGIN RISK RADAR TOP 10*/
			$risk_radar_top_data = array();

			$i_top = 1;
			foreach($risk_radar as $rr){
				list($coorx, $coory)= $this->generateDotTop($rr['data']->level_name, $rr['data']->risk_category_alias, $risk_radar_top_data);

				$coorx_text = $coorx + 4;
				$coory_text = $coory + 4;

				$risk_radar_top_data[] = array(
					'x'=>$coorx,
					'y'=>$coory,
					'x_text'=>$coorx_text,
					'y_text'=>$coory_text,
					'number'=>$rr['data']->risk_item_number,
					'risk_item_id'=>$rr['data']->risk_item_id,
					'radius'=>3,
				);

				$i_top++;

				if($i_top > 10){
					break;
				}
			}

			$this->data['risk_radar_top_data'] = $risk_radar_top_data;
			/*END RISK RADAR TOP 10*/

			/*BEGIN RISK RADAR*/
			$risk_radar_data_table  = array();
			$risk_radar_data 		= array();

			foreach($risk_radar as $risk_register_id => $rr){
				if($risk_radar_data_table!=array() and isset($risk_radar_data_table[$rr['data']->level_name])){
					if(!array_key_exists($rr['data']->risk_category_alias, $risk_radar_data_table[$rr['data']->level_name])){
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}else{
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] += 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}
				}else{
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
				}
			}

			
			$r=4;
			foreach($risk_radar_data_table as $level => $risk_data_table){
				foreach($risk_data_table as $alias => $value){
					list($coorx, $coory)= $this->generateDot($level, $alias);
					$coorx_text = $coorx + 7;
					$coory_text = $coory + 5;

					if($value['count']>5){
						$hasil = $value['count']/5;

						if($hasil>1 and $hasil<=2){
							$r+=2;
							$coorx_text+=2;
						}elseif ($hasil>2 and $hasil<=3) {
							$r+=4;
							$coorx_text+=4;
						}elseif ($hasil>3 and $hasil<=4) {
							$r+=6;
							$coorx_text+=6;
						}elseif ($hasil>4 and $hasil<=5) {
							$r+=8;
							$coorx_text+=8;
						}elseif ($hasil>5 and $hasil<=6) {
							$r+=10;
							$coorx_text+=10;
						}
					}

					$risk_radar_data[] = array(
						'x'=>$coorx,
						'y'=>$coory,
						'x_text'=>$coorx_text,
						'y_text'=>$coory_text,
						'count'=>$value['count'],
						'level'=>$level,
						'alias'=>$alias,
						'radius'=>$r,
					);
					
					/*reset*/
					$r=4;
				}
			}

			$this->data['risk_radar'] 		= $risk_radar_data;
			$this->data['risk_radar_table'] = $risk_radar_data_table;
			/*END RISK RADAR*/

			/*BEGIN DIRECTORATE PIE CHART*/
			$pie_directorate_data 	 = array();
			$riskDirectorateModel 	 = $this->risk_directorate_model->get_all();
			$summary_directorate_pie = 0;

			foreach($riskDirectorateModel as $rdm){
				if(!array_key_exists($rdm->id, $risk_directorate)){
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>0,
	    				'color'=>$rdm->color,
	    				'total_monitored'=>0,
	    			);
	    		}else{
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>$risk_directorate[$rdm->id]['total'],
	    				'color'=>$rdm->color,
	    				'total_monitored'=>$risk_directorate[$rdm->id]['monitored']
	    			);
	    		}
	    		$summary_directorate_pie++;
			}
			
			$this->data['directorate_pie'] 		   = $pie_directorate_data;
			$this->data['summary_directorate_pie'] = $summary_directorate_pie;
			/*END DIRECTORATE PIE CHART*/

			/*BEGIN CLASSIFICATION PIE CHART*/
			$pie_classification_data = array();
			$riskClassificationModel = $this->risk_classification_model->get_all();
			$summary_function_pie    = 0;

			foreach($riskClassificationModel as $rcm){
				if(!array_key_exists($rcm->id, $risk_classification)){
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>0,
	    				'color'=>$rcm->color,
	    				'total_monitored'=>0
	    			);
	    		}else{
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>$risk_classification[$rcm->id]['total'],
	    				'color'=>$rcm->color,
	    				'total_monitored'=>$risk_classification[$rcm->id]['monitored']
	    			);
	    		}
	    		$summary_function_pie++;
			}
			$this->data['summary_function_pie'] = $summary_function_pie;
			$this->data['classification_pie']   = $pie_classification_data;
			/*END CLASSIFICATION PIE CHART*/

			/*START RISK REKAPITULASI TABLE*/
			$array_risk_percategory  				= array();
			$array_risk_item_summary 				= array();
			$array_risk_per_event_summary  			= array();
			$array_risk_per_event_mitigasi_summary  = array();
			$data_rekapitulasi 						= array();

			if(isset($rekapitulasi)){
	        	foreach($rekapitulasi as $rekap){
	        		/*rekap per risk item*/
	        		if(!isset($array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] = 1;
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
	        			
	        			/*summary*/
	        			$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			if(!in_array($rekap->risk_item_id, $array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] += 1;
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
		        			
		        			/*summary*/
	        				$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
		        		}	
	        		}

	        		/*rekap per event summary teridentifikasi*/
	        		if(!isset($array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name])){
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}
		   
		        	/*rekap per event summary termitigasi*/
	        		if(!isset($array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name])){
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}else{
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}
	        	}        	
	        }

	        $risk_categories = $this->risk_category_model->get_all();
	        $risks 			 = $this->risk_model->get_all();

	        foreach($units as $u){
	        	$target = $this->target_pencapaian_model->get_by_unit_id($u->id, $tahun);
	        	
	        	$data_rekapitulasi[$u->id]['code'] = $u->code;
	        	
	        	if($target){
	        		$data_rekapitulasi[$u->id]['start_date'] = $target->start_date;
	        		$data_rekapitulasi[$u->id]['end_date'] = $target->end_date;
	        	}else{
	        		$data_rekapitulasi[$u->id]['start_date'] = null;
	        		$data_rekapitulasi[$u->id]['end_date'] = null;
	        	}

	        	foreach($risk_categories as $rc){
	        		foreach ($risks as $r) {
	        			if(isset($array_risk_percategory[$u->id][$rc->name."_".$r->name_alias])){
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = $array_risk_percategory[$u->id][$rc->name."_".$r->name_alias]['count'];
			        	}else{
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = 0;
			        	}
	        		}

	        		if(isset($array_risk_item_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = $array_risk_item_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = 0;
	        		}

	        		if(isset($array_risk_per_event_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = $array_risk_per_event_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = 0;
	        		}

	        		if(isset($array_risk_per_event_mitigasi_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = $array_risk_per_event_mitigasi_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = 0;
	        		}
	        	}
	        }
	        
	        $this->data['rekapitulasi'] = $data_rekapitulasi;
			/*END RISK REKAPITULASI TABLE*/
			
			/*PETA RISIKO RISK LEADERS*/
            $unit_id 		= $this->session->userdata('unit_id');
            $user_pic_ids 	= $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));

            $this->data['unit_report']  = $this->risk_model->get_by_unit_report($unit_id);

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);	
			$rows 	= $this->risk_identification_model->risk_map_monitoring_report($params);
			$resultRow = array();

			$i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_id, $row->risk_d_id);

                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Query*/
                    $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                    $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d,
                        'RiskProbability'     => $row->risk_k,
                        'RiskImpactId'        => $row->risk_d_id,
                        'RiskProbabilityId'   => $row->risk_k_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskValue'           => $riskLevelNames[0]->risk_levels
                    );
                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Query*/
                            $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                            $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d,
                                'RiskProbability'     => $row->risk_k,
                                'RiskImpactId'        => $row->risk_d_id,
                                'RiskProbabilityId'   => $row->risk_k_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskValue'           => $riskLevelNames[0]->risk_levels
                            );
                            $i++;
                        }
                    }else{
                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d,
                            'RiskProbability'     => $row->risk_k,
                            'RiskImpactId'        => $row->risk_d_id,
                            'RiskProbabilityId'   => $row->risk_k_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskValue'           => $riskLevelNames[0]->risk_levels
                        );
                        $i++;
                    }
                }
            }

            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $tahun,
                'user_pic_ids_search' => $user_pic_ids
            ));

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*BEGIN SUMMARY RISK LEADERS*/
            $query = $this->db->select("sum(tri.TERIDENTIFIKASI) as total_event, sum(tri.TERMITIGASI) as total_mitigasi")
	        ->from('tx_risk_identification as tri')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.UNIT_ID = '.$this->session->userdata('unit_id').' AND tri.TAHUN = '.$tahun)
	        ->get();

	        $sum_teridentifikasi_gm = 0;
	        $sum_termitigasi_gm 	= 0;

	      	if($query->num_rows() > 0){
	        	$result = $query->result();
	        	
	        	$sum_teridentifikasi_gm = $result[0]->total_event;
	        	$sum_termitigasi_gm 	= $result[0]->total_mitigasi;
	        }

	        $this->data['sum_teridentifikasi_gm'] 	= $sum_teridentifikasi_gm;
	        $this->data['sum_termitigasi_gm'] 		= $sum_termitigasi_gm;
	        /*END SUMMARY RISK LEADERS*/

	        /*BEGIN GOOGLE MAPS DATA*/
	        $maps_result = array();

	        foreach($units as $u){
	        	$result  = array();
            
	            $unit_id = $u->id;

	            $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

	            /*Risk Query Select*/
	            $rows = $this->risk_identification_model->get_risk_assessment_report($params);

	            if($rows){
	                foreach($rows as $row){
	                    $pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
	                    $pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

	                    $mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
	                    $mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

	                    $rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

	                    if(array_key_exists($row->RISK_ITEM_ID, $result)){
	                        $result[$row->RISK_ITEM_ID]['data'][] = $row;

	                        /*jika rangkingnya lebih besar*/
	                        if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
	                            $result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
	                            $result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
	                            $result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
	                        }

	                    }else{
	                        $result[$row->RISK_ITEM_ID] = array(
	                            'data'=>array($row),
	                            'rangking'=>$rangking,
	                            'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
	                            'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
	                        );
	                    }
	                }
	            }

	            $maps_result[$u->id] = $result;
	        }

	        /*echo "<pre/>";
	        var_dump($maps_result);die;*/
	        $this->data['data_maps_table'] = $maps_result;
	        /*END GOOGLE MAPS DATA*/
		}
		
		$this->template
			->load_module_partial('sections', 'welcome/hmvc/section_partial')
			/*Begin Flotchart*/
			->set_js_global('plugins/chartjs/Chart.min')
			->set_js_global('plugins/amcharts/amcharts/amcharts')
			->set_js_global('plugins/amcharts/amcharts/pie')
			->set_js_global('plugins/amcharts/amcharts/themes/light')
			->set_js_global('plugins/angularjs/angular.min')
            ->set_js_global('plugins/angularjs/angular-sanitize.min')
            ->set_js_global('plugins/angularjs/angular-touch.min')
            ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            ->set_js_global('plugins/angularjs/angular-risk-matrix')
            ->set_js_global('plugins/jspdf/jspdf.debug')
            ->set_js_global('plugins/html2canvas/html2canvas')
            ->set_js_global('plugins/riskchart/d3.min')
            ->set_js_global('plugins/riskchart/canvg')
            ->set_js_global('plugins/riskchart/riskchart')
            ->set_js_global('plugins/jqvmap/jqvmap/jquery.vmap')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.world')
            ->set_js_global('plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.indonesia')
			/*End Flotchart*/
			->build('welcome');
	}

	public function index_corporate()
	{
		/***********************************
		***		 DASHBOARD FUNCTION      ***
		***********************************/
		$tahun = date('Y');
		$tahunPrevious = $tahun-1;
		if(isset($_GET['tahun'])){
			$tahun = $_GET['tahun'];
			$tahunPrevious = $tahun-1;
		}

		$this->data['tahun'] = $tahun;

		/* if($_GET['stat']=="Y"){
            $stat = 1;
        }elseif($_GET['stat']=="N") {
            $stat = 0;
        }else{
            $stat = "";
        }

        $this->data['stat'] = $stat; */

		/*BEGIN NOTIFICATIONS*/
		$this->data['pending_risk']    		= $this->risk_identification_model->count_by_status(array(STATUS_DRAFT,STATUS_APPROVE_ASSESSMENT,STATUS_CONFIRM));
		$this->data['onprogress_risk'] 		= $this->risk_identification_model->count_by_status(array(STATUS_ON_MONITORING,STATUS_MITIGATION));
		$this->data['done_risk'] 	   		= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATED));
		$this->data['assessment_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_APPROVE_ASSESSMENT), true);
		$this->data['mitigation_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATION), true);
		/*END NOTIFICATIONS*/

		if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
			/*BEGIN TOP RISK REGISTER*/
			$top_risk 		  	 = array();
			$risk_radar 	  	 = array();
			$risk_directorate 	 = array();
			$risk_classification = array();
			$sum_teridentifikasi = 0;
			$sum_termitigasi  	 = 0;
			$rekapitulasi 		 = null;

			$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
			->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TAHUN = '.$tahun)
	       	//->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND (tri.TAHUN BETWEEN "'.$tahunPrevious.'" AND "'.$tahun.'")')
	       	//->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
			//->where('tri.TERMITIGASI = 0 AND TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_PUMR.'"')
	        ->order_by('rangking','asc')
	        ->get();
			

	        if($query->num_rows() > 0){
	        	$rekapitulasi = $query->result();

	        	foreach($query->result() as $top){
	        		if($top->status_dokumen != 6){
		        		if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI){
			        		if(!array_key_exists($top->risk_item_id, $top_risk)){
			        			$top_risk[$top->risk_item_id]['data'] = $top;
			        			$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        		}else{
			        			if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
			        				$top_risk[$top->risk_item_id]['data'] = $top;
			        				$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        			}
			        		}
		        		}
	        		}

	    			/*populate data for pie chart directorate*/
	        		if(!array_key_exists($top->risk_directorate_id, $risk_directorate)){
	        			$risk_directorate[$top->risk_directorate_id]['total'] = 1;
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] = 0;
	        		}else{
	        			$risk_directorate[$top->risk_directorate_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] += 1;
	        		}

	        		/*populate data for pie chart classification*/
	        		if(!array_key_exists($top->risk_classification_id, $risk_classification)){
	        			$risk_classification[$top->risk_classification_id]['total'] = 1;
	        			$risk_classification[$top->risk_classification_id]['monitored'] = 0;
	        		}else{
	        			$risk_classification[$top->risk_classification_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_classification[$top->risk_classification_id]['monitored'] += 1;
	        		}
	     
	        		/*sum data*/
	    			$sum_teridentifikasi +=$top->teridentifikasi;
	    			$sum_termitigasi +=$top->termitigasi;
	        	}
	        	$risk_radar = $top_risk;
	        }
	       
	        $this->data['top_risk'] = $top_risk;
	        $this->data['sum_teridentifikasi'] = $sum_teridentifikasi;
	        $this->data['sum_termitigasi'] = $sum_termitigasi - 1;
			/*END TOP RISK REGISTER*/

			/*BEGIN BAR CHART AND MAP RISIKO*/
			$label 			 = array();
			$teridentifikasi = array();
			$termitigasi 	 = array();

			$data_map_risk = array();

			$units = $this->unit_model->get_all_dashboard();

			foreach($units as $u){
				$label[] = $u->code;

				$query = $this->db->select("SUM(TERIDENTIFIKASI) AS total_teridentifikasi, SUM(TERMITIGASI) AS total_termitigasi")
		        ->from('tx_risk_identification')
				->where('STATUS_DOKUMEN_ID >= 4 AND TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_PUMR.'" AND TAHUN = '.$tahun.' AND UNIT_ID = '.$u->id)
		       	//->where('STATUS_DOKUMEN_ID >= 4 AND TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_PUMR.'" AND (TAHUN BETWEEN "'.$tahunPrevious.'" AND "'.$tahun.'") AND UNIT_ID = '.$u->id)
		        ->get();

		        if($query->num_rows() > 0){
		        	$result = $query->result();
		        	
		        	$teridentifikasi[] = $result[0]->total_teridentifikasi;
		        	$termitigasi[] 	   = $result[0]->total_termitigasi;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi > 0){
			        		$pencapaian = round(($result[0]->total_termitigasi/$result[0]->total_teridentifikasi)*100, 2);
			        	}else if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi == 0){
			        		$pencapaian = 100;
			        	}else{
			        		$pencapaian = 0;
			        	}
			        	
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : '.$pencapaian.'%',
				        );
			        }
		        }else{
		        	$teridentifikasi[] = 0;
		        	$termitigasi[] 	   = 0;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : 0%',
				        );
			        }
		        }
			}

			$this->data['barchart_label'] 			= $label;
			$this->data['barchart_teridentifikasi'] = $teridentifikasi;
			$this->data['barchart_termitigasi'] 	= $termitigasi;

			$this->data['map_risiko'] = $data_map_risk;
			/*END BAR CHART*/

			/*BEGIN RISK RADAR TOP 10*/
			$risk_radar_top_data = array();

			$i_top = 1;
			foreach($risk_radar as $rr){
				list($coorx, $coory)= $this->generateDotTop($rr['data']->level_name, $rr['data']->risk_category_alias, $risk_radar_top_data);

				$coorx_text = $coorx + 4;
				$coory_text = $coory + 4;

				$risk_radar_top_data[] = array(
					'x'=>$coorx,
					'y'=>$coory,
					'x_text'=>$coorx_text,
					'y_text'=>$coory_text,
					'number'=>$rr['data']->risk_item_number,
					'risk_item_id'=>$rr['data']->risk_item_id,
					'radius'=>3,
				);

				$i_top++;

				if($i_top > 10){
					break;
				}
			}

			$this->data['risk_radar_top_data'] = $risk_radar_top_data;
			/*END RISK RADAR TOP 10*/

			/*BEGIN RISK RADAR*/
			$risk_radar_data_table  = array();
			$risk_radar_data 		= array();

			foreach($risk_radar as $risk_register_id => $rr){
				if($risk_radar_data_table!=array() and isset($risk_radar_data_table[$rr['data']->level_name])){
					if(!array_key_exists($rr['data']->risk_category_alias, $risk_radar_data_table[$rr['data']->level_name])){
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}else{
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] += 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}
				}else{
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
				}
			}

			
			$r=4;
			foreach($risk_radar_data_table as $level => $risk_data_table){
				foreach($risk_data_table as $alias => $value){
					list($coorx, $coory)= $this->generateDot($level, $alias);
					$coorx_text = $coorx + 7;
					$coory_text = $coory + 5;

					if($value['count']>5){
						$hasil = $value['count']/5;

						if($hasil>1 and $hasil<=2){
							$r+=2;
							$coorx_text+=2;
						}elseif ($hasil>2 and $hasil<=3) {
							$r+=4;
							$coorx_text+=4;
						}elseif ($hasil>3 and $hasil<=4) {
							$r+=6;
							$coorx_text+=6;
						}elseif ($hasil>4 and $hasil<=5) {
							$r+=8;
							$coorx_text+=8;
						}elseif ($hasil>5 and $hasil<=6) {
							$r+=10;
							$coorx_text+=10;
						}
					}

					$risk_radar_data[] = array(
						'x'=>$coorx,
						'y'=>$coory,
						'x_text'=>$coorx_text,
						'y_text'=>$coory_text,
						'count'=>$value['count'],
						'level'=>$level,
						'alias'=>$alias,
						'radius'=>$r,
					);
					
					/*reset*/
					$r=4;
				}
			}

			$this->data['risk_radar'] 		= $risk_radar_data;
			$this->data['risk_radar_table'] = $risk_radar_data_table;
			/*END RISK RADAR*/

			/*BEGIN DIRECTORATE PIE CHART*/
			$pie_directorate_data 	 = array();
			$riskDirectorateModel 	 = $this->risk_directorate_model->get_all();
			$summary_directorate_pie = 0;

			foreach($riskDirectorateModel as $rdm){
				if(!array_key_exists($rdm->id, $risk_directorate)){
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>0,
	    				'color'=>$rdm->color,
	    				'total_monitored'=>0,
	    			);
	    		}else{
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>$risk_directorate[$rdm->id]['total'],
	    				'color'=>$rdm->color,
	    				'total_monitored'=>$risk_directorate[$rdm->id]['monitored']
	    			);
	    		}
	    		$summary_directorate_pie++;
			}
			
			$this->data['directorate_pie'] 		   = $pie_directorate_data;
			$this->data['summary_directorate_pie'] = $summary_directorate_pie;
			/*END DIRECTORATE PIE CHART*/

			/*BEGIN CLASSIFICATION PIE CHART*/
			$pie_classification_data = array();
			$riskClassificationModel = $this->risk_classification_model->get_all();
			$summary_function_pie    = 0;

			foreach($riskClassificationModel as $rcm){
				if(!array_key_exists($rcm->id, $risk_classification)){
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>0,
	    				'color'=>$rcm->color,
	    				'total_monitored'=>0
	    			);
	    		}else{
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>$risk_classification[$rcm->id]['total'],
	    				'color'=>$rcm->color,
	    				'total_monitored'=>$risk_classification[$rcm->id]['monitored']
	    			);
	    		}
	    		$summary_function_pie++;
			}
			$this->data['summary_function_pie'] = $summary_function_pie;
			$this->data['classification_pie']   = $pie_classification_data;
			/*END CLASSIFICATION PIE CHART*/

			/*START RISK REKAPITULASI TABLE*/
			$array_risk_percategory  				= array();
			$array_risk_item_summary 				= array();
			$array_risk_per_event_summary  			= array();
			$array_risk_per_event_mitigasi_summary  = array();
			$data_rekapitulasi 						= array();

			if(isset($rekapitulasi)){
	        	foreach($rekapitulasi as $rekap){
	        		/*rekap per risk item*/
	        		if(!isset($array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] = 1;
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
	        			
	        			/*summary*/
	        			$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			if(!in_array($rekap->risk_item_id, $array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] += 1;
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
		        			
		        			/*summary*/
	        				$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
		        		}	
	        		}

	        		/*rekap per event summary teridentifikasi*/
	        		if(!isset($array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name])){
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}
		   
		        	/*rekap per event summary termitigasi*/
	        		if(!isset($array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name])){
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}else{
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}
	        	}        	
	        }

	        $risk_categories = $this->risk_category_model->get_all();
	        $risks 			 = $this->risk_model->get_all();

	        foreach($units as $u){
	        	$target = $this->target_pencapaian_model->get_by_unit_id($u->id, $tahun);
	        	
	        	$data_rekapitulasi[$u->id]['code'] = $u->code;
	        	
	        	if($target){
	        		$data_rekapitulasi[$u->id]['start_date'] = $target->start_date;
	        		$data_rekapitulasi[$u->id]['end_date'] = $target->end_date;
	        	}else{
	        		$data_rekapitulasi[$u->id]['start_date'] = null;
	        		$data_rekapitulasi[$u->id]['end_date'] = null;
	        	}

	        	foreach($risk_categories as $rc){
	        		foreach ($risks as $r) {
	        			if(isset($array_risk_percategory[$u->id][$rc->name."_".$r->name_alias])){
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = $array_risk_percategory[$u->id][$rc->name."_".$r->name_alias]['count'];
			        	}else{
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = 0;
			        	}
	        		}

	        		if(isset($array_risk_item_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = $array_risk_item_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = 0;
	        		}

	        		if(isset($array_risk_per_event_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = $array_risk_per_event_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = 0;
	        		}

	        		if(isset($array_risk_per_event_mitigasi_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = $array_risk_per_event_mitigasi_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = 0;
	        		}
	        	}
	        }
	        
	        $this->data['rekapitulasi'] = $data_rekapitulasi;
			/*END RISK REKAPITULASI TABLE*/
			
			/*PETA RISIKO RISK LEADERS*/
            $unit_id 		= $this->session->userdata('unit_id');
            $user_pic_ids 	= $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));

            $this->data['unit_report']  = $this->risk_model->get_by_unit_report($unit_id);

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);	
			$rows 	= $this->risk_identification_model->risk_map_monitoring_report($params);
			$resultRow = array();

			$i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_id, $row->risk_d_id);

                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Query*/
                    $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                    $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d,
                        'RiskProbability'     => $row->risk_k,
                        'RiskImpactId'        => $row->risk_d_id,
                        'RiskProbabilityId'   => $row->risk_k_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskValue'           => $riskLevelNames[0]->risk_levels
                    );
                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Query*/
                            $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                            $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d,
                                'RiskProbability'     => $row->risk_k,
                                'RiskImpactId'        => $row->risk_d_id,
                                'RiskProbabilityId'   => $row->risk_k_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskValue'           => $riskLevelNames[0]->risk_levels
                            );
                            $i++;
                        }
                    }else{
                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d,
                            'RiskProbability'     => $row->risk_k,
                            'RiskImpactId'        => $row->risk_d_id,
                            'RiskProbabilityId'   => $row->risk_k_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskValue'           => $riskLevelNames[0]->risk_levels
                        );
                        $i++;
                    }
                }
            }

            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $tahun,
                'user_pic_ids_search' => $user_pic_ids
            ));

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*BEGIN SUMMARY RISK LEADERS*/
            $query = $this->db->select("sum(tri.TERIDENTIFIKASI) as total_event, sum(tri.TERMITIGASI) as total_mitigasi")
	        ->from('tx_risk_identification as tri')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.UNIT_ID = '.$this->session->userdata('unit_id').' AND tri.TAHUN = '.$tahun)
	        ->get();

	        $sum_teridentifikasi_gm = 0;
	        $sum_termitigasi_gm 	= 0;

	      	if($query->num_rows() > 0){
	        	$result = $query->result();
	        	
	        	$sum_teridentifikasi_gm = $result[0]->total_event;
	        	$sum_termitigasi_gm 	= $result[0]->total_mitigasi;
	        }

	        $this->data['sum_teridentifikasi_gm'] 	= $sum_teridentifikasi_gm;
	        $this->data['sum_termitigasi_gm'] 		= $sum_termitigasi_gm;
	        /*END SUMMARY RISK LEADERS*/

	        /*BEGIN GOOGLE MAPS DATA*/
	        $maps_result = array();

	        foreach($units as $u){
	        	$result  = array();
            
	            $unit_id = $u->id;

	            $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

	            /*Risk Query Select*/
	            $rows = $this->risk_identification_model->get_risk_assessment_report($params);

	            if($rows){
	                foreach($rows as $row){
	                    $pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
	                    $pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

	                    $mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
	                    $mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

	                    $rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

	                    if(array_key_exists($row->RISK_ITEM_ID, $result)){
	                        $result[$row->RISK_ITEM_ID]['data'][] = $row;

	                        /*jika rangkingnya lebih besar*/
	                        if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
	                            $result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
	                            $result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
	                            $result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
	                        }

	                    }else{
	                        $result[$row->RISK_ITEM_ID] = array(
	                            'data'=>array($row),
	                            'rangking'=>$rangking,
	                            'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
	                            'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
	                        );
	                    }
	                }
	            }

	            $maps_result[$u->id] = $result;
	        }

	        /*echo "<pre/>";
	        var_dump($maps_result);die;*/
	        $this->data['data_maps_table'] = $maps_result;
	        /*END GOOGLE MAPS DATA*/
		}
		
		$this->template
			->load_module_partial('sections', 'welcome/hmvc/section_partial')
			/*Begin Flotchart*/
			->set_js_global('plugins/chartjs/Chart.min')
			->set_js_global('plugins/amcharts/amcharts/amcharts')
			->set_js_global('plugins/amcharts/amcharts/pie')
			->set_js_global('plugins/amcharts/amcharts/themes/light')
			->set_js_global('plugins/angularjs/angular.min')
            ->set_js_global('plugins/angularjs/angular-sanitize.min')
            ->set_js_global('plugins/angularjs/angular-touch.min')
            ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            ->set_js_global('plugins/angularjs/angular-risk-matrix')
            ->set_js_global('plugins/jspdf/jspdf.debug')
            ->set_js_global('plugins/html2canvas/html2canvas')
            ->set_js_global('plugins/riskchart/d3.min')
            ->set_js_global('plugins/riskchart/canvg')
            ->set_js_global('plugins/riskchart/riskchart')
            ->set_js_global('plugins/jqvmap/jqvmap/jquery.vmap')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.world')
            ->set_js_global('plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.indonesia')
			/*End Flotchart*/
			->build('welcome_corporate');
	}

	public function index_residual()
	{
		/***********************************
		***		 DASHBOARD FUNCTION      ***
		***********************************/
		$tahun = date('Y');
		if(isset($_GET['tahun'])){
			$tahun = $_GET['tahun'];
		}

		$this->data['tahun'] = $tahun;

		/* if($_GET['stat']=="Y"){
            $stat = 1;
        }elseif($_GET['stat']=="N") {
            $stat = 0;
        }else{
            $stat = "";
        }

        $this->data['stat'] = $stat; */

		/*BEGIN NOTIFICATIONS*/
		$this->data['pending_risk']    		= $this->risk_identification_model->count_by_status(array(STATUS_DRAFT,STATUS_APPROVE_ASSESSMENT,STATUS_CONFIRM));
		$this->data['onprogress_risk'] 		= $this->risk_identification_model->count_by_status(array(STATUS_ON_MONITORING,STATUS_MITIGATION));
		$this->data['done_risk'] 	   		= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATED));
		$this->data['assessment_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_APPROVE_ASSESSMENT), true);
		$this->data['mitigation_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATION), true);
		/*END NOTIFICATIONS*/

		if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
			/*BEGIN TOP RISK REGISTER*/
			$top_risk 		  	 = array();
			$risk_radar 	  	 = array();
			$risk_directorate 	 = array();
			$risk_classification = array();
			$sum_teridentifikasi = 0;
			$sum_termitigasi  	 = 0;
			$rekapitulasi 		 = null;

			$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TAHUN = '.$tahun)
	       	//->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
	        ->order_by('rangking','asc')
	        ->get();

	        if($query->num_rows() > 0){
	        	$rekapitulasi = $query->result();

	        	foreach($query->result() as $top){
	        		if($top->status_dokumen != 6){
		        		if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI){
			        		if(!array_key_exists($top->risk_item_id, $top_risk)){
			        			$top_risk[$top->risk_item_id]['data'] = $top;
			        			$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        		}else{
			        			if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
			        				$top_risk[$top->risk_item_id]['data'] = $top;
			        				$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        			}
			        		}
		        		}
	        		}

	    			/*populate data for pie chart directorate*/
	        		if(!array_key_exists($top->risk_directorate_id, $risk_directorate)){
	        			$risk_directorate[$top->risk_directorate_id]['total'] = 1;
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] = 0;
	        		}else{
	        			$risk_directorate[$top->risk_directorate_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] += 1;
	        		}

	        		/*populate data for pie chart classification*/
	        		if(!array_key_exists($top->risk_classification_id, $risk_classification)){
	        			$risk_classification[$top->risk_classification_id]['total'] = 1;
	        			$risk_classification[$top->risk_classification_id]['monitored'] = 0;
	        		}else{
	        			$risk_classification[$top->risk_classification_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_classification[$top->risk_classification_id]['monitored'] += 1;
	        		}
	     
	        		/*sum data*/
	    			$sum_teridentifikasi +=$top->teridentifikasi;
	    			$sum_termitigasi +=$top->termitigasi;
	        	}
	        	$risk_radar = $top_risk;
	        }
	       
	        $this->data['top_risk'] = $top_risk;
	        $this->data['sum_teridentifikasi'] = $sum_teridentifikasi;
	        $this->data['sum_termitigasi'] = $sum_termitigasi;
			/*END TOP RISK REGISTER*/

			/*BEGIN RESIDUAL IDENTIFICATION AND MITIGATION*/
			$queryIdentification = $this->db->select("count(tri.TERIDENTIFIKASI) as teridentifikasi")
	        ->from('tx_risk_identification as tri')
	        ->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TERIDENTIFIKASI = 1 AND tri.TAHUN = '.$tahun)
	        ->get();

	        foreach($queryIdentification->result() as $totalIdentification){
	        	/*sum data*/
	    		$summary_teridentifikasi =$totalIdentification->teridentifikasi;
	        }
	        $this->data['summary_teridentifikasi'] = $summary_teridentifikasi;

	        $queryMitigation = $this->db->select("count(tri.TERMITIGASI) as termitigasi")
	        ->from('tx_risk_identification as tri')
	        ->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TERMITIGASI = 0 AND tri.TAHUN = '.$tahun)
	        ->get();

	        foreach($queryMitigation->result() as $totalMitigation){
	        	/*sum data*/
	    		$summary_termitigasi =$totalMitigation->termitigasi;
	        }
	        $this->data['summary_termitigasi'] = $summary_termitigasi;
			/*END RESIDUAL IDENTIFICATION AND MITIGATION*/

			/*BEGIN BAR CHART AND MAP RISIKO*/
			$label 			 = array();
			$teridentifikasi = array();
			$termitigasi 	 = array();

			$data_map_risk = array();

			$units = $this->unit_model->get_all_dashboard();

			foreach($units as $u){
				$label[] = $u->code;

				$query = $this->db->select("SUM(TERIDENTIFIKASI) AS total_teridentifikasi, SUM(TERMITIGASI) AS total_termitigasi")
		        ->from('tx_risk_identification')
		       	->where('STATUS_DOKUMEN_ID >= 4 AND TAHUN = '.$tahun.' AND UNIT_ID = '.$u->id)
		        ->get();

		        if($query->num_rows() > 0){
		        	$result = $query->result();
		        	
		        	$teridentifikasi[] = $result[0]->total_teridentifikasi;
		        	$termitigasi[] 	   = $result[0]->total_termitigasi;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi > 0){
			        		$pencapaian = round(($result[0]->total_termitigasi/$result[0]->total_teridentifikasi)*100, 2);
			        	}else if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi == 0){
			        		$pencapaian = 100;
			        	}else{
			        		$pencapaian = 0;
			        	}
			        	
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : '.$pencapaian.'%',
				        );
			        }
		        }else{
		        	$teridentifikasi[] = 0;
		        	$termitigasi[] 	   = 0;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : 0%',
				        );
			        }
		        }
			}

			$this->data['barchart_label'] 			= $label;
			$this->data['barchart_teridentifikasi'] = $teridentifikasi;
			$this->data['barchart_termitigasi'] 	= $termitigasi;

			$this->data['map_risiko'] = $data_map_risk;
			/*END BAR CHART*/

			/*BEGIN RISK RADAR TOP 10*/
			$risk_radar_top_data = array();

			$i_top = 1;
			foreach($risk_radar as $rr){
				list($coorx, $coory)= $this->generateDotTop($rr['data']->level_name, $rr['data']->risk_category_alias, $risk_radar_top_data);

				$coorx_text = $coorx + 4;
				$coory_text = $coory + 4;

				$risk_radar_top_data[] = array(
					'x'=>$coorx,
					'y'=>$coory,
					'x_text'=>$coorx_text,
					'y_text'=>$coory_text,
					'number'=>$rr['data']->risk_item_number,
					'risk_item_id'=>$rr['data']->risk_item_id,
					'radius'=>3,
				);

				$i_top++;

				if($i_top > 10){
					break;
				}
			}

			$this->data['risk_radar_top_data'] = $risk_radar_top_data;
			/*END RISK RADAR TOP 10*/

			/*BEGIN RISK RADAR*/
			$risk_radar_data_table  = array();
			$risk_radar_data 		= array();

			foreach($risk_radar as $risk_register_id => $rr){
				if($risk_radar_data_table!=array() and isset($risk_radar_data_table[$rr['data']->level_name])){
					if(!array_key_exists($rr['data']->risk_category_alias, $risk_radar_data_table[$rr['data']->level_name])){
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}else{
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] += 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}
				}else{
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
				}
			}

			
			$r=4;
			foreach($risk_radar_data_table as $level => $risk_data_table){
				foreach($risk_data_table as $alias => $value){
					list($coorx, $coory)= $this->generateDot($level, $alias);
					$coorx_text = $coorx + 7;
					$coory_text = $coory + 5;

					if($value['count']>5){
						$hasil = $value['count']/5;

						if($hasil>1 and $hasil<=2){
							$r+=2;
							$coorx_text+=2;
						}elseif ($hasil>2 and $hasil<=3) {
							$r+=4;
							$coorx_text+=4;
						}elseif ($hasil>3 and $hasil<=4) {
							$r+=6;
							$coorx_text+=6;
						}elseif ($hasil>4 and $hasil<=5) {
							$r+=8;
							$coorx_text+=8;
						}elseif ($hasil>5 and $hasil<=6) {
							$r+=10;
							$coorx_text+=10;
						}
					}

					$risk_radar_data[] = array(
						'x'=>$coorx,
						'y'=>$coory,
						'x_text'=>$coorx_text,
						'y_text'=>$coory_text,
						'count'=>$value['count'],
						'level'=>$level,
						'alias'=>$alias,
						'radius'=>$r,
					);
					
					/*reset*/
					$r=4;
				}
			}

			$this->data['risk_radar'] 		= $risk_radar_data;
			$this->data['risk_radar_table'] = $risk_radar_data_table;
			/*END RISK RADAR*/

			/*BEGIN DIRECTORATE PIE CHART*/
			$pie_directorate_data 	 = array();
			$riskDirectorateModel 	 = $this->risk_directorate_model->get_all();
			$summary_directorate_pie = 0;

			foreach($riskDirectorateModel as $rdm){
				if(!array_key_exists($rdm->id, $risk_directorate)){
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>0,
	    				'color'=>$rdm->color,
	    				'total_monitored'=>0,
	    			);
	    		}else{
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>$risk_directorate[$rdm->id]['total'],
	    				'color'=>$rdm->color,
	    				'total_monitored'=>$risk_directorate[$rdm->id]['monitored']
	    			);
	    		}
	    		$summary_directorate_pie++;
			}
			
			$this->data['directorate_pie'] 		   = $pie_directorate_data;
			$this->data['summary_directorate_pie'] = $summary_directorate_pie;
			/*END DIRECTORATE PIE CHART*/

			/*BEGIN CLASSIFICATION PIE CHART*/
			$pie_classification_data = array();
			$riskClassificationModel = $this->risk_classification_model->get_all();
			$summary_function_pie    = 0;

			foreach($riskClassificationModel as $rcm){
				if(!array_key_exists($rcm->id, $risk_classification)){
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>0,
	    				'color'=>$rcm->color,
	    				'total_monitored'=>0
	    			);
	    		}else{
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>$risk_classification[$rcm->id]['total'],
	    				'color'=>$rcm->color,
	    				'total_monitored'=>$risk_classification[$rcm->id]['monitored']
	    			);
	    		}
	    		$summary_function_pie++;
			}
			$this->data['summary_function_pie'] = $summary_function_pie;
			$this->data['classification_pie']   = $pie_classification_data;
			/*END CLASSIFICATION PIE CHART*/

			/*START RISK REKAPITULASI TABLE*/
			$array_risk_percategory  				= array();
			$array_risk_item_summary 				= array();
			$array_risk_per_event_summary  			= array();
			$array_risk_per_event_mitigasi_summary  = array();
			$data_rekapitulasi 						= array();

			if(isset($rekapitulasi)){
	        	foreach($rekapitulasi as $rekap){
	        		/*rekap per risk item*/
	        		if(!isset($array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] = 1;
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
	        			
	        			/*summary*/
	        			$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			if(!in_array($rekap->risk_item_id, $array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] += 1;
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
		        			
		        			/*summary*/
	        				$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
		        		}	
	        		}

	        		/*rekap per event summary teridentifikasi*/
	        		if(!isset($array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name])){
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}
		   
		        	/*rekap per event summary termitigasi*/
	        		if(!isset($array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name])){
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}else{
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}
	        	}        	
	        }

	        $risk_categories = $this->risk_category_model->get_all();
	        $risks 			 = $this->risk_model->get_all();

	        foreach($units as $u){
	        	$target = $this->target_pencapaian_model->get_by_unit_id($u->id, $tahun);
	        	
	        	$data_rekapitulasi[$u->id]['code'] = $u->code;
	        	
	        	if($target){
	        		$data_rekapitulasi[$u->id]['start_date'] = $target->start_date;
	        		$data_rekapitulasi[$u->id]['end_date'] = $target->end_date;
	        	}else{
	        		$data_rekapitulasi[$u->id]['start_date'] = null;
	        		$data_rekapitulasi[$u->id]['end_date'] = null;
	        	}

	        	foreach($risk_categories as $rc){
	        		foreach ($risks as $r) {
	        			if(isset($array_risk_percategory[$u->id][$rc->name."_".$r->name_alias])){
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = $array_risk_percategory[$u->id][$rc->name."_".$r->name_alias]['count'];
			        	}else{
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = 0;
			        	}
	        		}

	        		if(isset($array_risk_item_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = $array_risk_item_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = 0;
	        		}

	        		if(isset($array_risk_per_event_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = $array_risk_per_event_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = 0;
	        		}

	        		if(isset($array_risk_per_event_mitigasi_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = $array_risk_per_event_mitigasi_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = 0;
	        		}
	        	}
	        }
	        
	        $this->data['rekapitulasi'] = $data_rekapitulasi;
			/*END RISK REKAPITULASI TABLE*/
			
			/*PETA RISIKO RISK LEADERS*/
            $unit_id 		= $this->session->userdata('unit_id');
            $user_pic_ids 	= $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));

            $this->data['unit_report']  = $this->risk_model->get_by_unit_report($unit_id);

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);	
			$rows 	= $this->risk_identification_model->risk_map_monitoring_report($params);
			$resultRow = array();

			$i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_id, $row->risk_d_id);

                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Query*/
                    $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                    $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d,
                        'RiskProbability'     => $row->risk_k,
                        'RiskImpactId'        => $row->risk_d_id,
                        'RiskProbabilityId'   => $row->risk_k_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskValue'           => $riskLevelNames[0]->risk_levels
                    );
                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Query*/
                            $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                            $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d,
                                'RiskProbability'     => $row->risk_k,
                                'RiskImpactId'        => $row->risk_d_id,
                                'RiskProbabilityId'   => $row->risk_k_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskValue'           => $riskLevelNames[0]->risk_levels
                            );
                            $i++;
                        }
                    }else{
                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d,
                            'RiskProbability'     => $row->risk_k,
                            'RiskImpactId'        => $row->risk_d_id,
                            'RiskProbabilityId'   => $row->risk_k_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskValue'           => $riskLevelNames[0]->risk_levels
                        );
                        $i++;
                    }
                }
            }

            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $tahun,
                'user_pic_ids_search' => $user_pic_ids
            ));

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*BEGIN SUMMARY RISK LEADERS*/
            $query = $this->db->select("sum(tri.TERIDENTIFIKASI) as total_event, sum(tri.TERMITIGASI) as total_mitigasi")
	        ->from('tx_risk_identification as tri')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.UNIT_ID = '.$this->session->userdata('unit_id').' AND tri.TAHUN = '.$tahun)
	        ->get();

	        $sum_teridentifikasi_gm = 0;
	        $sum_termitigasi_gm 	= 0;

	      	if($query->num_rows() > 0){
	        	$result = $query->result();
	        	
	        	$sum_teridentifikasi_gm = $result[0]->total_event;
	        	$sum_termitigasi_gm 	= $result[0]->total_mitigasi;
	        }

	        $this->data['sum_teridentifikasi_gm'] 	= $sum_teridentifikasi_gm;
	        $this->data['sum_termitigasi_gm'] 		= $sum_termitigasi_gm;
	        /*END SUMMARY RISK LEADERS*/

	        /*BEGIN GOOGLE MAPS DATA*/
	        $maps_result = array();

	        foreach($units as $u){
	        	$result  = array();
            
	            $unit_id = $u->id;

	            $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

	            /*Risk Query Select*/
	            $rows = $this->risk_identification_model->get_risk_assessment_report($params);

	            if($rows){
	                foreach($rows as $row){
	                    $pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
	                    $pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

	                    $mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
	                    $mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

	                    $rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

	                    if(array_key_exists($row->RISK_ITEM_ID, $result)){
	                        $result[$row->RISK_ITEM_ID]['data'][] = $row;

	                        /*jika rangkingnya lebih besar*/
	                        if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
	                            $result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
	                            $result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
	                            $result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
	                        }

	                    }else{
	                        $result[$row->RISK_ITEM_ID] = array(
	                            'data'=>array($row),
	                            'rangking'=>$rangking,
	                            'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
	                            'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
	                        );
	                    }
	                }
	            }

	            $maps_result[$u->id] = $result;
	        }

	        /*echo "<pre/>";
	        var_dump($maps_result);die;*/
	        $this->data['data_maps_table'] = $maps_result;
	        /*END GOOGLE MAPS DATA*/
		}
		
		$this->template
			->load_module_partial('sections', 'welcome/hmvc/section_partial')
			/*Begin Flotchart*/
			->set_js_global('plugins/chartjs/Chart.min')
			->set_js_global('plugins/amcharts/amcharts/amcharts')
			->set_js_global('plugins/amcharts/amcharts/pie')
			->set_js_global('plugins/amcharts/amcharts/themes/light')
			->set_js_global('plugins/angularjs/angular.min')
            ->set_js_global('plugins/angularjs/angular-sanitize.min')
            ->set_js_global('plugins/angularjs/angular-touch.min')
            ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            ->set_js_global('plugins/angularjs/angular-risk-matrix')
            ->set_js_global('plugins/jspdf/jspdf.debug')
            ->set_js_global('plugins/html2canvas/html2canvas')
            ->set_js_global('plugins/riskchart/d3.min')
            ->set_js_global('plugins/riskchart/canvg')
            ->set_js_global('plugins/riskchart/riskchart')
			/*End Flotchart*/
			->build('welcome_residual');
	}

	public function index_corporate_worksheet()
	{
		/***********************************
		***		 DASHBOARD FUNCTION      ***
		***********************************/
		$tahun = date('Y');
		$tahunPrevious = $tahun-1;
		if(isset($_GET['tahun'])){
			$tahun = $_GET['tahun'];
			$tahunPrevious = $tahun-1;
		}

		$this->data['tahun'] = $tahun;

		/* if($_GET['stat']=="Y"){
            $stat = 1;
        }elseif($_GET['stat']=="N") {
            $stat = 0;
        }else{
            $stat = "";
        }

        $this->data['stat'] = $stat; */

		/*BEGIN NOTIFICATIONS*/
		$this->data['pending_risk']    		= $this->risk_identification_model->count_by_status_bumn(array(STATUS_DRAFT,STATUS_APPROVE_ASSESSMENT,STATUS_CONFIRM));
		$this->data['onprogress_risk'] 		= $this->risk_identification_model->count_by_status_bumn(array(STATUS_ON_MONITORING,STATUS_MITIGATION));
		$this->data['done_risk'] 	   		= $this->risk_identification_model->count_by_status_bumn(array(STATUS_MITIGATED));
		$this->data['assessment_approval']	= $this->risk_identification_model->count_by_status_bumn(array(STATUS_APPROVE_ASSESSMENT), true);
		$this->data['mitigation_approval']	= $this->risk_identification_model->count_by_status_bumn(array(STATUS_MITIGATION), true);
		/*END NOTIFICATIONS*/

		if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
			/*BEGIN TOP RISK REGISTER*/
			$top_risk 		  	 = array();
			$risk_radar 	  	 = array();
			$risk_directorate 	 = array();
			$risk_classification = array();
			$sum_teridentifikasi = 0;
			$sum_termitigasi  	 = 0;
			$rekapitulasi 		 = null;

			$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.RESIDUAL_RISK_K_ID AND mrv.risk_impact_id = tri.RESIDUAL_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
			->where('tri.STATUS_DOKUMEN_ID IN(3,4,5,6) AND tri.TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_BUMN.'" AND tri.TAHUN = '.$tahun)
			//->where('tri.STATUS_DOKUMEN_ID IN(3,4,5,6) AND (tri.TAHUN BETWEEN "'.$tahunPrevious.'" AND "'.$tahun.'")')
	       	//->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
			->where('tri.TERMITIGASI = 0')
	        ->order_by('rangking','asc')
	        ->get();

	        if($query->num_rows() > 0){
	        	$rekapitulasi = $query->result();

	        	foreach($query->result() as $top){
	        		if($top->status_dokumen != 6){
		        		if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI || $top->risk_level_id == RISIKO_SEDANG || $top->risk_level_id == RISIKO_RENDAH){
			        		if(!array_key_exists($top->risk_item_id, $top_risk)){
			        			$top_risk[$top->risk_item_id]['data'] = $top;
			        			$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend_bumn($top->risk_item_id, $top->rangking, $tahun);
			        		}else{
			        			if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
			        				$top_risk[$top->risk_item_id]['data'] = $top;
			        				$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend_bumn($top->risk_item_id, $top->rangking, $tahun);
			        			}
			        		}
		        		}
	        		}

	    			/*populate data for pie chart directorate*/
	        		if(!array_key_exists($top->risk_directorate_id, $risk_directorate)){
	        			$risk_directorate[$top->risk_directorate_id]['total'] = 1;
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] = 0;
	        		}else{
	        			$risk_directorate[$top->risk_directorate_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] += 1;
	        		}

	        		/*populate data for pie chart classification*/
	        		if(!array_key_exists($top->risk_classification_id, $risk_classification)){
	        			$risk_classification[$top->risk_classification_id]['total'] = 1;
	        			$risk_classification[$top->risk_classification_id]['monitored'] = 0;
	        		}else{
	        			$risk_classification[$top->risk_classification_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_classification[$top->risk_classification_id]['monitored'] += 1;
	        		}
	     
	        		/*sum data*/
	    			$sum_teridentifikasi +=$top->teridentifikasi;
	    			$sum_termitigasi +=$top->termitigasi;
	        	}
	        	$risk_radar = $top_risk;
	        }
	       
	        $this->data['top_risk'] = $top_risk;
	        $this->data['sum_teridentifikasi'] = $sum_teridentifikasi;
	        $this->data['sum_termitigasi'] = $sum_termitigasi;
			/*END TOP RISK REGISTER*/

			/*BEGIN BAR CHART AND MAP RISIKO*/
			$label 			 = array();
			$teridentifikasi = array();
			$termitigasi 	 = array();

			$data_map_risk = array();

			$units = $this->unit_model->get_all_dashboard();

			foreach($units as $u){
				$label[] = $u->code;

				$query = $this->db->select("SUM(TERIDENTIFIKASI) AS total_teridentifikasi, SUM(TERMITIGASI) AS total_termitigasi")
		        ->from('tx_risk_identification')
				->where('STATUS_DOKUMEN_ID >= 4 AND TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_BUMN.'" AND TAHUN = '.$tahun.' AND UNIT_ID = '.$u->id)
				//->where('STATUS_DOKUMEN_ID >= 4 AND TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_PUMR.'" AND (TAHUN BETWEEN "'.$tahunPrevious.'" AND "'.$tahun.'") AND UNIT_ID = '.$u->id)
		        ->get();

		        if($query->num_rows() > 0){
		        	$result = $query->result();
		        	
		        	$teridentifikasi[] = $result[0]->total_teridentifikasi;
		        	$termitigasi[] 	   = $result[0]->total_termitigasi;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi > 0){
			        		$pencapaian = round(($result[0]->total_termitigasi/$result[0]->total_teridentifikasi)*100, 2);
			        	}else if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi == 0){
			        		$pencapaian = 100;
			        	}else{
			        		$pencapaian = 0;
			        	}
			        	
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : '.$pencapaian.'%',
				        );
			        }
		        }else{
		        	$teridentifikasi[] = 0;
		        	$termitigasi[] 	   = 0;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : 0%',
				        );
			        }
		        }
			}

			$this->data['barchart_label'] 			= $label;
			$this->data['barchart_teridentifikasi'] = $teridentifikasi;
			$this->data['barchart_termitigasi'] 	= $termitigasi;

			$this->data['map_risiko'] = $data_map_risk;
			/*END BAR CHART*/

			/*BEGIN RISK RADAR TOP 10*/
			$risk_radar_top_data = array();

			$i_top = 1;
			foreach($risk_radar as $rr){
				list($coorx, $coory)= $this->generateDotTopBUMN($rr['data']->level_name, $rr['data']->risk_category_alias, $risk_radar_top_data);

				$coorx_text = $coorx + 4;
				$coory_text = $coory + 4;

				$risk_radar_top_data[] = array(
					'x'=>$coorx,
					'y'=>$coory,
					'x_text'=>$coorx_text,
					'y_text'=>$coory_text,
					'number'=>$rr['data']->risk_item_number,
					'risk_item_id'=>$rr['data']->risk_item_id,
					'radius'=>3,
				);

				$i_top++;

				if($i_top > 10){
					break;
				}
			}

			$this->data['risk_radar_top_data'] = $risk_radar_top_data;
			/*END RISK RADAR TOP 10*/

			/*BEGIN RISK RADAR*/
			$risk_radar_data_table  = array();
			$risk_radar_data 		= array();

			foreach($risk_radar as $risk_register_id => $rr){
				if($risk_radar_data_table!=array() and isset($risk_radar_data_table[$rr['data']->level_name])){
					if(!array_key_exists($rr['data']->risk_category_alias, $risk_radar_data_table[$rr['data']->level_name])){
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}else{
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] += 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}
				}else{
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
				}
			}

			
			$r=4;
			foreach($risk_radar_data_table as $level => $risk_data_table){
				foreach($risk_data_table as $alias => $value){
					list($coorx, $coory)= $this->generateDot($level, $alias);
					$coorx_text = $coorx + 7;
					$coory_text = $coory + 5;

					if($value['count']>5){
						$hasil = $value['count']/5;

						if($hasil>1 and $hasil<=2){
							$r+=2;
							$coorx_text+=2;
						}elseif ($hasil>2 and $hasil<=3) {
							$r+=4;
							$coorx_text+=4;
						}elseif ($hasil>3 and $hasil<=4) {
							$r+=6;
							$coorx_text+=6;
						}elseif ($hasil>4 and $hasil<=5) {
							$r+=8;
							$coorx_text+=8;
						}elseif ($hasil>5 and $hasil<=6) {
							$r+=10;
							$coorx_text+=10;
						}
					}

					$risk_radar_data[] = array(
						'x'=>$coorx,
						'y'=>$coory,
						'x_text'=>$coorx_text,
						'y_text'=>$coory_text,
						'count'=>$value['count'],
						'level'=>$level,
						'alias'=>$alias,
						'radius'=>$r,
					);
					
					/*reset*/
					$r=4;
				}
			}

			$this->data['risk_radar'] 		= $risk_radar_data;
			$this->data['risk_radar_table'] = $risk_radar_data_table;
			/*END RISK RADAR*/

			/*BEGIN DIRECTORATE PIE CHART*/
			$pie_directorate_data 	 = array();
			$riskDirectorateModel 	 = $this->risk_directorate_model->get_all();
			$summary_directorate_pie = 0;

			foreach($riskDirectorateModel as $rdm){
				if(!array_key_exists($rdm->id, $risk_directorate)){
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>0,
	    				'color'=>$rdm->color,
	    				'total_monitored'=>0,
	    			);
	    		}else{
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>$risk_directorate[$rdm->id]['total'],
	    				'color'=>$rdm->color,
	    				'total_monitored'=>$risk_directorate[$rdm->id]['monitored']
	    			);
	    		}
	    		$summary_directorate_pie++;
			}
			
			$this->data['directorate_pie'] 		   = $pie_directorate_data;
			$this->data['summary_directorate_pie'] = $summary_directorate_pie;
			/*END DIRECTORATE PIE CHART*/

			/*BEGIN CLASSIFICATION PIE CHART*/
			$pie_classification_data = array();
			$riskClassificationModel = $this->risk_classification_model->get_all();
			$summary_function_pie    = 0;

			foreach($riskClassificationModel as $rcm){
				if(!array_key_exists($rcm->id, $risk_classification)){
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>0,
	    				'color'=>$rcm->color,
	    				'total_monitored'=>0
	    			);
	    		}else{
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>$risk_classification[$rcm->id]['total'],
	    				'color'=>$rcm->color,
	    				'total_monitored'=>$risk_classification[$rcm->id]['monitored']
	    			);
	    		}
	    		$summary_function_pie++;
			}
			$this->data['summary_function_pie'] = $summary_function_pie;
			$this->data['classification_pie']   = $pie_classification_data;
			/*END CLASSIFICATION PIE CHART*/

			/*START RISK REKAPITULASI TABLE*/
			$array_risk_percategory  				= array();
			$array_risk_item_summary 				= array();
			$array_risk_per_event_summary  			= array();
			$array_risk_per_event_mitigasi_summary  = array();
			$data_rekapitulasi 						= array();

			if(isset($rekapitulasi)){
	        	foreach($rekapitulasi as $rekap){
	        		/*rekap per risk item*/
	        		if(!isset($array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] = 1;
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
	        			
	        			/*summary*/
	        			$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			if(!in_array($rekap->risk_item_id, $array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] += 1;
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
		        			
		        			/*summary*/
	        				$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
		        		}	
	        		}

	        		/*rekap per event summary teridentifikasi*/
	        		if(!isset($array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name])){
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}
		   
		        	/*rekap per event summary termitigasi*/
	        		if(!isset($array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name])){
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}else{
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}
	        	}        	
	        }

	        $risk_categories = $this->risk_category_model->get_all();
	        $risks 			 = $this->risk_model->get_all();

	        foreach($units as $u){
	        	$target = $this->target_pencapaian_model->get_by_unit_id($u->id, $tahun);
	        	
	        	$data_rekapitulasi[$u->id]['code'] = $u->code;
	        	
	        	if($target){
	        		$data_rekapitulasi[$u->id]['start_date'] = $target->start_date;
	        		$data_rekapitulasi[$u->id]['end_date'] = $target->end_date;
	        	}else{
	        		$data_rekapitulasi[$u->id]['start_date'] = null;
	        		$data_rekapitulasi[$u->id]['end_date'] = null;
	        	}

	        	foreach($risk_categories as $rc){
	        		foreach ($risks as $r) {
	        			if(isset($array_risk_percategory[$u->id][$rc->name."_".$r->name_alias])){
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = $array_risk_percategory[$u->id][$rc->name."_".$r->name_alias]['count'];
			        	}else{
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = 0;
			        	}
	        		}

	        		if(isset($array_risk_item_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = $array_risk_item_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = 0;
	        		}

	        		if(isset($array_risk_per_event_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = $array_risk_per_event_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = 0;
	        		}

	        		if(isset($array_risk_per_event_mitigasi_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = $array_risk_per_event_mitigasi_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = 0;
	        		}
	        	}
	        }
	        
	        $this->data['rekapitulasi'] = $data_rekapitulasi;
			/*END RISK REKAPITULASI TABLE*/
			
			/*PETA RISIKO RISK LEADERS*/
            $unit_id 		= $this->session->userdata('unit_id');
            $user_pic_ids 	= $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));

            $this->data['unit_report']  = $this->risk_model->get_by_unit_report($unit_id);

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);	
			$rows 	= $this->risk_identification_model->risk_map_monitoring_report($params);
			$resultRow = array();

			$i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_id, $row->risk_d_id);

                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Query*/
                    $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                    $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d,
                        'RiskProbability'     => $row->risk_k,
                        'RiskImpactId'        => $row->risk_d_id,
                        'RiskProbabilityId'   => $row->risk_k_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskValue'           => $riskLevelNames[0]->risk_levels
                    );
                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Query*/
                            $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                            $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d,
                                'RiskProbability'     => $row->risk_k,
                                'RiskImpactId'        => $row->risk_d_id,
                                'RiskProbabilityId'   => $row->risk_k_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskValue'           => $riskLevelNames[0]->risk_levels
                            );
                            $i++;
                        }
                    }else{
                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d,
                            'RiskProbability'     => $row->risk_k,
                            'RiskImpactId'        => $row->risk_d_id,
                            'RiskProbabilityId'   => $row->risk_k_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskValue'           => $riskLevelNames[0]->risk_levels
                        );
                        $i++;
                    }
                }
            }

            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $tahun,
                'user_pic_ids_search' => $user_pic_ids
            ));

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*BEGIN SUMMARY RISK LEADERS*/
            $query = $this->db->select("sum(tri.TERIDENTIFIKASI) as total_event, sum(tri.TERMITIGASI) as total_mitigasi")
	        ->from('tx_risk_identification as tri')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.UNIT_ID = '.$this->session->userdata('unit_id').' AND tri.TAHUN = '.$tahun)
	        ->get();

	        $sum_teridentifikasi_gm = 0;
	        $sum_termitigasi_gm 	= 0;

	      	if($query->num_rows() > 0){
	        	$result = $query->result();
	        	
	        	$sum_teridentifikasi_gm = $result[0]->total_event;
	        	$sum_termitigasi_gm 	= $result[0]->total_mitigasi;
	        }

	        $this->data['sum_teridentifikasi_gm'] 	= $sum_teridentifikasi_gm;
	        $this->data['sum_termitigasi_gm'] 		= $sum_termitigasi_gm;
	        /*END SUMMARY RISK LEADERS*/

	        /*BEGIN GOOGLE MAPS DATA*/
	        $maps_result = array();

	        foreach($units as $u){
	        	$result  = array();
            
	            $unit_id = $u->id;

	            $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

	            /*Risk Query Select*/
	            $rows = $this->risk_identification_model->get_risk_assessment_report($params);

	            if($rows){
	                foreach($rows as $row){
	                    $pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
	                    $pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

	                    $mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
	                    $mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

	                    $rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

	                    if(array_key_exists($row->RISK_ITEM_ID, $result)){
	                        $result[$row->RISK_ITEM_ID]['data'][] = $row;

	                        /*jika rangkingnya lebih besar*/
	                        if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
	                            $result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
	                            $result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
	                            $result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
	                        }

	                    }else{
	                        $result[$row->RISK_ITEM_ID] = array(
	                            'data'=>array($row),
	                            'rangking'=>$rangking,
	                            'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
	                            'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
	                        );
	                    }
	                }
	            }

	            $maps_result[$u->id] = $result;
	        }

	        /*echo "<pre/>";
	        var_dump($maps_result);die;*/
	        $this->data['data_maps_table'] = $maps_result;
	        /*END GOOGLE MAPS DATA*/
		}
		
		$this->template
			->load_module_partial('sections', 'welcome/hmvc/section_partial')
			/*Begin Flotchart*/
			->set_js_global('plugins/chartjs/Chart.min')
			->set_js_global('plugins/amcharts/amcharts/amcharts')
			->set_js_global('plugins/amcharts/amcharts/pie')
			->set_js_global('plugins/amcharts/amcharts/themes/light')
			->set_js_global('plugins/angularjs/angular.min')
            ->set_js_global('plugins/angularjs/angular-sanitize.min')
            ->set_js_global('plugins/angularjs/angular-touch.min')
            ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            ->set_js_global('plugins/angularjs/angular-risk-matrix')
            ->set_js_global('plugins/jspdf/jspdf.debug')
            ->set_js_global('plugins/html2canvas/html2canvas')
            ->set_js_global('plugins/riskchart/d3.min')
            ->set_js_global('plugins/riskchart/canvg')
            ->set_js_global('plugins/riskchart/riskchart')
            ->set_js_global('plugins/jqvmap/jqvmap/jquery.vmap')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.world')
            ->set_js_global('plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata')
            ->set_js_global('plugins/jqvmap/jqvmap/maps/jquery.vmap.indonesia')
			/*End Flotchart*/
			->build('welcome_corporate_worksheet');
	}

	public function index_residual_worksheet()
	{
		/***********************************
		***		 DASHBOARD FUNCTION      ***
		***********************************/
		$tahun = date('Y');
		if(isset($_GET['tahun'])){
			$tahun = $_GET['tahun'];
		}

		$this->data['tahun'] = $tahun;

		/* if($_GET['stat']=="Y"){
            $stat = 1;
        }elseif($_GET['stat']=="N") {
            $stat = 0;
        }else{
            $stat = "";
        }

        $this->data['stat'] = $stat; */

		/*BEGIN NOTIFICATIONS*/
		$this->data['pending_risk']    		= $this->risk_identification_model->count_by_status(array(STATUS_DRAFT,STATUS_APPROVE_ASSESSMENT,STATUS_CONFIRM));
		$this->data['onprogress_risk'] 		= $this->risk_identification_model->count_by_status(array(STATUS_ON_MONITORING,STATUS_MITIGATION));
		$this->data['done_risk'] 	   		= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATED));
		$this->data['assessment_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_APPROVE_ASSESSMENT), true);
		$this->data['mitigation_approval']	= $this->risk_identification_model->count_by_status(array(STATUS_MITIGATION), true);
		/*END NOTIFICATIONS*/

		if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN || $this->session->userdata('role_id')==GROUP_RISK_LEADERS || $this->session->userdata('role_id')==GROUP_RISK_BOD){
			/*BEGIN TOP RISK REGISTER*/
			$top_risk 		  	 = array();
			$risk_radar 	  	 = array();
			$risk_directorate 	 = array();
			$risk_classification = array();
			$sum_teridentifikasi = 0;
			$sum_termitigasi  	 = 0;
			$rekapitulasi 		 = null;

			$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TAHUN = '.$tahun)
	       	//->where('tri.TERMITIGASI LIKE "%'.$stat.'%"')
	        ->order_by('rangking','asc')
	        ->get();

	        if($query->num_rows() > 0){
	        	$rekapitulasi = $query->result();

	        	foreach($query->result() as $top){
	        		if($top->status_dokumen != 6){
		        		if($top->risk_level_id == RISIKO_SANGAT_TINGGI || $top->risk_level_id == RISIKO_TINGGI){
			        		if(!array_key_exists($top->risk_item_id, $top_risk)){
			        			$top_risk[$top->risk_item_id]['data'] = $top;
			        			$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        		}else{
			        			if(intval($top->rangking) < intval($top_risk[$top->risk_item_id]->rangking)){
			        				$top_risk[$top->risk_item_id]['data'] = $top;
			        				$top_risk[$top->risk_item_id]['icon'] = $this->risk_map_model->check_trend($top->risk_item_id, $top->rangking, $tahun);
			        			}
			        		}
		        		}
	        		}

	    			/*populate data for pie chart directorate*/
	        		if(!array_key_exists($top->risk_directorate_id, $risk_directorate)){
	        			$risk_directorate[$top->risk_directorate_id]['total'] = 1;
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] = 0;
	        		}else{
	        			$risk_directorate[$top->risk_directorate_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_directorate[$top->risk_directorate_id]['monitored'] += 1;
	        		}

	        		/*populate data for pie chart classification*/
	        		if(!array_key_exists($top->risk_classification_id, $risk_classification)){
	        			$risk_classification[$top->risk_classification_id]['total'] = 1;
	        			$risk_classification[$top->risk_classification_id]['monitored'] = 0;
	        		}else{
	        			$risk_classification[$top->risk_classification_id]['total'] += 1;
	        		}

	        		if($top->status_dokumen !=6){
	        			$risk_classification[$top->risk_classification_id]['monitored'] += 1;
	        		}
	     
	        		/*sum data*/
	    			$sum_teridentifikasi +=$top->teridentifikasi;
	    			$sum_termitigasi +=$top->termitigasi;
	        	}
	        	$risk_radar = $top_risk;
	        }
	       
	        $this->data['top_risk'] = $top_risk;
	        $this->data['sum_teridentifikasi'] = $sum_teridentifikasi;
	        $this->data['sum_termitigasi'] = $sum_termitigasi;
			/*END TOP RISK REGISTER*/

			/*BEGIN RESIDUAL IDENTIFICATION AND MITIGATION*/
			$queryIdentification = $this->db->select("count(tri.TERIDENTIFIKASI) as teridentifikasi")
	        ->from('tx_risk_identification as tri')
	        ->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TERIDENTIFIKASI = 1 AND tri.TAHUN = '.$tahun)
	        ->get();

	        foreach($queryIdentification->result() as $totalIdentification){
	        	/*sum data*/
	    		$summary_teridentifikasi =$totalIdentification->teridentifikasi;
	        }
	        $this->data['summary_teridentifikasi'] = $summary_teridentifikasi;

	        $queryMitigation = $this->db->select("count(tri.TERMITIGASI) as termitigasi")
	        ->from('tx_risk_identification as tri')
	        ->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.TERMITIGASI = 0 AND tri.TAHUN = '.$tahun)
	        ->get();

	        foreach($queryMitigation->result() as $totalMitigation){
	        	/*sum data*/
	    		$summary_termitigasi =$totalMitigation->termitigasi;
	        }
	        $this->data['summary_termitigasi'] = $summary_termitigasi;
			/*END RESIDUAL IDENTIFICATION AND MITIGATION*/

			/*BEGIN BAR CHART AND MAP RISIKO*/
			$label 			 = array();
			$teridentifikasi = array();
			$termitigasi 	 = array();

			$data_map_risk = array();

			$units = $this->unit_model->get_all_dashboard();

			foreach($units as $u){
				$label[] = $u->code;

				$query = $this->db->select("SUM(TERIDENTIFIKASI) AS total_teridentifikasi, SUM(TERMITIGASI) AS total_termitigasi")
		        ->from('tx_risk_identification')
		       	->where('STATUS_DOKUMEN_ID >= 4 AND TAHUN = '.$tahun.' AND UNIT_ID = '.$u->id)
		        ->get();

		        if($query->num_rows() > 0){
		        	$result = $query->result();
		        	
		        	$teridentifikasi[] = $result[0]->total_teridentifikasi;
		        	$termitigasi[] 	   = $result[0]->total_termitigasi;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi > 0){
			        		$pencapaian = round(($result[0]->total_termitigasi/$result[0]->total_teridentifikasi)*100, 2);
			        	}else if($result[0]->total_termitigasi > 0 and $result[0]->total_teridentifikasi == 0){
			        		$pencapaian = 100;
			        	}else{
			        		$pencapaian = 0;
			        	}
			        	
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : '.$pencapaian.'%',
				        );
			        }
		        }else{
		        	$teridentifikasi[] = 0;
		        	$termitigasi[] 	   = 0;

		        	/*set data for map risk*/
			        if(!$u->is_kantor_pusat){
			        	$data_map_risk[] = array(
			        		'unit_id'=>$u->id,
				        	'title' => $u->name.' : '.$pencapaian.'%',
				        	'lat' => $u->lat,
				        	'lon' => $u->lon,
				        	'label' => $u->code.' : 0%',
				        );
			        }
		        }
			}

			$this->data['barchart_label'] 			= $label;
			$this->data['barchart_teridentifikasi'] = $teridentifikasi;
			$this->data['barchart_termitigasi'] 	= $termitigasi;

			$this->data['map_risiko'] = $data_map_risk;
			/*END BAR CHART*/

			/*BEGIN RISK RADAR TOP 10*/
			$risk_radar_top_data = array();

			$i_top = 1;
			foreach($risk_radar as $rr){
				list($coorx, $coory)= $this->generateDotTop($rr['data']->level_name, $rr['data']->risk_category_alias, $risk_radar_top_data);

				$coorx_text = $coorx + 4;
				$coory_text = $coory + 4;

				$risk_radar_top_data[] = array(
					'x'=>$coorx,
					'y'=>$coory,
					'x_text'=>$coorx_text,
					'y_text'=>$coory_text,
					'number'=>$rr['data']->risk_item_number,
					'risk_item_id'=>$rr['data']->risk_item_id,
					'radius'=>3,
				);

				$i_top++;

				if($i_top > 10){
					break;
				}
			}

			$this->data['risk_radar_top_data'] = $risk_radar_top_data;
			/*END RISK RADAR TOP 10*/

			/*BEGIN RISK RADAR*/
			$risk_radar_data_table  = array();
			$risk_radar_data 		= array();

			foreach($risk_radar as $risk_register_id => $rr){
				if($risk_radar_data_table!=array() and isset($risk_radar_data_table[$rr['data']->level_name])){
					if(!array_key_exists($rr['data']->risk_category_alias, $risk_radar_data_table[$rr['data']->level_name])){
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}else{
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] += 1;
						$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
					}
				}else{
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['count'] = 1;
					$risk_radar_data_table[$rr['data']->level_name][$rr['data']->risk_category_alias]['data'][] = array($rr['data']->risk_item_id, $rr['data']->risk_item_number, $rr['data']->risk_item_name, $rr['data']->unit_name);
				}
			}

			
			$r=4;
			foreach($risk_radar_data_table as $level => $risk_data_table){
				foreach($risk_data_table as $alias => $value){
					list($coorx, $coory)= $this->generateDot($level, $alias);
					$coorx_text = $coorx + 7;
					$coory_text = $coory + 5;

					if($value['count']>5){
						$hasil = $value['count']/5;

						if($hasil>1 and $hasil<=2){
							$r+=2;
							$coorx_text+=2;
						}elseif ($hasil>2 and $hasil<=3) {
							$r+=4;
							$coorx_text+=4;
						}elseif ($hasil>3 and $hasil<=4) {
							$r+=6;
							$coorx_text+=6;
						}elseif ($hasil>4 and $hasil<=5) {
							$r+=8;
							$coorx_text+=8;
						}elseif ($hasil>5 and $hasil<=6) {
							$r+=10;
							$coorx_text+=10;
						}
					}

					$risk_radar_data[] = array(
						'x'=>$coorx,
						'y'=>$coory,
						'x_text'=>$coorx_text,
						'y_text'=>$coory_text,
						'count'=>$value['count'],
						'level'=>$level,
						'alias'=>$alias,
						'radius'=>$r,
					);
					
					/*reset*/
					$r=4;
				}
			}

			$this->data['risk_radar'] 		= $risk_radar_data;
			$this->data['risk_radar_table'] = $risk_radar_data_table;
			/*END RISK RADAR*/

			/*BEGIN DIRECTORATE PIE CHART*/
			$pie_directorate_data 	 = array();
			$riskDirectorateModel 	 = $this->risk_directorate_model->get_all();
			$summary_directorate_pie = 0;

			foreach($riskDirectorateModel as $rdm){
				if(!array_key_exists($rdm->id, $risk_directorate)){
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>0,
	    				'color'=>$rdm->color,
	    				'total_monitored'=>0,
	    			);
	    		}else{
	    			$pie_directorate_data[] = array(
	    				'directorate_id'=>$rdm->id,
	    				'directorate'=>$rdm->name,
	    				'value'=>$risk_directorate[$rdm->id]['total'],
	    				'color'=>$rdm->color,
	    				'total_monitored'=>$risk_directorate[$rdm->id]['monitored']
	    			);
	    		}
	    		$summary_directorate_pie++;
			}
			
			$this->data['directorate_pie'] 		   = $pie_directorate_data;
			$this->data['summary_directorate_pie'] = $summary_directorate_pie;
			/*END DIRECTORATE PIE CHART*/

			/*BEGIN CLASSIFICATION PIE CHART*/
			$pie_classification_data = array();
			$riskClassificationModel = $this->risk_classification_model->get_all();
			$summary_function_pie    = 0;

			foreach($riskClassificationModel as $rcm){
				if(!array_key_exists($rcm->id, $risk_classification)){
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>0,
	    				'color'=>$rcm->color,
	    				'total_monitored'=>0
	    			);
	    		}else{
	    			$pie_classification_data[] = array(
	    				'function_id'=>$rcm->id,
	    				'function'=>$rcm->name,
	    				'value'=>$risk_classification[$rcm->id]['total'],
	    				'color'=>$rcm->color,
	    				'total_monitored'=>$risk_classification[$rcm->id]['monitored']
	    			);
	    		}
	    		$summary_function_pie++;
			}
			$this->data['summary_function_pie'] = $summary_function_pie;
			$this->data['classification_pie']   = $pie_classification_data;
			/*END CLASSIFICATION PIE CHART*/

			/*START RISK REKAPITULASI TABLE*/
			$array_risk_percategory  				= array();
			$array_risk_item_summary 				= array();
			$array_risk_per_event_summary  			= array();
			$array_risk_per_event_mitigasi_summary  = array();
			$data_rekapitulasi 						= array();

			if(isset($rekapitulasi)){
	        	foreach($rekapitulasi as $rekap){
	        		/*rekap per risk item*/
	        		if(!isset($array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] = 1;
	        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
	        			
	        			/*summary*/
	        			$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			if(!in_array($rekap->risk_item_id, $array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'])){
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['count'] += 1;
		        			$array_risk_percategory[$rekap->unit_id][$rekap->category_name."_".$rekap->risk_category_alias]['ids'][] = $rekap->risk_item_id;
		        			
		        			/*summary*/
	        				$array_risk_item_summary[$rekap->unit_id][$rekap->category_name] += 1;
		        		}	
	        		}

	        		/*rekap per event summary teridentifikasi*/
	        		if(!isset($array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name])){
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}else{
	        			$array_risk_per_event_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        		}
		   
		        	/*rekap per event summary termitigasi*/
	        		if(!isset($array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name])){
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}else{
	        			if($rekap->status_dokumen == 6){
	        				$array_risk_per_event_mitigasi_summary[$rekap->unit_id][$rekap->category_name] += 1;
	        			}
	        		}
	        	}        	
	        }

	        $risk_categories = $this->risk_category_model->get_all();
	        $risks 			 = $this->risk_model->get_all();

	        foreach($units as $u){
	        	$target = $this->target_pencapaian_model->get_by_unit_id($u->id, $tahun);
	        	
	        	$data_rekapitulasi[$u->id]['code'] = $u->code;
	        	
	        	if($target){
	        		$data_rekapitulasi[$u->id]['start_date'] = $target->start_date;
	        		$data_rekapitulasi[$u->id]['end_date'] = $target->end_date;
	        	}else{
	        		$data_rekapitulasi[$u->id]['start_date'] = null;
	        		$data_rekapitulasi[$u->id]['end_date'] = null;
	        	}

	        	foreach($risk_categories as $rc){
	        		foreach ($risks as $r) {
	        			if(isset($array_risk_percategory[$u->id][$rc->name."_".$r->name_alias])){
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = $array_risk_percategory[$u->id][$rc->name."_".$r->name_alias]['count'];
			        	}else{
			        		$data_rekapitulasi[$u->id][$rc->name]['per_risk_category'][$r->name_alias] = 0;
			        	}
	        		}

	        		if(isset($array_risk_item_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = $array_risk_item_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_category'] = 0;
	        		}

	        		if(isset($array_risk_per_event_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = $array_risk_per_event_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_identifikasi'] = 0;
	        		}

	        		if(isset($array_risk_per_event_mitigasi_summary[$u->id][$rc->name])){
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = $array_risk_per_event_mitigasi_summary[$u->id][$rc->name];
	        		}else{
	        			$data_rekapitulasi[$u->id][$rc->name]['summary_risk_event_mitigasi'] = 0;
	        		}
	        	}
	        }
	        
	        $this->data['rekapitulasi'] = $data_rekapitulasi;
			/*END RISK REKAPITULASI TABLE*/
			
			/*PETA RISIKO RISK LEADERS*/
            $unit_id 		= $this->session->userdata('unit_id');
            $user_pic_ids 	= $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));

            $this->data['unit_report']  = $this->risk_model->get_by_unit_report($unit_id);

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);	
			$rows 	= $this->risk_identification_model->risk_map_monitoring_report($params);
			$resultRow = array();

			$i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_id, $row->risk_d_id);

                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Query*/
                    $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                    $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d,
                        'RiskProbability'     => $row->risk_k,
                        'RiskImpactId'        => $row->risk_d_id,
                        'RiskProbabilityId'   => $row->risk_k_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskValue'           => $riskLevelNames[0]->risk_levels
                    );
                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Query*/
                            $levels         = array("mst_risk_probabilities.id = '$row->risk_k_id' AND mst_risk_impacts.id = '$row->risk_d_id'" => null);
                            $riskLevelNames = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d,
                                'RiskProbability'     => $row->risk_k,
                                'RiskImpactId'        => $row->risk_d_id,
                                'RiskProbabilityId'   => $row->risk_k_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskValue'           => $riskLevelNames[0]->risk_levels
                            );
                            $i++;
                        }
                    }else{
                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d,
                            'RiskProbability'     => $row->risk_k,
                            'RiskImpactId'        => $row->risk_d_id,
                            'RiskProbabilityId'   => $row->risk_k_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskValue'           => $riskLevelNames[0]->risk_levels
                        );
                        $i++;
                    }
                }
            }

            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $tahun,
                'user_pic_ids_search' => $user_pic_ids
            ));

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*BEGIN SUMMARY RISK LEADERS*/
            $query = $this->db->select("sum(tri.TERIDENTIFIKASI) as total_event, sum(tri.TERMITIGASI) as total_mitigasi")
	        ->from('tx_risk_identification as tri')
	       	->where('tri.STATUS_DOKUMEN_ID IN(4,5,6) AND tri.UNIT_ID = '.$this->session->userdata('unit_id').' AND tri.TAHUN = '.$tahun)
	        ->get();

	        $sum_teridentifikasi_gm = 0;
	        $sum_termitigasi_gm 	= 0;

	      	if($query->num_rows() > 0){
	        	$result = $query->result();
	        	
	        	$sum_teridentifikasi_gm = $result[0]->total_event;
	        	$sum_termitigasi_gm 	= $result[0]->total_mitigasi;
	        }

	        $this->data['sum_teridentifikasi_gm'] 	= $sum_teridentifikasi_gm;
	        $this->data['sum_termitigasi_gm'] 		= $sum_termitigasi_gm;
	        /*END SUMMARY RISK LEADERS*/

	        /*BEGIN GOOGLE MAPS DATA*/
	        $maps_result = array();

	        foreach($units as $u){
	        	$result  = array();
            
	            $unit_id = $u->id;

	            $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

	            /*Risk Query Select*/
	            $rows = $this->risk_identification_model->get_risk_assessment_report($params);

	            if($rows){
	                foreach($rows as $row){
	                    $pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
	                    $pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

	                    $mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
	                    $mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

	                    $rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

	                    if(array_key_exists($row->RISK_ITEM_ID, $result)){
	                        $result[$row->RISK_ITEM_ID]['data'][] = $row;

	                        /*jika rangkingnya lebih besar*/
	                        if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
	                            $result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
	                            $result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
	                            $result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
	                        }

	                    }else{
	                        $result[$row->RISK_ITEM_ID] = array(
	                            'data'=>array($row),
	                            'rangking'=>$rangking,
	                            'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
	                            'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
	                        );
	                    }
	                }
	            }

	            $maps_result[$u->id] = $result;
	        }

	        /*echo "<pre/>";
	        var_dump($maps_result);die;*/
	        $this->data['data_maps_table'] = $maps_result;
	        /*END GOOGLE MAPS DATA*/
		}
		
		$this->template
			->load_module_partial('sections', 'welcome/hmvc/section_partial')
			/*Begin Flotchart*/
			->set_js_global('plugins/chartjs/Chart.min')
			->set_js_global('plugins/amcharts/amcharts/amcharts')
			->set_js_global('plugins/amcharts/amcharts/pie')
			->set_js_global('plugins/amcharts/amcharts/themes/light')
			->set_js_global('plugins/angularjs/angular.min')
            ->set_js_global('plugins/angularjs/angular-sanitize.min')
            ->set_js_global('plugins/angularjs/angular-touch.min')
            ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            ->set_js_global('plugins/angularjs/angular-risk-matrix')
            ->set_js_global('plugins/jspdf/jspdf.debug')
            ->set_js_global('plugins/html2canvas/html2canvas')
            ->set_js_global('plugins/riskchart/d3.min')
            ->set_js_global('plugins/riskchart/canvg')
            ->set_js_global('plugins/riskchart/riskchart')
			/*End Flotchart*/
			->build('welcome_residual_worksheet');
	}

	function get_event_detail_risk(){
        if(isset($_POST['risk_item_id'])){
            $risk_item_id 	= $_POST['risk_item_id'];
            $tahun          = $_POST['tahun'];

            /*Risk Query Select*/
            $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            
            $query = $this->db->select('tx_risk_identification.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                    mst_risk_probabilities.rating_value as risk_k, mst_risk_probabilities.id as risk_k_id, 
                    mst_risk_impacts.alphabet as risk_d, mst_risk_impacts.id as risk_d_id, tx_risk_identification.HAZARD as event, mst_units.name as branch, tx_risk_identification.PENYEBAB as penyebab, tx_risk_identification.DAMPAK as dampak, tx_risk_identification.PENGENDALIAN_YANG_TELAH_DILAKUKAN as sudah_pengendalian, tx_risk_mitigation.RENCANA_PENGENDALIAN as rencana_mitigasi, mst_risk_pics.name as pic, tx_risk_mitigation.TARGET_WAKTU as target_waktu')
            ->where('tx_risk_identification.STATUS_DOKUMEN_ID IN(4,5,6)') //STATUS_DOKUMEN_NAMA == ON MONITORING OR ON MITIGATED
            ->where($params, false, false)
            ->join('mst_risk_items','mst_risk_items.id = tx_risk_identification.RISK_ITEM_ID')
            ->join('mst_risk_probabilities','mst_risk_probabilities.id = tx_risk_identification.MITIGASI_RISK_K_ID')
            ->join('mst_risk_impacts','mst_risk_impacts.id = tx_risk_identification.MITIGASI_RISK_D_ID')
            ->join('mst_units','mst_units.id = tx_risk_identification.UNIT_ID')
            ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = tx_risk_identification.RISK_IDENTIFICATION_ID')
            ->join('mst_risk_pics','mst_risk_pics.id = tx_risk_mitigation.PIC_UNIT_KERJA_ID')
            //->group_by($this->table.'.HAZARD')
            ->order_by('tx_risk_identification.RISK_IDENTIFICATION_ID','asc')
            ->get('tx_risk_identification');

            $result = $query->result();

            echo json_encode($result);
        }
    }

    function get_event_branch_risk(){
        if(isset($_POST['unit_id'])){
        	$result  = array();
            
            $unit_id = $_POST['unit_id'];
            $tahun   = $_POST['tahun'];

            // /*Risk Query Select*/
            // $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            // $rows = $this->risk_identification_model->risk_map_monitoring_report($params);

            // echo json_encode($rows);

            $unit = $this->unit_model->get_by_id($unit_id);
            echo json_encode($unit->name);
        }
    }

    function get_event_directorate()
    {
    	if(isset($_POST['directorate_id']) and isset($_POST['tahun']) and isset($_POST['status_dokumen'])){

    		$directorate_id = $_POST['directorate_id'];
    		$tahun 			= $_POST['tahun'];
    		$status 	    = $_POST['status_dokumen'];

    		if($status==1){
    			$status_dokumen = "4,5,6";
    		}else{
    			$status_dokumen = "4,5";
    		}

    		$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, tri.HAZARD as hazard, tri.PENYEBAB as penyebab, tri.DAMPAK as dampak, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, mrd.name as risk_directorate_name,tri.RISK_CLASSIFICATION_ID as risk_classification_id, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name, mrp.rating_value as risk_k, mrim.alphabet as risk_d")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.RESIDUAL_RISK_K_ID AND mrv.risk_impact_id = tri.RESIDUAL_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
	       	->join('mst_risk_directorates as mrd', 'mrd.id = mri.risk_directorate_id', 'left')
	       	->join('mst_risk_probabilities as mrp', 'mrp.id = tri.RESIDUAL_RISK_K_ID', 'left')
	       	->join('mst_risk_impacts as mrim', 'mrim.id = tri.RESIDUAL_RISK_D_ID', 'left')
	       	->where('tri.STATUS_DOKUMEN_ID IN('.$status_dokumen.') AND tri.TAHUN = '.$tahun.' AND mri.risk_directorate_id = '.$directorate_id)
	        ->order_by('rangking','asc')
	        ->get();

            if($query->num_rows() > 0){
            	echo json_encode($query->result());
            }
    	}
    }

    function get_event_function()
    {
    	if(isset($_POST['function_id']) and isset($_POST['tahun']) and isset($_POST['status_dokumen'])){

    		$function_id = $_POST['function_id'];
    		$tahun 		 = $_POST['tahun'];
    		$status 	 = $_POST['status_dokumen'];

    		if($status==1){
    			$status_dokumen = "4,5,6";
    		}else{
    			$status_dokumen = "4,5";
    		}

    		$query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, tri.HAZARD as hazard, tri.PENYEBAB as penyebab, tri.DAMPAK as dampak, mri.name as risk_item_name, mri.risk_register_number as risk_item_number, mrv.rangking as rangking, mrl.id as risk_level_id, mrl.name as level_name, mrc.id as risk_category_id, mrc.name as risk_category_name, mrc.name_alias as risk_category_alias, mri.risk_directorate_id as risk_directorate_id, mrd.name as risk_directorate_name, tri.RISK_CLASSIFICATION_ID as risk_classification_id, mrcs.name as risk_classification_name, mu.id as unit_id, mu.name as unit_name, tri.STATUS_DOKUMEN_ID as status_dokumen, tri.TERIDENTIFIKASI as teridentifikasi, tri.TERMITIGASI as termitigasi, tri.RISK_IDENTIFICATION_ID as transaksi_id, rc.id as categori_id, rc.name as category_name, mrp.rating_value as risk_k, mrim.alphabet as risk_d")
	        ->from('tx_risk_identification as tri')
	        ->join('mst_risk_items as mri', 'mri.id = tri.RISK_ITEM_ID', 'left')
	        ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.RESIDUAL_RISK_K_ID AND mrv.risk_impact_id = tri.RESIDUAL_RISK_D_ID', 'left')
	       	->join('mst_risk_levels as mrl', 'mrl.id = mrv.risk_level_id', 'left')
	       	->join('mst_risks as mrc', 'mrc.id = mri.risk_id', 'left')
	       	->join('mst_units as mu', 'mu.id = tri.UNIT_ID', 'left')
	       	->join('mst_risk_categories as rc', 'rc.id = tri.RISK_CATEGORY_ID', 'left')
	       	->join('mst_risk_directorates as mrd', 'mrd.id = mri.risk_directorate_id', 'left')
	       	->join('ms_risk_classification as mrcs', 'mrcs.id = tri.RISK_CLASSIFICATION_ID', 'left')
	       	->join('mst_risk_probabilities as mrp', 'mrp.id = tri.RESIDUAL_RISK_K_ID', 'left')
	       	->join('mst_risk_impacts as mrim', 'mrim.id = tri.RESIDUAL_RISK_D_ID', 'left')
	       	->where('tri.STATUS_DOKUMEN_ID IN('.$status_dokumen.') AND tri.TAHUN = '.$tahun.' AND tri.RISK_CLASSIFICATION_ID = '.$function_id)
	        ->order_by('rangking','asc')
	        ->get();

            if($query->num_rows() > 0){
            	echo json_encode($query->result());
            }
    	}
    }

	public function index_kri()
	{
		$search    	= false;
		$tahun 		= date('Y');

		if(isset($_GET['tahun'])){
			$search = true;
			$tahun = $_GET['tahun'];
		} else {
			$search = true;
			$tahun = date('Y');
		}

		$params = "SELECT RISK_ITEM_ID FROM `tx_key_risk_indicator` WHERE TAHUN=$tahun GROUP BY RISK_ITEM_ID, TOP_RISK_NUMBER ORDER BY TOP_RISK_NUMBER ASC LIMIT 3";

		/*Query Select*/
		$this->data['rows'] = $this->key_risk_indicator_model->get_dashboard_kri($params);

		$this->data['search']           = $search;
		$this->data['tahun']            = $tahun;

		/*Build View*/
		$this->template->build('welcome_kri');
	}

	public function index_profile_kri()
	{
		$result = array();

		$search = false;
		$tahun  = date('Y');

		if(isset($_GET['tahun'])){
			$search = true;
			$tahun = $_GET['tahun'];
		} else {
			$search = true;
			$tahun = date('Y');
		}

		$params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=1 AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

		/* $params = "SELECT * FROM `tx_risk_identification`,
			(
           		SELECT `tx_risk_identification`.`RESIDUAL_RISK_K_ID` AS `RESIDUAL_RISK_K_ID_Q1`
           		FROM `tx_risk_identification`
           		LEFT JOIN `tx_risk_mitigation` ON `tx_risk_identification`.`RISK_IDENTIFICATION_ID`=`tx_risk_mitigation`.`RISK_IDENTIFICATION_ID`
				WHERE QUARTER(`tx_risk_mitigation`.`TARGET_WAKTU`) = 1 AND `tx_risk_identification`.`TAHUN`=$tahun AND `tx_risk_identification`.`UNIT_ID`=1 AND `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 ORDER BY `tx_risk_identification`.`RISK_ITEM_ID` ASC
       		) AS `RESIDUAL_RISK_K_ID_Q1`,
			(
           		SELECT `tx_risk_identification`.`RESIDUAL_RISK_D_ID` AS `RESIDUAL_RISK_D_ID_Q1`
           		FROM `tx_risk_identification`
           		LEFT JOIN `tx_risk_mitigation` ON `tx_risk_identification`.`RISK_IDENTIFICATION_ID`=`tx_risk_mitigation`.`RISK_IDENTIFICATION_ID`
				WHERE QUARTER(`tx_risk_mitigation`.`TARGET_WAKTU`) = 1 AND `tx_risk_identification`.`TAHUN`=$tahun AND `tx_risk_identification`.`UNIT_ID`=1 AND `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 ORDER BY `tx_risk_identification`.`RISK_ITEM_ID` ASC
       		) AS `RESIDUAL_RISK_D_ID_Q1`,
			(
           		SELECT `tx_risk_identification`.`MITIGASI_RISK_K_ID` AS `MITIGASI_RISK_K_ID_Q1`
           		FROM `tx_risk_identification`
           		LEFT JOIN `tx_risk_mitigation` ON `tx_risk_identification`.`RISK_IDENTIFICATION_ID`=`tx_risk_mitigation`.`RISK_IDENTIFICATION_ID`
				WHERE QUARTER(`tx_risk_mitigation`.`TARGET_WAKTU`) = 1 AND `tx_risk_identification`.`TAHUN`=$tahun AND `tx_risk_identification`.`UNIT_ID`=1 AND `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 ORDER BY `tx_risk_identification`.`RISK_ITEM_ID` ASC
       		) AS `MITIGASI_RISK_K_ID_Q1`,
			(
           		SELECT `tx_risk_identification`.`MITIGASI_RISK_D_ID` AS `MITIGASI_RISK_D_ID_Q1`
           		FROM `tx_risk_identification`
           		LEFT JOIN `tx_risk_mitigation` ON `tx_risk_identification`.`RISK_IDENTIFICATION_ID`=`tx_risk_mitigation`.`RISK_IDENTIFICATION_ID`
				WHERE QUARTER(`tx_risk_mitigation`.`TARGET_WAKTU`) = 1 AND `tx_risk_identification`.`TAHUN`=$tahun AND `tx_risk_identification`.`UNIT_ID`=1 AND `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 ORDER BY `tx_risk_identification`.`RISK_ITEM_ID` ASC
       		) AS `MITIGASI_RISK_D_ID_Q1`
			WHERE `tx_risk_identification`.`TAHUN`=$tahun AND `tx_risk_identification`.`UNIT_ID`=1 AND `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 GROUP BY `tx_risk_identification`.`RISK_ITEM_ID`"; */
		
		/*Risk Query Select*/
		$rows = $this->risk_identification_model->get_work_paper_report($params);

		if($rows){
			foreach($rows as $row){
				$pengendalian_probability  = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);
				$pengendalian_impact       = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

				$mitigasi_probability = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);
				$mitigasi_impact      = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

				$rangking = $this->risk_value_model->get_rangking($row->RESIDUAL_RISK_K_ID, $row->RESIDUAL_RISK_D_ID);

				if(array_key_exists($row->RISK_ITEM_ID, $result)){
					$result[$row->RISK_ITEM_ID]['data'][] = $row;

					/*jika rangkingnya lebih besar*/
					if($rangking < $result[$row->RISK_ITEM_ID]['rangking']){
						$result[$row->RISK_ITEM_ID]['rangking'] = $rangking;
						$result[$row->RISK_ITEM_ID]['nilai_perlakuan'] = $pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet;
						$result[$row->RISK_ITEM_ID]['nilai_mitigasi'] = $mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet;
					}

				}else{
					$result[$row->RISK_ITEM_ID] = array(
						'data'=>array($row),
						'rangking'=>$rangking,
						'nilai_perlakuan'=>$pengendalian_probability->rating_value.",".$pengendalian_impact->alphabet,
						'nilai_mitigasi'=>$mitigasi_probability->rating_value.",".$mitigasi_impact->alphabet,
					);
				}
			}
		}
		
		$this->data['rows'] = $result;

		$this->data['search']           = $search;
		$this->data['tahun']            = $tahun;

		/*Build View*/
		$this->template->build('welcome_profile_kri');
	}
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */