<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class AdminController extends MY_Protectedcontroller
{
	public function __construct()
	{
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

	public function userDonatur()
	{
		$data['petugas'] = $this->users->getAllDonatur();
		$this->slice->view('dashboard.profil.admin.donatur.index', $data);
	}

	public function userAnakPanti()
	{
		$data['petugas'] = $this->users->getAllAnakPanti();
		$this->slice->view('dashboard.profil.admin.anak_panti.index', $data);
	}

	public function tambahUserDonatur()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.profil.admin.donatur.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$username = $this->input->post('username');
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');

			$val_petugas = $this->users->getUser($username);
			if(!$val_petugas)
			{
				$username = $this->input->post('username');
			} 
			else 
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => ['Username Sudah Digunakan']));
				return redirect(base_url('AdminController/tambahUserDonatur'));	
			}

			$status = $this->users->createUserDonatur($username, $password);
			// var_dump($status); return;

			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/tambahUserDonatur'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah User']));
				return redirect(base_url('AdminController/userDonatur'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}

	public function tambahUserAnakPanti()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.profil.admin.anak_panti.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$username = $this->input->post('username');
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');

			$val_petugas = $this->users->getUser($username);
			if(!$val_petugas)
			{
				$username = $this->input->post('username');
			} 
			else 
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => ['Username Sudah Digunakan']));
				return redirect(base_url('AdminController/tambahUserDonatur'));	
			}

			$status = $this->users->createUserAnakPanti($username, $password);
			// var_dump($status); return;

			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/tambahUserAnakPanti'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah User']));
				return redirect(base_url('AdminController/userAnakPanti'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}

	public function resetPasswordAnakPanti($id)
	{
		$data['petugas'] = $this->users->getUser($id);
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.profil.admin.anak_panti.password', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');
			$status = $this->users->resetPass($id, $password);
			if(!$status)
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/resetPasswordAnakPanti'));	
			}
			else
			{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Reset Password Sukses']));
				return redirect(base_url('AdminController/userAnakPanti'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}

	public function resetPasswordDonatur($id)
	{
		$data['petugas'] = $this->users->getUser($id);
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.profil.admin.donatur.password', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$password = crypt($this->input->post('password'),'jaDzqvi93kHFY');
			$status = $this->users->resetPass($id, $password);
			if(!$status)
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/resetPasswordDonatur'));	
			}
			else
			{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Reset Password Sukses']));
				return redirect(base_url('AdminController/userDonatur'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}

	public function deleteUserDonatur($username)
	{
		$this->users->deluser($username);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['User Berhasil Dihapus']));
		return redirect(base_url('AdminController/userDonatur'));
	}

	public function deleteUserAnakPanti($username)
	{
		$this->users->deluser($username);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['User Berhasil Dihapus']));
		return redirect(base_url('AdminController/userAnakPanti'));
	}

	public function profilPanti()
	{
		$this->slice->view('dashboard.profil.panti.tambah');
	}
}
