<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Impact Indicator management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class risk_impact_indicator extends Admin_Controller {

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
            'label' => 'Description',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),'mst_risk_impact_category_id' => array(
            'label' => 'Risk Impact Category',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),'indicator_A' => array(
            'label' => 'Insignificant (A)',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),'indicator_B' => array(
            'label' => 'Minor (B)',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),'indicator_C' => array(
            'label' => 'Moderate (C)',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),'indicator_D' => array(
            'label' => 'Major (D)',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),'indicator_E' => array(
            'label' => 'Catasrophic (E)',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),/*,
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
        $this->load->model('risk_impact_indicator_model');
        $this->load->model('risk_impact_category_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/risk_impact_indicator/index');
    }

    function index() {
		$this->data['rows'] = $this->risk_impact_indicator_model->get_list(site_url('master/risk_impact_indicator/index'));
		$this->template->build('risk-impact-indicator-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
        
		$this->data['status'] = $this->risk_impact_indicator_model->get_by_status($user->status);
		$this->data['unit'] = $this->risk_impact_indicator_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->risk_impact_indicator_model->get_by_id((int) $id);
        $row = $this->data['row'];
        $this->data['risk_impact_category']            = $this->risk_impact_indicator_model->get_by_risk_impact_category($row->mst_risk_impact_category_id);
        $this->template->build('risk-impact-indicator-view');
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
        $this->data['code'] = $this->risk_impact_indicator_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();
        $this->data['mst_risk_impact_category'] = $this->risk_impact_category_model->drop_options();

        if ($id > 0) {
            $row = $this->risk_impact_indicator_model->get_by_id((int) $id);
			
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['description'] = $row->description;
			$this->data['status'] = $this->status_model->drop_options();
            $this->data['status_id'] = $row->status;
            $this->data['unit'] = $this->unit_model->drop_options();
            $this->data['unit_id'] = $row->unit_id;
            $this->data['mst_risk_impact_category'] = $this->risk_impact_category_model->drop_options();
            $this->data['mst_risk_impact_category_id'] = $row->mst_risk_impact_category_id;
            $this->data['indicator_A'] = $row->indicator_A;
            $this->data['indicator_B'] = $row->indicator_B;
            $this->data['indicator_C'] = $row->indicator_C;
            $this->data['indicator_D'] = $row->indicator_D;
            $this->data['indicator_E'] = $row->indicator_E;
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
			
			$this->form_validation->set_default($row);
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->risk_impact_indicator_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->risk_impact_indicator_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('master/risk_impact_indicator');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('risk-impact-indicator-form');
    }

    function delete($id) {
		$riskImpactIndicator = $this->risk_impact_indicator_model->get_by_id($id);
		if ($riskImpactIndicator)
			$this->risk_impact_indicator_model->delete($id);
		/* if update status */
        /* $this->risk_impact_indicator_model->update($id, array('status' => 0)); */
        redirect('master/risk_impact_indicator');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/risk_impact_indicator/';
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
                $this->risk_impact_indicator_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>