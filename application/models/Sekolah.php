<?php 
    class Sekolah extends CI_Model 
    {     
        public function getAll(){ 
            $this->db->select('*');
            $this->db->from('sekolah');        
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getAllsort(){ 
            $this->db->select('*');
            $this->db->from('sekolah');
            $this->db->where('username_update', null);
            $this->db->order_by('nama_sekolah', 'ASC');        
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getSurvey(){ 
            $this->db->select('*');
            $this->db->from('pelaksanaan_survey');       
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getSekolah($id){ 
            $this->db->select('*');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function uploadLayout($id, $data = []){
            if(sizeof($data) <= 0)
            {
                return 0;
            }

            $update_data = [
                'layout_plan1' => $data['layout_plan1'],
                'layout_plan2' => $data['layout_plan2'],
                'layout_plan3' => $data['layout_plan3'],
                'updated_at' => date('Y-m-d'),
                'username_update' => $this->session->user_login['username'],
            ];

            $this->db->where('npsn',$id);
            try{
                $this->db->update('sekolah', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function image1_jpg($id){
            $this->db->select('*');
            $this->db->like('layout_plan1', '.jpg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image2_jpg($id){
            $this->db->select('*');
            $this->db->like('layout_plan2', '.jpg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image3_jpg($id){
            $this->db->select('*');
            $this->db->like('layout_plan3', '.jpg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image1_jpeg($id){
            $this->db->select('*');
            $this->db->like('layout_plan1', '.jpeg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image2_jpeg($id){
            $this->db->select('*');
            $this->db->like('layout_plan2', '.jpeg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image3_jpeg($id){
            $this->db->select('*');
            $this->db->like('layout_plan3', '.jpeg');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image1_png($id){
            $this->db->select('*');
            $this->db->like('layout_plan1', '.png');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image2_png($id){
            $this->db->select('*');
            $this->db->like('layout_plan2', '.png');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function image3_png($id){
            $this->db->select('*');
            $this->db->like('layout_plan3', '.png');
            $this->db->from('sekolah');
            $this->db->where('npsn', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function pelaksanaan_survey()
        {
            $this->db->select('*');
            $this->db->from('pelaksanaan_survey');
            $this->db->order_by('petugas');
            $query = $this->db->get(); 
            return $query->result();
        }

        public function harga_satuan()
        {
            $this->db->select('*');
            $this->db->from('default');
            $query = $this->db->get();
            return $query->first_row();
        }
    } 
?>