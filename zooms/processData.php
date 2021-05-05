<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$animalID =  (int) $_REQUEST['animalID'];
			$animalDiet = $_REQUEST['animalDiet'];

			if (isset($_POST['submitNewAnimalDiet'])) {
				$query = "INSERT INTO nutrition VALUES('$animalID','$animalDiet')";
				sqlsrv_query( $conn, $query );
			} else {
				$query = "UPDATE nutrition SET diet = '$animalDiet' WHERE animal_ID = $animalID";
				sqlsrv_query( $conn, $query );
			}
		}

		header("Location: ./Veterinarian_admin_page.php");
