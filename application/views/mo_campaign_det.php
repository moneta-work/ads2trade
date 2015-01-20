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


<div class="breadcrumbs">
	<h1><span class="glyphicon glyphicon-list-alt"></span>RFP :: RFP Details</h1>
</div>
<?php


$this->db->select('distinct(auction) as auction');
$this->db->from('auctions');
$this->db->join('watch_list', 'watch_list.auction = auctions.id');
$select_query1 = $this->db->get();


$user = $this->session->userdata('user_id');
                $this->db->where('med_id', $user);
                $this->db->select('*');
                $this->db->from('proposal');
                $this->db->join('campaign','proposal.cam_id = campaign.cam_id');
		$select_query = $this->db->get();
?>

<div class="main col-xs-12">
    <form name="myne" method="post" action="../new_campaign/submit_proposal?p=campaigns&id=<?php echo $_GET['id'];?>">
	<ul class="nav navbar-nav section-menu">
			<li ><a href="../load_stock/view_my_assets">My Stock</a></li>
			<li class="active"><a href="../new_campaign/mo_proposals">Incoming Proposals<span class="badge"><?php echo $select_query->num_rows; ?></span></a></li>
			<li><a href="../load_stock/watch_list">Sold Items<span	class="badge"><?php echo $select_query1->num_rows; ?></span></a></li>
			
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
					<label for="dirst_name">Duration</label>
                                        
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
		<h3>Asset List</h3>

		<div class="table_div">
			<table class="table table-bordered headed" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Asset Name</th>
                                        <th>Media Type</th>
					<th>Respond By</th>
					<th>Campaign To Start</th>
					<th>End Date</th>
					<th>Price</th>
                                        <th>Quotation Price</th>
                                        <th>Available From</th>
                                        <th>Available To</th>
                                        <th>Select</th>
				</tr>
				</thead>

				<tbody>
				<?php
				$count = 0;
                                $dat = '';
                                $all = '';
				if (!empty($rfp_det)) {
					foreach ($rfp_det as $row) {
                                                $all = $all.','.$row->ass_id;
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
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $row->ass_name; ?></a>
							</td>
                                                        
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php echo $dat; ?></a></td>
							
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">01.08.2014</a></td>
							
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>"><?php $row->mec_id; ?></a>
							</td>
							<td><a href="auction_details?duration=<?php echo $row->loc_id; ?>&aset=<?php echo $row->mec_id; ?>">08.08.2014</a></td>
							<td><?php echo $row->ass_production_price_SCY ;?></td>
                                                        <td><input type="text" id="<?php echo $row->ass_id;?>" value="<?php echo $row->ass_production_price_SCY ;?>" name="<?php echo $row->ass_id;?>"</td>
                                                        <td><?php  $dates = (date('W') + 1);?><select name="week_<?php echo $row->ass_id;?>" id="week_<?php echo $row->ass_id;?>">
<?php for ($i = date('W'); $i <= 52; $i++) { ?>
<option value="<?php echo $i; ?>" <?php if ($i == $dates) { echo 'selected="selected"';} ?>><?php echo 'Week '.$i; ?></option>
<?php } ?>
</select></td>
							<td><select name="week1_<?php echo $row->ass_id;?>" id="week1_<?php echo $row->ass_id;?>">
<?php for ($i = date('W'); $i <= 52; $i++) { ?>
<option value="<?php echo $i; ?>" <?php if ($i == $dates ) { echo 'selected="selected"';} ?>><?php echo 'Week '.$i; ?></option>
<?php } ?>
</select></td>
						
                                                        <td><input type="checkbox" checked onclick="selecta('chk_<?php echo $row->ass_id;?>')" id="chk_<?php echo $row->ass_id;?>"></td>
                                                </tr>
					<?php
					}
				} else {
					?>
					<td colspan="10">No Records Found</td> <?php

				}?>
                                         <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
                        <td></td>
                        <td></td>
                        <td></td>
			<td>
                            <button type="button" onclick="selectall()" class="btn btn-success">Select All</button>
			</td>
						</tr>
                                        <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
                        
			<td>
				<button type="button" onclick="javascript:window.history.back();" class="btn btn-default">Back</button>
			</td>
			<td><input name="allasset" id="allasset" type="hidden" value="<?php echo $all;?>">
                            <button type="button" onclick="submits()" class="btn btn-success">Submit My Quotation To The Operator</button>
			</td><td></td>
						</tr>
                                               
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

function selectall(){
var inputs = document.getElementsByTagName("input"); //or
//document.forms[0].elements;  
var cbs = []; //will contain all checkboxes  
var checked = []; //will contain all checked checkboxes  
for (var i = 0; i < inputs.length; i++) {  
    if (inputs[i].id.indexOf('chk_') == 0) { 
       // cbs.push(inputs[i]);  
       // if (inputs[i].checked) {  ;
       var names = inputs[i].id;
             document.getElementById(names).checked = true;
          //  checked.push(inputs[i]);  
        //}  
    }  
}  
var nbCbs = cbs.length; //number of checkboxes  
var nbChecked = checked.length; //number of checked checkboxes    
   
}

function selecta(b){
    if (document.getElementById(b).checked == true){
        var str = b;
        var res = str.replace('chk_', "");
        if (document.getElementById(res).value == ''){
           alert('Please Enter Amount for Asset '+res);
           document.getElementById(b).checked = false;
           document.getElementById(res).focus();
       }else{
           document.getElementById("allasset").value = document.getElementById("allasset").value +','+ res;
       } 
    }else{
        var str = b;
        var res = str.replace('chk_', "");
        var res2 = document.getElementById("allasset").value ;
        var res1 = res2.replace(','+res, "");    
        document.getElementById(res).value = '';
        
        document.getElementById("allasset").value = res1;
    
}}

function submits(){
  allvalues = document.getElementById("allasset").value;
    if (allvalues != ''){
    document.forms['myne'].submit();
    }else{
        
        alert("Please Select Assets");
        
    }  
    
}

</script>

<div id='modalbak'></div>
<div id='modalwin'>


</div>

  
      