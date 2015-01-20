<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class load_stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('province');
        $this->load->model('town');
        $this->load->model('asset_type');
        $this->load->model('assssssetsi');
        $this->load->library('googlemaps');
        $this->load->model('duration');
        $this->load->model('auction');
        
    }

    public function index() {
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

    public function drop_pins() {
        //get post variables
        //var_dump($_POST); exit;
        $region = $this->input->post('region');
        $location = $this->input->post('location');
        $loc_ref = $this->input->post('loc_ref');

        //call the centrallised map for the chosen region
        //define the map data base on the chosen region
        $city = $region . $location . 'SA';
        $array = $this->lookup($city);
        $this->center_map($array['latitude'], $array['longitude']);
    }

    public function asset_detais() {

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
    
    public function asset() {
        $data1['mmm'] = $this->assssssetsi->getAsset();

        $this->load->library('googlemaps');
        
        foreach ($data1['mmm'] as $row) {
        
        
            $config['center'] = $row->position;  
        $config['zoom'] = 9;
        $config['map_name'] = 'map';
          if (isset($_POST['view'])){
                  $string = explode(',',$row->position);
                 $lat = $string[0];
                  $lon = $string[1];
                           $config['center'] = '37.4419, -122.1419';  
            
            $this->load->library('googlemaps');
            $config['map_type'] = 'STREET';
            $config['streetViewPovHeading'] = 90;

           
        }elseif(isset($_POST['map'])){
        $config['map_div_id'] = 'map_canvas';
        $marker = array();
        $marker['position'] = $row->position;
        $marker['infowindow_content'] = $row->ass_name;
        $this->googlemaps->add_marker($marker);
        }
        $this->googlemaps->initialize($config);
              
        
}
        $data['map'] = $this->googlemaps->create_map();
        //select existing Asset Details
       
         $this->layouts->view('view_stock', null, array_merge($data,$data1) );
    }

    public function asset_details2(){
        //take points from db
        $data = array();
        $data['mmm'] = $this->assssssetsi->getAssetDetails();
        //var_dump($data);exit;
        $this->layouts->view('load_stock4',null, array_merge($data));
    }
    
    public function spiderfy(){
        //take points from db
        $data = array();
        $data['mmm'] = $this->assssssetsi->getAssetSpiderfy();
        //var_dump($data);exit;
        $this->layouts->view('my_spidefy',null, array_merge($data));
    }
    
    
        public function home(){
        //take points from db
        $this->layouts->view('media_owner_dashboard',null);
    }
    
    
    public function asset_details3(){
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
       //var_dump($provinces);exit;     
        $durations['durations'] = $this->duration->getDudarion();
        // var_dump($durations);exit; 
        
        
        $data1['mmm'] = $this->assssssetsi->getAssetDetails1();
         $this->load->library('googlemaps');
        if (!empty($data1['mmm'])){ 
        $count = 0;
        foreach ($data1['mmm'] as $row) {
        if ($count == 0){    
        $config['center'] = $row->position;
        $config['zoom'] = '8';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = 'var geocoder = new google.maps.Geocoder();
        var address = document.getElementById("myPlaceTextBox").value;
       var image = "http://localhost/maps/images/blue_icon.png";
                geocoder.geocode({ "address": address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               if(typeof marker != "undefined"){marker.setMap(null)};
                $("#location").parent().removeClass("has-error");
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#latitude").val(latitude);
                $("#longitude").val(longitude);
                alert(longitude);
                
                 marker = new google.maps.Marker({
map:map,
draggable:true,
icon:image,
animation: google.maps.Animation.DROP,
position: new google.maps.LatLng(latitude, longitude)
});
map.setCenter(new google.maps.LatLng(latitude, longitude), 9);
map.setZoom(9);
google.maps.event.addListener(marker, "dragend", function (event) {
latitude = this.getPosition().lat();
longitude = this.getPosition().lng();
$("#latitude").val(latitude);
$("#longitude").val(longitude);
});
            } else {
                alert("Request failed.")
                $("#location").parent().addClass("has-error");
            }
        });

';
        $config['cluster'] = TRUE;
        $this->googlemaps->initialize($config);
        $count = $count + 1;
        }
        $marker = array();
        $marker['position'] = $row->position;
        
       
        
        
        $marker['infowindow_content'] = '<div id="placeBid" tabindex="-1" role="dialog"><div ><div><div><h4 >'. $row->ass_name .'</h4></div><div class="modal-body"><div class="row"><div class="col-xs-6"><a class="thumbnail" href="auctions_details.php"><img src="<?php echo base_url();?>assets/add1.jpg"></a></div><div class="col-xs-6"><table class="tables"><tr><td width="100">Current Bid <h3 style="margin:0px; margin-bottom:10px;"><?php echo $current_bid;?></h3></td></tr><tr><td><span class="glyphicon glyphicon-flag"></span> <?php echo $location;?> </td></tr><tr><td><input type="hidden" value="<?php echo $id;?>" name="auct_id"><span class="glyphicon glyphicon-tag"></span><?php echo $asset_type;?></td></tr><tr><td><input type="hidden" value="<?php echo $ass_id;?>" name="ass_id"><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td></tr></table><br><div class="form-group"><div class="input-group"><input class="form-control" name="email" id="email" type="text" placeholder="R0.00"><a href="#" onclick="document.form1.submit();return false;" class="input-group-addon btn btn-primary">Place Bid</a></div></div></div></div></div></div></div></div>';

                //$marker['infowindow_content'] = '<div><a href="asset?ass_id='.$row->ass_id.'" ><img height="80px" width="150px" onClick="tawas.php" src="../../assets/add2.jpg"></a><div>';
        $this->googlemaps->add_marker($marker);

 
        }}else{
        $config['center'] = '-26.2044,28.0456';
        $config['zoom'] = '7';
        $config['places'] = TRUE;
        $this->googlemaps->initialize($config);
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        }
        $data3['map1'] = $this->googlemaps->create_map();  
        

        $this->layouts->view('sell_stock',null, array_merge($data,$data2,$data3,$provinces, $towns, $asset_types,$durations));
         
            
        
    }
    
    
        public function cluster(){
            
       
        $data1['mmm'] = $this->assssssetsi->getAssetDetails1();
        $this->load->library('googlemaps');
        $count = 0;
        foreach ($data1['mmm'] as $row) {
        if ($count == 0){    
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
        
        $this->layouts->view('active_bids',null, array_merge($data));
    }
    
    public function bid(){
        
        $data = array();
        $this->auction->create_bid();
        
               
        $this->layouts->view('active_bids',null, array_merge($data));
    }
    
    public function buynow(){
        'To Gateway';exit;
        $data = array();
        $this->auction->buy_now();
        
               
        $this->layouts->view('active_bids',null, array_merge($data));
    }
    
    
     public function addwatch(){
         $data = array();       
        $this->auction->add_watch();
        
               
        $this->layouts->view('active_bids',null, array_merge($data));
    }
    
    
    public function auction_details(){
        //take points from db
        $data = array();
        $data1 = array();
        $data1['mmm'] = $this->assssssetsi->getAssetDetails1();
        $provinces['my_provinces'] = $this->province->getRegions();
        //get the uploaded towns
        $towns['my_towns'] = $this->town->getTowns();
        //get asset_types
        $asset_types['may_asset_types'] = $this->asset_type->getAssetType();
       //var_dump($provinces);exit;     
        $durations['durations'] = $this->duration->getDudarion();
        // var_dump($durations);exit; 
       
        $this->load->library('googlemaps');
        $a = 0;
       foreach ($data1['mmm'] as $row) {
        $a = $a + 1;
            // Map One
            $mapname = 'map_'.$a;    
            $mapcanv = 'map_canvas'.$a;
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

 
        $this->layouts->view('auction_details',null, array_merge($data,$data1,$provinces, $towns, $asset_types,$durations));
    }


    public function center_map($rekutanga, $rechipiri) {
        $center_position = $rekutanga . ", " . $rechipiri;
        $this->load->library('googlemaps');
        $config['center'] = $center_position;
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        $config['onclick'] = 'createMarker_map({ map: map, position:event.latLng, draggable:true });';
        $this->googlemaps->initialize($config);
        $data['map'] = $this->googlemaps->create_map();
        $this->layouts->view('load_stock2', null,$data);
    }
    
      public function active_bids() {
        $this->layouts->view('active_bids');
    }
     public function watch_list() {
        $this->layouts->view('watch_list');
      }
      
    public function won_bids() {
        $this->layouts->view('won_bids');
      }
      
   public function lost_bids() {
        $this->layouts->view('lost_bids');
      }
      
      
      
    public function lookup($string) {

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
            'latitude' => $geometry['location']['lat'],
            'longitude' => $geometry['location']['lng'],
            'location_type' => $geometry['location_type'],
        );

        return $array;
    }
    
    public function our_ajax(){
        
        if($_POST["action"]=="get_asset_details"){ ?>
  <div id="dialog_content">
    <form>
      <h2>Edit Assets</h2>
      <label>Title</label>
      <input type="text" name="title" class="form-control">

      <label>Description</label>
      <textarea type="text" name="title" class="form-control"></textarea>

      <input type="hidden" name="action" value="save_exist_asset" >
      <input type="hidden" name="position" value="12312312,31231212" >

      <div class="buttons">
        <a href="#" class="save_asset">Save Asset</a>
        <a href="#" class="delete_asset">Delete Asset</a>
      </div>
      <br>
    </form>
  </div>
<?php } 


if($_POST["action"]=="add_new_asset"){
  //use position as the unique ID 


}

if($_POST["action"]=="save_exist_asset"){ 
  //use position as the unique ID


}

if($_POST["action"]=="delete_asset"){ 
  //use position as the unique ID


}

    }

}