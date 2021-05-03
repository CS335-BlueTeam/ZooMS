<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $myRoot = $_SERVER["DOCUMENT_ROOT"];
    
    include($myRoot . '/myproject/index.php');
    ?>
    <title>ZooMS</title>
</head>
<body>
    <center>
        
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$animalID =  (int) $_REQUEST['animalID'];
			$animalDiet = $_REQUEST['animalDiet'];

			if (isset($_POST['submitNewRecord'])) {
				$query = "INSERT INTO nutrition VALUES('$animalID','$animalDiet')";
				sqlsrv_query( $conn, $query );
			} else {
				$query = "UPDATE nutrition SET diet = '$animalDiet' WHERE animal_ID = 1";
				sqlsrv_query( $conn, $query );
			}
		}

		header("Location: ./Veterinarian_admin_page.php");
        ?>
    </center>
</body>
</html>
