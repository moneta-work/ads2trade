<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->model('user_type_model', 'user_type');
        $this->load->model('country_model', 'country');      
        $this->load->model('user_status_model', 'user_status');
        
    }

    public function index() {
        
        //Lets get what type of list we are dealing with here.
        $list = $this->input->get("list");
        $list = empty($list) ? 'adv' : $list;
        
        //Let us default to status active
        $status = $this->input->get('st');
        $status = empty($status) ? 'active' : $status;
        
        //Now we get the status_id
        $status_id = $this->user->getStatusId($status);
        
        $data = array( 'list' => $list, 'status' => $status);
        
        switch($list) {
            case 'med':
                $user_type_id = 2;
                $user_type = "Media Owners";
            break;
            case 'adv':
                $user_type_id = 1;
                $user_type = "Advertisers";
            break;
            case 'op':
            default:
                $user_type_id = 3;
                $user_type = "Operators";
                $list = 'op';
            break;
        }
        
        $users = $this->user->getFilterUsers(array('status' => $status_id, 'user_type' => $user_type_id));
        $data['title'] = $user_type;
        $data['users'] = $users;
        
        // //Search form assets
        $search_data['country_options'] = $this->country->get_select_options();
        $search_data['user_type_options'] = $this->user_type->get_select_options();
        
        //$search_data['user_status_options'] = $this->user->get_status_options();
        $search_data['user_status_options'] = $this->user_status->getSelectOptions(array('' => ''));
        
        $data['search_data'] = $search_data;
        
        $this->layouts->view("user/list", null, $data);
    }

    public function edit() {

        //Now we update the user entity
        if($this->input->post("update-user")) {
            
            $this->load->library('form_validation');
            
            if( $this->form_validation->run() == false && false) {
                //something is still wrong
                exit("Something is wrong");
            } else {
                
                $user_id = $this->input->post("id");
                $user = $this->user->getById($user_id);
                
                //update all the fields one by one here
                
                $user->use_auction_limit = $this->input->post("use_auction_limit");
                $user->use_increase_limit = $this->input->post("use_increase_limit");
                $user->use_email = $this->input->post("use_email");
                //$user->use_date_updated = date();
                $user->use_status = $this->input->post("use_status");
                $user->use_country = $this->input->post("use_country");
                $user->use_city = $this->input->post("use_city");
                $user->use_street_number = $this->input->post("use_street_number");
                $user->use_mobile_number = $this->input->post("use_mobile_number");
                $user->use_suburb = $this->input->post("use_suburb");
                $user->use_company_name = $this->input->post("use_company_name");
                
                $this->user->saveUser($user);
                
                $this->session->set_flashdata('info', "User updated successfully");

                redirect("user", 'refresh');
            }
        }
        
        
        $id = $this->input->get("id");
        
        $data = array();
        
        $user = $this->user->getDetailedById($id);
        
        $data['user'] = $user;
        
        //Get the form asset thingies
        $data['user_type_options'] = $this->user_type->get_select_options();
        $data['user_status_options'] = $this->user->get_status_options();
        $data['country_options'] = $this->country->get_select_options();
        
        $this->layouts->view("user/edit", null, $data);
    }

}