<?php 
    class Users extends CI_Model{

        public function getAllDonatur()
        { 
            $sql = "SELECT * from users_kantor where id_role = '3';"; 
            return $this->db->query($sql)->result();
        }

        public function getAllAnakPanti()
        { 
            $sql = "SELECT * from users_kantor where id_role = '4';"; 
            return $this->db->query($sql)->result();
        }

        public function dptUsers(){ 
            $this->db->select('*');
            $this->db->from('users_kantor');
            $query = $this->db->get();
            return $query->result();
        }

        public function getUser($id)
        { 
            $sql = "SELECT * from users_kantor where username = ? ;"; 
            return $this->db->query($sql, array($id))->first_row();
        }

        public function get_survey($id){ 
            $this->db->select('*');
            $this->db->from('pelaksanaan_survey');
            $this->db->where('id', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function createUserDonatur($username, $password)
        {
            $insert_data = [
                'username' => $username,
                'password' => $password,
                'salt' => 'jaDzqvi93kHFY',
                'id_role' => 3,
                'created_on' => date('Y-m-d'),
            ];
            try
            {
                $this->db->insert('users_kantor', $insert_data);
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }

        public function createUserAnakPanti($username, $password)
        {
            $insert_data = [
                'username' => $username,
                'password' => $password,
                'salt' => 'jaDzqvi93kHFY',
                'id_role' => 4,
                'created_on' => date('Y-m-d'),
            ];
            try
            {
                $this->db->insert('users_kantor', $insert_data);
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }

        public function updateProfil($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }

            $update_data = [
                'nama_petugas' => $data['nama_petugas'],
                'email_petugas' => $data['email_petugas'],
                'no_hape_petugas' => $data['no_hape_petugas'],
                'alamat_petugas' => $data['alamat_petugas'],
                'update_at' => date('Y-m-d'),
            ];

            $this->db->where('username',$id);
            try{
                $this->db->update('users_kantor', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function updateSurvey($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $update_data = [
                'tempat_pelaksanaan' => $data['tempat_pelaksanaan'],
                'pihak_sekolah' => $data['pihak_sekolah'],
                'jam' => $data['jam'],
                'tanggal' => $data['tanggal'],
                'petugas' => $this->session->user_login['username'],
            ];

            $this->db->where('id',$id);
            try{
                $this->db->update('pelaksanaan_survey', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function resetPass($username,$password)
        {
            $this->db->set('password', $password);
            $this->db->where('username', $username);
            if($this->db->update('users_kantor'))
            {
                return true;
            }
            else return false;
        }

        public function delUser($username)
        {
            $this->db->where('username', $username);
            try
            {
                $this->db->delete('users_kantor');
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }

        public function delsurvey($username){
            $this->db->where('id', $username);
            try{
                $this->db->delete('pelaksanaan_survey');
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function get_profil_panti($id)
        {
            $sql = "SELECT * from profil_panti where id = ? ;"; 
            return $this->db->query($sql, array($id))->first_row();
        }

        public function updateProfilPanti($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }
            $update_data = [
                'nama_panti' => $data['nama_panti'],
                'alamat_panti' => $data['alamat_panti'],
                'no_telp_panti' => $data['no_telp_panti'],
                'deskripsi_panti' => $data['deskripsi_panti'],
                'visi' => $data['visi'],
                'misi' => $data['misi'],
                'no_rekening_bank' => $data['no_rekening_bank'],
                'nama_bank' => $data['nama_bank'],
                'nama_ketua_panti' => $data['nama_ketua_panti'],
            ];

            $this->db->where('id',$id);
            try{
                $this->db->update('profil_panti', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }
    }
?>   