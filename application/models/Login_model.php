<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function toSearchCards($user)
    {

    	$sql = "SELECT * FROM user WHERE name_user = ? AND password = ?";

		$query = $this->db->query($sql, array($user->name_user, $user->password));	
    	
    	if($query->num_rows() > 0){

    		$user->id_user = $query->first_row()->id_user;
    		$user->id_employee = $query->first_row()->id_employee;
    	}

    	return $user;

    }

    public function isValidToken($id_user, $token)
    {

    	$sql = "SELECT * FROM user WHERE id_user = ? and token = ?";

		$query = $this->db->query($sql, array($id_user, $token));	
    	
    	if($query->num_rows() > 0){

    		return true;

    	}

    	return false;

    }

    public function toInsertToken($user){
    	
    	$sql = "update user set token = ? WHERE id_user = ?";

		$query = $this->db->query($sql, array($user->token, $user->id_user));

    }

    public function toInsertLog($user){
    	
    	$sql = "insert log_login(id_user,day_entry) values(?,?)";

		$query = $this->db->query($sql, array($user->id_user, $user->day_entry));

    }
}
