<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Assessment Register Card Controller.
     * 
     * @package App
     * @category Controller
     * @author Jaya Dianto
     */
    class risk_assessment_register_card extends Admin_Controller {

        protected $form = array(

        );

        function __construct() {
            parent::__construct();
            $this->load->model('risk/risk_identification_model');
            $this->load->model('risk/risk_identification_pic_model');
            $this->load->model('risk/risk_mitigation_model');
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
            $this->load->model('risk/log_model');
            $this->load->model('risk/risk_mitigation_file_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('report/risk_assessment_report/index');
        }

        function index() {
          
            $result = array();

            $search           = false;
            $unit_id          = "";
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['unit']          = $this->unit_model->drop_options();
            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->post('unit_id') && $this->input->post('tahun') && $this->input->post('status') && $this->input->post('risk_category_id')){
                $search = true;

                $unit_id          = $this->input->post('unit_id');
                $tahun            = $this->input->post('tahun');
                $risk_category_id = $this->input->post('risk_category_id');

                if($this->input->post('status')=="Y"){
                    $status = 1;
                }elseif($this->input->post('status')=="N") {
                    $status = 0;
                }else{
                    $status = "ALL";
                }

                if(($risk_category_id === "ALL") AND ($status === "ALL")){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }
                
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
                
                $this->data['rows'] = $result;
                echo $params;
            }

            $this->data['search']           = $search;
            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*Build View*/
            $this->template->build('risk-assessment-report-list');
        }

     
        function filter() {
        
            // /*Build View*/
            // $this->template->build('risk-assessment-register-card');
            $params = "SELECT *,`mst_risk_items`. `name`as `risk_register` , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
            LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
            LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
            LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
            WHERE 
                `tx_risk_identification`.`TAHUN`='2021' AND 
                `mst_risk_items`.`risk_id`='1' AND 
                `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
            GROUP BY 
                `tx_risk_identification`.`RISK_ITEM_ID`, `mst_risk_items`.`risk_register_number`
            ORDER BY 
                `tx_risk_identification`.`RISK_ITEM_ID` ASC";
        
        /*Risk Query Select*/
        $rows = $this->risk_identification_model->get_risk_assessment_report($params);
       //echo(DataTable::of($rows)->toJson());
        //return DataTable::of($rows)->toJson();
       // $this->datatables->from($rows);
        echo json_encode($rows); 
        //return $rows->result();


        }

        function register_card_pdf() {
            $result = array();

            $search           = false;
            $tahun            = date('Y');
            $risk_id          = "";

            $this->data['risk']          = $this->risk_model->drop_options();

            if($this->input->get('tahun') && $this->input->get('risk_id')){
                $search = true;

                $tahun            = $this->input->get('tahun');
                $risk_id          = $this->input->get('risk_id');

                $params = "SELECT * , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
                    LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
                    LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
                    LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
                    WHERE 
                        `tx_risk_identification`.`TAHUN`=$tahun AND 
                        `mst_risk_items`.`risk_id`=$risk_id AND 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    GROUP BY 
                        `tx_risk_identification`.`RISK_ITEM_ID`, `mst_risk_items`.`risk_register_number`
                    ORDER BY 
                        `tx_risk_identification`.`RISK_ITEM_ID` ASC";
                
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
                
                $this->data['rows'] = $result;
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['risk_id']          = $this->input->get('risk_id');

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a4', 'portrait');
            $this->pdf->load_view('risk-assessment-register-card-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_register_card.pdf", array("Attachment"=>1));
        }

        function register_card_detail() {
            $result = array();
            $tahun            = date('Y');

            if($this->input->get('tahun') && $this->input->get('risk_item_id')){

                $params = "SELECT * , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
                    LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
                    LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
                    LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
                    WHERE 
                        `tx_risk_identification`.`TAHUN`=".$this->input->get('tahun')." AND 
                        `tx_risk_identification`.`RISK_ITEM_ID`=".$this->input->get('risk_item_id')." AND 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    ORDER BY 
                        `tx_risk_identification`.`UNIT_ID` ASC";
                
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
                
                $this->data['rows'] = $result;
            }

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['risk_register_report'] = $this->risk_item_model->get_by_id($this->input->get('risk_item_id'));
            $this->data['risk_register_no_report'] = $this->input->get('risk_no');
            $this->data['risk_level_report'] = $this->input->get('risk_level');

            /*Build View*/
            $this->template->build('risk-assessment-register-card-detail');
        }

        function register_card_detail_pdf() {
            $result = array();
            $tahun            = date('Y');

            if($this->input->get('tahun') && $this->input->get('risk_item_id')){

                $params = "SELECT * , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
                    LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
                    LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
                    LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
                    WHERE 
                        `tx_risk_identification`.`TAHUN`=".$this->input->get('tahun')." AND 
                        `tx_risk_identification`.`RISK_ITEM_ID`=".$this->input->get('risk_item_id')." AND 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    ORDER BY 
                        `tx_risk_identification`.`UNIT_ID` ASC";
                
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
                
                $this->data['rows'] = $result;
            }

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['risk_register_report'] = $this->risk_item_model->get_by_id($this->input->get('risk_item_id'));
            $this->data['risk_register_no_report'] = $this->input->get('risk_no');
            $this->data['risk_level_report'] = $this->input->get('risk_level');

            /*Build View PDF*/
            $this->pdf->set_paper('a2', 'landscape');
            $this->pdf->load_view('risk-assessment-register-card-detail-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_register_card_detail.pdf", array("Attachment"=>1));
        }

        function view($id, $type){
            $this->data['logs']           = $this->log_model->get_by_risk_identification_id($id);
            $this->data['risk_mitigation_files'] = $this->risk_mitigation_file_model->get_by_risk_identification_id($id);
            $this->data['d'] = $this->risk_identification_model->get_by_id($id);
            $this->data['type'] = $type;

            /*Build View*/
            $this->template->build('risk-assessment-report-view');
        }
    }
?>