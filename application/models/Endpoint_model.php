<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Endpoint_model extends CI_Model
{

    public $nameTable = "endpoint";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ".$this->nameTable." where id_status = 1";

        $query = $this->db->query($sql);  
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Endpoint');
            
        }

        return null;
    }

    public function getById($endpoint)
    {
       $this->db->select('*');
        $this->db->where('id_uri', $endpoint["id_uri"]);
        $query = $this->db->get('endpoint'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Endpoint')[0];
            
        }

        return null;
    }

    public function getByName($endpoint)
    {   
        $this->db->select('*');
        $this->db->like('name_uri', $endpoint["name_uri"]);
        $query = $this->db->get('endpoint'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Endpoint');
            
        }

        return null;
    }

    public function getBySameName($endpoint)
    {   
        $this->db->select('*');
        $this->db->where('name_uri', $endpoint["name_uri"]);
        $query = $this->db->get('endpoint'); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Endpoint');
            
        }

        return null;
    }

    public function insert($endpoint)
    {   
        $restException = new RestException( "This record already exists." , RestException::AlreadyExists );

        $endpoint["name_uri"] = strtolower($endpoint["name_uri"]);

        $search = $this->getByName($endpoint);

        if(empty($search)){
            unset($endpoint["id_uri"]);
            if($this->db->insert('endpoint', $endpoint)){
                return true;
            }
        }
        
        throw $restException;

    }

    public function changeStatus($endpoint)
    {
        $this->db->set('id_status', $endpoint["id_status"]);
        $this->db->where('id_uri', $endpoint["id_uri"]);
        $statement = $this->db->update('endpoint');
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function update($endpoint)
    {

        $restException = new RestException( "You already have a record with the same description into database." , RestException::AlreadyExists );

        $search = $this->getByName($endpoint);

        if(empty($search)){
            $this->db->where('id_uri', $endpoint["id_uri"]);
            $statement = $this->db->update('endpoint', $endpoint);
            if($statement){
                return true;
            }else{
                return false;
            }
        }
        
        throw $restException;

    }

}
