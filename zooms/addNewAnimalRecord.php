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
   
        // Taking all 5 values from the form data(input)
        $animalID =  $_REQUEST['animalID'];
        $animalDiet = $_REQUEST['animalDiet'];
		
		$query = "INSERT INTO nutrition VALUES('$animalID','$animalDiet')";
		$result = sqlsrv_query( $conn, $query );
		
		header("Location: ./Veterinarian_admin_page.php");
        ?>
    </center>
</body>
</html>