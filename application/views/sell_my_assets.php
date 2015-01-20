<?php $count = 0;
foreach ($mmm as $row) {
    
    $count = $count + 1;
}

?>
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
   .gray-gradiant-background {
    background: linear-gradient(to bottom, #FFF 0%, #F3F3F3 100%) repeat scroll 0% 0% transparent;
    padding-bottom: 5px;
}
.img-thumbnail {
    padding: 4px;
    line-height: 1.42857;
    background-color: #FFF;
    border: 1px solid #DDD;
    border-radius: 4px;
    transition: all 0.2s ease-in-out 0s;
    display: inline-block;
    max-width: 100%;
    height: auto;
}
.img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
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
	<h1><span class="glyphicon glyphicon-list-alt"></span>My Stock</h1>
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
			<li class="active"><a href="../load_stock/view_my_assets">My Stock</a></li>
			<li><a href="../new_campaign/mo_proposals">Incoming Proposals<span class="badge"><?php echo $select_query->num_rows; ?></span></a></li>
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
		<br>
 <div class="table_div">
        
        <div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="container">
							<div class="sbInRow ">
								<form novalidate="novalidate" class="form-inline">
																
									<div class="form-group pull-right">
										<span class="help-block">Found <?php echo $count;?> Assets</span>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
	<div class="list-group" data-bind="foreach: pagedRows">
						
  
      <?php
            $a = 0;
            foreach ($mm as $row) {
              $a = $a + 1;
              $b = 'map_'.$a; 
              $c = 'map_canvas'.$a; 
			  
			$this->db->where('tow_id', $row->loc_id);
                        $select_query = $this->db->get('town');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$town=$rows->tow_description;
		}
		

		}
                
                
                          
                
                
                   $this->db->where('ass_id', $row->ass_id);
                  
               //   $this->db->where('use_id', $user);
		$this->db->select('*');
		$this->db->from('auctions');  
                
		$this->db->join('durations', 'durations.days = auctions.duration');
               $select_query = $this->db->get();
                  
                  
                 	//$this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
                            $found = 1;                        
				$towns=$rows->minimum_bid;
                                $from = $rows->starts;
                                $ends = $rows->ends;
                                $duration = $rows->description;
                                $minimum_bid = $rows->minimum_bid;
                                $buy_now = $rows->buy_now;
                                $increment = $rows->increment;
                                $reference = $rows->id;
                                }
		}else{
                                $towns='';
                                $from = '';
                                $ends = '';
                                $duration = '';
                                $minimum_bid = '';
                                $buy_now = '0.00';
                                $increment = '0.00'; 
                                $reference = 'N/A';
                                
                    
                }
			  
			  
			  
            ?>
<a href="asset?ass_id=<?php echo $row->ass_id;?>" class="list-group-item gray-gradiant-background">

							<div class="row">
								<div class="col-md-2 col-md-3 col-sm-3 col-xs-4">
									<div style="display: none;" data-bind="visible : IsSold" class="soldVehicleList">&nbsp;</div>
									<img src="<?php echo $row->url;?>"  alt="<?php echo $row->ass_name;?>" class="img-responsive img-thumbnail">

									<div class="hidden-xs">
										<span class="text-blue-bold">VIEW DETAILS  </span>
									</div>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
									<div>
										<div class="row">
											<div class="col-sm-12">
												<div class="pull-left">
													
													<h4 class="media-heading pull-left" data-bind="text: Title"><?php echo $row->ass_name;?></h4>
													<small>&nbsp;</small>
												</div>

												<span class="pull-right yes360" style="display: inline-block; height:28px; width:100px;" data-bind="css:{yes360 : HasThreeSixty, div360 : !HasThreeSixty}"></span>
											</div>
										</div>

										<hr style="margin-top:5px;">
										<div class="row">

											<div class="col-xs-12 col-sm-6">
												<div>
													<div>
														<span class="detailField">Reference :</span>
														<span data-bind="text: PublicReference == null ? '' : PublicReference " class="detailFieldDetail"><?php echo $reference;?></span>
													</div>
													<div>
														<span class="detailField">Increment :</span><!--"detailField"-->
														<span data-original-title="Code" title="" data-bind="attr:{title: VehicleCode == 0 ? 'To be confirmed' : 'Code'}, text: VehicleCode == 0 ? 'TBC' : VehicleCode" class="detailFieldDetail"><?php echo $increment;?></span>
													</div>

													<span class="detailField">Asset Category :</span><!--"detailField"-->
													<span class="detailFieldDetail" data-bind="text:VehicleCategory"><?php echo $row->mec_description;?></span>
													<!--"detailFieldDetail"-->

													<div data-bind="visible: !IsComingSoon">
														<span class="detailField">Duration:</span><!--"detailField"-->
														<span class="detailFieldDetail" data-bind="text: HasReserve ? 'Yes':'No'"><?php echo $duration;?></span>
														<!--"detailFieldDetail"-->
													</div>
												</div>
											</div>
											<div class="col-sm-6">

												<div class="pull-right" style="display: inline-block; padding-left: 15px;" data-bind="visible: IsTimedBid">
													<span class="sales-type" data-bind="visible: IsTimedBid">Bids:  <span data-original-title="Total number of successfull bids made" title="" data-bind="text: TotalBidsMade">2</span> </span>
													<span class="sales-type" data-bind="visible: IsTimedBid">
														Highest Bid: <span data-original-title="Highest successfull bid made" title="" data-bind="text: HighestTimedBidAmount != null ? HighestTimedBidAmountString : 'No Bids'">R 18&nbsp;500</span>
													</span>
													<div>
														<span data-bind="visible: HighestTimedBidAmount >=  ReservePrice" class="text-success detailfield">Minimum Bid : <?php echo $minimum_bid; ?></span>
														<span style="display: none;" data-bind="visible: HighestTimedBidAmount < ReservePrice" class="text-danger detailField">STC : Yes</span>
													</div>

													<span data-bind="visible: !IsTimeBidExpired">Auction Expires: </span><span data-bind="visible: !IsTimeBidExpired, text: TimeBidEndDate"><?php echo $ends;?></span> <span style="display: none;" class="sales-type" data-bind="visible: IsTimeBidExpired">Expired</span>
												</div>
												
												<div class="pull-right" style="display: none; width: 180px; padding-left: 15px;" data-bind="visible: IsAuctionItem">
													<span class="sales-type" style="margin-bottom: 3px; display: none;" data-bind="visible: IsAuctionItem">On Auction</span>
													<span class="sales-type" style="margin-bottom:3px;">
														<b>	Current Bid: <span data-original-title=" highest successfull bid made" title="" data-bind="text: HighestTimedBidAmount != null ? HighestTimedBidAmountString : 'No Bids'">R 18&nbsp;500</span></b>
													</span>
													
													<div style="display: none;" class="placeTimedBid" data-bind="visible: ShowPreBidButton">
														<div>PRE-BID</div> 
													</div>
												</div>

												<div class="pull-right" style="padding-left: 15px; display: inline-block">
													<span style="display: none;" class="sales-type" data-bind="visible: IsSold">Sold</span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsComingSoon">Coming Soon</span>
													<span class="sales-type text-blue" data-bind="visible: IsBuyNow, text: 'Buy Now ' + BuyNowSalesAmountString">Buy Now R <?php echo $buy_now ;?></span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsMakeAnOffer &amp;&amp; IsBuyNow">or best offer</span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsMakeAnOffer &amp;&amp; !IsBuyNow">Make an offer</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<span data-bind="visible: !IsComingSoon"><span href="../load_stock/asset_details3" class="label label-primary" data-bind="text:SiteName">Randburg</span></span>
												<span style="display: none;" data-bind="visible: IsAuctionItem"><span class="label label-primary" data-bind="text:AuctionDateString">01 Jan 0001</span></span>
												<span style="display: none;" data-bind="visible: IsAuctionItem"><span class="label label-primary">Starts: <!--ko text: AuctionTimeString-->Passed<!--/ko--></span></span>
												<span style="display: none;" data-bind="visible: LotNumber>0"><span class="label label-primary">Lot No: <!--ko text: LotNumber-->0<!--/ko--></span></span>
												<span style="display: none;" data-bind="visible: IsAuctionItem &amp;&amp; LotNumber=='0'"><span class="label label-info">To be Lotted</span></span>
												<span><span class="label label-primary">Watching: <!--ko text: WatchCount-->14<!--/ko--></span></span>
												<span id="ca7cc8de-1801-e411-9409-00155d42d62c" data-bind="attr:{id:Id}, visible: IsTimedBid || IsAuctionItem" data-original-title="Bidders">
													<span  href="../load_stock/asset_details3" class="label label-primary">Bids: <!--ko text: TotalBidsMade-->2<!--/ko--></span>
												</span>

											</div>
										</div>
									</div>
								</div>
							</div>

						</a>
      <?php }?>


    </div>
				</div>
				<div class="panel-footer">
					<div class="smd-pagination">
						<div id="pager" class="smd-pager light-theme"><span class="current"></span></a><span class="ellipse"></span></div>
					</div>
				</div>
			</div>



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

  
      