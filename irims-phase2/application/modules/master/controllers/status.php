<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Status management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class Status extends Admin_Controller {

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
		'description' => array(
            'label' => 'description',
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
        $this->load->model('status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/status/index');
    }

    function index() {
		$this->data['rows'] = $this->status_model->get_list(site_url('master/status/index'));
		$this->template->build('status-list');
    }
	
	function view($id) {
        $this->load->model('auth/user_model');
        $this->load->model('master/unit_model');
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;

        $this->data['row'] = $this->status_model->get_by_id((int) $id);
        $this->template->build('status-view');
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
        $this->data['code'] = $this->status_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->status_model->get_by_id((int) $id);
			//option 1
            //$form['code']['value'] = $row->code;
            //$form['name']['value'] = $row->name;
            //$form['description']['value'] = $row->description;
            //$form['status']['value'] = $row->status;
            //$form['unit_id']['value'] = $row->unit_id;
            //$form['created_by']['value'] = $row->created_by;
            //$form['created_date']['value'] = $row->created_date;
            //$form['updated_by']['value'] = $row->updated_by;
            //$form['updated_date']['value'] = $row->updated_date;
			
			//option 2
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['description'] = $row->description;
            $this->data['status'] = $this->status_model->drop_options();
            $this->data['status_id'] = $row->status;
            $this->data['unit'] = $this->unit_model->drop_options();
            $this->data['unit_id'] = $row->unit_id;
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->status_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->status_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }

            redirect('master/status');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('status-form');
    }

    function delete($id) {
		$status = $this->status_model->get_by_id($id);
		if ($status)
			$this->status_model->delete($id);
		
        //$this->status_model->update($id, array('status' => 0));
        redirect('master/status');
    }
}

?>