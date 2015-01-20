<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class campaign extends CI_Controller {

    public function __construct() {
        parent::__construct();
		//For logging entries to the system events module
		//$this->load->model('sysevents_model', 'sysevents');
    }

    public function index() {
        //if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('new_campaign/campaigns');
        //}
    }

}