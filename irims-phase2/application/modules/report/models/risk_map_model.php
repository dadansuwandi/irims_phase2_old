<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Map Model
     * 
     * @package App
     * @category Model
     * @author Wildan Sawaludin
     */
    class risk_map_model extends MY_Model {
    	
    	private $ci;
    	protected $table       = 'tx_risk_maps';
    	protected $user_table  = 'auth_users';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'TX_RISK_MAP_ID';
    	}

        function get_by_id($id) {
            $query = $this->db
                    ->where('TX_RISK_MAP_ID', $id)
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }

        function check_trend($risk_item_id, $rangking, $tahun){
            $tahun = $tahun-1;

            $query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mrv.rangking as rangking")
            ->from('tx_risk_identification as tri')
            ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
            ->where('tri.STATUS_DOKUMEN_ID = 6 AND tri.TAHUN = '.$tahun.' AND tri.RISK_ITEM_ID = '.$risk_item_id)
            ->order_by('rangking','asc')
            ->get();

            if($query->num_rows() > 0){
                $res = $query->result();

                if($rangking > $res[0]->rangking){
                    return "up-arrow.png";    
                }else if($rangking < $res[0]->rangking){
                    return "down-arrow.png";
                }else{
                    return "minus.png";
                }
            }else{
                return "up-arrow.png";  
            }
        }

        function check_trend_bumn($risk_item_id, $rangking, $tahun){
            $tahun = $tahun-1;

            $query = $this->db->select("tri.RISK_ITEM_ID as risk_item_id, mrv.rangking as rangking")
            ->from('tx_risk_identification as tri')
            ->join('mst_risk_values as mrv', 'mrv.risk_probability_id = tri.MITIGASI_RISK_K_ID AND mrv.risk_impact_id = tri.MITIGASI_RISK_D_ID', 'left')
            ->where('tri.STATUS_DOKUMEN_ID = 6 AND tri.TIPE_KERTAS_KERJA = "'.TIPE_KERTAS_KERJA_BUMN.'" AND tri.TAHUN = '.$tahun.' AND tri.RISK_ITEM_ID = '.$risk_item_id)
            ->order_by('rangking','asc')
            ->get();

            if($query->num_rows() > 0){
                $res = $query->result();

                if($rangking > $res[0]->rangking){
                    return "up-arrow.png";    
                }else if($rangking < $res[0]->rangking){
                    return "down-arrow.png";
                }else{
                    return "minus.png";
                }
            }else{
                return "up-arrow.png";  
            }
        }
    }
?>
