<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Login extends MY_Controller 
{
	function index()
	{
		// user is already logged in
        if ($this->auth->loggedin()) 
		{
			if ($this->session->userdata('role_id') == GROUP_RISK_HEADQUARTERS || $this->session->userdata('role_id') == GROUP_RISK_OWNER || $this->session->userdata('role_id') == GROUP_RISK_LEADERS) {
				redirect('welcome/index_corporate');
			} else {
            	redirect('welcome/index_corporate_worksheet');
			}
        }
		
		$this->load->language('auth');
		
		//var date expired user
		$exp = '';
		
        // form submitted
        if ($this->input->post('username') && $this->input->post('password')) 
		{
            $remember = $this->input->post('remember') ? TRUE : FALSE;
            
            // get user from database
			$user = $this->user_model->get_by_username($this->input->post('username'));

			// --------------------------------------------------------------------------------- //
			// get from API AP2
			// BEGIN LDAP Flagging
			if ($user->LDAP == '1') {
				$apiHost    = getenv('API_HOST_DEV_AP2').'/mobile/ldap/is_valid/';
				$postData   = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$json = $this->curl->simple_post($apiHost, $postData);
				$data = json_decode($json);

				//var_dump($data); die;

				//if ($user && ($data->status == "ok" && $data->username == $this->input->post('username')))
				if ($data && ($this->input->post('username') == $data->username))
				{
					
					$now = date('Y-m-d H:i:s');
					if(!empty($user->expired)){
						$exp = $user->expired;
					}
					if($now > $exp){
						$this->template->add_message ('Error', 'Masa aktif akun anda telah habis.');
					}else{
						// mark user as logged in
						$this->auth->login($user->id, $remember);
						
						// Add session data
						$this->session->set_userdata(array(
							'user_id'	=> $user->id,
							'lang'		=> $user->lang,
							'unit_id'	=> $user->unit_id,
							'role_id'	=> $user->role_id,
							'role_name'	=> $user->role_name,
							'registered'=> $user->registered,
							'expired'	=> $user->expired,
							'pic_id'	=> $user->pic_id,
							//'objective'	=> $pic->objective
						));
						
						redirect($this->config->item('dashboard_uri'));
					}
				}
				else {
					// $this->template->add_message ('error', lang('login_attempt_failed'));
					redirect($this->config->item('dashboard_uri'));
				}

			} else if ($user->LDAP == '0') {
			// END LDAP Flagging
			// --------------------------------------------------------------------------------- //

				//if ($user && $this->user_model->check_password($this->input->post('password'), $user->password))
				if ($user)
				{
					
					$now = date('Y-m-d H:i:s');
					if(!empty($user->expired)){
						$exp = $user->expired;
					}
					if($now > $exp){
						$this->template->add_message ('Error', 'Masa aktif akun anda telah habis.');
					}else{
						// mark user as logged in
						$this->auth->login($user->id, $remember);
						
						// Add session data
						$this->session->set_userdata(array(
							'user_id'	=> $user->id,
							'lang'		=> $user->lang,
							'unit_id'	=> $user->unit_id,
							'role_id'	=> $user->role_id,
							'role_name'	=> $user->role_name,
							'registered'=> $user->registered,
							'expired'	=> $user->expired,
							'pic_id'	=> $user->pic_id,
							//'objective'	=> $pic->objective
						));
						
						redirect($this->config->item('dashboard_uri'));
					}
				}
				else {
					// $this->template->add_message ('error', lang('login_attempt_failed'));
					redirect($this->config->item('dashboard_uri'));
				}

			}
        }
		
		if ($this->input->post('username'))
			$this->data['username'] = $this->input->post('username');
		if ($this->input->post('remember'))
			$this->data['remember'] = $this->input->post('remember');
        
        // show login form
        $this->load->helper('form');
		//$this->template->set_layout('no-footer')->build('login');
		$this->template
			->set_css_admin('pages/css/login')
			->set_js_global('plugins/jquery-validation/js/jquery.validate.min')
			->set_js_admin('pages/scripts/login')
			->build('login');
	}
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */