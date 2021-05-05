<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include '../db/connect_to_db.php';			
			$conn = get_db_connection();
			if( $conn === false ) {
			die( print_r( sqlsrv_errors(), true));
			}

		$tsql = "SELECT animal_id, enclosure_id, health, handler, species, name, sex FROM animals";
		$animals = sqlsrv_query($conn, $tsql);
		if ($animals === false) {
			echo "<script>alert('No Animals!');</script>";
		}
if (!empty($_POST)){
	$action_type = $_POST['action_type'];
	if($action_type=='submit') {
		$behavior = $_POST['behavior'];
		$intake = $_POST['intake'];
		$output = $_POST['output'];
		$emp_id = $_SESSION['employee_id'];
		$animal_id = $_POST['animal_id'];
		$o_date = date("m/d/Y");
		
		$tsql = "INSERT INTO observations VALUES('$behavior','$emp_id','$animal_id','$intake', '$output', '$o_date');";
		$qry = sqlsrv_query($conn, $tsql);
		
		if ($qry === true) {
			echo "<script>alert('Animal observation logged');</script>";
		}
	}
}

?>
<html>
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/styles.css" type="text/css">
    <title>Keeper Logs</title>
</head>
	<body>
		<style>
			.form-group {
				padding: 25px;
			}
			#btn {
				font-size: 15px;
				font-weight: 700;
				color: slate-gray;
			}
			textarea {
				width: 100%;
				height: 50px;
			}
			label {
				font-size: 20px;
				padding-top: 5px;
			}
			p {
				font-size: 20px;
				display: inline;
				font-weight: bold;
				padding-left: 20px;
			}
			table thead th {
				padding: 10px;
			}
			table tbody td {
				text-align: center;
			}
		</style>
		<?php echo file_get_contents("../html/header.php"); ?>
			<div class="container">
			<div class="card">
			<form method="POST">
				<div class="form-group">
					<label for="id" style="font-weight:bold">Observing as: </label>
						<p><?php echo htmlspecialchars($_SESSION["employee_name"]); ?></p>
				</div>
				<div class="form-group">
					<label for="id" style="font-weight:bold">Date will be logged as (mm/dd/yyyy): </label>
					<p><?php echo date("m/d/Y"); ?></p>
				</div>
				
				<div class="form-group">
					<label for="behavior">Behavior: </label>
					<div>
						<textarea id="behavior" name="behavior"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="intake">Intake: </label>
					<div>
						<textarea id="intake" name="intake"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="output">Output: </label>
					<div>
						<textarea id="output" name="output"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="animal">Animals in Zoo</label>
					<div>
					<table class="table"> 
						<thead>
							<tr>
								<th>Animal ID</th>
								<th>Name</th>
								<th>Enclosure ID</th>
								<th>Health</th>
								<th>Handler</th>
								<th>Species</th>
								<th>Sex</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($row = sqlsrv_fetch_array($animals)) {
						?>
							<tr>
								<td><?=$row['animal_id']?></td>
								<td><?=$row['name']?></td>
								<td><?=$row['enclosure_id'] ?></td>
								<td><?=$row['health'] ?></td>
								<td><?=$row['handler'] ?></td>
								<td><?=$row['species'] ?></td>
								<td><?=$row['sex'] ?></td>
							</tr>
							<?php $IDs[]=$row["animal_id"];
						}
						?>
						</tbody>
					</table>
					<label>Select Animal to Log: <label>
						<select for="animal_id" id="animal_id" name="animal_id">
								<?php
								foreach (array_unique($IDs) as $id){
									echo '<option value="'.$id.'">'.$id."</option>";
								}
								?>
						</select>
					</div>
				
				<input id="btn" class="btn btn-primary" type="hidden" name="action_type" value=<?="Submit"?>></input>
				<input id="btn" class="btn btn-primary" type="submit" value="Submit"></input>
			</form>
			</div>
			</div>
		<?php
			sqlsrv_close( $conn );
		?>
	</body>
</html>