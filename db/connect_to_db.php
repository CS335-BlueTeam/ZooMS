<?php
include 'db_user_pass.php';

function get_db_connection(){
  $connectionInfo = array( "Database"=>"zooms", "UID"=>$GLOBALS['username'], "PWD"=>$GLOBALS['password']);
  $conn = sqlsrv_connect( $GLOBALS['servername'], $connectionInfo);

  if( $conn ) {
       
       echo "Connection established.";
  }else{
       echo "Connection could not be established.";
       die( print_r( sqlsrv_errors(), true));
  }
return $conn;
}
?>
