<style>
	table {
		border-collapse: collapse;
		border-spacing: 0;
	}

	p {
		margin: 0.75em 0;
	}

	#map-canvas-sell {
		height: 500px;
		position: absolute;
		bottom: 0;
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

<style>
	#modalbak {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #333333;
		display: none;
		opacity: 0.40;
		z-index: 9;
	}

	#modalwin {
		position: fixed;
		top: 0;
		left: 0;
		width: 900px;
		height: 600px;
		background: #FFF;
		display: none;
		padding: 5px;
		border: 3px double #CCC;
		z-index: 10;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-box-shadow: 3px 3px 6px #666;
		-webkit-box-shadow: 3px 3px 6px #666;
	}

	#modalmsg {
		text-align: center;
		/* Add more style to your message */
	}

</style>


<style>
	html, body {
		height: 100%;
		margin: 0px;
		padding: 0px
	}

	.tabs_wrap {
		border: solid 1px #e1e1e1;
	}

	.tabs_wrap a.active {
		background-color: #cbc9c9;
	}

	.dn {
		display: none;
	}

	.Faces {
		border-bottom: solid 1px #e1e1e1;
		padding-bottom: 10px;
		height: 30px;
		margin-bottom: 10px;
	}

	.dbfl {
		float: left;
		display: inline-block;
	}

	.tab_content {
		display: none;
		height: 215px;
		overflow: auto;
	}

	.tab_content.active {
		display: block;
	}

	#dialog_content .buttons_wrap a {
		margin-right: 10px;
	}

	#dialog_content {
		float: left;
		width: 100%;
	}

	#dialog_content label {
		display: block;
		margin: 0px;
	}

	#dialog_content .form-control {
		outline: none !important;
		border-shadow: none;
		margin: 0px;
		outline: none;
		border: solid 2px #e1e1e1;
		width: 250px;
		padding: 6px;
		margin-bottom: 10px;
	}
</style>

<div id="popup_content" style="display:none">
	<div id="dialog_content">
		<form name="test" method="post" action="tawas.php">

			<div class="Faces">
				<div class="col-xs-4">
					<input type="radio" name="face" checked="checked" id="fa" class="dbfl">
					<label for="fa" class="dbfl">Face A</label>
				</div>
				<div class="col-xs-6">
					<input type="radio" name="face" id="fb" class="dbfl">
					<label for="fb" class="dbfl">Face B</label>
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
					<input type="hidden" name="action" value="add_new_asset">

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
					<input type="hidden" name="action" value="add_new_asset">

				</div>
				<div class="tab_content" id="production">
					Product Content Face B
				</div>
				<div class="tab_content" id="rate">
					Rate Content Face B
				</div>
			</div>

			<div class="buttons_wrap">
				<input type="hidden" class="form-control latlong" name="position" value="">
				<a href="#" class="save_new_asset btn btn-primary">Save Asset</a>
				<a href="#" class="delete_new_asset btn btn-primary">Delete Asset</a>
			</div>
			<br>
		</form>
	</div>
	<div class="clear"></div>
</div>


<div class="breadcrumbs">
	<h1><span class="glyphicon glyphicon-list-alt"></span>Auctions</h1>
</div>
<?php


$this->db->select('distinct(auction) as auction');
$this->db->from('auctions');
$this->db->join('watch_list', 'watch_list.auction = auctions.id');
$select_query1 = $this->db->get();


$this->db->select('distinct(auction) as auction');
$this->db->from('auctions');
$this->db->join('bids', 'bids.auction = auctions.id');
$select_query = $this->db->get();
?>

<div class="main col-xs-12">
	<form method="post">
		<ul class="nav navbar-nav section-menu">
			<li class="active"><a href="../load_stock/asset_details3">Search</a></li>
			<li><a href="../load_stock/active_bids">Your Active Bids<span
						class="badge"><?php echo $select_query->num_rows; ?></span></a></li>
			<li><a href="../load_stock/watch_list">Watch List<span
						class="badge"><?php echo $select_query1->num_rows; ?></span></a></li>
			<li><a href="../load_stock/won_bids">Won Bids</a></li>
			<li><a href="../load_stock/lost_bids">Lost Bids</a></li>
		</ul>


		<div class="clear"></div>

		<div class="alert alert-info" role="alert">
			<span class="glyphicon glyphicon-info-sign"></span>
			Select the media type and use the map to point the locations that you prefer
		</div>

		<br>

		<div class="row">
			<div class="col-xs-4">
				<p><label for="myPlaceTextBox">Location</label>
					<input class="form-control"  type="text" id="myPlaceTextBox"/>
				</p>
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
				<p>
                                
				<label for="first_name">Media Type Required</label>
				<select name="mec_id[]" id="mec_id[]" data-placeholder="Type Media Type" style="width:100%;" multiple
				        class="chosen-select" tabindex="8">

					<?php
					foreach ($may_asset_types as $row) {
						echo "<option value=\"$row->mec_id\" >$row->mec_description</option>";
					}
					?>
				</select>
				</p>

				<p>
					<label for="dirst_name">Duration</label>
					<select name="duration[]" data-placeholder="Please Select Duration" style="width:100%;" multiple
					        class=" chosen-select" tabindex="8">

						<?php
						foreach ($durations as $row) {
							echo "<option value=\"$row->days\" " . ((isset($_POST['days']) &&
									$_POST['days'] == $row->tow_description) ? 'selected="selected"' : '') . " >$row->description</option>";
						}
						?>


					</select>
				</p>

				<div class="row">
					<p class="col-xs-6">
						<label for="first_name">From Date</label>
						<input type="text" name="first_name" id="first_name" class="form-control">
					</p>

					<p class="col-xs-6">
						<label for="first_name">To Date</label>
						<input type="text" vname="first_name" id="first_name" class="form-control">
					</p>
				</div>

				<div class="text-center">
					<input name="filter" type="submit" class="btn btn-primary" value="Apply Filter">
				</div>
				<p>&nbsp;</p>

			</div>

			<div class="col-xs-8">

				<div id="map-canvas-sell"></div>

			</div>
		</div>

		<br>
		<br>
<br>
		<br>
		<h3>Auction Rooms</h3>

		<div class="table_div">
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
		</div>

	</form>


</div><!--Main -->

<?php
//include("footer.php");
?>

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

<div id='modalbak'></div>
<div id='modalwin'>


</div>

  
      