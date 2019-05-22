<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class KegiatanController extends MY_Protectedcontroller
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
		$this->load->model('sekolah');
		$this->load->model('ruang');
		$this->load->model('kondisi');
		$this->load->model('users');
		$this->load->model('kegiatan');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		$this->can_read = ['a01', 'd01', 'p01', 'ap01'];
		$this->can_write = ['a01', 'd01', 'p01', 'ap01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}
	}

	public function lihatKegiatan()
	{
		$data['kegiatan'] = $this->kegiatan->lihatKegiatan();
		$this->slice->view('dashboard.kegiatan.lihat', $data);
	}

	public function tambahKegiatan()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.kegiatan.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$input = $this->input->post(NULL, TRUE);
			$status = $this->kegiatan->insertKegiatan($input);
			if(!$status)
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('KegiatanController/tambahKegiatan'.$data));	
			}
			else
			{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Story Kegiatan']));
				return redirect(base_url('kegiatanController/lihatKegiatan'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}

	public function lihatDetailKegiatan($id)
	{
		$data['detail_kegiatan'] = $this->kegiatan->lihatDetailKegiatan($id);

		var_dump($id);return;
	}
}