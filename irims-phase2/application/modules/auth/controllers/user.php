<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class User extends Admin_Controller 
{
	/**
	 * User form definition.
	 * 
	 * @var array
	 */
	protected $user_form = array(
		'first_name' => array(
			'label' => 'lang:first_name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'last_name' => array(
			'label'	=> 'lang:last_name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'id' => array(
			'helper' => 'form_hidden'
		),
		'username' => array(
			'label' => 'lang:username',
			'rules' => 'trim|required|max_length[255]|callback_unique_username|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'email' => array(
			'label' => 'lang:email',
			'rules' => 'trim|required|max_length[255]|valid_email|callback_unique_email|xss_clean',
			'helper' => 'form_emaillabel'
		),
		'password' => array(
			'label' => 'lang:password',
			'rules' => 'trim|required|matches[confirm-password]|callback_valid_password',
			'helper' => 'form_passwordlabel',
			'value' => ''
		),
		'confirm-password' => array(
			'label' => 'lang:confirm_password',
			'rules' => 'trim|required',
			'helper' => 'form_passwordlabel',
			'value' => ''
		),
		'role_id' => array(
			'label' => 'lang:Role',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel'
		),
		'unit_id' => array(
			'label' => 'Unit',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
            'extra' => ''
		),
		'lang' => array(
			'label'	=> 'lang:language',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel'
		),
	);
	
	/**
	 * Redirect to index if cancel-button clicked.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('master/risk_pic_model');
		
		if ($this->input->post('cancel-button'))
			redirect ('auth/user/index');
		
		$this->load->language('auth');
	}
	
	/**
	 * Display User list. 
	 */
	function index()
	{
		$this->data['users'] = $this->user_model->get_list(site_url('auth/user/index'));
		$this->template->build('user-list');
		//--------------
		/* load css and javascript
		set_css
		set_css_global
		set_css_admin
		set_js
		set_js_global
		set_js_admin */
		//--------------
	}
	
	/**
	 * Edit User
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->_updatedata($id);
	}
	
	/**
	 * Add a new User. 
	 */
	function add()
	{
		$this->_updatedata();
	}
	
	/**
	 * Update profile.
	 */
	function profile()
	{
		$this->data['redirect'] = 'auth/user/profile';
		$this->edit($this->auth->userid());
	}
	
	/**
	 * Update user data
	 * 
	 * @param int $id
	 */
	function _updatedata($id = 0)
	{
		$this->load->library('form_validation');
		$user_form = $this->user_form;
		
		// Update rules for update data
		if ($id > 0)
		{
			$user_form['username']['rules']	= "trim|required|max_length[255]|callback_unique_username[$id]|xss_clean";
			$user_form['email']['rules']	= "trim|required|max_length[255]|valid_email|callback_unique_email[$id]|xss_clean";
			$user_form['password']['rules']	= "trim|matches[confirm-password]|callback_valid_password";
			$user_form['confirm-password']['rules']	= "trim";
		}
		
		// Add language options
		$languages = $this->config->item('languages');
		foreach($languages as $code => $language)
			$user_form['lang']['options'][$code] = $language['name'];
		
		// Add role options
		$role_tree = $this->role_model->get_tree();
		$user_form['role_id']['options'] = array(0 => '(' . lang('none') . ')') + $this->generate_options($role_tree);
		
		// Add unit options
		$this->load->model('master/unit_model');
		$user_form['unit_id']['options'] = array(0 => '(' . lang('none') . ')') + $this->unit_model->drop_options();
		

		$this->form_validation->init($user_form);
		// Set default value for update data
		if ($id > 0)
			$user = $this->user_model->get_by_id($id);
            $this->data['user'] = $user;

            //$pic = $this->user_model->get_by_pic_id($id);
            //$this->data['pic_id'] = $pic;

			$this->form_validation->set_default($this->user_model->get_by_id($id));
			if ($this->form_validation->run())
			{
				if ($id > 0)
				{
					$this->user_model->update($id, $this->form_validation->get_values());
					//upload photo
					$this->do_upload_photo($id);
					$this->template->set_flashdata('info', lang('user_updated'));
				}
				else
				{
					$this->user_model->insert($this->form_validation->get_values());
					$insert_id = $this->db->insert_id();
					//upload photo
					$this->do_upload_photo($insert_id);
					$this->template->set_flashdata('info', lang('user_added'));
				}
				
				if (isset($this->data['redirect']))
					//redirect($this->data['redirect']);
					redirect('auth/user');
				else
					redirect('auth/user');
			}
		
		$this->data['form'] = $this->form_validation;
		$this->template->build('user-form');
	}
	
	/**
	 * Delete a User
	 * 
	 * @param integer $id 
	 */
	function delete($id)
	{
		$user = $this->user_model->get_by_id($id);
		if ($user)
			$this->user_model->delete($id);
		
		redirect('auth/user');
	}
	
	/**
	 * Validation callback function to check whether the username is unique
	 * 
	 * @param string $value Username to check
	 * @param int $id Don't check if the username has this ID
	 * @return boolean
	 */
	function unique_username($value, $id = 0)
	{
		if ($this->user_model->is_username_unique($value, $id))
			return TRUE;
		else
		{
			$this->form_validation->set_message('unique_username', lang('already_taken'));
			return FALSE;
		}
	}
	
	/**
	 * Validation callback function to check whether the email is unique
	 * 
	 * @param string $value Email to check
	 * @param int $id Don't check if the email has this ID
	 * @return boolean
	 */
	function unique_email($value, $id = 0)
	{
		if ($this->user_model->is_email_unique($value, $id))
			return TRUE;
		else
		{
			$this->form_validation->set_message('unique_email', lang('already_taken'));
			return FALSE;
		}
	}
	
	function do_upload_photo($id) {
        $config['upload_path'] = 'uploads/user/';
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
                $this->user_model->update($id, array('photo' => $img));
            }  else {
                
            }
        }
    }

	/**
	 * save cookie temporary
	 * 
	 */
	function save_cookie_temp()
	{	
		ini_set("allow_url_fopen", 1);

		// Remote image URL
		$url = getenv('API_HOST_DEV_AP2').'/mobile/Photo/index/'.$_POST['name'];
		// Image path
		$imgDownload = 'uploads/user/' . date('Ymd') . '-ldap-'.$_POST['name'].'.jpg';

		// Save image
		$remoteUrl = $this->curl->simple_get($url);
		$fp = fopen($imgDownload, 'wb');
		fwrite($fp, $remoteUrl);
		fclose($fp);
		

		// Save image with curl
		/* $ch = curl_init($url);
		$fp = fopen($imgDownload, 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp); */

		//insert to table
		$data['name'] = $_POST['name'];
		$data['description'] =  $_POST['description'];
		$data['created_by'] = $this->session->userdata('auth_user');
        $data['created_date'] = mdate('%Y-%m-%d %h:%i:%s', now());
        $data['updated_by'] = 0;
        $data['updated_date'] = '0000-00-00 00:00:00';	

		$query = $this->user_model->insert_temp_cookie($data);
		
		if($query == TRUE){
			echo json_encode("Data Inserted Successfully");
		} else {
			echo json_encode('Problem');
		}
	}

	function get_cookie_name(){
		$query = $this->user_model->get_cookie_name();
		$data['nip'] = $query;
		echo json_encode($data);
	}

	//Create strong password 
	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}
	//strong password end
	
}

/* End of file user.php */
/* Location: ./application/modules/auth/controllers/user.php */