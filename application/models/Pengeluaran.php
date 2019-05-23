<?php 
    class Pengeluaran extends CI_Model 
    {     
        public function lihatPengeluaran()
        {
            $sql = "SELECT * from donasi order by tanggal_donasi desc;"; 
            return $this->db->query($sql)->result();
        }

        public function insertPengeluaran($data = [])
        {
            $dateTime = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $now = $dateTime->format("Y-m-d H:i:s");
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $insert_data = [
                // 'username_donatur' => $this->session->user_login['username'],
                'nominal_pengeluaran' => $data['nominal_pengeluaran'],
                'keterangan_pengeluaran' => $data['keterangan_pengeluaran'],
                'tanggal_pengeluaran' => $now,
                'username_update' => $this->session->user_login['username'],
            ];
            try{
                $this->db->insert('pengeluaran', $insert_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }
    }
?>