<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('pdf_model');
    }

    public function index()
    {
         echo "hello";
    }
    
}
