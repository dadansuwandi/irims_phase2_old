<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Unit management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class Unit extends Admin_Controller {

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
		'address' => array(
            'label' => 'Address',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'village' => array(
            'label' => 'Village',
            'rules' => 'trim|max_length[150]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'district' => array(
            'label' => 'District',
            'rules' => 'trim|max_length[150]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'city' => array(
            'label' => 'City',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'province' => array(
            'label' => 'Province',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'country' => array(
            'label' => 'Country',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'phone' => array(
            'label' => 'Phone',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'fax' => array(
            'label' => 'Fax',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'mobile_phone' => array(
            'label' => 'Mobile Phone',
            'rules' => 'trim|max_length[50]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'email' => array(
			'label' => 'Email',
			'rules' => 'trim|max_length[150]|valid_email|callback_unique_email|xss_clean',
			'helper' => 'form_emaillabel'
		),
		'description' => array(
            'label' => 'Description',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
        'is_kantor_pusat' => array(
            'label' => 'Ini Kantor Pusat?',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'lat' => array(
            'label' => 'Latitude',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'lon' => array(
            'label' => 'Longitude',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'showin_dashboard' => array(
            'label' => 'Show in dashboard?',
            'rules' => 'trim',
            'helper' => 'form_dropdownlabel',
            'extra' => ''
        ),
        'sorting' => array(
            'label' => 'Sorting',
            'rules' => 'trim',
            'helper' => 'form_inputlabel',
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
        $this->load->model('unit_model');
		$this->load->model('master/status_model');
        $this->load->model('master/target_pencapaian_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/unit/index');
    }

    function index() {
		$this->data['rows'] = $this->unit_model->get_list(site_url('master/unit/index'));
		$this->template->build('unit-list');
    }
	
	function view($id) {
        $this->load->model('auth/user_model');
        $this->load->model('master/unit_model');
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;

        $this->data['row'] = $this->unit_model->get_by_id((int) $id);

        $this->template->build('unit-view');
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
		
		//$form['id']['value'] = '';
        //$form['status']['options'] = $this->status_model->drop_options();
		
		$this->data['id'] = '';
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->unit_model->get_by_id((int) $id);
			//option 2
			$this->data['id'] = $row->id;
			$this->data['code'] = $row->code;
            $this->data['name'] = $row->name;
            $this->data['address'] = $row->address;
            $this->data['village'] = $row->village;
            $this->data['district'] = $row->district;
            $this->data['city'] = $row->city;
            $this->data['province'] = $row->province;
            $this->data['country'] = $row->country;
            $this->data['phone'] = $row->phone;
            $this->data['fax'] = $row->fax;
            $this->data['mobile_phone'] = $row->mobile_phone;
            $this->data['email'] = $row->email;
            $this->data['description'] = $row->description;
            $this->data['status'] = $this->status_model->drop_options();
            $this->data['status_id'] = $row->status;
            $this->data['unit'] = $this->unit_model->drop_options();
            $this->data['unit_id'] = $row->unit_id;
            $this->data['is_kantor_pusat'] = $row->is_kantor_pusat;
            $this->data['lat'] = $row->lat;
            $this->data['lon'] = $row->lon;
            $this->data['created_by'] = $row->created_by;
            $this->data['created_date'] = $row->created_date;
            $this->data['updated_by'] = $row->updated_by;
            $this->data['updated_date'] = $row->updated_date;
            $this->data['showin_dashboard'] = $row->showin_dashboard;
            $this->data['sorting'] = $row->sorting;
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->unit_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->unit_model->insert($this->form_validation->get_values());

                $unit_id = $this->db->insert_id();

                /*create default risk target*/
                $data = array(
                    'unit_id'   => $unit_id,
                    'target'    => 70,
                    'start_date'=> date('Y-m-d'),
                    'end_date'  => date('Y-m-d'),
                    'tahun'     => date('Y'),
                );

                /*insert target pencapaian for current year*/
                $this->target_pencapaian_model->insert($data);

				$this->template->set_flashdata('info', 'Data has been added');
            }

            redirect('master/unit');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('unit-form');
    }

    function delete($id) {
		$unit = $this->unit_model->get_by_id($id);
		if ($unit)
			$this->unit_model->delete($id);
		
        //$this->unit_model->update($id, array('status' => 0));
        redirect('master/unit');
    }
}

?>