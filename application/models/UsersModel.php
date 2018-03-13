<?php
    class UsersModel extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }
        public function getUser()
        {
            $query = $this->db->get('todo');
            return $query->result_array();
        }
        
        public function todo_add_task ($title )
        {
            $data = array(
            // 'id ' => ??? , // No use because of the serial type and the sequence
            'title' => $title // Argument given to the method
            );
            return $this->db->insert( 'todo', $data );
            // produce ' INSERT INTO todo ( title ) VALUES (...) ;'
        }
    }

?>