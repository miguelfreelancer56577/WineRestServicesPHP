<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Position_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM position where id_status = 1";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Position');
            
        }

        return null;
    }

    public function getById($position)
    {
       $this->db->select('*');
        $this->db->where('id_position', $position["id_position"]);
        $query = $this->db->get('position'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Position')[0];
            
        }

        return null;
    }

    public function getByName($position)
    {   
        $this->db->select('*');
        $this->db->like('name_position', $position["name_position"]);
        $query = $this->db->get('position'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Position');
            
        }

        return null;
    }

    public function deleteById($position)
    {
        $this->db->where('id_position', $position["id_position"]);
        $statement = $this->db->delete('position');
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function insert($position)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $search = $this->getByName($position);

        if(empty($search)){
            unset($position["id_position"]);
            if($this->db->insert('position', $position)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function changeStatus($position)
    {
        $this->db->set('id_status', $position["id_status"]);
        $this->db->where('id_position', $position["id_position"]);
        $statement = $this->db->update('position');
        if($statement){
            return true;
        }else{
            return false;
        }
    }

}
