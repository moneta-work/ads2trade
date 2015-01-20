<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsfeed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('newsfeed_model', 'newsfeed');
        $this->load->model('user_type_model', 'user_type');
    }

    /**
     * Show the active news feeds only??
     */
    public function index() {
        
        $newsfeeds = $this->newsfeed->getFilterNews();
        $data['newsfeeds'] = $newsfeeds;
        
        // //Search form assets
        $search_data['suspended_options'] = $this->newsfeed->getStatusOptions();
        
        $data['search_data'] = $search_data;
        
        $this->layouts->view("newsfeeds/list", null, $data);
    }

    public function create() {

        //Now we update the user entity
        if($this->input->post("create-news")) {
            
            $this->load->library('form_validation');
            
            if( $this->form_validation->run() == false && false) {
                //something is still wrong
                exit("Something is wrong");
            } else {
                
                $newsfeed = new stdClass;
                
                //set all the fields one by one here
                $newsfeed->title = $this->input->post("title");
                $newsfeed->content = $this->input->post("content");
                $newsfeed->suspended = $this->input->post("suspended");
                $newsfeed->news_date = $this->input->post("news_date"); //desired format: date('Y-m-d h:m:s');

                //The user types that have access.
                $user_types = $this->input->post('user_type');
                
                //Save the news feed
                $this->newsfeed->saveNewsfeed($newsfeed);
                $news_id = $this->db->insert_id();
                
                $this->newsfeed->saveNewsAccess($news_id, $user_types);
                
                $this->session->set_flashdata('info', "Newsfeed created successfully");

                redirect("newsfeed", 'refresh');
            }
        }

        $data = array();
        
        //Get the form asset thingies
        $data['suspended_options'] = $this->newsfeed->getStatusOptions();
        $data['user_type_options'] = $this->user_type->getSelectOptions();
        
        $this->layouts->view("newsfeeds/new", null, $data);
    }

    public function edit($id) {

        //Now we update the user entity
        if($this->input->post("update-news")) {
            
            $this->load->library('form_validation');
            
            if( $this->form_validation->run() == false && false) {
                //something is still wrong
                exit("Something is wrong");
            } else {
                
                $news_id = $this->input->post("id");
                $newsfeed = $this->newsfeed->getById($news_id);
                
                $news = new stdClass;
                
                //update all the fields one by one here
                $news->title = $this->input->post("title");
                $news->content = $this->input->post("content");
                $news->suspended = $this->input->post("suspended");
                $newsfeed->news_date = $this->input->post("news_date"); //desired format: date('Y-m-d h:m:s');

                $this->newsfeed->saveNewsfeed($newsfeed);
                
                 //Save the news feed
                $this->newsfeed->saveNewsfeed($newsfeed);
                
                //Save the dependencies.
                //The user types that have access.
                $user_types = $this->input->post('user_type');
                $this->newsfeed->saveNewsAccess($newsfeed->id, $user_types);
                $this->session->set_flashdata('info', "Newsfeed updated successfully");

                redirect("newsfeed", 'refresh');
            }
        }
        
        $data = array();
        
        $newsfeed = $this->newsfeed->getById($id);
        
        $data['newsfeed'] = $newsfeed;
        
        //Get the form asset thingies
        $data['suspended_options'] = $this->newsfeed->getStatusOptions();
        $data['user_type_options'] = $this->user_type->getSelectOptions();
        
        $data['news_user_types'] = $this->newsfeed->getUserTypeIdbyNewsId($newsfeed->id);
        
        $this->layouts->view("newsfeeds/edit", null, $data);
    }

    public function delete($id) {
    
        $newsfeed = $this->newsfeed->getById($id);
        
        if(is_null($newsfeed)) { //feed was not found
            $this->session->set_flashdata("warn", "Newsfeed was not found.");
            
            redirect("newsfeed", 'refresh');
            return;
        } else if($this->input->post("delete-news")) {
            
            $newsfeed = $this->newsfeed->getById($this->input->post('id'));
            
            if ( $this->newsfeed->delete($id) == true) {
                $this->session->set_flashdata('info', 'Newsfeed ' . $newsfeed->id . ' was deleted successfullly.');
                
                redirect("newsfeed", 'refresh');
            }

        }
        
        //prompt for the deletion of the feed here
        
        $data = array('newsfeed' => $newsfeed);
        
        $this->layouts->view("newsfeeds/delete", null, $data);
    }
    
}