<?php
    class UsersModel extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }
        public function getUsers()
        {
            $query = $this->db->get('todo');
            return $query->result_array();
        }
        
        public function addUser ($userName, $userPass )
        {
            $data = array(
            'nickname' => $userName // Argument given to the method
            'pass' => $userPass // Argument given to the method
            );
            return $this->db->insert( '_user', $data );
            // produce ' INSERT INTO todo ( title ) VALUES (...) ;'
        }
    }

?>