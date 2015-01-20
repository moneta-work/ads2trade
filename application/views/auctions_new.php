<style>
	table {
		border-collapse: collapse;
		border-spacing: 0;
	}

	p {
		margin: 0.75em 0;
	}
        #map-canvas-sell {
		/*height: 100%;*/
		height: 500px;
		width:1053px;
		bottom: 0;
        position: absolute;
        left: 0;
		right: 0;
		top: 0;
		max-width:none; /* fix issue with grey areas on map*/
	}
	/* left align the text and checkboxes */
	div.mapping_legend{text-align: left;}

	@media print {
		#map_canvas {
			height: 950px;
		}
	}
</style>

        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span>Auctions</h1>
        </div>
<?PHP
//print_r($auction_areas);
?>

        <form method="post" class="main col-xs-12 actions_home_page" action="">

          <div class="top_form">
            <div class="row">
              <div class="col-sm-2">
                <p>
                  <label for="first_name">Media Family</label>                         
                 <select name="mef_id[]" id="mef_id" data-placeholder="Type Media Family" style="width:100%;" multiple
				        class="chosen-select" tabindex="8">
                                    
                                    
                                    
                                    <?php
                                        $arry1 = $_POST['mef_id'];
                                        
					foreach ($may_asset_family as $row) {?>
                                    <option <?php for($i=0;$i<count($arry1);$i++){
                                        if ($arry1[$i] == $row->mef_id){ echo 'Selected';}

} ?> value="<?php echo $row->mef_id;?>"  ><?php echo $row->mef_description;?></option>
					<?php }
					?>
                                    
                                    
				</select>
                </p>
              </div>

              <div class="col-sm-2">
                <p>
                  <label for="first_name">Master Media</label>                         
                  <select name="mam_id[]" id="mam_id" data-placeholder="Type Master Media" style="width:100%;" multiple
				        class="chosen-select" tabindex="8">

					<?php
                                        $arry = $_POST['mam_id'];
                                        
					foreach ($may_asset_master as $row) {?>
                                    <option <?php for($i=0;$i<count($arry);$i++){
                                        if ($arry[$i] == $row->mam_id){ echo 'Selected';}

} ?> value="<?php echo $row->mam_id;?>"  ><?php echo $row->met_description;?></option>
					<?php }
					?>
				</select>
                </p>
              </div>
            <div class="col-sm-2">
                <p>
                  <label for="first_name">Location</label>                         
                  <input class="form-control"  type="text" id="myPlaceTextBox"/>
                </p>
              </div>
                <div class="col-sm-1">
                <p>
                  <label for="first_name">Duration</label>                         
                  <select name="duration[]" data-placeholder="Please Select Duration" style="width:100%;" multiple
					        class=" chosen-select" tabindex="8">

						<?php
                                                $ar = $_POST['duration'];
						foreach ($durations as $row) {?>
							<option <?php for($i=0;$i<count($ar);$i++){
                                                            if ($ar[$i] == $row->days){ echo 'Selected';}
} ?> value="<?php echo $row->days;?>" > <?php echo  $row->description; ?></option>
						<?php }
						?>


					</select>
                </p>
              </div>

              <div class="col-sm-3">
                <div class="row">
                  <p class="col-xs-6">
                    <label for="first_name">From Date</label>                           
                    <input type="text" vname="from_date" id="from_date" class="form-control">
                  </p>
                  <p class="col-xs-6">
                    <label for="first_name">To Date</label>                           
                    <input type="text" vname="to_date" id="to_date" class="form-control">
                  </p>
                </div>
              </div>

              <div class="col-sm-2">
                <label for="first_name">&nbsp;</label><br>
                <input type="submit" class="btn btn-primary" value="Apply Filter">
              </div>
            </div>
            <div class="clear"></div>
          </div>
            
            
            <div class="text-center">
              <br>
              <div class="btn-group">
                <button type="button" class="btn btn-default show_auctions_locations active">Show Locations</button>
                <button type="button" class="btn btn-default show_auctions_map" id="showmap">Show Map</button>
              </div>
            </div>
            
		<div class="locations_view">
		    <br>
		    <h3>Auctions by Area</h3>
		    <br>
		        <div class="row">
		        
		        <?php
		        
		        //echo 'testing';
		        $rowitems_count = 1;
		        $colitems_count = 0;
		        $max_items_per_row = 4;
		        $max_items_per_col = 2;
		        $new_row = true;
		        $new_col = true;
		        $total_areas = count($auction_areas);
		        //print_r($auction_areas);
		        foreach ($auction_areas as $area) {
		            //if($area->ass_province == 'GP'){
		              if($rowitems_count == 1){
		                echo '<div class="col-sm-3">';
		                echo '<ul class="list-unstyled">';
		              }
		                echo '    <li><a href="./auction_details?auction_id='.$area->id.'&area='.$area->ass_city.'&duration=7&aset=5">'.$area->ass_city.' ('.$area->area_count.')</a></li>';

		              if($rowitems_count == $max_items_per_col){
		                echo '  </ul>';
		                echo '</div>';
		                $rowitems_count = 1;
		              } else {
		                $rowitems_count++;
		              }   
		            //}
		            
		          } 
		          
		        ?>

		      </div>
		</div>

        <!-- Locations view-->
		<div class="map_view">        
		      <div id="map-canvas-sell" style="width:1053px;height:500px;"> Loading ... </div>
		</div>
              <!--
              <br>
              <br>
              <h3>Auction Rooms</h3>-->
              <div class="table_div">

              <!--

				<table class="table table-bordered headed " cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Auction Room</th>
                    <th>Media Type</th>
					<th>Duration</th>
					<th>Artwork Required By</th>
					<th>Auction Start</th>
					<th>No Of Assets</th>
					<th>Campaign To Start</th>
					<th>End Date</th>
					
					<th>Time Remaining</th>
				</tr>
				</thead>

				<tbody>
				<?php
				$count = 0;
                                $dat = '';
				if (!empty($mmm1)) {
					foreach ($mmm1 as $row) {
						$count = $count + 1;
						$this->db->where('mec_id', $row->mec_id);
						$select_query = $this->db->get('media_category');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$dat = $rows->mec_description;
							}


						}
                                                
                                                
                                                
                                                $this->db->where('days', $row->loc_id);
						$select_query = $this->db->get('durations');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$duration = $rows->description;
							}


						}
						?>
						<tr>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $count; ?></a>
							</td>
                                                        
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $dat; ?></a></td>
							<td>
								<a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $duration; ?></a>
							</td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">01.08.2014</a></td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"></a></td>
							<td>
								<a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $row->counts; ?></a>
							</td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php $row->mec_id; ?></a>
							</td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">08.08.2014</a></td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">2 Days</a></td>
						</tr>
					<?php
					}
				} else {
					?>
					<td colspan="10">No Records Found</td> <?php

				}?>
				</tbody>
			</table>
			-->

			<?php
			//print_r($mmm1);
			?>
		    <br>
		    <br>
		    <h3>Auction Rooms</h3>
		    <table class="table table-bordered headed" cellspacing="0" width="100%">
		          <thead>
		              <tr>
		                  <th>Pic</th>
		                  <th>Location</th>
		                  <th>Start Date</th>
		                  <th>End Date</th>
		                  <th>Time Remaining</th>
		                  <th>Type</th>
		                  <th>Status</th>
		                  <th>&nbsp;</th>
		              </tr>
		          </thead>
		   
		          <tbody>

				<?php

				$count = 0;
                                $dat = '';
				if (!empty($mmm1)) {
					foreach ($mmm1 as $row) {
						$count = $count + 1;
						$this->db->where('mec_id', $row->mec_id);
						$select_query = $this->db->get('media_category');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$dat = $rows->mec_description;
							}


						}
                                                
                                                
                        $this->db->where('days', $row->loc_id);
						$select_query = $this->db->get('durations');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$duration = $rows->description;
							}


						}

						//requires php 5.3+
						$date1 = new DateTime($row->starts);
						$date2 = new DateTime($row->ends);
						$difference = $date2->diff($date1);
						$diff = $difference->format("%a");

						//TODO: Find out what status id is in auctions table
						$status = 'Open';	
						//id closed?
						if($row->cloded>0){
							$status = 'Closed';
						}
						//id suspended?
						if($row->suspended>0){
							$status = 'Suspended';
						}						
						?>

		              <tr>
		                  <td width="50">
		                    <a class="thumbnail" href="auction_details?area=<?php echo $row->ass_city;?>&duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">
		                      <img src="<?php echo base_url();?>assets/add1.jpg">
		                    </a>
		                  </td>
		                  <td><a href="auction_details?auction_id=<?php echo $row->id;?>&area=<?php echo $row->ass_city;?>&duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $row->ass_street_address,', ',$row->ass_city;?></a></td>
		                  <td><?php echo date_format($date1,"d M, Y");?></td>
		                  <td><?php echo date_format($date2,"d M, Y");?></td>
		                  <td><?php echo $difference->d,' days ',$difference->h,' hours'; ?></td>
		                  <td><?php echo $row->mec_description; ?></td>
		                  <td><?php echo $status;?></td>
		                  
		              </tr>

						<?php
						}
					} else {
						?>
						<tr>
							<td colspan="7">No Records Found</td> 
						</tr>
					<?php
					}?>

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
	var map;

	$('#showmap').click(function(e){
		initialize();
		if(map){
			//alert('Show Map CLicked');
			//we have to set center for map after resize, but we need to know center BEFORE we resize it
			//$(window).resize();
			$(window).trigger('resize');
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize"); //this fix the problem with not completely map
			map.setCenter(center);
			/*if (document.createEventObject) {   // IE before version 9
			    var resizeEvent = document.createEventObject (window.event);
			    //clickEvent.button = 1;  // left click
			    window.fireEvent ("onresize", resizeEvent);
			}*/
		}
	});

	function initialize() {
		console.log('Initializing AdsMap');
		var mapOptions = {
			center: new google.maps.LatLng(-26.2044, 28.0456),
			zoom: 10 /*changed from 6 to remove grey area*/
		};
		map = new google.maps.Map(document.getElementById("map-canvas-sell"), mapOptions);

		google.maps.event.addListenerOnce(map, 'idle', function(){
		    $(window).resize();
		    //map.setCenter(-26.2044, 28.0456);
			//we have to set center for map after resize, but we need to know center BEFORE we resize it
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize"); //this fix the problem with not completely map
			map.setCenter(center);
		});

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
<div id='modalbak'></div>
<div id='modalwin'>
</div>

