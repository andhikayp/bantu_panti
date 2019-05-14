<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class Download extends MY_Protectedcontroller
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

    public function lihat_ruang($id)
    {
    	$data['sekolah'] = $this->sekolah->getSekolah($id);
		$data['ruang'] = $this->ruang->getRuangSekolah($id);
		$this->slice->view('dashboard.download.ruang', $data);
    }

    public function laporan_layout_plan($id)
    {
    	$data['image1_jpg'] = $this->sekolah->image1_jpg($id);
    	$data['image1_jpeg'] = $this->sekolah->image1_jpeg($id);
    	$data['image1_png'] = $this->sekolah->image1_png($id);
		$data['image2_jpg'] = $this->sekolah->image2_jpg($id);
		$data['image2_jpeg'] = $this->sekolah->image2_jpeg($id);
		$data['image2_png'] = $this->sekolah->image2_png($id);
		$data['image3_jpg'] = $this->sekolah->image3_jpg($id);
		$data['image3_jpeg'] = $this->sekolah->image3_jpeg($id);
		$data['image3_png'] = $this->sekolah->image3_png($id);
    	$data['sekolah'] = $this->sekolah->getSekolah($id);
    	ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// var_dump($data['image1_jpg']); return;
       	if($data['image1_jpg']!=null || $data['image1_jpeg']!=null || $data['image1_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 1     			
	       		</div><br><br>
	       		<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan1).'" alt="" style="" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	} 	
       	if($data['image2_jpg']!=null || $data['image2_jpeg']!=null || $data['image2_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 2
	       		</div><br><br>
	       		<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan2).'" alt="" style="" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	}
       	if($data['image3_jpg']!=null || $data['image3_jpeg']!=null || $data['image3_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 3
	       		</div><br><br>
		       	<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan3).'" alt="" style="" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	}
       	ob_clean();
		$filename="layout_plan_".$data['sekolah']->nama_sekolah.".pdf";
		$pdf->Output($filename, 'I');
    }

    public function laporan_kondisi_sekolah()
	{
		$data['sekolah'] = $this->sekolah->getAll();
		$row = 35;
		$var = (int)(count($data['sekolah'])/$row);
		if($var==0)
		{
			$jumlah_halaman = 1;
		}
		elseif(count($data['sekolah'])%$row==0)
		{
			$jumlah_halaman = $var;
		}
		else
		{
			$jumlah_halaman = 1+(int)(count($data['sekolah'])/$row);
		}
		ob_start();
		$pdf = new Pdf('L', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(5, 10, 5, true);
		$pdf->AddPage('L', 'F4');
		$no=1;
		$loop=0;
		for($i=1;$i<=$jumlah_halaman;$i++)
		{
			$html =	
				'<div style="font-size:9pt">PEMERINTAH KABUPATEN SIDOARJO<br>
					DINAS PENDIDIKAN DAN KEBUDAYAAN<br>
					JALAN PAHLAWAN NO. 4 SIDOARJO<br>
					Fax. [031] 8051962 Kode Pos 61213<br>
					Website: www.dispendiksidoarjo.net<br>
					DATA SEKOLAH DASAR NEGERI TAHUN 2018<br>
					KABUPATEN SIDOARJO PROVINSI JAWA TIMUR<br>
				</div>';
			$html = $html.
				'<style>
					table, th, td {
						border: 1px solid black;
						vertical-align: middle;
					}
					tr{
						//text-align: center; 
    					vertical-align: middle;
					}
					.font-size {
						font-size: 8.5pt;
						text-align: left;
					}
				</style>
				<table width="100%" style="font-size: 8.5pt; color: #000000; text-align:center;">
					<tr>
						<td width="2.5%" rowspan="2">No</td>
						<td width="15%"rowspan="2">Nama Sekolah</td>
						<td width="13.5%" colspan="2">Kondisi Ruang Kelas</td>
						<td width="13.5%" colspan="4">Kondisi Ruang Kasek</td>
						<td width="13.5%" colspan="4">Kondisi Ruang Guru</td>
						<td width="13.5%" colspan="4">Kondisi Ruang Perpustakaan</td>
						<td width="4%" rowspan="2">Jumlah KM / WC</td>
						<td width="13.5%" colspan="4">Kondisi KM/WC</td>
						<td width="11%" colspan="3">R. Pendukung</td>
					</tr>
					<tr style="font-size: 7pt;">
						<td width="3%" >Baik</td>
						<td width="3.5%" >Rusak Ringan 0-30%</td>
						<td width="3.5%;" >Rusak Sedang 30-45%</td>
						<td width="3.5%;">Rusak Berat 45-65%</td>
						<td width="3%" >Baik</td>
						<td width="3.5%" >Rusak Ringan 0-30%</td>
						<td width="3.5%" >Rusak Sedang 30-45%</td>
						<td width="3.5%" >Rusak Berat 45-65%</td>
						<td width="3%" >Baik</td>
						<td width="3.5%" >Rusak Ringan 0-30%</td>
						<td width="3.5%" >Rusak Sedang 30-45%</td>
						<td width="3.5%" >Rusak Berat 45-65%</td>
						<td width="3%" >Baik</td>
						<td width="3.5%" >Rusak Ringan 0-30%</td>
						<td width="3.5%" >Rusak Sedang 30-45%</td>
						<td width="3.5%" >Rusak Berat 45-65%</td>
						<td width="3%" >Baik</td>
						<td width="3.5%" >Rusak Ringan 0-30%</td>
						<td width="3.5%" >Rusak Sedang 30-45%</td>
						<td width="3.5%" >Rusak Berat 45-65%</td>		
						<td width="3.5%">Rumah Penjaga</td>
						<td width="3.5%">Rumah Dinas Guru</td>
						<td width="4%">Musholla</td>
					</tr>';
			while(1)
			{
				$html=$html.
					'<tr>
						<td width="2.5%" >'.$no.'</td>
						<td width="15%" class="font-size">'.$data['sekolah'][$loop]->nama_sekolah.'</td>
						<td width="3%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%;"></td>
						<td width="3%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="4%"></td>
						<td width="3%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%" ></td>
						<td width="3.5%"></td>
						<td width="3.5%"></td>
						<td width="4%"></td>
					</tr>';
				$no++;
				$loop++;
				if(($no-1)%$row==0)break;
				if($data['sekolah'][$loop]->nama_sekolah==null)break;
			}
			$html=$html.'</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			if($i!=$jumlah_halaman)
			{
				$pdf->SetMargins(5, 5, 5, true);
				$pdf->AddPage('L', 'F4');			
			}
		}
		ob_clean();
		$filename="Laporan_Kondisi_Sekolah.pdf";
		$pdf->Output($filename, 'I');
	}

	public function laporan_analisa_kerusakan($id)
	{
		$data['sekolah'] = $this->sekolah->getSekolah($id);
		ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
	 
		$pdf->AddPage('P', 'F4');
		$html = '
			<table border="3">
				<table width="100%" style="font-size: 12pt; color: #000000;page-break-inside:avoid; margin-top: 10px">
					<tr>
						<td><br></td>
					</tr>
	                <tr>
	                	<td width="13%;"></td>
	                    <td width="20%;" rowspan="4"><img src="https://kantor.ppdbsda.net/img/favicon.ico" style="width:5.5em;height:5.5em;"></td>
	                    <td width="50%" style="text-align:center; font-size: 14pt; font-weight: bold;">PEMERINTAH KABUPATEN SIDOARJO</td>
	                    <td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-size: 13pt; font-weight: bold;">DINAS PENDIDIKAN DAN KEBUDAYAAN</td>
	                	<td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-weight: 200;">Jl. Pahlawan No. 4 Telp. (031) 8921219 Fax. (031) 8051962</td>
	                	<td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-weight: 200;">Sidoarjo, Jawa Timur 61213</td>
	                	<td width="15%"></td>
	                </tr>
	            </table><br>
	            <hr style="color:black; height: 2px; margin-bottom:20px;"/>
	            <div style="font-size: 25pt; font-weight: bold;text-align: center; font-style: italic;"><br><br><br><br><br><br><br><br><br>LAPORAN<br> ANALISA TINGKAT KERUSAKAN <br><br><br><br><br></div>
	            <div style="font-size: 20pt; font-weight: bold;text-align: center;">'.$data['sekolah']->nama_sekolah.'<br>KECAMATAN '.$data['sekolah']->kecamatan.'<br><br>TAHUN 2019 <br><br><br><br><br></div>
	        </table>';
       	$pdf->writeHTML($html, true, false, true, false, '');	
		ob_clean();
		$filename="Cover_".$data['sekolah']->nama_sekolah.".pdf";
		$pdf->Output($filename, 'I');
	}

	public function laporan_analisa_kerusakan_tiap_ruang($id, $npsn)
	{
		$data['kondisi'] = $this->kondisi->getKondisi($id);
		$data['sekolah'] = $this->sekolah->getSekolah($npsn);
		$data['ruang'] = $this->ruang->getRuang($id);
		ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P', 'F4');
		$html = '
			<style>
				table, th, td {
					border: 1px solid black;
				}
				.bold{
					font-weight: bold;
				}
				.center{
					text-align: center;
				}
			</style>
			<div class="">Hasil Perhitungan Analisa Kerusakan</div>
			<div class="bold center" style="font-size:12px;">ANALISA TINGKAT KERUSAKAN<br>PADA KOMPONEN / SUB KOMPONEN BANGUNAN GEDUNG<br>BANTUAN REHABILITASI GEDUNG '.$data['sekolah']->nama_sekolah.'<br>TAHUN 2019
			</div>
			<br>
			<table border="2" width="100%" style="font-size: 9pt; color: #000000;">
				<tr>
					<td width="25%" class="bold">Nama Sekolah</td>
					<td width="25%">'.$data['sekolah']->nama_sekolah.'</td>
					<td class="bold center" colspan="3" width="50%">Jenis Bangunan (**)</td>
				</tr>
				<tr>
					<td width="25%" class="bold">Alamat Sekolah</td>
					<td width="25%">'.$data['sekolah']->alamat_sekolah.'</td>';
					if($data['ruang']->jenis_bangunan==1)
					{
						$html= $html.'
							<td class="center">1 Lantai ( &#42; )</td>
							<td class="center">2 Lantai ( )</td>
							<td class="center">3 Lantai ( )</td>';
					}
					elseif($data['ruang']->jenis_bangunan==2)
					{
						$html= $html.'
							<td class="center">1 Lantai ( )</td>
							<td class="center">2 Lantai ( &#42; )</td>
							<td class="center">3 Lantai ( )</td>';
					}
					elseif($data['ruang']->jenis_bangunan==3)
					{
						$html= $html.'
							<td class="center">1 Lantai ( )</td>
							<td class="center">2 Lantai ( )</td>
							<td class="center">3 Lantai ( &#42; )</td>';
					}
					else
					{
						$html= $html.'
							<td class="center">1 Lantai ( )</td>
							<td class="center">2 Lantai ( )</td>
							<td class="center">3 Lantai ( )</td>';
					}
				$html = $html.'
				</tr>
				<tr>
					<td width="25%" class="bold">Propinsi</td>
					<td width="25%">JAWA TIMUR</td>
					<td class="bold center" colspan="3" width="50%">Rencana Rehab (**)</td>
				</tr>
				<tr>
					<td width="25%" class="bold">Kab/kota</td>
					<td width="25%">SIDOARJO</td>';
					if(!$data['ruang']->rencana_rehab)
					{
						$html= $html.'
							<td class="center" colspan="3">Tidak ada rencana rehab</td>';
					}
					elseif($data['ruang']->rencana_rehab==1)
					{
						$html= $html.'
							<td class="center">Lantai dasar ( &#42; )</td>
							<td class="center">Lantai 2 ( )</td>
							<td class="center">Lantai 3 ( )</td>';
					}
					elseif($data['ruang']->rencana_rehab==2)
					{
						$html= $html.'
							<td class="center">Lantai dasar( )</td>
							<td class="center">Lantai 2 ( &#42; )</td>
							<td class="center">Lantai 3 ( )</td>';
					}
					elseif($data['ruang']->rencana_rehab==3)
					{
						$html= $html.'
							<td class="center">Lantai dasar ( )</td>
							<td class="center">Lantai 2 ( )</td>
							<td class="center">Lantai 3 ( &#42; )</td>';
					}
					$html = $html.'
				</tr>
				<tr>
					<td width="25%" class="bold">Tlp / Fax / e-mail</td>
					<td width="25%">'.$data['sekolah']->no_telepon.'</td>
					<td class="bold center" colspan="3" width="50%">Bantuan Rehab Gedung</td>
				</tr>
				<tr>
					<td width="25%" class="bold">Ruang / Kelas</td>
					<td width="25%">'.$data['ruang']->nama_ruang.'</td>
					<td class="center">Nama Ruang</td>
					<td class="center">Tahun Dibangun</td>
					<td class="center">Rehab ke</td>
				</tr>
				<tr>
					<td width="25%" class="bold">Type Bangunan</td>
					<td width="25%">'.$data['ruang']->tipe_bangunan.'</td>
					<td class="center">'.$data['ruang']->nama_ruang.'</td>
					<td class="center">'.$data['ruang']->tahun_dibangun.'</td>';
					if(!$data['ruang']->rehab_ke || $data['ruang']->rehab_ke==0)
					{
						$html= $html.'
							<td class="center">Belum pernah rehab</td>';
					}
					elseif($data['ruang']->rehab_ke==1)
					{
						$html= $html.'
							<td class="center">1 ( &#42; ); 2 ( ); </td>';
					}
					elseif($data['ruang']->rehab_ke==2)
					{
						$html= $html.'
							<td class="center">1 ( ); 2 ( &#42; ); </td>';
					}
					else
					{
						$html= $html.'
							<td class="center">'.$data['ruang']->rehab_ke.'</td>';
					}
				$html = $html.'
				</tr>
				<tr>
					<td class="center bold" rowspan="2" width="4%">No</td>
					<td class="center bold" rowspan="2" width="21%" style="">KOMPONEN BANGUNAN</td>
					<td class="center bold" rowspan="2" width="25%">SUB KOMPONEN BANGUNAN</td>
					<td class="center bold" colspan="3" width="50%">BOBOT %</td>
				</tr>
				<tr>
					<td class="center bold">Terhadap Seluruh Bangunan</td>
					<td class="center bold">Tingkat Kerusakan (%)</td>
					<td class="center bold">Nilai Kerusakan (%)</td>
				</tr>
				<tr>
					<td width="4%" class="center">(a)</td>
					<td width="21%" class="center">(b)</td>
					<td width="25%" class="center">(c)</td>
					<td class="center">(d)</td>
					<td class="center">(e)</td>
					<td class="center">f=(d x e)</td>
				</tr>';
				$no=1;
					$data['kondisi'] = $this->kondisi->getKondisi($data['ruang']->kode_ruang);
					$jumlahtsb=0;
					$jumlah_tingkat_kerusakan=0;
					$jumlah_nilai_kerusakan=0;
					$nama;
					foreach($data['kondisi'] as $kondisi)
					{
						$jumlahtsb=$jumlahtsb+$kondisi->ts_bangunan;
						$jumlah_tingkat_kerusakan=$jumlah_tingkat_kerusakan+$kondisi->t_kerusakan;
						$jumlah_nilai_kerusakan=$jumlah_nilai_kerusakan+$kondisi->n_kerusakan/100;
						$html = $html.'
						<tr>
							';
							if($nama==null)
							{
								$nama=$kondisi->nama_komponen;
								$html = $html.'
									<td class="center">'.$no.'</td>
									<td>'.$kondisi->nama_komponen.'</td>
								';
								$no++;
							}
							elseif ($nama==$kondisi->nama_komponen) 
							{
								$html = $html.'
									<td></td>
									<td></td>
								';
							}
							elseif ($nama!=$kondisi->nama_komponen) 
							{
								$nama=$kondisi->nama_komponen;
								$html = $html.'
									<td class="center">'.$no.'</td>
									<td>'.$kondisi->nama_komponen.'</td>
								';
								$no++;
							}
							$html=$html.'
							<td>'.$kondisi->sub_komponen.'</td>
							<td style="text-align: right;">'.number_format($kondisi->ts_bangunan,2).'</td>';
							if($kondisi->t_kerusakan==0)
							{
								$html=$html.'
								<td style="text-align: right;">-</td>';
							}
							else
							{
								$html=$html.'
								<td style="text-align: right;">'.number_format($kondisi->t_kerusakan,2).'</td>';
							}
							if($kondisi->t_kerusakan==0)
							{
								$html=$html.'
								<td style="text-align: right;">-</td>';
							}
							else
							{
								$html=$html.'
								<td style="text-align: right;">'.number_format($kondisi->n_kerusakan,2).'</td>';
							}
							$html=$html.'
						</tr>';
					}
					$data['sum_tsb'] = $this->kondisi->getSumtsb($id);
					$html=$html.'
					<tr>
						<td width="25%"></td>
						<td width="25%" style="font-weight:bold">Jumlah</td>
						<td width="16.66%" style="font-weight: bold; text-align:right;">'.number_format($jumlahtsb,2).'</td>
						<td width="16.66%" style="font-weight: bold"></td>
						<td rowspan="2" style="font-weight: bold; text-align:right;">
							'.number_format($jumlah_nilai_kerusakan*100,2).'<br>';
					$html = $html.'</td>
					</tr>
					<tr>
						<td width="83.333%" style="text-align: center; font-weight: bold;">Nilai Tingkat Kerusakan (%)</td>
					</tr>
				</table>
				<div>
					<br>
					<table style="border: none;">
						<tr style="border: none;">
							<td width="60%" style="border: none;">
								<div style="font-size: 8px;">
									(*) : Coret yang tidak perlu <br>
									(**) : Beri tanda yang sesuai () <br><br>
									<b>Catatan: </b><br>
									Format ini digunakan terhadap satu gedung yang ditinjau misal: R. Kantor atau gedung yang sejenis misal: 3 Ruang Teori <br>Per sekolah dimungkinkan lebih dari satu Format Analisa Kerusakan
								</div>
							</td>
							<td style="border: none;">
								<table width="81%" style="float: right;">
									<tr>
										<td style="font-size: 10px;">Ringan</td>
										<td style="font-size: 10px;">< 31%</td>
									</tr>
									<tr>
										<td style="font-size: 10px;">Sedang</td>
										<td style="font-size: 10px;">31% - 45%</td>
									</tr>
									<tr>
										<td style="font-size: 10px;">Berat</td>
										<td style="font-size: 10px;">46% - 65%</td>
									</tr>	
								</table>
							</td>
						</tr>
					</table>
					<br>
					<div style="font-weight: bold; font-size: 11px;">Kesimpulan Analisis Hasil Pengamatan Lapangan</div>
					<table width="100%" style="font-size: 10px; border: none;">
						<tr>
							<td width="4%" style="border:none;">A.</td>
							<td width="21%" style="border:none;">Jenis Perawatan</td>
							<td style="border:none;">: '.$data['ruang']->jenis_perawatan.'</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">B.</td>
							<td width="21%" style="border:none;">Nilai Kerusakan</td>
							<td style="border:none;">: (a) '.number_format($jumlah_nilai_kerusakan*100,2).' %</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">C.</td>
							<td width="21%" style="border:none;">Luas ruangan di Rehab</td>
							<td style="border:none;">: (b) '.$data['ruang']->luas_direhab.' m<sup>2</sup></td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">D.</td>
							<td width="21%" style="border:none;">Harga Satuan Wilayah</td>';
							$data['harga_satuan'] = $this->sekolah->harga_satuan();
							$hasil_rupiah = "Rp " . number_format($data['harga_satuan']->harga_satuan,2,',','.');
							$html=$html.'
							<td style="border:none;">: (c) '.$hasil_rupiah.'</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">E.</td>
							<td width="21%" style="border:none;">Perkiraan Biaya</td>';
							$hasil = $jumlah_nilai_kerusakan*$data['ruang']->luas_direhab*$data['harga_satuan']->harga_satuan;
							$hasil = round($hasil); 
							$terbilang = $this->terbilang($hasil);
							$hasil_rupiah = "Rp " . number_format($hasil,2,',','.');
							$html=$html.'
							<td style="border:none;">: (a) x (b) x (c)= '.$hasil_rupiah.'</td>
						</tr>
						<tr>
							<td width="25%" style="text-align: right; border: none;">Terbilang</td>';
							if ($hasil) 
							{
								$html=$html.'<td width="75%" style="border:none;">: ( '.$terbilang.' rupiah )</td>';
							}
							else 
							{
								$html=$html.'<td width="75%" style="border:none;">: </td>';
							}
							$html=$html.'
						</tr>
					</table>
					<div style="font-weight: bold; font-size: 11px;"><br>
						Penjelasan Singkat Kondisi Bangunan
						<div style="font-weight: none; font-size: 10px;">';
						if($data['ruang']->penjelasan_singkat)
						{
							$html = $html.''.$data['ruang']->penjelasan_singkat;
						}
						else
						{
							$html = $html.'Tidak ada penjelasan';
						}
						$html = $html.'
						</div>
					</div>
				<table style="border: none;">
					<tr style="border: none;">
						<td style="border: none;" width="70%">
							<div class="bold" style="font-size: 11px;">
								Mengetahui / Menyetujui <br>Kepala Sekolah <br><br><br><br>( '.$data['sekolah']->nama_kepala_sekolah.' )
							</div>
						</td>
						<td style="border: none;">
							<div class="bold" style="font-size: 11px;">
								Sidoarjo, <br>Tim Teknis <br><br><br><br>(__________________)
							</div>
						</td>
					</tr>
				</table>
			</div>
			';
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_clean();
		$filename="Analisa_Kerusakan_Komponen_".$data['sekolah']->nama_sekolah."_".$data['ruang']->nama_ruang.".pdf";
		$pdf->Output($filename, 'I');
	}

	public function foto_tiap_ruang($id)
	{
		set_time_limit(60);
		$data['foto_ruang'] = $this->ruang->getFotoRuang($id);
		$nama_sekolah="sekolah";
		$nama_ruang="ruang";
		// var_dump($data['foto_ruang']); return;
		ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetMargins(20, 10, 5, true);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$no=0;
		foreach($data['foto_ruang'] as $fotoruang)
		{
			$data['ruangan'] = $this->ruang->getRuang($fotoruang->kode_ruang);
			$data['sekolah'] = $this->sekolah->getSekolah($data['ruangan']->npsn);
			$nama_sekolah = $data['sekolah']->nama_sekolah;
			$nama_ruang = $data['ruangan']->nama_ruang;
			// var_dump($data['ruangan']); return;
			if($no%2==0)
			{
				$pdf->AddPage('P', 'F4');
				$html = '
				<div style="font-size: 16pt; font-weight: bold; text-align: center;">
					Foto '.$data['ruangan']->nama_ruang.'<br>'.$data['sekolah']->nama_sekolah.'
		 		</div><br>';
			}
	 		if ($fotoruang->keterangan_foto) 
	 		{
	 			$html = $html.'<div style="font-size: 13pt; font-weight: bold; ">Keterangan: '.$fotoruang->keterangan_foto.'</div>';
	 		}
		 	$html = $html.'
		 		<br>
				<img class="img-fluid" src="https://ruangdata.net//upload/fotoruang/'.str_replace(' ', '_', $fotoruang->nama_foto).'" alt="" style="height: 320px; display: block;" >
				<br>
			';
			if($no%2==1)
			{
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			$no++;
		}
		ob_clean();
		$filename="Foto_".$nama_sekolah."_".$nama_ruang.".pdf";
		$pdf->Output($filename, 'I');
	}

	public function all($id)
    {
    	$data['sekolah'] = $this->sekolah->getSekolah($id);
    	$data['image1_jpg'] = $this->sekolah->image1_jpg($id);
    	$data['image1_jpeg'] = $this->sekolah->image1_jpeg($id);
    	$data['image1_png'] = $this->sekolah->image1_png($id);
		$data['image2_jpg'] = $this->sekolah->image2_jpg($id);
		$data['image2_jpeg'] = $this->sekolah->image2_jpeg($id);
		$data['image2_png'] = $this->sekolah->image2_png($id);
		$data['image3_jpg'] = $this->sekolah->image3_jpg($id);
		$data['image3_jpeg'] = $this->sekolah->image3_jpeg($id);
		$data['image3_png'] = $this->sekolah->image3_png($id);
    	$data['sekolah'] = $this->sekolah->getSekolah($id);
		$data['dataruang'] = $this->ruang->getRuangSekolah($id);

		ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
	 
		$pdf->AddPage('P', 'F4');
		$html = '
			<table border="3">
				<table width="100%" style="font-size: 12pt; color: #000000;page-break-inside:avoid; margin-top: 10px">
					<tr>
						<td><br></td>
					</tr>
	                <tr>
	                	<td width="13%;"></td>
	                    <td width="20%;" rowspan="4"><img src="https://kantor.ppdbsda.net/img/favicon.ico" style="width:5.5em;height:5.5em;"></td>
	                    <td width="50%" style="text-align:center; font-size: 14pt; font-weight: bold;">PEMERINTAH KABUPATEN SIDOARJO</td>
	                    <td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-size: 13pt; font-weight: bold;">DINAS PENDIDIKAN DAN KEBUDAYAAN</td>
	                	<td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-weight: 200;">Jl. Pahlawan No. 4 Telp. (031) 8921219 Fax. (031) 8051962</td>
	                	<td width="15%"></td>
	                </tr>
	                <tr>
	                	<td width="13%;"></td>
	                	<td style="text-align:center; font-weight: 200;">Sidoarjo, Jawa Timur 61213</td>
	                	<td width="15%"></td>
	                </tr>
	            </table><br>
	            <hr style="color:black; height: 2px; margin-bottom:20px;"/>
	            <div style="font-size: 25pt; font-weight: bold;text-align: center; font-style: italic;"><br><br><br><br><br><br><br><br><br>LAPORAN<br> ANALISA TINGKAT KERUSAKAN <br><br><br><br><br></div>
	            <div style="font-size: 20pt; font-weight: bold;text-align: center;">'.$data['sekolah']->nama_sekolah.'<br>KECAMATAN '.$data['sekolah']->kecamatan.'<br><br>TAHUN 2019 <br><br><br><br><br></div>
	        </table>';
       	$pdf->writeHTML($html, true, false, true, false, '');
       	// "https://ruangdata.net//upload/layoutplan/{{ str_replace(' ', '_', $sekolah->layout_plan1) }}"
    	if($data['image1_jpg']!=null || $data['image1_jpeg']!=null || $data['image1_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 1     			
	       		</div><br><br>
	       		<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan1).'" alt="" style="height: 700px;" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	} 	
       	if($data['image2_jpg']!=null || $data['image2_jpeg']!=null || $data['image2_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 2
	       		</div><br><br>
	       		<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan2).'" alt="" style="height: 700px;" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	}
       	if($data['image3_jpg']!=null || $data['image3_jpeg']!=null || $data['image3_png']!=null)
       	{
			$pdf->AddPage('P', 'F4');
	       	$html = 
	       		'<div style="font-size: 30pt; font-weight: bold; text-align: center;">LAYOUT PLAN LANTAI 3
	       		</div><br><br>
		       	<img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/'.str_replace(' ', '_', $data['sekolah']->layout_plan3).'" alt="" style="height: 700px;" >';
	       	$pdf->writeHTML($html, true, false, true, false, '');
       	}
       	
       	foreach($data['dataruang'] as $data['ruang'])
       	{
	       	$pdf->AddPage('P', 'F4');
			$html = '
				<style>
					table, th, td {
						border: 1px solid black;
					}
					.bold{
						font-weight: bold;
					}
					.center{
						text-align: center;
					}
				</style>
				<div class="">Hasil Perhitungan Analisa Kerusakan</div>
				<div class="bold center" style="font-size:12px;">ANALISA TINGKAT KERUSAKAN<br>PADA KOMPONEN / SUB KOMPONEN BANGUNAN GEDUNG<br>BANTUAN REHABILITASI GEDUNG '.$data['sekolah']->nama_sekolah.'<br>TAHUN 2019
				</div>
				<br>
				<table border="2" width="100%" style="font-size: 9pt; color: #000000;">
					<tr>
						<td width="25%" class="bold">Nama Sekolah</td>
						<td width="25%">'.$data['sekolah']->nama_sekolah.'</td>
						<td class="bold center" colspan="3" width="50%">Jenis Bangunan (**)</td>
					</tr>
					<tr>
						<td width="25%" class="bold">Alamat Sekolah</td>
						<td width="25%">'.$data['sekolah']->alamat_sekolah.'</td>';
						if($data['ruang']->jenis_bangunan==1)
						{
							$html= $html.'
								<td class="center">1 Lantai ( &#42; )</td>
								<td class="center">2 Lantai ( )</td>
								<td class="center">3 Lantai ( )</td>';
						}
						elseif($data['ruang']->jenis_bangunan==2)
						{
							$html= $html.'
								<td class="center">1 Lantai ( )</td>
								<td class="center">2 Lantai ( &#42; )</td>
								<td class="center">3 Lantai ( )</td>';
						}
						elseif($data['ruang']->jenis_bangunan==3)
						{
							$html= $html.'
								<td class="center">1 Lantai ( )</td>
								<td class="center">2 Lantai ( )</td>
								<td class="center">3 Lantai ( &#42; )</td>';
						}
						else
						{
							$html= $html.'
								<td class="center">1 Lantai ( )</td>
								<td class="center">2 Lantai ( )</td>
								<td class="center">3 Lantai ( )</td>';
						}
					$html = $html.'
					</tr>
					<tr>
						<td width="25%" class="bold">Propinsi</td>
						<td width="25%">JAWA TIMUR</td>
						<td class="bold center" colspan="3" width="50%">Rencana Rehab (**)</td>
					</tr>
					<tr>
						<td width="25%" class="bold">Kab/kota</td>
						<td width="25%">SIDOARJO</td>';
						if(!$data['ruang']->rencana_rehab)
						{
							$html= $html.'
								<td class="center" colspan="3">Tidak ada rencana rehab</td>';
						}
						elseif($data['ruang']->rencana_rehab==1)
						{
							$html= $html.'
								<td class="center">Lantai dasar ( &#42; )</td>
								<td class="center">Lantai 2 ( )</td>
								<td class="center">Lantai 3 ( )</td>';
						}
						elseif($data['ruang']->rencana_rehab==2)
						{
							$html= $html.'
								<td class="center">Lantai dasar( )</td>
								<td class="center">Lantai 2 ( &#42; )</td>
								<td class="center">Lantai 3 ( )</td>';
						}
						elseif($data['ruang']->rencana_rehab==3)
						{
							$html= $html.'
								<td class="center">Lantai dasar ( )</td>
								<td class="center">Lantai 2 ( )</td>
								<td class="center">Lantai 3 ( &#42; )</td>';
						}
						$html = $html.'
					</tr>
					<tr>
						<td width="25%" class="bold">Tlp / Fax / e-mail</td>
						<td width="25%">'.$data['sekolah']->no_telepon.'</td>
						<td class="bold center" colspan="3" width="50%">Bantuan Rehab Gedung</td>
					</tr>
					<tr>
						<td width="25%" class="bold">Ruang / Kelas</td>
						<td width="25%">'.$data['ruang']->nama_ruang.'</td>
						<td class="center">Nama Ruang</td>
						<td class="center">Tahun Dibangun</td>
						<td class="center">Rehab ke</td>
					</tr>
					<tr>
						<td width="25%" class="bold">Type Bangunan</td>
						<td width="25%">'.$data['ruang']->tipe_bangunan.'</td>
						<td class="center">'.$data['ruang']->nama_ruang.'</td>
						<td class="center">'.$data['ruang']->tahun_dibangun.'</td>';
						if(!$data['ruang']->rehab_ke || $data['ruang']->rehab_ke==0)
						{
							$html= $html.'
								<td class="center">Belum pernah rehab</td>';
						}
						elseif($data['ruang']->rehab_ke==1)
						{
							$html= $html.'
								<td class="center">1 ( &#42; ); 2 ( ); </td>';
						}
						elseif($data['ruang']->rehab_ke==2)
						{
							$html= $html.'
								<td class="center">1 ( ); 2 ( &#42; ); </td>';
						}
						else
						{
							$html= $html.'
								<td class="center">'.$data['ruang']->rehab_ke.'</td>';
						}
					$html = $html.'
					</tr>
					<tr>
						<td class="center bold" rowspan="2" width="4%">No</td>
						<td class="center bold" rowspan="2" width="21%" style="">KOMPONEN BANGUNAN</td>
						<td class="center bold" rowspan="2" width="25%">SUB KOMPONEN BANGUNAN</td>
						<td class="center bold" colspan="3" width="50%">BOBOT %</td>
					</tr>
					<tr>
						<td class="center bold">Terhadap Seluruh Bangunan</td>
						<td class="center bold">Tingkat Kerusakan (%)</td>
						<td class="center bold">Nilai Kerusakan (%)</td>
					</tr>
					<tr>
						<td width="4%" class="center">(a)</td>
						<td width="21%" class="center">(b)</td>
						<td width="25%" class="center">(c)</td>
						<td class="center">(d)</td>
						<td class="center">(e)</td>
						<td class="center">f=(d x e)</td>
					</tr>';
					$no=1;
					$data['kondisi'] = $this->kondisi->getKondisi($data['ruang']->kode_ruang);
					$jumlahtsb=0;
					$jumlah_tingkat_kerusakan=0;
					$jumlah_nilai_kerusakan=0;
					$nama;
					foreach($data['kondisi'] as $kondisi)
					{
						$jumlahtsb=$jumlahtsb+$kondisi->ts_bangunan;
						$jumlah_tingkat_kerusakan=$jumlah_tingkat_kerusakan+$kondisi->t_kerusakan;
						$jumlah_nilai_kerusakan=$jumlah_nilai_kerusakan+$kondisi->n_kerusakan/100;
						$html = $html.'
						<tr>
							';
							if($nama==null)
							{
								$nama=$kondisi->nama_komponen;
								$html = $html.'
									<td class="center">'.$no.'</td>
									<td>'.$kondisi->nama_komponen.'</td>
								';
								$no++;
							}
							elseif ($nama==$kondisi->nama_komponen) 
							{
								$html = $html.'
									<td></td>
									<td></td>
								';
							}
							elseif ($nama!=$kondisi->nama_komponen) 
							{
								$nama=$kondisi->nama_komponen;
								$html = $html.'
									<td class="center">'.$no.'</td>
									<td>'.$kondisi->nama_komponen.'</td>
								';
								$no++;
							}
							$html=$html.'
							<td>'.$kondisi->sub_komponen.'</td>
							<td style="text-align: right;">'.number_format($kondisi->ts_bangunan,2).'</td>';
							if($kondisi->t_kerusakan==0)
							{
								$html=$html.'
								<td style="text-align: right;">-</td>';
							}
							else
							{
								$html=$html.'
								<td style="text-align: right;">'.number_format($kondisi->t_kerusakan,2).'</td>';
							}
							if($kondisi->t_kerusakan==0)
							{
								$html=$html.'
								<td style="text-align: right;">-</td>';
							}
							else
							{
								$html=$html.'
								<td style="text-align: right;">'.number_format($kondisi->n_kerusakan,2).'</td>';
							}
							$html=$html.'
						</tr>';
					}
					$data['sum_tsb'] = $this->kondisi->getSumtsb($id);
					$html=$html.'
					<tr>
						<td width="25%"></td>
						<td width="25%" style="font-weight:bold">Jumlah</td>
						<td width="16.66%" style="font-weight: bold; text-align:right;">'.number_format($jumlahtsb,2).'</td>
						<td width="16.66%" style="font-weight: bold"></td>
						<td rowspan="2" style="font-weight: bold; text-align:right;">
							'.number_format($jumlah_nilai_kerusakan*100,2).'<br>';
							// if($jumlah_nilai_kerusakan==0)
							// {
							// 	$html = $html.'(Kondisi Baik)';
							// }
							// elseif($jumlah_nilai_kerusakan<31)
							// {
							// 	$html = $html.'(Kategori Ringan)';
							// }
							// elseif($jumlah_nilai_kerusakan<46)
							// {
							// 	$html = $html.'(Kategori Sedang)';
							// }
							// elseif($jumlah_nilai_kerusakan<65)
							// {
							// 	$html = $html.'(Kategori Berat)';
							// }
					$html = $html.'</td>
					</tr>
					<tr>
						<td width="83.333%" style="text-align: center; font-weight: bold;">Nilai Tingkat Kerusakan (%)</td>
					</tr>
				</table>
				<div>
					<br>
					<table style="border: none;">
						<tr style="border: none;">
							<td width="60%" style="border: none;">
								<div style="font-size: 8px;">
									(*) : Coret yang tidak perlu <br>
									(**) : Beri tanda yang sesuai () <br><br>
									<b>Catatan: </b><br>
									Format ini digunakan terhadap satu gedung yang ditinjau misal: R. Kantor atau gedung yang sejenis misal: 3 Ruang Teori <br>Per sekolah dimungkinkan lebih dari satu Format Analisa Kerusakan
								</div>
							</td>
							<td style="border: none;">
								<table width="81%" style="float: right;">
									<tr>
										<td style="font-size: 10px;">Ringan</td>
										<td style="font-size: 10px;">< 31%</td>
									</tr>
									<tr>
										<td style="font-size: 10px;">Sedang</td>
										<td style="font-size: 10px;">31% - 45%</td>
									</tr>
									<tr>
										<td style="font-size: 10px;">Berat</td>
										<td style="font-size: 10px;">46% - 65%</td>
									</tr>	
								</table>
							</td>
						</tr>
					</table>
					<br>
					<div style="font-weight: bold; font-size: 11px;">Kesimpulan Analisis Hasil Pengamatan Lapangan</div>
					<table width="100%" style="font-size: 10px; border: none;">
						<tr>
							<td width="4%" style="border:none;">A.</td>
							<td width="21%" style="border:none;">Jenis Perawatan</td>
							<td style="border:none;">: '.$data['ruang']->jenis_perawatan.'</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">B.</td>
							<td width="21%" style="border:none;">Nilai Kerusakan</td>
							<td style="border:none;">: (a) '.number_format($jumlah_nilai_kerusakan*100,2).' %</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">C.</td>
							<td width="21%" style="border:none;">Luas ruangan di Rehab</td>
							<td style="border:none;">: (b) '.$data['ruang']->luas_direhab.' m<sup>2</sup></td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">D.</td>
							<td width="21%" style="border:none;">Harga Satuan Wilayah</td>';
							$data['harga_satuan'] = $this->sekolah->harga_satuan();
							$hasil_rupiah = "Rp " . number_format($data['harga_satuan']->harga_satuan,2,',','.');
							$html=$html.'
							<td style="border:none;">: (c) '.$hasil_rupiah.'</td>
						</tr>
						<tr>
							<td width="4%" style="border:none;">E.</td>
							<td width="21%" style="border:none;">Perkiraan Biaya</td>';
							$hasil = $jumlah_nilai_kerusakan*$data['ruang']->luas_direhab*$data['harga_satuan']->harga_satuan;
							$hasil = round($hasil); 
							$terbilang = $this->terbilang($hasil);
							$hasil_rupiah = "Rp " . number_format($hasil,2,',','.');
							$html=$html.'
							<td style="border:none;">: (a) x (b) x (c)= '.$hasil_rupiah.'</td>
						</tr>
						<tr>
							<td width="25%" style="text-align: right; border: none;">Terbilang</td>';
							if ($hasil) 
							{
								$html=$html.'<td width="75%" style="border:none;">: ( '.$terbilang.' rupiah )</td>';
							}
							else 
							{
								$html=$html.'<td width="75%" style="border:none;">: </td>';
							}
							$html=$html.'
						</tr>
					</table>
					<div style="font-weight: bold; font-size: 11px;"><br>
						Penjelasan Singkat Kondisi Bangunan
						<div style="font-weight: none; font-size: 10px;">';
						if($data['ruang']->penjelasan_singkat)
						{
							$html = $html.''.$data['ruang']->penjelasan_singkat;
						}
						else
						{
							$html = $html.'Tidak ada penjelasan';
						}
						$html = $html.'
						</div>
					</div>
					<table style="border: none;">
						<tr style="border: none;">
							<td style="border: none;" width="70%">
								<div class="bold" style="font-size: 11px;">
									Mengetahui / Menyetujui <br>Kepala Sekolah <br><br><br><br>( '.$data['sekolah']->nama_kepala_sekolah.' )
								</div>
							</td>
							<td style="border: none;">
								<div class="bold" style="font-size: 11px;">
									Sidoarjo, <br>Tim Teknis <br><br><br><br>(__________________)
								</div>
							</td>
						</tr>
					</table>
				</div>
				';
			$pdf->writeHTML($html, true, false, true, false, '');  
       	}
		ob_clean();
		$filename="Analisa_Kerusakan_Komponen_".$data['sekolah']->nama_sekolah.".pdf";
		$pdf->Output($filename, 'I');
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
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

	public function surveyor()
	{
		set_time_limit(100);
		$data['pelaksanaan_survey'] = $this->sekolah->pelaksanaan_survey();
		$no=1;
		// var_dump($data['pelaksanaan_survey']);return;
		// $data['foto_ruang'] = $this->ruang->getFotoRuang($id);
		// $nama_sekolah="sekolah";
		// $nama_ruang="ruang";
		ob_start();
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P', 'F4');
		$html = '<table border="2" width="100%">
			<tr>
				<td width="5%" style="text-align: center; font-weight: bold;">No</td>
				<td width="18%" style="text-align: center; font-weight: bold;">NRP</td>
				<td width="30%" style="text-align: center; font-weight: bold;">Nama Surveyor</td>
				<td width="17%" style="text-align: center; font-weight: bold;">Telepon</td>
				<td width="30%" style="text-align: center; font-weight: bold;">Sekolah yang disurvey</td>
			</tr>';
		foreach($data['pelaksanaan_survey'] as $pelaksanaan)
		{
			$data['surveyor'] = $this->users->getUser($pelaksanaan->petugas);
			$html = $html.'
				<tr>
					<td width="5%" style="text-align: center;">'.$no.'</td>
					<td width="18%" style="text-align: center;">'.$pelaksanaan->petugas.'</td>
					<td width="30%">'.$data['surveyor']->nama_petugas.'</td>
					<td width="17%">'.$data['surveyor']->no_hape_petugas.'</td>
					<td width="30%">'.$pelaksanaan->tempat_pelaksanaan.'</td>
				</tr>';
				$no++;
		}
		$html = $html.'</table>';
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_clean();
		$filename="Foto.pdf";
		$pdf->Output($filename, 'I');
	}
}