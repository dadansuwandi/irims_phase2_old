<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Backdate Controller.
     * 
     * @package App
     * @category Controller
     * @author Jaya Dianto
     */
    class risk_backdate extends Admin_Controller {

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
            $this->load->model('master/risk_probability_model');
            $this->load->model('master/risk_impact_model');
            $this->load->model('master/risk_pic_model');
            $this->load->model('master/risk_category_model');
            $this->load->model('master/risk_classification_model');
            $this->load->model('risk/log_model');
            $this->load->model('risk/risk_mitigation_file_model');
            $this->load->model('master/risk_impact_indicator_model');
            $this->load->model('master/risk_impact_category_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('risk/risk_backdate/index');
        }

        function index() {
            $this->_createdata();
        }

        function _createdata($id = 0) {
            $this->load->library('form_validation');
            $form = $this->form;
    		
    		$this->data['RISK_IDENTIFICATION_ID'] = $id;

            $this->data['UNIT'] = $this->unit_model->drop_options();
            $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
            
            $this->data['INHERENT_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['RESIDUAL_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['MITIGASI_RISK_K'] = $this->risk_probability_model->drop_options();

            $this->data['INHERENT_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['RESIDUAL_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['MITIGASI_RISK_D'] = $this->risk_impact_model->drop_options();

            $this->data['RISK_PIC_K'] = $this->risk_pic_model->drop_options();
            $this->data['RISK_PIC_P'] = $this->risk_pic_model->drop_options();

            $this->data['RISK_CATEGORY']        = $this->risk_category_model->drop_options();            
            $this->data['RISK_CLASSIFICATION']  = $this->risk_classification_model->drop_options();

            $this->data['CREATOR_ID'] = $this->user_model->drop_options_extend(array(GROUP_RISK_OWNER, GROUP_RISK_HEADQUARTERS));

            if ($id > 0) {
                $row = $this->risk_identification_model->get_by_id((int) $id);
    			
    			$this->data['RISK_IDENTIFICATION_ID']   = $row->RISK_IDENTIFICATION_ID;
                $this->data['OBJECTIVE']                = $this->risk_pic_model->get_by_id($this->session->userdata('pic_id'))->objective;
                $this->data['HAZARD']                   = $row->HAZARD;
                $this->data['PENYEBAB']                 = $row->PENYEBAB;
                $this->data['DAMPAK']                   = $row->DAMPAK;

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
                $this->data['INSERTED_BY'] = $row->INSERTED_BY;
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

                redirect('risk/risk_backdate');
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
                ->build('risk-backdate-form');
        }

        function saveWizard() {
            $result = false;

            if(isset($_POST)){
                $dataPostIdentification['UNIT_ID']                           = $_POST['UNIT_ID'];
                $dataPostIdentification['INSERTED_BY']                       = $_POST['INSERTED_BY'];
                $dataPostIdentification['TAHUN']                             = $_POST['TAHUN'];
                $dataPostIdentification['HAZARD']                            = $_POST['HAZARD'];
                $dataPostIdentification['PENYEBAB']                          = $_POST['PENYEBAB'];
                $dataPostIdentification['DAMPAK']                            = $_POST['DAMPAK'];
                $dataPostIdentification['USER_PIC_ID']                       = $this->user_model->get_by_id((int) $_POST['INSERTED_BY'])->pic_id;
                $dataPostIdentification['INHERENT_RISK_K_ID']                = $_POST['INHERENT_RISK_K_ID']>0?$_POST['INHERENT_RISK_K_ID']:0;
                $dataPostIdentification['INHERENT_RISK_D_ID']                = $_POST['INHERENT_RISK_D_ID']>0?$_POST['INHERENT_RISK_D_ID']:0;
                $dataPostIdentification['PENGENDALIAN_YANG_TELAH_DILAKUKAN'] = $_POST['PENGENDALIAN_YANG_TELAH_DILAKUKAN'];
                $dataPostIdentification['RESIDUAL_RISK_K_ID']                = $_POST['RESIDUAL_RISK_K_ID']>0?$_POST['RESIDUAL_RISK_K_ID']:0;
                $dataPostIdentification['RESIDUAL_RISK_D_ID']                = $_POST['RESIDUAL_RISK_D_ID']>0?$_POST['RESIDUAL_RISK_D_ID']:0;
                $dataPostIdentification['MITIGASI_RISK_K_ID']                = $_POST['MITIGASI_RISK_K_ID']>0?$_POST['MITIGASI_RISK_K_ID']:0;
                $dataPostIdentification['MITIGASI_RISK_D_ID']                = $_POST['MITIGASI_RISK_D_ID']>0?$_POST['MITIGASI_RISK_D_ID']:0;
                $dataPostIdentification['RISK_ITEM_ID']                      = $_POST['RISK_ITEM_ID']>0?$_POST['RISK_ITEM_ID']:0;
                $dataPostIdentification['RISK_CATEGORY_ID']                  = $_POST['RISK_CATEGORY_ID']>0?$_POST['RISK_CATEGORY_ID']:0;
                $dataPostIdentification['RISK_CLASSIFICATION_ID']            = $_POST['RISK_CLASSIFICATION_ID']>0?$_POST['RISK_CLASSIFICATION_ID']:0;
                $dataPostIdentification['TERMITIGASI']                       = $_POST['TERMITIGASI']>0?$_POST['TERMITIGASI']:0;
                $dataPostIdentification['STATUS_DOKUMEN_ID']                 = $_POST['STATUS_DOKUMEN_ID']>0?$_POST['STATUS_DOKUMEN_ID']:0;

                if(isset($_POST['RISK_IDENTIFICATION_ID']) && $_POST['RISK_IDENTIFICATION_ID']!=""){
                    $idSave = $this->risk_identification_model->update($_POST['RISK_IDENTIFICATION_ID'], $dataPostIdentification);

                    if($idSave > 0){
                        $result = $idSave;
                    }
                }else{
                    /*generate code risk identification*/
                    $dataPostIdentification['CODE'] = $this->risk_identification_model->create_code($_POST['UNIT_ID'], $_POST['TAHUN']);
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
                    /*Update adn Save Mitigation Multiple*/
                    if(isset($_POST['RENCANA_PENGENDALIAN']) && count($_POST['RENCANA_PENGENDALIAN']) > 1 && $_POST['RENCANA_PENGENDALIAN'][1] != ""){
                        
                        $riskMitigationData['RENCANA_PENGENDALIAN'] = $_POST['RENCANA_PENGENDALIAN'];
                        $riskMitigationData['PIC_UNIT_KERJA_ID']    = $_POST['PIC_UNIT_KERJA_ID'];
                        $riskMitigationData['PIC_KANTOR_PUSAT_ID']  = $_POST['PIC_KANTOR_PUSAT_ID'];
                        $riskMitigationData['TARGET_WAKTU']         = $_POST['TARGET_WAKTU'];
                        $riskMitigationData['REALISASI_MITIGASI']   = $_POST['REALISASI_MITIGASI'];

                        $this->risk_mitigation_model->delete_update_backdate($_POST['RISK_IDENTIFICATION_ID'], $riskMitigationData);
                    }

                    echo json_encode(array('status'=>'success', 'RISK_IDENTIFICATION_ID'=>$result));
                }else{
                    echo json_encode(array('status'=>'failed'));
                }
            }
        }

        function edit($id) {
            $this->_updatedata($id);
        }

        function _updatedata($id = 0) {
            $this->load->library('form_validation');
            $form = $this->form;
            
            $this->data['RISK_IDENTIFICATION_ID'] = $id;

            $this->data['UNIT'] = $this->unit_model->drop_options();
            $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
            
            $this->data['INHERENT_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['RESIDUAL_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['MITIGASI_RISK_K'] = $this->risk_probability_model->drop_options();

            $this->data['INHERENT_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['RESIDUAL_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['MITIGASI_RISK_D'] = $this->risk_impact_model->drop_options();

            $this->data['RISK_PIC_K'] = $this->risk_pic_model->drop_options();
            $this->data['RISK_PIC_P'] = $this->risk_pic_model->drop_options();

            $this->data['RISK_CATEGORY'] = $this->risk_category_model->drop_options();            
            $this->data['RISK_CLASSIFICATION'] = $this->risk_classification_model->drop_options();

            if ($id > 0) {
                $row = $this->risk_identification_model->get_by_id((int) $id);
                
                $this->data['RISK_IDENTIFICATION_ID']   = $row->RISK_IDENTIFICATION_ID;
                $this->data['OBJECTIVE']                = $this->risk_pic_model->get_by_id($this->session->userdata('pic_id'))->objective;
                $this->data['HAZARD']                   = $row->HAZARD;
                $this->data['PENYEBAB']                 = $row->PENYEBAB;
                $this->data['DAMPAK']                   = $row->DAMPAK;
                $this->data['TAHUN']                    = $row->TAHUN;
                $this->data['UNIT_ID']                  = $row->UNIT_ID;
                $this->data['RISK_ITEM_ID']             = $row->RISK_ITEM_ID;
                $this->data['RISK_CATEGORY_ID']         = $row->RISK_CATEGORY_ID;
                $this->data['RISK_CLASSIFICATION_ID']   = $row->RISK_CLASSIFICATION_ID;

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

                redirect('report/risk_assessment_report/view/'.$id.'/1');
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
                ->build('risk-update-form');
        }

        function saveWizardUpdate() {
            $result = false;

            if(isset($_POST)){
                $dataPostIdentification['UNIT_ID']                           = $_POST['UNIT_ID'];
                $dataPostIdentification['INSERTED_BY']                       = $_POST['INSERTED_BY'];
                $dataPostIdentification['TAHUN']                             = $_POST['TAHUN'];
                $dataPostIdentification['HAZARD']                            = $_POST['HAZARD'];
                $dataPostIdentification['PENYEBAB']                          = $_POST['PENYEBAB'];
                $dataPostIdentification['DAMPAK']                            = $_POST['DAMPAK'];
                $dataPostIdentification['USER_PIC_ID']                       = $this->user_model->get_by_id((int) $_POST['INSERTED_BY'])->pic_id;
                $dataPostIdentification['INHERENT_RISK_K_ID']                = $_POST['INHERENT_RISK_K_ID']>0?$_POST['INHERENT_RISK_K_ID']:0;
                $dataPostIdentification['INHERENT_RISK_D_ID']                = $_POST['INHERENT_RISK_D_ID']>0?$_POST['INHERENT_RISK_D_ID']:0;
                $dataPostIdentification['PENGENDALIAN_YANG_TELAH_DILAKUKAN'] = $_POST['PENGENDALIAN_YANG_TELAH_DILAKUKAN'];
                $dataPostIdentification['RESIDUAL_RISK_K_ID']                = $_POST['RESIDUAL_RISK_K_ID']>0?$_POST['RESIDUAL_RISK_K_ID']:0;
                $dataPostIdentification['RESIDUAL_RISK_D_ID']                = $_POST['RESIDUAL_RISK_D_ID']>0?$_POST['RESIDUAL_RISK_D_ID']:0;
                $dataPostIdentification['MITIGASI_RISK_K_ID']                = $_POST['MITIGASI_RISK_K_ID']>0?$_POST['MITIGASI_RISK_K_ID']:0;
                $dataPostIdentification['MITIGASI_RISK_D_ID']                = $_POST['MITIGASI_RISK_D_ID']>0?$_POST['MITIGASI_RISK_D_ID']:0;
                $dataPostIdentification['RISK_ITEM_ID']                      = $_POST['RISK_ITEM_ID']>0?$_POST['RISK_ITEM_ID']:0;
                $dataPostIdentification['RISK_CATEGORY_ID']                  = $_POST['RISK_CATEGORY_ID']>0?$_POST['RISK_CATEGORY_ID']:0;
                $dataPostIdentification['RISK_CLASSIFICATION_ID']            = $_POST['RISK_CLASSIFICATION_ID']>0?$_POST['RISK_CLASSIFICATION_ID']:0;
                $dataPostIdentification['TERMITIGASI']                       = $_POST['TERMITIGASI']>0?$_POST['TERMITIGASI']:0;
                // $dataPostIdentification['STATUS_DOKUMEN_ID']                 = $_POST['STATUS_DOKUMEN_ID']>0?$_POST['STATUS_DOKUMEN_ID']:0;

                if(isset($_POST['RISK_IDENTIFICATION_ID']) && $_POST['RISK_IDENTIFICATION_ID']!=""){
                    $idSave = $this->risk_identification_model->update($_POST['RISK_IDENTIFICATION_ID'], $dataPostIdentification);

                    if($idSave > 0){
                        $result = $idSave;
                    }
                }

                if($result){
                    if(isset($_POST['RENCANA_PENGENDALIAN']) && count($_POST['RENCANA_PENGENDALIAN']) > 1 && $_POST['RENCANA_PENGENDALIAN'][1] != ""){
                        
                        $riskMitigationData['RENCANA_PENGENDALIAN'] = $_POST['RENCANA_PENGENDALIAN'];
                        $riskMitigationData['PIC_UNIT_KERJA_ID'] = $_POST['PIC_UNIT_KERJA_ID'];
                        $riskMitigationData['PIC_KANTOR_PUSAT_ID'] = $_POST['PIC_KANTOR_PUSAT_ID'];
                        $riskMitigationData['TARGET_WAKTU'] = $_POST['TARGET_WAKTU'];

                        $this->risk_mitigation_model->delete_update_evaluation($_POST['RISK_IDENTIFICATION_ID'], $riskMitigationData);
                    }
                    echo json_encode(array('status'=>'success', 'RISK_IDENTIFICATION_ID'=>$result));
                }else{
                    echo json_encode(array('status'=>'failed'));
                }
            }
        }
        
        function delete($id) {
            /*delete data*/
            $riskIdentification = $this->risk_identification_model->get_by_id($id);
            if ($riskIdentification)
                $this->risk_identification_model->delete($id);

            /*delete logs*/
            $this->log_model->delete_by_risk_identification_id($id);

            redirect('report/risk_assessment_report/index');
        }
    }
?>