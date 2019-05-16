<?php 
    class Kegiatan extends CI_Model 
    {     
        public function insertKegiatan($data = [])
        {
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $insert_data = [
                'nama_kegiatan' => $data['nama_kegiatan'],
                'deskripsi_kegiatan' => $data['deskripsi_kegiatan'],
                'tanggal_dibuat' => date('Y-m-d'),
                'pembuat' => $this->session->user_login['username'],
            ];
            try{
                $this->db->insert('kegiatan', $insert_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function lihatKegiatan()
        {
            $sql = "SELECT * from kegiatan;"; 
            return $this->db->query($sql)->result();
        }
    }
?>