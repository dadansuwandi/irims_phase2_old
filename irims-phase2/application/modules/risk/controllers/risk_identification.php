<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Identification Controller.
     * 
     * @package App
     * @category Controller
     * @author Jaya Dianto
     */
    class risk_identification extends Admin_Controller {

        protected $form = array(
        );

        function __construct() {
            parent::__construct();
            $this->load->model('risk_identification_model');
            $this->load->model('risk_identification_pic_model');
            $this->load->model('risk_mitigation_model');
    		$this->load->model('auth/user_model');
            $this->load->model('master/unit_model');
            $this->load->model('master/status_dokumen_model');
            $this->load->model('master/risk_item_model');
            $this->load->model('master/risk_category_model');
            $this->load->model('master/risk_probability_model');
    		$this->load->model('master/risk_impact_model');
            $this->load->model('master/risk_pic_model');
            $this->load->model('master/exco_effectiveness_question_model');
            $this->load->model('master/exco_effectiveness_answer_model');
            $this->load->model('master/exco_effectiveness_value_category_model');
            $this->load->model('risk/log_model');
            $this->load->model('notification/notification_model');
            $this->load->model('master/risk_impact_indicator_model');
            $this->load->model('master/risk_impact_category_model');
            $this->load->model('master/risk_kpi_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('risk/risk_register/index');
        }

        function index() {
    		$this->data['rows'] = $this->risk_identification_model->get_list_owner(array(1,2,3));
    		$this->template->build('risk-identification-list');
        }
    	
    	function view($id) {
    		$this->data['row']            = $this->risk_identification_model->get_by_id((int) $id);
            $this->data['pic_unit_kerja'] = $this->risk_identification_pic_model->get_data_pic($id, 0);
            $this->data['logs']           = $this->log_model->get_by_risk_identification_id($id);
            
            $this->template->build('risk-identification-view');
        }

        function edit($id) {
            $this->_updatedata($id);
        }

        function add() {
            $this->_updatedata();
        }

        function _updatedata($id = 0) {
            $this->load->library('form_validation');
            $form = $this->form;
    		
    		$this->data['RISK_IDENTIFICATION_ID'] = $id;

            $this->data['INHERENT_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['RESIDUAL_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['TARGET_RESIDUAL_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['MITIGASI_RISK_K'] = $this->risk_probability_model->drop_options();

            $this->data['INHERENT_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['RESIDUAL_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['TARGET_RESIDUAL_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['MITIGASI_RISK_D'] = $this->risk_impact_model->drop_options();

            $this->data['RISK_PIC_K']       = $this->risk_pic_model->drop_options();
            $this->data['RISK_PIC_P']       = $this->risk_pic_model->drop_options();

            //$this->data['OBJECTIVE']        = $this->risk_pic_model->get_by_id($this->session->userdata('pic_id'))->objective;
            $this->data['USER_PIC_ID']      = $this->session->userdata('pic_id');

            if ($id <= 0) { //This data is just information
                $this->data['USER_LAST_NAME']   = $this->user_model->get_by_pic($this->session->userdata('pic_id'))->last_name;
                $this->data['CREATED_AT_YEAR']  = date('Y');
                $this->data['CREATED_AT_DATE']  = date('Y-m-d');
            }

            $this->data['KPI_DATA']              = $this->risk_kpi_model->drop_options_2();
            //$this->data['WORK_PROGRAM']          = $this->risk_pic_model->get_by_id($this->session->userdata('pic_id'))->work_program;

            $this->data['SCOPE']                = $this->risk_pic_model->get_by_id($this->session->userdata('pic_id'))->objective;

            if ($id > 0) {
                $row = $this->risk_identification_model->get_by_id((int) $id);
    			
    			$this->data['RISK_IDENTIFICATION_ID']   = $row->RISK_IDENTIFICATION_ID;
                $this->data['OBJECTIVE']                = $row->OBJECTIVE;
                
                //This data is just information
                $this->data['USER_LAST_NAME']           = $this->user_model->get_by_pic($row->USER_PIC_ID)->last_name;
                $this->data['CREATED_AT_YEAR']          = $row->TAHUN;
                $this->data['CREATED_AT_DATE']          = date('Y-m-d', strtotime($row->INSTERTED_TIME));

                $this->data['KPI']                   = $row->KPI;
                $this->data['KPI_VALUE']             = $this->risk_kpi_model->get_by_name($row->KPI);


                $this->data['WORK_PROGRAM']             = $row->WORK_PROGRAM;
                $this->data['HAZARD']                   = $row->HAZARD;
                $this->data['QUANTIFICATION']           = $row->QUANTIFICATION;
                $this->data['PENYEBAB']                 = $row->PENYEBAB;
                $this->data['DAMPAK']                   = $row->DAMPAK;
                $this->data['USER_PIC_ID']              = $row->USER_PIC_ID;

                $this->data['INHERENT_RISK_K_ID']               = $row->INHERENT_RISK_K_ID;
                $this->data['INHERENT_RISK_K_VALUE']            = $this->risk_probability_model->get_by_id($row->INHERENT_RISK_K_ID);
                
                $this->data['INHERENT_RISK_D_ID']               = $row->INHERENT_RISK_D_ID;
                $this->data['INHERENT_RISK_D_VALUE']            = $this->risk_impact_model->get_by_id($row->INHERENT_RISK_D_ID);

                $this->data['PENGENDALIAN_YANG_TELAH_DILAKUKAN']= $row->PENGENDALIAN_YANG_TELAH_DILAKUKAN;
                
                $this->data['RESIDUAL_RISK_K_ID']               = $row->RESIDUAL_RISK_K_ID;
                $this->data['RESIDUAL_RISK_K_VALUE']            = $this->risk_probability_model->get_by_id($row->RESIDUAL_RISK_K_ID);

                $this->data['RESIDUAL_RISK_D_ID']               = $row->RESIDUAL_RISK_D_ID;
                $this->data['RESIDUAL_RISK_D_VALUE']            = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

               // $this->data['RENCANA_PENGENDALIAN']             = $row->RENCANA_PENGENDALIAN;
                //$this->data['RISK_IDENTIFICATION_PIC']          = $this->risk_identification_pic_model->get_list_id($id, 0);

                //$this->data['TARGET_WAKTU'] = $row->TARGET_WAKTU;

                //$this->data['pic_unit_kerja'] = $this->risk_identification_pic_model->get_data_pic($id, 0);			
    			
                $this->data['MITIGASI'] = $this->risk_mitigation_model->get_data($id);

                $this->data['ACTIVITY']                         = $row->ACTIVITY;
                $this->data['SCOPE']                            = $row->SCOPE;
                $this->data['CRITERIA']                         = $row->CRITERIA;
                $this->data['EXTERNAL_CONTEXT']                 = $row->EXTERNAL_CONTEXT;
                $this->data['INTERNAL_CONTEXT']                 = $row->INTERNAL_CONTEXT;
                $this->data['EXCO_EFFECTIVENESS_VALUE_K_ID']    = $row->EXCO_EFFECTIVENESS_VALUE_K_ID;
                $this->data['EXCO_EFFECTIVENESS_VALUE_D_ID']    = $row->EXCO_EFFECTIVENESS_VALUE_D_ID;
                $this->data['TREATMENT_DECISION_CATEGORY']      = $row->TREATMENT_DECISION_CATEGORY;
                $this->data['TREATMENT_DECISION_DESCRIPTION']   = $row->TREATMENT_DECISION_DESCRIPTION;

                $this->data['TARGET_RESIDUAL_RISK_K_ID']               = $row->TARGET_RESIDUAL_RISK_K_ID;
                $this->data['TARGET_RESIDUAL_RISK_K_VALUE']            = $this->risk_probability_model->get_by_id($row->TARGET_RESIDUAL_RISK_K_ID);

                $this->data['TARGET_RESIDUAL_RISK_D_ID']               = $row->TARGET_RESIDUAL_RISK_D_ID;
                $this->data['TARGET_RESIDUAL_RISK_D_VALUE']            = $this->risk_impact_model->get_by_id($row->TARGET_RESIDUAL_RISK_D_ID);

                //$this->data['MITIGATION_COSTS']                 = $row->MITIGATION_COSTS;

                $this->form_validation->set_default($row);
            }

            $this->form_validation->init($form);
    		
            if ($this->form_validation->run()) {
                if ($id > 0) {
                    $this->risk_identification->update($id, $this->form_validation->get_values());
    				$this->template->set_flashdata('info', 'Data has been updated');
                } else {
                    $this->risk_identification->insert($this->form_validation->get_values());
    				$this->template->set_flashdata('info', 'Data has been added');
                }
    			/* upload photo */
    			//$this->do_upload_photo($id);

                redirect('risk/risk_identification');
            }

            $this->data['form'] = $this->form_validation;
            $this->template
                ->set_css_global('plugins/select2/select2')
                ->set_css_global('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5')
                ->set_js_global('plugins/select2/select2.min')
                ->set_js_global('plugins/jquery-validation/js/jquery.validate.min')
                ->set_js_global('plugins/jquery-validation/js/additional-methods.min')
                ->set_js_global('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min')
                ->set_js_global('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0')
                ->set_js_global('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5')
                ->build('risk-identification-form');
        }

        function saveWizard() {
            $result = false;

            if(isset($_POST)){
                $dataPostIdentification['USER_PIC_ID']                       = $this->session->userdata('pic_id');
                $dataPostIdentification['OBJECTIVE']                         = $_POST['OBJECTIVE'];
                $dataPostIdentification['KPI']                               = $_POST['KPI'];
                $dataPostIdentification['WORK_PROGRAM']                      = $_POST['WORK_PROGRAM'];
                $dataPostIdentification['HAZARD']                            = $_POST['HAZARD'];
                $dataPostIdentification['QUANTIFICATION']                    = $_POST['QUANTIFICATION'];
                $dataPostIdentification['PENYEBAB']                          = $_POST['PENYEBAB'];
                $dataPostIdentification['DAMPAK']                            = $_POST['DAMPAK'];
                $dataPostIdentification['INHERENT_RISK_K_ID']                = $_POST['INHERENT_RISK_K_ID']>0?$_POST['INHERENT_RISK_K_ID']:0;
                $dataPostIdentification['INHERENT_RISK_D_ID']                = $_POST['INHERENT_RISK_D_ID']>0?$_POST['INHERENT_RISK_D_ID']:0;
                $dataPostIdentification['PENGENDALIAN_YANG_TELAH_DILAKUKAN'] = $_POST['PENGENDALIAN_YANG_TELAH_DILAKUKAN'];
                $dataPostIdentification['RESIDUAL_RISK_K_ID']                = $_POST['RESIDUAL_RISK_K_ID']>0?$_POST['RESIDUAL_RISK_K_ID']:0;
                $dataPostIdentification['RESIDUAL_RISK_D_ID']                = $_POST['RESIDUAL_RISK_D_ID']>0?$_POST['RESIDUAL_RISK_D_ID']:0;
                //$dataPostIdentification['RENCANA_PENGENDALIAN']              = $_POST['RENCANA_PENGENDALIAN'];
                //$dataPostIdentification['TARGET_WAKTU']                      = $_POST['TARGET_WAKTU'];
                $dataPostIdentification['ACTIVITY']                          = $_POST['ACTIVITY'];
                $dataPostIdentification['SCOPE']                             = $_POST['SCOPE'];
                $dataPostIdentification['CRITERIA']                          = $_POST['CRITERIA'];
                $dataPostIdentification['EXTERNAL_CONTEXT']                  = $_POST['EXTERNAL_CONTEXT'];
                $dataPostIdentification['INTERNAL_CONTEXT']                  = $_POST['INTERNAL_CONTEXT'];
                $dataPostIdentification['EXCO_EFFECTIVENESS_VALUE_K_ID']     = $_POST['EXCO_EFFECTIVENESS_VALUE_K_ID'];
                $dataPostIdentification['EXCO_EFFECTIVENESS_VALUE_D_ID']     = $_POST['EXCO_EFFECTIVENESS_VALUE_D_ID'];
                $dataPostIdentification['TREATMENT_DECISION_CATEGORY']       = $_POST['TREATMENT_DECISION_CATEGORY'];
                $dataPostIdentification['TREATMENT_DECISION_DESCRIPTION']    = $_POST['TREATMENT_DECISION_DESCRIPTION'];
                $dataPostIdentification['TARGET_RESIDUAL_RISK_K_ID']         = $_POST['TARGET_RESIDUAL_RISK_K_ID']>0?$_POST['TARGET_RESIDUAL_RISK_K_ID']:0;
                $dataPostIdentification['TARGET_RESIDUAL_RISK_D_ID']         = $_POST['TARGET_RESIDUAL_RISK_D_ID']>0?$_POST['TARGET_RESIDUAL_RISK_D_ID']:0;
                //$dataPostIdentification['MITIGATION_COSTS']                  = $_POST['MITIGATION_COSTS'];

                if(isset($_POST['RISK_IDENTIFICATION_ID']) && $_POST['RISK_IDENTIFICATION_ID']!=""){
                    $idSave = $this->risk_identification_model->update($_POST['RISK_IDENTIFICATION_ID'], $dataPostIdentification);

                    if($idSave > 0){
                        $result = $idSave;
                    }
                }else{
                    $idSave = $this->risk_identification_model->insert($dataPostIdentification);
                    
                    if($idSave > 0){
                        $result = $idSave;

                        /*crete insert log */
                        $logData['risk_identification_id']  = $idSave;
                        $logData['created_date']            = date("Y-m-d H:i:s");
                        $logData['user_id']                 = $this->session->userdata('auth_user');
                        $logData['keterangan']              = "Membuat kertas kerja baru";
                        $this->log_model->insert($logData);
                    }
                }

                if($result){
                    /*update and save PIC*/
                    /*if(isset($_POST['RISK_PIC_ID_K'])){
                        $this->risk_identification_pic_model->delete_update($_POST['RISK_IDENTIFICATION_ID'], $_POST['RISK_PIC_ID_K']);
                    }*/

                    /*Update adn Save Mitigation Multiple*/
                    if(isset($_POST['RENCANA_PENGENDALIAN']) && count($_POST['RENCANA_PENGENDALIAN']) > 1 && $_POST['RENCANA_PENGENDALIAN'][1] != ""){
                        
                        $riskMitigationData['RENCANA_PENGENDALIAN'] = $_POST['RENCANA_PENGENDALIAN'];
                        $riskMitigationData['DAMPAK_RENCANA_PENGENDALIAN'] = $_POST['DAMPAK_RENCANA_PENGENDALIAN'];
                        $riskMitigationData['PIC_UNIT_KERJA_ID'] = $_POST['PIC_UNIT_KERJA_ID'];
                        $riskMitigationData['MULAI_WAKTU'] = $_POST['MULAI_WAKTU'];
                        $riskMitigationData['TARGET_WAKTU'] = $_POST['TARGET_WAKTU'];
                        $riskMitigationData['MITIGATION_COSTS'] = preg_replace('/[Rp. ]/','',$_POST['MITIGATION_COSTS']);

                        $this->risk_mitigation_model->delete_update($_POST['RISK_IDENTIFICATION_ID'], $riskMitigationData);
                    }

                    echo json_encode(array('status'=>'success', 'RISK_IDENTIFICATION_ID'=>$result));
                }else{
                    echo json_encode(array('status'=>'failed'));
                }
            }
        }
        
        function delete($id) {
    		$riskIdentification = $this->risk_identification_model->get_by_id($id);
    		if ($riskIdentification)
    			$this->risk_identification_model->delete($id);
            redirect('risk/risk_identification');
        }

        function change_status(){
            if(isset($_GET['id']) && isset($_GET['status'])){
                $data['STATUS_DOKUMEN_ID']      = $_GET['status'];
                $data['RISK_IDENTIFICATION_ID'] = $_GET['id'];

                if($_GET['status']==2){
                    /*crete insert log */
                    $logData['risk_identification_id']  = $_GET['id'];
                    $logData['created_date']            = date("Y-m-d H:i:s");
                    $logData['user_id']                 = $this->session->userdata('auth_user');
                    $logData['keterangan']              = "Dokumen telah diajukan ke risk admin untuk di evaluasi";
                    $this->log_model->insert($logData);

                    /*create notification to admin*/
                    $notification['description']    = "1 Risk Assessment perlu approval anda";
                    $notification['url']            = site_url('risk/risk_evaluation/view/'.$_GET['id']);
                    $notification['role_id']        = GROUP_RISK_ADMIN;
                    $notification['pic_id']         = 0;
                    $notification['created_date']   = date('Y-m-d H:i:s');
                    $notification['status']         = "UNREAD";
                    $this->notification_model->insert($notification);

                    // /* sent notification by email */
                    $userID = $this->risk_identification_model->get_by_id($_GET['id'])->INSERTED_BY;
                    $emailRiskOwner = $this->user_model->get_by_id($userID)->email;
                    $emailRiskAdmin = $this->user_model->get_by_username('risk-admin')->email;
                    /* email parameters */
                    // $fromEmail  = $emailRiskOwner;
                    // $fromName   = 'IRIMS';
                    // $to         = array($emailRiskAdmin);
                    // $attachment = NULL;
                    // $subject    = '#'.$_GET['id'].' - 1 Risk Assessment perlu approval anda';
                    // $message    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen telah diajukan ke risk admin untuk di evaluasi'; 
                    // $this->sendNotificationByEmail($fromEmail, $fromName, $to, $attachment, $subject, $message);

                    $to         = $emailRiskAdmin;
                    $subject    = '#'.$_GET['id'].' - 1 Risk Assessment perlu approval anda';
                    $content    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen telah diajukan ke risk admin untuk di evaluasi';
                    $link       = '<a href='.base_url().'risk/risk_identification/view/'.$_GET['id'].'>#'.$_GET['id'].'</a>';

                    $message = array(
                        'to' => $to,
                        'subject' => $subject,
                        'content' => $content,
                        'link' => $link
                    );
                    $emailContent = $this->load->view('email/email/index', $message, true);

                    /* sent notification by email no reply */
                    $apiHost    = getenv('API_HOST_EMAIL_AP2').'/welcome/api_send_email';
                    $postData   = array(
                        'to' => $to,
                        'subject' => $subject,
                        'content' => $content
                    );
                    $this->curl->simple_post($apiHost, $postData);
                    

                    $this->template->set_flashdata('info', 'Dokumen telah diajukan ke risk admin untuk di evaluasi.');
                }

                if($_GET['status']==4){
                    /*crete insert log */
                    $logData['risk_identification_id']  = $_GET['id'];
                    $logData['created_date']            = date("Y-m-d H:i:s");
                    $logData['user_id']                 = $this->session->userdata('auth_user');
                    $logData['keterangan']              = "Dokumen telah dikonfirmasi oleh risk owner, Status risiko telah dirubah menjadi monitored";
                    $this->log_model->insert($logData);

                    /*generate code risk identification*/
                    $data['CODE'] = $this->risk_identification_model->create_code();

                    // /* sent notification by email */
                    $userID = $this->risk_identification_model->get_by_id($_GET['id'])->INSERTED_BY;
                    $emailRiskOwner = $this->user_model->get_by_id($userID)->email;
                    $emailRiskAdmin = $this->user_model->get_by_username('risk-admin')->email;
                    /* email parameters */
                    // $fromEmail  = $emailRiskOwner;
                    // $fromName   = 'IRIMS';
                    // $to         = array($emailRiskAdmin);
                    // $attachment = NULL;
                    // $subject    = '#'.$_GET['id'].' - 1 Risk Assessment telah dirubah menjadi monitored';
                    // $message    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen telah dikonfirmasi oleh risk owner, Status risiko telah dirubah menjadi monitored'; 
                    // $this->sendNotificationByEmail($fromEmail, $fromName, $to, $attachment, $subject, $message);

                    $to         = $emailRiskOwner;
                    $subject    = '#'.$_GET['id'].' - 1 Risk Assessment telah dirubah menjadi monitored';
                    $content    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen telah dikonfirmasi oleh risk owner, Status risiko telah dirubah menjadi monitored';
                    $link       = '<a href='.base_url().'risk/risk_identification/view/'.$_GET['id'].'>#'.$_GET['id'].'</a>';

                    $message = array(
                        'to' => $to,
                        'subject' => $subject,
                        'content' => $content,
                        'link' => $link
                    );
                    $emailContent = $this->load->view('email', $message, true);

                    /* sent notification by email no reply */
                    $apiHost    = getenv('API_HOST_EMAIL_AP2').'/welcome/api_send_email';
                    $postData   = array(
                        'to' => $to,
                        'subject' => $subject,
                        'content' => $content
                    );
                    $this->curl->simple_post($apiHost, $postData);


                    $this->template->set_flashdata('info', 'Status risiko telah dirubah menjadi monitored.');
                }

                /*udpate data*/
                $this->risk_identification_model->update($_GET['id'], $data);

                if($_GET['status']==4){
                    $riskModel = $this->risk_identification_model->get_by_id($_GET['id']);
                    $this->generate_notification($riskModel);
                }

                redirect('risk/risk_identification');
            }else{
                redirect('risk/risk_identification');
            }

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //$this->load->library('email');
            /*Begin Send Email Function*/
            /*$subject = 'This is a test';
            $message = '<p>This message has been sent for testing purposes.</p>';*/

            // Get full html:
            /*$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                <title>' . html_escape($subject) . '</title>
                <style type="text/css">
                    body {
                        font-family: Arial, Verdana, Helvetica, sans-serif;
                        font-size: 16px;
                    }
                </style>
            </head>
            <body>
            ' . $message . '
            </body>
            </html>';*/
            // Also, for getting full html you may use the following internal method:
            //$body = $this->email->full_html($subject, $message);

           /* $result = $this->email
                ->from('wildan.sawaludin@gmail.com')
                ->reply_to('wildan.sawaludin@gmail.com')    // Optional, an account where a human being reads.
                ->to('wildan.sawaludin@yahoo.com')
                ->subject($subject)
                ->message($body)
                ->send();

            var_dump($result);
            echo '<br />';
            echo $this->email->print_debugger();

            exit;*/
            /*End Send Email Function*/
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }

        function generate_notification($riskModel)
        {
            $gm = $this->risk_pic_model->get_by_id($riskModel->USER_PIC_ID);

            /*create notification to admin*/
            $notification['description']    = "Risk Assessment ".$riskModel->CODE." on monitoring";
            $notification['url']            = site_url('report/risk_assessment_report/view/'.$riskModel->RISK_IDENTIFICATION_ID."/1");
            $notification['role_id']        = GROUP_RISK_ADMIN;
            $notification['pic_id']         = 0;
            $notification['created_date']   = date('Y-m-d H:i:s');
            $notification['status']         = "UNREAD";
            $this->notification_model->insert($notification);

            if($gm->parent_pic_id!=""){
                /*create notification to gm*/
                $notification['description']    = "Risk Assessment ".$riskModel->CODE." on monitoring";
                $notification['url']            = site_url('report/risk_assessment_report/view/'.$riskModel->RISK_IDENTIFICATION_ID."/3");
                $notification['role_id']        = GROUP_RISK_LEADERS;
                $notification['pic_id']         = $gm->parent_pic_id;
                $notification['created_date']   = date('Y-m-d H:i:s');
                $notification['status']         = "UNREAD";
                $this->notification_model->insert($notification);
            }

            /*create notification to pic unit kerja dan kantor pusat*/
            $riskMitigation = $this->risk_mitigation_model->get_data($riskModel->RISK_IDENTIFICATION_ID);
            if($riskMitigation){
                foreach ($riskMitigation as $rm) {
                    if($rm->PIC_UNIT_KERJA_ID != NULL OR $rm->PIC_UNIT_KERJA_ID != 0){
                        /*PIC unit kerja*/
                        $notification['description']    = "Risk Assessment ".$riskModel->CODE." on monitoring";
                        $notification['url']            = site_url('report/risk_assessment_report/view/'.$riskModel->RISK_IDENTIFICATION_ID."/4");
                        $notification['role_id']        = GROUP_RISK_OFFICERS;
                        $notification['pic_id']         = $rm->PIC_UNIT_KERJA_ID;
                        $notification['created_date']   = date('Y-m-d H:i:s');
                        $notification['status']         = "UNREAD";
                        $this->notification_model->insert($notification);
                    }

                    if($rm->PIC_KANTOR_PUSAT_ID != NULL OR $rm->PIC_KANTOR_PUSAT_ID != 0){
                        /*PIC kantor pusat*/
                        $notification['description']    = "Risk Assessment ".$riskModel->CODE." on monitoring";
                        $notification['url']            = site_url('report/risk_assessment_report/view/'.$riskModel->RISK_IDENTIFICATION_ID."/5");
                        $notification['role_id']        = GROUP_RISK_HEADQUARTERS;
                        $notification['pic_id']         = $rm->PIC_KANTOR_PUSAT_ID;
                        $notification['created_date']   = date('Y-m-d H:i:s');
                        $notification['status']         = "UNREAD";
                        $this->notification_model->insert($notification);
                    }
                }
            }
        }

        function getExcoEffectivenessValueCategoryByGroupValue($excoScore)
        {
            $excoEffectivenessValueCategoryByGroupValue =  $this->exco_effectiveness_value_category_model->getExcoEffectivenessValueCategoryByGroupValue($excoScore);
            echo json_encode($excoEffectivenessValueCategoryByGroupValue);
        }

        function sendNotificationByEmail($fromEmail = null, $fromName = null, $to = null, $attachment = null, $subject = null, $message = null) {
            // Email dan nama pengirim
            $this->email->from($fromEmail, $fromName);
            // Email penerima
            $this->email->to($to);
            // Lampiran email, isi dengan url/path file
            $this->email->attach($attachment);
            // Subject email
            $this->email->subject($subject);
            // Isi email
            $this->email->message($message);
            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                // Show success notification or other things here
                echo 'Sukses! email berhasil dikirim.';
            } else {
                // Raise error message
                echo 'Error! email tidak dapat dikirim.';
            }
        }
        public function GetTooltipsData(){
            $query = $this->db->select('name,label_name')->from('risk_information_tooltips')->order_by('name')->get()->result();
            echo json_encode($query);
        }
    }
?>