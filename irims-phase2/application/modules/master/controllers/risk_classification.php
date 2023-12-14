<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Classification Controller
 * 
 * @package App
 * @category Controller
 * @author Jaya Dianto
 */
class risk_classification extends Admin_Controller {

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
        'color' => array(
            'label' => 'Color',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->model('risk_classification_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_classification/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_classification_model->get_list();
		$this->template->build('risk-classification-list');
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

        if ($id > 0) {
            $row = $this->risk_classification_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['color'] = $row->color;
			
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->risk_classification_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_classification_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }

            redirect('master/risk_classification');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-classification-form');
    }

    function delete($id) {
		$risk = $this->risk_classification_model->get_by_id($id);
		if ($risk)
			$this->risk_classification_model->delete($id);

        redirect('master/risk_classification');
    }
}

?>