<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';
include APPPATH . '/beans/HeaderResponse.php';
include APPPATH . '/beans/Position.php';
include APPPATH . '/beans/Status.php';
include APPPATH . '/exception/CustomException.php';

class Restservices extends REST_Controller {

	public $businessRequest;

    function __construct() {

        parent::__construct();
        $this->load->model('login_model');

    	$HeaderRequest = null;

    	$token = $this->post("token");

        if(!($this->post("token") || $this->post("id_user"))){
        	$this->response("You did a bad request.", 400);
        }else{
        	if(!$this->login_model->isValidToken($this->post("id_user"), $this->post("token"))){
        		$this->response("Your token has expired or someone has started a session in another device.", 401);
        	}else{
                $this->businessRequest = $this->post("businessRequest");
            }
        } 
    }

    public function sendResponse($headerResponse){
        
        if(property_exists('HeaderResponse', 'businessRequest')){
            $this->response($headerResponse, $headerResponse->status);
        }else{
            $this->response($headerResponse);
        }

    }
    
}
