<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/Restservices.php';

class Status_Purchase_Catalog extends Restservices {

    function __construct() {
        parent::__construct();
        $this->load->model('status_purchase_model');
    }

    public function getAll_post()
    {   
        $headerResponse = new HeaderResponse();
        $headerResponse->businessResponse = $this->status_purchase_model->getAll();
        $this->sendResponse($headerResponse);
    }

    public function getById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->status_purchase_model->getById($this->headerRequest->businessRequest);
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
        
        $response = $this->status_purchase_model->getByName($this->headerRequest->businessRequest);
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
            $response = $this->status_purchase_model->insert($this->headerRequest->businessRequest);
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

    public function deleteById_post()
    {
        $headerResponse = new HeaderResponse();
        
        $response = $this->status_purchase_model->deleteById($this->headerRequest->businessRequest);
        if($response){
            $headerResponse->businessResponse = $response;
        }else{
            $headerResponse->status = 403;
            $headerResponse->message = "You had an error to try to delete the record";
            $headerResponse->businessResponse = false;
        }

        $this->sendResponse($headerResponse);
    }

    public function update_post()
    {
        $headerResponse = new HeaderResponse();
        
        try{
            $response = $this->status_purchase_model->update($this->headerRequest->businessRequest);
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

    public function uploadImg_post()
    {

        $count = 0;

        foreach ($this->post() as $img) {
            if($this->status_purchase_model->saveImg($img)){
                $count++;
            }
        }

        $this->sendResponse($count);

    }

    public function getImg_post()
    {

        $this->sendResponse($this->status_purchase_model->getImg());
    }

}
