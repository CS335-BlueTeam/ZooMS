<?php
echo file_get_contents("../html/header.html");

function alert_func($message){
    // display the alert box
    echo "<script>alert('$message');</script>";
}

session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    function_alert("You are not logged in.");
    exit;
}
    elseif($_SESSION["department"]!='Accounting'){
        header("location: login.php");
        function_alert("You are not part of the accounting deptartment.");
        exit;
    }

$myRoot = $_SERVER["DOCUMENT_ROOT"];

// Include connection file
require_once ($myRoot . '/myproject/db/connect_to_db.php');
$conn = get_db_connection();
?>
<h1>hi</h1>