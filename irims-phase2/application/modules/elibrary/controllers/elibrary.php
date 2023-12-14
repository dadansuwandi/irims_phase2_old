<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Elibrary management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class Elibrary extends Admin_Controller {

  protected $form = array(
		'TX_ELIBRARY_ID' => array(
        'helper' => 'form_hidden'
    )/*,
		'FILE_NAME' => array(
        'label' => 'FILE_NAME',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_PATH' => array(
        'label' => 'FILE_PATH',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_FULL_PATH' => array(
        'label' => 'FILE_FULL_PATH',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_SIZE' => array(
        'label' => 'FILE_SIZE',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_TYPE' => array(
        'label' => 'FILE_TYPE',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_URL' => array(
        'label' => 'FILE_URL',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_TITLE' => array(
        'label' => 'FILE_TITLE',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_EXT' => array(
        'label' => 'FILE_EXT',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_ORIG_NAME' => array(
        'label' => 'FILE_ORIG_NAME',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'FILE_CLIENT_NAME' => array(
        'label' => 'FILE_CLIENT_NAME',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
    'DESCRIPTION' => array(
        'label' => 'DESCRIPTION',
        'rules' => 'trim|required|max_length[250]|xss_clean',
        'helper' => 'form_inputlabel'
    ),
		'STATUS' => array(
			'label' => 'STATUS',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		),
		'UNIT_ID' => array(
			'label' => 'UNIT_ID',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		)*/
  );

  function __construct() {
      parent::__construct();
      $this->load->model('elibrary_model');
      $this->load->model('master/status_model');
	    $this->load->model('master/unit_model');
	
      if ($this->input->post('cancel-button'))
          redirect('elibrary/elibrary/index');
  }

  function index() {
	  $this->data['rows'] = $this->elibrary_model->get_list(site_url('elibrary/elibrary/index'));
	  $this->template->build('elibrary-list');
  }
	
	function view($id) {
    $this->load->model('auth/user_model');
    $this->load->model('master/unit_model');
    $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
    $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
    $this->data['user'] = $user;
    $this->data['unit'] = $unit;

    $this->data['row'] = $this->elibrary_model->get_by_id((int) $id);
    $this->template->build('elibrary-view');
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
	
    $this->data['TX_ELIBRARY_ID'] = '';

    if ($id > 0) {
      $row = $this->elibrary_model->get_by_id((int) $id);

      $this->data['FILE'] = $row->FILE;
	
      /*$this->data['TX_ELIBRARY_ID'] = $row->TX_ELIBRARY_ID;
      $this->data['FILE_NAME'] = $row->FILE_NAME;
      $this->data['FILE_PATH'] = $row->FILE_PATH;
      $this->data['FILE_FULL_PATH'] = $row->FILE_FULL_PATH;
      $this->data['FILE_SIZE'] = $row->FILE_SIZE;
      $this->data['FILE_TYPE'] = $row->FILE_TYPE;
      $this->data['FILE_URL'] = $row->FILE_URL;
      $this->data['FILE_TITLE'] = $row->FILE_TITLE;
      $this->data['FILE_EXT'] = $row->FILE_EXT;
      $this->data['FILE_ORIG_NAME'] = $row->FILE_ORIG_NAME;
      $this->data['FILE_CLIENT_NAME'] = $row->FILE_CLIENT_NAME;
      $this->data['DESCRIPTION'] = $row->DESCRIPTION;
      $this->data['STATUS'] = $this->status_model->drop_options();
      $this->data['STATUS_ID'] = $row->STATUS;
      $this->data['UNIT'] = $this->unit_model->drop_options();
      $this->data['UNIT_ID'] = $row->UNIT_ID;
      $this->data['CREATED_BY'] = $row->CREATED_BY;
      $this->data['CREATED_DATE'] = $row->CREATED_DATE;
      $this->data['UPDATED_BY'] = $row->UPDATED_BY;
      $this->data['UPDATED_DATE'] = $row->UPDATED_DATE;*/
    }

    $this->form_validation->init($form);
	
    if ($this->form_validation->run()) {
      if ($id > 0) {
        $this->elibrary_model->update($id, $this->form_validation->get_values());
		    $this->template->set_flashdata('info', 'Data has been updated');
      } else {
        $this->elibrary_model->insert($this->form_validation->get_values());
		    $this->template->set_flashdata('info', 'Data has been added');
      }

        redirect('elibrary/elibrary');
    }

    $this->data['form'] = $this->form_validation;
      
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
      ->build('elibrary-form');
  }

  function delete($id) {
    $elibrary = $this->elibrary_model->get_by_id($id);
    if ($elibrary)
		  $this->elibrary_model->delete($id);

      redirect('elibrary/elibrary');
  }

  function delete_file() {
      $this->_updatedata();
  }

  function do_upload() {
    $upload_path_url = base_url() . 'uploads/risk_elibrary/';

    $config['upload_path'] = FCPATH . 'uploads/risk_elibrary/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif|txt|csv|bin|exe|psd|dll|pdf|xls|ppt|gz|tar|zip|text|xml|xsl|doc|docx|xlsx|word';
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $config['max_size'] = '500000000000';
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
      $existingFiles = get_dir_file_info($config['upload_path']);
      //$existingFiles = $this->risk_mitigation_file_model->get_by_risk_identification_id($this->uri->segment(4));
      $foundFiles = array();
      $f=0;
      foreach ($existingFiles as $fileName => $info) {
        if($fileName!='thumbs'){//Skip over thumbs directory
          //set the data for the json array   
          $foundFiles[$f]['name'] = $fileName;
          $foundFiles[$f]['size'] = $info->FILE_SIZE;
          $foundFiles[$f]['type'] = $info->FILE_TYPE;
          $foundFiles[$f]['url'] = $upload_path_url . $fileName;
          $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
          $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/elibrary/elibrary/deleteFile/' . $fileName;
          $foundFiles[$f]['deleteType'] = 'DELETE';
          $foundFiles[$f]['error'] = null;
          
          $f++;
        }
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
      $config = array();
      $config['image_library'] = 'gd2';
      $config['source_image'] = $data['full_path'];
      $config['create_thumb'] = TRUE;
      $config['new_image'] = $data['file_path'] . 'thumbs/';
      $config['maintain_ratio'] = TRUE;
      $config['thumb_marker'] = '';
      $config['width'] = 75;
      $config['height'] = 50;
      $this->load->library('image_lib', $config);
      $this->image_lib->resize();

      
      //set the data for the json array
      $info = new StdClass;
      $info->name = $data['file_name'];
      $info->size = $data['file_size'] * 1024;
      $info->type = $data['file_type'];
      $info->url = $upload_path_url . $data['file_name'];
      // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
      $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
      $info->deleteUrl = base_url() . 'index.php/elibrary/elibrary/deleteFile/' . $data['file_name'];
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
          $this->load->view('elibrary/elibrary/upload_success', $file_data);
      }

      /*save to tx_risk_mitigation_files*/
      //if(isset($_POST['RISK_IDENTIFICATION_ID'])) {
        //$fileData['RISK_IDENTIFICATION_ID']   = $_POST['RISK_IDENTIFICATION_ID'];
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
        $this->elibrary_model->insert($fileData);

        $this->template->set_flashdata('info', 'File telah diupload.');

        //redirect('risk/risk_assessment/mitigation/'.$_POST['RISK_IDENTIFICATION_ID']);
      //} else {
        //redirect('risk/risk_assessment/mitigation/'.$_POST['RISK_IDENTIFICATION_ID']);
      //}
    }
  }

  function deleteFile($file) {//gets the job done but you might want to add error checking and security
    $success = unlink(FCPATH . 'uploads/risk_elibrary/' . $file);
    $success = unlink(FCPATH . 'uploads/risk_elibrary/thumbs/' . $file);
    //info to see if it is doing what it is supposed to
    $info = new StdClass;
    $info->sucess = $success;
    $info->path = base_url() . 'uploads/risk_elibrary/' . $file;
    $info->file = is_file(FCPATH . 'uploads/risk_elibrary/' . $file);

    if (IS_AJAX) {
        //I don't think it matters if this is set but good for error checking in the console/firebug
        echo json_encode(array($info));
    } else {
        //here you will need to decide what you want to show for a successful delete    
        $file_data['delete_data'] = $file;
        $this->load->view('elibrary/elibrary/delete_success', $file_data);
    }

    /*delete from tx_elibraries*/
    $deleteFromTable = $this->elibrary_model->get_by_file($file);
    if ($deleteFromTable) {
      $this->db->delete('tx_elibraries', array('FILE_NAME' => $file));
    }

  }

  function edit_role($id) {
      $this->_updatedata_role($id);
  }

  function _updatedata_role($id = 0) {
    $this->load->library('form_validation');
    $form = $this->form;
  
    $this->data['TX_ELIBRARY_ID'] = '';

    if ($id > 0) {
      $row = $this->elibrary_model->get_by_id((int) $id);
  
      $this->data['TX_ELIBRARY_ID'] = $row->TX_ELIBRARY_ID;
      $this->data['ROLE_ID'] = $row->ROLE_ID;
    }

    //$this->form_validation->init($form);
  
    //if ($this->form_validation->run()) {
    if ($_POST) {
      if ($id > 0) {
        $this->elibrary_model->update_role($id, $this->form_validation->get_values());
        $this->template->set_flashdata('info', 'Data has been updated');
      } else {
        //$this->elibrary_model->insert($this->form_validation->get_values());
        $this->template->set_flashdata('info', 'Data has been added');
      }

        redirect('elibrary/elibrary');
    }

    $this->data['form'] = $this->form_validation;
      
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
      ->build('elibrary-form-role');
  }

}

?>