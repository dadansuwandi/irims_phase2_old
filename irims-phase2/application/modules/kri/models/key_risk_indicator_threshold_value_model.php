<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * key_risk_indicator_threshold_value Model
     * 
     * @package App
     * @category Model
     * @author Jaya Dianto
     */

    class key_risk_indicator_threshold_value_model extends MY_Model {
    	
    	private $ci;
    	protected $table = 'tx_key_risk_indicator_threshold_value';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'id';
    	}

        function get_data($keyRiskIndicatorId)
        {

            $query = $this->db->order_by('id', 'desc')
            ->get_where($this->table, array(
                $this->table . '.key_risk_indicator_id' => $keyRiskIndicatorId,
            ));

            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
        }

        function get_data_report($keyRiskIndicatorId, $tahun = null)
        {
            $tahun 	   = date('Y');
            if(isset($_GET['tahun'])){
                $tahun = $_GET['tahun'];
            } else {
                $tahun = date('Y');
            }

            $query = $this->db->query("SELECT 
                SUM(IF(month = '1', threshold_value, 0)) AS 'January',
                SUM(IF(month = '2', threshold_value, 0)) AS 'February',
                SUM(IF(month = '3', threshold_value, 0)) AS 'March',
                SUM(IF(month = '4', threshold_value, 0)) AS 'April',
                SUM(IF(month = '5', threshold_value, 0)) AS 'May',
                SUM(IF(month = '6', threshold_value, 0)) AS 'June',
                SUM(IF(month = '7', threshold_value, 0)) AS 'July',
                SUM(IF(month = '8', threshold_value, 0)) AS 'August',
                SUM(IF(month = '9', threshold_value, 0)) AS 'September',
                SUM(IF(month = '10', threshold_value, 0)) AS 'October',
                SUM(IF(month = '11', threshold_value, 0)) AS 'November',
                SUM(IF(month = '12', threshold_value, 0)) AS 'December'
                FROM (
                    SELECT year(`tx_key_risk_indicator_threshold_value`.`input_date`) as year, 
                        month(`tx_key_risk_indicator_threshold_value`.`input_date`) as month, 
                        avg(`tx_key_risk_indicator_threshold_value`.`threshold_value`) as threshold_value 
                    FROM 
                        `tx_key_risk_indicator_threshold_value` 
                    WHERE 
                        `tx_key_risk_indicator_threshold_value`.`key_risk_indicator_id` = $keyRiskIndicatorId AND year(`tx_key_risk_indicator_threshold_value`.`input_date`) = $tahun 
                    GROUP BY 
                        year(`tx_key_risk_indicator_threshold_value`.`input_date`), month(`tx_key_risk_indicator_threshold_value`.`input_date`)
                    ORDER BY
                        month(`tx_key_risk_indicator_threshold_value`.`input_date`) ASC
                        
                    ) as monthly_report");

            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
        }

        function get_data_dashboard($keyRiskIndicatorId, $tahun = null)
        {
            $tahun 	   = date('Y');
            if(isset($_GET['tahun'])){
                $tahun = $_GET['tahun'];
            } else {
                $tahun = date('Y');
            }

            $query = $this->db->query("SELECT 
                SUM(IF(month = '1', threshold_value, 0)) AS 'January',
                SUM(IF(month = '2', threshold_value, 0)) AS 'February',
                SUM(IF(month = '3', threshold_value, 0)) AS 'March',
                SUM(IF(month = '4', threshold_value, 0)) AS 'April',
                SUM(IF(month = '5', threshold_value, 0)) AS 'May',
                SUM(IF(month = '6', threshold_value, 0)) AS 'June',
                SUM(IF(month = '7', threshold_value, 0)) AS 'July',
                SUM(IF(month = '8', threshold_value, 0)) AS 'August',
                SUM(IF(month = '9', threshold_value, 0)) AS 'September',
                SUM(IF(month = '10', threshold_value, 0)) AS 'October',
                SUM(IF(month = '11', threshold_value, 0)) AS 'November',
                SUM(IF(month = '12', threshold_value, 0)) AS 'December'
                FROM (
                    SELECT year(`tx_key_risk_indicator_threshold_value`.`input_date`) as year, 
                        month(`tx_key_risk_indicator_threshold_value`.`input_date`) as month, 
                        avg(`tx_key_risk_indicator_threshold_value`.`threshold_value`) as threshold_value 
                    FROM 
                        `tx_key_risk_indicator_threshold_value` 
                    WHERE 
                        `tx_key_risk_indicator_threshold_value`.`key_risk_indicator_id` = $keyRiskIndicatorId AND year(`tx_key_risk_indicator_threshold_value`.`input_date`) = $tahun 
                    GROUP BY 
                        year(`tx_key_risk_indicator_threshold_value`.`input_date`), month(`tx_key_risk_indicator_threshold_value`.`input_date`)
                    ORDER BY
                        month(`tx_key_risk_indicator_threshold_value`.`input_date`) ASC
                        
                    ) as monthly_report");

            if ($query->num_rows() > 0)
                return $query->result();
            else
                return FALSE;
        }

        function insert($keyRiskIndicatorId, $thresholdValue, $inputDate)
        {
            /*insert new data*/
            if($thresholdValue){
                $data = array(
                    'key_risk_indicator_id' => $keyRiskIndicatorId,
                    'threshold_value' => $thresholdValue,
                    'input_date' => $inputDate,
                    'created_by' => $this->session->userdata('auth_user'),
                    'created_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                );
                parent::insert($data);
            }
        }

        function update($id, $thresholdValue, $inputDate) {   
            /*update data*/
            if($thresholdValue){
                $data = array(
                    'threshold_value' => $thresholdValue,
                    'input_date' => $inputDate,
                    'updated_by' => $this->session->userdata('auth_user'),
                    'updated_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                );
                parent::update($id, $data);
            }
        }	

        function get_by_id($id) {
            $query = $this->db->get_where($this->table, array($this->table . '.' . $this->id_field => $id));
            if ($query->num_rows() > 0)
                return $query->row();
            else
                return FALSE;
        }
    }
?>
