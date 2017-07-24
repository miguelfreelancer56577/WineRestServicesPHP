<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';

class Position_Catalog extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('position_model');
    }

    public function getAll_post()
    {   
        $headerResponse = new HeaderResponse();
        $headerResponse->businessResponse = $this->position_model->getAll();
        $this->sendResponse($headerResponse);
    }

    public function getById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->position_model->getById($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 404;
            $headerResponse->message = "Record not found.";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function getByName_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->position_model->getByName($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 404;
            $headerResponse->message = "Record/s not found.";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function insert_post()
    {
        $headerResponse = new HeaderResponse();
        
        try{
            $response = $this->position_model->insert($this->headerRequest->businessRequest);
            if($response){
                $headerResponse->businessResponse = $response;
            }
        }catch(RestException $e){
            $headerResponse->status = 400;
            $headerResponse->message = $e->getMessage();
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function deleteById()
    {
        
    }
    
}
