<?php
    class UsersModel extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }
        public function getUser($userName = null)
        {
            if($userName == null){
                $sql = 'SELECT * FROM visagelivre._user;';
                $query = $this->db->query($sql);

            }else{
                $sql = 'SELECT * FROM visagelivre._user WHERE nickname = ?';
                $query = $this->db->query($sql, array($userName));

            }
            return $query->result_array();
        }
        
        public function addUser($userName, $userPass )
        {
            $data = array(
            'nickname' => $userName, // Argument given to the method
            'pass' => $userPass // Argument given to the method
            );
            return $this->db->insert( '_user', $data );
            // produce ' INSERT INTO todo ( title ) VALUES (...) ;'
        }
    }

?>