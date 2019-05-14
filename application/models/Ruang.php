<?php 
    class Ruang extends CI_Model 
    {     
        public function getAll(){ 
            $this->db->select('*');
            $this->db->from('ruang');        
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getRuangSekolah($id){ 
            $this->db->select('*');
            $this->db->from('ruang');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getRuang($id){
            $this->db->select('*');
            $this->db->from('ruang');
            $this->db->where('kode_ruang', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }
// SELECT R.npsn, COUNT(R.npsn), S.nama_sekolah FROM ruang R, sekolah S WHERE R.npsn=S.npsn GROUP BY R.npsn, S.nama_sekolah
        
        public function get_count()
        {
            $this->db->select('count(*) as jumlah, npsn');
            $this->db->from('ruang');
            $this->db->group_by('npsn');
            $query = $this->db->get(); 
            return $query->result();
        }

        // R.npsn, S.nama_sekolah
        // public function get_count()
        // {
        //     $this->db->select('count(*) as jumlah, sekolah.nama_sekolah');
        //     $this->db->from('sekolah');
        //     // $this->db->where('R.npsn=S.npsn');
        //     $this->db->join('ruang', 'sekolah.npsn = ruang.npsn');
        //     $this->db->group_by('ruang.npsn,sekolah.nama_sekolah');
        //     // $this->db->order_by('S.nama_sekolah','ASC');
        //     $query = $this->db->get(); 
        //     return $query->result();
        // }

        public function saveRuang($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }
// SELECT R.npsn, COUNT(R.npsn), S.nama_sekolah FROM ruang R, sekolah S WHERE R.npsn=S.npsn GROUP BY R.npsn, S.nama_sekolah
            $insert_data = [
                'kode_ruang' => $data['kode_ruang'],
                'npsn' => $id,
                'nama_ruang' => $data['nama_ruang'],
                // 'luas_ruang' => $data['luas_ruang'],
                'tipe_bangunan' => $data['tipe_bangunan'],
                'jenis_bangunan' => $data['jenis_bangunan'],
                'rencana_rehab' => $data['rencana_rehab'],
                'tahun_dibangun' => $data['tahun_dibangun'],
                'rehab_ke' => $data['rehab_ke'],
                // 'foto_ruang' => $data['foto_ruang'],
                'created_at' => date('Y-m-d'),
                'username_update' => $this->session->user_login['username'],
            ];
            try{
                $this->db->insert('ruang', $insert_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function saveSurvey($data = [])
        {
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $insert_data = [
                'tempat_pelaksanaan' => $data['tempat_pelaksanaan'],
                'pihak_sekolah' => $data['pihak_sekolah'],
                'tanggal' => $data['tanggal'],
                'jam' => $data['jam'],
                'petugas' => $this->session->user_login['username'],
            ];
            try{
                $this->db->insert('pelaksanaan_survey', $insert_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function userSurvey($data = [])
        {
            $username_data = [
                'username_update' => $this->session->user_login['username'],
            ];
            $this->db->where('nama_sekolah',$data['tempat_pelaksanaan']);
            try{
                $this->db->update('sekolah', $username_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function updateRuang($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $update_data = [
                'nama_ruang' => $data['nama_ruang'],
                // 'luas_ruang' => $data['luas_ruang'],
                'tipe_bangunan' => $data['tipe_bangunan'],
                'jenis_bangunan' => $data['jenis_bangunan'],
                'rencana_rehab' => $data['rencana_rehab'],
                'tahun_dibangun' => $data['tahun_dibangun'],
                'rehab_ke' => $data['rehab_ke'],
                // 'foto_ruang' => $data['foto_ruang'],
                'update_at' => date('Y-m-d'),
                'username_update' => $this->session->user_login['username'],
            ];
            $this->db->where('kode_ruang',$id);
            try{
                $this->db->update('ruang', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function hapusRuang($id){
            $this->db->where('kode_ruang', $id);
            try{
                $this->db->delete('ruang');
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function getFotoRuang($id){
            $this->db->select('*');
            $this->db->from('fotoruang');
            $this->db->where('kode_ruang', $id);
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getFotoRuangById($id){
            $this->db->select('*');
            $this->db->from('fotoruang');
            $this->db->where('kode_foto', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function hapusFoto($id){
            $this->db->where('kode_foto', $id);
            try{
                $this->db->delete('fotoruang');
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function getRuangKondisi($kode_sekolah)
        {
            $this->db->select('*');
            $this->db->from('kondisi');
            $this->db->where('kode_sekolah', $kode_sekolah);
            $query = $this->db->get(); 
            return $query->result();
        }
        // SELECT sekolah.nama_sekolah, sekolah.kecamatan, ruang.npsn, sum(ruang.nilai_kerusakan/100*ruang.luas_direhab*3000000) FROM ruang, sekolah where sekolah.npsn = ruang.npsn GROUP BY npsn, sekolah.nama_sekolah, sekolah.kecamatan ORDER BY sekolah.kecamatan ; 
        public function getHargaTotal()
        {
            $sql = "SELECT sekolah.nama_sekolah, sekolah.kecamatan, ruang.npsn, sum(ruang.nilai_kerusakan/100*ruang.luas_direhab*3000000) as total_anggaran FROM ruang, sekolah where sekolah.npsn = ruang.npsn GROUP BY npsn, sekolah.nama_sekolah, sekolah.kecamatan ORDER BY sekolah.kecamatan" ; 
            return $this->db->query($sql)->result();
        }

        public function getHargaTotalKecamatan()
        {
            $sql = "SELECT sekolah.kecamatan, sum(ruang.nilai_kerusakan/100*ruang.luas_direhab*3000000)AS total_anggaran FROM ruang, sekolah where sekolah.npsn = ruang.npsn GROUP BY sekolah.kecamatan ORDER BY sekolah.kecamatan; " ; 
            return $this->db->query($sql)->result();
        }
    } 
?>