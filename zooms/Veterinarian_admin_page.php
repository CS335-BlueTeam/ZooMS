<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./view/login.php");
    exit;
}elseif($_SESSION["department"]!=='Veterinarian Medicine'){
    header("location: ./view/login.php");
    echo "You are not in Accounting.";
    exit;
}
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
	<?php
    $myRoot = $_SERVER["DOCUMENT_ROOT"];
    include ('C:/xampp/htdocs/ZooMS/zooms/db/connect_to_db.php');
    $conn = get_db_connection();
   
    ?>
    <title>ZooMS</title>
</head>
<body>
    <?php
    echo file_get_contents("./html/header.php");
    ?>
    <?php

    if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
	<div id="container">
		<div id="left-pane">
			<div class="nav nav-pills d-flex flex-column p-3 text-white bg-dark sidebar" role="tablist" style="width: 280px;">
			  <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
				
				<span class="fs-4">Veterinarian Services</span>
			  </a>
			  <hr>
			  <ul class="nav nav-pills flex-column mb-auto">
				<li>
				  <a href="#" class="nav-link text-white" id="dashboard-pill" data-bs-toggle="pill" data-bs-target="#dashboard" type="button" role="tablist" aria-orientation="vertical">
					
					Dashboard
				  </a>
				</li>
				
			  </ul>
			  <hr>
			  <div>
				  <strong>TaNasha Hilton</strong>
			  </div>
			</div>
		</div>
		<div id="right-pane">
			<div class="tab-content" id="v-pills-tabContent">

				<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-pill">
				
					<button id="viewAllNutritionRecordButton">View All Nutrition Records </button>
					<button id="viewAllMedicalRecordButton">View All Medical Records </button>
					<button id="updateDietButton">Add Medical Record</button>
					<button id="updateDietButton">Update Medical Record</button>
					
					<div id="allNutritionRecords">

						<?php 
								

								$query = "SELECT animals.animal_ID, animals.species, animals.health, animals.name, animals.sex, nutrition.diet FROM animals LEFT OUTER JOIN nutrition ON nutrition.animal_ID = animals.animal_ID";

								$nutrition = sqlsrv_query( $conn, $query ); ?>
								
								<table class='table table-dark table-striped table-hover'>
										<tr>
										<th>Animal ID</th>
										<th>Name</th>
										<th>Sex</th>
										<th>Species</th>
										<th>Health</th>
										<th>Diet</th>
										<th colspan="2">Actions</th>
										</tr>
								
								<?php
                                    while ($row = sqlsrv_fetch_array($nutrition, SQLSRV_FETCH_ASSOC)): ?>

									<tr>
									<td> <?php echo $row['animal_ID']; ?></td>
									<td> <?php echo $row['name']; ?></td>
									<td> <?php echo $row['sex']; ?></td>
									<td> <?php echo $row['species']; ?></td>
									<td> <?php echo $row['health']; ?></td>
									<td> <?php echo $row['diet']; ?></td>


                                    <?php if(is_null($row['diet']))
                                    { echo '<td>
                                        <a href="#" class="btn btn-primary addButtons" >Add</a></td>';
                                    } else {
                                        echo '<td>
                                        <a href="#" class="btn btn-primary editButtons" >Edit</a></td>';
                                    }
                                    ?>

									</tr>
                                <?php endwhile ?>

                                </table>
            
					</div>

                    <form id="update" class="row g-3" action="processData.php" method="post">


                        <div class="col-md-8" id="updateFields">
                            <div><label for="taskOption">Choose the animal ID: </label>
                            <select name="animalID">

                                <?php
                                $query = "SELECT animal_ID FROM animals";
                                $animalIDs = sqlsrv_query( $conn, $query );

                                while ($row = sqlsrv_fetch_array($animalIDs, SQLSRV_FETCH_ASSOC))
                                {
                                    echo '<option value="'.$row['animal_ID'].'">'.$row['animal_ID'].'</option>';
                                }
                                ?>
                                </select></div>

                            <div><input type="text" class="form-control-sm" style="width: 100%"name="animalDiet" id="animalDiet" placeholder="Insert Updated Diet..."></div>
                            <div>
                                <button type="submit" class="btn btn-primary" id="submitUpdateAnimalRecord" name="submitUpdatedAnimalDiet">Submit</button>
                            </div>
                        </div>
                    </form>
				
					<form id="dietForNewAnimalForm" class="row g-3" action="processData.php" method="post">
				
					  <div class="col-md-8" id="AddFields">
						<div><label for="taskOption">Choose the animal ID: </label>
						<select name="animalID">
							
							<?php 
								$query = "SELECT animal_ID FROM animals";
								$animalIDs = sqlsrv_query( $conn, $query );
								
								while ($row = sqlsrv_fetch_array($animalIDs, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$row['animal_ID'].'">'.$row['animal_ID'].'</option>';
								}							
							?>
                        </select><br></div>

                          <div><input type="text" class="form-control-sm" style="width: 100%" name="animalDiet" id="animalDiet" placeholder="Insert New Diet..."></div>
                          <div>
                            <button type="submit" class="btn btn-primary" id="submitNewAnimalRecord" name="submitNewAnimalDiet">Submit</button>
                          </div>
                      </div>
                    </form>
					<div id="allMedicalRecords">

<?php 
		

		$query = "SELECT * FROM medicalrecords";

		$medrec = sqlsrv_query( $conn, $query ); ?>
		
		<table class='table table-dark table-striped table-hover'>
				<tr>
				<th>Animal ID</th>
				<th>Appointment</th>
				<th>Health</th>
				<th>Medications</th>
				<th colspan="2">Actions</th>
				</tr>
		
		<?php
			while ($row = sqlsrv_fetch_array($medrec, SQLSRV_FETCH_ASSOC)): ?>

			<tr>
			<td> <?php echo $row['animal_ID']; ?></td>
			<td> <?php echo $row['appointment']; ?></td>
			<td> <?php echo $row['health']; ?></td>
			<td> <?php echo $row['medications']; ?></td>


			<?php if(is_null($row['medications']))
			{ echo '<td>
				<a href="#" class="btn btn-primary addButtons" >Add</a></td>';
			} else {
				echo '<td>
				<a href="#" class="btn btn-primary editButtons" >Edit</a></td>';
			}
			?>

			</tr>
		<?php endwhile ?>

		</table>
	</div>
				</div>
			</div>
			
		</div>
	</div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="./js/Vet.js"></script>
</body>
</html>

