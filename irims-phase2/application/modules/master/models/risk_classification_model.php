<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Risk Classification Model
 * 
 * @package App
 * @category Model
 * @author Jaya Dianto
 */
class risk_classification_model extends MY_Model {
	
	private $ci;
	protected $table = 'ms_risk_classification';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
	}
	
	function get_list() {
        return $this->db->order_by('name', 'asc')->get($this->table)->result();
    }

    function insert($data) {  
        return parent::insert($data);
    }
    
    function update($id, $data) { 
        return parent::update($id, $data);
    }

    function get_by_id($id) {
        $query = $this->db->get_where($this->table, array($this->table . '.' . $this->id_field => $id));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }

    function drop_options() {
        $query = $this->db->select('id, name')
                ->order_by('name', 'ASC')
                ->get($this->table);

        $result = $query->result();
        $options[''] = '';
        foreach ($result as $item) {
            $options[$item->id] = $item->name;
        }
        return $options;
    }

    function get_all() {
        $query = $this->db
                ->get($this->table);
        $result = $query->result();
        return $result; 
    }	
}

?>
