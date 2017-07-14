<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';
include APPPATH . '/beans/HeaderResponse.php';

class Position_Catalog extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('position_model');
    }

    public function getAll_post()
    {   
        $headerResponse = new HeaderResponse();
        $headerResponse->businessRequest = $this->position_model->getAll();
        $this->sendResponse($headerResponse);
    }

    public function getById_post()
    {
        
    }

    public function getByName_post()
    {
        
    }

    public function insert()
    {
        
    }

    public function deleteById()
    {
        
    }
    
}
