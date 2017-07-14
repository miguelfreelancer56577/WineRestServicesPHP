<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");
include APPPATH . '/beans/Position.php';
include APPPATH . '/beans/Status.php';

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

    public function getByDescription($position)
    {
        $sql = "SELECT * FROM position where description_status like '%?%'";

        $query = $this->db->query($sql, $position);  
        
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
        $sql = "insert position(name_position, description_position) values (?,?)";

        $query = $this->db->query($sql, $position);  

        return $query;
    }

    public function changeStatus($status)
    {
        $sql = "update position set id_status = ? where id_position = ?";

        $query = $this->db->query($sql, $position);  

        return $query;
    }

}
