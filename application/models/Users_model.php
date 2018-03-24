<?php

class Users_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getUser($userName = null)
	{
		if ($userName == null) {
			$sql = 'SELECT * FROM visagelivre._user;';
			$query = $this->db->query($sql);

		} else {
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

	public function confirmConnect()
	{

		$connection = true;

		$sql = 'SELECT * FROM visagelivre._user WHERE pass = ? AND email = ?';
		$query = $this->db->query($sql, array(md5($_POST['inputPassword']), $_POST['inputEmail']));

		if (empty($query->result_array())) {
			$connection = false;
			$_SESSION['errorSignin'] = true;
		} else {
			$tab = $this->setUserByEmail($_POST['inputEmail']);
			$_SESSION['user']['nickname'] = $tab[0]['nickname'];
			$_SESSION['user']['email'] = $tab[0]['email'];
		}
		$tab = $this->setUserByEmail($_POST['inputEmail']);
		$_SESSION['user']['nickname'] = $tab[0]['nickname'];
		$_SESSION['user']['email'] = $tab[0]['email'];

		return $connection = true;
	}


	public function addUser($userName, $userPass, $userEmail)
	{
		$data = array(
			'nickname' => $userName, // Argument given to the method
			'pass' => md5($userPass), // Argument given to the method
			'email' => $userEmail // Argument given to the method
		);
		return $this->db->insert('_user', $data);
		// produce ' INSERT INTO todo ( title ) VALUES (...) ;'
	}



	public function getPostByUser($nickname){
        $sql = 'SELECT * FROM visagelivre.post WHERE auteur = ? ORDER BY create_date';

        $query = $this->db->query($sql, array($nickname));
        $dataReturned = $query->result_array();
        
        $amis = $this->getFriends($nickname);
        foreach($amis as $ami){
            $sql = 'SELECT * FROM visagelivre.post WHERE auteur = ? ORDER BY create_date';

            $query = $this->db->query($sql, array((($ami['nickname'] == $_SESSION['user']['nickname']) ? $ami['friend'] : $ami['nickname'])));

            $dataReturned = array_merge($dataReturned, $query->result_array());
        }
		return $dataReturned;
	}
    
    
	public function getCommentByIdPost($idPost){

		$sql = 'SELECT * FROM visagelivre.vu_comment WHERE ref = ?;';

		$query = $this->db->query($sql, array($idPost));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
	public function getCommentById($iddoc){

		$sql = 'SELECT * from visagelivre.vu_comment;';

		$query = $this->db->query($sql, array($iddoc));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
    
    
    public function addPost($content, $nickname){

		$sql = 'INSERT INTO visagelivre.post (content, auteur) VALUES (?, ?)';

		$query = $this->db->query($sql, array($content, $nickname));
	}

    
    
    
    public function addComment($content, $nickname, $ref){

		$sql = 'INSERT INTO visagelivre.vu_comment (content, auteur, ref) VALUES (?, ?, ?)';
		$query = $this->db->query($sql, array($content, $nickname, $ref));
	}
    
    
    
    
    
	public function getFriends($nickname){

		$sql = 'SELECT DISTINCT nickname, friend FROM visagelivre._friendof WHERE nickname = ? OR friend = ? ';

		$query = $this->db->query($sql, array($nickname, $nickname));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
       
	public function getFriendsRequestToUser($nickname){

		$sql = 'SELECT * FROM visagelivre._friendrequest WHERE target = ?';

		$query = $this->db->query($sql, array($nickname));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
        
	public function addFriend($nickname, $target){

		$sql = 'INSERT INTO visagelivre._friendrequest (nickname, target) VALUES (?, ?) ';

		$query = $this->db->query($sql, array($nickname, $target));

		
	}
    
    public function deleteFriend($nickname, $friend){

		$sql = 'DELETE FROM visagelivre._friendof WHERE (nickname = ? AND friend = ?) OR (nickname = ? AND friend = ?)';

		$query = $this->db->query($sql, array($nickname, $friend, $nickname, $friend));

		
	}
    
    
         
	public function confirmFriendRequest($nickname, $target){

		$sql = 'DELETE FROM visagelivre._friendrequest WHERE (nickname = ? AND target = ?) OR (nickname = ? AND target = ?); 
                INSERT INTO visagelivre._friendof (nickname, friend) VALUES (?, ?) ';

		$query = $this->db->query($sql, array($nickname, $target, $target, $nickname, $nickname, $target));

	}
    
    
    
    public function denyFriendRequest($nickname, $target){

		$sql = 'DELETE FROM visagelivre._friendrequest WHERE (nickname = ? AND target = ?) OR (nickname = ? AND target = ?);';

		$query = $this->db->query($sql, array($nickname, $target, $target, $nickname));

	}
    
    
    
    
       
	public function getFriendsRequestFromUser($nickname){

		$sql = 'SELECT * FROM visagelivre._friendrequest WHERE nickname = ?';

		$query = $this->db->query($sql, array($nickname));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
    
    
    public function deleteUser($nickname){

		$sql = 'DELETE FROM visagelivre._user WHERE nickname = ?';

		$query = $this->db->query($sql, array($nickname));

		
	}
    
           
	public function getUnknownUser($nickname){

		$sql = 'SELECT visagelivre._user.nickname
					FROM visagelivre._user 
					LEFT JOIN visagelivre._friendof on (visagelivre._user.nickname = visagelivre._friendof.nickname OR visagelivre._user.nickname = visagelivre._friendof.friend)
					LEFT JOIN visagelivre._friendrequest on (visagelivre._friendrequest.nickname = visagelivre._user.nickname OR visagelivre._user.nickname = visagelivre._friendrequest.target)
							EXCEPT (SELECT visagelivre._user.nickname
								FROM visagelivre._user 
								LEFT JOIN visagelivre._friendof on (visagelivre._user.nickname = visagelivre._friendof.nickname OR visagelivre._user.nickname = visagelivre._friendof.friend)
								LEFT JOIN visagelivre._friendrequest on (visagelivre._friendrequest.nickname = visagelivre._user.nickname OR visagelivre._user.nickname = visagelivre._friendrequest.target)
									WHERE target = ? 
										OR visagelivre._user.nickname = ?
										OR visagelivre._friendrequest.nickname = ?
										OR visagelivre._friendof.nickname = ?
										OR friend = ?);';

		$query = $this->db->query($sql, array($nickname, $nickname, $nickname, $nickname, $nickname));

		$dataReturned = $query->result_array();

		return $dataReturned;
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>
