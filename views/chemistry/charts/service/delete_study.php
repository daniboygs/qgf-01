<?php
session_start();
include ('../../../../service/connection.php');

$detail_id = $_POST['detail_id'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[EstudioQF] WHERE EstudioID = '$detail_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}
?>