<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class buy_now extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //get loaded stock by region
        $this->layouts->view('buy_now', null);

    }

    
}