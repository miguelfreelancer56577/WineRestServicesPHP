<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class User_model extends CI_Model
{

    public $nameTable = "user";

    public function __construct()
    {
        parent::__construct();
    }

    public function getByToken($user)
    {
        $this->db->select('*');
        $this->db->where('token', $user->token);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('User')[0];
            
        }

        return null;

    }
}
