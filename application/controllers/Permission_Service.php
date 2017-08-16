<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';

class Permission_Service extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('permission_model');
    }

    public function getByIdEmployee_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->permission_model->getByIdEmployee($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 404;
            $headerResponse->message = "Record/s not found.";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function searchByIdCompound_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->permission_model->searchByIdCompound($this->headerRequest->businessRequest);
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
            $response = $this->permission_model->insert($this->headerRequest->businessRequest);
            if($response){
                $headerResponse->businessResponse = $response;
            }
        }catch(RestException $e){
            $headerResponse->status = 403;
            $headerResponse->message = $e->getMessage();
            $headerResponse->businessResponse = false;
        }
        $this->sendResponse($headerResponse);
    }

    public function insertCollection_post()
    {
        $headerResponse = new HeaderResponse();
        
        $collectionPermissions = $this->headerRequest->businessRequest;

        $errors = [];
        $headerResponse->businessResponse = true;
        foreach ($collectionPermissions as $permission) {
            try{
                $response = $this->permission_model->insert($permission);
            }catch(RestException $e){
                $headerResponse->status = 403;
                array_push($errors, $permission);
            }
        }
        if(!empty($errors)){
            $headerResponse->message = "there were many errors to insert.";
            $headerResponse->businessResponse = $errors; 
        }

        $this->sendResponse($headerResponse);
    }
    
    public function deleteById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->permission_model->deleteById($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 403;
            $headerResponse->message = "You had an error to try to delete the record";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }
}
