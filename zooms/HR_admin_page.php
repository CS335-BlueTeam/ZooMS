<?php
//// Initialize the session
//session_start();
//
//// Check if the user is logged in, if not then redirect to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: login.php");
//    exit;
////}elseif($_SESSION["department"]!=='Human Resources'){
////    header("location: ./view/login.php");
////    echo "You are not in Accounting.";
////    exit;
//}
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <title>ZooMS</title>
</head>
<body>
    <?php
    echo file_get_contents("./html/header.php");

    include ('C:/xampp/htdocs/ZooMS/zooms/db/connect_to_db.php');
    $conn = get_db_connection();
    ?>
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
              </ul>
				

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
				
					<form id="form" class="row g-3" action="processHRData.php" method="post">
					<h3>Insert New Employee Data</h3>
					  <div class="col-md-6">
						<label for="inputfname" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname" id="inputfname">
					  </div>
					  <div class="col-md-6">
						<label for="inputlname" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname" id="inputlname">
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
						<label for="inputDefaultPassword" class="form-label">Default Password</label>
						<input type="password" step="0.01" name="password" class="form-control" id="inputDefaultPassword">
					  </div>
					  <div class="col-12">
						<button type="submit" class="btn btn-primary" id='submitNewEmployeeRecord' name="submitNewEmployeeRecord">Submit</button>
					  </div>
				
					</form>
					
					<form id="updateForm" class="row g-3" action="processHRData.php" method="post">
					<h3>Update Employee Data</h3>
						<div class="input-group">
						  <span class="input-group-text">Enter Employee's First and Last Name</span>
						  <input type="text" aria-label="First name" id="firstName" class="form-control">
						  <input type="text" aria-label="Last name" class="form-control">
						</div>
					  <div class="col-md-6">
						<label for="inputfname" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname" id="inputfname">
					  </div>
					  <div class="col-md-6">
						<label for="inputlname" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname" id="inputlname">
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
						<label for="inputDefaultPassword" class="form-label">Default Password</label>
						<input type="password" step="0.01" name="password" class="form-control" id="inputDefaultPassword">
					  </div>
					  <div class="col-12">
						<button type="submit" id="submitUpdateEmployeeRecord" class="btn btn-primary" name="submitUpdateEmployeeRecord">Update</button>
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
