<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 * 
 * @package App
 * @category Model
 * @author Wildan Sawaludin
 */
class Map_model extends MY_Model 
{
	protected $table = 'auth_users';
	protected $role_table = 'acl_roles';
	protected $pic_table = 'mst_risk_pics';
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
	}
	
	/**
	 * Insert data to User Model
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function insert($data)
	{
		
		$data['registered'] = date('Y-m-d H:i:s');
		if (!isset($data['unit_id'])) {
            $data['unit_id'] = $this->session->userdata('unit_id');
        }

        $data['expired'] = '2039-07-01 00:00:00';
        $data['created_by'] = $this->session->userdata('auth_user');
        $data['created_date'] = mdate('%Y-%m-%d %h:%i:%s', now());
        $data['updated_by'] = 0;
        $data['updated_date'] = '0000-00-00 00:00:00';
        $data['pic_id'] = $_POST['pic_id'];
		$data['LDAP'] = $_POST['ldap'];
		$data['photo'] = $_POST['photo'];
		
		return parent::insert($this->prep_data($data));
	}
	
	/**
	 * Update data to User Model
	 * 
	 * @param int $id
	 * @param array $data
	 * @return boolean
	 */
	public function update($id, $data)
	{
		die("aa");
		if (!isset($data['unit_id'])) {
            $data['unit_id'] = $this->session->userdata('unit_id');
        }
        $data['expired'] = '2039-07-01 00:00:00';
        $data['updated_by'] = $this->session->userdata('auth_user');
        $data['updated_date'] = mdate('%Y-%m-%d %h:%i:%s', now());
        $data['pic_id'] = $_POST['pic_id'];
		$data['LDAP'] = $_POST['ldap'];
		$data['photo'] = $_POST['photo'];
		
		return parent::update($id, $this->prep_data($data));
	}
	
	/**
	 * Prepare input data
	 * 
	 * @param array $data
	 * @return array
	 */
	private function prep_data($data)
	{
		die("aa");
		// Remove confirm-password field
		unset($data['confirm-password']);
		
		// Hash password field if not empty
		if (isset($data['password']))
		{
			if (strlen(trim($data['password'])) > 0)
				$data['password'] = $this->ci->passwordhash->HashPassword($data['password']);
			else
				unset($data['password']);
		}
		return $data;
	}
    
    /**
     * Compare user input password to stored hash
     * 
	 * @param string $userpass
     * @param string $password
	 * @return boolean
     */
    public function check_password($password, $userpass)
	{
        // check password
        return $this->ci->passwordhash->CheckPassword($password, $userpass);
    }
	
	/**
	 * Get user by id
	 * 
	 * @param int $id
	 * @return array|boolean
	 */
	function get_by_id($id)
	{
		$this->db->select($this->table . '.*, ' . $this->role_table . '.name AS role_name')
				->join($this->role_table, $this->role_table . '.id = ' . $this->table . '.role_id', 'left');
		return parent::get_by_id($id);
	}
	
	/**
	 * Get user by username
	 * 
	 * @param string $username
	 * @return object user
	 */
	function get_by_username($username)
	{
		$this->db->select($this->table . '.*, ' . $this->role_table . '.name AS role_name')
				->join($this->role_table, $this->role_table . '.id = ' . $this->table . '.role_id', 'left');
		$query = $this->db->get_where($this->table, array($this->table . '.username' => $username));
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}
	
	/**
	 * Check if username is available
	 * 
	 * @param string $username
	 * @param int $id
	 * @return boolean
	 */
	function is_username_unique($username, $id = 0)
	{
		$this->db->where('username', $username);
		if ($id > 0)
			$this->db->where($this->id_field . ' <>', $id);
		$query = $this->db->get($this->table);
		return ($query->num_rows() == 0);
	}
	
	/**
	 * Check if email is available
	 * 
	 * @param string $email
	 * @param int $id
	 * @return boolean
	 */
	function is_email_unique($email, $id = 0)
	{
		$this->db->where('email', $email);
		if ($id > 0)
			$this->db->where($this->id_field . ' <>', $id);
		$query = $this->db->get($this->table);
		return ($query->num_rows() == 0);
	}

	function get_by_pic_id($id) {
		$this->db->select($this->pic_table . '.*, ' . $this->pic_table . '.name AS pic_name')
				->join($this->pic_table, $this->pic_table . '.id = ' . $this->table . '.pic_id', 'left');
		return parent::get_by_id($id);
	}

	function drop_options($role_id) {
        $query = $this->db->select('id, first_name, last_name')
                ->order_by('id', 'ASC')
                ->get_where(
                	$this->table, array(
						$this->table . '.status'  => 1,
						$this->table . '.role_id' => $role_id
					)
                );
        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->first_name." ".$item->last_name;
        }
        return $options;
    }

    function drop_options_extend($roles_id) {
        $query = $this->db->select('id, first_name, last_name')
                ->order_by('id', 'ASC')
                ->where($this->table . '.status', 1)
                ->where_in($this->table . '.role_id', $roles_id)
                ->get($this->table);

        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->first_name." ".$item->last_name;
        }
        return $options;
    }

	function drop_options_kri($role_id) {
        $query = $this->db->select('id, first_name, last_name, username')
                ->order_by('id', 'ASC')
                ->get_where(
                	$this->table, array(
						$this->table . '.status'  => 1,
						$this->table . '.role_id' => $role_id
					)
                );
        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->first_name." ".$item->last_name." (".$item->username.")";
        }
        return $options;
    }

	function get_by_pic($pic_id) {
		$query = $this->db->get_where($this->table, array($this->table . '.' . 'pic_id' => $pic_id));
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

	function insert_temp_cookie($data)
	{
		if($this->db->insert('temp_cookies', $data)) {
			return TRUE;
		} else {
			return FALSE;	
		}
	}

	function get_cookie_name(){
		$this->db->select('name');
		$this->db->from('temp_cookies');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);

		return $this->db->get()->row()->name;
	}
}