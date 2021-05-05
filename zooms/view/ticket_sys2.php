<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
include '../db/connect_to_db.php';
//echo file_get_contents("../html/header.html");

$conn = get_db_connection();

if( $conn === false ) {
die( print_r( sqlsrv_errors(), true));
}

if (!empty($_POST)){
	$action_type = $_POST['action_type'];
	$emp_id = $_SESSION['employee_id'];
	
	if($action_type=='total') {
		#Assuming ticket prices are $20 for adults and $10 for children
		
		$tsql = "select * from ticketbooth";
		$rows = sqlsrv_query($conn, $tsql);
		
		//var_dump(sqlsrv_has_rows($rows));
		if (sqlsrv_has_rows($rows)=== false) {			
			$purchase_date= date("Y-m-d H:i:s");
			$adult_tickets = intval($_POST['adult-tickets']);
			$children_tickets= intval($POST['children-tickets']);
			$a_price= $adult_tickets*20;
			$c_price=$children_tickets*10;
			$total= $a_price+$c_price;
			$trac=0;
			
			for ($j=0; $j<$adult_tickets; $j++){
					$ticket_type[]="Adult";
				}
			for ($j=0; $j<$children_tickets; $j++){
					$ticket_type[]="Child";
				}
			
			for($i=0; $i<=$num; $i++){
				$tsql = "INSERT INTO ticketbooth VALUES('$emp_id','$trac','$i','$total','$ticket_type[$i]', '$purchase_date');";
				$qry = sqlsrv_query($conn, $tsql);
			}
		}
		else {				
			$adult_tickets = intval($_POST['adult-tickets']);
			$children_tickets= intval($_POST['children-tickets']);
			$num=$adult_tickets+$children_tickets;
			$a_price= $adult_tickets*20;
			$c_price=$children_tickets*10;
			$total= $a_price+$c_price;
			
			$ticket_trac=mt_rand(100000000, 999999999);
			$purchase_date= date("Y-m-d H:i:s");
			$tsql = "SELECT MAX(ticket_ID) as last_ticket FROM ticketbooth";
			$qry = sqlsrv_query($conn, $tsql);
			
			$row = sqlsrv_fetch_array($qry);
			$prev_ticket = $row['last_ticket'];
			$new_ticket = $prev_ticket+1;
			
			
			for ($j=0; $j<$adult_tickets; $j++){
					$ticket_type[]="Adult";
				}
			for ($j=0; $j<$children_tickets; $j++){
					$ticket_type[]="Child";
				}
				
			for($i=0; $i<$num; $i++){
				
				
				$tsql = "INSERT INTO ticketbooth VALUES ('$emp_id','$ticket_trac','$new_ticket','$total', '$ticket_type[$i]', '$purchase_date')";
				sqlsrv_query($conn, $tsql);
				$new_ticket++;
			}
		}
	}
	if($action_type=='delete') {
		 $ticket_to_delete = $_POST['ticket_to_delete'];
		
		//delete the row with the specified ID using prepared statement:
		$result = sqlsrv_query($conn,"delete FROM ticketbooth where transaction_ID=".$ticket_to_delete);
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
	
</head>
	<body>
	<style>
		.container {
			padding: 25px;
		}
		.card {
			padding: 25px;
			width: 500px;
			margin: 0 auto;
			}
		.card-body{
			margin: 0 auto;
		}
		.card-body h3 {
			text-align:center;
		}
		#table-card {
			width: 1000px;
		}
		.visitor-counter {
			text-align: center;
		}
		#visitor-counter-num {
			text-align: center;
			margin-right: 30px;
		}
		.form-group {
			padding: 10px;
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
				<div class="card-header">
					<div class="visitor-counter">Total Zoo Visitors</div>
					<ul class="visitor_counter">
					<?php 
						$tsql = "SELECT * FROM ticketbooth";
						$result = sqlsrv_query($conn, $tsql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						$num = sqlsrv_num_rows($result);
					?>
					<h3 id="visitor-counter-num"> <?php echo $num; ?> </h3>
				</div>
				<!-- basic form start -->
				<div class="card-body">
					<h3>Price Per Ticket: <br>
						Adults: $20 <br>
						Children: $10</h3>
					<br>
					<form method="POST">
					<div class="form-group">
						<label for="adult-tickets">Adult Tickets: </label>
						<input type="number" id="adult-tickets" name="adult-tickets" value="Adult">
					</div>
					
					<div class="form-group">
						<label for="children-tickets">Children Tickets: </label>
						<input type="number" id="children-tickets" name="children-tickets">
					</div>
					
						<input type="hidden" name="action_type" value=<?="total"?>></input>
						<input class="btn btn-primary btn-block" type="submit" value="Total"></input>
					</form>
				

					<?php
						if (!empty($_POST['total'])) {
							echo "Total Price for ".$num." tickets: $".$total;
						}
						else{
							echo "Select quantity to complete purchase.";
						}
					?>
				</div>
			</div>
		</div>
			
			<?php
				$tsql = "SELECT * FROM ticketbooth";
				$qry  = sqlsrv_query($conn, $tsql);
			?>
			<div class="container">
			<div class="card" id="table-card">
			<div class="card-header">
				<h3>Transactions</h3>
			</div>
			<div class="card-body">
			<form method="POST">
			<table>
				<thead>
					<tr>
						<th>Processed By</th>
						<th>Transaction ID</th>
						<th>Ticket ID</th>
						<th>Ticket Type</th>
						<th>Purchase Date</th>
					</tr>
				</thead>
				<tbody>
			<?php				
				$emps=sqlsrv_query($conn,"SELECT employees.fname, employees.lname FROM employees INNER JOIN ticketbooth ON employees.ID=ticketbooth.employee_ID");
				$e=sqlsrv_fetch_array($emps);
			    while($row = sqlsrv_fetch_array($qry)) {
			?>
					<tr>
						<td><?=$e["lname"],", ",$e["fname"] ?></td>
						<td><?=$row["transaction_ID"];?></td>
						<td><?=$row["ticket_ID"];?></td>
						<td><?=$row["ticket_type"];?></td>
						<td><?=$row["purchase_date"];?></td>
					</tr>
				<?php $IDs[]=$row["transaction_ID"];
				}
				?>
				</tbody>
			</table>
				<label for="ticket_to_delete">Ticket Transaction ID<label>
				<select name="ticket_to_delete">
						<?php
						foreach (array_unique($IDs) as $id){
							echo "<option>".$id."</option>";
						}
						?>
				</select>
				<input type="hidden" name="action_type" value=<?="delete"?>></input>
				<input class="btn btn-primary" type="submit" value="Delete"></input>					
			</form>
			</div>			
			</div>
			</div>
				<?php sqlsrv_close( $conn ); ?>
				
	</body>
</html>