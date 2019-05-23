<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class DonasiController extends MY_Protectedcontroller
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
		$this->load->model('donasi');


		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		$this->can_read = ['a01', 'd01', 'p01'];
		$this->can_write = ['a01', 'd01', 'p01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}
	}

	public function index()
	{
		if ($this->session->user_login['role'] == 'a01' || $this->session->user_login['role'] == 'd01') {
			$data['donasi'] = $this->donasi->lihatDonasiAll();
			$this->slice->view('dashboard.donasi.index', $data);
		}
		if ($this->session->user_login['role'] == 'p01') {
			$data['donasi'] = $this->donasi->lihatDonasi($this->session->user_login['username']);
			$this->slice->view('dashboard.donasi.index', $data);
		}
	}

	public function tambahDonasi()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.donasi.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$input = $this->input->post(NULL, TRUE);
			$status = $this->donasi->insertDonasi($input);
			if(!$status)
			{
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('donasiController/tambahDonasi'.$data));	
			}
			else
			{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Donasi']));
				return redirect(base_url('donasiController/index'));	
			}
		}
		else
		{
			show_error("Method Not Allowed", 405);
		}
	}
	
	public function konfirmasiDonasi($id)
	{
		$dateTime = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $now = $dateTime->format("Y-m-d H:i:s");
        $data = array(
			"tanggal_konfirmasi" => $now,
			"username_pengurus_panti" => $this->session->user_login['username'],
		);
		$this->db->update('donasi', $data);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Konfirmasi Donasi Berhasil Dilakukan']));
		return redirect(base_url('DonasiController/index'));
	}

	public function deleteDonatur()
	{

	}
}