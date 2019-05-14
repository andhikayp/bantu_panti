<?php 
    class Authentikasi extends CI_Model 
    {     
        function check_login($table, $field1, $field2) 
        { 
            $this->db->select('*'); 
            $this->db->from($table); 
            $this->db->where($field1); 
            $this->db->where($field2); 
            $this->db->limit(1); 
            $this->db->join('role_users', $table.'.id_role = role_users.id_role'); 
            $query = $this->db->get(); 
            if ($query->num_rows() == 0)  
            { 
                return FALSE; 
            }  
            else  
            { 
                return $query->first_row(); 
            } 
        }
        function ganti_password($username,$password_baru)
        {
            $this->db->set('password', $password_baru);
            $this->db->where('username', $username);

            if($this->db->update('users_kantor'))
            {
                return true;
            }
            else return false;
        }
    } 
?>