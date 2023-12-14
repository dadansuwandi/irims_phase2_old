<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Value Model
 * 
 * @package App
 * @category Model
 * @author Wildan Sawaludin
 */
class risk_value_model extends MY_Model {
	
	private $ci;
	protected $table = 'mst_risk_values';
    protected $risk_level_table = 'mst_risk_levels';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
	}
	
	function get_list() {
        return $this->db->order_by('rangking', 'asc')->get($this->table)->result();
    }

    function insert($data) {
        $data['created_by'] = $this->session->userdata('auth_user');
        $data['created_date'] = mdate('%Y-%m-%d %h:%i:%s', now());
        
        return parent::insert($this->prep_data($data));
    }
    
    function update($id, $data) {
        $data['updated_by'] = $this->session->userdata('auth_user');
        $data['updated_date'] = mdate('%Y-%m-%d %h:%i:%s', now());
        
        return parent::update($id, $this->prep_data($data));
    }
	
	function get_all() {
		$query = $this->db
				->where('unit_id', $this->session->userdata('unit_id'))
				->get($this->table);
		$result = $query->result();
		return $result; 
	}
	
	function get_list_view($base_url = '', $offset = 0, $limit = 0) {
        // If base_url is empty, list all data.
        if (empty($base_url)) {
            return $this->db->get_where($this->table, array(
					$this->table . '.status ' => 1, 
					$this->table . '.unit_id' => $this->session->userdata('unit_id')))->result();
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
				$this->table . '.status' => 1, 
				$this->table . '.unit_id' => $this->session->userdata('unit_id')));
            $row_counts = $this->db->count_all_results($this->table);

            // Create pagination
            $config['base_url'] = $base_url;
            $config['total_rows'] = $row_counts;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            // Execute query
            $query = $this->db->where(array(
				$this->table . '.status' => 1, 
				$this->table . '.unit_id' => $this->session->userdata('unit_id')))->get($this->table, $limit, $offset);
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

    function get_by_name($name) {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.name'=> $name, 
			$this->table . '.status' => 1, 
			$this->table . '.unit_id' => $this->session->userdata('unit_id')));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }
	
	function get_by_code($code) {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.code' => $code, 
			$this->table . '.status' => 1, 
			$this->table . '.unit_id' => $this->session->userdata('unit_id')));
        $result = $query->row();
        return $result;
    }
    
    function get_all_root() {
        $query = $this->db->select('id, code, name')
                ->order_by('name', 'ASC')
                ->get_where($this->table, array(
				'length(code)' => 3, 
				$this->table . '.unit_id' => $this->session->userdata('unit_id')));
        $result = $query->result();
        return $result;
    }
    
    function get_all_by_parent($parentCode) {
        $query = $this->db->select('id, name')
                ->order_by('name', 'ASC')
                ->get_where($this->table, array(
				'length(code)' => (strlen($parentCode)+3), 
				'LIKE"%'.$parentCode.'%"' => null, 
				$this->table . '.unit_id' => $this->session->userdata('unit_id')));
        $result = $query->result();
        return $result;
    }
	
	function get_default() {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.is_default' => 1, 
			$this->table . '.unit_id' => $this->session->userdata('unit_id')));
        $resutl = $query->result();

        return $resutl;
    }
	
	function get_search($param = NULL) {
		$query = $this->db->where(array(
			$this->table . '.unit_id' => $this->session->userdata('unit_id')))
			->like('LOWER('. $this->table.'.name)', strtolower($param), 'both', FALSE)
                                  ->or_like('LOWER('. $this->table.'.name)', strtolower($param), 'both', FALSE)
                                  ->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
	
	function drop_options() {
        $query = $this->db->select('id, name')
                ->order_by('name', 'ASC')
                ->get_where($this->table, array(
				$this->table . '.unit_id' => $this->session->userdata('unit_id'), 
				$this->table . '.status' => 1));
        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->name;
        }
        return $options;
    }
	
	function drop_options_root() {
        $query = $this->db->select('id, name')
                ->where($this->table . '.unit_id', $this->session->userdata('unit_id'))
                ->where('length(code) = 3')
                ->order_by('name', 'ASC')
                ->get($this->table);
        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->name;
        }
        return $options;
    }
	
	function autocomplete() {
        $query = $this->db->select('id, name')
				->where(array($this->table . '.unit_id' => $this->session->userdata('unit_id'), $this->table . '.status' => 1))
                ->like('upper(name)', strtoupper($_GET['term']))
                ->order_by('name', 'ASC')
                ->get($this->table);

        $result = $query->result();
		
		$arrData = array();
        foreach ($result as $row) {
            $arrData[] = array('id' => $row->id, 'value' => $row->name);
        }
        return $arrData;
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

    function get_by_risk_level($id) {
        $this->db->select($this->risk_level_table . '.*, ' . $this->risk_level_table . '.name AS risk_category_name')
                ->join($this->risk_level_table, $this->risk_level_table . '.id = ' . $this->table . '.risk_level_id', 'left');
        return parent::get_by_id($id);
    }
	
	function get_by_status($id) {
		$this->db->select($this->status_table . '.*, ' . $this->status_table . '.name AS status_name')
				->join($this->status_table, $this->status_table . '.id = ' . $this->table . '.status', 'left');
		return parent::get_by_id($id);
	}
	
	function get_by_unit($id) {
		$this->db->select($this->unit_table . '.*, ' . $this->unit_table . '.name AS unit_name')
				->join($this->unit_table, $this->unit_table . '.id = ' . $this->table . '.unit_id', 'left');
		return parent::get_by_id($id);
	}

    function get_risk_level_name($levels) {
        $query = $this->db->select($this->table.'.id as level_id, 
                                mst_risk_probabilities.rating_value as risk_probabilities, mst_risk_probabilities.id as risk_probabilities_id, 
                                mst_risk_impacts.alphabet as risk_impacts, mst_risk_impacts.id as risk_impacts_id, 
                                mst_risk_levels.name as risk_levels')
                            ->where($levels, false, false)
                            ->join('mst_risk_probabilities','mst_risk_probabilities.id = '.$this->table.'.risk_probability_id')
                            ->join('mst_risk_impacts','mst_risk_impacts.id = '.$this->table.'.risk_impact_id')
                            ->join('mst_risk_levels','mst_risk_levels.id = '.$this->table.'.risk_level_id')
                            ->order_by($this->table.'.id','asc')
                            ->get($this->table);
        $result = $query->result();
        return $result;
    }
	
    function get_rangking($probability_id, $impact_id){
        $query = $this->db->get_where(
            $this->table, array(
                $this->table . '.risk_probability_id'=> $probability_id, 
                $this->table . '.risk_impact_id' => $impact_id, 
            )
        );
        
        if ($query->num_rows() > 0){
            $result = $query->result();
            return $result[0]->rangking;
        }else{
            return 1000;
        }
    }

    function get_risk_level($probability_id, $impact_id){
        $query = $this->db->get_where(
            $this->table, array(
                $this->table . '.risk_probability_id'=> $probability_id, 
                $this->table . '.risk_impact_id' => $impact_id, 
            )
        );
        
        if ($query->num_rows() > 0){
            $result = $query->result();
            return $result[0]->risk_level_id;
        }else{
            return 1000;
        }
    }
}

?>
