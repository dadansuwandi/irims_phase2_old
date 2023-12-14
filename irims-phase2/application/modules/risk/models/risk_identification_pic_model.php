<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Identification PIC Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */

    class risk_identification_pic_model extends MY_Model {
    	
    	private $ci;
    	protected $table = 'tx_risk_identification_pic';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'RISK_IDENTIFICATION_PIC_ID';
    	}

        function get_data_pic($riskIdentificationId, $isKp)
        {
            $query = $this->db->get_where($this->table, array(
                $this->table . '.RISK_IDENTIFICATION_ID' => $riskIdentificationId,
                $this->table . '.IS_KP' => $isKp,

            ));
            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
        }

        function get_list_id($riskIdentificationId, $isKp)
        {
            $data = $this->get_data_pic($riskIdentificationId, $isKp);
            
            if($data){
                $result = array();

                foreach ($data as $d) {
                    array_push($result, $d->PIC_ID);    
                }

                return $result;
            }else{
                return false;
            }
        }

        function delete_update($riskIdentificationId, $pics, $isKp=0)
        {
            /*delete all data before update*/
            $riskIdentificationPics = $this->get_data_pic($riskIdentificationId, $isKp);
            if($riskIdentificationPics){
                foreach ($riskIdentificationPics as $riskIdentificationPic) {
                    parent::delete($riskIdentificationPic->RISK_IDENTIFICATION_PIC_ID);
                }
            }

            /*try insert new data*/
            if($pics){
                 foreach($pics as $pic){
                    $dataPic = array(
                        'RISK_IDENTIFICATION_ID' => $riskIdentificationId,
                        'PIC_ID' => $pic,
                        'IS_KP' => $isKp
                    );
                    parent::insert($dataPic);
                }
            }
        }	
    }
?>
