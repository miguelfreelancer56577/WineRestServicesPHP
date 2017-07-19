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
        $sql = "SELECT * FROM position";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Position');
            
        }

        return null;
    }

    public function getById($position)
    {
        $sql = "SELECT * FROM position where id_position = ?";

        $query = $this->db->query($sql, $position);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Position');
            
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
        $sql = "delete FROM position where id_position = ?";

        $query = $this->db->query($sql, $position);  

        return $query;
    }

    public function insert($position)
    {   
        $positionException = new PositionException( "This record already exists." , PositionException::AlreadyExists );

        $search = $this->getByName($position);

        if(empty($search)){
            unset($position["id_position"]);
            if($this->db->insert('position', $position)){
                return true;
            }
        }
        
        throw $positionException;

    }

    public function changeStatus($status)
    {
        $sql = "update position set id_status = ? where id_position = ?";

        $query = $this->db->query($sql, $position);  

        return $query;
    }

}
