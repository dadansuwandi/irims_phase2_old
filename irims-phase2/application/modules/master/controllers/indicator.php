<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indicator management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class indicator extends Admin_Controller {

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
        /*'name_alias' => array(
            'label' => 'Alias',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'description' => array(
            'label' => 'Description',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),*/
        'risk_item_id' => array(
            'label' => 'Risk Item',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
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
        $this->load->model('indicator_model');
		$this->load->model('auth/user_model');
        $this->load->model('master/risk_item_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/indicator/index');
    }

    function index() {
		$this->data['rows'] = $this->indicator_model->get_list(site_url('master/indicator/index'));
		$this->template->build('indicator-list');
    }
	
	function view($id) {
        $riskItem = $this->risk_item_model->get_by_id($this->session->userdata('risk_item_id'));
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['risk_item'] = $riskItem;
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;

		
        $this->data['risk_item'] = $this->indicator_model->get_by_risk_item($riskItem->risk_item_id);
		$this->data['status'] = $this->indicator_model->get_by_status($user->status);
		$this->data['unit'] = $this->indicator_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->indicator_model->get_by_id((int) $id);
        $this->template->build('indicator-view');
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
        $this->data['code'] = $this->indicator_model->create_code();
        $this->data['risk_item'] = $this->risk_item_model->drop_options();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->indicator_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['name_alias'] = $row->name_alias;
            $this->data['description'] = $row->description;
            $this->data['risk_item'] = $this->risk_item_model->drop_options();
            $this->data['risk_item_id'] = $row->risk_item_id;
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
                $this->indicator_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->indicator_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('master/indicator');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('indicator-form');
    }

    function delete($id) {
		$indicator = $this->indicator_model->get_by_id($id);
		if ($indicator)
			$this->indicator_model->delete($id);
		/* if update status */
        /* $this->indicator_model->update($id, array('status' => 0)); */
        redirect('master/indicator');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/indicator/';
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
                $this->indicator_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>