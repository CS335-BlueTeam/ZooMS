<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $myRoot = $_SERVER["DOCUMENT_ROOT"];

    include('C:/xampp/htdocs/ZooMS/zooms/db/connect_to_db.php');
    $conn = get_db_connection();
    ?>
    <title>ZooMS</title>
</head>
<body>
<?php
        session_start();

        if (isset($_POST['submitNewEmployeeRecord'])){
        // Taking all 5 values from the form data(input)
        $first_name =  $_REQUEST['fname'];
        $last_name = $_REQUEST['lname'];
        $startDate =  $_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $bankAccountNumber = (int)$_REQUEST['bankAccountNumber'];
        $department = $_REQUEST['department'];
        $position = $_REQUEST['position'];
        $salary = (float)$_REQUEST['salary'];
        $hourlyPay = (float)$_REQUEST['hourlyPay'];
        $password = $_REQUEST['password'];


		$query = "SELECT MAX(ID) as lastID from employees";
		$result = sqlsrv_query( $conn, $query );
		$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		$ID = (int)$row['lastID']+1;



        // Performing insert query execution
        // here our table name is college
        $sql_query = "INSERT INTO employees  VALUES ('$ID','$position', '$first_name', 
            '$last_name','$startDate','$endDate','$bankAccountNumber', '$department', '$salary','$hourlyPay','$password')";
         sqlsrv_query($conn, $sql_query);

            $_SESSION['message'] = "Employee Record Created!";
            $_SESSION['msg_type'] = "success";

		header("Location: ./HR_admin_page.php");
        } elseif (isset($_POST['submitUpdateEmployeeRecord'])){
            // Taking all 5 values from the form data(input)
            $id = (int)$_REQUEST['ID'];
            $first_name =  $_REQUEST['fname'];
            $last_name = $_REQUEST['lname'];
            $startDate =  $_REQUEST['startDate'];
            $endDate = $_REQUEST['endDate'];
            $department = $_REQUEST['department'];
            $position = $_REQUEST['position'];
            $salary = (float)$_REQUEST['salary'];
            $hourlyPay = (float)$_REQUEST['hourlyPay'];

            $sql_query = "update employees  set  ID='$id', position='$position', fname='$first_name', lname= '$last_name', start_date='$startDate', end_date='$endDate', dept_name='$department', salary='$salary', payperhour='$hourlyPay' where ID='$id'";
            sqlsrv_query($conn, $sql_query);

            $_SESSION['message'] = "Employee Record Updated!";
            $_SESSION['msg_type'] = "success";


        }

        header("Location: ./HR_admin_page.php");
        exit;

?>
</body>
</html>