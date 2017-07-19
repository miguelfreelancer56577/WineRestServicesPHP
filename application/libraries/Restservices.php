<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';
include APPPATH . '/beans/HeaderResponse.php';
include APPPATH . '/beans/HeaderRequest.php';
include APPPATH . '/beans/Position.php';
include APPPATH . '/beans/Status.php';
include APPPATH . '/exception/CustomException.php';

class Restservices extends REST_Controller {

	public $headerRequest;

    function __construct() {

        parent::__construct();
        $this->load->model('login_model');

    	$headerResponse = new HeaderResponse();
        $headerResponse->status = 400;
        $headerResponse->message = "You did a bad request.";
        $headerRequest = new HeaderRequest();
        $headerRequest->id_user = $this->post("id_user");
        $headerRequest->token = $this->post("token");
        $headerRequest->businessRequest = $this->post("businessRequest");
        if(!$headerRequest->id_user || !$headerRequest->token){
        	$this->sendResponse($headerResponse);
        }else{
        	if(!$this->login_model->isValidToken($headerRequest->id_user, $headerRequest->token)){
                $headerResponse->status = 401;
                $headerResponse->message = "Your token has expired or someone has started a session in another device.";
                $this->sendResponse($headerResponse);
        	}else{
                $this->headerRequest = $headerRequest;
            }
        } 
    }

    public function sendResponse($headerResponse){
        
        if(property_exists('HeaderResponse', 'businessResponse')){
            $this->response($headerResponse, $headerResponse->status);
        }else{
            $this->response($headerResponse);
        }

    }
    
}
