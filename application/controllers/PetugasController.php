<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class PetugasController extends MY_Protectedcontroller
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

	public function upIndex(){
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['sekolah'] = $this->sekolah->getAll();
		$this->slice->view('dashboard.upload.layoutplan.index', $data);
	}

	public function lihatLayout($id){
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['sekolah'] = $this->sekolah->getSekolah($id);
		$this->slice->view('dashboard.upload.layoutplan.lihat', $data);
	}

	public function uploadLayout($id){
		$data['sekolah'] = $this->sekolah->getSekolah($id);

		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.upload.layoutplan.upload', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$config['upload_path'] = 'upload/layoutplan/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 1000000;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$files = $_FILES;

			$cpt = count ( $_FILES ['file'] ['name'] );
			for($i = 0; $i < $cpt; $i ++) {

				$_FILES ['file'] ['name'] = $id.$i.$files ['file'] ['name'] [$i];
				$_FILES ['file'] ['type'] = $files ['file'] ['type'] [$i];
				$_FILES ['file'] ['tmp_name'] = $files ['file'] ['tmp_name'] [$i];
				$_FILES ['file'] ['error'] = $files ['file'] ['error'] [$i];
				$_FILES ['file'] ['size'] = $files ['file'] ['size'] [$i];

				$this->upload->do_upload('file');
			}

			$data = array(
				"layout_plan1" => $id."0".$files ['file'] ['name'] [0],
				"layout_plan2" => $id."1".$files ['file'] ['name'] [1],
				"layout_plan3" => $id."2".$files ['file'] ['name'] [2],
			);
			// var_dump($data); return;
			$this->sekolah->uploadLayout($id, $data);
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Layout Plan Berhasil diupload']));       
			return redirect('PetugasController/upIndex');
		}
	}

	public function downIndex()
	{
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['ruang'] = $this->sekolah->getAll();
		$data['sekolah'] = $this->sekolah->getAll();
		$data['sum'] = $this->ruang->get_count();
		$this->slice->view('dashboard.download.index', $data);
	}

	public function survey()
	{
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['sekolah'] = $this->sekolah->getAllsort();
		$this->slice->view('dashboard.pelaksanaan.survey', $data);
	}

	public function save_survey()
	{
		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.pelaksanaan.survey');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$input = $this->input->post(NULL, TRUE);
			// var_dump($input); return;
			$status = $this->ruang->saveSurvey($input);
			$update = $this->ruang->userSurvey($input);
			// var_dump($status); return;
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PetugasController/survey/'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Data Pelaksanaan Survey']));
				return redirect(base_url('PetugasController/hasil_survey/'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function hasil_survey()
	{
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['petugas'] = $this->users->dptUsers();
		$data['survey'] = $this->sekolah->getSurvey();
		$this->slice->view('dashboard.download.survey', $data);
	}

	public function edit_survey($username)
	{
		$data['sekolah'] = $this->sekolah->getAllsort();
		$data['petugas'] = $this->users->get_survey($username);
		if(!in_array($this->session->user_login['role'], $this->can_write))
		{
			show_404();
		}
		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$this->slice->view('dashboard.pelaksanaan.edit_survey', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$input = $this->input->post(NULL, TRUE);
			$status = $this->users->updateSurvey($username, $input);
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PetugasController/edit_survey'.$username));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Update Hasil Survey']));
				return redirect(base_url('PetugasController/hasil_survey'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function hapus_survey($id, $username)
	{
		$this->users->delsurvey($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Data Pelaksanaan Survey Berhasil Dihapus']));
		return redirect(base_url('PetugasController/hasil_survey'));
	}

	public function indexProfil(){
		if($this->users->getUser($this->username)->no_hape_petugas == ''){
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Wajib Mengisi Profil Terlebih Dahulu']));
			return redirect(base_url('PetugasController/editProfil'));				
		}
		$data['petugas'] = $this->users->getUser($this->username);
		$this->slice->view('dashboard.profil.petugas.index', $data);
	}

	public function editProfil(){
		$data['petugas'] = $this->users->getUser($this->username);

		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.profil.petugas.edit', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){

			$input = $this->input->post(NULL, TRUE);

			$status = $this->users->updateProfil($this->username, $input);

			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PetugasController/editProfil'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengubah Profil']));
				return redirect(base_url('PetugasController/indexProfil'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}
}