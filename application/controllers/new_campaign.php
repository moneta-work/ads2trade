<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class new_campaign extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('media_category');
        $this->load->model('city');
        $this->load->library('googlemaps');
        $this->load->model('asset_size');
        $this->load->model('uploaded_documents');
        $this->load->model('rfp');
        $this->load->model('media_family');
        $this->load->model('asset');
    }
    
    public function loadrfp()
    {
            $data = array();
            $data['rfp_det'] = $this->rfp->rfp_add_assets();
            $this->load->view('loadrfp', null, array_merge($data));
    }
    

    public function index() {

        //get the media categories from the database
        $media_cat['my_categories'] = $this->media_category->getMediaCategories();
        $this->layouts->view('new_campaign', null, array_merge($media_cat));
    }
    
     public function mo_proposals() {

        //get the media categories from the database
   
    $data3 = array();
    $data3['rfps'] = $this->rfp->mo_getRfp();
        $this->layouts->view('mo_proposal', null, array_merge($data3));
    }
      public function ad_proposals() {

        //get the media categories from the database
   
    $data3 = array();
  //  $data3['rfps'] = $this->rfp->ad_getRfp();
    $data3['rfps'] = $this->rfp->getRfp();
        $this->layouts->view('ad_proposal', null, array_merge($data3));
    }
    
     public function add_assets() {

        //get the media categories from the database
     
     $id=$_GET['id'];  
     $this->rfp->add_media_owner();
     $this->campaigns1();
    }
    
    public function submit_assets() {

        //get the media categories from the database
     
     $this->rfp->create_proposal();
     $this->layouts->view('record_created',null);
    }
    public function submit_proposal() {

        //get the media categories from the database
     
     $this->rfp->submit_proposal();
     $this->layouts->view('record_created',null);
    }
    
   public function campaigns() {
    $data3 = array();
    $data3['rfps'] = $this->rfp->getRfp();
        $this->layouts->view('op_campaign', null, array_merge($data3));
    }
    
   public function ad_campaigns() {
    $data3 = array();
    $data3['rfps'] = $this->rfp->getRfp();
        $this->layouts->view('ad_campaign', null, array_merge($data3));
    }
    
    
   public function proposals() {
    $data3 = array();
    $data3['rfps'] = $this->rfp->getRfp_prop();
        $this->layouts->view('op_proposal', null, array_merge($data3));
    }
    
    
    public function campaigns1() {

        //get the media categories from the database
        $data1 = array();
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
         $data1['map1'] = $this->googlemaps->create_map();
         $data3 = array();
         $data['rfps'] = $this->rfp->getRfp();
         $data1['rfp_det'] = $this->rfp->getRfpDet();
                 //GET ALL THE MEDIA TYPES
         $media_types['all_media'] = $this->media_category->getMediaCategories();

         $this->layouts->view('op_campaign_det', null, array_merge($data, $data1, $media_types));
    }
   
    
     public function campaigns2() {

        //get the media categories from the database
         $data1 = array();
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
            $data1['map1'] = $this->googlemaps->create_map();
         $data3 = array();
         $data['rfps'] = $this->rfp->getRfp_prop();
         $data1['rfp_det'] = $this->rfp->getRfpDet();
         $this->layouts->view('op_proposal_det', null, array_merge($data, $data1));
    }
    
    public function mo_campaigns1() {

        //get proposal details
        
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
        $data2['map'] = $this->googlemaps->create_map(); 
        $data['rfps'] = $this->rfp->pro_getRfp();
         $data1['rfp_det'] = $this->rfp->mo_getRfpDet();
         $data3['mmm'] = $this->rfp->mo_getRfpDet();
        $this->layouts->view('mo_campaign_det', null, array_merge($data, $data1,$data2,$data3));
    }

        public function ad_campaigns1() {

        //get proposal details
        
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
        $data2['map'] = $this->googlemaps->create_map(); 
        $data['rfps'] = $this->rfp->pro_getRfp();
         $data1['rfp_det'] = $this->rfp->mo_getRfpDet();
         $data3['mmm'] = $this->rfp->mo_getRfpDet();
        $this->layouts->view('ad_campaign_det', null, array_merge($data, $data1,$data2,$data3));
    }

    function headerInfo() {
             
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
				            } 
				        });

				';
        //GET ALL THE MEDIA TYPES
        $media_types['all_media'] = $this->media_category->getMediaCategories();
        //get Media Family
        $media_types2['all_media2'] = $this->media_category->getMediaCategoriesByFamily();
        //get Media Family
        $media_fam['my_families'] = $this->media_family->getMediaFamilies();
        $this->googlemaps->initialize($config);
        $data3['map1'] = $this->googlemaps->create_map();
        $this->layouts->view('new_campaign2', null, array_merge($data3, $media_types, $media_fam, $media_types2));
    }
    
    public function dynamic_table(){
        $this->load->view('dynamic_table', null);
    }
    
    public function city_cell(){
          //get the size options from the database
         $sizes['size_options'] = $this->asset_size->getMediaSizes();
      // var_dump($sizes); exit;
         $this->load->view('city_cell', $sizes);
      
    }
    
    public function campaignSummary(){
  
// 		$config['center'] = '-26.2044,28.0456';
//        $config['zoom'] = '7';
//        $config['places'] = TRUE;
//
//        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
//        $config['placesAutocompleteBoundsMap'] = TRUE;
//        $config['placesAutocompleteOnChange'] = 'var geocoder = new google.maps.Geocoder();
//		        var address = document.getElementById("myPlaceTextBox").value;
//		       var image = "http://localhost/maps/images/blue_icon.png";
//
//		                geocoder.geocode({ "address": address }, function (results, status) {
//		            if (status == google.maps.GeocoderStatus.OK) {
//		               //if(typeof marker != "undefined"){marker.setMap(null)};
//		                $("#location").parent().removeClass("has-error");
//		                var latitude = results[0].geometry.location.lat();
//		                var longitude = results[0].geometry.location.lng();
//		                $("#latitude").val(latitude);
//		                $("#longitude").val(longitude);
//
//		mezmerize(address,latitude, longitude);
//
//
//		map.setCenter(new google.maps.LatLng(latitude, longitude), 9);
//		map.setZoom(9);
//		            }
//		        });
//
//		';
//
//        //echo "<pre>", print_r($_POST), '</pre><br />';
//
//            //get the longitude and latitude values
//               #to deal with this later baba, not your problem for now :-)
//            //end lon lat
//
//        $campaign_header = array();
//        $category_names = array();
//        $asset_average_prices = array();
//        $lat_long = array();
//        $latlong2 = array();
//
//        $campaign_header['camp_title'] = $this->input->post('camp_title');
//        $campaign_header['budget'] = $this->input->post('budget');
//        $campaign_header['description'] = $this->input->post('description');
//        $campaign_header['partial_availability'] = $this->input->post('partial_availability');
//        $campaign_header['respond_date'] = $this->input->post('respond_date');
//        $campaign_header['from_date'] = $this->input->post('from_date');
//        $campaign_header['to_date'] = $this->input->post('to_date');
//        $media_categories['mec_id'] = $this->input->post('mec_id');
//        $media_fam['mef_id'] = $this->input->post('mef_id');
//        //get the media descs
//        foreach ($media_categories as $key => $value) {
//          for($count = 0; $count < count($value); $count++){
//             //go grab your media category descriptions
//             //$category_names['my_categories'][] = $this->media_category->getMediaCategoriesByID($value[$count]);
//             $category_names['my_categories'][] = $this->media_category->getMediaCategoriesAvgPricesByID($value[$count]);
//             //end grab
//             //also get prices for each one
//
//          }
//        }
//
//        $street_add['streetAdd'] = $_POST['chosen_location'];
//        print_r($street_add);
//        foreach ($street_add['streetAdd'] as $key => $value) {
//            $address = $value;
//            $value = explode(",", $value);
//            $value = $value[0];
//            $asset_average_prices['avg_prices'][] = $this->asset->averageAssetPriceForArea($value);
//            $lat_long['area_lat_long'][$key] = $this->getLangLongFromAddress($address);
//
//            $latitude_longitude = $lat_long['area_lat_long'][$key];
//            $latlong2['lat'] = $latitude_longitude;
//        }
//
//        //$latlon['lat'] = $_POST['latitude']; //moved inside foreach above to get it for each chosen area
//        $this->googlemaps->initialize($config);
//        $data3['map1'] = $this->googlemaps->create_map();
//        $this->layouts->view('new_campaign3', null, array_merge($campaign_header, $media_categories, $street_add, $latlong2, $category_names,  $data3, $media_fam, $asset_average_prices, $lat_long));

        print_r($this->input->post());

        //

//        $this->layouts->view('new_campaign3');
    }

    public function upload_campaign() {

        $image_path_base = 'uploaded_documents/campaign_assets/user_photos/';
                $map_path_base = 'uploaded_documents/campaign_assets/map_snapshots/';

        $campaign = array(
            'id' =>  '',
            'images' => array(
                'user' => array(),
                'map' => array()
            )
        );

            
                
        if (array_key_exists('campaign_id', $_POST)) {
            $campaign['id'] = $_POST['campaign_id'];
            unset($_POST['campaign_id']);
        }



        foreach ($_POST as $key => $value) {
            list($type, $id, $desc_or_image) = explode('_', $key);
            if (!array_key_exists($id, $campaign['images'][$type])) {
                $campaign['images'][$type][$id] = array(
                    'description' => '',
                    'image_path' => ''
                );
            }
            if ($desc_or_image == 'description') {
                $campaign['images'][$type][$id]['description'] = $value;
            }else{
                //Convert the image, move it and link its url
                list($img_type, $data) = explode(';', $value);
                list(, $ext) = explode('/', $img_type);
                if (trim($ext) == '') {

                }
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                do {
                    $filename = uniqid($type."_") . "." . $ext;
                    $full_path = $image_path_base . $filename;
                }while(file_exists($full_path));
                if (!file_put_contents($full_path, $data)){
                    $campaign['images'][$type][$id]['image_path'] = 'Error';
                }
                $campaign['images'][$type][$id]['image_path'] = $full_path;
            }
        }

        print_r($campaign);
               // echo (count($campaign));
        //Use $campaign
                
                //now store the campaign data in the uploaded documents table
               // for($i=0;$i<count($campaign); $i++){
                //print_r($campaign[$i]);
                //$this->uploaded_documents->rfpDocs($this->session->userdata('user_id'));

    }//}
        
        public function saveCampaign(){
              //my own rfp array

                ///echo "<pre> DEBUG Campaign ";
                //print_r($_POST);
                //exit;

                $campaign_header = array();
                $campaign = array();
                $category_names = array();

                $campaign_header['title']              = $this->input->post('camp_title');
                $campaign_header['budget']                  = $this->input->post('budget');
                $campaign_header['camp_descriptor']             = $this->input->post('description');
                //$campaign_header['partial_availability']    = $this->input->post('partial_availability');
                $campaign_header['respond_date']            = $this->input->post('respond_date');
                $campaign_header['start_date']               = $this->input->post('from_date');
                $campaign_header['end_date']                 = $this->input->post('to_date');
                $campaign_header['ast_id']                  = 3;
                $campaign_header['rfp_status_id']           = 0;
                $campaign_header['use_id']                  = $this->session->userdata('user_id');

                /*
                campain table fields
                cam_requested_start_date
                cam_requested_end_date
                cam_partial_availability_status (0-OFF, 1-ON)
                cam_title
                cam_budget
                cam_requested_response_date
                cam_description
                adv_id (user id)
                cas_id
                cam_number
                cab_id
                cst_id
                cam_creation_date
                cam_status
                */ 
                
                $campaign['cam_title']              = $this->input->post('camp_title');
                $campaign['cam_budget']                  = $this->input->post('budget');
                $campaign['cam_description']             = $this->input->post('description');
                $campaign['cam_partial_availability_status']    = $this->input->post('partial_availability');
                if($campaign['cam_partial_availability_status']=='ON'){
                    $campaign['cam_partial_availability_status'] = 1;
                } else {
                    $campaign['cam_partial_availability_status'] = 0;
                }
                $campaign['cam_requested_response_date']            = $this->input->post('respond_date');
                $campaign['cam_requested_start_date']               = $this->input->post('from_date');
                $campaign['cam_requested_end_date']                 = $this->input->post('to_date');
                //$campaign['ast_id']                  = 3;
                $campaign['cam_status']           = 0;
                $campaign['adv_id']                  = $this->session->userdata('user_id');
                $campaign['cam_creation_date']                  = date('Y-m-d H:j:s');

                $street_address = $this->input->post('street_address');
                
                $media_types    = $this->input->post('media_types');
                $media_category = $this->input->post('media_category');
                $mec_ids        = $this->input->post('mec_id');
                $med_quantity   = $this->input->post('med_quantity');
                $avg_total      = $this->input->post('avg_total');
                $rem_total      = $this->input->post('rem_total');
                
                $chosen_size_id = $this->input->post('chosen_size_id');


                //$mec_ids = explode(",", $mec_ids);
                //echo $med_quantity[0][3];

                //print_r($campaign_header);
                /*	
                for($i=0; $i<count($media_types); $i++){
                    //echo "<br>$i-",$media_types[$i];
                }
				*/
                //count areas 
                $count          = $this->input->post('count');

               // exit;
                /*
                if( $_REQUEST["name"] )
                {
                   $name = $_REQUEST['name'];
                    $cam_budget = $_REQUEST['budget'];
                  // echo "Welcome ". $name;
                }
               
                $campaign_details = array(
                   'budget' =>$cam_budget,
                    'respond_date'=>date('Y-m-d'),
                    'title'=>'trymore test',
                    'camp_descriptor'=> $name,
                    'start_date'=>date('Y-m-d'),
                    'end_date'=>date('Y-m-d'),
                    'ast_id'=>3,
                    'rfp_status_id' =>0,
                    'use_id'=>$this->session->userdata('user_id')
                );
                //end of rfp array
                 */
                //store the rfp details
                                
                //$this->rfp->rpfCommit($rfp_details);
                $this->rfp->rpfCommit($campaign_header);
                $campaign_id = $this->rfp->campaignCommit($campaign);
                //end rfp commit 

                //campaign line items / transactions
                for($i=0; $i<count($street_address); $i++){

                	$campaign_txn = array();

                    $campaign_address = $street_address[$i];
                    //echo("<BR>$campaign_address (". count($mec_ids));
                    $lat_long         = $this->getLangLongFromAddress($campaign_address);
                    $lat_long         = explode(",", $lat_long);
                    $campaign_lat     = $lat_long[0];
                    $campaign_long    = $lat_long[1];

                    for($j=0; $j<count($mec_ids); $j++){

            			$txn_mec_id			= isset($mec_ids[$j])?$mec_ids[$j]:0;
            			$txn_mec_name		= isset($media_category[$j])?$media_category[$j]:'';
                        $txn_med_quantity   = isset($med_quantity[$j])?$med_quantity[$j]:0;
                        $txn_avg_total      = isset($avg_total[$j])?$avg_total[$j]:0;
                        $txn_rem_total      = isset($rem_total[$j])?$rem_total[$j]:0;
                        $txn_lat			= $campaign_lat;
                        $txn_lon			= $campaign_long;

                        //echo "<br> $txn_mec_id $txn_mec_name $txn_med_quantity $txn_lat $txn_lon - [".($chosen_size_id[0])."]"; 

                        if(isset($chosen_size_id[0]) && !is_null($chosen_size_id[0])){

                        	//echo "<br> chosen sizes";

	                        for($k=0; $k<count($chosen_size_id); $k++){
	                        	//sample 26_-25.9991795_28.1262927,bench,1
	                        	//explode() = [0] = 26_-25.9991795_28.1262927
	                        	//[1] = bench (mec_description)
	                        	//[2] = 1 (asg_id)
	                        	$line_item = explode(",", $chosen_size_id[$k]);
	                        	//print_r($line_item); exit;
	                        	//
	                        	$asg_id = isset($line_item[2])?$line_item[2]:1;
	                        	//
	                        	$mec_name = isset($line_item[1])?$line_item[1]:'';
	                        	//example 26_-25.9991795_28.1262927
	                        	$asi_id_and_lat = explode("_", $line_item[0]);
	                        	//[0] = 26 (asi_id)
	                        	$asi_id = $asi_id_and_lat[0];
	                        	//$latitude = $asi_id_and_lat[1];

	                        	//setup & commit campaign line/txn
	                        	if(strtoupper($txn_mec_name) == strtoupper($mec_name)){
		                        	$campaign_txn['cam_id'] 		= $campaign_id;
		                        	$campaign_txn['mec_id'] 		= $txn_mec_id;
		                        	$campaign_txn['cam_latitude'] 	= $txn_lat;
		                        	$campaign_txn['cam_longitude'] 	= $txn_lon;
		                        	$campaign_txn['asi_id'] 		= $asi_id;
		                        	$campaign_txn['asg_id'] 		= $asg_id;
		                        	$campaign_txn['quantity'] 		= $txn_med_quantity;

		                        	///print_r($campaign_txn);  //echo $k; echo $mec_name; exit;
		                        	if($campaign_id > 0)
		                        		$this->rfp->campaignTxnCommit($campaign_txn);
	                        	}

	                        }                        	

                        } else {

                        	//echo "<br> NO chosen sizes";

                        	$campaign_txn['cam_id'] 		= $campaign_id;
                        	$campaign_txn['mec_id'] 		= $txn_mec_id;
                        	$campaign_txn['cam_latitude'] 	= $txn_lat;
                        	$campaign_txn['cam_longitude'] 	= $txn_lon;
                        	$campaign_txn['asi_id'] 		= 0; //placeholder asset id
                        	$campaign_txn['asg_id'] 		= 0; //placeholder asset group id 
                        	$campaign_txn['quantity'] 		= $txn_med_quantity; 

                        	//print_r($campaign_txn);  //echo $k; echo $mec_name; exit;
                        	if($campaign_id > 0)
                        		$this->rfp->campaignTxnCommit($campaign_txn);                        	

                        }

                    }

                }

                //exit;

                $this->campaigns();
        }

        public function ajax_get_mediatypes(){
            /*
            Example call http://indigostorage.co.za/ads_final/index.php/new_campaign/ajax_get_mediatypes/?id=digital,traditional

            Result: [{"id":"2","text":"bench"},{"id":"3","text":"bus (Digital)"},{"id":"5","text":"street pole (Digital)"},{"id":"7","text":"bill board (Digital)"},{"id":"9","text":"taxi tv digital network"},{"id":"10","text":"cafe digital network"},{"id":"1","text":"poster"},{"id":"11","text":"magazine advert "},{"id":"4","text":"bus (Traditional)"},{"id":"6","text":"street pole (Traditional)"},{"id":"8","text":"bill board (Traditional)"}]
            */
            $all_media = array();
            $new_media = array();

//            echo $this->input->get('media_family_id');
            if($this->input->get('id')) {
                $all_media = $this->media_category->getMediaCategoriesByFamily($this->input->get('id'));
            } else {
                $all_media = $this->media_category->getMediaCategoriesByFamily();
            }
            foreach ($all_media as $row) {
                # code...
                $new_media[] = array('id' => $row->id, 'text'=>$row->description);
            }
            echo json_encode($new_media);
        }  

        /* Utility functions google maps*/              
        // function to get the address
        public function getLangLongFromAddress($address){

            $address = str_replace(" ", "+", $address);

            //$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
            $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=");
            $json = json_decode($json);

            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            return $lat.','.$long;
        }

        public function getAddressFromLatLong($lat, $lng){

            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
            $json = @file_get_contents($url);
            $data=json_decode($json);
            $status = $data->status;
            if($status=="OK")
                return $data->results[0]->formatted_address;
            else
                return "";

        }

}

