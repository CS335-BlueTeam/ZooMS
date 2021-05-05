<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php
      $myRoot = $_SERVER["DOCUMENT_ROOT"];
      include ($myRoot . '\ZooMS\zooms\db\connect_to_db.php');
      $conn = get_db_connection();

      ?>
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
      <link rel="stylesheet" href="../css/styles.css" type="text/css">
  </head>
  <body>
	<?php
		echo file_get_contents("../html/header.php");
	?>
    <h1>Map of Zoo</h1>
    <div id="map"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXpZEki0U_vGZB2HSR3JRKxDdp9ditQ1M&callback=initMap&libraries=&v=weekly"></script>
    <script>
    function initMap() {
      var map;
      var options = {
        zoom:15,
        center:{lat:40.8506, lng:-73.8770}
      }
      map = new google.maps.Map(document.getElementById('map'), options);
	  /*
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			map.setCenter(initialLocation);
     });
 }*/
    }
    
    </script>
    <div id="allNutritionRecords">

        <?php


        $query = "SELECT department.dept_name, enclosures.place FROM enclosures left outer join department on department.enclosure_ID = enclosures.enclosure_ID";

        $department = sqlsrv_query( $conn, $query ); ?>

        <table class='table table-dark table-striped table-hover'>
            <tr>
                <th>Department Name</th>
                <th>Buildings/Enclosures</th>
            </tr>

            <?php
            while ($row = sqlsrv_fetch_array($department, SQLSRV_FETCH_ASSOC)): ?>

                <tr>
                    <td> <?php echo $row['dept_name']; ?></td>
                    <td> <?php echo $row['place']; ?></td>

                </tr>
            <?php endwhile ?>

        </table>

    </div>
  </body>
</html>
