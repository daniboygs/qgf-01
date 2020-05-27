<?php
session_start();
include ('../../../../service/connection.php');

$study_id = $_POST['study_id'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[EstudioQF] WHERE EstudioID = '$study_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[DetalleQF] WHERE EstudioID = '$study_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}
?>