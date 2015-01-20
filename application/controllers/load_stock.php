<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class load_stock extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('province');
		$this->load->model('town');
		$this->load->model('asset_type');
		$this->load->model('assssssetsi');
		$this->load->library('googlemaps');
		$this->load->model('duration');
		$this->load->model('auction');
		$this->load->model('ajax_asset');
		$this->load->model('bids');

	}

	public function index()
	{
		//get the uploaded regions
		$provinces['my_provinces'] = $this->province->getRegions();
		//get the uploaded towns
		$towns['my_towns'] = $this->town->getTowns();
		//get asset_types
		$asset_types['may_asset_types'] = $this->asset_type->getAssetType();
		//var_dump($provinces);exit;
		$this->layouts->view('upload_stock', null, array_merge(
				$provinces, $towns, $asset_types
			)
		);
	}

	public function spec_sheet()
	{
		//get the uploaded regions

		$this->load->view('spec_sheet', null);
	}
        public function proposal()
	{
		//get the uploaded regions

		$this->load->view('proposal', null);
	}
	public function drop_pins()
	{
		//get post variables

		$region = $this->input->post('region');
		$location = $this->input->post('location');
		$loc_ref = $this->input->post('loc_ref');

		//call the centrallised map for the chosen region
		//define the map data base on the chosen region
		$city = $region . $location . 'SA';
		$array = $this->lookup($city);
		$this->center_map($array['latitude'], $array['longitude']);
	}

	public function asset_detais()
	{

		$region = $this->input->post('region');
		$location = $this->input->post('location');
		$loc_ref = $this->input->post('loc_ref');
		$asset_type = $this->input->post('med_type');
		$data = array();
		$data['region'] = $region;
		$data['location'] = $location;
		$data['loc_ref'] = $loc_ref;
		$data['asset_type'] = $asset_type;
		//select existing Asset Details
		$this->layouts->view('load_stock3', null, $data
		);
	}

	public function asset()
	{
		$data1['mmm'] = $this->assssssetsi->getAsset();
		//$data1['auction_id'] = $_REQUEST['auction_id']; 
		foreach ($data1['mmm'] as $row) {
			$config['center'] = $row->position;
			$config['zoom'] = 9;
			$config['map_name'] = 'map';
			if (isset($_POST['view'])) {
				$string = explode(',', $row->position);
				$lat = $string[0];
				$lon = $string[1];
				$config['center'] = '37.4419, -122.1419';
				$config['map_type'] = 'STREET';
				$config['streetViewPovHeading'] = 90;


			} elseif (isset($_POST['map'])) {
				$config['map_div_id'] = 'map_canvas';
				$marker = array();
				$marker['position'] = $row->position;
				$marker['infowindow_content'] = $row->ass_name;
				$this->googlemaps->add_marker($marker);
			}
			$this->googlemaps->initialize($config);

		}
		$data['map'] = $this->googlemaps->create_map();
		//get current bid on an asset
        $auction_id =  $_REQUEST['ass_id'];
        $bid_data['current_bid'] = $this->bids->getBidDetail($_REQUEST['auction_id']);
       	$this->layouts->view('view_stock', null, array_merge($data, $data1, $bid_data));
	}

	public function asset_details2()
	{
		//take points from db
		$data = array();
		$data['mmm'] = $this->assssssetsi->getAssetDetails();
		//var_dump($data);exit;
		$this->layouts->view('load_stock4', null, array_merge($data));
	}

	public function spiderfy()
	{
		//take points from db
		$data = array();
		$data['mmm'] = $this->assssssetsi->getAssetSpiderfy();
		//var_dump($data);exit;
		$this->layouts->view('my_spidefy', null, array_merge($data));
	}


	public function home()
	{
		//take points from db
		$this->layouts->view('media_owner_dashboard', null);
	}


	public function asset_details3()
	{
		//take points from db
		$data = array();
		$data['mmm'] = $this->assssssetsi->getAssetDetails();
		$data['mmm1'] = $this->assssssetsi->getAssetDetail();
		$provinces['my_provinces'] = $this->province->getRegions();
		$data2['mmm2'] = $this->assssssetsi->getAssetDetails1();
		//get the uploaded towns
		$towns['my_towns'] = $this->town->getTowns();
		//get asset_types
		$asset_types['may_asset_types'] = $this->asset_type->getAssetType();
                $asset_family['may_asset_family'] = $this->asset_type->getFamilyType();
                $asset_master['may_asset_master'] = $this->asset_type->getMasterType();
		//var_dump($provinces);exit;
		$durations['durations'] = $this->duration->getDudarion();
		// var_dump($durations);exit;
		$data1['mmm'] = $this->assssssetsi->getAssetDetails1();

		$post_criteria = array(
			'filter_criteria' => $_POST
		);
		unset($post_criteria['filter_criteria']['filter']);

		//11.12.2014 - Get Area/City Auctions Counts
		$post_criteria['auction_areas'] = $this->auction->getCityAreaAuctionCounts($user_id);
		//print_r($post_criteria['auction_areas']); exit;
              //  $this->layouts->view('sell_stock', null, array_merge($asset_family,$asset_master,$data, $data1, $data2, $provinces, $towns, $asset_types, $durations, $post_criteria));

		$this->layouts->view('auctions_new', null, array_merge($asset_family,$asset_master,$data, $data1, $data2, $provinces, $towns, $asset_types, $durations, $post_criteria));


	}
        
        
        public function view_my_assets()
	{
		//take points from db
		$data = array();
                $dat['mm'] = $this->assssssetsi->getMyAsset();
		$data['mmm'] = $this->assssssetsi->getAssetDetailsm();
		$data['mmm1'] = $this->assssssetsi->getAssetDetailm();
		$provinces['my_provinces'] = $this->province->getRegions();
		$data2['mmm2'] = $this->assssssetsi->getAssetDetails1m();
		//get the uploaded towns
		$towns['my_towns'] = $this->town->getTowns();
		//get asset_types
		$asset_types['may_asset_types'] = $this->asset_type->getAssetType();
                $asset_family['may_asset_family'] = $this->asset_type->getFamilyType();
                $asset_master['may_asset_master'] = $this->asset_type->getMasterType();
		//var_dump($provinces);exit;
		$durations['durations'] = $this->duration->getDudarion();
		// var_dump($durations);exit;
		$data1['mmm'] = $this->assssssetsi->getAssetDetails1m();

		$post_criteria = array(
			'filter_criteria' => $_POST
		);
		unset($post_criteria['filter_criteria']['filter']);



		$this->layouts->view('sell_my_assets', null, array_merge($asset_family,$asset_master,$data, $data1, $data2, $provinces, $dat,$towns, $asset_types, $durations, $post_criteria));


	}



	public function cluster()
	{


		$data1['mmm'] = $this->assssssetsi->getAssetDetails1();
		$this->load->library('googlemaps');
		$count = 0;
		foreach ($data1['mmm'] as $row) {
			if ($count == 0) {
				$config['center'] = $row->position;
				$config['zoom'] = 'auto';
				$config['cluster'] = TRUE;
				$this->googlemaps->initialize($config);
				$count = $count + 1;
			}
			$marker = array();
			$marker['position'] = $row->position;
			$this->googlemaps->add_marker($marker);


		}
		$data['map'] = $this->googlemaps->create_map();

		$this->layouts->view('active_bids', null, array_merge($data));
	}

	public function bid()
	{

		$data = array();
		$this->auction->create_bid();
		$this->layouts->view('bid', null, array_merge($data));
	}

	public function buynow()
	{
		$data = array();
		//  do buy now queries
		//  $this->auction->buy_now();


		$this->layouts->view('buy_now', null, array_merge($data));
	}


	public function addwatch()
	{
		$data = array();
		$this->auction->add_watch();


		$this->layouts->view('active_bids', null, array_merge($data));
	}


	public function auction_details()
	{
		
		//area filter
		$area_filter = $this->input->get('area');
      
		//take points from db
		$data = array();
		$data1 = array();
		$data1['mmm'] = $this->assssssetsi->getAssetDetails1($area_filter);
		$data1['auction_id'] = $_REQUEST['auction_id'];
		$provinces['my_provinces'] = $this->province->getRegions();
		//get the uploaded towns
		$towns['my_towns'] = $this->town->getTowns();
		//get asset_types
		$asset_types['may_asset_types'] = $this->asset_type->getAssetType();
		//var_dump($provinces);exit;
		$durations['durations'] = $this->duration->getDudarion();
		$bid_data['current_bid'] = $this->bids->getBidDetail($_REQUEST['auction_id']);
        //get my last bid
        $current_bid['last_bid'] = $this->bids->currentBid($this->session->userdata('user_id'));

		$a = 0; // what is this now oooh!
		foreach ($data1['mmm'] as $row) {
			$a = $a + 1;
			// Map One
			$mapname = 'map_' . $a;
			$mapcanv = 'map_canvas' . $a;
			$config['center'] = $row->position;
			$config['zoom'] = 9;
			$config['map_name'] = $mapname;
			$config['map_div_id'] = $mapcanv;
			$this->googlemaps->initialize($config);
			$marker = array();
			$marker['position'] = $row->position;
			$marker['infowindow_content'] = $row->ass_name;
			$this->googlemaps->add_marker($marker);
            $data[$mapname] = $this->googlemaps->create_map();
            
		}
		$this->layouts->view('auction_details', null, array_merge($data, $data1, $provinces, $towns, $asset_types, $durations, $bid_data, $current_bid));
		}


	public function center_map($rekutanga, $rechipiri)
	{
		$center_position = $rekutanga . ", " . $rechipiri;
		$this->load->library('googlemaps');
		$config['center'] = $center_position;
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		$config['onclick'] = 'createMarker_map({ map: map, position:event.latLng, draggable:true });';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->layouts->view('load_stock2', null, $data);
	}

	public function active_bids()
	{
		$this->layouts->view('active_bids');
	}
        public function all_active_bids()
	{
		$this->layouts->view('all_active_bids');
	}
	public function watch_list()
	{
		$this->layouts->view('watch_list');
	}
        public function all_watch_list()
	{
		$this->layouts->view('all_watch_list');
	}
	public function won_bids()
	{
		$this->layouts->view('won_bids');
	}
        public function all_won_bids()
	{
		$this->layouts->view('all_won_bids');
	}
        
        public function remove_watch()
	{      $this->auction->remove_watch();
		$this->layouts->view('watch_list');
	}
        
	public function lost_bids()
	{
		$this->layouts->view('lost_bids');
	}


	public function lookup($string)
	{

		$string = str_replace(" ", "+", urlencode($string));
		$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $string . "&sensor=false";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $details_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);

		// If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
		if ($response['status'] != 'OK') {
			return null;
		}

		//print_r($response);
		$geometry = $response['results'][0]['geometry'];

		$longitude = $geometry['location']['lng'];
		$latitude = $geometry['location']['lat'];

		$array = array(
			'latitude'      => $geometry['location']['lat'],
			'longitude'     => $geometry['location']['lng'],
			'location_type' => $geometry['location_type'],
		);

		return $array;
	}

	public function loadajax()
	{

		$this->load->view('loadajax', null);
	}
        
        
        
	public function bid_pop()
	{

		$this->load->view('test', null);
	}


	public function our_ajax()
	{

		if ($_POST["action"] == "get_asset_details") {
			?>
			<div id="dialog_content">
				<form>
					<h2>Edit Assets</h2>
					<label>Title</label>
					<input type="text" name="title" class="form-control">

					<label>Description</label>
					<textarea type="text" name="title" class="form-control"></textarea>

					<input type="hidden" name="action" value="save_exist_asset">
					<input type="hidden" name="position" value="12312312,31231212">

					<div class="buttons">
						<a href="#" class="save_asset">Save Asset</a>
						<a href="#" class="delete_asset">Delete Asset</a>
					</div>
					<br>
				</form>
			</div>
		<?php
		}


		if ($_POST["action"] == "add_new_asset") {
			//use position as the unique ID


		}

		if ($_POST["action"] == "save_exist_asset") {
			//use position as the unique ID


		}

		if ($_POST["action"] == "delete_asset") {
			//use position as the unique ID


		}

	}
	/********************************************************************************
	 * 11.12.2014																	*
	 * NEW FUNCTIONS FOR NEW LAYOUTS/DESIGN											*
	 *																				*
	 *******************************************************************************/
	public function auctions()
	{

		//Get filters if any

		//Get Session data required
		$user_id = $this->session->userdata('user_id');
		
		//Get data from db
		//take points from db
		$data = array();
		$data['mmm'] = $this->assssssetsi->getAssetDetails();
		$data['mmm1'] = $this->assssssetsi->getAssetDetail();
		$provinces['my_provinces'] = $this->province->getRegions();
		$data2['mmm2'] = $this->assssssetsi->getAssetDetails1();
		//get the uploaded towns
		$towns['my_towns'] = $this->town->getTowns();
		//get asset_types
		$asset_types['may_asset_types'] = $this->asset_type->getAssetType();
                $asset_family['may_asset_family'] = $this->asset_type->getFamilyType();
                $asset_master['may_asset_master'] = $this->asset_type->getMasterType();

		$durations['durations'] = $this->duration->getDudarion();

		$data1['mmm'] = $this->assssssetsi->getAssetDetails1();

		$post_criteria = array(
			'filter_criteria' => $_POST
		);
		unset($post_criteria['filter_criteria']['filter']);

		//11.12.2014 - Get Area/City Auctions Counts
		$post_criteria['auction_areas'] = $this->auction->getCityAreaAuctionCounts(0);

		//$this->layouts->view('auctions_new', null, array_merge($asset_family,$asset_master,$data, $data1, $data2, $provinces, $towns, $asset_types, $durations, $post_criteria));

		//Build view data array
		//$data = array();
		$data['user_id'] = $user_id;

		//Load view
		$this->layouts->view('auctions_new_home', null, array_merge($asset_family,$asset_master,$data, $data1, $data2, $provinces, $towns, $asset_types, $durations, $post_criteria));
	}
}