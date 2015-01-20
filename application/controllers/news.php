<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model', 'news');
    }

    /**
     * Show the active news feeds only??
     */
    public function index() {
        
        $news = $this->news->getFilterNews();
        $data['news'] = $news;
        
        // //Search form assets
        $search_data['suspended_options'] = $this->news->getStatusOptions();
        
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
                
                $news = new stdClass;
                
                //set all the fields one by one here
                $news->title = $this->input->post("title");
                $news->content = $this->input->post("content");
                $news->suspended = $this->input->post("suspended");

                $this->news->saveNews($news);
                
                $this->session->set_flashdata('info', "Newsfeed saved successfully");

                redirect("news", 'refresh');
            }
        }

        $data = array();
        
        //Get the form asset thingies
        $data['suspended_options'] = $this->news->getStatusOptions();
        
        $this->layouts->view("newsfeeds/new", null, $data);
    }

    public function edit() {

        //Now we update the user entity
        if($this->input->post("update-news")) {
            
            $this->load->library('form_validation');
            
            if( $this->form_validation->run() == false && false) {
                //something is still wrong
                exit("Something is wrong");
            } else {
                
                $news_id = $this->input->post("id");
                $news = $this->news->getById($news_id);
                
                //update all the fields one by one here
                $news->title = $this->input->post("title");
                $news->content = $this->input->post("content");
                $news->suspended = $this->input->post("suspended");

                $this->news->saveNews($news);
                
                $this->session->set_flashdata('info', "Newsfeed updated successfully");

                redirect("news", 'refresh');
            }
        }
        
        $id = $this->input->get("id");
        $data = array();
        
        $news = $this->news->getById($id);
        
        $data['news'] = $news;
        
        //Get the form asset thingies
        $data['suspended_options'] = $this->news->getStatusOptions();
        
        $this->layouts->view("newsfeeds/edit", null, $data);
    }

    public function delete($id) {
    
        $newsfeed = $this->news->getById($id);
        
        if(is_null($newsfeed)) { //feed was not found
            $this->session->set_flashdata("warn", "Newsfeed was not found.");
            
            redirect("news", 'refresh');
            return;
        } else if($this->input->post("delete-news")) {
            
            $newsfeed = $this->news->getById($this->input->post('id'));
            
            if ( $this->news->delete($id) == true) {
                $this->session->set_flashdata('info', 'Newsfeed ' . $newsfeed->id . ' was deleted successfullly.');
                
                redirect("news", 'refresh');
            }

        }
        
        //prompt for the deletion of the feed here
        
        $data = array('newsfeed' => $newsfeed);
        
        $this->layouts->view("newsfeeds/delete", null, $data);
    }
    
}