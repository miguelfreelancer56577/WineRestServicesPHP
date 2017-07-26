<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Status_Employee_model extends CI_Model
{

    public $nameTable = "status_employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ".$this->nameTable."";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusEmployee');
            
        }

        return null;
    }

    public function getById($statusEmployee)
    {
       $this->db->select('*');
        $this->db->where('id_status', $statusEmployee["id_status"]);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusEmployee')[0];
            
        }

        return null;
    }

    public function getByName($statusEmployee)
    {   
        $this->db->select('*');
        $this->db->like('name_status', $statusEmployee["name_status"]);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusEmployee');
            
        }

        return null;
    }

    public function deleteById($statusEmployee)
    {
        $this->db->where('id_status', $statusEmployee["id_status"]);
        $statement = $this->db->delete($this->nameTable);
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function insert($statusEmployee)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $search = $this->getByName($statusEmployee);

        if(empty($search)){
            unset($statusEmployee["id_status"]);
            if($this->db->insert($this->nameTable, $statusEmployee)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function update($statusEmployee)
    {

        $restException = new RestException( "You already have a record with the same description into database." , RestException::AlreadyExists );

        $search = $this->getByName($statusEmployee);

        if(empty($search)){
            $this->db->where('id_status', $statusEmployee["id_status"]);
            $statement = $this->db->update($this->nameTable, $statusEmployee);
            if($statement){
                return true;
            }else{
                return false;
            }
        }
        
        throw $restException;

    }

}
