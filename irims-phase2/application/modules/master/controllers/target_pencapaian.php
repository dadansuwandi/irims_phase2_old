<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Target Pencapaian Controller
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class target_pencapaian extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
        'unit_id' => array(
            'label' => 'Unit',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'target' => array(
            'label' => 'Target',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'tahun' => array(
            'label' => 'Tahun',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'start_date' => array(
            'label' => 'Implementation date start',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'end_date' => array(
            'label' => 'Implementation date end',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->model('master/target_pencapaian_model');
        $this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/target_pencapaian/index');
    }

    function index() {
        $tahun   = date('Y');

        if($this->input->post('tahun')){
            $tahun = $this->input->post('tahun');
        }

        $this->data['rows'] = $this->target_pencapaian_model->get_all($tahun);
        $this->data['tahun']  = $tahun;

		$this->template->build('target-pencapaian-list');
    }
	
    function edit($id) {
        $this->_updatedata($id);
    }

    function _updatedata($id = 0) {
        $this->load->library('form_validation');
        $form = $this->form;
		
		$this->data['id'] = '';

        if ($id > 0) {
            $row = $this->target_pencapaian_model->get_by_id((int) $id);
			
	        $this->data['id']         = $row->id;
            $this->data['unit']       = $this->unit_model->get_by_id($row->unit_id)->name;
            $this->data['unit_id']    = $row->unit_id;
            $this->data['target']     = $row->target;
            $this->data['start_date'] = $row->start_date;
            $this->data['end_date'] = $row->end_date;
            $this->data['tahun']      = $row->tahun;
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->target_pencapaian_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->target_pencapaian_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
            redirect('master/target_pencapaian');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('target-pencapaian-form');
    }
}

?>