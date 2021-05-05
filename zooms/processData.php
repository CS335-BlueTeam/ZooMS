<?php
        session_start();

        $myRoot = $_SERVER["DOCUMENT_ROOT"];
        include ('C:/xampp/htdocs/ZooMS/zooms/db/connect_to_db.php');
        $conn = get_db_connection();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if (isset($_POST['submitNewAnimalDiet'])) {
                $animalID =  (int) $_REQUEST['animalID'];
                $animalDiet = $_REQUEST['animalDiet'];

				$query = "INSERT INTO nutrition VALUES('$animalID','$animalDiet')";
				sqlsrv_query( $conn, $query );

                $_SESSION['message'] = "Animal Record Created!";
                $_SESSION['msg_type'] = "success";

			} else  {
                $animalID =  (int) $_REQUEST['animalID'];
                $animalDiet = $_REQUEST['animalDiet'];
                $query = "UPDATE nutrition SET diet = '$animalDiet' WHERE animal_ID = $animalID";
                sqlsrv_query( $conn, $query );

                $_SESSION['message'] = "Animal Record Updated!";
                $_SESSION['msg_type'] = "success";
            }


		}

		header("Location: ./Veterinarian_admin_page.php");
		exit;
