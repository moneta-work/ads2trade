<?php
class search_radius extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the library
        $this->load->library('googlemaps');
		
		}

	public function index()
	{
		
 $intrest_data['radius'] = $_POST['radius'];
 $intrest_data['latitude'] = $_POST['latitude'];
 $intrest_data['longitude'] = $_POST['longitude'];
 //var_dump($intrest_data); exit;
 $this->load->view('proximity_search', $intrest_data);
 }
 }