<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Identification Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */
    class log_model extends MY_Model {
    	
    	private $ci;
    	protected $table       = 'logs';
    	protected $user_table  = 'auth_users';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'logs_id';
    	}
    	
        function insert($data) {
            $result = parent::insert($data);

            if($result){
               return $this->db->insert_id();
            }else{
                return $result;
            }
        }

        function get_by_risk_identification_id($risk_identification_id){
            $query = $this->db
                    ->where('risk_identification_id', $risk_identification_id)
                    ->order_by('created_date','desc')
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }

        function delete_by_risk_identification_id($risk_identification_id){
            $this->db->where('risk_identification_id', $risk_identification_id);
            $this->db->delete($this->table);
        }
    }
?>
