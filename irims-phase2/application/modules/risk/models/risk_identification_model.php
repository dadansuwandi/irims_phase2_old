<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Identification Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */
    class risk_identification_model extends MY_Model {
    	
    	private $ci;
    	protected $table                = 'tx_risk_identification';
    	protected $status_dokumen_table = 'ms_status_dokumen';
    	protected $unit_table           = 'mst_units';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'RISK_IDENTIFICATION_ID';
    	}
    	
        /*to get list data risk by owner*/
    	function get_list_owner($status){
            $query = $this->db
                    ->where('TAHUN', date('Y'))
                    ->where('USER_PIC_ID', $this->session->userdata('pic_id'))
                    ->where('UNIT_ID', $this->session->userdata('unit_id'))
                    ->where_in('STATUS_DOKUMEN_ID',$status)
                    ->order_by('INSTERTED_TIME', 'DESC')
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }

        /*to get list data risk by gm*/
        function get_list_gm($status){
            $query = $this->db
                    ->where('TAHUN', date('Y'))
                    //->where('USER_PIC_ID', $this->session->userdata('pic_id'))
                    ->where('UNIT_ID', $this->session->userdata('unit_id'))
                    ->where_in('STATUS_DOKUMEN_ID',$status)
                    ->get($this->table);
            // echo $this->db->last_query();
            $result = $query->result();
            return $result;
        }

        /*to get list data risk by owner*/
        function get_list_admin($status){
            $query = $this->db
                    ->where('TAHUN', date('Y'))
                    ->where_in('STATUS_DOKUMEN_ID',$status)
                    ->order_by('INSTERTED_TIME', 'DESC')
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }

        /*to get list data risk by owner*/
        function get_list_admin_bumn($status){
            $query = $this->db
                    ->where('TAHUN', date('Y'))
                    ->where_in('STATUS_DOKUMEN_ID',$status)
                    ->where_in('TIPE_KERTAS_KERJA',TIPE_KERTAS_KERJA_BUMN)
                    ->order_by('INSTERTED_TIME', 'DESC')
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }
    	
        /*to count risk data in dashboard*/
        function count_by_status($status, $risk_admin=false){
            if($risk_admin){
                $query = $this->db
                        ->where('TAHUN', date('Y'))
                        ->where_in('STATUS_DOKUMEN_ID',$status)
                        ->get($this->table);
                $result = $query->num_rows();
                // echo $this->db->last_query();exit;
            }else{
                $query = $this->db
                        ->where('TAHUN', date('Y'))
                        ->where('USER_PIC_ID', $this->session->userdata('pic_id'))
                        ->where('UNIT_ID', $this->session->userdata('unit_id'))
                        ->where_in('STATUS_DOKUMEN_ID',$status)
                        ->get($this->table);
                $result = $query->num_rows();
            }
            
            return $result;
        }

        /*to count risk data in dashboard*/
        function count_by_status_bumn($status, $risk_admin=false){
            if($risk_admin){
                $query = $this->db
                        ->where('TIPE_KERTAS_KERJA', TIPE_KERTAS_KERJA_BUMN)
                        ->where('TAHUN', date('Y'))
                        ->where_in('STATUS_DOKUMEN_ID',$status)
                        ->get($this->table);
                $result = $query->num_rows();
            }else{
                $query = $this->db
                        ->where('TIPE_KERTAS_KERJA', TIPE_KERTAS_KERJA_BUMN)
                        ->where('TAHUN', date('Y'))
                        ->where('USER_PIC_ID', $this->session->userdata('pic_id'))
                        ->where('UNIT_ID', $this->session->userdata('unit_id'))
                        ->where_in('STATUS_DOKUMEN_ID',$status)
                        ->get($this->table);
                $result = $query->num_rows();
            }
            
            return $result;
        }

    	
    	function get_by_id($id) {
    		$query = $this->db->get_where($this->table, array($this->table . '.' . $this->id_field => $id));
    		if ($query->num_rows() > 0)
    			return $query->row();
    		else
    			return FALSE;
    	}
    	
    	function insert($data) {
    		if (!isset($data['UNIT_ID'])) {
                $data['UNIT_ID'] = $this->session->userdata('unit_id');
            }
    		if (!isset($data['TAHUN'])) {
                $data['TAHUN'] = date('Y');
            }
            if (!isset($data['STATUS_DOKUMEN_ID'])) {
                $data['STATUS_DOKUMEN_ID'] = 1;
            }

            $data['INSERTED_BY']    = $this->session->userdata('auth_user');
            $data['INSTERTED_TIME'] = date('Y-m-d H:i:s');
    		
            $result = parent::insert($data);

            if($result){
               return $this->db->insert_id();
            }else{
                return $result;
            }
    	}
    	
    	function update($risk_identification_id, $data) {
            $data['UPDATED_BY']     = $this->session->userdata('auth_user');
            $data['UPDATED_TIME']   = date('Y-m-d H:i:s');
    		
            $result = parent::update($risk_identification_id, $data);

            if($result){
               return $risk_identification_id;
            }else{
                return $result;
            }
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

        function risk_map_monitoring_report($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        mst_risk_probabilities.rating_value as risk_k, mst_risk_probabilities.id as risk_k_id, 
                                        mst_risk_impacts.alphabet as risk_d, mst_risk_impacts.id as risk_d_id, '.$this->table.'.HAZARD as event, mst_units.name as branch, '.$this->table.'.PENYEBAB as penyebab, '.$this->table.'.DAMPAK as dampak, '.$this->table.'.PENGENDALIAN_YANG_TELAH_DILAKUKAN as sudah_pengendalian, tx_risk_mitigation.RENCANA_PENGENDALIAN as rencana_mitigasi, mst_risk_pics.name as pic, tx_risk_mitigation.TARGET_WAKTU as target_waktu')
                                ->where($this->table . '.STATUS_DOKUMEN_ID IN(3,4,5)') //STATUS_DOKUMEN_NAMA == ON MONITORING OR ON MITIGATED
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities','mst_risk_probabilities.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts','mst_risk_impacts.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('mst_units','mst_units.id = '.$this->table.'.UNIT_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                ->join('mst_risk_pics','mst_risk_pics.id = tx_risk_mitigation.PIC_UNIT_KERJA_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function risk_map_mitigated_report($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        k_monitoring.rating_value as risk_k_monitoring, k_monitoring.id as risk_k_monitoring_id, 
                                        d_monitoring.alphabet as risk_d_monitoring, d_monitoring.id as risk_d_monitoring_id, 
                                        k_mitigated.rating_value as risk_k_mitigated, k_mitigated.id as risk_k_mitigated_id, 
                                        d_mitigated.alphabet as risk_d_mitigated, d_mitigated.id as risk_d_mitigated_id, '.$this->table.'.HAZARD as event, mst_units.name as branch, '.$this->table.'.PENYEBAB as penyebab, '.$this->table.'.DAMPAK as dampak, '.$this->table.'.PENGENDALIAN_YANG_TELAH_DILAKUKAN as sudah_pengendalian, tx_risk_mitigation.RENCANA_PENGENDALIAN as rencana_mitigasi, mst_risk_pics.name as pic, tx_risk_mitigation.TARGET_WAKTU as target_waktu')
                                ->where($this->table . '.STATUS_DOKUMEN_ID IN(4,5,6)') //STATUS_DOKUMEN_NAMA == MITIGATED
                                ->where($this->table . '.TERMITIGASI =1')
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities as k_monitoring','k_monitoring.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts as d_monitoring','d_monitoring.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('mst_risk_probabilities as k_mitigated','k_mitigated.id = '.$this->table.'.MITIGASI_RISK_K_ID')
                                ->join('mst_risk_impacts as d_mitigated','d_mitigated.id = '.$this->table.'.MITIGASI_RISK_D_ID')
                                ->join('mst_units','mst_units.id = '.$this->table.'.UNIT_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                ->join('mst_risk_pics','mst_risk_pics.id = tx_risk_mitigation.PIC_UNIT_KERJA_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function risk_report_map_mitigated_report($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        k_monitoring.rating_value as risk_k_monitoring, k_monitoring.id as risk_k_monitoring_id, 
                                        d_monitoring.alphabet as risk_d_monitoring, d_monitoring.id as risk_d_monitoring_id, 
                                        k_mitigated.rating_value as risk_k_mitigated, k_mitigated.id as risk_k_mitigated_id, 
                                        d_mitigated.alphabet as risk_d_mitigated, d_mitigated.id as risk_d_mitigated_id, '.$this->table.'.HAZARD as event, mst_units.name as branch, '.$this->table.'.PENYEBAB as penyebab, '.$this->table.'.DAMPAK as dampak, '.$this->table.'.PENGENDALIAN_YANG_TELAH_DILAKUKAN as sudah_pengendalian, tx_risk_mitigation.RENCANA_PENGENDALIAN as rencana_mitigasi, mst_risk_pics.name as pic, tx_risk_mitigation.TARGET_WAKTU as target_waktu')
                                ->where($this->table . '.STATUS_DOKUMEN_ID IN(4,5,6)') //STATUS_DOKUMEN_NAMA == MITIGATED
                                ->where($this->table . '.TERMITIGASI =1')
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities as k_monitoring','k_monitoring.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts as d_monitoring','d_monitoring.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('mst_risk_probabilities as k_mitigated','k_mitigated.id = '.$this->table.'.MITIGASI_RISK_K_ID')
                                ->join('mst_risk_impacts as d_mitigated','d_mitigated.id = '.$this->table.'.MITIGASI_RISK_D_ID')
                                ->join('mst_units','mst_units.id = '.$this->table.'.UNIT_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                ->join('mst_risk_pics','mst_risk_pics.id = tx_risk_mitigation.PIC_UNIT_KERJA_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function risk_map_identification_report($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        k_monitoring.rating_value as risk_k_monitoring, k_monitoring.id as risk_k_monitoring_id, 
                                        d_monitoring.alphabet as risk_d_monitoring, d_monitoring.id as risk_d_monitoring_id, 
                                        k_mitigated.rating_value as risk_k_mitigated, k_mitigated.id as risk_k_mitigated_id, 
                                        d_mitigated.alphabet as risk_d_mitigated, d_mitigated.id as risk_d_mitigated_id, '.$this->table.'.HAZARD as event, mst_units.name as branch, '.$this->table.'.PENYEBAB as penyebab, '.$this->table.'.DAMPAK as dampak, '.$this->table.'.PENGENDALIAN_YANG_TELAH_DILAKUKAN as sudah_pengendalian, tx_risk_mitigation.RENCANA_PENGENDALIAN as rencana_mitigasi, mst_risk_pics.name as pic, tx_risk_mitigation.TARGET_WAKTU as target_waktu')
                                ->where(array($this->table . '.TERIDENTIFIKASI' => 1)) //TERIDENTIFIKASI == 1
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities as k_monitoring','k_monitoring.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts as d_monitoring','d_monitoring.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('mst_risk_probabilities as k_mitigated','k_mitigated.id = '.$this->table.'.MITIGASI_RISK_K_ID')
                                ->join('mst_risk_impacts as d_mitigated','d_mitigated.id = '.$this->table.'.MITIGASI_RISK_D_ID')
                                ->join('mst_units','mst_units.id = '.$this->table.'.UNIT_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                ->join('mst_risk_pics','mst_risk_pics.id = tx_risk_mitigation.PIC_UNIT_KERJA_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function risk_map_monitoring_report_head($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        mst_risk_probabilities.rating_value as risk_k, mst_risk_probabilities.id as risk_k_id, 
                                        mst_risk_impacts.alphabet as risk_d, mst_risk_impacts.id as risk_d_id, '.$this->table.'.HAZARD as event')
                                ->where($this->table . '.STATUS_DOKUMEN_ID IN(4,5)') //STATUS_DOKUMEN_NAMA == ON MONITORING OR ON MITIGATED
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities','mst_risk_probabilities.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts','mst_risk_impacts.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function risk_map_mitigated_report_head($params) {
            $query = $this->db->select($this->table.'.RISK_IDENTIFICATION_ID as risk_identification_id, mst_risk_items.id as risk_item_id, mst_risk_items.name as risk_name, 
                                        k_monitoring.rating_value as risk_k_monitoring, k_monitoring.id as risk_k_monitoring_id, 
                                        d_monitoring.alphabet as risk_d_monitoring, d_monitoring.id as risk_d_monitoring_id, 
                                        k_mitigated.rating_value as risk_k_mitigated, k_mitigated.id as risk_k_mitigated_id, 
                                        d_mitigated.alphabet as risk_d_mitigated, d_mitigated.id as risk_d_mitigated_id, '.$this->table.'.HAZARD as event')
                                ->where(array($this->table . '.STATUS_DOKUMEN_ID' => 6)) //STATUS_DOKUMEN_NAMA == MITIGATED
                                ->where($params, false, false)
                                ->join('mst_risk_items','mst_risk_items.id = '.$this->table.'.RISK_ITEM_ID')
                                ->join('mst_risk_probabilities as k_monitoring','k_monitoring.id = '.$this->table.'.RESIDUAL_RISK_K_ID')
                                ->join('mst_risk_impacts as d_monitoring','d_monitoring.id = '.$this->table.'.RESIDUAL_RISK_D_ID')
                                ->join('mst_risk_probabilities as k_mitigated','k_mitigated.id = '.$this->table.'.MITIGASI_RISK_K_ID')
                                ->join('mst_risk_impacts as d_mitigated','d_mitigated.id = '.$this->table.'.MITIGASI_RISK_D_ID')
                                ->join('tx_risk_mitigation','tx_risk_mitigation.RISK_IDENTIFICATION_ID = '.$this->table.'.RISK_IDENTIFICATION_ID')
                                //->group_by($this->table.'.HAZARD')
                                ->order_by($this->table.'.RISK_IDENTIFICATION_ID','asc')
                                ->get($this->table);
            $result = $query->result();
            return $result;
        }

        function create_code($unit_id=false, $year=false) {
            if($unit_id!=false AND $year!=false){
                $query  = $this->db->query(
                    'SELECT MAX(RIGHT(CODE,4)) AS CODE FROM '.$this->table.' 
                    WHERE TAHUN = '.$year.' AND '.$this->table. '.UNIT_ID = '.$unit_id
                );
            }else{
                $query  = $this->db->query(
                    'SELECT MAX(RIGHT(CODE,4)) AS CODE FROM '.$this->table.' 
                    WHERE TAHUN = '.date('Y').' AND '.$this->table. '.UNIT_ID = '.$this->session->userdata('unit_id')
                );
            }

            $row    = $query->row();
            if(!empty($row)) {
                $lastNo  = $row->CODE;
            } else {
                $lastNo  = 0;
            }

            $nextNo = $lastNo+1;
            $nextNo = 'RISK/'.$unit_id.'/'.$year.'/'.str_pad($nextNo, 4, '0', STR_PAD_LEFT);
            
            return $nextNo;
        }

        function get_risk_assessment_report($params)
        {
            $query = $this->db->query($params);
            $result = $query->result();
            
            return $result;
        }

        function get_work_paper_report($params)
        {
            $query = $this->db->query($params);
            $result = $query->result();
            
            return $result;
        }

        function get_list_from_PMAO(/* $base_url = '', $offset = 0, $limit = 0 */) {
            // sumber: https://github.com/philsturgeon/codeigniter-curl

            $dataApiBranch = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/branch/nugroho.prasetyo');
            $dataApiUnit = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/unit/nugroho.prasetyo/CGK');
            $dataApi = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/project/nugroho.prasetyo/2021/298');
            $dataPerUnit = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/project/admin.irims/'.date("Y").'/298');

            $dataApiByUnit = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/projectByUnit/admin.irims/132');
            $dataApiByBranch = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/projectByBranch/admin.irims/PST');

            $unitCode = $this->unit_model->get_unit_code($this->session->userdata('unit_id'));
            // $data = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/projectByYearAndBranch/admin.irims/'.date("Y").'/'.$unitCode.'');
            $data = $this->curl->simple_get(getenv('API_HOST_DEV_PMAO_AP2') . '/api/Rest/projectByBranch/admin.irims/'.$unitCode.'');
								
			return json_decode($data, TRUE);
        }
    }
?>
