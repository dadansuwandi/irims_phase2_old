<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * My_api Controller
 *
 *
 * @package     my_api
 * @author      Wildan Sawaludin
*/

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('content-type: application/json; charset=utf-8');

class My_api_by_ldap extends CI_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // Load AddChat required libraries
        $this->load->helper(array('form', 'url', 'language'));
        $this->load->library(array('form_validation'));

        // Load Model
        $this->load->model('auth/user_model');
        $this->load->model('master/unit_model');
        $this->load->model('master/status_dokumen_model');
        $this->load->model('master/risk_model');
        $this->load->model('master/risk_item_model');
        $this->load->model('master/risk_probability_model');
    		$this->load->model('master/risk_impact_model');
        $this->load->model('master/risk_pic_model');
        $this->load->model('master/risk_category_model');
        $this->load->model('master/risk_value_model');
        $this->load->model('master/target_pencapaian_model');
        $this->load->model('risk/risk_identification_model');
        $this->load->model('risk/risk_identification_pic_model');
        $this->load->model('risk/risk_mitigation_model');
        $this->load->model('risk/log_model');
        $this->load->model('risk/risk_mitigation_file_model');
        
    }

    // get PHPINFO()
    public function get_phpinfo()
    {
		  phpinfo();
    }

    // get from temp_cookies table
    public function get_cookie_name()
    {
      $query = $this->user_model->get_cookie_name();
		  $data['nip'] = $query;
		  echo json_encode($data);
    }

    // get risk progress
    public function risk_progress()
    {
      if ($this->input->post('username') && $this->input->post('password')) {
        // get user from database
			  $user = $this->user_model->get_by_username($this->input->post('username'));
        if ($user && $this->user_model->check_password($this->input->post('password'), $user->password)) {
          $now = date('Y-m-d H:i:s');
				  if (!empty($user->expired)) {
					  $exp = $user->expired;
				  }
				  
          if ($now > $exp) {
					  echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
				  } else {
            $result = array();
            // get data
            if($this->input->post('unit_id') && $this->input->post('risk_category_id') && $this->input->post('status') && $this->input->post('tahun')){
              
                $unit_id          = $this->input->post('unit_id');
                $risk_category_id = $this->input->post('risk_category_id');
                if($this->input->post('status')=="MITIGATED"){
                  $status = 1;
                }elseif($this->input->post('status')=="MONITORING") {
                  $status = 0;
                }else{
                  $status = "ALL";
                }
                $tahun            = $this->input->post('tahun');

                
                $params = "SELECT * FROM `tx_risk_identification` WHERE UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND TERMITIGASI=$status AND TAHUN=$tahun AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                
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
                if ($result) {
                  $print = array();
                  $no = 1;
                  foreach ($result as $risk_item_id => $row) {
                    $risk_item = $this->risk_item_model->get_by_id($risk_item_id);
                    foreach($row['data'] as $data){
                      $mitigation = $this->risk_mitigation_model->get_data($data->RISK_IDENTIFICATION_ID);
                      for ($i=0; $i <= count($mitigation)-1; $i++) {
                        $ii = $i;
                      }

                      $print[]= array(
                        "NO" => $no++,
                        "RISK_IDENTIFICATION_ID" => $data->RISK_IDENTIFICATION_ID,
                        "RISK_REGISTER" => $risk_item->name,
                        "RISK_EVENT" => $data->HAZARD,
                        "PENYEBAB" => $data->PENYEBAB,
                        "DAMPAK" => $data->DAMPAK,
                        "INHERENT_RISK_K_ID" => $this->risk_probability_model->get_by_id($data->INHERENT_RISK_K_ID)->rating_value,
                        "INHERENT_RISK_D_ID" => $this->risk_impact_model->get_by_id($data->INHERENT_RISK_D_ID)->alphabet,
                        "PENGENDALIAN_YANG_TELAH_DILAKUKAN" => $data->PENGENDALIAN_YANG_TELAH_DILAKUKAN,
                        "RESIDUAL_RISK_K_ID" => $this->risk_probability_model->get_by_id($data->RESIDUAL_RISK_K_ID)->rating_value,
                        "RESIDUAL_RISK_D_ID" => $this->risk_impact_model->get_by_id($data->RESIDUAL_RISK_D_ID)->alphabet,
                        "RENCANA_PENGENDALIAN" => $mitigation[$ii]->RENCANA_PENGENDALIAN,
                        "PIC_UNIT_KERJA_ID" => $this->risk_pic_model->get_by_id($mitigation[$i]->PIC_UNIT_KERJA_ID)->name,
                        "TARGET_WAKTU" => $mitigation[$i]->TARGET_WAKTU,
                        "REALISASI_MITIGASI" => $mitigation[$ii]->REALISASI_MITIGASI,
                        "MITIGASI_RISK_K_ID" => $this->risk_probability_model->get_by_id($d->MITIGASI_RISK_K_ID)->rating_value,
                        "MITIGASI_RISK_D_ID" => $this->risk_impact_model->get_by_id($d->MITIGASI_RISK_D_ID)->alphabet,
                        "JUMLAH_TERIDENTIFIKASI" => $data->TERIDENTIFIKASI,
                        "JUMLAH_TERMITIGASI" => $data->TERMITIGASI,
                        "PIC_KANTOR_PUSAT_ID" => $this->risk_pic_model->get_by_id($mitigation[$i]->PIC_KANTOR_PUSAT_ID)->name,
                        "RISK_ITEM_CODE" => $risk_item->description,
                        "RISK_CATEGORY_ID" => $this->risk_category_model->get_by_id($d->RISK_CATEGORY_ID)->name,
                      );
                    }
                  }
                  echo json_encode($print, true);
                } else {
                  echo json_encode(array('code' => 204, 'status' => 'No Content'));
                }
            }
          }
        } else {
          echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
        }
      }
    }

    // get unit
    public function unit()
    {
      $apiHost    = getenv('API_HOST_DEV_AP2').'/mobile/ldap/is_valid/';
      $postData   = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );
      $json = $this->curl->simple_post($apiHost, $postData);
      $data = json_decode($json);

			// var_dump($data); die;

      if ($data && ($this->input->post('username') == $data->username))
			{
        // get data
        $data = $this->unit_model->get_list();
        echo json_encode($data, true);
      }else{
        echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
      }
      // if ($this->input->post('username') && $this->input->post('password')) {
      //   // get user from database
			//   $user = $this->user_model->get_by_username($this->input->post('username'));
      //   if ($user && $this->user_model->check_password($this->input->post('password'), $user->password)) {
      //     $now = date('Y-m-d H:i:s');
			// 	  if (!empty($user->expired)) {
			// 		  $exp = $user->expired;
			// 	  }
				  
      //     if ($now > $exp) {
			// 		  echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
			// 	  } else {
      //       // get data
      //       $data = $this->unit_model->get_list();
      //       echo json_encode($data, true);
      //     }
      //   } else {
      //     echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
      //   }
      // }
    }

    // get risk category
    public function risk_category()
    {
      if ($this->input->post('username') && $this->input->post('password')) {
        // get user from database
			  $user = $this->user_model->get_by_username($this->input->post('username'));
        if ($user && $this->user_model->check_password($this->input->post('password'), $user->password)) {
          $now = date('Y-m-d H:i:s');
				  if (!empty($user->expired)) {
					  $exp = $user->expired;
				  }
				  
          if ($now > $exp) {
					  echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
				  } else {
            // get data
            $data = $this->risk_category_model->get_list();
            echo json_encode($data, true);
          }
        } else {
          echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
        }
      }
    }

    // get risk register
    public function risk_register()
    {
      if ($this->input->post('username') && $this->input->post('password')) {
        // get user from database
			  $user = $this->user_model->get_by_username($this->input->post('username'));
        if ($user && $this->user_model->check_password($this->input->post('password'), $user->password)) {
          $now = date('Y-m-d H:i:s');
				  if (!empty($user->expired)) {
					  $exp = $user->expired;
				  }
				  
          if ($now > $exp) {
					  echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
				  } else {
            // get data
            $data = $this->risk_item_model->get_list();
            echo json_encode($data, true);
          }
        } else {
          echo json_encode(array('code' => 401, 'status' => 'Unauthorized'));
        }
      }
    }
    
}

/* My_api controller ends */