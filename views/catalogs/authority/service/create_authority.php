<?php
session_start();
include('../../../../service/connection.php');

$authority = $_POST['authority'];
$fiscalia = $_POST['fiscalia'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = 
    "INSERT INTO [QGFORENSE].[dbo].[AutoridadSolicitante]
    ([Nombre], [FiscaliaID])
    VALUES
    (
        '$authority',
        '$fiscalia'
    )
    SELECT SCOPE_IDENTITY()
    ";


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_next_result($stmt); 
sqlsrv_fetch($stmt); 
echo sqlsrv_get_field($stmt, 0); 

/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/
sqlsrv_close($conn);
?>