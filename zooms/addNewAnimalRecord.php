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

					<form id="newAnimalForm" class="row g-3" action="./addNewAnimalRecord.php" method="post">
					<h3>Insert Diet for New Animal</h3>
				
					  <div class="col-md-6">
						<label for="taskOption">Choose the animal ID: </label>
						<select name="animalID">
							
							<?php 
								$query = "SELECT animal_ID FROM animals";
								$animalIDs = sqlsrv_query( $conn, $query );
								
								while ($row = sqlsrv_fetch_array($animalIDs, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$row['animal_ID'].'">'.$row['animal_ID'].'</option>';
								}							
							?>
						</select><br>
		
						<label for="animalDiet" class="form-label">Insert Diet</label>
						<input type="text" class="form-control" name="animalDiet" id="animalDiet">
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary" id="submitNewAnimalRecord" name="">Submit</button>
					  </div>
				
					</form>



					<form id="updateAnimalForm" class="row g-3" action="./addNewAnimalRecord.php" method="post">
					<h3>Update Diet for Animal</h3>
				
					  <div class="col-md-6">
						<label for="taskOption">Choose the animal ID: </label>
						<select name="animalID">
						
							
							<?php 
								$query = "SELECT animal_ID FROM animals";
								$animalIDs = sqlsrv_query( $conn, $query );
								
								while ($row = sqlsrv_fetch_array($animalIDs, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$row['animal_ID'].'">'.$row['animal_ID'].'</option>';
								}							
							?>
						</select><br>
		
						<label for="animalDiet" class="form-label">Insert New Diet</label>
						<input type="text" class="form-control" name="animalDiet" id="animalDiet">
							
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary" id="submitUpdateAnimalRecord" name="">Submit</button>
					  </div>
				
					</form>
    </center>
</body>
</html>
