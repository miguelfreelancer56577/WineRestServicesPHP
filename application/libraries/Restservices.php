<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';

class Restservices extends REST_Controller {

	public $header_request;

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
        	}
        } 
    }
    
}
