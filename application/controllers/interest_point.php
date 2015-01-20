<?php
class interest_point extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the library
        $this->load->library('googlemaps');
		
		}

	public function index()
	{
	$this->load->view('interest_point');
	}
	}