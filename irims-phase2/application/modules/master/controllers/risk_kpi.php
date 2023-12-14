<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Kpi management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class risk_kpi extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
		'code' => array(
            'label' => 'Code',
            'rules' => 'trim|required|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'name' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET' => array(
            'label' => 'TARGET',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET_SATUAN' => array(
            'label' => 'TARGET SATUAN',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET_KET' => array(
            'label' => 'TARGET KET',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET_REVISI' => array(
            'label' => 'TARGET REVISI',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET_REVISI_SATUAN' => array(
            'label' => 'TARGET REVISI SATUAN',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TARGET_REVISI_KET' => array(
            'label' => 'TARGET REVISI KET',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'ACCEPTABLE' => array(
            'label' => 'ACCEPTABLE',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'ACCEPTABLE_SATUAN' => array(
            'label' => 'ACCEPTABLE SATUAN',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'ACCEPTABLE_KET' => array(
            'label' => 'ACCEPTABLE KET',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TORELABLE' => array(
            'label' => 'TORELABLE',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TORELABLE_SATUAN' => array(
            'label' => 'TORELABLE SATUAN',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'TORELABLE_KET' => array(
            'label' => 'TORELABLE KET',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'UNACCEPTABLE' => array(
            'label' => 'UNACCEPTABLE',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'UNACCEPTABLE_SATUAN' => array(
            'label' => 'UNACCEPTABLE SATUAN',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'UNACCEPTABLE_KET' => array(
            'label' => 'UNACCEPTABLE KET',
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
        $this->load->model('risk_kpi_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_kpi/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_kpi_model->get_list(site_url('master/risk_kpi/index'));
		$this->template->build('risk-kpi-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
		
		$this->data['status'] = $this->risk_kpi_model->get_by_status($user->status);
		$this->data['unit'] = $this->risk_kpi_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->risk_kpi_model->get_by_id((int) $id);
        $this->template->build('risk-kpi-view');
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
        $this->data['code'] = $this->risk_kpi_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->risk_kpi_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['TARGET'] = $row->TARGET;
            $this->data['TARGET_SATUAN'] = $row->TARGET_SATUAN;
            $this->data['TARGET_KET'] = $row->TARGET_KET;
            $this->data['TARGET_REVISI'] = $row->TARGET_REVISI;
            $this->data['TARGET_REVISI_SATUAN'] = $row->TARGET_REVISI_SATUAN;
            $this->data['TARGET_REVISI_KET'] = $row->TARGET_REVISI_KET;
            $this->data['ACCEPTABLE'] = $row->ACCEPTABLE;
            $this->data['ACCEPTABLE_SATUAN'] = $row->ACCEPTABLE_SATUAN;
            $this->data['ACCEPTABLE_KET'] = $row->ACCEPTABLE_KET;
            $this->data['TORELABLE'] = $row->TORELABLE;
            $this->data['TORELABLE_SATUAN'] = $row->TORELABLE_SATUAN;
            $this->data['TORELABLE_KET'] = $row->TORELABLE_KET;
            $this->data['UNACCEPTABLE'] = $row->UNACCEPTABLE;
            $this->data['UNACCEPTABLE_SATUAN'] = $row->UNACCEPTABLE_SATUAN;
            $this->data['UNACCEPTABLE_KET'] = $row->UNACCEPTABLE_KET;
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
                $this->risk_kpi_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_kpi_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('master/risk_kpi');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-kpi-form');
    }

    function delete($id) {
		$riskKpi = $this->risk_kpi_model->get_by_id($id);
		if ($riskKpi)
			$this->risk_kpi_model->delete($id);
		/* if update status */
        /* $this->risk_kpi_model->update($id, array('status' => 0)); */
        redirect('master/risk_kpi');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/risk_kpi/';
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
                $this->risk_kpi_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>