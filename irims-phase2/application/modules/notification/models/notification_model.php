<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Notification Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */
    class notification_model extends MY_Model {
    	
    	private $ci;
    	protected $table       = 'tx_notification';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
    	}
    	
        function insert($data) {
            $result = parent::insert($data);

            if($result){
               return $this->db->insert_id();
            }else{
                return $result;
            }
        }

        function update($id, $data) {            
            return parent::update($id, $data);
        }

        function get_data($role_id, $pic_id=false) {
            if($pic_id){
                $query = $this->db
                    ->where('role_id', $role_id)
                    ->where('pic_id', $pic_id)
                    ->where('status', "UNREAD")
                    ->order_by('created_date','desc')
                    ->get($this->table);
                
                $result = $query->result();
            }else{
                $query = $this->db
                    ->where('role_id', $role_id)
                    ->where('status', "UNREAD")
                    ->order_by('created_date','desc')
                    ->get($this->table);
                
                $result = $query->result();
            }

            return $result;
        }

        function get_by_id($id) {
            $query = $this->db->get_where($this->table, array($this->table . '.id' => $id));
            if ($query->num_rows() > 0)
                return $query->row();
            else
                return FALSE;
        }
    }
?>
