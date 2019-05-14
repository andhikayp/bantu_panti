<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->model('Authentikasi');
		$this->load->library('session');
		$this->load->model('users');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
		
		$this->can_read = ['a01', 'd01', 'p01'];
		$this->can_write = ['a01', 'd01', 'p01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}

		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
	}
 
	public function index() 
	{
		$this->slice->view('password/ganti_password'); 
	}

	function ganti_password() 
	{ 
		if($this->input->post('password_baru')!=$this->input->post('konfirmasi_password_baru'))
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password baru dan konfirmasi tidak sama"]));
			redirect(base_url("password/index")); 
		}
		$username = $this->session->user_login['username']; 
		$password = $this->input->post('password_lama'); 
		$password = crypt($password,'jaDzqvi93kHFY'); 

		$namatabel ="users_kantor"; 
		$user = $this->Authentikasi->check_login($namatabel, array('username' => $username), array('password' => $password)); 

		if($user != FALSE) 
		{ 	
			$password_baru = crypt($this->input->post('password_baru'),'jaDzqvi93kHFY');
			$res = $this->Authentikasi->ganti_password($username,$password_baru);
			if($res){
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ["Password berhasil diubah"]));
				redirect(base_url("dashboard"));
			}
			else {
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password gagal diubah"]));
				redirect(base_url("password/index"));
			}
		} 
		
		else 
		{ 
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password lama tidak sesuai"]));
			redirect(base_url("password/index")); 
		} 
	}
}
