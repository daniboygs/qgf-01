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


if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}


if($crime != 0){
    $sql = 
        "INSERT INTO [QGFORENSE].[dbo].[ExpedienteGF]
        ([Fecha]
        ,[FechaVencimiento]
        ,[AutoridadSolicitanteID]
        ,[nuc]
        ,[FiscaliaID]
        ,[PeritoID]
        ,[Oficio]
        ,[DelitoID])
        VALUES
        (
            '$date',
            '$expiratedDate',
            '$authority',
            '$nuc',
            '$fiscalia',
            '$perito',
            '$oficio',
            $crime
        )
        SELECT SCOPE_IDENTITY()
        ";
}
else{
    $sql = 
        "INSERT INTO [QGFORENSE].[dbo].[ExpedienteGF]
        ([Fecha]
        ,[FechaVencimiento]
        ,[AutoridadSolicitanteID]
        ,[nuc]
        ,[FiscaliaID]
        ,[PeritoID]
        ,[Oficio])
        VALUES
        (
            '$date',
            '$expiratedDate',
            '$authority',
            '$nuc',
            '$fiscalia',
            '$perito',
            '$oficio'
        )
        SELECT SCOPE_IDENTITY()
        ";
}

$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_next_result($stmt); 
sqlsrv_fetch($stmt); 


$record_id = sqlsrv_get_field($stmt, 0); 


echo $record_id;
/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

sqlsrv_close($conn);

?>