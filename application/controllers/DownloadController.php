<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class DownloadController extends MY_Protectedcontroller
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

	public function downloadFormatKomponen($id, $npsn){
		$data['komponen']=$this->kondisi->getKondisi($id);
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		require_once APPPATH.'/third_party/Phpexcel/Bootstrap.php';
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$no = 1;

		$styleArray = [
			'borders' => [
				'allborders' => [
					'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
				],
			],
		];

		$stylethin = [
			'borders' => [
				'allborders' => [
					'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		
		$spreadsheet->getActiveSheet()->getStyle('A3:F28')->applyFromArray($stylethin);
		// $spreadsheet->getActiveSheet()->getStyle('D3:F5')->applyFromArray($stylethin);
		// $spreadsheet->getActiveSheet()->getStyle('D6:F26')->applyFromArray($stylethin);

		$spreadsheet->getActiveSheet()->getStyle('A28')->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle('A1:F5')->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle('A1:F28')->getAlignment()->setVertical('center');
		$spreadsheet->getActiveSheet()->getStyle('A1:A26')->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle('D6:F27')->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle('A1:F4')->getFont()->setBold(true);
	
		$spreadsheet->getActiveSheet()->mergeCells('A1:F1');
		$spreadsheet->getActiveSheet()->setCellValue('A1', 'Kondisi Komponen '.$data['ruang']->nama_ruang.' '.$data['sekolah']->nama_sekolah);
		$spreadsheet->getActiveSheet()->mergeCells('D3:F3');
		$spreadsheet->getActiveSheet()->mergeCells('A3:A4');
		$spreadsheet->getActiveSheet()->mergeCells('B3:B4');
		$spreadsheet->getActiveSheet()->mergeCells('C3:C4');
		$spreadsheet->getActiveSheet()->mergeCells('A7:A8');
		$spreadsheet->getActiveSheet()->mergeCells('A9:A11');
		$spreadsheet->getActiveSheet()->mergeCells('A12:A13');
		$spreadsheet->getActiveSheet()->mergeCells('A14:A18');
		$spreadsheet->getActiveSheet()->mergeCells('A20:A22');
		$spreadsheet->getActiveSheet()->mergeCells('A23:A26');
		$spreadsheet->getActiveSheet()->mergeCells('B7:B8');
		$spreadsheet->getActiveSheet()->mergeCells('B9:B11');
		$spreadsheet->getActiveSheet()->mergeCells('B12:B13');
		$spreadsheet->getActiveSheet()->mergeCells('B14:B18');
		$spreadsheet->getActiveSheet()->mergeCells('B20:B22');
		$spreadsheet->getActiveSheet()->mergeCells('B23:B26');
		$spreadsheet->getActiveSheet()->mergeCells('A28:E28');
		$spreadsheet->getActiveSheet()->mergeCells('F27:F28');
		$spreadsheet->getActiveSheet()->setCellValue('A3', 'No.');
		$spreadsheet->getActiveSheet()->setCellValue('B3', 'Komponen Bangunan');
		$spreadsheet->getActiveSheet()->setCellValue('C3', 'Sub Komponen Bangunan');
		$spreadsheet->getActiveSheet()->setCellValue('D3', 'Bobot %');
		$spreadsheet->getActiveSheet()->setCellValue('D4', 'Terhadap Seluruh Bangunan');
		$spreadsheet->getActiveSheet()->setCellValue('E4', 'Tingkat Kerusakan (%)');
		$spreadsheet->getActiveSheet()->setCellValue('F4', 'Nilai Kerusakan (%)');
		$spreadsheet->getActiveSheet()->setCellValue('A5', '(a)');
		$spreadsheet->getActiveSheet()->setCellValue('B5', '(b)');
		$spreadsheet->getActiveSheet()->setCellValue('C5', '(c)');
		$spreadsheet->getActiveSheet()->setCellValue('D5', '(d)');
		$spreadsheet->getActiveSheet()->setCellValue('E5', '(e)');
		$spreadsheet->getActiveSheet()->setCellValue('F5', 'f = (d x e)');
		$spreadsheet->getActiveSheet()->setCellValue('A6', '1');
		$spreadsheet->getActiveSheet()->setCellValue('A7', '2');
		$spreadsheet->getActiveSheet()->setCellValue('A9', '3');
		$spreadsheet->getActiveSheet()->setCellValue('A12', '4');
		$spreadsheet->getActiveSheet()->setCellValue('A14', '5');
		$spreadsheet->getActiveSheet()->setCellValue('A19', '6');
		$spreadsheet->getActiveSheet()->setCellValue('A20', '7');
		$spreadsheet->getActiveSheet()->setCellValue('A23', '8');
		$spreadsheet->getActiveSheet()->setCellValue('B6', 'PONDASI');
		$spreadsheet->getActiveSheet()->setCellValue('B7', 'STRUKTUR');
		$spreadsheet->getActiveSheet()->setCellValue('B9', 'ATAP');
		$spreadsheet->getActiveSheet()->setCellValue('B12', 'PLAFOND');
		$spreadsheet->getActiveSheet()->setCellValue('B14', 'DINDING');
		$spreadsheet->getActiveSheet()->setCellValue('B19', 'LANTAI');
		$spreadsheet->getActiveSheet()->setCellValue('B20', 'UTILITAS');
		$spreadsheet->getActiveSheet()->setCellValue('B23', 'FINISHING');
		$spreadsheet->getActiveSheet()->setCellValue('C6', 'Pondasi');
		$spreadsheet->getActiveSheet()->setCellValue('C7', 'Kolom dan Balok');
		$spreadsheet->getActiveSheet()->setCellValue('C8', 'Plesteran');
		$spreadsheet->getActiveSheet()->setCellValue('C9', 'Kuda-kuda');
		$spreadsheet->getActiveSheet()->setCellValue('C10', 'Gording + Listplank');
		$spreadsheet->getActiveSheet()->setCellValue('C11', 'Penutup Atap');
		$spreadsheet->getActiveSheet()->setCellValue('C12', 'Rangka Plafond');
		$spreadsheet->getActiveSheet()->setCellValue('C13', 'Penutup Plafond');
		$spreadsheet->getActiveSheet()->setCellValue('C14', 'Batu Bata / Batako-Dinding');
		$spreadsheet->getActiveSheet()->setCellValue('C15', 'Plesteran');
		$spreadsheet->getActiveSheet()->setCellValue('C16', 'Jendela Kaca');
		$spreadsheet->getActiveSheet()->setCellValue('C17', 'Pintu');
		$spreadsheet->getActiveSheet()->setCellValue('C18', 'Kusen');
		$spreadsheet->getActiveSheet()->setCellValue('C19', 'Penutup Lantai');
		$spreadsheet->getActiveSheet()->setCellValue('C20', 'Instalasi Listrik');
		$spreadsheet->getActiveSheet()->setCellValue('C21', 'Instalasi Air');
		$spreadsheet->getActiveSheet()->setCellValue('C22', 'Drainase/Limbah');
		$spreadsheet->getActiveSheet()->setCellValue('C23', 'Finishing Struktur');
		$spreadsheet->getActiveSheet()->setCellValue('C24', 'Finishing Plafond');
		$spreadsheet->getActiveSheet()->setCellValue('C25', 'Finishing Dinding');
		$spreadsheet->getActiveSheet()->setCellValue('C26', 'Finishing Kusen/Daun');
		$spreadsheet->getActiveSheet()->setCellValue('C27', 'Jumlah');
		$spreadsheet->getActiveSheet()->setCellValue('A28', 'Nilai Tingkat Kerusakan (%) (a)');

		for($activesheet=0;$activesheet<1;$activesheet++){
			
		    $spreadsheet->setActiveSheetIndex($activesheet);
		    if($activesheet==0)$spreadsheet->getActiveSheet()->setTitle('Sheet 1');
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4.00);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(27.00);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30.00);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(31.00);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(27.90);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(27.30);
			
			for($baris=3; $baris<=28; $baris++){
				$spreadsheet->getActiveSheet()->getRowDimension($baris)->setRowHeight(20);
			}

			for($baris=6; $baris<=26; $baris++){
				$spreadsheet->getActiveSheet()->setCellValue('F'.$baris, '=D'.$baris.'*'.'E'.$baris);
			}
			$i=6;
			foreach($data['komponen'] as $komponen){
		    	$spreadsheet->getActiveSheet()->setCellValue('D'.$i, $komponen->ts_bangunan);
		    	$spreadsheet->getActiveSheet()->setCellValue('E'.$i, $komponen->t_kerusakan);
				$spreadsheet->getActiveSheet()->setCellValue('F'.$i, $komponen->n_kerusakan);
		    	$i++;
			}

			$spreadsheet->getActiveSheet()->setCellValue('D27', '=SUM(D6:D26)');
			$spreadsheet->getActiveSheet()->setCellValue('F27', '=SUM(F6:F26)');

		}
	    $filename='Format Kondisi '.$data['ruang']->nama_ruang.' '.$data['sekolah']->nama_sekolah.'.xls'; 
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
	    header('Cache-Control: max-age=0'); //no cache
	    header('Cache-Control: max-age=1');

	    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

	    ob_end_clean();
	    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel5');
		$writer->save('php://output','xls');
	}

	public function uploadFormatKomponen($id, $npsn){
        $fileName = $this->input->post('file', TRUE);
		$config['upload_path'] = 'upload/komponen/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size'] = 10000000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		// var_dump($config['upload_path']); return;
		require_once APPPATH.'/third_party/Phpexcel/Bootstrap.php';
		
		if (!$this->upload->do_upload('file')) {
			$error = array('error' => $this->upload->display_errors());
			// var_dump('awan'); return;
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => $error));
			redirect('SekolahController/index'); 
		} else {
			$media = $this->upload->data();
			$inputFileName =  'upload/komponen/'.$media['file_name'];
   
			try {
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			// UPLOAD
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$numRow = $highestRow-2;
			// var_dump($numRow); return;
			
			for ($row = 6; $row <= $numRow ; $row++){  
				$rowData = $sheet->rangeToArray('A'.$row.':F'.$row, NULL, TRUE, FALSE);
				$index = $row-5;
				$kode_komponen = 'SKMP'.$index.$id;
				if($row == 8){
					$rowData[0][1] = "STRUKTUR";
				} else if($row == 10 | $row == 11){
					$rowData[0][1] = "ATAP";
				} else if($row == 13){
					$rowData[0][1] = "PLAFOND";
				} else if($row == 15 | $row == 16 | $row == 17 | $row == 18){
					$rowData[0][1] = "DINDING";
				} else if($row == 21 | $row == 22){
					$rowData[0][1] = "UTILITAS";
				} else if($row == 24 | $row == 25 | $row == 26){
					$rowData[0][1] = "FINISHING";
				}

				$data = array(
					"kode_ruang" => $id,
					"kode_sekolah" => $npsn,
					"kode_komponen" => $kode_komponen,
					"nama_komponen" => $rowData[0][1],
					"sub_komponen" => $rowData[0][2],
					"ts_bangunan" => $rowData[0][3],
					"t_kerusakan" => $rowData[0][4],
					"n_kerusakan" => $rowData[0][5],
					'username_update' => $this->session->user_login['username'],
				);

				$result = $this->kondisi->cekKondisiSama($id, $kode_komponen);
				// var_dump($result); return;
				if($result) {
					$cek_kode_komponen = $result->kode_komponen;
				} else {
					$cek_kode_komponen = 'kosong';
				}
				if($kode_komponen != $cek_kode_komponen){
					$this->db->insert('kondisi', $data);
				}
				else{
					$this->db->where('kode_komponen', $kode_komponen);
					$this->db->update('kondisi', $data);
				}
			}

			$jumlah_tsb = $sheet->getCell('D27')->getCalculatedValue();
			$total_nilai_kerusakan = $sheet->getCell('F27')->getCalculatedValue();

			$update_array = [
				"jumlah_tsb" => $jumlah_tsb,
				"nilai_kerusakan" => $total_nilai_kerusakan,
				"update_at" => date('Y-m-d'),
				'username_update' => $this->session->user_login['username'],
			];

			$this->db->where('kode_ruang', $id);
			$this->db->update('ruang', $update_array);

			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Upload Sukses. Data Telah diupdate']));
			unlink($inputFileName);
			redirect('SekolahController/uploadKondisi/'.$id.'/'.$npsn); 
		}
	}
}