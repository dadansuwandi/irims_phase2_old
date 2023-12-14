<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cronjob controller.
 * 
 * @package App
 * @category Controller
 * @author Jaya Dianto
 */

ini_set('max_execution_time', 0);

class cronjob extends CI_Controller 
{

	function __construct() {
        parent::__construct();
        $this->load->model('master/unit_model');
        $this->load->model('master/target_pencapaian_model');
        $this->load->model('risk/risk_identification_model');
        $this->load->model('risk/risk_mitigation_model');
        $this->load->model('risk/risk_mitigation_file_model');
        $this->load->model('risk/log_model');
    }

    /*
		Fungsi cron index address : /index.php/cli/cronjob/index
    */
	public function index()
	{
		# eksekusi setiap tanggal 1 Januari jam 00:01
		# m h  dom mon dow   command
		# 01 00 01 01 * /opt/lampp/bin/php /opt/lampp/htdocs/irims/index.php/cli/cronjob/index
		echo "Testing Cron Index !!!";
		# eksekusi setiap hari/every day jam 59:23
		# m h  dom mon dow   command
		# 59 23 * * * /opt/lampp/bin/php /opt/lampp/htdocs/irims/index.php/cli/cronjob/index
	}

    /*
		Fungsi cron untuk mencopy target di tahun sebelumnya ke tahun berjalan. di eksekusi setiap tengah malam pergantian tahun
		# 01 00 01 01 * /opt/lampp/bin/php /opt/lampp/htdocs/irims/index.php/cli/cronjob/risk_target
    */
	public function risk_target()
	{
		$count 			= 0;
		$currentYear 	= date('Y');
		$previousYear 	= date('Y')-1;
		$unitModel 		= $this->unit_model->get_all();

		foreach($unitModel as $unit){
			$target_this_year = $this->target_pencapaian_model->get_by_unit_id($unit->id, $currentYear);
			if(!$target_this_year){
				$target_prev_year = $this->target_pencapaian_model->get_by_unit_id($unit->id, $previousYear);

				if($target_prev_year->start_date != "0000-00-00"){
					$start_date = date('Y-m-d', strtotime('+1 years', strtotime($target_prev_year->start_date)));
				}else{
					$start_date = $target_prev_year->start_date;
				}

				if($target_prev_year->end_date != "0000-00-00"){
					$end_date = date('Y-m-d', strtotime('+1 years', strtotime($target_prev_year->end_date)));
				}else{
					$end_date = $target_prev_year->end_date;
				}

				$data = array(
					'unit_id' 	=> $target_prev_year->unit_id,
					'target' 	=> $target_prev_year->target,
					'start_date'=> $start_date,
					'end_date' 	=> $end_date,
					'tahun' 	=> $currentYear,
				);

				/*insert target pencapaian for current year*/
				$this->target_pencapaian_model->insert($data);

				$count++;
			}	
		}

		echo "$count data berhasil di eksekusi";
	}

	/*
		Fungsi cron untuk mencopy risk assessment yang statusnya belum termitigasi di tahun sebelumnya ke tahun berjalan. di eksekusi setiap tengah malam pergantian tahun
		# 01 00 01 01 * /opt/lampp/bin/php /opt/lampp/htdocs/irims/index.php/cli/cronjob/risk_monitoring
    */
	public function risk_monitoring()
	{
		$count 			= 0;
		$currentYear 	= date('Y');
		$previousYear 	= date('Y')-1;
		$unitModel 		= $this->unit_model->get_all();

		foreach($unitModel as $unit){
			$query = $this->db->select("risk_indentification.*")
	        ->from("tx_risk_identification as risk_indentification")
	       	->where("risk_indentification.STATUS_DOKUMEN_ID IN(4,5) AND risk_indentification.UNIT_ID = ".$unit->id." AND risk_indentification.TAHUN=$previousYear")
	        ->get();

	        if($query->num_rows()){
	        	foreach($query->result() as $risk){

	        		/*cek dulu apakah data ini sudah pernah di insert atau belum di taun berjalan*/
	        		$queryCheck = $this->db->select('RISK_IDENTIFICATION_ID')
	                    ->where('RISK_ITEM_ID', $risk->RISK_ITEM_ID)
	                    ->where('HAZARD', $risk->HAZARD)
	                    ->where('PENYEBAB', $risk->PENYEBAB)
	                    ->where('DAMPAK', $risk->DAMPAK)
	                    ->where('UNIT_ID', $risk->UNIT_ID)
	                    ->where('TAHUN', $currentYear)
	                    ->get("tx_risk_identification");

	                if($queryCheck->num_rows()==0){
	                	$dataRisk = array(
	                		"CODE"								=> $this->risk_identification_model->create_code($unit->id, $currentYear),
	                		"OBJECTIVE"							=> $risk->OBJECTIVE,
	                		"RISK_ITEM_ID"						=> $risk->RISK_ITEM_ID,
	                		"HAZARD"							=> $risk->HAZARD,
	                		"PENYEBAB"							=> $risk->PENYEBAB,
	                		"DAMPAK"							=> $risk->DAMPAK,
	                		"INHERENT_RISK_K_ID"				=> $risk->INHERENT_RISK_K_ID,
	                		"INHERENT_RISK_D_ID"				=> $risk->INHERENT_RISK_D_ID,
	                		"PENGENDALIAN_YANG_TELAH_DILAKUKAN" => $risk->PENGENDALIAN_YANG_TELAH_DILAKUKAN,
	                		"RESIDUAL_RISK_K_ID" 				=> $risk->RESIDUAL_RISK_K_ID,
	                		"RESIDUAL_RISK_D_ID"				=> $risk->RESIDUAL_RISK_D_ID,
	                		"REALISASI_MITIGASI"				=> $risk->REALISASI_MITIGASI,
	                		"FILE"								=> $risk->FILE,
	                		"MITIGASI_RISK_K_ID"				=> $risk->MITIGASI_RISK_K_ID,
	                		"MITIGASI_RISK_D_ID"				=> $risk->MITIGASI_RISK_D_ID,
	                		"RISK_CATEGORY_ID"					=> $risk->RISK_CATEGORY_ID,
	                		"RISK_CLASSIFICATION_ID"			=> $risk->RISK_CLASSIFICATION_ID,
	                		"TERIDENTIFIKASI"					=> $risk->TERIDENTIFIKASI,
	                		"TERMITIGASI"						=> $risk->TERMITIGASI,
	                		"USER_PIC_ID"						=> $risk->USER_PIC_ID,
	                		"UNIT_ID"							=> $risk->UNIT_ID,
	                		"TAHUN" 							=> $currentYear,
	                		"STATUS_DOKUMEN_ID" 				=> $risk->STATUS_DOKUMEN_ID,
	                		"INSERTED_BY" 						=> $risk->INSERTED_BY,
	                		"INSTERTED_TIME" 					=> $risk->INSTERTED_TIME,
	                		"UPDATED_BY" 						=> $risk->UPDATED_BY,
	                		"UPDATED_TIME" 						=> $risk->UPDATED_TIME,
	                	);

						$saveRiskIdentification = $this->risk_identification_model->insert($dataRisk);
						
						if($saveRiskIdentification){
							$risk_identification_id = $this->db->insert_id();

							/*simpan history logs dokumen sebelumnya*/
							$queryLogs = $this->db
						       	->where("risk_identification_id", $risk->RISK_IDENTIFICATION_ID)
						        ->get("logs");

						    if($queryLogs->num_rows()){
						    	foreach($queryLogs->result() as $logs){
						    		$dataLogs = array(
						    			'risk_identification_id' => $risk_identification_id,
						    			'created_date' 			 => $logs->created_date,
						    			'user_id' 				 => $logs->user_id,
						    			'keterangan' 			 => $logs->keterangan,
						    		);

						    		$this->log_model->insert($dataLogs);
						    	}
						    }

							/*simpan risk mitigation jika ada*/
							$queryMitigation = $this->db
						       	->where("RISK_IDENTIFICATION_ID",$risk->RISK_IDENTIFICATION_ID)
						        ->get("tx_risk_mitigation");

						    if($queryMitigation->num_rows()){
						    	foreach($queryMitigation->result() as $riskMitigation){
						    		$dataMitigation = array(
						    			"RISK_IDENTIFICATION_ID" 	=> $risk_identification_id,
						    			"RENCANA_PENGENDALIAN" 		=> $riskMitigation->RENCANA_PENGENDALIAN,
						    			"PIC_UNIT_KERJA_ID" 		=> $riskMitigation->PIC_UNIT_KERJA_ID,
						    			"PIC_KANTOR_PUSAT_ID" 		=> $riskMitigation->PIC_KANTOR_PUSAT_ID,
						    			"TARGET_WAKTU" 				=> $riskMitigation->TARGET_WAKTU,
						    			"REALISASI_MITIGASI" 		=> $riskMitigation->REALISASI_MITIGASI,
						    		);

						    		$this->risk_mitigation_model->insert($dataMitigation);
						    	}
						    }

						    /*simpan risk mitigation file jika ada*/
						    $queryMitigationFile = $this->db
						       	->where("RISK_IDENTIFICATION_ID",$risk->RISK_IDENTIFICATION_ID)
						        ->get("tx_risk_mitigation_files");

						    if($queryMitigationFile->num_rows()){
						    	foreach($queryMitigationFile->result() as $riskMitigationFile){
						    		$dataMitigationFile = array(
						    			"RISK_IDENTIFICATION_ID" => $risk_identification_id,
						    			"FILE_NAME" 			 => $riskMitigationFile->FILE_NAME,
						    			"FILE_PATH" 			 => $riskMitigationFile->FILE_PATH,
						    			"FILE_FULL_PATH" 		 => $riskMitigationFile->FILE_FULL_PATH,
						    			"FILE_SIZE" 			 => $riskMitigationFile->FILE_SIZE,
						    			"FILE_TYPE" 			 => $riskMitigationFile->FILE_TYPE,
						    			"FILE_URL" 				 => $riskMitigationFile->FILE_URL,
						    			"FILE_TITLE" 			 => $riskMitigationFile->FILE_TITLE,
						    			"FILE_EXT" 				 => $riskMitigationFile->FILE_EXT,
						    			"FILE_ORIG_NAME" 		 => $riskMitigationFile->FILE_ORIG_NAME,
						    			"FILE_CLIENT_NAME" 		 => $riskMitigationFile->FILE_CLIENT_NAME,
						    			"DESCRIPTION" 			 => $riskMitigationFile->DESCRIPTION,
						    		);

						    		$this->risk_mitigation_file_model->insert($dataMitigationFile);
						    	}
						    }
						}

						$count++;
					}
	        	}
	        }
		}

		echo "$count data berhasil di eksekusi";
	}
}