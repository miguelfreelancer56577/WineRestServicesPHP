<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Permission_model extends CI_Model
{

    public $nameTable = "permission";

    public function __construct()
    {
        parent::__construct();
    }

    public function getByIdEmployee($permission)
    {   
        $this->db->select('*');
        $this->db->where('id_employee', $permission["id_employee"]);
        $query = $this->db->get('permission'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Permission');
            
        }

        return null;
    }

    public function searchByIdCompound($permission)
    {   
        $this->db->select('*');
        $this->db->where('id_uri', $permission["id_uri"]);
        $this->db->where('id_employee', $permission["id_employee"]);
        $query = $this->db->get('permission'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Permission')[0];
            
        }

        return null;
    }

    public function insert($permission)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $search = $this->searchByIdCompound($permission);

        if(empty($search)){
            if($this->db->insert('permission', $permission)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function deleteById($permission)
    {
        $this->db->where('id_uri', $permission["id_uri"]);
        $this->db->where('id_employee', $permission["id_employee"]);
        $statement = $this->db->delete('permission');
        if($statement){
            return true;
        }else{
            return false;
        }
    }

}
