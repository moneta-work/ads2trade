<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
		//For logging entries to the system events module
		//$this->load->model('sysevents_model', 'sysevents');
    }

    public function index() {
        if (!isset($is_logged_in) || $is_logged_in != true) {

            //  $message = array('error' => 'You do not have permission to access this page');
            $this->load->view('login', null);
            //redirect('../');
            //redirect(base_url());exit;
        }
    }
  /*
	private function log_event($user, $object_id, $event_date, $event_datails){
		$event = new stdClass;
		$event->event_type = 5; //User related event
		$event->event_user = $user;
		$event->event_object_id = $object_id; //same as event user in this case but differs in other modules
		$event->event_date = $event_date;
		$event->event_details = $event_datails;
		$this->sysevents->save($event);		
	}
	 */
    public function logout() {
		
		//Log this event to system events
		//log_event($this->session->userdata('user_id'), $this->session->userdata('user_id'), date('Y-m-d H:j:s'), "User logged out successfully");
		
		$this->events->log_event($this->session->userdata('user_id'), $this->session->userdata('user_id'), date('Y-m-d H:j:s'), "User logged out successfully");
		
        $this->session->unset_userdata('all_session_data');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('school_id');
        $this->session->unset_userdata('user_type');
        $this->session->sess_destroy();
        redirect('../');
        //$this->load->view('login', null);
    }

    public function validate_credentials() {

        $this->load->model('user');
        $result = $this->user->getLoginDetails();


        if ($result) {//if the user credentials are valid
            //GET USER TYPE
            //echo 'baba'; exit;
            $user_type = $result[0]->ust_id;


            //temporary code to implement ACL
            switch ($user_type) {

                case 1://advertiser login

                    $user_session_data = array(
                        'username' => $this->input->post('username'),
                        'is_logged_in' => TRUE,
                        'user_id' => $result[0]->use_id,
                        'user_type' => $result[0]->ust_id,
                        'user_photo' => $result[0]->use_photo
                    );

                    $user_type = $this->session->userdata('user_type');

                    $all_session_data = array_merge($user_session_data, $result);
                    $this->session->set_userdata($all_session_data);
                    $user_id = $this->session->userdata('user_id');
                    $user_id = $this->session->userdata('user_id');
                    //Log this event to system events
					$this->events->log_event($user_id, $user_id, date('Y-m-d H:j:s'), "Advertiser ". $this->input->post('username'). " logged in successfully");
					$this->layouts->view('index', null);
                    break;
                case 2://media owner login
                    $user_session_data = array(
                        'username' => $this->input->post('username'),
                        'is_logged_in' => TRUE,
                        'user_id' => $result[0]->use_id,
                        //'school_id' => $result[0]->sch_id,
                        'user_type' => $result[0]->ust_id,
                        'user_photo' => $result[0]->use_photo
                    );

                    $user_type = $this->session->userdata('user_type');

                    $all_session_data = array_merge($user_session_data, $result);
                    //echo '<pre>',print_r($all_session_data),'</pre>';exit;
                    $this->session->set_userdata($all_session_data);

                    $user_id = $this->session->userdata('user_id');

                    //echo  "this is the student login"; exit;
                    $user_id = $this->session->userdata('user_id');
                    //echo $user_id;exit();

					//Log this event to system events
					$this->events->log_event($user_id, $user_id, date('Y-m-d H:j:s'), "Media Owner ". $this->input->post('username'). " logged in successfully");
					
                   // $this->layouts->view('media_owner_dashboard', null);
                    $this->layouts->view('index_media', null);

                    break;
               

                case 3://operator login

                    $user_session_data = array(
                        'username' => $this->input->post('username'),
                        'is_logged_in' => TRUE,
                        'user_id' => $result[0]->use_id,
                        //'school_id' => $result[0]->sch_id,
                        'user_type' => $result[0]->ust_id,
                        'user_photo' => $result[0]->use_photo
                    );

                    $user_type = $this->session->userdata('user_type');

                    $all_session_data = array_merge($user_session_data, $result);
                    //echo '<pre>',print_r($all_session_data),'</pre>';exit;
                    $this->session->set_userdata($all_session_data);

                    $user_id = $this->session->userdata('user_id');

                    //echo  "this is the student login"; exit;
                    $user_id = $this->session->userdata('user_id');
                    //echo $user_id;exit();

					//Log this event to system events
					$this->events->log_event($this, $user_id, $user_id, date('Y-m-d H:j:s'), "Operator ". $this->input->post('username'). " logged in successfully");
					
                   // $this->layouts->view('operator_dashboard', null);
                    $this->layouts->view('index_operator', null);
                    break;
               

                default:

					//Log this event to system events
					$this->events->log_event($user_id, $user_id, date('Y-m-d H:j:s'), "Unknown user  ". $this->input->post('username'). " failed to login: " . htmlspecialchars(var_dump($result)));
					
                    $this->session->unset_userdata('all_session_data');
                    redirect(base_url());
                    break;
            }
        } else {

            //exit;
            // $message = array('error' => 'You do not have permission to access this page');

            redirect(base_url());
        }
    }
    

    public function register_user() {
        $this->load->view('register_user');
    }

    public function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            $message = array('error' => 'You do not have permission to access this page');
            $this->load->view('login', null);
        }
    }

}