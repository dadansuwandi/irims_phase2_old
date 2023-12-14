<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Setting management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class Setting extends Admin_Controller {

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
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'district' => array(
            'label' => 'District',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'city' => array(
            'label' => 'City',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'province' => array(
            'label' => 'Province',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'country' => array(
            'label' => 'Country',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'phone' => array(
            'label' => 'Phone',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'fax' => array(
            'label' => 'Fax',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'mobile_phone' => array(
            'label' => 'Mobile Phone',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'email' => array(
            'label' => 'Email',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'website' => array(
            'label' => 'Website',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'owner' => array(
            'label' => 'Owner',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
		'photo' => array(
            'label' => 'Photo',
            'rules' => 'trim|max_length[250]|xss_clean',
            'helper' => 'form_uploadlabel'
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
        $this->load->model('setting_model');
		$this->load->model('auth/user_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
		
        if ($this->input->post('cancel-button'))
            redirect('master/setting/index');
    }

    function index() {
		$this->data['rows'] = $this->setting_model->get_list(site_url('master/setting/index'));
		$this->template->build('setting-list');
    }
	
	function view($id) {
        $user = $this->user_model->get_by_id($this->session->userdata('auth_user'));
        $unit = $this->unit_model->get_by_id($this->session->userdata('unit_id'));
        $this->data['user'] = $user;
        $this->data['unit'] = $unit;
		
		$this->data['status'] = $this->setting_model->get_by_status($user->status);
		$this->data['unit'] = $this->setting_model->get_by_unit($user->unit_id);
		
		$this->data['row'] = $this->setting_model->get_by_id((int) $id);
        $this->template->build('setting-view');
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
        $this->data['code'] = $this->setting_model->create_code();
		$this->data['status'] = $this->status_model->drop_options();
		$this->data['unit'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->setting_model->get_by_id((int) $id);
			
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
            $this->data['website'] = $row->website;
            $this->data['owner'] = $row->owner;
            $this->data['photo'] = $row->photo;
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
                $this->setting_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->setting_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }
			
			/* upload photo */
			$this->do_upload_photo($id);

            redirect('master/setting');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('setting-form');
    }

    function delete($id) {
		$setting = $this->setting_model->get_by_id($id);
		if ($setting)
			$this->setting_model->delete($id);
		/* if update status */
        /* $this->setting_model->update($id, array('status' => 0)); */
        redirect('master/setting');
    }
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/setting/';
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
                $this->setting_model->update($id, array('photo' => $img));
            }  else {
                print_r($error);
            }
        }
    }
}

?>