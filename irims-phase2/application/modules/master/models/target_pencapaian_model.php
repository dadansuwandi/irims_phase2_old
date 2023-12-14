<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Target Pencapaian Model
 * 
 * @package App
 * @category Model
 * @author Jaya Dianto
 */
class target_pencapaian_model extends MY_Model {
	
	private $ci;
	protected $table = 'ms_target_pencapaian';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
	}
	
    function get_target($unit_id, $tahun){

        $query = $this->db
            ->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->get($this->table);
        
        $result = $query->row();
        return $result->target;
    }

    function get_by_unit_id($unit_id, $tahun){

        $query = $this->db
            ->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->get($this->table);
        
        $result = $query->row();
        return $result;
    }

    function get_all($tahun){
        $query = $this->db->where('tahun', $tahun)->order_by('unit_id', 'ASC')->get($this->table);
        $result = $query->result();
        return $result; 
    }

    function update($id, $data) {        
        return parent::update($id, $data);
    }
}

?>
