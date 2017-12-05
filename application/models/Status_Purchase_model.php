<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Status_Purchase_model extends CI_Model
{
    
    public $nameTable = "status_purcharse";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->nameTable;

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusPurchase');
            
        }

        return null;
    }

    public function getById($statusPurchase)
    {
       $this->db->select('*');
        $this->db->where('id_status', $statusPurchase["id_status"]);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusPurchase')[0];
            
        }

        return null;
    }

    public function getByName($statusPurchase)
    {   
        $this->db->select('*');
        $this->db->like('description_status', $statusPurchase["description_status"]);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('StatusPurchase');
            
        }

        return null;
    }

    public function deleteById($statusPurchase)
    {
        $this->db->where('id_status', $statusPurchase["id_status"]);
        $statement = $this->db->delete($this->nameTable);
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function insert($statusPurchase)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $search = $this->getByName($statusPurchase);

        if(empty($search)){
            unset($statusPurchase["id_status"]);
            if($this->db->insert($this->nameTable, $statusPurchase)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function update($statusPurchase)
    {

        $restException = new RestException( "You already have a record with the same description into database." , RestException::AlreadyExists );

        $search = $this->getByName($statusPurchase);

        if(empty($search)){
            $this->db->where('id_status', $statusPurchase["id_status"]);
            $statement = $this->db->update($this->nameTable, $statusPurchase);
            if($statement){
                return true;
            }else{
                return false;
            }
        }
        
        throw $restException;

    }

    public function saveImg($img)
    {
        unset($img["id_item"]);
        $status = $this->db->insert("item", $img);
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function getImg()
    {
        
        $sql = "SELECT * FROM item";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->result();
            
        }

        return null;
    }


}
