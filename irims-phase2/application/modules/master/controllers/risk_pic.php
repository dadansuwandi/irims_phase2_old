<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk PIC management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class risk_pic extends Admin_Controller {

    protected $form = array(
		'id' => array(
            'helper' => 'form_hidden'
        ),
		/*'code' => array(
            'label' => 'Code',
            'rules' => 'trim|required|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),*/
		'name' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'unit_id' => array(
            'label' => 'Unit',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'parent_pic_id' => array(
            'label' => 'Parent PIC',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
		'objective' => array(
            'label' => 'Objective',
            'rules' => 'trim',
            'helper' => 'form_inputlabel'
        ),
		'year' => array(
            'label' => 'Year',
            'rules' => 'trim',
            'helper' => 'form_inputlabel'
        ),
		'date' => array(
            'label' => 'Date',
            'rules' => 'trim',
            'helper' => 'form_inputlabel'
        ),
        'kpi' => array(
            'label' => 'KPI',
            'rules' => 'trim',
            'helper' => 'form_inputlabel'
        ),
        'work_program' => array(
            'label' => 'Work Program',
            'rules' => 'trim',
            'helper' => 'form_inputlabel'
        )
    );

    function __construct() {
        parent::__construct();
        $this->load->model('risk_pic_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_pic/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_pic_model->get_list(site_url('master/risk_pic/index'));
		$this->template->build('risk-pic-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
		
		$this->data['row'] = $this->risk_pic_model->get_by_id((int) $id);
        $this->data['parent_pic'] = $this->risk_pic_model->get_by_id($this->data['row']->parent_pic_id);

        $this->template->build('risk-pic-view');
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
        $this->data['code'] = $this->risk_pic_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
        $this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->risk_pic_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['objective'] = $row->objective;
			$this->data['status'] = $this->status_model->drop_options();
            $this->data['status_id'] = $row->status;
            $this->data['unit'] = $this->unit_model->drop_options();
            $this->data['unit_id'] = $row->unit_id;
            $this->data['parent_pic_id'] = $row->parent_pic_id;
          /*  $this->data['is_risk_owner'] = $row->is_risk_owner;
            $this->data['is_risk_viewer'] = $row->is_risk_viewer;*/
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
            $this->data['year'] = $row->year;
            $this->data['date'] = $row->date;
            $this->data['kpi'] = $row->kpi;
            $this->data['work_program'] = $row->work_program;
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->risk_pic_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_pic_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
            redirect('master/risk_pic');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-pic-form');
    }

    function delete($id) {
		$riskpic = $this->risk_pic_model->get_by_id($id);
		if ($riskpic)
			$this->risk_pic_model->delete($id);
		/* if update status */
        /* $this->risk_pic_model->update($id, array('status' => 0)); */
        redirect('master/risk_pic');
    }
}

?>