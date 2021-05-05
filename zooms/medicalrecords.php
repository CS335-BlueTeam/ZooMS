<HTML>
<body>
<?php
    $servername = "cs335db.database.windows.net";
    $username = "sadmin";
    $password = "mypass123!";
    $dbname = "zooms";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


	$db_name = 'Tables';

	$conn = get_db_connection($db_name);
	
	$table_list = array('medicalrecords');
	assort($table_list);
	
?>
</body>
</html>