<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auctions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('messages_model'); //Already autoloaded in Events library
        $this->load->model('User_model', 'users');

        $this->load->model('province');
        $this->load->model('town');
        $this->load->model('asset_type');
        $this->load->model('assssssetsi');
        $this->load->library('googlemaps');
        $this->load->model('duration');
        $this->load->model('auction');
        $this->load->model('ajax_asset');

    }

    public function index() {
    	//echo ' this is a test';
    	//exit;
        $this->layouts->view('auctions_new_home');
    }

}

//End of file auction.php