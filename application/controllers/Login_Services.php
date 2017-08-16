<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';
include APPPATH . '/beans/Employee.php';
include APPPATH . '/beans/InfoUser.php';
include APPPATH . '/beans/HeaderResponse.php';

class Login_Services extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('employee_model');
    }

    public function login_post()
    {	

    	$user = new User();
        $employee = new Employee();
        $infoUser = new InfoUser();
        $headerResponse = new HeaderResponse();

    	$user->name_user = $this->post('name_user');
		$user->password = $this->post('password');  	

    	$user  = $this->login_model->toSearchCards($user);

    	if($user->id_user){
    		$user->generateToken();
    		$this->login_model->toInsertToken($user);
    		$this->login_model->toInsertLog($user);
            $employee->id_employee = $user->id_employee;
            $employee  = $this->employee_model->getById($employee);
            $infoUser->user = $user;            
            $infoUser->employee = $employee;
			$headerResponse->businessResponse = $infoUser;
			$this->response($headerResponse, $headerResponse->status);
    	}else{
    		$headerResponse->status = 406;
			$headerResponse->message = "Your user or password are incorrect.";
			$this->response($headerResponse, $headerResponse->status);
    	}

    	
    }
    
}
