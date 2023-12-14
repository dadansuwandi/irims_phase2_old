<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Notification Controller.
     * 
     * @package App
     * @category Controller
     * @author Jaya Dianto
     */
    class notification extends Admin_Controller {

      function __construct() {
          parent::__construct();
          $this->load->model('notification/notification_model');
  		
          if ($this->input->post('cancel-button'))
              redirect('welcome/index');
      }

      function read($id){
        $notification = $this->notification_model->get_by_id($id);

        $data['status'] = "READ";
        $this->notification_model->update($id, $data);

        redirect($notification->url);
      }
    }
?>