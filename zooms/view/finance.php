<?php
echo file_get_contents("../html/header.html");
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
require_once ($myRoot . '/myproject/db/connect_to_db.php');
$conn = get_db_connection();
$sql = "SELECT item_name, quantity, cost from items";
$items = sqlsrv_query($conn, $sql);
$sql2 = "SELECT fname, lname, salary from employees where salary > 0";
$salaries = sqlsrv_query($conn, $sql2);
$sql3 = "SELECT fname, lname, payperhour from employees";
$hourly = sqlsrv_query($conn, $sql3);
$sum_i = 0.0;
$sum_s = 0.0;


?>
<h1>ZooMS Financial Managment</h1>

<label for="expenses">Zoo Item Expenses</label>
<table name="expenses">
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

<label for="expenses">Zoo Salary Expenses</label>
<table name="expenses">
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