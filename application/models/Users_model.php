<?php
    class Users_model extends CI_Model{
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
        
        public function confirmConnect(){
            
            $connection = true;
            
            $sql = 'SELECT * FROM _user WHERE pass = AND email = ?';
            
            $query = $this->db->query($sql, array(password_hash($_POST['inputPassword']), $_POST['inputEmail']));

            if(empty($query->result_array()))
                $connection = false;
            
            
            return $connection;
        }
        
        
        
        public function addUser($userName, $userPass )
        {
            $data = array(
            'nickname' => $userName, // Argument given to the method
            'pass' => $this->hash_password($userPass) // Argument given to the method
            );
            return $this->db->insert( '_user', $data );
            // produce ' INSERT INTO todo ( title ) VALUES (...) ;'
        }
    }

?>