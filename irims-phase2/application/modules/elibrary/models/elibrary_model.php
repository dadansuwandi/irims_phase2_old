<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Elibrary Model
 * 
 * @package App
 * @category Model
 * @author Wildan Sawaludin
 */
class Elibrary_model extends MY_Model {
	
	private $ci;
	protected $table = 'tx_elibraries ';
	
	function __construct() {
		parent::__construct();
		$this->ci =& get_instance();
	}

	function get_by_file($file) {
        $query = $this->db->get_where($this->table, array($this->table . '.`FILE_NAME`=' => $file));

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }

    function get_icon($extention){
        $image = "";
        
        if ($extention == '.jpg') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/jpg.png'." alt=".'jpg_file'." width=".'24'." height=".'24'." border=".'0'." title=".'jpg_file'.">";
        } else if ($extention == '.jpeg') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/jpeg.png'." alt=".'jpeg_file'." width=".'24'." height=".'24'." border=".'0'." title=".'jpeg_file'.">";
        } else if ($extention == '.png') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/png.png'." alt=".'png_file'." width=".'24'." height=".'24'." border=".'0'." title=".'png_file'.">";
        } else if ($extention == '.gif') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/gif.png'." alt=".'gif_file'." width=".'24'." height=".'24'." border=".'0'." title=".'gif_file'.">";
        } else if ($extention == '.txt') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/txt.png'." alt=".'txt_file'." width=".'24'." height=".'24'." border=".'0'." title=".'txt_file'.">";
        } else if ($extention == '.csv') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/csv.png'." alt=".'csv_file'." width=".'24'." height=".'24'." border=".'0'." title=".'csv_file'.">";
        } else if ($extention == '.bin') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/bin.png'." alt=".'bin_file'." width=".'24'." height=".'24'." border=".'0'." title=".'bin_file'.">";
        } else if ($extention == '.exe') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/exe.png'." alt=".'exe_file'." width=".'24'." height=".'24'." border=".'0'." title=".'exe_file'.">";
        } else if ($extention == '.psd') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/psd.png'." alt=".'psd_file'." width=".'24'." height=".'24'." border=".'0'." title=".'psd_file'.">";
        } else if ($extention == '.dll') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/dll.png'." alt=".'dll_file'." width=".'24'." height=".'24'." border=".'0'." title=".'dll_file'.">";
        } else if ($extention == '.pdf') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/pdf.png'." alt=".'pdf_file'." width=".'24'." height=".'24'." border=".'0'." title=".'pdf_file'.">";
        } else if ($extention == '.xls') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/xls.png'." alt=".'xls_file'." width=".'24'." height=".'24'." border=".'0'." title=".'xls_file'.">";
        } else if ($extention == '.ppt') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/ppt.png'." alt=".'ppt_file'." width=".'24'." height=".'24'." border=".'0'." title=".'ppt_file'.">";
        } else if ($extention == '.gz') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/gz.png'." alt=".'gz_file'." width=".'24'." height=".'24'." border=".'0'." title=".'gz_file'.">";
        } else if ($extention == '.tar') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/tar.png'." alt=".'tar_file'." width=".'24'." height=".'24'." border=".'0'." title=".'tar_file'.">";
        } else if ($extention == '.zip') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/zip.png'." alt=".'zip_file'." width=".'24'." height=".'24'." border=".'0'." title=".'zip_file'.">";
        } else if ($extention == '.text') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/text.png'." alt=".'text_file'." width=".'24'." height=".'24'." border=".'0'." title=".'text_file'.">";
        } else if ($extention == '.xml') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/xml.png'." alt=".'xml_file'." width=".'24'." height=".'24'." border=".'0'." title=".'xml_file'.">";
        } else if ($extention == '.xsl') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/xsl.png'." alt=".'xsl_file'." width=".'24'." height=".'24'." border=".'0'." title=".'xsl_file'.">";
        } else if ($extention == '.doc') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/doc.png'." alt=".'doc_file'." width=".'24'." height=".'24'." border=".'0'." title=".'doc_file'.">";
        } else if ($extention == '.docx') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/docx.png'." alt=".'docx_file'." width=".'24'." height=".'24'." border=".'0'." title=".'docx_file'.">";
        } else if ($extention == '.xlsx') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/xlsx.png'." alt=".'xlsx_file'." width=".'24'." height=".'24'." border=".'0'." title=".'xlsx_file'.">";
        } else if ($extention == '.word') {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/word.png'." alt=".'word_file'." width=".'24'." height=".'24'." border=".'0'." title=".'word_file'.">";
        } else {
            $image = "<img src=".base_url() . 'assets/img/icons/48px/_page.png'." alt=".'page_file'." width=".'24'." height=".'24'." border=".'0'." title=".'page_file'.">";
        }

        return $image;
    }
	
	function get_list($base_url = '', $offset = 0, $limit = 0) {
        //return $this->db->order_by('TX_ELIBRARY_ID', 'asc')->get_where($this->table, array(
				//$this->table . '.STATUS' => 1, 
				//$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')
                //$this->table . '.ROLE_ID !=' => $params
			//))->result();

        if ($this->session->userdata('role_id')==GROUP_ADMINISTRATOR || $this->session->userdata('role_id')==GROUP_RISK_ADMIN) {
            $query = $this->db->query("select * from tx_elibraries where ROLE_ID in (0,1)");

            return $query->result(); 
        } else {
            $query = $this->db->query("select * from tx_elibraries where ROLE_ID in (1)");

            return $query->result(); 
        }
        //UPDATE tx_elibraries SET ROLE_ID = 0
    }
	
	function get_all() {
		$query = $this->db
				->where('UNIT_ID', $this->session->userdata('unit_id'))
				->get($this->table);
		$result = $query->result();
		return $result; 
	}
	
	function get_list_view($base_url = '', $offset = 0, $limit = 0) {
        // If base_url is empty, list all data.
        if (empty($base_url)) {
            return $this->db->get_where($this->table, array(
					$this->table . '.STATUS ' => 1, 
					$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')))->result();
        } else {
            $this->load->library('pagination');

            // Set pagination limit
            if (empty($limit)) {
                if ($this->input->get('page_limit'))
                    $limit = (int) $this->input->get('page_limit');
                else
                    $limit = $this->config->item('rows_limit');
            }

            // Set pagination offset
            if (empty($offset)) {
                if ($this->pagination->page_query_string)
                    $offset = (int) $this->input->get($this->pagination->query_string_segment);
                else {
                    $offset = $this->uri->segment(4);
                    if ($this->pagination->use_page_numbers && ($offset > 0))
                        $offset = ($offset - 1) * $limit;
                }
            }

            // Set base_url, 
            if ($this->pagination->page_query_string) {
                $last_char = substr($base_url, -1, 1);
                if ($last_char == '/')
                    $base_url .= '?';
                elseif ($last_char != '?')
                    $base_url .= '/?';
            }

            // Get number of rows
            $this->db->where(array(
				$this->table . '.STATUS' => 1, 
				$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')));
            $row_counts = $this->db->count_all_results($this->table);

            // Create pagination
            $config['base_url'] = $base_url;
            $config['total_rows'] = $row_counts;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            // Execute query
            $query = $this->db->where(array(
				$this->table . '.STATUS' => 1, 
				$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')))->get($this->table, $limit, $offset);
            return $query->result();
        }
    }
	
	function get_by_id($id) {
		$query = $this->db->get_where($this->table, array($this->table . '.TX_ELIBRARY_ID =' => $id));
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

    function get_by_name($name) {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.FILE_NAME'=> $name, 
			$this->table . '.STATUS' => 1, 
			$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }
	
	function get_by_file_path($FILE_PATH) {
        $query = $this->db->get_where($this->table, array(
			$this->table . '.FILE_PATH' => $FILE_PATH, 
			$this->table . '.STATUS' => 1, 
			$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')));
        $result = $query->row();
        return $result;
    }
	
	function get_search($param = NULL) {
		$query = $this->db->where(array(
			$this->table . '.UNIT_ID' => $this->session->userdata('unit_id')))
			->like('LOWER('. $this->table.'.FILE_NAME)', strtolower($param), 'both', FALSE)
                                  ->or_like('LOWER('. $this->table.'.FILE_NAME)', strtolower($param), 'both', FALSE)
                                  ->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
	
	function insert($data) {
		if (!isset($data['UNIT_ID'])) {
            $data['UNIT_ID'] = $this->session->userdata('unit_id');
        }
		if (!isset($data['STATUS'])) {
            $data['STATUS'] = 1;
        }
        $data['CREATED_BY'] = $this->session->userdata('auth_user');
        $data['CREATED_DATE'] = mdate('%Y-%m-%d %h:%i:%s', now());
		
		return parent::insert($this->prep_data($data));
	}
	
	function update($id, $data) {
		if (!isset($data['UNIT_ID'])) {
            $data['UNIT_ID'] = $this->session->userdata('unit_id');
        }
		if (!isset($data['STATUS'])) {
            $data['STATUS'] = 1;
        }
        $data['UPDATED_BY'] = $this->session->userdata('auth_user');
        $data['UPDATED_DATE'] = mdate('%Y-%m-%d %h:%i:%s', now());
		
		return parent::update($id, $this->prep_data($data));
	}
	
	function prep_data($data)
	{
		return $data;
	}

    function update_role($id, $data) {
        if (!isset($data['UNIT_ID'])) {
            $data['UNIT_ID'] = $this->session->userdata('unit_id');
        }
        if (!isset($data['STATUS'])) {
            $data['STATUS'] = 1;
        }
        $data['UPDATED_BY'] = $this->session->userdata('auth_user');
        $data['UPDATED_DATE'] = mdate('%Y-%m-%d %h:%i:%s', now());
        $data['ROLE_ID'] = $_POST['ROLE_ID'];
        
        //return parent::update($id, $this->prep_data($data));
        $this->db->where('TX_ELIBRARY_ID', $id);
        $this->db->update('tx_elibraries', $data);
    }
	
}

?>
