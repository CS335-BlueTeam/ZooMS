<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Map</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 400px;
      }
    </style>
  </head>
  <body>
	<?php
		echo file_get_contents("../html/header.html");
	?>
    <h1>Map of Zoo</h1>
    <div id="map"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXpZEki0U_vGZB2HSR3JRKxDdp9ditQ1M&callback=initMap&libraries=&v=weekly"></script>
    <script>
    function initMap() {
      var map;
      var options = {
        zoom:15,
        center:{lat:41.3318, lng:-72.9483}
      }
      map = new google.maps.Map(document.getElementById('map'), options);
	  
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			map.setCenter(initialLocation);
     });
 }
    }
    </script>
  </body>
</html>
