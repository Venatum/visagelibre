<?php
    class Users_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
            $this->nickname = null;
            $this->pass = null;
            $this->email = null;
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
         public function setUserByEmail($email)
        {
            $sql = 'SELECT nickname, email FROM visagelivre._user WHERE email = ?';
            $query = $this->db->query($sql, array($email));

            return $query->result_array();
        }
        public function confirmConnect(){
            
            $connection = true;
            
            $sql = 'SELECT * FROM visagelivre._user WHERE pass = ? AND email = ?';
            echo $_POST['inputPassword'].$_POST['inputEmail'];
            $query = $this->db->query($sql, array(password_hash($_POST['inputPassword'], PASSWORD_DEFAULT), $_POST['inputEmail']));

            if(empty($query->result_array()))
                $connection = false;
            else{
                $tab = setUserByEmail();
                $this->nickname = $tab[1];
                $this->email = $tab[0];
            }
            
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