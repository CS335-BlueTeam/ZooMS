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
	
	$table_list = array('feedschedules');
	assort($table_list);
	
	if( isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $res = mysql_query("SELECT * FROM e2teams");
        $row= mysql_fetch_array($res);
    }
?>
</body>
</html>