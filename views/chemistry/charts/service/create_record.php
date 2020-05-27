<?php
session_start();
include ('../../../../service/connection.php');

$date = $_POST['date'];
$authority = $_POST['authority'];
$description = $_POST['description'];
$name = $_POST['name'];
$nuc = $_POST['nuc'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = 
"INSERT INTO [QGFORENSE].[dbo].[ExpedienteQF]
([Fecha]
,[AutoridadSolicitante]
,[DescripcionHecho]
,[Nombre]
,[nuc])
VALUES
(
    '$date',
    '$authority',
    '$description',
    '$name',
    '$nuc'
)";


$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

?>