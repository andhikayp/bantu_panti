<?php 
    class Donasi extends CI_Model 
    {
        public function lihatDonasiAll()
        {
            $sql = "SELECT * from donasi order by tanggal_donasi desc;"; 
            return $this->db->query($sql)->result();
        }

        public function lihatDonasi($username)
        {
            $sql = "SELECT * from donasi where username_donatur = ? order by tanggal_donasi desc;"; 
            return $this->db->query($sql, array($username))->result(); 
        }

        public function insertDonasi($data = [])
        {
            $dateTime = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $now = $dateTime->format("Y-m-d H:i:s");
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $insert_data = [
                'username_donatur' => $this->session->user_login['username'],
                'nominal_donasi' => $data['nominal_donasi'],
                'keterangan_donasi' => $data['keterangan_donasi'],
                'tanggal_donasi' => $now,
            ];
            try{
                $this->db->insert('donasi', $insert_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }
    }
?>