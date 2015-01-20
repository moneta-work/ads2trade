<?php
class save_location_details extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the library
        $this->load->library('googlemaps');
		
		}

	public function index()
	{
	
	$latitude = $_GET['lat'];
    $longitude = $_GET['lng'];
	$asset_type = $_GET['med_type'];
	
	//$asset_data = array (
	//'asset_type' => $asset_type,
	//'latitude' => $latitude,
	//'longitude' => $longitude
	//);
	$assignment_data = array(
	'latitude' => $latitude,
	'longitude' => $longitude,
	'asset_type' => $asset_type
			);
	//var_dump($assignment_data); exit;
	//call the model to save the coordinates in the db including the type of the asset
	//$this->asset->add_asset($latitude,$longitude);
	$this->load->model('ads_asset');
    $this->ads_asset->insertAsset($latitude, $longitude, $asset_type);
	
	//redirect to a function that will go and place that marker on a map 
	
	$this->place_pin($latitude, $longitude, $asset_type);
	
	}
	
	public function place_pin($latitude, $longitude, $asset_type){
	
	//okie dokie, now lets draw a map and place a pin on that location
	
	
	
	
	
	$config['center'] = $latitude. ", ".$longitude;
	$config['asset_type'] = $asset_type;
    $config['zoom'] = '14';
    $config["map_width"] = '60%'; //var_dump ($config);exit;
	//$marker['ondragend'] = 'alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
    //var_dump ($config);exit;
	
	$this->googlemaps->initialize($config);
	//echo $pin_color; exit;
	$marker = array();
    $marker['position'] = $latitude.",". $longitude;
	switch($asset_type){
	case 'bins':
	$marker['icon'] = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
	break;
	case 'billboards':
	$marker['icon'] = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
	break;
	
	case 'street pole':
	$marker['icon'] = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
	break;
	}
    //$marker['setIcon'] = $pin_color;
    $marker['title'] = $asset_type;
	$info_array = array (
	'title' => 'Description : 3m x 10m Billboard',
	'media owner' => 'Media Owner: Primedia',
	'Start Date' => 'Available Starting: 22 March 2014',
	'End Date' => 'Available up to: 22 April 2014', 
	'Partial Availability' => 'Partial Availability : YES'
	);
	$marker['infowindow_content'] = $info_array['title']."<br>".$info_array['media owner']. "<br>" .$info_array['Start Date']. "<br>" . $info_array['End Date']. "<br>" . $info_array['Partial Availability']. "<br>";
	$marker['draggable'] = true;
	
 //var_dump($marker); exit;
    $this->googlemaps->add_marker($marker);
	
    $data['map'] = $this->googlemaps->create_map();
//call the view 
    $this->load->view('drag_marker', array_merge($data, $config));
	
	}
	}