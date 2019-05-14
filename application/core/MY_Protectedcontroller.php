<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Protectedcontroller extends CI_Controller
{
    public $can_write = [];
    public $can_read = [];


    public function __construct()
    {
        parent::__construct();

        $this->load->library('roles');
        
        if(!$this->session->user_login)
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Silahkan masuk terlebih dahulu"]));
			redirect(base_url("auth/index")); 
		} 
    }
}
