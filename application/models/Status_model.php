<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Status_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM status";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Status');
            
        }

        return null;
    }

    public function getById($status)
    {
       $this->db->select('*');
        $this->db->where('id_status', $status["id_status"]);
        $query = $this->db->get('status'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Status')[0];
            
        }

        return null;
    }

    public function getByName($status)
    {   
        $this->db->select('*');
        $this->db->like('description_status', $status["description_status"]);
        $query = $this->db->get('status'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Status');
            
        }

        return null;
    }

}
