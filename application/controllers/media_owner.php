<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class media_owner extends CI_Controller {


	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		    
                  //  $message = array('error' => 'You do not have permission to access this page');
			$this->layouts->view('media_owner_dashboard', null);
		}
        }
}