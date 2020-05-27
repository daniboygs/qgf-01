<?php
session_start();
include ('../../../../service/connection.php');

$date = $_POST['date'];
$authority = $_POST['authority'];
$nuc = $_POST['nuc'];
$fiscalia = $_POST['fiscalia'];

$perito = $_POST['perito'];  
$oficio = $_POST['oficio']; 
$crime = $_POST['crime'];

$record = $_POST['record_id'];

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

if($crime != 0){
    $sql = "UPDATE [QGFORENSE].[dbo].[ExpedienteQF]
            SET [Fecha] = '$date'
                ,[AutoridadSolicitanteID] = $authority
                ,[PeritoID] = $perito
                ,[Oficio] = '$oficio'
                ,[nuc] = '$nuc'
                ,[DelitoID] = $crime
                ,[FiscaliaID] = '$fiscalia'
            WHERE ExpedienteID = $record
        ";
}
else{
    $sql = "UPDATE [QGFORENSE].[dbo].[ExpedienteQF]
            SET [Fecha] = '$date'
                ,[AutoridadSolicitanteID] = $authority
                ,[PeritoID] = $perito
                ,[Oficio] = '$oficio'
                ,[nuc] = '$nuc'
                ,[FiscaliaID] = '$fiscalia'
            WHERE ExpedienteID = $record
        ";
}


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 

/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

?>