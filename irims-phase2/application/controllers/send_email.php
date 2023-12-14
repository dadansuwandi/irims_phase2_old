<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function index()
    {
        // Konfigurasi email
        /* $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'xxx@gmail.com',  // Email gmail
            'smtp_pass'   => 'xxx',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ]; */

        // Load library email dan konfigurasinya
        /* $this->load->library('email', $config) */;

        // Set your email information
        $from = [
            'email' => 'wildan.sawaludin@gmail.com',
            'name' => 'macmour.id'
        ];
       
        $to = array('wildan.sarjanateknik@gmail.com');
        $attachment = 'https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $subject = 'Kirim Email dengan SMTP Gmail CodeIgniter | macmour.id';
        // use this line to send text email.
        $message = "Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.id/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya."; 
        // load view file called "welcome_message" in to a $message variable as a html string.
        //$message =  $this->load->view('welcome_message',[],true); 

        // Email dan nama pengirim
        $this->email->from($from['email'], $from['name']);

        // Email penerima
        $this->email->to($to); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        //$this->email->attach($attachment);

        // Subject email
        $this->email->subject($subject);

        // Isi email
        $this->email->message($message);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            // Show success notification or other things here
            echo 'Sukses! email berhasil dikirim.';
        } else {
            // Raise error message
            //echo $this->email->print_debugger();
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}