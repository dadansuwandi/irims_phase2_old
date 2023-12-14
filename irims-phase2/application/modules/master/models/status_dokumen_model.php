<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Status Model
 * 
 * @package App
 * @category Model
 * @author Jaya Dianto
 */
class Status_dokumen_model extends MY_Model {
	
	private $ci;
	protected $table = 'ms_status_dokumen';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
        $this->id_field = 'STATUS_DOKUMEN_ID';
	}
	
	function get_list($base_url = '', $offset = 0, $limit = 0) {
        return $this->db->order_by('STATUS_DOKUMEN_ID', 'asc')->get($this->table)->result();
    }
	
	function get_all() {
		$query = $this->db->get($this->table);
		$result = $query->result();
		return $result; 
	}
	
	function get_list_view($base_url = '', $offset = 0, $limit = 0) {
        // If base_url is empty, list all data.
        if (empty($base_url)) {
            return $this->db->get($this->table);
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
            $this->db->get($this->table);
            
            $row_counts = $this->db->count_all_results($this->table);

            // Create pagination
            $config['base_url'] = $base_url;
            $config['total_rows'] = $row_counts;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            // Execute query
            $query = $this->db->get($this->table, $limit, $offset);
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
	
	function insert($data) {
		return parent::insert($this->prep_data($data));
	}
	
	function update($id, $data) {
		return parent::update($id, $this->prep_data($data));
	}
	
	function prep_data($data)
	{
		return $data;
	}
	
}

?>
