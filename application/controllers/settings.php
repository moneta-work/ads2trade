<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('rfps');
        $this->load->model('User_model', 'users');
    }

    public function index() {

        $data = array();

        $data['user_id'] =  $this->session->userdata('user_id');
        $data['user_type'] =  $this->session->userdata('user_type');

        //echo $view;
        $this->layouts->view('settings', null, $data);
    }

}

