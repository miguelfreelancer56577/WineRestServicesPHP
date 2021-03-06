<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';

class Endpoint_Service extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('endpoint_model');
    }

    public function getAll_post()
    {   
        $headerResponse = new HeaderResponse();
        $headerResponse->businessResponse = $this->endpoint_model->getAll();
        $this->sendResponse($headerResponse);
    }

    public function getById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->endpoint_model->getById($this->headerRequest->businessRequest);
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
        
        $response = $this->endpoint_model->getByName($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 404;
            $headerResponse->message = "Record/s not found.";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function getBySameName_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->endpoint_model->getBySameName($this->headerRequest->businessRequest);
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
            $response = $this->endpoint_model->insert($this->headerRequest->businessRequest);
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
    
    public function changeStatus_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->endpoint_model->changeStatus($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 400;
            $headerResponse->message = "You had an error to try to change the status";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function update_post()
    {
        $headerResponse = new HeaderResponse();
        
        try{
            $response = $this->endpoint_model->update($this->headerRequest->businessRequest);
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
}
