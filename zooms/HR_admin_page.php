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
    
   
    ?>
    <title>ZooMS</title>
</head>
<body>
	<div id="container">
		<div id="left-pane">
			<div class="nav nav-pills d-flex flex-column p-3 text-white bg-dark sidebar" role="tablist" style="width: 280px;">
			  <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
				
				<span class="fs-4">HR Administrator</span>
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
				<button id="addNewEmployeeButton">Add New Employee</button>
				<button id="updateEmployeeButton">Update Employee</button>
				
					<form id="form" class="row g-3" action="./addNewEmployee.php" target="_self" method="post">
					<h3>Insert New Employee Data</h3>
					  <div class="col-md-6">
						<label for="inputfname" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname" id="inputfname">
					  </div>
					  <div class="col-md-6">
						<label for="inputlname" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname" id="inputlname">
					  </div>
					  <div class="col-12">
						<label for="inputAddress" class="form-label">Address</label>
						<input type="text" class="form-control" name="address1" id="inputAddress" placeholder="1234 Main St">
					  </div>
					  <div class="col-12">
						<label for="inputAddress2" class="form-label">Address 2</label>
						<input type="text" class="form-control" name="address2" id="inputAddress2" placeholder="Apartment, studio, or floor">
					  </div>
					  <div class="col-md-6">
						<label for="inputCity" class="form-label">City</label>
						<input type="text" class="form-control" name="city" id="inputCity">
					  </div>
					  <div class="col-md-4">
						<label for="inputState" class="form-label">State</label>
						<select id="inputState" name="state" class="form-select">
						  <option selected>Choose...</option>
						  <option>...</option>
						</select>
					  </div>
					  <div class="col-md-2">
						<label for="inputZip" class="form-label">Zip</label>
						<input type="text" name="zipcode" class="form-control" id="inputZip">
					  </div>
					  <div class="col-md-6">
						<label for="inputStartDate" class="form-label">Start Date</label>
						<input type="date" name="startDate" class="form-control" id="inputStartDate">
					  </div>
					  <div class="col-md-6">
						<label for="inputEndDate" class="form-label">End Date</label>
						<input type="date" name="endDate" class="form-control" id="inputEndDate">
					  </div>
					  <div class="col-md-6">
						<label for="inputBankInfo" class="form-label">Bank Account Number</label>
						<input type="text" name="bankAccountNumber" class="form-control" id="inputBankInfo">
					  </div>
					  <div class="col-md-6">
						<label for="inputDepartment" class="form-label">Department</label>
						<input type="text" name="department" class="form-control" id="inputDepartment">
					  </div>
					  <div class="col-md-6">
						<label for="inputSalary" class="form-label">Salary</label>
						<input type="number" step="0.01" name="salary" class="form-control" id="inputSalary">
					  </div>
					  <div class="col-md-6">
						<label for="inputHourlyPay" class="form-label">Hourly Pay</label>
						<input type="number" step="0.01" name="hourlyPay" class="form-control" id="inputHourlyPay">
					  </div>
					  <div class="col-md-6">
						<label for="inputPosition" class="form-label">Position</label>
						<input type="text" name="position" class="form-control" id="inputPosition">
					  </div>
					  <div class="col-md-6">
						<label for="inputDefaultPassword" class="form-label">Password</label>
						<input type="password" step="0.01" name="password" class="form-control" id="inputDefaultPassword">
					  </div>
					  <div class="col-12">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" id="gridCheck">
						  <label class="form-check-label" for="gridCheck">
							Check me out
						  </label>
						</div>
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary">Sign in</button>
					  </div>
				
					</form>
				</div>
			</div>
			
		</div>
	</div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="./js/javascript.js"></script>
</body>
</html>