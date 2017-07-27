<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Employee_model extends CI_Model
{

    public $nameTable = "employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function getById($employee)
    {
        $this->db->select('*');
        $this->db->where('id_employee', $employee->id_employee);
        $query = $this->db->get($this->nameTable); 
        
        if($query->num_rows() > 0){

            return $query->custom_result_object('Employee')[0];
            
        }

        return null;

    }
}
