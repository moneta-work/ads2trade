<?php //var_dump($latitude); ?>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 90%;
		width: 80%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">
var rad = <?= $radius; ?>;
var lat = <?= $latitude; ?>;
var lon = <?= $longitude; ?>;
var map;
var infowindow;

function initialize() {
  var pyrmont = new google.maps.LatLng(lat, lon);//new google.maps.LatLng(-26.063214, 27.943271);

  map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: pyrmont,
    zoom: 15
  });

  var request = {
    location: pyrmont,
    radius: rad,
    types: ['store']
  };
  infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

	</script>
	
	</head>
  <body>
    <div id="map-canvas"></div>
	<div>
	<form action='' method='POST'>
<input type="button" value="Back" onClick='location.href="simple_marker/radius_search"'>
</form>
	</div>
  </body>
</html>