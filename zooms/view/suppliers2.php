<?php
//include('header.php');

session_start();
include '../db/connect_to_db.php';
//echo file_get_contents("../html/header.html");

$conn = get_db_connection();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else{
if (!empty($_POST)){
	$action_type = $_POST['action_type'];
	
	if($action_type=='submit') {
		$s_id = $_POST['ID'];
		$name = $_POST['name'];
		
		$ins_query="insert into suppliers values('$s_id', '$name')";
		$ret=sqlsrv_query($conn,$ins_query);
		if( $ret === false) {		
		echo '<script>alert("Supplier ID already exists !")</script>';
		header("refresh: 1; url=suppliers2.php");
		exit;
		}
		echo '<script>alert("Supplier has been added !")</script>';
	  }
	 if($action_type=='delete') {
		$id = $_POST['supplier-to-delete'];
		
		$result = sqlsrv_query($conn,"delete FROM suppliers where supplier_ID=".$id);
		echo '<script>alert("Supplier has been deleted !")</script>';
	 }
}
}
?>
<!-- BEGIN: Content-->
<html>
<head>
    <title>Suppliers</title>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/styles.css" type="text/css">
	
</head>
<body>
<style>
	.container {
		padding: 25px;
	}
	.card {
		padding: 25px;
		margin: 0 auto;
		}	
	.form-group {
		padding: 10px;
	}
</style>
	<?php echo file_get_contents("../html/header.php"); ?>
    <div class="container">	
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Insert a New Supplier</h4>
			</div>
			<div class="card-body">
			<form name="form" method="post" action=""> 
				<input type="hidden" name="new" value="1" />
				<p><input type="text" name="ID" placeholder="Enter ID" required /></p>
				<p><input type="text" name="name" placeholder="Enter name" required /></p>
				<input type="hidden" name="action_type" value=<?="submit"?>></input>
				<input class="btn btn-primary" type="submit" value="Insert"></input>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header">                                    
				<h4 class="card-title">Suppliers Data</h4>
			</div>
			
			<div class="card-content">
				<div class="card-body">
					<div>
						
					<?php
						$tsql = "SELECT * FROM suppliers";
						$qry  = sqlsrv_query($conn, $tsql);
						?>
						<h3>List of Suppliers</h3>
						<form method="POST">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Supplier ID</th>
									<th>Supplier Name</th>
								</tr>
							</thead>
							<tbody>
							<?php
								while($row = sqlsrv_fetch_array($qry)) {
							?>
								<tr>
									<td><?=$row["supplier_ID"];?></td>
									<td><?=$row["supplier_name"];?></td>
								</tr>
								<?php $IDs[]=$row["supplier_ID"];
							
								}
								?>
								</tbody>
							</table>
							<select name="supplier-to-delete">
							<?php												
								foreach ($IDs as $id) {
									echo "<option>".$id."</option>";
								}
								?>
							</select>										
							<input type="hidden" name="action_type" value=<?="delete"?>></input>
							<input class="btn btn-danger" type="submit" value="Delete"></input>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- END: Content-->
<script>
    $(document).ready(function(){

    $('.cancel-button').on('click',function(){        
        swal({
            title: "Are you sure?",
            text: "To Delete This Record!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
        .then((isConfirm) => {
            if (isConfirm) {
                var id=this.id;
            $.ajax({
              url: "app/suppliers?id="+id,
              type: "GET",
              success: function(inputValue){
                swal("Deleted!", "Your Record has been deleted.", "success");
                setTimeout(function(){// wait for 5 secs(2)
                   location.reload(); // then reload the page.(3)
              }, 1000); 
                }
            });
                
            } else {
                swal("Cancelled", "Your Record is safe", "error");
            }
        });

    });   

});
</script>

</body>
</html>