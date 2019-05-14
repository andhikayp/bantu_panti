<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Sessions extends CI_Controller  
{ 
  public function __construct() { 
    parent::__construct(); 
    $this->load->library('slice');
  } 
 
  public function index() { 
    $this->slice->view('auth/login'); 
  } 
 
  function logout() {
    $this->session->sess_destroy(); 
    redirect('auth/index'); 
  } 
}