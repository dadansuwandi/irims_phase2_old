<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Work Paper Report Controller.
     * 
     * @package App
     * @category Controller
     * @author Wildan Sawaludin
     */
    class work_paper_report extends Admin_Controller {

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
            $this->load->model('master/risk_level_model');
            $this->load->model('master/target_pencapaian_model');
            $this->load->model('risk/log_model');
            $this->load->model('risk/risk_mitigation_file_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('risk_report/work_paper_report/index');
        }

        function index() {
            $result = array();

            $search           = false;
            $unit_id          = "";
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['unit']          = $this->unit_model->drop_options_corporate();
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
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID <= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND STATUS_DOKUMEN_ID <= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID <= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID <= 4 ORDER BY RISK_ITEM_ID ASC";
                }
                
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
            }

            $this->data['search']           = $search;
            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*Build View*/
            $top_risk = $this->input->post('top_risk');
            if ($top_risk == 'yes') {
                $this->template->build('work-paper-report-list-top-risk');    
            } else {
                $this->template->build('work-paper-report-list');
            }
        }

        function index_pdf() {
            $result 		  = array();

            $search           = false;
            $unit_id          = "";
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['unit']          = $this->unit_model->drop_options_corporate();
            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->get('unit_id') && $this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $unit_id          = $this->input->get('unit_id');
                $tahun            = $this->input->get('tahun');
                $risk_category_id = $this->input->get('risk_category_id');

                //get params selected_print
                $query  = explode('&', $_SERVER['QUERY_STRING']);
                $params = array();
                foreach( $query as $param ) {
                    // prevent notice on explode() if $param has no '='
                    if (strpos($param, '=') === false) $param += '=';

                    list($name, $value) = explode('=', $param, 2);
                    $params[urldecode($name)][] = urldecode($value);
                }
                $selected_print   = implode(",", $params['selected_print']);


                if($this->input->get('status')=="Y"){
                    $status = 1;
                }elseif($this->input->get('status')=="N") {
                    $status = 0;
                }else{
                    $status = "ALL";
                }

                if(($risk_category_id === "ALL") AND ($status === "ALL")){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID <= 4 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND STATUS_DOKUMEN_ID <= 4 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID <= 4 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID <= 4 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }

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
            }

            $this->data['search']           = $search;
            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

             /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

			
			// /*Build View PDF*/
            // $this->pdf->set_paper('a3', 'landscape');
            // $this->pdf->load_view('work-paper-report-list-pdf-adkom', $this->data);
            // $this->pdf->render();
            // $this->pdf->stream(date("Ymd")."_risk_admin.pdf", array("Attachment"=>1));
			
			
			/*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
			if($risk_category_id == "1"){
				$this->pdf->load_view('work-paper-report-list-pdf-opstek', $this->data);				
			} elseif($risk_category_id == "2") {
				$this->pdf->load_view('work-paper-report-list-pdf-adkom', $this->data);					
			} else {
                $this->pdf->load_view('work-paper-report-list-pdf', $this->data);
            }
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_admin.pdf", array("Attachment"=>1));
			
			
            // $this->load->view('work-paper-report-list', $this->data);
        }

        function index_monev() {
            $result = array();

            $search           = false;
            $unit_id          = "";
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['unit']          = $this->unit_model->drop_options_corporate();
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
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 5 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND STATUS_DOKUMEN_ID >= 5 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 5 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 5 ORDER BY RISK_ITEM_ID ASC";
                }
                
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
            }

            $this->data['search']           = $search;
            $this->data['unit_id']          = $this->input->post('unit_id');
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');

            /*Build View*/
            $top_risk = $this->input->post('top_risk');
            if ($top_risk == 'yes') {
                $this->template->build('work-paper-report-list-monev-top-risk');    
            } else {
                $this->template->build('work-paper-report-list-monev');
            }
        }

        function index_monev_pdf() {
            $result 		  = array();

            $search           = false;
            $unit_id          = "";
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['unit']          = $this->unit_model->drop_options_corporate();
            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->get('unit_id') && $this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $unit_id          = $this->input->get('unit_id');
                $tahun            = $this->input->get('tahun');
                $risk_category_id = $this->input->get('risk_category_id');

                //get params selected_print
                $query  = explode('&', $_SERVER['QUERY_STRING']);
                $params = array();
                foreach( $query as $param ) {
                    // prevent notice on explode() if $param has no '='
                    if (strpos($param, '=') === false) $param += '=';

                    list($name, $value) = explode('=', $param, 2);
                    $params[urldecode($name)][] = urldecode($value);
                }
                $selected_print   = implode(",", $params['selected_print']);


                if($this->input->get('status')=="Y"){
                    $status = 1;
                }elseif($this->input->get('status')=="N") {
                    $status = 0;
                }else{
                    $status = "ALL";
                }

                if(($risk_category_id === "ALL") AND ($status === "ALL")){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 5 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND STATUS_DOKUMEN_ID >= 5 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 5 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TIPE_KERTAS_KERJA=1 AND TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 5 AND RISK_IDENTIFICATION_ID IN ($selected_print) ORDER BY RISK_ITEM_ID ASC";
                }

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
            }

            $this->data['search']           = $search;
            $this->data['unit_id']          = $this->input->get('unit_id');
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

             /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

			
			// /*Build View PDF*/
            // $this->pdf->set_paper('a3', 'landscape');
            // $this->pdf->load_view('work-paper-report-list-pdf-adkom', $this->data);
            // $this->pdf->render();
            // $this->pdf->stream(date("Ymd")."_risk_admin.pdf", array("Attachment"=>1));
			
			
			/*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
			if($risk_category_id == "1"){
				$this->pdf->load_view('work-paper-report-list-pdf-opstek', $this->data);				
			} elseif($risk_category_id == "2") {
				$this->pdf->load_view('work-paper-report-list-pdf-adkom', $this->data);					
			} else {
                $this->pdf->load_view('work-paper-report-list-pdf', $this->data);
            }
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_admin.pdf", array("Attachment"=>1));
			
			
            // $this->load->view('work-paper-report-list', $this->data);
        }

        function owner() {
            $result = array();

            $search           = false;
            $unit_id          = $this->session->userdata('unit_id');
            $user_pic_id      = $this->session->userdata('pic_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->post('tahun') && $this->input->post('status') && $this->input->post('risk_category_id')){
                $search = true;

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
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }

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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Build View*/
            $this->template->build('work-paper-report-owner-list');
        }

        function owner_pdf() {
            $result = array();

            $search           = false;
            $unit_id          = $this->session->userdata('unit_id');
            $user_pic_id      = $this->session->userdata('pic_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $tahun            = $this->input->get('tahun');
                $risk_category_id = $this->input->get('risk_category_id');

                if($this->input->get('status')=="Y"){
                    $status = 1;
                }elseif($this->input->get('status')=="N") {
                    $status = 0;
                }else{
                    $status = "ALL";
                }

                if(($risk_category_id === "ALL") AND ($status === "ALL")){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$user_pic_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }

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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-report-owner-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_owner.pdf", array("Attachment"=>1));
        }

        function gm() {
            $result = array();

            $search           = false;
            $unit_id          = $this->session->userdata('unit_id');
            $user_pic_ids     = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->post('tahun') && $this->input->post('status') && $this->input->post('risk_category_id')){
                $search = true;

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

                //$params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERIDENTIFIKASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID IN ($user_pic_ids) AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                //$params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";

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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Build View*/
            $this->template->build('work-paper-report-gm-list');
        }

        function gm_pdf() {
            $result = array();

            $search           = false;
            $unit_id          = $this->session->userdata('unit_id');
            $user_pic_ids     = $this->risk_pic_model->get_child_id($this->session->userdata('pic_id'));
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();

            if($this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $tahun            = $this->input->get('tahun');
                $risk_category_id = $this->input->get('risk_category_id');

                if($this->input->get('status')=="Y"){
                    $status = 1;
                }elseif($this->input->get('status')=="N") {
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

                //$params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERIDENTIFIKASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID IN ($user_pic_ids) AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                //$params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                
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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');
            $this->data['unit_id']          = $unit_id;

             /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-report-gm-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_gm.pdf", array("Attachment"=>1));
        }

        function officer() {
            $result = array();

            $unit_id        = $this->session->userdata('unit_id');
            $pic_unit_kerja = $this->session->userdata('pic_id');
            $tahun          = date('Y');

            $this->data['unit'] = $this->unit_model->drop_options();

            if($this->input->post('tahun')){
                $tahun   = $this->input->post('tahun');
            }
                

            $params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
            WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 AND `tx_risk_mitigation`.PIC_UNIT_KERJA_ID = $pic_unit_kerja ORDER BY RISK_ITEM_ID ASC";

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

            $this->data['unit_id']= $unit_id;
            $this->data['tahun']  = $tahun;

            /*Build View*/
            $this->template->build('work-paper-report-officer-list');
        }

        function officer_pdf() {
            $result = array();

            $unit_id        = $this->session->userdata('unit_id');
            $pic_unit_kerja = $this->session->userdata('pic_id');
            $tahun          = date('Y');

            $this->data['unit'] = $this->unit_model->drop_options();

            if($this->input->get('tahun')){
                $tahun   = $this->input->get('tahun');
            }
                

            $params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
            WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND STATUS_DOKUMEN_ID >= 4 AND `tx_risk_mitigation`.PIC_UNIT_KERJA_ID = $pic_unit_kerja ORDER BY RISK_ITEM_ID ASC";

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
            $this->data['unit_id']= $unit_id;
            $this->data['tahun']  = $tahun;
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');

             /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-report-officer-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_officer.pdf", array("Attachment"=>1));
        }

        function head() {
            $result = array();
            $search = false;

            $pic_kantor_pusat = $this->session->userdata('pic_id');
            $unit_id          = $this->session->userdata('unit_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            
            if($this->input->post('tahun') && $this->input->post('status') && $this->input->post('risk_category_id')){
                $search = true;

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
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }                
                
                /*$params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
                WHERE TAHUN=$tahun AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 AND (`tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = $pic_kantor_pusat OR `tx_risk_identification`.USER_PIC_ID = $pic_kantor_pusat) ORDER BY RISK_ITEM_ID ASC";
*/
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

            }
                
            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Build View*/
            $this->template->build('work-paper-report-head-list');
        }

        function head_pdf() {
            $result = array();
            $search = false;

            $pic_kantor_pusat = $this->session->userdata('pic_id');
            $unit_id          = $this->session->userdata('unit_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            
            if($this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $tahun            = $this->input->get('tahun');
                $risk_category_id = $this->input->get('risk_category_id');

                if($this->input->get('status')=="Y"){
                    $status = 1;
                }elseif($this->input->get('status')=="N") {
                    $status = 0;
                }else{
                    $status = "ALL";
                }

                if(($risk_category_id === "ALL") AND ($status === "ALL")){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id === "ALL" AND $status !== "ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }elseif($risk_category_id !== "ALL" AND $status ==="ALL"){
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }else{
                    $params = "SELECT * FROM `tx_risk_identification` WHERE TAHUN=$tahun AND UNIT_ID=$unit_id AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND USER_PIC_ID=$pic_kantor_pusat AND STATUS_DOKUMEN_ID >= 4 ORDER BY RISK_ITEM_ID ASC";
                }

                //$params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
                //WHERE TAHUN=$tahun AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 AND (`tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = $pic_kantor_pusat OR `tx_risk_identification`.USER_PIC_ID = $pic_kantor_pusat) ORDER BY RISK_ITEM_ID ASC";
                
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

            }
                
            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');
            $this->data['unit_id']          = $unit_id;

             /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-report-head-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_head.pdf", array("Attachment"=>1));
        }

        function branch(){
            $result = array();
            $search = false;

            $pic_kantor_pusat = $this->session->userdata('pic_id');
            $unit_id          = $this->session->userdata('unit_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            
            if($this->input->post('tahun') && $this->input->post('status') && $this->input->post('risk_category_id')){
                $search = true;

                $tahun            = $this->input->post('tahun');
                $status           = $this->input->post('status')=="Y"?1:0;
                $risk_category_id = $this->input->post('risk_category_id');

                $params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
                WHERE TAHUN=$tahun AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 AND (`tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = $pic_kantor_pusat) ORDER BY RISK_ITEM_ID ASC";

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

            }
                
            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['status']           = $this->input->post('status');
            $this->data['risk_category_id'] = $this->input->post('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Build View*/
            $this->template->build('work-paper-report-branch-list');
        }

        function branch_pdf() {
            $result = array();
            $search = false;

            $pic_kantor_pusat = $this->session->userdata('pic_id');
            $unit_id          = $this->session->userdata('unit_id');
            $tahun            = date('Y');
            $status           = "";
            $risk_category_id = "";

            $this->data['risk_category'] = $this->risk_category_model->drop_options();
            
            if($this->input->get('tahun') && $this->input->get('status') && $this->input->get('risk_category_id')){
                $search = true;

                $tahun            = $this->input->get('tahun');
                $status           = $this->input->get('status')=="Y"?1:0;
                $risk_category_id = $this->input->get('risk_category_id');

                $params = "SELECT * FROM `tx_risk_identification` LEFT JOIN tx_risk_mitigation ON `tx_risk_mitigation`.RISK_IDENTIFICATION_ID = `tx_risk_identification`.RISK_IDENTIFICATION_ID
                WHERE TAHUN=$tahun AND TERMITIGASI=$status AND RISK_CATEGORY_ID=$risk_category_id AND STATUS_DOKUMEN_ID >= 4 AND (`tx_risk_mitigation`.PIC_KANTOR_PUSAT_ID = $pic_kantor_pusat) ORDER BY RISK_ITEM_ID ASC";
                
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

            }
                
            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['status']           = $this->input->get('status');
            $this->data['risk_category_id'] = $this->input->get('risk_category_id');
            $this->data['unit_id']          = $unit_id;

            /*Title Report*/
            $this->data['risk_category_report'] = $this->risk_model->get_by_risk_category_report($this->input->get('risk_category_id'));
            $this->data['unit_report'] = $this->risk_model->get_by_unit_report($unit_id);
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-report-branch-list-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_branch.pdf", array("Attachment"=>1));
        }

        function register_card() {
            $result = array();

            $search           = false;
            $tahun            = date('Y');
            $risk_id          = "";

            $this->data['risk']          = $this->risk_model->drop_options();

            if($this->input->post('tahun') && $this->input->post('risk_id')){
                $search = true;

                $tahun            = $this->input->post('tahun');
                $risk_id          = $this->input->post('risk_id');

                if ($risk_id == "ALL") {
                    $filterRisk = "";
                } else {
                    $filterRisk = "`mst_risk_items`.`risk_id`=$risk_id AND";
                }

                $params = "SELECT * , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
                    LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
                    LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
                    LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
                    WHERE 
                        `tx_risk_identification`.`TAHUN`=$tahun AND 
                        `tx_risk_identification`.`TIPE_KERTAS_KERJA`=1 AND 
                        $filterRisk 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    GROUP BY 
                        `tx_risk_identification`.`RISK_ITEM_ID`, `mst_risk_items`.`risk_register_number`
                    ORDER BY 
                        `tx_risk_identification`.`RISK_ITEM_ID` ASC";
                
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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->post('tahun');
            $this->data['risk_id']          = $this->input->post('risk_id');

            /*Build View*/
            $top_risk = $this->input->post('top_risk');
            if ($top_risk == 'yes') {
                $this->template->build('work-paper-register-card-top-risk');    
            } else {
                $this->template->build('work-paper-register-card');
            }
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

                if ($risk_id == "ALL") {
                    $filterRisk = "";
                } else {
                    $filterRisk = "`mst_risk_items`.`risk_id`=$risk_id AND";
                }

                $params = "SELECT * , `mst_risk_levels`.`name` as `level_name` FROM `tx_risk_identification` 
                    LEFT JOIN `mst_risk_items` ON `tx_risk_identification`.`RISK_ITEM_ID`=`mst_risk_items`.`id`
                    LEFT JOIN `mst_risk_values` ON `tx_risk_identification`.`RESIDUAL_RISK_K_ID`=`mst_risk_values`.`risk_probability_id` AND `tx_risk_identification`.`RESIDUAL_RISK_D_ID`=`mst_risk_values`.`risk_impact_id` 
                    LEFT JOIN `mst_risk_levels` ON `mst_risk_values`.`risk_level_id`=`mst_risk_levels`.`id`
                    WHERE 
                        `tx_risk_identification`.`TAHUN`=$tahun AND 
                        `tx_risk_identification`.`TIPE_KERTAS_KERJA`=1 AND 
                        $filterRisk 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    GROUP BY 
                        `tx_risk_identification`.`RISK_ITEM_ID`, `mst_risk_items`.`risk_register_number`
                    ORDER BY 
                        `tx_risk_identification`.`RISK_ITEM_ID` ASC";
                
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
            }

            $this->data['search']           = $search;
            $this->data['tahun']            = $this->input->get('tahun');
            $this->data['risk_id']          = $this->input->get('risk_id');

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['tahun_report'] =  $this->input->get('tahun');

            /*Build View PDF*/
            $this->pdf->set_paper('a4', 'portrait');
            $this->pdf->load_view('work-paper-register-card-pdf', $this->data);
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
                        `tx_risk_identification`.`TIPE_KERTAS_KERJA`=1 AND 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    ORDER BY 
                        `tx_risk_identification`.`UNIT_ID` ASC";
                
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
            }

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['risk_register_report'] = $this->risk_item_model->get_by_id($this->input->get('risk_item_id'));
            $this->data['risk_register_no_report'] = $this->input->get('risk_no');
            $this->data['risk_level_report'] = $this->input->get('risk_level');

            /*Build View*/
            $this->template->build('work-paper-register-card-detail');
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
                        `tx_risk_identification`.`TIPE_KERTAS_KERJA`=1 AND 
                        `tx_risk_identification`.`STATUS_DOKUMEN_ID` >= 4 
                    ORDER BY 
                        `tx_risk_identification`.`UNIT_ID` ASC";
                
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
            }

            /*Title Report*/
            $this->data['risk_report'] = $this->risk_model->get_by_risk_report($this->input->get('risk_id'));
            $this->data['risk_register_report'] = $this->risk_item_model->get_by_id($this->input->get('risk_item_id'));
            $this->data['risk_register_no_report'] = $this->input->get('risk_no');
            $this->data['risk_level_report'] = $this->input->get('risk_level');

            /*Build View PDF*/
            $this->pdf->set_paper('a3', 'landscape');
            $this->pdf->load_view('work-paper-register-card-detail-pdf', $this->data);
            $this->pdf->render();
            $this->pdf->stream(date("Ymd")."_risk_register_card_detail.pdf", array("Attachment"=>1));
        }

        function view($id, $type){
            $this->data['logs']           = $this->log_model->get_by_risk_identification_id($id);
            $this->data['risk_mitigation_files'] = $this->risk_mitigation_file_model->get_by_risk_identification_id($id);
            $this->data['d'] = $this->risk_identification_model->get_by_id($id);
            $this->data['type'] = $type;

            /*Build View*/
            $this->template->build('work-paper-report-view');
        }
    }
?>