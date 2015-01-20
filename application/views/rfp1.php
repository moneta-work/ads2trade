<?php 
 if (isset($_POST['cluster'])){echo $map1['js'];} ?>
 <style>
    table { border-collapse: collapse; border-spacing: 0; }
    p { margin: 0.75em 0; }
    #map_canvas { height: auto; position: absolute; bottom: 0; left: 0; right: 0; top: 0; }
    @media print { #map_canvas { height: 950px; } }
  </style>
<style>
    html, body, #map-canvas {
        height: 100px;
        margin: 0px;
        padding: 0px
    }

    .tabs_wrap{ border:solid 1px #e1e1e1; }
    .tabs_wrap a.active{ background-color: #cbc9c9; }
    .dn{ display:none;}
    .Faces{ border-bottom: solid 1px #e1e1e1; padding-bottom: 10px; height: 30px; margin-bottom: 10px; }
    .dbfl{float:left; display:inline-block;}
    .tab_content{display:none; height: 215px; overflow: auto;}
    .tab_content.active{display:block;}
    #dialog_content .buttons_wrap a{ margin-right: 10px;}
    #dialog_content{ float:left; width:100%;}
    #dialog_content label{ display: block; margin: 0px;}
    #dialog_content .form-control{ outline: none!important; border-shadow:none; margin: 0px;outline: none; border: solid 2px #e1e1e1; width: 250px; padding: 6px; margin-bottom: 10px;}
</style>

<div id="popup_content" style="display:none">
    <div id="dialog_content"><form name="test"  method="post" action="tawas.php">
            
            <div class="Faces">
                <div class="col-xs-4">
                    <input type="radio" name="face" checked="checked" id="fa" class="dbfl">
                    <label for="fa" class="dbfl">Face A</label>
                </div>
                <div class="col-xs-6">
                    <input type="radio" name="face" id="fb" class="dbfl">
                    <label  for="fb" class="dbfl">Face B</label>
                </div>
            </div>
            
            <div class="face_a_content">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Upload Photo</label>
                    <input type="file" name="file_fa" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content
                </div>
                <div class="tab_content" id="rate">
                    Rate Content
                </div>
            </div>
            
            <div class="face_b_content dn">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content Face B
                </div>
                <div class="tab_content" id="rate">
                    Rate Content Face B
                </div>
            </div>

            <div class="buttons_wrap">
                <input type="hidden" class="form-control latlong" name="position"  value="" >
                <a href="#" class="save_new_asset btn btn-primary">Save Asset</a>
                <a href="#" class="delete_new_asset btn btn-primary">Delete Asset</a>
            </div><br>
        </form></div>
    <div class="clear"></div>
</div>


<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>RFP</h1>
</div>
<?php
               

                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get(); 


                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();  
?>

<div class="main col-xs-12">
    <form method="post">
    <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="../load_stock/asset_details3">Search</a></li>
            <li><a href="../load_stock/active_bids">Your Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li><a href="../load_stock/watch_list">Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li><a href="../load_stock/won_bids">Won Bids</a></li>
            <li><a href="../load_stock/lost_bids">Lost Bids</a></li>
            <li><a href="../rfp/rfp_list">My RFPs</a></li>
    </ul>


    <div class="clear"></div>

    <style>
	table {
		border-collapse: collapse;
		border-spacing: 0;
	}

	p {
		margin: 0.75em 0;
	}
        #map-canvas-sell {
		height: 100%;
		bottom: 0;
                position: absolute;
                left: 0;
		right: 0;
		top: 0;
	}

	@media print {
		#map_canvas {
			height: 950px;
		}
	}
</style>
 <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please Specify Header Details For Your Campaign
            </div>
        <form method="post" class="main col-xs-12 actions_home_page" action="auction_room.php">

          <div class="top_form">
            <div class="row">
             <div class="col-sm-2">
                <p>
                  <label for="campaign_title">Campaign Title</label>                         
                  <input class="form-control"  type="text" id="campaign_title" name="campaign_title" />
                </p>
              </div>
              <div class="col-sm-3">
                <p>
                  <label for="mec_id">Media Categories</label>                         
                  <select name="mec_id[]" id="mam_id" data-placeholder="Type Media Categories" style="width:100%;" multiple
				        class="chosen-select" tabindex="8">

					<?php
                                        $arry = $_POST['mec_id'];
                                        
					foreach ($may_asset_types as $row) {?>
                                    <option <?php for($i=0;$i<count($arry);$i++){
                                        if ($arry[$i] == $row->mec_id){ echo 'Selected';}

} ?> value="<?php echo $row->mec_id;?>"  ><?php echo $row->mec_description;?></option>
					<?php }
					?>
				</select>
                </p>
              </div>
           
                <div class="col-sm-2">
                <p>
                  <label for="first_name">Budget</label>                         
                  <input type="text" name="budget"  id="budget" class="form-control" />
                </p>
              </div>

              <div class="col-sm-4">
             
                  <p>
                    <label for="from_date">From Date</label>                           
                    <input type="date" vname="from_date" id="from_date" class="form-control">
                  </p>
                </div>
                 <div class="col-sm-4">
                  <p>
                    <label for="to_date">To Date</label>                           
                    <input type="date" vname="to_date" id="to_date" class="form-control">
                  </p>
                 </div>
                 <div class="col-sm-4">
                   <p>
                    <label for="respond_date">Respond By</label>                           
                    <input type="date" vname="respond_date" id="respond_date" class="form-control">
                  </p>
                </div>
                 <div class="col-sm-4">
                   <p>
                    <label for="respond_date">Campaign Description</label>                           
                    <textarea class="form-control" rows="3" name="campaign_desc" id="campaign_desc" data-bv-field="campaign_desc">                                        </textarea>
                  </p>
                </div>
                
              </div>
            </div>
            <div class="clear"></div>
            <br>
            <br>
             <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please Choose Desired Locations For Your Campaign
            </div>
             <div class="col-sm-6">
               <input class="form-control"  type="text" id="myPlaceTextBox"/>
             </div>    
          </div>
            
            
            <!--div class="text-center">
              <br>
              <div class="btn-group">
                <button type="button" class="btn btn-default show_auctions_locations active">Beginner User</button>
                <button type="button" class="btn btn-default #">Advanced User</button>
              </div>
            </div -->
            
       
<div class="map_view">        
      <div id="map-canvas-sell"></div>
 </div>
              
              <br>
              <br>
     <div>
            <table class="table table-striped" id="rfp_locations">
                <thead>
                    <tr>
                        <th>Place</th>
                        <th>Delete</th>
                        <th>View Map</th>
                       <th>GPS Coordinates</th>
                         
                        <th>Edit Images</th>
                        


                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                      
                        <td></td>


                    </tr>
                    <tr>
                        <td></td>
                      
                        <td></td>
                        <td></td>
                        <td></td>
                 
                        <td></td>


                    </tr>
                     <tr>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                      
                        <td></td>


                    </tr>
                     <tr>
                        <td></td>
                       
                        <td></td>
                        <td></td>
                        <td></td>
                       
                        <td></td>


                    </tr>
                    <tr>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                     
                        <td>
                            <button type="button" class="btn btn-default" onclick="javascript:history.go(-1)">Back</button>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Next</button>
                        </td>


                    </tr>
                </tbody>
            </table>
        </div>        
        </form><!--Main -->


 <!-- Mapping Requirements -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA5bJNyTu51BbOwopYMiV93RkuPO1yoSqA&sensor=false"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMap.js"></script>
<script type="text/javascript">
	var raw_markers = <?php echo json_encode($mmm);?>;
	var base_url = '<?php echo base_url();?>';
	var adsMap = false;
	function initialize() {
		console.log('Initializing AdsMap');
		var mapOptions = {
			center: new google.maps.LatLng(-26.2044, 28.0456),
			zoom: 6
		};
		var map = new google.maps.Map(document.getElementById("map-canvas-sell"), mapOptions);

		//Load markers
		var dont_show_info = false;
		var markers = [];
		for (var i in raw_markers) {
			(function (i) {
				var marker_details = raw_markers[i]
				console.log('Ugly hack to fix missing mec_id field');
				if (!marker_details.hasOwnProperty('mec_id')) {
					marker_details.mec_id = marker_details.med_id;
				}
				var position_parts = marker_details.position.split(',');

				var latLng = new google.maps.LatLng(position_parts[0], position_parts[1]);
				var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					type: parseInt(marker_details.mec_id),
					asset_id: marker_details.ass_id
				});
				markers.push(marker);

//				google.maps.event.addListener(marker, 'click', function () {
//
//					modalshow(marker_details.ass_id);
//				});
			})(i);

		}
			var optOptions = {
			urlBase: base_url,
			markers: markers,
			showRadii: false,
			showSearchPOIButton: function() {
				disableListener = true;
				adsMap.add_message('Please click on the map.', 10);
				adsMap.search_poi(false, function() {
					disableListener = false;
				});
				return false;
			},
			showFilterButton: function() {
				disableListener = true;
				adsMap.add_message('Please click on the map.', 10);
				adsMap.filter_markers_in_radius(false, function() {
					disableListener = false;
				});
				return false;
			}
		};
		var clusterOptions = {};
		var spiderOptions = {
			keepSpiderfied: true
		};
		var html2canvasOptions = {
			logging: true
		};
		adsMap = new AdsMap(map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
		//Now add the click events to the markers
		document.addEventListener('AdsMaploaded', function(e) {
			adsMap.spider.addListener('click', function(clicked_marker) {
				modalshow(clicked_marker.asset_id);
			});
		}, false);


		/** Autocomplete Places */
		var input = document.getElementById('myPlaceTextBox');
		var image = base_url + 'assets/mapping/images/user_marker.png';
		var marker_location = new google.maps.Marker({
			map: map,
			draggable: true,
			icon: image,
			animation: google.maps.Animation.DROP,
			visible: false
		});
		var autoCompleteOnChange = function () {
			var geocoder = new google.maps.Geocoder();
			var address = document.getElementById("myPlaceTextBox").value;

			geocoder.geocode({ "address": address }, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {

					$("#location").parent().removeClass("has-error");
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					$("#latitude").val(latitude);
					$("#longitude").val(longitude);
					marker_location.setVisible(true);
					marker_location.setPosition(results[0].geometry.location);
					console.log(results[0].geometry.location);
					map.setCenter(new google.maps.LatLng(latitude, longitude), 9);
					map.setZoom(9);
					google.maps.event.addListener(marker_location, "dragend", function (event) {
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

		}
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);
		google.maps.event.addListener(autocomplete, 'place_changed', autoCompleteOnChange);
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	function search_poi() {
		adsMap.add_message('Please click on the area where you would like to search.', 10);
		adsMap.search_poi();
	}

</script>
<!-- End Mapping Requirements -->

<script>
	function modalshow(a) {
		var width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = (window.innerWidth - width - padding) / 2;


		$("#modalwin").load("loadajax?c=" + a +"&p=asset_details3");

		modalbak = document.getElementById("modalbak");
		modalbak.style.display = "block";

		modalwin = document.getElementById("modalwin");
		modalwin.style.top = top + "px";
		modalwin.style.left = left + "px";
		modalwin.style.display = "block";
	}
	function modalhide() {
		document.getElementById("modalbak").style.display = "none";
		document.getElementById("modalwin").style.display = "none";
	}

</script>
 <script>

            function deleteRow(r) {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("rfp_locations").deleteRow(i);
            }

            function mezmerize(address, lat, lon) {
                var table = document.getElementById("rfp_locations");
                var row = table.insertRow(3);
              
                var cell2 = row.insertCell(0);//cell 1
                var cell3 = row.insertCell(1);//cell 2
                var cell7 = row.insertCell(2);//cell 2(0)
                var cell4 = row.insertCell(2);//cell 3
                var cell6 = row.insertCell(3);//cell 4
               // var cell1 = row.insertCell(-1);//cell 5
                var cell5 = row.insertCell(4); //cell 6
               
                btn = '<input type="button" value="Delete Location" class="btn btn-danger" onclick="deleteRow(this)">';
                editbtn = '<input type="button" value="Edit Images" class="btn btn-danger" onclick="">';
                proxBtn = '<input type="text"  id="proximity" name="proximity" class="form-control" placeholder="No Proximity Sprcified" readonly />';
                myLat = '<input type="hidden"  id="lat[]" name="lat[]" value="' + lat + "," + lon + '"/>';
                myStreetAdd = '<input type="hidden"  id="streetAdd[]" name="streetAdd[]" value="' + address + '"/>';
                viewMap = '<button type="button" class="js-fire-modal btn btn-info" data-toggle="modal" data-target="#mapModal" data-latLng="' + lat + ',' + lon + '">View Map</button>';
                myCountry = address.substr(address.lastIndexOf(",") + 1);
		
                //cell 1
                cell2.innerHTML = address + myStreetAdd;
                //--------------------

                //cell 2
                cell3.innerHTML = btn;
                //----------------
                
                //cell 3
                cell4.innerHTML = viewMap;
                //--------------
                
                //cell 4
                cell6.innerHTML = " <strong>lat:</strong> " + lat + "\n <strong>lon:</strong> " + lon;
                //-------------
		
                //cell 5
               // cell1.innerHTML = address + myStreetAdd;
                //-------------
                
                //cell 6
                cell5.innerHTML = proxBtn + myLat; 
                //--------------
                
                //cell 7
                cell7.innerHTML = editbtn; 
                //--------------
          }



            var base_url = '<?php echo base_url(); ?>';
            var adsMap = false;
            function adsMapInit() {




                $('#mapModal').on('shown.bs.modal', function (e) {
                    var tmp_id = $(e.relatedTarget).attr('data-latLng');

                    var parts = tmp_id.split(',');
                    var position = new google.maps.LatLng(parts[0], parts[1]);

                    var mapOptions = {
                        center: position,
                        zoom: 10
                    };
                    var campaign_map = new google.maps.Map(document.getElementById("campaign_map_canvas"), mapOptions);


                    var selected_marker = new google.maps.Marker({
                        position: position,
                        map: campaign_map,
                        icon: base_url + 'assets/mapping/images/user_marker.png'
                    });
                    var optOptions = {
                        urlBase: base_url,
                        markers: [selected_marker],
                        showRadii: true,
                        currentFilterCriteria: {},
                        showSearchPOIButton: true,
                        showFilterButton: true
                    };
                    var clusterOptions = {};
                    var spiderOptions = {};
                    var html2canvasOptions = {
                        logging: true
                    };
                    adsMap = new AdsMap(campaign_map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
                    google.maps.event.trigger(campaign_map,'resize');

                    var campaign = new AdsMap.Campaign(adsMap, {url: base_url + 'index.php/new_campaign/upload_campaign', onsuccess: function() {
                            $('#mapModal').modal('hide');
                            alert('Succesfully posted images');
                        }}, {id: tmp_id});
                    $('#campaign_images').html(campaign.edit());
                });

            }
            google.maps.event.addDomListener(window, 'load', adsMapInit);



        </script>
<div id='modalbak'></div>
<div id='modalwin'>
</div>