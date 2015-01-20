<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
	<style type="text/css">
		html {
			height: 100%
		}

		body {
			height: 100%;
			margin: 0;
			padding: 0
		}

		#map-canvas {
			height: 50%;
			width: 50%;
		}

		#details {
			width: 20%;
			top: 0px;
			right: 0px;
			background-color: rgba(0, 0, 0, 0.75);

			height: 100%;
			position: fixed;
			z-index: 999;
			display: none;
			padding: 20px;
		}

		#details h2, #details p {
			color: #fff;
		}

	</style>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="mapping/css/mapping_styles.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script type="text/javascript"
	        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA5bJNyTu51BbOwopYMiV93RkuPO1yoSqA&sensor=false"></script>

	<script type="text/javascript" src="mapping/js/AdsMap.js"></script>
<!--	<script src="js/markerclusterer.js"></script>-->
<!--	<script src="js/oms.min.js"></script>-->
<!--	<script src="js/html2canvas.js"></script>-->
	<script type="text/javascript">
		var base_url = 'http://localhost/ads2trade/';
		var adsMap = false;
		var campaign = false;
		function initialize() {
			var mapOptions = {
				center: new google.maps.LatLng(-26.2044, 28.0456),
				zoom: 6

			};
			var minClusterZoom = 14
			var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

			var info = new google.maps.InfoWindow({

			});

			var markers = [];
			for (var i = 0; i < 30; i++) {
				(function (i) {
					var modlat = Math.random();
					var modlng = Math.random();
					if (i % 2 == 0) {
						modlat = modlat * -1;
						modlng = modlng * -1;
					}
					if (i < 20) {
						modlat = Math.random() / 700;
						modlng = Math.random() / 700;
					}
					var latlng = new google.maps.LatLng(-26.2044 + modlat, 28.0456 + modlng);
					var marker_rand = Math.floor(Math.random() * 7) + 1
					var marker = new google.maps.Marker({
						position: latlng,
						title: 'Item ' + i,
						icon: base_url + '/assets/mapping/images/media_' + marker_rand + '.png',
						map: map,
						radius: 1000,
						type: marker_rand
					});

					markers.push(marker)
				})(i);

			}

			var optOptions = {
				urlBase: base_url,
				markers: markers,
				showRadii: false,
				mode: 'select', //select | input
				currentFilterCriteria: {
					Area: 'South Africa',
					'Campaign Start': '2014-08-01',
					'Campaign End': '2014-08-31'
				}
			}
			var clusterOptions = {};
			var spiderOptions = {};
			var html2canvasOptions = {
				logging: true
			};
			adsMap = new AdsMap(map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);

			campaign = new AdsMap.Campaign(adsMap, {url: base_url + '/assets/mapping/src/campaign_upload.php'}, {});
			$('body').append(campaign.edit());
		}
		google.maps.event.addDomListener(window, 'load', initialize);


	</script>

</head>
<body>
<div id="map-canvas"></div>
<div id="details">
	<h2></h2>

	<p></p>
	<button class="btn btn-success"><span class="glyphicon glyphicon-usd"></span> Buy Now</button>
	<button class="btn btn-primary"><span class="glyphicon glyphicon-bullhorn"></span> Bid</button>
	<button class="btn btn-info"><span class="glyphicon glyphicon-comment"></span> RFP</button>
</div>

</body>
</html>