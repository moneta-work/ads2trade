<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class loadajax extends CI_Controller {

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
        
        
    }

      
    
       
   
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

