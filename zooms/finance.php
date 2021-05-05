<?php
echo file_get_contents("./html/header.php");
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    echo "You are not logged in.";
    exit;
}
    elseif($_SESSION["department"]!=='Accounting'){
        header("location: login.php");
        echo "You are not in Accounting.";
        exit;
    }

$myRoot = $_SERVER["DOCUMENT_ROOT"];

// Include connection file
require_once ($myRoot . '/zooms/zooms/db/connect_to_db.php');
$conn = get_db_connection();
$sql = "SELECT item_name, quantity, cost from items";
$items = sqlsrv_query($conn, $sql);
$sql2 = "SELECT fname, lname, salary from employees where salary > 0";
$salaries = sqlsrv_query($conn, $sql2);
$sql3 = "SELECT employees.fname, employees.lname, employees.payperhour, workschedules.clock_in, workschedules.clock_out from employees INNER JOIN workschedules ON employees.ID=workschedules.employee_ID";
$hourly = sqlsrv_query($conn, $sql3);
$sql6 = "SELECT dept_name from department";
$depts = sqlsrv_query($conn, $sql6);
$sql7 = "SELECT cost from ticketbooth";
$tix = sqlsrv_query($conn, $sql7);
$sum_i = 0.0;
$sum_s = 0.0;
$sum_h = 0.0;
$tot_i = 0.0;
$tix_s = 0.0;

?>

<style>
    #main{
        display: flex;
        justify-content: center;
    }
th, td {padding: 10px;}
table tr:nth-child(even){background-color: #f2f2f2;}
.btn-group .button {
  background: royalblue; /* Green */
  border: 1px solid gray;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  float: left;
}

.btn-group .button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

.btn-group .button:hover {
  background-color: #3e8e41;
}
</style>
<center>
<div class="btn-group">
  <button class="button" id="ibtn">Items</button>
  <button class="button" id="sbtn">Salaries</button>
  <button class="button" id="hbtn">Hourly</button>
  <button class="button" id="dbtn">Department</button>
  <button class="button" id="tbtn">Total</button>
  <button class="button" id="tibtn">Tickets</button>
</div>
</center>
<br>
<center><h1>Financial Managment</h1></center>
<div id='main'>
<body>
<div id="iexp">
<label for="expenses"><h3>Item Expenses</h3></label>
<table name="expenses" class="exp-t" id="i-exp-t">
    <tr>
        <th>Expense</th>
        <th>Cost</th>
        <th>Quantity</th>
        <th>Total Cost</th>
    </tr>
<?php          
    while ($row = sqlsrv_fetch_array($items, SQLSRV_FETCH_ASSOC))
    {
        $sum_i += $row['cost']*$row['quantity'];
        echo "<tr><td>".$row['item_name']."</td><td>".$row['cost']."</td><td>".$row['quantity']."</td><td>".$row['cost']*$row['quantity']."</td></tr>";
    }
?>
    <tr>
        <td colspan="3">Total Inventory Expenses</td>
        <td colspan="1"><?php echo $sum_i; ?></td>
    </tr>
</table>
</div>
<div id="sexp">
<label for="expenses"><h3>Salary Expenses</h3></label>
<table name="expenses" class="exp-t" id="s-exp-t">
    <tr>
        <th>Name</th>
        <th>Salary</th>
    </tr>
<?php          
    while ($row = sqlsrv_fetch_array($salaries, SQLSRV_FETCH_ASSOC))
    {
        $sum_s += $row['salary'];
        echo "<tr><td>".$row['fname']." ".$row['lname']."</td><td>".$row['salary']."</td></tr>";
    }
?>
    <tr>
        <td>Total</td>
        <td><?php echo $sum_s; ?></td>
    </tr>

</table>
</div>
<div id="hexp">
<label for="expenses"><h3>Hourly Expenses</h3></label>
<table name="expenses" class="exp-t" id="h-exp-t">
    <tr>
        <th>Name</th>
        <th>Hourly Rate</th>
        <th>Hours Worked</th>
        <th>Pay</th>
    </tr>
<?php          
    while ($row = sqlsrv_fetch_array($hourly, SQLSRV_FETCH_ASSOC))
    {
        $start_t = $row['clock_in'];
        $current_t = $row['clock_out'];
        $difference = $start_t ->diff($current_t );
        $hours_t = $difference ->format('%H');
        $time_r = $difference ->format('%H:%I:%S');
        $ppp = intval($hours_t)*$row['payperhour'];
        $sum_h += $ppp;
        echo "<tr><td>".$row['fname']." ".$row['lname']."</td><td>".$row['payperhour']."</td><td>".$time_r."</td><td>".$ppp."</td></tr>";
    }
?>
    <tr>
        <td colspan="3">Total</td>
        <td><?php echo $sum_h; ?></td>
    </tr>

</table>
</div>
<div id="dexp">
    <form method="post" action="">
        <label for="dept_to_select">Department<br></label>
        
        <select name="dept_to_select">
        <?php
        while ($row = sqlsrv_fetch_array($depts, SQLSRV_FETCH_ASSOC)){
            echo "<option>".$row['dept_name']."</option>";
        }
        ?>
        </select>
        <input type="hidden" name="action_type" value=<?="select"?>></input>
        <input type="submit" value="Load"></input>
    </form>


<label ><h3>Departmental Expenses</h3></label>
<table name="expenses" class="exp-t" id="d-exp-t">
    <tr>
        <th>Item</th>
        <th>Expense</th>
    </tr>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dept = $_POST['dept_to_select'];
    echo "<br>".$dept."<br>";
    $sql4 = "SELECT items.item_name, items.quantity, items.cost, department.dept_name, department.budget from items INNER JOIN department ON items.dept_name=department.dept_name where department.dept_name = ?";
    if($result = sqlsrv_query($conn, $sql4, array($dept))){
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $tot_i = $row['cost']*$row['quantity'];
            echo "<tr><td>".$row['item_name']."</td><td>".$tot_i."</tr>";
        }
    }
}
?>
    <tr>
        <td >Total</td>
        <td><?php if($tot_i){echo $tot_i;}else{} ?></td>
    </tr>

</table>
</div>
<div id="texp">
<label for="expenses"><h3>Total Expenses</h3></label>
<table name="expenses" class="exp-t" id="t-exp-t">
    <tr>
        <th>Items</th>
        <th>Salaries</th>
        <th>Hourly</th>
    </tr>
    <tr>
        <td><?php echo $sum_i; ?></td>
        <td><?php echo $sum_s; ?></td>
        <td><?php echo $sum_h; ?></td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td><?php echo $sum_i+$sum_s+$sum_h; ?></td>
    </tr>

</table>
</div>
<div id="tiexp">
<label for="expenses"><h3>Ticket Income</h3></label>
<table name="expenses" class="exp-t" id="ti-exp-t">
    <tr>
        <th>Ticket Sales</th>
    </tr>
        <?php
        while ($row = sqlsrv_fetch_array($tix, SQLSRV_FETCH_ASSOC)){
            $tix_s += $row['cost'];
        }
        ?>
    <tr>
        <td>Total</td>
        <td><?php echo $tix_s; ?></td>
    </tr>

</table>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='./js/finance.js'></script>
</div>