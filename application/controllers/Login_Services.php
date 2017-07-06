<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';
include APPPATH . '/beans/HeaderResponse.php';

class Login_Services extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function login_post()
    {	

    	$user = new User();
        $headerResponse = new HeaderResponse();

    	$user->name_user = $this->post('user');
		$user->password = $this->post('pass');  	

    	$user  = $this->login_model->toSearchCards($user);

    	if($user->id_user){
    		$user->generateToken();
    		$this->login_model->toInsertToken($user);
    		$this->login_model->toInsertLog($user);
			$headerResponse->businessRequest = $user;
			$this->response($headerResponse, $headerResponse->status);
    	}else{
    		$headerResponse->status = 401;
			$headerResponse->message = "Your user or password are incorrect.";
			$this->response($headerResponse, $headerResponse->status);
    	}

    	
    }
    
}
