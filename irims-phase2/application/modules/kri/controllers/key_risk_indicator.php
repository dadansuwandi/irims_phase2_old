<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Key Risk Indicator management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class key_risk_indicator extends Admin_Controller {

    protected $form = array(
		'KEY_RISK_INDICATOR_ID' => array(
            'helper' => 'form_hidden'
        ),
		'CODE' => array(
            'label' => 'Code',
            'rules' => 'trim|required|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'auth_user_id' => array(
            'label' => 'For User',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'risk_kpi_id' => array(
            'label' => 'KPI',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'RISK_ITEM_ID' => array(
            'label' => 'Risk Register',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'HAZARD' => array(
            'label' => 'Risk Event',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'BASIC_EVENT' => array(
            'label' => 'Basic Event',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'DASHBOARD_DESCRIPTION' => array(
            'label' => 'Deskripsi Dashboard',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'key_risk_indicator_threshold_id' => array(
            'label' => 'Key Risk Indicator Threshold',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        /* 'THRESHOLD_VALUE' => array(
            'label' => 'Nilai Threshold',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ), */
        'measure_unit' => array(
            'label' => 'Measure Unit',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TOP_RISK_NUMBER' => array(
            'label' => 'Urutan Top Risk',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'PENYEBAB' => array(
            'label' => 'Penyebab',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'INDICATOR_NUMBER' => array(
            'label' => 'Nomor KRI',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'INDICATOR_ID' => array(
            'label' => 'Key Risk Indicator',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'LEADING_LAGGING' => array(
            'label' => 'Leading / Lagging',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'TRAKING_FREQUENCY' => array(
            'label' => 'Traking Frequency',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'THRESHOLD_BAWAH' => array(
            'label' => 'Threshold Batas Bawah',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'THRESHOLD_ATAS' => array(
            'label' => 'Threshold Batas Atas',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'DATA_SOURCE' => array(
            'label' => 'Data Source',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'INDICATOR_RANGKING' => array(
            'label' => 'Indicator',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'STATUS' => array(
			'label' => 'Status',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		)
        /*
		'unit_id' => array(
			'label' => 'Unit',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		)*/
    );

    function __construct() {
        parent::__construct();
        $this->load->model('key_risk_indicator_model');
        $this->load->model('key_risk_indicator_threshold_value_model');
        $this->load->model('key_risk_indicator_threshold_model');
		$this->load->model('auth/user_model');
        $this->load->model('master/risk_item_model');
        $this->load->model('master/indicator_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
        $this->load->model('master/risk_kpi_model');
		
        if ($this->input->post('cancel-button'))
            redirect('kri/key_risk_indicator/index');
    }

    function index_list() {
		$this->data['rows'] = $this->key_risk_indicator_model->get_list_for_user(site_url('kri/key_risk_indicator/index_list'));
		$this->template->build('key-risk-indicator-index-list');
    }

    function index() {
		$this->data['rows'] = $this->key_risk_indicator_model->get_list(site_url('kri/key_risk_indicator/index'));
		$this->template->build('key-risk-indicator-list');
    }
	
	function view($id) {
        $riskItem = $this->risk_item_model->get_by_id($this->session->userdata('risk_item_id'));
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['risk_item'] = $riskItem;
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;

		
        $this->data['risk_item'] = $this->key_risk_indicator_model->get_by_risk_item($riskItem->risk_item_id);
		$this->data['status'] = $this->key_risk_indicator_model->get_by_status($user->status);
		$this->data['unit'] = $this->key_risk_indicator_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->key_risk_indicator_model->get_by_id((int) $id);
        
        $this->data['rows'] = $this->key_risk_indicator_threshold_value_model->get_data($id);

        $this->template->build('key-risk-indicator-view');
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
		
		$this->data['KEY_RISK_INDICATOR_ID'] = '';
        $this->data['CODE'] = $this->key_risk_indicator_model->create_code();
        $this->data['auth_users'] = $this->user_model->drop_options_kri(GROUP_RISK_OWNER);
        $this->data['risk_kpi'] = $this->risk_kpi_model->drop_options();
        $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
        $this->data['INDICATOR'] = $this->indicator_model->drop_options();
        $this->data['INDICATOR_THRESHOLD'] = $this->key_risk_indicator_threshold_model->drop_options();

        $this->data['LEADING_LAGGING_VALUE'] = array(LEADING => "Leading", LAGGING => "Lagging");

		$this->data['STATUS'] = $this->status_model->drop_options();
		$this->data['UNIT'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->key_risk_indicator_model->get_by_id((int) $id);
			
			$this->data['KEY_RISK_INDICATOR_ID'] = $row->KEY_RISK_INDICATOR_ID;
			$this->data['CODE'] = $row->CODE;

            $this->data['auth_users'] = $this->user_model->drop_options_kri(GROUP_RISK_OWNER);
            $this->data['auth_user_id'] = $row->auth_user_id;

            $this->data['risk_kpi'] = $this->risk_kpi_model->drop_options();
            $this->data['risk_kpi_id'] = $row->risk_kpi_id;

            $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
            $this->data['RISK_ITEM_ID'] = $row->RISK_ITEM_ID;

            $this->data['TOP_RISK_NUMBER'] = $row->TOP_RISK_NUMBER;
            $this->data['HAZARD'] = $row->HAZARD;
            $this->data['BASIC_EVENT'] = $row->BASIC_EVENT;
            $this->data['DASHBOARD_DESCRIPTION'] = $row->DASHBOARD_DESCRIPTION;
            $this->data['THRESHOLD_VALUE'] = $row->THRESHOLD_VALUE;
            $this->data['measure_unit'] = $row->measure_unit;

            $this->data['PENYEBAB'] = $row->PENYEBAB;
            $this->data['INDICATOR_NUMBER'] = $row->INDICATOR_NUMBER;
            
            $this->data['INDICATOR'] = $this->indicator_model->drop_options();
            $this->data['INDICATOR_ID'] = $row->INDICATOR_ID;

            $this->data['INDICATOR_THRESHOLD'] = $this->key_risk_indicator_threshold_model->drop_options();
            $this->data['key_risk_indicator_threshold_id'] = $row->key_risk_indicator_threshold_id;
            
            $this->data['LEADING_LAGGING'] = $row->LEADING_LAGGING;
            $this->data['TRAKING_FREQUENCY'] = $row->TRAKING_FREQUENCY;
            $this->data['THRESHOLD_BAWAH'] = $row->THRESHOLD_BAWAH;
            $this->data['THRESHOLD_ATAS'] = $row->THRESHOLD_ATAS;
            $this->data['DATA_SOURCE'] = $row->DATA_SOURCE;
            $this->data['INDICATOR_RANGKING'] = $row->INDICATOR_RANGKING;

            $this->data['LEADING_LAGGING_VALUE'] = array(LEADING => "Leading", LAGGING => "Lagging");
            $this->data['LEADING_LAGGING'] = $row->LEADING_LAGGING;

            $this->data['TAHUN'] = $row->TAHUN;
			$this->data['STATUS'] = $this->status_model->drop_options();
            $this->data['STATUS_ID'] = $row->STATUS;
            $this->data['UNIT'] = $this->unit_model->drop_options();
            $this->data['UNIT_ID'] = $row->UNIT_ID;
            $this->data['CREATED_BY'] = $row->CREATED_BY;
            $this->data['CREATED_DATE'] = $row->CREATED_DATE;
            $this->data['UPDATED_BY'] = $row->UPDATED_BY;
            $this->data['UPDATED_DATE'] = $row->UPDATED_DATE;
			
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->key_risk_indicator_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->key_risk_indicator_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }

            redirect('kri/key_risk_indicator');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('key-risk-indicator-form');
    }

    function delete($id) {
		$key_risk_indicator = $this->key_risk_indicator_model->get_by_id($id);
		if ($key_risk_indicator)
			$this->key_risk_indicator_model->delete($id);
		/* if update status */
        /* $this->key_risk_indicator_model->update($id, array('status' => 0)); */
        redirect('kri/key_risk_indicator');
    }

    public function index_kri_report()
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

		$params = "SELECT * FROM `tx_key_risk_indicator` WHERE TAHUN=$tahun ORDER BY TOP_RISK_NUMBER ASC";

		/*Query Select*/
		$this->data['rows'] = $this->key_risk_indicator_model->get_key_risk_indicator($params);

		$this->data['search']           = $search;
		$this->data['tahun']            = $tahun;

		/*Build View*/
		$this->template->build('key-risk-indicator-report');
	}
	
}

?>