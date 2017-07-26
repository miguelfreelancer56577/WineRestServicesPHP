<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Country_model extends CI_Model
{

    public $nameTable = "country";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ".$this->nameTable." where id_status = 1";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Country');
            
        }

        return null;
    }

    public function getById($country)
    {
       $this->db->select('*');
        $this->db->where('id_country', $country["id_country"]);
        $query = $this->db->get('country'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Country')[0];
            
        }

        return null;
    }

    public function getByName($country)
    {   
        $this->db->select('*');
        $this->db->like('name_country', $country["name_country"]);
        $query = $this->db->get('country'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Country');
            
        }

        return null;
    }

    public function insert($country)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $search = $this->getByName($country);

        if(empty($search)){
            unset($country["id_country"]);
            if($this->db->insert('country', $country)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function changeStatus($country)
    {
        $this->db->set('id_status', $country["id_status"]);
        $this->db->where('id_country', $country["id_country"]);
        $statement = $this->db->update('country');
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function update($country)
    {

        $restException = new RestException( "You already have a record with the same description into database." , RestException::AlreadyExists );

        $search = $this->getByName($country);

        if(empty($search)){
            $this->db->where('id_country', $country["id_country"]);
            $statement = $this->db->update('country', $country);
            if($statement){
                return true;
            }else{
                return false;
            }
        }
        
        throw $restException;

    }

}
