<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Value management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class risk_value extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
        'risk_probability_id' => array(
            'label' => 'Risk Probability',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
       'risk_impact_id' => array(
            'label' => 'Risk Impact',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'risk_level_id' => array(
            'label' => 'Risk Level',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'rangking' => array(
            'label' => 'Rangking',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'description' => array(
            'label' => 'Description',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        )
    );

    function __construct() {
        parent::__construct();
        $this->load->model('risk_value_model');
		$this->load->model('auth/user_model');
        $this->load->model('master/risk_level_model');
        $this->load->model('master/risk_probability_model');
        $this->load->model('master/risk_impact_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_value/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_value_model->get_list(site_url('master/risk_value/index'));
		$this->template->build('risk-value-list');
    }
	
	function view($id) {
		$this->data['row'] = $this->risk_value_model->get_by_id((int) $id);
        $this->template->build('risk-value-view');
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
        $this->data['risk_probability'] = $this->risk_probability_model->drop_options();
        $this->data['risk_impact'] = $this->risk_impact_model->drop_options();
        $this->data['risk_level'] = $this->risk_level_model->drop_options();

        if ($id > 0) {
            $row = $this->risk_value_model->get_by_id((int) $id);
			
	        $this->data['id'] = $row->id;
            $this->data['risk_probability'] = $this->risk_probability_model->drop_options();
		    $this->data['risk_probability_id'] = $row->risk_probability_id;
            $this->data['risk_impact'] = $this->risk_impact_model->drop_options();
            $this->data['risk_impact_id'] = $row->risk_impact_id;
            $this->data['risk_level'] = $this->risk_level_model->drop_options();
            $this->data['risk_level_id'] = $row->risk_level_id;
            $this->data['rangking'] = $row->rangking;
            $this->data['description'] = $row->description;
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
			
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->risk_value_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_value_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
            redirect('master/risk_value');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-value-form');
    }

    function delete($id) {
		$riskvalue = $this->risk_value_model->get_by_id($id);
		if ($riskvalue)
			$this->risk_value_model->delete($id);
		/* if update status */
        /* $this->risk_value_model->update($id, array('status' => 0)); */
        redirect('master/risk_value');
    }
}

?>