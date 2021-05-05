<?php
session_start();
include '../db/connect_to_db.php';
//echo file_get_contents("../html/header.html");

$conn = get_db_connection();

$usr = $_SESSION["employee_id"];
$emps=sqlsrv_query($conn,"SELECT managerID FROM department WHERE managerID='$usr'");

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else if($emps === false ) {
	echo "<script>alert('MANAGER ONLY ACCESS !');</script>";
	header("refresh: 1; url=welcome.php");
    exit;
}
else{
if(isset($_POST['submit']))	
  {
	$emp_id = $_SESSION['employee_id'];
    $anum= intval($_POST['anum']);
    $species=$_POST['species'];
    $enum= intval($_POST['enum']);
    $health=$_POST['health'];
	$aname=$_POST['aname'];
	$sex=$_POST['sex'];
/*   $aimg=$_FILES["image"]["name"];
	$extension = substr($aimg,strlen($aimg)-4,strlen($aimg));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Image has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$aimg=md5($aimg).time().$extension;
 move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$aimg);
 */
 

 $ret=sqlsrv_query($conn,"select animal_ID from animals where animal_ID='$anum'");
 if( $ret === false) {
    die( print_r( sqlsrv_errors(), true) );
}
 $result=sqlsrv_fetch_array($ret);

 //if(sqlsrv_num_rows($result)>0){
 if($result>0){

echo "<script>alert('This Animal ID is already alloted to other animal');</script>";
    }
    else{
		$tsql = "insert into animals values('$anum','$enum','$health','$emp_id','$species','$aname','$sex')";
        $query=sqlsrv_query($conn, $tsql);

    if ($query) {
    
     echo '<script>alert("Animal detail has been added.")</script>';
  }
  else
    {
       echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}
}
}
  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">		
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/styles.css" type="text/css">
</head>

<body>    
<style>
.form-group {
	padding: 10px;
}
</style>
	<?php echo file_get_contents("../html/header.php"); ?>
    <!-- page container area start -->
    <div class="container"> 
		<div class="card">
			<div class="card-header">
				<h4>Add Animal Detail</h4>
			</div>
			<div class="card-body">
				<form method="post">
					<!--
				 <div class="form-group">
						<label for="exampleInputEmail1">Animal Image</label>
						<input type="file" class="form-control" id="image" name="image" aria-describedby="emailHelp" value="" required="true">
						
					</div> -->
					<?php
						$tsql = "SELECT * FROM employees";
						$qry = sqlsrv_query($conn, $tsql);
						while($row = sqlsrv_fetch_array($qry)) {
							$IDs[]=$row["ID"];
							$fname[]=$row["fname"];
							$lname[]=$row["lname"];
							}
					?>
					<div class="form-group">
						<label for="handler" style="font-weight:bold">Assign a Handler: </label>
						<select name="handler">
							<?php
								foreach (array_unique($IDs) as $id){
									echo "<option>".$lname[$id].", ".$fname[$id]." (ID:".$id.")</option>";
								}
							?>
						</select>
						<?php //echo htmlspecialchars($_SESSION["employee_name"]); ?>
					</div>
					<div class="form-group">
						<label for="aname">Animal Name</label>
						<input type="text" class="form-control" id="aname" name="aname" placeholder="Enter animal name" value="" required="true">
					</div>	
				   <div class="form-group">
						<label for="anum">Animal ID</label>
						<input type="text" class="form-control" id="anum" name="anum" placeholder="Enter animal ID" value="" required="true">
					</div>											
					<div class="form-group">
						<label for="species">Species</label>
						<input type="text" class="form-control" id="species" name="species" placeholder="Enter animal species" value="" required="true">
					</div>
					<?php
						$tsql = "SELECT * FROM enclosures";
						$qry = sqlsrv_query($conn, $tsql);
						while($row = sqlsrv_fetch_array($qry)) {
							$IDs[]=$row["enclosure_ID"];
							$place[]=$row["place"];
							}
					?>
				   <div class="form-group">
						<label for="enum">Enclosure ID</label>
						<select name="enum">
							<?php
								foreach (array_unique($IDs) as $id){
									echo "<option>".$id."-".$place[$id]."</option>";
								}
							?>
						</select>
						<!--<input type="text" class="form-control" id="enum" name="enum" placeholder="Enter enclosure ID" value="" required="true">--->
					</div>
				  <div class="form-group">
						<label for="health">Status</label>
						<select name="health">
							<option name="Healthy" value="Healthy">Healthy</option>
							<option name="Sick" value="Sick">Sick</option>
							<option name="Rented" value="Rented">Rented</option>
						</select>
					</div>
					<div class="form-group">
						<label for="sex">Sex</label>
						<select name="sex">
							<option name="Male" value="Male">Male</option>
							<option name="Female" value="Female">Female</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" name="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
 
	
</div>
	
<?php 
    sqlsrv_close($conn);
?>
</body>

</html>