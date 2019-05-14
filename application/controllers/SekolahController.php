<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class SekolahController extends MY_Protectedcontroller
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

	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " Milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
	
	function terbilang($nilai){
		if($nilai<0) {
			$hasil = "Minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

	public function index(){
		$data['sekolah'] = $this->sekolah->getAll();
		$this->slice->view('dashboard.sekolah.data', $data);
	}

	public function ruangSekolah(){
		$data['ruang'] = $this->sekolah->getAll();
		$this->slice->view('dashboard.sekolah.ruang.index', $data);
	}

	public function lihatRuang($id){
		$data['sekolah'] = $this->sekolah->getSekolah($id);
		$data['ruang'] = $this->ruang->getRuangSekolah($id);
		$this->slice->view('dashboard.sekolah.ruang.lihat', $data);
	}

	public function tambahRuang($id){
		$data['sekolah'] = $this->sekolah->getSekolah($id);

		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.sekolah.ruang.tambah', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$date = date("his");
			$input['kode_ruang'] = 'R'.$id.$date;
			// var_dump($input['kode_ruang']); return;
			
			// $config['file_name'] = 'foto_ruang_'.$input['kode_ruang'].'.jpg';
			// $fileName = $config['file_name'];
			// $config['upload_path'] = 'upload/fotoruang/';
			// $config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size'] = 1000000;
			// $config['overwrite'] = FALSE;
			// $this->load->library('upload', $config);
			// $test = $this->upload->initialize($config);

			// $this->upload->do_upload('foto_ruang');

			$input = $this->input->post(NULL, TRUE);
			// $input['foto_ruang'] = $fileName;
			$input['kode_ruang'] = 'R'.$id.$date;

			$status = $this->ruang->saveRuang($id, $input);
			// var_dump($status); return;
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('SekolahController/lihatRuang/'.$id));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Ruangan']));
				return redirect(base_url('SekolahController/lihatRuang/'.$id));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function ubahRuang($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);

		if(!in_array($this->session->user_login['role'], $this->can_write)){
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.sekolah.ruang.ubah', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$date = date("s");

			// $config['file_name'] = 'foto_ruang_'.$id.$date.'.jpg';
			// $fileName = $config['file_name'];
			// $config['upload_path'] = 'upload/fotoruang/';
			// $config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size'] = 1000000;
			// $config['overwrite'] = TRUE;
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);
			// $test = $this->upload->do_upload('foto_ruang');
			
			// var_dump($fileName); return;
			// var_dump($data['ruang']->foto_ruang); return;
			$input = $this->input->post(NULL, TRUE);

			// if(!$test){
			// 	$input['foto_ruang'] = $data['ruang']->foto_ruang;

			// } else {
			// 	// var_dump($fileName); return;
			// 	$input['foto_ruang'] = $fileName;
			// }

			$status = $this->ruang->updateRuang($id, $input);
			// var_dump($status); return;
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('SekolahController/lihatRuang/'.$npsn));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengubah Ruangan']));
				return redirect(base_url('SekolahController/lihatRuang/'.$npsn));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function hapusRuang($id, $npsn){
		$this->ruang->hapusRuang($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menghapus Ruangan']));
		return redirect(base_url('SekolahController/lihatRuang/'.$npsn));
	}

	public function kondisiSekolah(){
		$data['kondisi'] = $this->sekolah->getAll();
		$this->slice->view('dashboard.sekolah.kondisi.index', $data);
	}

	public function lihatKondisi($id){
		$data['sekolah'] = $this->sekolah->getSekolah($id);
		$data['ruang'] = $this->ruang->getRuangSekolah($id);
		$this->slice->view('dashboard.sekolah.kondisi.lihat', $data);
	}

	public function lihatKondisiRuang($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		$data['terbilang'] = $this->terbilang($data['ruang']->perkiraan_biaya);
		$data['harga_satuan'] = $this->sekolah->harga_satuan();
		// $data['terbilang'] = $this->terbilang(35690);

		$this->slice->view('dashboard.sekolah.kondisi.kondisi', $data);
	}

	public function kesimpulanKondisi($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.sekolah.kondisi.kesimpulan', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$input = $this->input->post(NULL, TRUE);
			// var_dump($input); return;
			$status = $this->kondisi->updateKesimpulan($id, $input);
 			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('SekolahController/lihatKondisi/'.$npsn));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengubah Ruangan']));
				return redirect(base_url('SekolahController/lihatKondisi/'.$npsn));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function uploadKondisi($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		$data['kondisi'] = $this->kondisi->getKondisi($id);
		$this->slice->view('dashboard.sekolah.kondisi.upload', $data);
	}

	public function fotoRuang($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		$this->slice->view('dashboard.sekolah.ruang.foto', $data);
	}

	public function saveFotoRuang($id, $npsn){
		$config['upload_path'] = 'upload/fotoruang/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 1000000;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$files = $_FILES;
		$posts = $_POST;

		$cpt = count ( $_FILES ['file'] ['name'] );
		$date = date("his");

		for($i = 0; $i < $cpt; $i ++) {
			
			$data_array = [
				'kode_ruang' => $id,
				'kode_foto' => $id.$date.$i,
				'nama_foto' => $id.$date.$i.$files ['file'] ['name'] [$i],
				'keterangan_foto' => $posts['keterangan_foto'][$i],
				'update_at' => date('Y-m-d'),
				'username_update' => $this->session->user_login['username'],
			];

			$this->db->insert('fotoruang', $data_array);

			$_FILES ['file'] ['name'] = $id.$date.$i.$files ['file'] ['name'] [$i];
			$_FILES ['file'] ['type'] = $files ['file'] ['type'] [$i];
			$_FILES ['file'] ['tmp_name'] = $files ['file'] ['tmp_name'] [$i];
			$_FILES ['file'] ['error'] = $files ['file'] ['error'] [$i];
			$_FILES ['file'] ['size'] = $files ['file'] ['size'] [$i];

			$this->upload->do_upload('file');
		}
		
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Foto Ruang Berhasil diupload']));       
		return redirect('SekolahController/cekFotoRuang/'.$id.'/'.$npsn);
	}

	public function cekFotoRuang($id, $npsn){
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		$data['foto'] = $this->ruang->getFotoRuang($id);

		// var_dump($data['foto']); return;
		$this->slice->view('dashboard.sekolah.ruang.cekfoto', $data);
	}

	function hapusFoto($id, $kode_ruang, $npsn){
		$foto = $this->ruang->getFotoRuangById($id);
		// var_dump($foto); return;

		$path = '/var/www/html/ruangdata-2019/public/upload/fotoruang/'.str_replace(' ', '_', $foto->nama_foto);
		unlink($path);

		$this->ruang->hapusFoto($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menghapus Foto']));
		return redirect(base_url('SekolahController/cekFotoruang/'.$kode_ruang.'/'.$npsn));
	}

	public function anggaran()
	{
		$data['harga'] = $this->ruang->getHargaTotal();
		$this->slice->view('dashboard.sekolah.anggaran', $data);
	}

	public function anggaran_kecamatan()
	{
		$data['harga'] = $this->ruang->getHargaTotalKecamatan();
		$this->slice->view('dashboard.sekolah.anggaran_kecamatan', $data);
	}
}