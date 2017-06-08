<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Restservices extends REST_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('pdf_model');
    }

    function user_get()
    {
    	$this->response(array(1,2,3,4,6), 200);
    }
    
}
