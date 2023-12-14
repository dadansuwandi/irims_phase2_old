<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Key Risk Indicator Model
 * 
 * @package App
 * @category Model
 * @author Wildan Sawaludin
 */
class key_risk_indicator_model extends MY_Model {
	
	private $ci;
	protected $table = 'tx_key_risk_indicator';
    protected $risk_item_table = 'mst_risk_items';
	protected $status_table = 'mst_status';
	protected $unit_table = 'mst_units';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
        $this->id_field = 'KEY_RISK_INDICATOR_ID';
	}
	
	function create_code() {
        $query  = $this->db->query('SELECT MAX(LEFT(CODE,3)) AS CODE FROM '.$this->table.' 
					WHERE EXTRACT(MONTH FROM created_date) = '.date('m').' AND 
					EXTRACT(YEAR FROM created_date) = '.date('Y').' AND 
					'.$this->table. '.unit_id = '.$this->session->userdata('unit_id').' AND 
					'.$this->table. '.STATUS = 1');
        $row    = $query->row();
        if(!empty($row)) {
            $lastNo  = $row->CODE;
        } else {
            $lastNo  = 0;
        }
        
        $nextNo = $lastNo+1;

        $nextNo = substr('00'.$nextNo, -3) . '/KRI/' . date('m') . '/' . date('Y');
        return $nextNo;
    }
	
    function get_list_for_user($base_url = '', $offset = 0, $limit = 0) {
        return $this->db->order_by('KEY_RISK_INDICATOR_ID', 'desc')
            ->get_where($this->table, array(
				$this->table . '.auth_user_id' => $this->session->userdata('auth_user'), 
			))
            ->result();
    }

	function get_list($base_url = '', $offset = 0, $limit = 0) {
        return $this->db->order_by('KEY_RISK_INDICATOR_ID', 'desc')
            /* ->get_where($this->table, array(
				$this->table . '.STATUS' => 1, 
			)) */
            ->get($this->table)
            ->result();
    }
	
	function get_all() {
		$query = $this->db
				->get($this->table);
		$result = $query->result();
		return $result; 
	}
	
	function get_list_view($base_url = '', $offset = 0, $limit = 0) {
        // If base_url is empty, list all data.
        if (empty($base_url)) {
            return $this->db->get_where($this->table, array(
					$this->table . '.STATUS ' => 1, 
				))->result();
        } else {
            $this->load->library('pagination');

            // Set pagination limit
            if (empty($limit)) {
                if ($this->input->get('page_limit'))
                    $limit = (int) $this->input->get('page_limit');
                else
                    $limit = $this->config->item('rows_limit');
            }

            // Set pagination offset
            if (empty($offset)) {
                if ($this->pagination->page_query_string)
                    $offset = (int) $this->input->get($this->pagination->query_string_segment);
                else {
                    $offset = $this->uri->segment(4);
                    if ($this->pagination->use_page_numbers && ($offset > 0))
                        $offset = ($offset - 1) * $limit;
                }
            }

            // Set base_url, 
            if ($this->pagination->page_query_string) {
                $last_char = substr($base_url, -1, 1);
                if ($last_char == '/')
                    $base_url .= '?';
                elseif ($last_char != '?')
                    $base_url .= '/?';
            }

            // Get number of rows
            $this->db->where(array(
				$this->table . '.STATUS' => 1));
            $row_counts = $this->db->count_all_results($this->table);

            // Create pagination
            $config['base_url'] = $base_url;
            $config['total_rows'] = $row_counts;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            // Execute query
            $query = $this->db->where(array(
				$this->table . '.STATUS' => 1))->get($this->table, $limit, $offset);
            return $query->result();
        }
    }
	
	function get_by_id($id) {
		$query = $this->db->get_where($this->table, array($this->table . '.' . $this->id_field => $id));
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

	function get_by_code($code) {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.CODE' => $code, 
			$this->table . '.STATUS' => 1));
        $result = $query->row();
        return $result;
    }
	
	function get_search($param = NULL) {
		$query = $this->db->where(array(
			$this->table . '.unit_id' => $this->session->userdata('unit_id')))
			->like('LOWER('. $this->table.'.CODE)', strtolower($param), 'both', FALSE)
                                  ->or_like('LOWER('. $this->table.'.CODE)', strtolower($param), 'both', FALSE)
                                  ->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
	
	function drop_options() {
        $query = $this->db->select('id, CODE')
                ->order_by('CODE', 'ASC')
                ->get_where($this->table, array(
				$this->table . '.STATUS' => 1));
        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->CODE;
        }
        return $options;
    }
	
	function autocomplete() {
        $query = $this->db->select('id, CODE')
				->where(array($this->table . '.unit_id' => $this->session->userdata('unit_id'), $this->table . '.STATUS' => 1))
                ->like('upper(CODE)', strtoupper($_GET['term']))
                ->order_by('CODE', 'ASC')
                ->get($this->table);

        $result = $query->result();
		
		$arrData = array();
        foreach ($result as $row) {
            $arrData[] = array('id' => $row->id, 'value' => $row->CODE);
        }
        return $arrData;
    }
	
	function insert($data) {
        if (!isset($data['TAHUN'])) {
                $data['TAHUN'] = date('Y');
        }
		if (!isset($data['unit_id'])) {
            $data['unit_id'] = $this->session->userdata('unit_id');
        }
		/* if (!isset($data['STATUS'])) {
            $data['STATUS'] = 1;
        } */
        $data['CREATED_BY'] = $this->session->userdata('auth_user');
        $data['CREATED_DATE'] = mdate('%Y-%m-%d %h:%i:%s', now());
		
		return parent::insert($this->prep_data($data));
	}
	
	function update($id, $data) {
        if (!isset($data['TAHUN'])) {
                $data['TAHUN'] = date('Y');
        }
		if (!isset($data['unit_id'])) {
            $data['unit_id'] = $this->session->userdata('unit_id');
        }
		/* if (!isset($data['STATUS'])) {
            $data['STATUS'] = 1;
        } */
        $data['UPDATED_BY'] = $this->session->userdata('auth_user');
        $data['UPDATED_DATE'] = mdate('%Y-%m-%d %h:%i:%s', now());
		
		return parent::update($id, $this->prep_data($data));
	}

    function prep_data($data) {
        // Remove confirm-password field
        //unset($data['confirm-password']);
        
        // Hash password field if not empty
        //if (isset($data['password']))
        //{
        //  if (strlen(trim($data['password'])) > 0)
        //      $data['password'] = $this->ci->passwordhash->HashPassword($data['password']);
        //  else
        //      unset($data['password']);
        //}
        return $data;
    }

    function get_by_risk_item($id) {
        $this->db->select($this->risk_item_table . '.*, ' . $this->risk_item_table . '.name AS risk_item_name')
                ->join($this->risk_item_table, $this->risk_item_table . '.id = ' . $this->table . '.risk_item_id', 'left');
        return parent::get_by_id($id);
    }
	
	function get_by_status($id) {
		$this->db->select($this->status_table . '.*, ' . $this->status_table . '.name AS status_name')
				->join($this->status_table, $this->status_table . '.id = ' . $this->table . '.STATUS', 'left');
		return parent::get_by_id($id);
	}
	
	function get_by_unit($id) {
		$this->db->select($this->unit_table . '.*, ' . $this->unit_table . '.name AS unit_name')
				->join($this->unit_table, $this->unit_table . '.id = ' . $this->table . '.unit_id', 'left');
		return parent::get_by_id($id);
	}

    function get_indicator($params)
    {
        $query = $this->db->query($params);
        $result = $query->result();
        
        return $result;
    }

    function get_key_risk_indicator($params)
    {
        $query = $this->db->query($params);
        $result = $query->result();
        
        return $result;
    }

    function get_dashboard_kri($params)
    {
        $query = $this->db->query($params);
        $result = $query->result();
        
        return $result;
    }

    function get_kri($risk_item_id, $tahun = null)
    {
        $tahun 	   = date('Y');
        if(isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        } else {
            $tahun = date('Y');
        }
        
        $query = $this->db->query("SELECT * FROM `tx_key_risk_indicator` WHERE `tx_key_risk_indicator`.`RISK_ITEM_ID` = $risk_item_id AND `tx_key_risk_indicator`.`tahun` = $tahun  ORDER BY TOP_RISK_NUMBER ASC LIMIT 3");
        
        $result = $query->result();
        
        return $result;
    }


    function get_last_insert_id() {
        return $this->db->order_by('KEY_RISK_INDICATOR_ID', 'desc')
            ->get($this->table)
            ->row()->KEY_RISK_INDICATOR_ID;
	}
	
}

?>
