<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Street View service</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
function initialize() {
  var fenway = new google.maps.LatLng(-26.07387,28.01199);
  var mapOptions = {
    center: fenway,
    zoom: 14
  };
  var map = new google.maps.Map(
      document.getElementById('map-canvas'), mapOptions);
  var panoramaOptions = {
    position: fenway,
    pov: {
      heading: 34,
      pitch: 10
    }
  };
  var panorama = new  google.maps.StreetViewPanorama(document.getElementById('pano'),panoramaOptions);
  map.setStreetView(panorama);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas" style="width: 50%; height: 80%"></div>
    <div id="pano" style="position:absolute; left:410px; top: 8px; width: 400px; height: 300px;"></div>
  </body>
</html>