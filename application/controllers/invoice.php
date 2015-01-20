<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {

        $this->layouts->view('invoices',null,null);
    }

    
}

