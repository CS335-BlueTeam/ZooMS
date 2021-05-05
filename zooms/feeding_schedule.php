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
	include($myRoot . '/myproject/index.php');
   
    ?>
    <title>ZooMS</title>
</head>
<body>
	<div id="container">
		<div id="left-pane">
			<div class="nav nav-pills d-flex flex-column p-3 text-white bg-dark sidebar" role="tablist" style="width: 280px;">
			  <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
				
				<span class="fs-4">Veterinarian Services</span>
			  </a>
			  <hr>
			  <ul class="nav nav-pills flex-column mb-auto">
				<li class="nav-item">
				  <a href="#" class="nav-link active" id="home-pill" data-bs-toggle="pill" data-bs-target="#home" type="button" role="tablist" aria-orientation="vertical">
					
					Home
				  </a>
				</li>
				<li>
				  <a href="#" class="nav-link text-white" id="dashboard-pill" data-bs-toggle="pill" data-bs-target="#dashboard" type="button" role="tablist" aria-orientation="vertical">
					
					Dashboard
				  </a>
				</li>
				
			  </ul>
			  <hr>
			  <div class="dropdown">
				<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
				  <!-- <img src="" alt="mdo" width="32" height="32" class="rounded-circle me-2"> -->
				  <strong>TaNasha Hilton</strong>
				</a>
				<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
				  <li><a class="dropdown-item" href="#">Settings</a></li>
				  <li><a class="dropdown-item" href="#">Profile</a></li>
				  <li><hr class="dropdown-divider"></li>
				  <li><a class="dropdown-item" href="#">Sign out</a></li>
				</ul>
			  </div>
			</div>
		</div>
		<div id="right-pane">
			<div class="tab-content" id="v-pills-tabContent">
			
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-pill">
				Hello
				</div>

				<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-pill">
					<button id="viewAllNutritionRecordButton">View All Feeding Records </button>
					<button id="addNewAnimalRecordButton">Add Feeding Record </button>
					<button id="updateDietButton">Update Feeding Record</button>
					
					<div id="allNutritionRecords">
					<h3>Feeding Records</h3>
						<?php 
								
								$query = "SELECT feedschedules.animal_ID, animals.species, animals.health, feedschedules.feed_time, feedschedules.diet FROM nutrition LEFT OUTER JOIN animals ON feedschedules.animal_ID = animals.animal_ID";
								$nutrition = sqlsrv_query( $conn, $query );
								
								echo "<table class='table table-dark table-striped table-hover'>
										<tr>
										<th>Animal ID</th>
										<th>Species</th>
										<th>Health</th>
                                        <th>Feeding Times</th>
										<th>Diet</th>
										</tr>";
								
								while ($row = sqlsrv_fetch_array($nutrition, SQLSRV_FETCH_ASSOC))
								{
									echo "<tr>";
									echo "<td>" . $row['animal_ID'] . "</td>";
									echo "<td>" . $row['species'] . "</td>";
									echo "<td>" . $row['health'] . "</td>";
                                    echo "<td>" . $row['feed_time'] . "</td>";
									echo "<td>" . $row['diet'] . "</td>";
									echo "</tr>";

								}
								echo "</table>";							
						?>
				
					</div>
					
				
					<form id="newFeedingForm" class="row g-3" action="./addNewFeedingRecord.php" method="post">
					<h3>Insert Feeding Schedule for New Animal</h3>
				
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
		
						<label for="animalFeeding" class="form-label">Insert Feeding Schedule</label>
						<input type="text" class="form-control" name="animalFeeding" id="animalFeeding">
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary" id="submitNewFeedingRecord" name="">Submit</button>
					  </div>
				
					</form>



					<form id="updateFeedingForm" class="row g-3" action="./addNewFeedingRecord.php" method="post">
					<h3>Update Feeding Schedule for Animal</h3>
				
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
		
						<label for="animalFeeding" class="form-label">Insert New Diet</label>
						<input type="text" class="form-control" name="animalFeeding" id="animalFeeding">
							
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary" id="submitUpdateAnimalRecord" name="">Submit</button>
					  </div>
				
					</form>

					
				</div>
			</div>
			
		</div>
	</div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="./js/Vet.js"></script>
</body>
</html>
