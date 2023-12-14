<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Key Risk Indicator Threshold management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class key_risk_indicator_threshold extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
		'code' => array(
            'label' => 'Code',
            'rules' => 'trim|required|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'INDICATOR_ID' => array(
            'label' => 'Key Risk Indicator',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
		'name' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'threshold_acceptable' => array(
            'label' => 'Threshold Acceptable',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'threshold_tolerable' => array(
            'label' => 'Threshold Tolerable',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'threshold_unacceptable' => array(
            'label' => 'Threshold Unacceptable',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'nilai_awal' => array(
            'label' => 'Nilai Awal',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'simbol' => array(
            'label' => 'Simbol',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'nilai_akhir' => array(
            'label' => 'Nilai Akhir',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'description' => array(
            'label' => 'Description',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        )/*,
		'status' => array(
			'label' => 'Status',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		),
		'unit_id' => array(
			'label' => 'Unit',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		)*/
    );

    function __construct() {
        parent::__construct();
        $this->load->model('key_risk_indicator_threshold_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
        $this->load->model('master/indicator_model');
		
        if ($this->input->post('cancel-button'))
            redirect('kri/key_risk_indicator_threshold/index');
    }

    function index() {
		$this->data['rows'] = $this->key_risk_indicator_threshold_model->get_list(site_url('kri/key_risk_indicator_threshold/index'));
		$this->template->build('key-risk-indicator-threshold-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
		
		$this->data['status'] = $this->key_risk_indicator_threshold_model->get_by_status($user->status);
		$this->data['unit'] = $this->key_risk_indicator_threshold_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->key_risk_indicator_threshold_model->get_by_id((int) $id);
        $this->template->build('key-risk-indicator-threshold-view');
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
		
		$this->data['id'] = '';
        $this->data['code'] = $this->key_risk_indicator_threshold_model->create_code();
        $this->data['INDICATOR'] = $this->indicator_model->drop_options();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->key_risk_indicator_threshold_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['INDICATOR'] = $this->indicator_model->drop_options();
            $this->data['INDICATOR_ID'] = $row->INDICATOR_ID;
            $this->data['name'] = $row->name;
            $this->data['threshold_acceptable'] = $row->threshold_acceptable;
            $this->data['threshold_tolerable'] = $row->threshold_tolerable;
            $this->data['threshold_unacceptable'] = $row->threshold_unacceptable;
            $this->data['nilai_awal'] = $row->nilai_awal;
            $this->data['simbol'] = $row->simbol;
            $this->data['nilai_akhir'] = $row->nilai_akhir;
            $this->data['description'] = $row->description;
			$this->data['status'] = $this->status_model->drop_options();
            $this->data['status_id'] = $row->status;
            $this->data['unit'] = $this->unit_model->drop_options();
            $this->data['unit_id'] = $row->unit_id;
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
			
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->key_risk_indicator_threshold_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->key_risk_indicator_threshold_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('kri/key_risk_indicator_threshold');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('key-risk-indicator-threshold-form');
    }

    function delete($id) {
		$riskCategory = $this->key_risk_indicator_threshold_model->get_by_id($id);
		if ($riskCategory)
			$this->key_risk_indicator_threshold_model->delete($id);
		/* if update status */
        /* $this->key_risk_indicator_threshold_model->update($id, array('status' => 0)); */
        redirect('kri/key_risk_indicator_threshold');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/key_risk_indicator_threshold/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['max_size'] = 0;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $arr_image = array('upload_data' => $this->upload->data());
            $img  = $arr_image["upload_data"]["file_name"];
            if($id > 0){
                $this->key_risk_indicator_threshold_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>