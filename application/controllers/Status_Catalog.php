<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';

class Status_Catalog extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('status_model');
    }

    public function getAll_post()
    {   
        $headerResponse = new HeaderResponse();
        $headerResponse->businessResponse = $this->status_model->getAll();
        $this->sendResponse($headerResponse);
    }

    public function getById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->status_model->getById($this->headerRequest->businessRequest);
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
        
        $response = $this->status_model->getByName($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 404;
            $headerResponse->message = "Record/s not found.";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

}
