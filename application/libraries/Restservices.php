<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/beans/User.php';
include APPPATH . '/beans/HeaderResponse.php';
include APPPATH . '/beans/HeaderRequest.php';
include APPPATH . '/beans/Position.php';
include APPPATH . '/beans/Status.php';
include APPPATH . '/beans/StatusEmployee.php';
include APPPATH . '/beans/Country.php';
include APPPATH . '/beans/StatusPurchase.php';
include APPPATH . '/beans/Endpoint.php';
include APPPATH . '/beans/Permission.php';
include APPPATH . '/beans/Employee.php';
include APPPATH . '/beans/InfoUser.php';
include APPPATH . '/exception/CustomException.php';

class Restservices extends REST_Controller {

	public $headerRequest;
    public $infoUser;

    function __construct() {

        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('employee_model');
        $this->load->model('permission_model');

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
                $user = new User();
                $employee = new Employee();
                $infoUser = new InfoUser();
                $user->token = $this->post('token');
                $user  = $this->user_model->getByToken($user);
                $employee->id_employee = $user->id_employee;
                $employee  = $this->employee_model->getById($employee);
                $infoUser->user = $user;            
                $infoUser->employee = $employee;
                $this->infoUser = $infoUser;
            }          
        } 
    }

    public function sendResponse($headerResponse){
            if(property_exists('HeaderResponse', 'businessResponse')){
                $isLog = empty($this->infoUser->employee->id_employee);
                if($isLog){
                    $this->response($headerResponse, $headerResponse->status);
                }else{
                    if($this->permission_model->hasAccess(uri_string(),$this->infoUser->employee->id_employee)){
                        $this->response($headerResponse, $headerResponse->status);
                    }else{
                        $headerResponse = new HeaderResponse();
                        $headerResponse->status = 405;
                        $headerResponse->message = "You don't have access to this method.";
                        $this->response($headerResponse, $headerResponse->status);
                    }
                }
            }else{
                $this->response($headerResponse);
            }
    }
    
}
