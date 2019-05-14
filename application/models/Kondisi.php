<?php 
    class Kondisi extends CI_Model 
    {     
        public function getAll(){ 
            $this->db->select('*');
            $this->db->from('kondisi');
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getKondisi($id){
            $this->db->select('*');
            $this->db->from('kondisi');
            $this->db->where('kode_ruang', $id);
            $this->db->order_by('id', 'asc');
            $query = $this->db->get(); 
            return $query->result();
        }

        public function updateKesimpulan($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }

            $update_data = [
                'jenis_perawatan' => $data['jenis_perawatan'],
                'nilai_kerusakan' => $data['nilai_kerusakan'],
                'luas_direhab' => $data['luas_direhab'],
                'harga_satuan' => $data['harga_satuan'],
                'perkiraan_biaya' => $data['perkiraan_biaya'],
                'penjelasan_singkat' => $data['penjelasan_singkat'],
                'update_at' => date('Y-m-d'),
                'username_update' => $this->session->user_login['username'],
            ];

            $this->db->where('kode_ruang',$id);
            try{
                $this->db->update('ruang', $update_data);
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        public function cekKondisiSama($id, $kode_komponen)
        {
            $this->db->select('*');
            $this->db->from('kondisi');
            $this->db->where('kode_ruang', $id);
            $this->db->where('kode_komponen', $kode_komponen);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function getSumtsb($id)
        {
            $this->db->select('sum(ts_bangunan) as jumlah');
            $this->db->from('kondisi');
            $this->db->where('kode_ruang', $id);
            $query = $this->db->get(); 
            return $query->result();
        }
    }
?>