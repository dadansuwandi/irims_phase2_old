<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Risk Mitigation File Model
     * 
     * @package App
     * @category Model
     * @author Wildan Sawaludin
     */
    class risk_mitigation_file_model extends MY_Model {
    	
    	private $ci;
    	protected $table       = 'tx_risk_mitigation_files';
    	protected $user_table  = 'auth_users';
    	
    	function __construct() {
    		parent::__construct();
    		$this->ci =& get_instance();
            $this->id_field = 'TX_RISK_MITIGATION_FILE_ID';
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
                    ->join('tx_risk_identification as tri', 'tri.RISK_IDENTIFICATION_ID = tx_risk_mitigation_files.RISK_IDENTIFICATION_ID', 'left')
                    ->where('tx_risk_mitigation_files.RISK_IDENTIFICATION_ID', $risk_identification_id)
                    ->get($this->table);
            $result = $query->result();
            
            return $result;
        }

        function get_by_file($file) {
            $query = $this->db->get_where($this->table, array($this->table . '.FILE_NAME' => $file));

            if ($query->num_rows() > 0)
                return $query->row();
            else
                return FALSE;
        }

        function get_icon($extention){
            $image = "";
            
            if ($extention == '.jpg') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/jpg.png'." alt=".'jpg_file'." width=".'48'." height=".'48'." border=".'0'." title=".'jpg_file'.">";
            } else if ($extention == '.jpeg') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/jpeg.png'." alt=".'jpeg_file'." width=".'48'." height=".'48'." border=".'0'." title=".'jpeg_file'.">";
            } else if ($extention == '.png') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/png.png'." alt=".'png_file'." width=".'48'." height=".'48'." border=".'0'." title=".'png_file'.">";
            } else if ($extention == '.gif') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/gif.png'." alt=".'gif_file'." width=".'48'." height=".'48'." border=".'0'." title=".'gif_file'.">";
            } else if ($extention == '.txt') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/txt.png'." alt=".'txt_file'." width=".'48'." height=".'48'." border=".'0'." title=".'txt_file'.">";
            } else if ($extention == '.csv') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/csv.png'." alt=".'csv_file'." width=".'48'." height=".'48'." border=".'0'." title=".'csv_file'.">";
            } else if ($extention == '.bin') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/bin.png'." alt=".'bin_file'." width=".'48'." height=".'48'." border=".'0'." title=".'bin_file'.">";
            } else if ($extention == '.exe') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/exe.png'." alt=".'exe_file'." width=".'48'." height=".'48'." border=".'0'." title=".'exe_file'.">";
            } else if ($extention == '.psd') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/psd.png'." alt=".'psd_file'." width=".'48'." height=".'48'." border=".'0'." title=".'psd_file'.">";
            } else if ($extention == '.dll') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/dll.png'." alt=".'dll_file'." width=".'48'." height=".'48'." border=".'0'." title=".'dll_file'.">";
            } else if ($extention == '.pdf') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/pdf.png'." alt=".'pdf_file'." width=".'48'." height=".'48'." border=".'0'." title=".'pdf_file'.">";
            } else if ($extention == '.xls') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/xls.png'." alt=".'xls_file'." width=".'48'." height=".'48'." border=".'0'." title=".'xls_file'.">";
            } else if ($extention == '.ppt') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/ppt.png'." alt=".'ppt_file'." width=".'48'." height=".'48'." border=".'0'." title=".'ppt_file'.">";
            } else if ($extention == '.gz') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/gz.png'." alt=".'gz_file'." width=".'48'." height=".'48'." border=".'0'." title=".'gz_file'.">";
            } else if ($extention == '.tar') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/tar.png'." alt=".'tar_file'." width=".'48'." height=".'48'." border=".'0'." title=".'tar_file'.">";
            } else if ($extention == '.zip') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/zip.png'." alt=".'zip_file'." width=".'48'." height=".'48'." border=".'0'." title=".'zip_file'.">";
            } else if ($extention == '.text') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/text.png'." alt=".'text_file'." width=".'48'." height=".'48'." border=".'0'." title=".'text_file'.">";
            } else if ($extention == '.xml') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/xml.png'." alt=".'xml_file'." width=".'48'." height=".'48'." border=".'0'." title=".'xml_file'.">";
            } else if ($extention == '.xsl') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/xsl.png'." alt=".'xsl_file'." width=".'48'." height=".'48'." border=".'0'." title=".'xsl_file'.">";
            } else if ($extention == '.doc') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/doc.png'." alt=".'doc_file'." width=".'48'." height=".'48'." border=".'0'." title=".'doc_file'.">";
            } else if ($extention == '.docx') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/docx.png'." alt=".'docx_file'." width=".'48'." height=".'48'." border=".'0'." title=".'docx_file'.">";
            } else if ($extention == '.xlsx') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/xlsx.png'." alt=".'xlsx_file'." width=".'48'." height=".'48'." border=".'0'." title=".'xlsx_file'.">";
            } else if ($extention == '.word') {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/word.png'." alt=".'word_file'." width=".'48'." height=".'48'." border=".'0'." title=".'word_file'.">";
            } else {
                $image = "<img src=".base_url() . 'assets/img/icons/48px/_page.png'." alt=".'page_file'." width=".'48'." height=".'48'." border=".'0'." title=".'page_file'.">";
            }

            return $image;
        }
    }
?>
