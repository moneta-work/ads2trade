<?php
class simple_marker extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the library
        $this->load->library('googlemaps');
		
		}

	public function index()
	{
		
//customize the map here
$confiq["map_width"] = '60%';
// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
$this->googlemaps->initialize($confiq);
// Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
// placed where we want the map to appear.
$data['map'] = $this->googlemaps->create_map();
// Load our view, passing the map data that has just been created
$this->load->view('simple_marker', $data);
	}
public function center_map(){

$center_position = $_POST['latitude']. ", ".$_POST['longitude'];
//customize the map here
$confiq["map_width"] = '60%'; 
$confiq["center"] = $center_position;//print_r($confiq);exit;
// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
$this->googlemaps->initialize($confiq);
// Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
// placed where we want the map to appear.
$data['map'] = $this->googlemaps->create_map();
// Load our view, passing the map data that has just been created
$this->load->view('ours', $data);


}

public function media_type(){

$this->load->view('media_type', NULL, NULL);

}

public function media_types(){

$config['media_type'] = $_POST['med_type'];
$config['center'] = '-26.07387, 28.01199';
$config['zoom'] = 'auto';
$config["map_width"] = '60%'; 
$config['onclick'] = 'createMarker_map({ map: map, position:event.latLng }),getMarkerPosition(event.latLng.lat(), event.latLng.lng());';
$this->googlemaps->initialize($config);
$data['map'] = $this->googlemaps->create_map();
$this->load->view('media_types',$data);
}

public function drop_markers(){
$media_type = $_POST['media_type'];//get media type from previous screen
$config['media_type'] = $media_type;
$config['center'] = '-26.07387, 28.01199';
$config['zoom'] = 'auto';
$config["map_width"] = '60%'; 
$config['onclick'] = 'createMarker_map({ map: map, position:event.latLng }),getMarkerPosition(event.latLng.lat(), event.latLng.lng());';
//print_r($config['onclick'] ); die();
$this->googlemaps->initialize($config);
$data['map'] = $this->googlemaps->create_map();

$this->load->view('simple_marker', $data);

}
public function cluster_management(){

$config['center'] = '-26.07387, 28.01199';//'37.4419, -122.1419';
$config['zoom'] = 'auto';
$config["map_width"] = '60%'; 
$config['cluster'] = TRUE;
$this->googlemaps->initialize($config);

$marker = array();
$marker['position'] = '-26.08677, 28.01199';//'37.429, -122.1419';
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '-31.08677, 28.01199';//'32.429, -112.1419';5.0129
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '-31.08477, 28.01199';;
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '-26.07187, 28.01199';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();

$this->load->view('cluster_resolution', $data);

}
public function search_location(){

//get all the pin positions from our ads_asset table


$this->load->view('search_location');
}
public function radius_search(){
//aha takuzviita zvakare, mfana muhombe uyu
$this->load->model('assssssetsi');
//get all the coordinates that we have stored in the database

$coordinates['my_coordinates'] = $this->ads_asset->allCoordinates();
//var_dump($coordinates); exit;
//now go plot all those points in a map

//okie dokie, now lets draw a map and place a pin on that location

foreach($coordinates as $data){
 foreach($data as $key){
 //var_dump($key['longitude']); exit;

	$config['center'] = $key['latitude']. ", ".$key['longitude'];
    $config['zoom'] = 'auto';
    $config["map_width"] = '60%'; //var_dump ($config);exit;
	$config['cluster'] = TRUE;
	//$marker['ondragend'] = 'alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
    //var_dump ($config);exit;
	
	$this->googlemaps->initialize($config);
	
	$marker = array();
    $marker['position'] = $key['latitude']. ", ".$key['longitude'];
    $marker['setIcon'] = ('http://www.maps.google.com/mapfiles/ms/icons/green-dot.png');
    $marker['title'] = 'Billboard';
	$info_array = array (
	'title' => 'Description : 3m x 10m Billboard',
	'Location' => $key['latitude']. ", ".$key['longitude'],
	'media owner' => 'Media Owner: Primedia',
	'Start Date' => 'Available Starting: 22 March 2014',
	'End Date' => 'Available up to: 22 April 2014', 
	'Partial Availability' => 'Partial Availability : YES'
	);
	$marker['infowindow_content'] = $info_array['title']."<br>".$info_array['media owner']."<br>".$info_array['Location']. "<br>" .$info_array['Start Date']. "<br>" . $info_array['End Date']. "<br>" . $info_array['Partial Availability']. "<br>";
	$marker['draggable'] = true;
	//var_dump ($marker);exit;

    $this->googlemaps->add_marker($marker);
	}
    $data['map'] = $this->googlemaps->create_map();
	//var_dump ($data);exit;
//call the view 
    $this->load->view('radius_search', $data);
	
}
 }
 
 public function interest(){
 
    $this->load->view('spiderfy', $data);
	
}

 
 
public function geo_search(){
//require("phpsqlsearch_dbinfo.php");

// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
$connection=mysql_connect (localhost, $username, $password);
if (!$connection) {
  die("Not connected : " . mysql_error());
}

// Set the active mySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}

// Search the rows in the markers table
$query = sprintf("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);

$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();
}
public function streetView(){
$this->load->view('street_view2',null,null);
}
}