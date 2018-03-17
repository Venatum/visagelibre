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
		echo password_hash($_POST['inputPassword'], PASSWORD_DEFAULT) . $_POST['inputEmail'];
		$query = $this->db->query($sql, array(md5($_POST['inputPassword']), $_POST['inputEmail']));

		if (empty($query->result_array())) {
			$connection = false;
			print_r($query->result_array());
		} else {
			print_r($tab = $this->setUserByEmail($_POST['inputEmail']));
			$_SESSION['user']['nickname'] = $tab[0]['nickname'];
			$_SESSION['user']['email'] = $tab[0]['email'];
		}

		$connection = true;
		return $connection;
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



	public function getCommentsByPost($idPost){

		$sql = 'SELECT * FROM visagelivre._comment WHERE ref = ?';

		$query = $this->db->query($sql, array($idPost));

		$comments = $this->db->query->result_array();


		return $comments;

	}

}

?>
