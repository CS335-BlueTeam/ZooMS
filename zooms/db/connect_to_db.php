<?php
include 'db_user_pass.php';

function get_db_connection(){
  $connectionInfo = array( "Database"=>"zooms", "UID"=>$GLOBALS['username'], "PWD"=>$GLOBALS['password']);
  $conn = sqlsrv_connect( $GLOBALS['servername'], $connectionInfo);

  return $conn;
}
?>
