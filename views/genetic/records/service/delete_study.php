<?php
include('../../../../service/connection.php');

$study_id = $_POST['study_id'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[EstudioGF] WHERE EstudioID = '$study_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[VarianteGF] WHERE EstudioID = '$study_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "DELETE FROM [QGFORENSE].[dbo].[MuestraGF] WHERE EstudioID = '$study_id'";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
?>