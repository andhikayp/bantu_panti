<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class PengeluaranController extends MY_Protectedcontroller
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
		$this->load->model('pengeluaran');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		$this->can_read = ['a01', 'd01'];
		$this->can_write = ['a01', 'd01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}
	}

	public function index()
	{
		$data['pengeluaran'] = $this->pengeluaran->lihatPengeluaran();
		$this->slice->view('dashboard.pengeluaran.index', $data);
	}

	public function tambahPengeluaran()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.pengeluaran.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$input = $this->input->post(NULL, TRUE);
			$status = $this->pengeluaran->insertPengeluaran($input);
			if(!$status)
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PengeluaranController/tambahPengeluaran'.$data));	
			}
			else
			{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Pengeluaran']));
				return redirect(base_url('PengeluaranController/index'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}
}