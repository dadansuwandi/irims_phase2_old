<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Key Risk Indicator management controller.
 * 
 * @package App
 * @category Controller
 * @author Wildan Sawaludin
 */
class key_risk_indicator_threshold_value extends Admin_Controller {

    protected $form = array(
		
    );

    function __construct() {
        parent::__construct();
        $this->load->model('key_risk_indicator_model');
        $this->load->model('key_risk_indicator_threshold_value_model');
        $this->load->model('key_risk_indicator_threshold_model');
		$this->load->model('auth/user_model');
        $this->load->model('master/risk_item_model');
        $this->load->model('master/indicator_model');
		$this->load->model('master/status_model');
		$this->load->model('master/unit_model');
        $this->load->model('master/risk_kpi_model');
		
        if ($this->input->post('cancel-button'))
            redirect('kri/key_risk_indicator/index');
    }

    function measure_value($id){
        $this->_updatedata($id);
    }

    function _updatedata($id = 0) {
		$this->data['KEY_RISK_INDICATOR_ID'] = $id;
        $this->data['CODE'] = $this->key_risk_indicator_model->create_code();
        $this->data['auth_users'] = $this->user_model->drop_options_kri(GROUP_RISK_OWNER);
        $this->data['risk_kpi'] = $this->risk_kpi_model->drop_options();
        $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
        $this->data['INDICATOR'] = $this->indicator_model->drop_options();
        $this->data['INDICATOR_THRESHOLD'] = $this->key_risk_indicator_threshold_model->drop_options();

        $this->data['LEADING_LAGGING_VALUE'] = array(LEADING => "Leading", LAGGING => "Lagging");

		$this->data['STATUS'] = $this->status_model->drop_options();
		$this->data['UNIT'] = $this->unit_model->drop_options();

        if ($id > 0) {
            $row = $this->key_risk_indicator_model->get_by_id((int) $id);
			
			$this->data['KEY_RISK_INDICATOR_ID'] = $row->KEY_RISK_INDICATOR_ID;
			$this->data['CODE'] = $row->CODE;

            $this->data['auth_users'] = $this->user_model->drop_options_kri(GROUP_RISK_OWNER);
            $this->data['auth_user_id'] = $row->auth_user_id;

            $this->data['risk_kpi'] = $this->risk_kpi_model->drop_options();
            $this->data['risk_kpi_id'] = $row->risk_kpi_id;

            $this->data['RISK_ITEM'] = $this->risk_item_model->drop_options();
            $this->data['RISK_ITEM_ID'] = $row->RISK_ITEM_ID;

            $this->data['TOP_RISK_NUMBER'] = $row->TOP_RISK_NUMBER;
            $this->data['HAZARD'] = $row->HAZARD;
            $this->data['BASIC_EVENT'] = $row->BASIC_EVENT;
            $this->data['DASHBOARD_DESCRIPTION'] = $row->DASHBOARD_DESCRIPTION;
            $this->data['THRESHOLD_VALUE'] = $row->THRESHOLD_VALUE;
            $this->data['measure_unit'] = $row->measure_unit;

            $this->data['PENYEBAB'] = $row->PENYEBAB;
            $this->data['INDICATOR_NUMBER'] = $row->INDICATOR_NUMBER;
            
            $this->data['INDICATOR'] = $this->indicator_model->drop_options();
            $this->data['INDICATOR_ID'] = $row->INDICATOR_ID;

            $this->data['INDICATOR_THRESHOLD'] = $this->key_risk_indicator_threshold_model->drop_options();
            $this->data['key_risk_indicator_threshold_id'] = $row->key_risk_indicator_threshold_id;
            
            $this->data['LEADING_LAGGING'] = $row->LEADING_LAGGING;
            $this->data['TRAKING_FREQUENCY'] = $row->TRAKING_FREQUENCY;
            $this->data['THRESHOLD_BAWAH'] = $row->THRESHOLD_BAWAH;
            $this->data['THRESHOLD_ATAS'] = $row->THRESHOLD_ATAS;
            $this->data['DATA_SOURCE'] = $row->DATA_SOURCE;
            $this->data['INDICATOR_RANGKING'] = $row->INDICATOR_RANGKING;

            $this->data['LEADING_LAGGING_VALUE'] = array(LEADING => "Leading", LAGGING => "Lagging");
            $this->data['LEADING_LAGGING'] = $row->LEADING_LAGGING;

            $this->data['TAHUN'] = $row->TAHUN;
			$this->data['STATUS'] = $this->status_model->drop_options();
            $this->data['STATUS_ID'] = $row->STATUS;
            $this->data['UNIT'] = $this->unit_model->drop_options();
            $this->data['UNIT_ID'] = $row->UNIT_ID;
            $this->data['CREATED_BY'] = $row->CREATED_BY;
            $this->data['CREATED_DATE'] = $row->CREATED_DATE;
            $this->data['UPDATED_BY'] = $row->UPDATED_BY;
            $this->data['UPDATED_DATE'] = $row->UPDATED_DATE;

            if ($_GET['threshold_value_id'] > 0) {
                $rowData = $this->key_risk_indicator_threshold_value_model->get_by_id((int) $_GET['threshold_value_id']);
                $this->data['INPUT_DATE'] = $rowData->input_date;
                $this->data['THRESHOLD_VALUE'] = $rowData->threshold_value;
            }
        }

        if(isset($_POST['THRESHOLD_VALUE'])){
            if ($_GET['threshold_value_id'] > 0) {
                /*update to key_risk_indicator_threshold_value*/
                if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN) {
                    $inputDate = $_POST['INPUT_DATE'];
                } else {
                    $inputDate = mdate('%Y-%m-%d', now());
                }

                $this->key_risk_indicator_threshold_value_model->update($_GET['threshold_value_id'], $_POST['THRESHOLD_VALUE'], $inputDate);

            } else {
                /*insert to key_risk_indicator_threshold_value*/
                if($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN) {
                    $inputDate = $_POST['INPUT_DATE'];
                } else {
                    $inputDate = mdate('%Y-%m-%d', now());
                }

                $this->key_risk_indicator_threshold_value_model->insert($id, $_POST['THRESHOLD_VALUE'], $inputDate);

                /*save to key_risk_indicator_threshold*/
                $data_kri['is_input_threshold_value'] = 1;
                $this->key_risk_indicator_model->update($id, $data_kri);
            }

            redirect('kri/key_risk_indicator/view/'.$id);
        }

        $this->template->build('key-risk-indicator-threshold-value-form');
    }

    function delete($id) {
		$key_risk_indicator_threshold_value = $this->key_risk_indicator_threshold_value_model->get_by_id($id);
		if ($key_risk_indicator_threshold_value)
			$this->key_risk_indicator_threshold_value_model->delete($id);
		/* if update status */
        /* $this->key_risk_indicator_threshold_value_model->update($id, array('status' => 0)); */
        redirect('kri/key_risk_indicator/view/'.$key_risk_indicator_threshold_value->key_risk_indicator_id);
    }
}

?>