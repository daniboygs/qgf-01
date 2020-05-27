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

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

if($crime != 0){
    $sql = 
        "INSERT INTO [QGFORENSE].[dbo].[ExpedienteQF]
        ([Fecha]
        ,[AutoridadSolicitanteID]
        ,[nuc]
        ,[FiscaliaID]
        ,[PeritoID]
        ,[Oficio]
        ,[DelitoID])
        VALUES
        (
            '$date',
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
        "INSERT INTO [QGFORENSE].[dbo].[ExpedienteQF]
        ([Fecha]
        ,[AutoridadSolicitanteID]
        ,[nuc]
        ,[FiscaliaID]
        ,[PeritoID]
        ,[Oficio])
        VALUES
        (
            '$date',
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
echo sqlsrv_get_field($stmt, 0); 

/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

?>