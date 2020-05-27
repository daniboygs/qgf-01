<?php
session_start();
include ('../../../../service/connection.php');

$record_id = $_POST['record_id'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[ExpedienteQF] WHERE ExpedienteID = '$record_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[EstudioQF] WHERE ExpedienteID = '$record_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}
?>