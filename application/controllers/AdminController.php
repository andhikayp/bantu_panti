<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class AdminController extends MY_Protectedcontroller
{
	public function __construct(){
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->library('pdf');
		$this->load->helper('download');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('path');
		$this->load->helper('date');
		$this->load->model('users');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		$this->can_read = ['a01','d01'];
		$this->can_write = ['a01','d01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}
	}

	public function userPetugas(){
		$data['petugas'] = $this->users->getAllUsers();
		$this->slice->view('dashboard.profil.admin.index', $data);
	}

	public function tambahUser(){
		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.profil.admin.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$username = $this->input->post('username');
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');

			$val_petugas = $this->users->getUser($username);
			if(!$val_petugas){
				$username = $this->input->post('username');
			} else {
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => ['Username Sudah Digunakan']));
				return redirect(base_url('AdminController/tambahUser'));	
			}

			$status = $this->users->createUser($username, $password);
			// var_dump($status); return;

			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/tambahUser'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah User']));
				return redirect(base_url('AdminController/userPetugas'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function resetPassword($id){
		$data['petugas'] = $this->users->getUser($id);

		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.profil.admin.password', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');
			$status = $this->users->resetPass($id, $password);

			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/resetPassword'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Reset Password Sukses']));
				return redirect(base_url('AdminController/userPetugas'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function deleteUser($username){
		$this->users->deluser($username);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['User Berhasil Dihapus']));
		return redirect(base_url('AdminController/userPetugas'));
	}

	public function statistik()
	{
		$data['petugas'] = $this->users->count_user();
		$data['all'] = $this->users->count_all_user();
		$data['sekolah'] = $this->users->count_sekolah();
		$data['all_sekolah'] = $this->users->count_all_sekolah();
		// var_dump($data['petugas']); return;
		$this->slice->view('dashboard.statistik', $data);
	}
}
