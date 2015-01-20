<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rfp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('province');
        $this->load->model('town');
        $this->load->model('asset_type');
        $this->load->model('assssssetsi');
        $this->load->library('googlemaps');
        $this->load->model('duration');
        $this->load->model('auction');
        $this->load->model('rfps');
        $this->load->model('media_category');
        
        
    }

    public function index() {
        //take points from db
        $data = array();
        $data1 = array();
        $data1['mmm'] = $this->assssssetsi->getAssetDetails1();
        $provinces['my_provinces'] = $this->province->getRegions();
        ////get the uploaded towns
       $towns['my_towns'] = $this->town->getTowns();
        ////get asset_types
        $asset_types['may_asset_types'] = $this->asset_type->getAssetType();
       ////var_dump($provinces);exit;     
       $durations['durations'] = $this->duration->getDudarion();
        //// var_dump($durations);exit; 
       
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
//$config['center'] = '37.4419, -122.1419';
//$config['zoom'] = 'auto';
//$config['places'] = TRUE;
//$config['placesAutocompleteInputID'] = 'myPlaceTextBox';
//$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
//$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
//$this->googlemaps->initialize($config);
//$data['map'] = $this->googlemaps->create_map();
 
        $this->layouts->view('rfp',null, array_merge($data,$data1,$provinces, $towns, $asset_types,$durations));
    }


    
    public function bid() {
                
          $data['rfp'] = $this->rfps->getRfp();    
        $this->layouts->view('rfp_list',null, array_merge($data));
         
         
         
    }
    
    public function asset() {
        $data = array();
        $data1 = array();
        $this->load->library('googlemaps');
        $data1['mmm'] = $this->assssssetsi->getAsset();
        $asset_types['asset_types'] = $this->asset_type->getAssetType();
        $durations['durations'] = $this->duration->getDudarion();
        
        foreach ($data1['mmm'] as $row) {
        $config['center'] = $row->position;
        $config['zoom'] = 9;
        $config['map_name'] = 'map';
        $config['map_div_id'] = 'map_canvas';
        $this->googlemaps->initialize($config);
        
        $marker = array();
        $marker['position'] = $row->position;
        $marker['infowindow_content'] = $row->ass_name;
        $this->googlemaps->add_marker($marker);
        }
        $data['map'] = $this->googlemaps->create_map();
        //select existing Asset Details
       
         $this->layouts->view('rfp_details', null, array_merge($data,$data1,$asset_types,$durations) );
         
         
         
    }
    
    
    
    
        public function rfp_stock() {
        $data = array();
        $data1 = array();
        $this->load->library('googlemaps');
        $data1['mmm'] = $this->assssssetsi->getAsset();
        $asset_types['asset_types'] = $this->asset_type->getAssetType();
        $durations['durations'] = $this->duration->getDudarion();
        
        foreach ($data1['mmm'] as $row) {
        $config['center'] = $row->position;
        $config['zoom'] = 9;
        $config['map_name'] = 'map';
        $config['map_div_id'] = 'map_canvas';
        $this->googlemaps->initialize($config);
        
        $marker = array();
        $marker['position'] = $row->position;
        $marker['infowindow_content'] = $row->ass_name;
        $this->googlemaps->add_marker($marker);
        }
        $data['map'] = $this->googlemaps->create_map();
        //select existing Asset Details
       
         $this->layouts->view('rfp_stock', null, array_merge($data,$data1,$asset_types,$durations) );
         
         
         
    }

     public function rfp_list(){

        $user['user_id'] =  $this->session->userdata('user_id');
        $user['user_type'] =  $this->session->userdata('user_type');
        
        $data = array();
        
        //quickfix: TO BE LOOKED AT IN DETAIL
        redirect('new_campaign/headerInfo');exit;

        switch($user['user_type']) {
            case 1: //Advertiser
                $rfps = $this->rfps->get_user_rfps($user['user_id']);
                $data['rfps'] = $rfps;
                $view = 'rfp/adv_list';
            break;
            
            case 3: //Operator
                $rfps = $this->rfps->get_rfps();
                $data['rfps'] = $rfps;
                $view = 'rfp/operator_list';
            break;
            
            default:
                $view = "noaccess";
            break;
        }
        

        $this->layouts->view($view, null, $data);
    }
    
//        public function rfp_list(){
                 
 //       $data['rfp'] = $this->rfps->getRfp();    
  //      $this->layouts->view('rfp_list',null, array_merge($data));
  //  }
   
     public function rfp1(){
        //take points from db
         
        if (isset($_POST['filter'])  ){                    
                 $this->rfps->create_rfp();
                 $data['rfp'] = $this->rfps->getRfp();
                 $this->layouts->view('rfp_list',null, array_merge($data));                  
                }else{
         
        $data = array();
        $data['mmm'] = $this->assssssetsi->getAssetDetails();
        $data['mmm1'] = $this->assssssetsi->getAssetDetail();
        $provinces['my_provinces'] = $this->province->getRegions();
        $data2['mmm2'] = $this->assssssetsi->getAssetDetails1();
        //get the uploaded towns
        $towns['my_towns'] = $this->town->getTowns();
        //get asset_types
        $asset_types['may_asset_types'] = $this->media_category->getMediaCategories();
         //var_dump($asset_types);exit;     
        $durations['durations'] = $this->duration->getDudarion();
        // var_dump($durations);exit; 
        
        
        $data1['mmm'] = $this->assssssetsi->getAssetDetails1();
         $this->load->library('googlemaps');
        if (!empty($data1['mmm'])){ 
        $count = 0;
        foreach ($data1['mmm'] as $row) {
        if ($count == 0){    
       $config['center'] = '-26.2044,28.0456';
        $config['zoom'] = '7';
        $config['places'] = TRUE;
        
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE;
        $config['placesAutocompleteOnChange'] = 'var geocoder = new google.maps.Geocoder();
        var address = document.getElementById("myPlaceTextBox").value;
       var image = "http://localhost/maps/images/blue_icon.png";
       
                geocoder.geocode({ "address": address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               //if(typeof marker != "undefined"){marker.setMap(null)};
                $("#location").parent().removeClass("has-error");
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#latitude").val(latitude);
                $("#longitude").val(longitude);
        
mezmerize(address,latitude, longitude);

                
map.setCenter(new google.maps.LatLng(latitude, longitude), 9);
map.setZoom(9);
//google.maps.event.addListener(marker, "dragend", function (event) {
//              latitude = this.getPosition().lat();
//              longitude = this.getPosition().lng();
//              $("#latitude").val(latitude);
//              $("#longitude").val(longitude);
//              });
            } 
        });

';
        $this->googlemaps->initialize($config);
        $data3['map1'] = $this->googlemaps->create_map();
        $count = $count + 1;
        }
        $marker = array();
        $marker['position'] = $row->position;
        $marker['infowindow_content'] = '<div><a href="asset?ass_id='.$row->ass_id.'" ><img height="80px" width="150px" onClick="tawas.php" src="../../assets/add2.jpg"></a><div>';
        $this->googlemaps->add_marker($marker);

 
        }}else{
        $config['center'] = '-26.2044,28.0456';
        $config['zoom'] = '7';
        $config['places'] = TRUE;
        $this->googlemaps->initialize($config);
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        }
        $data3['map1'] = $this->googlemaps->create_map();  
        

        $this->layouts->view('rfp1',null, array_merge($data,$data2,$data3,$provinces, $towns, $asset_types,$durations));
                } 
            
        
    }
    
    
   

    }

