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
        $this->load->model('ajax_asset');
        
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
    
        public function spec_sheet() {
        //get the uploaded regions
        
        $this->load->view('spec_sheet', null );
    }

    public function drop_pins() {
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
        $marker['onclick'] = 'modalshow('.$row->ass_id .')';
       
        
        
      //  $marker['infowindow_content'] = '<div style="overflow: auto;" tabindex="-1" id="markerPopupContent" class="dialogContent"><div style="display: block;" tabindex="-1" id="CloseButton" class="closeButton"><img tabindex="-1" src="images/MiscIcons/close_grey.png"></div><div id="ApproachPhoto"><img style="width:100%;" src="photosheetimages/090/090.014146.PhotosheetApproach.201103011535065329338.jpg" onerror="this.src="PhotoSheetImages/PhotoSheetUnavailable.GIF";this.onerror=null;"></div><div tabindex="-1" id="PhotoSheetMapContainer"><div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" tabindex="-1" id="PhotoSheetMap"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; width: 100%; z-index: 200;"><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div></div><div style="position: absolute; left: 0px; top: 0px; width: 100%; z-index: 201;"><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 157px; top: -257px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 157px; top: -1px;"><canvas width="256" height="256" style="-moz-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;" draggable="false"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -99px; top: -257px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -99px; top: -1px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 413px; top: -257px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 413px; top: -1px;"></div></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; width: 100%; z-index: 202;"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 157px; top: -257px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 157px; top: -1px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -99px; top: -257px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -99px; top: -1px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 413px; top: -257px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 413px; top: -1px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 425px; height: 150px;"><img src="http://maps.googleapis.com/maps/api/js/StaticMapService.GetMapImage?1m2&amp;1i511331&amp;2i863489&amp;2e1&amp;3u13&amp;4m2&amp;1u425&amp;2u150&amp;5m4&amp;1e0&amp;5sen-US&amp;6sus&amp;10b1&amp;token=124357" style="width: 425px; height: 150px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 157px; top: -257px;"><img draggable="false" src="http://mt0.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1998&amp;y=3372&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 157px; top: -1px;"><img draggable="false" src="http://mt0.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1998&amp;y=3373&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -99px; top: -257px;"><img draggable="false" src="http://mt1.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1997&amp;y=3372&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -99px; top: -1px;"><img draggable="false" src="http://mt1.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1997&amp;y=3373&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 413px; top: -257px;"><img draggable="false" src="http://mt1.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1999&amp;y=3372&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 413px; top: -1px;"><img draggable="false" src="http://mt1.googleapis.com/vt?lyrs=m@271000000&amp;src=apiv3&amp;hl=en-US&amp;x=1999&amp;y=3373&amp;z=13&amp;apistyle=s.t%3A33%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=47,37%7Csmartmaps" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Click to see this area on Google Maps" href="http://maps.google.com/maps?ll=30.24786,-92.1878&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img draggable="false" src="http://maps.gstatic.com/mapfiles/api-3/images/google_white2.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 264px; bottom: 0px; width: 55px;" class="gmnoprint"><div class="gm-style-cc" style="-moz-user-select: none;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer;">Map Data</a><span style="display: none;">Map data ©2014 Google</span></div></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 256px; height: 108px; position: absolute; left: 63px; top: 5px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;">Map data ©2014 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2014 Google</div></div><div draggable="false" style="z-index: 1000001; position: absolute; -moz-user-select: none; right: 96px; bottom: 0px;" class="gmnoprint gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_blank" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 0px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="http://maps.google.com/maps?ll=30.24786,-92.1878&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" title="Report errors in the road map or imagery to Google" target="_new">Report a map error</a></div></div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 167px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><span>1 km&nbsp;</span><div style="position: relative; display: inline-block; height: 8px; bottom: -1px; width: 61px;"><div style="width: 100%; height: 4px; position: absolute; background-color: rgb(255, 255, 255); bottom: 0px; left: 0px;"></div><div style="position: absolute; left: 0px; top: 0px; width: 4px; height: 8px; background-color: rgb(255, 255, 255);"></div><div style="width: 4px; height: 8px; position: absolute; background-color: rgb(255, 255, 255); bottom: 0px; right: 0px;"></div><div style="position: absolute; background-color: rgb(102, 102, 102); height: 2px; bottom: 1px; right: 1px; left: 1px;"></div><div style="position: absolute; left: 1px; top: 1px; width: 2px; height: 6px; background-color: rgb(102, 102, 102);"></div><div style="width: 2px; height: 6px; position: absolute; background-color: rgb(102, 102, 102); bottom: 1px; right: 1px;"></div></div></div></div></div></div></div><div class="clear"></div><div id="PanelInfoTable" class="InfoTable"><table><tbody><tr><td class="popupLabelText">Panel:</td><td class="popupText">14146</td></tr><tr class="even"><td class="popupLabelText">TAB ID:</td><td class="popupText">30472306</td></tr><tr><td class="popupLabelText">Location:</td><td class="popupText">N/S I-10 W/O LA 343, LOC 1 F/E TOP</td></tr><tr class="even"><td class="popupLabelText">Lat/Long:</td><td class="popupText">30.24786 / -92.1878</td></tr><tr><td class="popupLabelText">Media/Style:</td><td class="popupText">Permanent Bulletin/Regular</td></tr><tr class="even"><td class="popupLabelText">Impressions:</td><td class="popupText">173247/week</td></tr><tr><td class="popupLabelText">Panel Size:</td><td class="popupText">12" x 40"<a href="http://salesmarketing.lamar.com/specsheets/12x40(complete).pdf" class="specSheetLink" target="_blank">Spec Sheet</a></td></tr><tr class="even"><td class="popupLabelText">Facing/Read:</td><td class="popupText">E/Right Of Road</td></tr><tr><td class="popupLabelText">Illuminated:</td><td class="popupText">Yes</td></tr></tbody></table></div><div id="PhotoSheetAdvertisingStrengthsWrapper" class="AdvertisingStrengthsWrapper"><div id="AdvertisingStrengths" class="AdvertisingStrengths"><span class="advertisingStrengthsLabelText">Advertising Strengths: </span><span class="popupText">N/A</span></div></div><div class="clear"></div><div id="PhotoSheetFooter" class="PopupFooter"><div id="AddToList" class="button popupButton"><img tabindex="-1" class="left" src="images/buttonImages/star_icon.png"><span tabindex="-1" class="buttonText">Add To Favorites</span></div><div id="PhotoSheetRequestQuoteButton" class="button popupButton"><img class="popupButtonImage" src="images/buttonImages/quote_icon.png"><span class="buttonText">Request Quote</span></div><div id="PhotoSheetLinkButton" class="button popupButton image-wrap"><img src="images/icons/photosheet_icon.png"><a target="_blank" class="buttonText" href="http://resources.lamar.com/PublishedProposals/Inventory/ByChartables/?chartables=90-14146:::&amp;photoType=LargeDriveBy&amp;complete=true&amp;format=">Photo Sheet</a></div><a class="button popupButton RateLink" style="margin-right: 0px;"><img src="images/buttonImages/pricetag_icon.png" class="left"><span class="buttonText">View Pricing</span></a></div></div>';

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
        
               
        $this->layouts->view('bid',null, array_merge($data));
    }
    
    public function buynow(){
        $data = array();
      //  do buy now queries
      //  $this->auction->buy_now();
        
               
        $this->layouts->view('buy_now',null, array_merge($data));
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
    
     public function loadajax(){
                 
           
        $this->load->view('loadajax',null);
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