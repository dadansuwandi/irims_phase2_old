<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Mitigation Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */

    class risk_mitigation_model extends MY_Model {
    	
    	private $ci;
    	protected $table = 'tx_risk_mitigation';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'RISK_MITIGATION_ID';
    	}

        function get_data($riskIdentificationId)
        {

            $query = $this->db->get_where($this->table, array(
                $this->table . '.RISK_IDENTIFICATION_ID' => $riskIdentificationId,
            ));

            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
        }

        function delete_update($riskIdentificationId, $riskMitigasiDatas)
        {
            /*delete all data before update*/
            $riskMitigations = $this->get_data($riskIdentificationId);
            if($riskMitigations){
                foreach ($riskMitigations as $riskMitigation) {
                    parent::delete($riskMitigation->RISK_MITIGATION_ID);
                }
            }

            /*try insert new data*/
            if($riskMitigasiDatas){
                for($i=1;$i<=count($riskMitigasiDatas['RENCANA_PENGENDALIAN'])-1;$i++){
                    if($riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i]!=""){
                        $dataMitigasi = array(
                            'RISK_IDENTIFICATION_ID' => $riskIdentificationId,
                            'RENCANA_PENGENDALIAN' => $riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i],
                            'DAMPAK_RENCANA_PENGENDALIAN' => $riskMitigasiDatas['DAMPAK_RENCANA_PENGENDALIAN'][$i],
                            'PIC_UNIT_KERJA_ID' => $riskMitigasiDatas['PIC_UNIT_KERJA_ID'][$i],
                            'MULAI_WAKTU' => $riskMitigasiDatas['MULAI_WAKTU'][$i],
                            'TARGET_WAKTU' => $riskMitigasiDatas['TARGET_WAKTU'][$i],
                            'MITIGATION_COSTS' => $riskMitigasiDatas['MITIGATION_COSTS'][$i],
                        );
                        parent::insert($dataMitigasi);
                    }
                }
            }
        }

        function delete_update_evaluation($riskIdentificationId, $riskMitigasiDatas)
        {
            /*delete all data before update*/
            $riskMitigations = $this->get_data($riskIdentificationId);
            if($riskMitigations){
                foreach ($riskMitigations as $riskMitigation) {
                    parent::delete($riskMitigation->RISK_MITIGATION_ID);
                }
            }

            /*try insert new data*/
            if($riskMitigasiDatas){
                for($i=1;$i<=count($riskMitigasiDatas['RENCANA_PENGENDALIAN'])-1;$i++){
                    if($riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i]!=""){
                        $dataMitigasi = array(
                            'RISK_IDENTIFICATION_ID' => $riskIdentificationId,
                            'RENCANA_PENGENDALIAN' => $riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i],
                            'DAMPAK_RENCANA_PENGENDALIAN' => $riskMitigasiDatas['DAMPAK_RENCANA_PENGENDALIAN'][$i],
                            'PIC_UNIT_KERJA_ID' => $riskMitigasiDatas['PIC_UNIT_KERJA_ID'][$i],
                            'PIC_KANTOR_PUSAT_ID' => $riskMitigasiDatas['PIC_KANTOR_PUSAT_ID'][$i],
                            'MULAI_WAKTU' => $riskMitigasiDatas['MULAI_WAKTU'][$i],
                            'TARGET_WAKTU' => $riskMitigasiDatas['TARGET_WAKTU'][$i],
                            'MITIGATION_COSTS' => $riskMitigasiDatas['MITIGATION_COSTS'][$i],
                            'REALISASI_MITIGASI' => $riskMitigasiDatas['REALISASI_MITIGASI'][$i],
                            'EXECUTION_TIME' => $riskMitigasiDatas['EXECUTION_TIME'][$i],
                            'YEAR' => $riskMitigasiDatas['YEAR'][$i],
                            'MONTH' => $riskMitigasiDatas['MONTH'][$i],
                            'DAY' => $riskMitigasiDatas['DAY'][$i],
                        );
                        parent::insert($dataMitigasi);
                    }
                }
            }
        }

        function delete_update_backdate($riskIdentificationId, $riskMitigasiDatas)
        {
            /*delete all data before update*/
            $riskMitigations = $this->get_data($riskIdentificationId);
            if($riskMitigations){
                foreach ($riskMitigations as $riskMitigation) {
                    parent::delete($riskMitigation->RISK_MITIGATION_ID);
                }
            }

            /*try insert new data*/
            if($riskMitigasiDatas){
                for($i=1;$i<=count($riskMitigasiDatas['RENCANA_PENGENDALIAN'])-1;$i++){
                    if($riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i]!=""){
                        $dataMitigasi = array(
                            'RISK_IDENTIFICATION_ID' => $riskIdentificationId,
                            'RENCANA_PENGENDALIAN'   => $riskMitigasiDatas['RENCANA_PENGENDALIAN'][$i],
                            'DAMPAK_RENCANA_PENGENDALIAN'   => $riskMitigasiDatas['DAMPAK_RENCANA_PENGENDALIAN'][$i],
                            'PIC_UNIT_KERJA_ID'      => $riskMitigasiDatas['PIC_UNIT_KERJA_ID'][$i],
                            'PIC_KANTOR_PUSAT_ID'    => $riskMitigasiDatas['PIC_KANTOR_PUSAT_ID'][$i],
                            'MULAI_WAKTU'            => $riskMitigasiDatas['MULAI_WAKTU'][$i],
                            'TARGET_WAKTU'           => $riskMitigasiDatas['TARGET_WAKTU'][$i],
                            'MITIGATION_COSTS'       => $riskMitigasiDatas['MITIGATION_COSTS'][$i],
                            'REALISASI_MITIGASI'     => $riskMitigasiDatas['REALISASI_MITIGASI'][$i],
                        );
                        parent::insert($dataMitigasi);
                    }
                }
            }
        }

        function update($risk_mitigation_id, $data) {   
            $result = parent::update($risk_mitigation_id, $data);

            if($result){
               return $risk_mitigation_id;
            }else{
                return $result;
            }
        }

         // function get_list_id($riskIdentificationId, $isKp)
        // {
        //     $data = $this->get_data_pic($riskIdentificationId, $isKp);
            
        //     if($data){
        //         $result = array();

        //         foreach ($data as $d) {
        //             array_push($result, $d->PIC_ID);    
        //         }

        //         return $result;
        //     }else{
        //         return false;
        //     }
        // }	
    }
?>
