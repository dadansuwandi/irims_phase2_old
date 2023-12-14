<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Status management controller.
 * 
 * @package App
 * @category Controller
 * @author Jaya Dianto
 */
class status_dokumen extends Admin_Controller {

    protected $form = array(
		'STATUS_DOKUMEN_ID' => array(
            'helper' => 'form_hidden'
        ),
		'STATUS_DOKUMEN_NAMA' => array(
            'label' => 'Nama Status',
            'rules' => 'trim|required|max_length[250]|xss_clean',
            'helper' => 'form_inputlabel'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->model('status_dokumen_model');
        if ($this->input->post('cancel-button'))
            redirect('master/status_dokumen/index');
    }

    function index() {
		$this->data['rows'] = $this->status_model->get_list(site_url('master/status_dokumen/index'));
		$this->template->build('status-dokumen-list');
    }
	
	function view($id) {
        $this->data['row'] = $this->status_model->get_by_id((int) $id);
        $this->template->build('status-view');
    }

    function edit($id) {
        $this->_updatedata($id);
    }

    function add() {
        $this->_updatedata();
    }

    function _updatedata($id = 0) {
        $this->load->library('form_validation');
        $form = $this->form;
		
		$this->data['STATUS_DOKUMEN_ID'] = '';
       
        if ($id > 0) {
            $row = $this->status_dokumen_model->get_by_id((int) $id);
			
			//option 2
			$this->data['STATUS_DOKUMEN_ID'] = $row->STATUS_DOKUMEN_ID;
			$this->data['STATUS_DOKUMEN_NAMA'] = $row->STATUS_DOKUMEN_NAMA;
        }

        $this->form_validation->init($form);
		
        if ($this->form_validation->run()) {
            if ($id > 0) {
                $this->status_dokumen_model->update($id, $this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been updated');
            } else {
                $this->status_dokumen_model->insert($this->form_validation->get_values());
				$this->template->set_flashdata('info', 'Data has been added');
            }

            redirect('master/status');
        }

        $this->data['form'] = $this->form_validation;
        $this->template->build('status-dokumen-form');
    }

    function delete($id) {
		$status = $this->status_dokumen_model->get_by_id($id);
		if ($status)
			$this->status_dokumen_model->delete($id);
		
        //$this->status_model->update($id, array('status' => 0));
        redirect('master/status_dokumen');
    }
}

?>