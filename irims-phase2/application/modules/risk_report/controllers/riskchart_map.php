<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Chart Map Controller.
     * 
     * @package App
     * @category Controller
     * @author Wildan Sawaludin
     */
    class riskchart_map extends Admin_Controller {

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
            $this->load->model('risk/log_model');
            $this->load->model('risk/risk_mitigation_file_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('risk_report/riskchart_map/index');
        }

        /*
        array[0] = apakah id itemnya sesuai
        array[1] = apakah rangkingnya lebih besar
        array[2] = key arraynya
        */
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

        /*untuk risk admin*/
        function index() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options_corporate();

            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->post('risk_category_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                if($riskCategoryId === "ALL") {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN."" => null);
                } else {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
                }
            endif;

            if($this->input->post('unit_id')):      
                $riskUnitId = $this->input->post('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->post('risk_category_id') && $this->input->post('unit_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                $riskUnitId = $this->input->post('unit_id');
                if($riskCategoryId === "ALL") {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                } else {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                }
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->post('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($this->input->post('unit_id'));
            $this->data['tahun_report'] =  $this->input->post('tahun');

            /*Risk Query Select*/
    		$rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal-bs3patch')
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal')
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
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-list');
        }

        /*untuk risk admin*/
        function index_pdf() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options_corporate();

            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->get('risk_category_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
            endif;

            if($this->input->get('unit_id')):      
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->get('risk_category_id') && $this->input->get('unit_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($this->input->get('unit_id'));
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-list');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map.pdf", array("Attachment"=>1));
        }

        function index_mitigated() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options_corporate();

            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->post('risk_category_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                if($riskCategoryId === "ALL") {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN."" => null);
                } else {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
                }
            endif;

            if($this->input->post('unit_id')):      
                $riskUnitId = $this->input->post('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->post('risk_category_id') && $this->input->post('unit_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                $riskUnitId = $this->input->post('unit_id');
                if($riskCategoryId === "ALL") {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                } else {
                    $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                }
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->post('risk_category_id'));
            $this->data['unit_report']          = $this->risk_model->get_by_unit_report($this->input->post('unit_id'));
            $this->data['tahun_report']         =  $this->input->post('tahun');

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_report_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                        'Id'                   => $i,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                                'Id'                   => $i,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                            'Id'                   => $i,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);
            $this->data['rowsMerge']    = $mergeResultRow;

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal-bs3patch')
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal')
                ->set_js_global('plugins/angularjs/angular.min')
                ->set_js_global('plugins/angularjs/angular-sanitize.min')
                ->set_js_global('plugins/angularjs/angular-touch.min')
                ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
                ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
                ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
                ->set_js_global('plugins/angularjs/angular-risk-matrix-custom')
                ->set_js_global('plugins/jspdf/jspdf.debug')
                ->set_js_global('plugins/html2canvas/html2canvas')
                ->set_js_global('plugins/riskchart/d3.min')
                ->set_js_global('plugins/riskchart/canvg')
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-mitgated-list');
        }

        function index_mitigated_pdf() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options_corporate();

            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->get('risk_category_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
            endif;

            if($this->input->get('unit_id')):      
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->get('risk_category_id') && $this->input->get('unit_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.TIPE_KERTAS_KERJA = ".TIPE_KERTAS_KERJA_BUMN." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report']          = $this->risk_model->get_by_unit_report($this->input->get('unit_id'));
            $this->data['tahun_report']         =  $this->input->get('tahun');

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix-custom');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-mitgated-list');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-mitgated-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_mitigated.pdf", array("Attachment"=>1));
        }

        function index_identification() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options();

            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->post('risk_category_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
            endif;

            if($this->input->post('unit_id')):      
                $riskUnitId = $this->input->post('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->post('risk_category_id') && $this->input->post('unit_id')):      
                $riskCategoryId = $this->input->post('risk_category_id');
                $riskUnitId = $this->input->post('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->post('risk_category_id'));
            $this->data['unit_report']          = $this->risk_model->get_by_unit_report($this->input->post('unit_id'));
            $this->data['tahun_report']         =  $this->input->post('tahun');

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_identification_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                        'Id'                   => $i,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                                'Id'                   => $i,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                            'Id'                   => $i,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*merge array for map diagram*/
            //$mergeResultRow = array_merge($resultRow, $resultRowAfter);

            //$this->data['rows']         = $rowTable;
            //$this->data['jsonRowsData'] = json_encode($mergeResultRow);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal-bs3patch')
                ->set_css_global('plugins/bootstrap-modal/css/bootstrap-modal')
                ->set_js_global('plugins/angularjs/angular.min')
                ->set_js_global('plugins/angularjs/angular-sanitize.min')
                ->set_js_global('plugins/angularjs/angular-touch.min')
                ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
                ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
                ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
                ->set_js_global('plugins/angularjs/angular-risk-matrix-custom')
                ->set_js_global('plugins/jspdf/jspdf.debug')
                ->set_js_global('plugins/html2canvas/html2canvas')
                ->set_js_global('plugins/riskchart/d3.min')
                ->set_js_global('plugins/riskchart/canvg')
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-identification-list');
        }

        function index_identification_pdf() {
            /*Risk Filter*/
            $tahun = date('Y');
            $riskUnitIdDefault = 0;

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            $this->data['unit'] = $this->unit_model->drop_options();

            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.TAHUN =".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitIdDefault."" => null);

            if($this->input->get('risk_category_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
            endif;

            if($this->input->get('unit_id')):      
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            if($this->input->get('risk_category_id') && $this->input->get('unit_id')):      
                $riskCategoryId = $this->input->get('risk_category_id');
                $riskUnitId = $this->input->get('unit_id');
                $params = array("tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
            endif;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report']          = $this->risk_model->get_by_unit_report($this->input->get('unit_id'));
            $this->data['tahun_report']         =  $this->input->get('tahun');

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            /*merge array for map diagram*/
            //$mergeResultRow = array_merge($resultRow, $resultRowAfter);

            //$this->data['rows']         = $rowTable;
            //$this->data['jsonRowsData'] = json_encode($mergeResultRow);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->data['unit_id'],
                'tahun_search' => $this->data['tahun'],
                'risk_category_id_search' => $this->data['risk_category_id']
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix-custom');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-mitgated-list');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-identification-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_identification.pdf", array("Attachment"=>1));
        }
    	
        /*untuk risk owner*/
        function owner() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_id = $this->session->userdata('pic_id');


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
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
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-list-owner');
        }

        /*untuk risk owner_pdf*/
        function owner_pdf() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_id = $this->session->userdata('pic_id');


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-list-owner');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-list-owner-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_owner.pdf", array("Attachment"=>1));
        }

        function index_mitigated_owner() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_id = $this->session->userdata('pic_id');


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_js_global('plugins/angularjs/angular.min')
                ->set_js_global('plugins/angularjs/angular-sanitize.min')
                ->set_js_global('plugins/angularjs/angular-touch.min')
                ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
                ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
                ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
                ->set_js_global('plugins/angularjs/angular-risk-matrix-custom')
                ->set_js_global('plugins/jspdf/jspdf.debug')
                ->set_js_global('plugins/html2canvas/html2canvas')
                ->set_js_global('plugins/riskchart/d3.min')
                ->set_js_global('plugins/riskchart/canvg')
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-mitgated-list-owner');
        }

        function index_mitigated_owner_pdf() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_id = $this->session->userdata('pic_id');


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix-custom');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-mitgated-list-owner');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-mitgated-list-owner-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_mitigated_owner.pdf", array("Attachment"=>1));
        }

        /*untuk risk gm*/
        function gm() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            //$params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            
            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_ids_search' => $user_pic_ids
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
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
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-list-gm');
        }

        /*untuk risk gm*/
        function gm_pdf() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            //$params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_ids_search' => $user_pic_ids
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-list-gm');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-list-gm-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_gm.pdf", array("Attachment"=>1));
        }

        function index_mitigated_gm() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            //$params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_ids_search' => $user_pic_ids
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_js_global('plugins/angularjs/angular.min')
                ->set_js_global('plugins/angularjs/angular-sanitize.min')
                ->set_js_global('plugins/angularjs/angular-touch.min')
                ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
                ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
                ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
                ->set_js_global('plugins/angularjs/angular-risk-matrix-custom')
                ->set_js_global('plugins/jspdf/jspdf.debug')
                ->set_js_global('plugins/html2canvas/html2canvas')
                ->set_js_global('plugins/riskchart/d3.min')
                ->set_js_global('plugins/riskchart/canvg')
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-mitgated-list-gm');
        }

        function index_mitigated_gm_pdf() {
            /*Risk Filter*/
            $tahun       = date('Y');
            $unit_id     = $this->session->userdata('unit_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            //$params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_ids_search' => $user_pic_ids
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix-custom');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-mitgated-list-gm');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-mitgated-list-gm-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_mitigated_gm.pdf", array("Attachment"=>1));
        }

        /*untuk risk head*/
        function head() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_id  = $this->session->userdata('pic_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            //$params = array("(tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report_head($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
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
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-list-head');
        }

        /*untuk risk head*/
        function head_pdf() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_id  = $this->session->userdata('pic_id');
            $user_pic_ids = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            //$params = array("(tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_monitoring_report_head($params);
            
            /*prepare data result*/
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

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            $this->data['rows']         = $resultRow;
            $this->data['jsonRowsData'] = json_encode($resultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-list-head');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-list-head-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_head.pdf", array("Attachment"=>1));
        }

        function index_mitigated_head() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_id  = $this->session->userdata('pic_id');


            if($this->input->post('tahun')):            
                $tahun = $this->input->post('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            //$params = array("(tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report_head($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            $this->template
                // <!-- BEGIN CORE ANGULARJS PLUGINS -->
                ->set_js_global('plugins/angularjs/angular.min')
                ->set_js_global('plugins/angularjs/angular-sanitize.min')
                ->set_js_global('plugins/angularjs/angular-touch.min')
                ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
                ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
                ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
                ->set_js_global('plugins/angularjs/angular-risk-matrix-custom')
                ->set_js_global('plugins/jspdf/jspdf.debug')
                ->set_js_global('plugins/html2canvas/html2canvas')
                ->set_js_global('plugins/riskchart/d3.min')
                ->set_js_global('plugins/riskchart/canvg')
                ->set_js_global('plugins/riskchart/riskchart-map')
                // <!-- END CORE ANGULARJS PLUGINS -->
                ->build('riskchart-map-mitgated-list-head');
        }

        function index_mitigated_head_pdf() {
            /*Risk Filter*/
            $tahun        = date('Y');
            $unit_id      = $this->session->userdata('unit_id');
            $user_pic_id  = $this->session->userdata('pic_id');


            if($this->input->get('tahun')):            
                $tahun = $this->input->get('tahun');
            endif;

            $params = array("tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
            //$params = array("(tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);

            /*Title Report*/
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);

            /*Risk Query Select*/
            $rows = $this->risk_identification_model->risk_map_mitigated_report_head($params);
            
            /*prepare data result*/
            $resultRow      = array();
            $resultRowAfter = array();
            $rowTable       = array();

            $i=1;
            foreach($rows as $row){
                $rangking = $this->risk_value_model->get_rangking($row->risk_k_monitoring_id, $row->risk_d_monitoring_id);
            
                list($check_risk_item, $check_rangking, $key) = $this->check_rangking($row->risk_item_id, $rangking, $resultRow);

                if($resultRow == array()){
                    /*Risk Level Name Before Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                    $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                    /*Risk Level Name After Query*/
                    $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                    $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                    $resultRow[] = array(
                        'Id'                  => $i,
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_monitoring,
                        'RiskProbability'     => $row->risk_k_monitoring,
                        'RiskImpactId'        => $row->risk_d_monitoring_id,
                        'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'BEFORE',
                        'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                    );

                    $resultRowAfter[] = array(
                        'Id'                  => $i."'",
                        'Title'               => 'Risk '.$i,   
                        'Description'         => $row->risk_name,
                        'RiskImpact'          => $row->risk_d_mitigated,
                        'RiskProbability'     => $row->risk_k_mitigated,
                        'RiskImpactId'        => $row->risk_d_mitigated_id,
                        'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                        'RiskIdentifikasiId'  => $row->risk_identification_id,
                        'RiskItemiId'         => $row->risk_item_id,
                        'Rangking'            => $rangking,
                        'RiskCSSColor'        => 'AFTER',
                        'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                    );

                    $rowTable[] = array(
                        'description'          => $row->risk_name,
                        'risk_k_monitoring'    => $row->risk_k_monitoring,
                        'risk_d_monitoring'    => $row->risk_d_monitoring,
                        'risk_k_mitigated'     => $row->risk_k_mitigated,
                        'risk_d_mitigated'     => $row->risk_d_mitigated,
                        'risk_identifikasi_id' => $row->risk_identification_id,
                        'risk_item_id'         => $row->risk_item_id,
                    );

                    $i++;
                }else{
                    if($check_risk_item){
                        if($check_rangking){
                            /*Risk Level Name Before Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                            $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                            /*Risk Level Name After Query*/
                            $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                            $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                            $resultRow[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_monitoring,
                                'RiskProbability'     => $row->risk_k_monitoring,
                                'RiskImpactId'        => $row->risk_d_monitoring_id,
                                'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'BEFORE',
                                'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                            );

                            $resultRowAfter[$key] = array(
                                'Id'                  => $i,
                                'Title'               => 'Risk '.$i,   
                                'Description'         => $row->risk_name,
                                'RiskImpact'          => $row->risk_d_mitigated,
                                'RiskProbability'     => $row->risk_k_mitigated,
                                'RiskImpactId'        => $row->risk_d_mitigated_id,
                                'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                                'RiskIdentifikasiId'  => $row->risk_identification_id,
                                'RiskItemiId'         => $row->risk_item_id,
                                'Rangking'            => $rangking,
                                'RiskCSSColor'        => 'AFTER',
                                'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                            );

                            $rowTable[$key] = array(
                                'description'          => $row->risk_name,
                                'risk_k_monitoring'    => $row->risk_k_monitoring,
                                'risk_d_monitoring'    => $row->risk_d_monitoring,
                                'risk_k_mitigated'     => $row->risk_k_mitigated,
                                'risk_d_mitigated'     => $row->risk_d_mitigated,
                                'risk_identifikasi_id' => $row->risk_identification_id,
                                'risk_item_id'         => $row->risk_item_id,
                            );
                        }
                    }else{
                        /*Risk Level Name Before Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_monitoring_id' AND mst_risk_impacts.id = '$row->risk_d_monitoring_id'" => null);
                        $riskLevelNamesBefore = $this->risk_value_model->get_risk_level_name($levels);

                        /*Risk Level Name After Query*/
                        $levels               = array("mst_risk_probabilities.id = '$row->risk_k_mitigated_id' AND mst_risk_impacts.id = '$row->risk_d_mitigated_id'" => null);
                        $riskLevelNamesAfter = $this->risk_value_model->get_risk_level_name($levels);

                        $resultRow[] = array(
                            'Id'                  => $i,
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_monitoring,
                            'RiskProbability'     => $row->risk_k_monitoring,
                            'RiskImpactId'        => $row->risk_d_monitoring_id,
                            'RiskProbabilityId'   => $row->risk_k_monitoring_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'BEFORE',
                            'RiskValue'           => $riskLevelNamesBefore[0]->risk_levels
                        );

                        $resultRowAfter[] = array(
                            'Id'                  => $i."'",
                            'Title'               => 'Risk '.$i,   
                            'Description'         => $row->risk_name,
                            'RiskImpact'          => $row->risk_d_mitigated,
                            'RiskProbability'     => $row->risk_k_mitigated,
                            'RiskImpactId'        => $row->risk_d_mitigated_id,
                            'RiskProbabilityId'   => $row->risk_k_mitigated_id,
                            'RiskIdentifikasiId'  => $row->risk_identification_id,
                            'RiskItemiId'         => $row->risk_item_id,
                            'Rangking'            => $rangking,
                            'RiskCSSColor'        => 'AFTER',
                            'RiskValue'           => $riskLevelNamesAfter[0]->risk_levels
                        );

                        $rowTable[] = array(
                            'description'          => $row->risk_name,
                            'risk_k_monitoring'    => $row->risk_k_monitoring,
                            'risk_d_monitoring'    => $row->risk_d_monitoring,
                            'risk_k_mitigated'     => $row->risk_k_mitigated,
                            'risk_d_mitigated'     => $row->risk_d_mitigated,
                            'risk_identifikasi_id' => $row->risk_identification_id,
                            'risk_item_id'         => $row->risk_item_id,
                        );

                        $i++;
                    }
                }
            }

            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $tahun;
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

            /*merge array for map diagram*/
            $mergeResultRow = array_merge($resultRow, $resultRowAfter);

            $this->data['rows']         = $rowTable;
            $this->data['jsonRowsData'] = json_encode($mergeResultRow);

            /*set session search*/
            $this->session->set_userdata(array(
                'unit_search' => $this->session->userdata('unit_id'),
                'tahun_search' => $this->data['tahun'],
                'user_pic_id_search' => $this->session->userdata('pic_id')
            ));

            /*Build View*/
            // $this->template
            //     // <!-- BEGIN CORE ANGULARJS PLUGINS -->
            //     ->set_js_global('plugins/angularjs/angular.min')
            //     ->set_js_global('plugins/angularjs/angular-sanitize.min')
            //     ->set_js_global('plugins/angularjs/angular-touch.min')
            //     ->set_js_global('plugins/angularjs/plugins/angular-ui-router.min')
            //     ->set_js_global('plugins/angularjs/plugins/ocLazyLoad.min')
            //     ->set_js_global('plugins/angularjs/plugins/ui-bootstrap-tpls.min')
            //     ->set_js_global('plugins/angularjs/angular-risk-matrix-custom');
            //     // <!-- END CORE ANGULARJS PLUGINS -->
            //     //->build('riskchart-map-mitgated-list-head');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('riskchart-map-mitgated-list-head-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-sanitize.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-touch.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
            $this->pdf->set_base_path(base_url().'assets/global/plugins/angularjs/angular-risk-matrix.js');
            $this->pdf->stream(date("Ymd")."_riskchart_map_mitigated_head.pdf", array("Attachment"=>1));
        }

    	function view($id) {
    		/*$this->data['row']            = $this->risk_identification_model->get_by_id((int) $id);
            $this->data['pic_unit_kerja'] = $this->risk_identification_pic_model->get_data_pic($id, 0);
            $this->data['logs']           = $this->log_model->get_by_risk_identification_id($id);
            
            $this->template->build('risk-identification-view');*/
        }

        function get_event_detail(){
            if(isset($_POST['risk_item_id'])){
                $type         = $_POST['type'];
                $risk_item_id = $_POST['risk_item_id'];

                $tahun          = date('Y');
                if(isset($_POST['tahun'])){
                    $tahun = $_POST['tahun'];
                }

                if($type=="risk-admin"){
                    if($this->session->userdata('tahun_search')):            
                        $tahun = $this->session->userdata('tahun_search');
                    endif;

                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    if($this->session->userdata('risk_category_id_search_search')):      
                        $riskCategoryId = $this->session->userdata('risk_category_id_search_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
                    endif;

                    if($this->session->userdata('unit_search')):      
                        $riskUnitId = $this->session->userdata('unit_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                    endif;

                    if($this->session->userdata('risk_category_id_search_search') && $this->session->userdata('unit_search')):      
                        $riskCategoryId = $this->session->userdata('risk_category_id_search_search');
                        $riskUnitId = $this->session->userdata('unit_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                    endif;

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_monitoring_report($params);

                    echo json_encode($rows);
                }

                if($type=="owner"){
                    $unit_id     = $this->session->userdata('unit_search');
                    $user_pic_id = $this->session->userdata('user_pic_id_search');

                    if($this->session->userdata('tahun_search')):            
                        $tahun = $this->session->userdata('tahun_search');
                    endif;

                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_monitoring_report($params);

                    echo json_encode($rows);
                }

                if($type=="gm"){
                    $unit_id      = $this->session->userdata('unit_search');
                    $user_pic_ids = $this->session->userdata('user_pic_ids_search');
                    
                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    
                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_monitoring_report($params);

                    echo json_encode($rows);
                }

                if($type=="head"){
                    $unit_id      = $this->session->userdata('unit_search');
                    $user_pic_id  = $this->session->userdata('user_pic_id_search');

                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND (tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_monitoring_report_head($params);

                    echo json_encode($rows);
                }
            }
        }

        function get_event_detail_mitigation(){
            if(isset($_POST['risk_item_id'])){
                $type         = $_POST['type'];
                $risk_item_id = $_POST['risk_item_id'];

                $tahun          = date('Y');

                if($type=="risk-admin"){
                    if($this->session->userdata('tahun_search')):            
                        $tahun = $this->session->userdata('tahun_search');
                    endif;

                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    if($this->session->userdata('risk_category_id_search_search')):      
                        $riskCategoryId = $this->session->userdata('risk_category_id_search_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId."" => null);
                    endif;

                    if($this->session->userdata('unit_search')):      
                        $riskUnitId = $this->session->userdata('unit_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                    endif;

                    if($this->session->userdata('risk_category_id_search_search') && $this->session->userdata('unit_search')):      
                        $riskCategoryId = $this->session->userdata('risk_category_id_search_search');
                        $riskUnitId = $this->session->userdata('unit_search');
                        $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN = ".$tahun." AND tx_risk_identification.RISK_CATEGORY_ID = ".$riskCategoryId." AND tx_risk_identification.UNIT_ID = ".$riskUnitId."" => null);
                    endif;

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_mitigated_report($params);

                    echo json_encode($rows);
                }

                if($type=="owner"){
                    $unit_id     = $this->session->userdata('unit_search');
                    $user_pic_id = $this->session->userdata('user_pic_id_search');

                    if($this->session->userdata('tahun_search')):            
                        $tahun = $this->session->userdata('tahun_search');
                    endif;

                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID = ".$user_pic_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_mitigated_report($params);

                    echo json_encode($rows);
                }

                if($type=="gm"){
                    $unit_id      = $this->session->userdata('unit_search');
                    $user_pic_ids = $this->session->userdata('user_pic_ids_search');
                    
                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.USER_PIC_ID IN (".$user_pic_ids.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.UNIT_ID = ".$unit_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    
                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_mitigated_report($params);

                    echo json_encode($rows);
                }

                if($type=="head"){
                    $unit_id      = $this->session->userdata('unit_search');
                    $user_pic_id  = $this->session->userdata('user_pic_id_search');

                    //$params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND (tx_risk_identification.USER_PIC_ID = ".$user_pic_id." OR `tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = ".$user_pic_id.") AND tx_risk_identification.TAHUN =".$tahun."" => null);
                    $params = array("tx_risk_identification.RISK_ITEM_ID = ".$risk_item_id." AND tx_risk_identification.TAHUN =".$tahun."" => null);

                    /*Risk Query Select*/
                    $rows = $this->risk_identification_model->risk_map_mitigated_report_head($params);

                    echo json_encode($rows);
                }
            }
        }
    }
?>
