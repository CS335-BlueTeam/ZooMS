<?php
		
   
        // Taking all 5 values from the form data(input)
        $first_name =  $_REQUEST['fname'];
        $last_name = $_REQUEST['lname'];
        $startDate =  $_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $bankAccountNumber = $_REQUEST['bankAccountNumber'];
        $department = $_REQUEST['department'];
        $position = $_REQUEST['position'];
        $salary = $_REQUEST['salary'];
        $hourlyPay = $_REQUEST['hourlyPay'];
        $password = $_REQUEST['password'];
		
		
		$query = "SELECT MAX(ID) as lastID from employees";
		$result = sqlsrv_query( $conn, $query );
		$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		$ID = $row['lastID']+1;
		
		
          
        // Performing insert query execution
        // here our table name is college
        $sql_query = "INSERT INTO employees  VALUES ('$ID','$position', '$first_name', 
            '$last_name','$startDate','$endDate','$bankAccountNumber', '$department', '$salary','$hourlyPay','$password')";
         sqlsrv_query($conn, $sql_query);
