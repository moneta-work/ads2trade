<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class navigate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('province');
        $this->load->model('town');
        $this->load->model('asset_type');
        $this->load->model('assssssetsi');
        $this->load->library('googlemaps');
        $this->load->model('duration');
        $this->load->model('auction');
        
    }

    public function index() {
      $user_type = $this->session->userdata('user_type'); 
       switch ($user_type) {

                case 1://advertiser login   
                $this->layouts->view('index', null);
               // $this->layouts->view('advertiser_dashboard', null);
                    break;
                case 2:       
               // $this->layouts->view('media_owner_dashboard', null);
                    $this->layouts->view('index_media', null);
                  break;
               case 3:
               // $this->layouts->view('operator_dashboard', null);
                   $this->layouts->view('index_operator', null);
                  break;
       }
       
       }
       
       
      public function auction() {
      $user_type = $this->session->userdata('user_type'); 
       switch ($user_type) {

                case 1://advertiser login   
                $this->layouts->view('auction_dashboard', null);
                    break;
                case 2:       
                $this->layouts->view('auction_media', null);
                  break;
               case 3:       
                $this->layouts->view('index', null);
                  break;
                
       }
       
       }  
       public function invoice_list() {
       
        $this->layouts->view('invoice_list', null);
       }
        
        public function check() {
       
        $this->layouts->view('check', null);
       } 
       
      public function new_campaign() {
      $user_type = $this->session->userdata('user_type'); 
       
        $this->layouts->view('new_campaign', null);
       }  

}