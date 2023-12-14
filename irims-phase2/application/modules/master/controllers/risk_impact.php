<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Impact management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class risk_impact extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
		'code' => array(
            'label' => 'Code',
            'rules' => 'trim|required|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'alphabet' => array(
            'label' => 'Alphabet',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'name' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_financial' => array(
            'label' => 'Impact Financial',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'begin' => array(
            'label' => 'Begin',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'end' => array(
            'label' => 'End',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_compliance' => array(
            'label' => 'Impact Compliance',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_reputation' => array(
            'label' => 'Impact Reputation',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_safety' => array(
            'label' => 'Impact Safety',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_operation_technique' => array(
            'label' => 'Impact Operation & Technique',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_strategic' => array(
            'label' => 'Impact Strategic',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'impact_environment' => array(
            'label' => 'Impact Environment',
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
        $this->load->model('risk_impact_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_impact/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_impact_model->get_list(site_url('master/risk_impact/index'));
		$this->template->build('risk-impact-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
		
		$this->data['status'] = $this->risk_impact_model->get_by_status($user->status);
		$this->data['unit'] = $this->risk_impact_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->risk_impact_model->get_by_id((int) $id);
        $this->template->build('risk-impact-view');
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
        $this->data['code'] = $this->risk_impact_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->risk_impact_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['alphabet'] = $row->alphabet;
            $this->data['name'] = $row->name;
            $this->data['impact_financial'] = $row->impact_financial;
            $this->data['begin'] = $row->begin;
            $this->data['end'] = $row->end;
            $this->data['impact_compliance'] = $row->impact_compliance;
            $this->data['impact_reputation'] = $row->impact_reputation;
            $this->data['impact_safety'] = $row->impact_safety;
            $this->data['impact_operation_technique'] = $row->impact_operation_technique;
            $this->data['impact_strategic'] = $row->impact_strategic;
            $this->data['impact_environment'] = $row->impact_environment;
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
                $this->risk_impact_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_impact_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('master/risk_impact');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-impact-form');
    }

    function delete($id) {
		$riskimpact = $this->risk_impact_model->get_by_id($id);
		if ($riskimpact)
			$this->risk_impact_model->delete($id);
		/* if update status */
        /* $this->risk_impact_model->update($id, array('status' => 0)); */
        redirect('master/risk_impact');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/risk_impact/';
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
                $this->risk_impact_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>