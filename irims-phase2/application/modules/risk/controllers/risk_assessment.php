<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Assessment Controller.
     * 
     * @package App
     * @category Controller
     * @author Jaya Dianto
     */
    class risk_assessment extends Admin_Controller {

        /*protected $form = array(
            'id' => array(
                'helper' => 'form_hidden'
            ),
            'REALISASI_MITIGASI' => array(
                'rules' => 'trim|required|max_length[250]|xss_clean',
                'helper' => 'form_inputlabel'
            ),
            'MITIGASI_RISK_K_ID' => array(
                'rules' => 'trim',
                'helper' => 'form_dropdownlabel',
                'extra' => ''
            ),
            'MITIGASI_RISK_D_ID' => array(
                'rules' => 'trim',
                'helper' => 'form_dropdownlabel',
                'extra' => ''
            ),
        );*/

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
            $this->load->model('notification/notification_model');
            $this->load->model('master/risk_impact_indicator_model');
            $this->load->model('master/risk_impact_category_model');
    		
            if ($this->input->post('cancel-button'))
                redirect('risk/risk_register/index');
        }

        function monitored_list() {
    		  $this->data['rows'] = $this->risk_identification_model->get_list_owner(array(4,5,7));
    		  $this->template->build('risk-assessment-list');
        }

        function mitigated_list() {
            $this->data['rows'] = $this->risk_identification_model->get_list_owner(array(6));
            $this->template->build('risk-assessment-list');
        }

        function mitigated_list_admin() {
            $this->data['rows'] = $this->risk_identification_model->get_list_admin(array(6));
            $this->template->build('risk-assessment-list-admin');
        }
    	
    	function view($id) {
    		$this->data['row']            = $this->risk_identification_model->get_by_id((int) $id);
            $this->data['pic_unit_kerja'] = $this->risk_identification_pic_model->get_data_pic($id, 0);
            $this->data['logs']           = $this->log_model->get_by_risk_identification_id($id);

            $this->data['risk_mitigation_files'] = $this->risk_mitigation_file_model->get_by_risk_identification_id($id);
            
            $this->template->build('risk-assessment-view');
        }

        function mitigation($id){
            $this->_updatedata($id);
        }

        function _updatedata($id = 0) {
    		$this->data['RISK_IDENTIFICATION_ID'] = $id;

            $this->data['INHERENT_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['RESIDUAL_RISK_K'] = $this->risk_probability_model->drop_options();
            $this->data['MITIGASI_RISK_K'] = $this->risk_probability_model->drop_options();

            $this->data['INHERENT_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['RESIDUAL_RISK_D'] = $this->risk_impact_model->drop_options();
            $this->data['MITIGASI_RISK_D'] = $this->risk_impact_model->drop_options();

            $this->data['RISK_PIC_K'] = $this->risk_pic_model->drop_options();
            $this->data['RISK_PIC_P'] = $this->risk_pic_model->drop_options();
            

            if ($id > 0) {
                $row = $this->risk_identification_model->get_by_id((int) $id);
                $this->data['RISK_IDENTIFICATION_ID']   = $row->RISK_IDENTIFICATION_ID;
                $this->data['OBJECTIVE']                = $row->OBJECTIVE;
                $this->data['HAZARD']                   = $row->HAZARD;
                $this->data['QUANTIFICATION']           = $row->QUANTIFICATION;
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
                $this->data['RESIDUAL_RISK_D_VALUE']           = $this->risk_impact_model->get_by_id($row->RESIDUAL_RISK_D_ID);

                $this->data['RENCANA_PENGENDALIAN']             = $row->RENCANA_PENGENDALIAN;
                $this->data['RISK_IDENTIFICATION_PIC']          = $this->risk_identification_pic_model->get_list_id($id, 0);

                $this->data['TARGET_WAKTU']                     = $row->TARGET_WAKTU;

                $this->data['REALISASI_MITIGASI']               = $row->REALISASI_MITIGASI;
                
                $this->data['MITIGASI_RISK_K_ID']               = $row->MITIGASI_RISK_K_ID;
                $this->data['MITIGASI_RISK_K_VALUE']            = $this->risk_probability_model->get_by_id($row->MITIGASI_RISK_K_ID);

                $this->data['MITIGASI_RISK_D_ID']               = $row->MITIGASI_RISK_D_ID;
                $this->data['MITIGASI_RISK_D_VALUE']            = $this->risk_impact_model->get_by_id($row->MITIGASI_RISK_D_ID);

    			      $this->data['FILE']                             = $row->FILE;

                $this->data['pic_unit_kerja']                   = $this->risk_identification_pic_model->get_data_pic($id, 0);
                $this->data['mitigation'] = $this->risk_mitigation_model->get_data($id);
            }

            if(isset($_POST['MITIGASI_RISK_K_ID']) && isset($_POST['MITIGASI_RISK_D_ID'])){
                /*update to risk mitigation*/
                $mitigasiData = $this->risk_mitigation_model->get_data($id);
                foreach ($mitigasiData as $mitigation_id) {
                    $mitigasi_data['REALISASI_MITIGASI']    = $_POST['REALISASI_MITIGASI'][$mitigation_id->RISK_MITIGATION_ID];
                    $mitigasi_data['EXECUTION_TIME']        = $_POST['EXECUTION_TIME'][$mitigation_id->RISK_MITIGATION_ID];
                    $mitigasi_data['YEAR']                  = $_POST['YEAR'][$mitigation_id->RISK_MITIGATION_ID];
                    $mitigasi_data['MONTH']                 = $_POST['MONTH'][$mitigation_id->RISK_MITIGATION_ID];
                    $mitigasi_data['DAY']                   = $_POST['DAY'][$mitigation_id->RISK_MITIGATION_ID];
                    $this->risk_mitigation_model->update($mitigation_id->RISK_MITIGATION_ID, $mitigasi_data);
                }

                // /*update to risk mitigation*/
                // foreach ($_POST['REALISASI_MITIGASI'] as $mitigation_id => $value) {
                //     $mitigasi_data['REALISASI_MITIGASI'] = $value;
                //     $this->risk_mitigation_model->update($mitigation_id, $mitigasi_data);
                // }

                /*save to risk identification*/
                $data['MITIGASI_RISK_K_ID'] = $_POST['MITIGASI_RISK_K_ID'];
                $data['MITIGASI_RISK_D_ID'] = $_POST['MITIGASI_RISK_D_ID'];
                $this->risk_identification_model->update($id, $data);

                redirect('risk/risk_assessment/view/'.$id);
            }

            $this->template
                ->set_css_global('plugins/select2/select2')
                ->set_css_global('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5')
                /*<!-- blueimp Gallery styles -->*/
                ->set_css_global('plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min')
                ->set_css_global('plugins/jquery-file-upload/css/jquery.fileupload')
                ->set_css_global('plugins/jquery-file-upload/css/jquery.fileupload-ui')
                ->set_js_global('plugins/select2/select2.min')
                ->set_js_global('plugins/jquery-validation/js/jquery.validate.min')
                ->set_js_global('plugins/jquery-validation/js/additional-methods.min')
                ->set_js_global('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min')
                ->set_js_global('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0')
                ->set_js_global('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5')
                ->set_js_global('plugins/fancybox/source/jquery.fancybox.pack')
                /*<!-- BEGIN:File Upload Plugin JS files-->*/
                /*<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->*/
                ->set_js_global('plugins/jquery-file-upload/js/vendor/jquery.ui.widget')
                /*<!-- The Templates plugin is included to render the upload/download listings -->*/
                ->set_js_global('plugins/jquery-file-upload/js/vendor/tmpl.min')
                /*<!-- The Load Image plugin is included for the preview images and image resizing functionality -->*/
                ->set_js_global('plugins/jquery-file-upload/js/vendor/load-image.min')
                /*<!-- The Canvas to Blob plugin is included for image resizing functionality -->*/
                ->set_js_global('plugins/jquery-file-upload/js/vendor/canvas-to-blob.min')
                /*<!-- blueimp Gallery script -->*/
                ->set_js_global('plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min')
                /*<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.iframe-transport')
                /*<!-- The basic File Upload plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload')
                /*<!-- The File Upload processing plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-process')
                /*<!-- The File Upload image preview & resize plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-image')
                /*<!-- The File Upload audio preview plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-audio')
                /*<!-- The File Upload video preview plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-video')
                /*<!-- The File Upload validation plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-validate')
                /*<!-- The File Upload user interface plugin -->*/
                ->set_js_global('plugins/jquery-file-upload/js/jquery.fileupload-ui')
                /*<!-- The main application script -->*/
                /*<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->*/
                /*<!--[if (gte IE 8)&(lt IE 10)]>*/
                /*->set_js_global('plugins/jquery-file-upload/js/cors/jquery.xdr-transport')*/
                /*<![endif]-->*/
                /*<!-- END:File Upload Plugin JS files-->*/
                ->set_js_admin('pages/scripts/form-fileupload')
                ->build('risk-assessment-form');
        }

      //   function saveWizard() {
      //       $result = false;

      //       if(isset($_POST)){
      //           $dataPostIdentification['OBJECTIVE']                         = $_POST['OBJECTIVE'];
      //           $dataPostIdentification['HAZARD']                            = $_POST['HAZARD'];
      //           $dataPostIdentification['QUANTIFICATION']                    = $_POST['QUANTIFICATION'];
      //           $dataPostIdentification['PENYEBAB']                          = $_POST['PENYEBAB'];
      //           $dataPostIdentification['DAMPAK']                            = $_POST['DAMPAK'];
      //           $dataPostIdentification['INHERENT_RISK_K_ID']                = $_POST['INHERENT_RISK_K_ID'];
      //           $dataPostIdentification['INHERENT_RISK_D_ID']                = $_POST['INHERENT_RISK_D_ID'];
      //           $dataPostIdentification['PENGENDALIAN_YANG_TELAH_DILAKUKAN'] = $_POST['PENGENDALIAN_YANG_TELAH_DILAKUKAN'];
      //           $dataPostIdentification['RESIDUAL_RISK_K_ID']                = $_POST['RESIDUAL_RISK_K_ID'];
      //           $dataPostIdentification['RESIDUAL_RISK_D_ID']                = $_POST['RESIDUAL_RISK_D_ID'];
      //           $dataPostIdentification['RENCANA_PENGENDALIAN']              = $_POST['RENCANA_PENGENDALIAN'];
      //           $dataPostIdentification['TARGET_WAKTU']                      = $_POST['TARGET_WAKTU'];

      //           if(isset($_POST['RISK_IDENTIFICATION_ID']) && $_POST['RISK_IDENTIFICATION_ID']!=""){
      //               $idSave = $this->risk_identification_model->update($_POST['RISK_IDENTIFICATION_ID'], $dataPostIdentification);

      //               if($idSave > 0){
      //                   $result = $idSave;
      //               }
      //           }else{
      //               $idSave = $this->risk_identification_model->insert($dataPostIdentification);
                    
      //               if($idSave > 0){
      //                   $result = $idSave;
      //               }
      //           }

      //           if($result){
      //               /*update and save PIC*/
      //               if(isset($_POST['RISK_PIC_ID_K'])){
      //                   $this->risk_identification_pic_model->delete_update($_POST['RISK_IDENTIFICATION_ID'], $_POST['RISK_PIC_ID_K']);
      //               }
      //               echo json_encode(array('status'=>'success', 'RISK_IDENTIFICATION_ID'=>$result));
      //           }else{
      //               echo json_encode(array('status'=>'failed'));
      //           }
      //       }
      //   }
        
        function delete($id) {
    		$riskIdentification = $this->risk_identification_model->get_by_id($id);
    		if ($riskIdentification)
    			$this->risk_identification_model->delete($id);
            redirect('risk/risk_assessment');
        }

        function change_status(){
            if(isset($_GET['id']) && isset($_GET['status'])){
                $riskModel = $this->risk_identification_model->get_by_id($_GET['id']);

                $data['STATUS_DOKUMEN_ID']      = $_GET['status'];
                $data['RISK_IDENTIFICATION_ID'] = $_GET['id'];

                $this->risk_identification_model->update($_GET['id'], $data);

                if($_GET['status']==5){
                    /*crete insert log */
                    $logData['risk_identification_id']  = $_GET['id'];
                    $logData['created_date']            = date("Y-m-d H:i:s");
                    $logData['user_id']                 = $this->session->userdata('auth_user');
                    $logData['keterangan']              = "Dokumen mitigasi telah diajukan ke risk admin untuk di evaluasi";
                    $this->log_model->insert($logData);

                    /*create notification to admin*/
                    $notification['description']    = "Risk mitigation ".$riskModel->CODE." perlu approval anda";
                    $notification['url']            = site_url('risk/risk_evaluation/view_mitigated/'.$_GET['id']);
                    $notification['role_id']        = GROUP_RISK_ADMIN;
                    $notification['pic_id']         = 0;
                    $notification['created_date']   = date('Y-m-d H:i:s');
                    $notification['status']         = "UNREAD";
                    $this->notification_model->insert($notification);

                    // /* sent notification by email */
                    $userID = $this->risk_identification_model->get_by_id($_GET['id'])->INSERTED_BY;
                    $emailRiskOwner = $this->user_model->get_by_id($userID)->email;
                    $emailRiskAdmin = $this->user_model->get_by_username('risk-admin')->email;
                    // /* email parameters */
                    // $fromEmail  = $emailRiskAdmin;
                    // $fromName   = 'IRIMS';
                    // $to         = array($emailRiskOwner);
                    // $attachment = NULL;
                    // $subject    = '#'.$_GET['id'].' - Risk mitigation '.$riskModel->CODE.' perlu approval anda';
                    // $message    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen mitigasi telah diajukan ke risk admin untuk di evaluasi'; 
                    // $this->sendNotificationByEmail($fromEmail, $fromName, $to, $attachment, $subject, $message);

                    $to         = $emailRiskAdmin;
                    $subject    = '#'.$_GET['id'].' - Risk mitigation '.$riskModel->CODE.' perlu approval anda';
                    $content    = '<strong>Status : #'.$_GET['id'].'</strong> - Dokumen mitigasi telah diajukan ke risk admin untuk di evaluasi';
                    $link       = '<a href='.base_url().'risk/risk_evaluation/view/'.$_GET['id'].'>#'.$_GET['id'].'</a>';

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

                    $this->template->set_flashdata('info', 'Dokumen telah diajukan ke risk admin untuk di evaluasi.');
                    redirect('risk/risk_assessment/monitored_list');
                }

                /*if($_GET['status']==6){
                    $this->template->set_flashdata('info', 'Dokumen telah diajukan ke risk admin untuk di evaluasi.');
                    redirect('risk/risk_assessment/mitigated_list');
                }*/

                    
            }else{
                redirect('risk/risk_assessment/monitored_list');
            }
        }

        function do_upload() {
          $upload_path_url = base_url() . 'uploads/risk_mitigation/';

          $config['upload_path'] = FCPATH . 'uploads/risk_mitigation/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif|txt|csv|psd|pdf|xls|ppt|gz|tar|zip|text|xml|xsl|doc|docx|xlsx|word';
          $config['max_width'] = 0;
          $config['max_height'] = 0;
          $config['max_size'] = 1000000;
          //if you want encrypt the file name
          //$config['encrypt_name'] = TRUE;
          $new_name = date("YmdHis").'_'.$_FILES["userfile"]['name'];
          $config['file_name'] = $new_name;

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload()) {
              //$error = array('error' => $this->upload->display_errors());
              //$this->load->view('upload', $error);

              //Load the list of existing files in the upload directory
              // $existingFiles = get_dir_file_info($config['upload_path']);
              // $foundFiles = array();
              // $f=0;
              // foreach ($existingFiles as $fileName => $info) {
              //   if($fileName!='thumbs'){//Skip over thumbs directory
              //     //set the data for the json array   
              //     $foundFiles[$f]['name'] = $fileName;
              //     $foundFiles[$f]['size'] = $info['size'];
              //     $foundFiles[$f]['type'] = $info['type'];
              //     $foundFiles[$f]['url'] = $upload_path_url . $fileName;
              //     $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
              //     $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/risk/risk_assessment/deleteFile/' . $fileName;
              //     $foundFiles[$f]['deleteType'] = 'DELETE';
              //     $foundFiles[$f]['error'] = null;
                  
              //     $f++;
              //   }
              // }
              
              //Document-document upload
              $existingFiles = $this->risk_mitigation_file_model->get_by_risk_identification_id($this->uri->segment(4));
              $foundFiles = array();
              $f=0;
              foreach ($existingFiles as $fileName => $info) {
                //if($fileName!='thumbs'){//Skip over thumbs directory
                  //set the data for the json array   
                  $foundFiles[$f]['name'] = $info->FILE_NAME;
                  $foundFiles[$f]['size'] = $info->FILE_SIZE;
                  $foundFiles[$f]['type'] = $info->FILE_TYPE;
                  $foundFiles[$f]['url'] = $upload_path_url . $info->FILE_NAME;
                  $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $info->FILE_NAME;
                  $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/risk/risk_assessment/deleteFile/' . $info->FILE_NAME;
                  $foundFiles[$f]['deleteType'] = 'DELETE';
                  $foundFiles[$f]['error'] = null;
                  
                  $f++;
                //}
              }

              $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(array('files' => $foundFiles)));
          } else {
              $data = $this->upload->data();
              /*
               * Array
                (
                [file_name] => png1.jpg
                [file_type] => image/jpeg
                [file_path] => /home/ipresupu/public_html/uploads/risk_mitigation/
                [full_path] => /home/ipresupu/public_html/uploads/risk_mitigation/png1.jpg
                [raw_name] => png1
                [orig_name] => png.jpg
                [client_name] => png.jpg
                [file_ext] => .jpg
                [file_size] => 456.93
                [is_image] => 1
                [image_width] => 1198
                [image_height] => 1166
                [image_type] => jpeg
                [image_size_str] => width="1198" height="1166"
                )
               */
              // to re-size for thumbnail images un-comment and set path here and in json array
					// $config = array();
					  // $config['image_library'] = 'gd2';
					  // $config['source_image'] = $data['full_path'];
					  // $config['create_thumb'] = TRUE;
					  // $config['new_image'] = $data['file_path'] . 'thumbs/';
					  // $config['maintain_ratio'] = TRUE;
					  // $config['thumb_marker'] = '';
					  // $config['width'] = 75;
					  // $config['height'] = 50;
					  // $this->load->library('image_lib', $config);
					  // $this->image_lib->resize();
              

              
              //set the data for the json array
              $info = new StdClass;
              $info->name = $data['file_name'];
              $info->size = $data['file_size'] * 1024;
              $info->type = $data['file_type'];
              $info->url = $upload_path_url . $data['file_name'];
              // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
              $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
              $info->deleteUrl = base_url() . 'index.php/risk/risk_assessment/deleteFile/' . $data['file_name'];
              $info->deleteType = 'DELETE';
              $info->error = null;

              $files[] = $info;
              //this is why we put this in the constants to pass only json data
              if (IS_AJAX) {
                  echo json_encode(array("files" => $files));
                  //this has to be the only data returned or you will get an error.
                  //if you don't give this a json array it will give you a Empty file upload result error
                  //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                  // so that this will still work if javascript is not enabled
              } else {
                  $file_data['upload_data'] = $this->upload->data();
                  $this->load->view('risk/risk_assessment/upload_success', $file_data);
              }

              /*save to tx_risk_mitigation_files*/
              if(isset($_POST['RISK_IDENTIFICATION_ID'])) {
                $fileData['RISK_IDENTIFICATION_ID']   = $_POST['RISK_IDENTIFICATION_ID'];
                $fileData['FILE_NAME']                = $data['file_name'];
                $fileData['FILE_PATH']                = $data['file_path'];
                $fileData['FILE_FULL_PATH']           = $data['full_path'];
                $fileData['FILE_SIZE']                = $data['file_size'];
                $fileData['FILE_TYPE']                = $data['file_type'];
                $fileData['FILE_URL']                 = $data['full_path'];
                $fileData['FILE_TITLE']               = $data['raw_name'];
                $fileData['FILE_EXT']                 = $data['file_ext'];
                $fileData['FILE_ORIG_NAME']           = $data['orig_name'];
                $fileData['FILE_CLIENT_NAME']         = $data['client_name'];
                $fileData['DESCRIPTION']              = 'FILENAME IS '.$data['orig_name'];
                $this->risk_mitigation_file_model->insert($fileData);

                $this->template->set_flashdata('info', 'File telah diupload.');
    
                //redirect('risk/risk_assessment/mitigation/'.$_POST['RISK_IDENTIFICATION_ID']);
              } //else {
                //redirect('risk/risk_assessment/mitigation/'.$_POST['RISK_IDENTIFICATION_ID']);
              //}
          }
        }

        function deleteFile($file) {//gets the job done but you might want to add error checking and security
          $success = unlink(FCPATH . 'uploads/risk_mitigation/' . $file);
          $success = unlink(FCPATH . 'uploads/risk_mitigation/thumbs/' . $file);
          //info to see if it is doing what it is supposed to
          $info = new StdClass;
          $info->sucess = $success;
          $info->path = base_url() . 'uploads/risk_mitigation/' . $file;
          $info->file = is_file(FCPATH . 'uploads/risk_mitigation/' . $file);

          if (IS_AJAX) {
              //I don't think it matters if this is set but good for error checking in the console/firebug
              echo json_encode(array($info));
          } else {
              //here you will need to decide what you want to show for a successful delete    
              $file_data['delete_data'] = $file;
              $this->load->view('risk/risk_assessment/delete_success', $file_data);
          }

          /*delete from tx_risk_mitigation_files*/
          $deleteFromTable = $this->risk_mitigation_file_model->get_by_file($file);
          if ($deleteFromTable) {
            $this->db->delete('tx_risk_mitigation_files', array('FILE_NAME' => $file));
          }

        }

    }
?>