<?php
include('../../../../service/connection.php');

$date = $_POST['date'];
$expiratedDate = $_POST['expirated_date'];
$authority = $_POST['authority'];
$nuc = $_POST['nuc'];
$fiscalia = $_POST['fiscalia'];

$perito = $_POST['perito'];  
$oficio = $_POST['oficio'];
$crime = $_POST['crime'];

$record_id = $_POST['record_id'];


if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}


if($crime != 0){
    $sql = "UPDATE [QGFORENSE].[dbo].[ExpedienteGF]
            SET [Fecha] = '$date'
                ,[FechaVencimiento] = '$expiratedDate'
                ,[AutoridadSolicitanteID] = $authority
                ,[PeritoID] = $perito
                ,[Oficio] = '$oficio'
                ,[nuc] = '$nuc'
                ,[DelitoID] = $crime
                ,[FiscaliaID] = '$fiscalia'
            WHERE ExpedienteID = $record_id
        ";
}
else{
    $sql = "UPDATE [QGFORENSE].[dbo].[ExpedienteGF]
            SET [Fecha] = '$date'
                ,[FechaVencimiento] = '$expiratedDate'
                ,[AutoridadSolicitanteID] = $authority
                ,[PeritoID] = $perito
                ,[Oficio] = '$oficio'
                ,[nuc] = '$nuc'
                ,[FiscaliaID] = '$fiscalia'
            WHERE ExpedienteID = $record_id
        ";
}


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 


/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

sqlsrv_close($conn);

?>