<?php
include('../../../../service/connection.php');

$record_id = $_POST['record_id'];
$document_type= $_POST['document_type'];
$emited_document= $_POST['emited_document'];
$indication = $_POST['indication'];
$area = $_POST['area'];
$result = $_POST['result'];  
$observation = $_POST['observation'];
$sp = $_POST['sp'];


if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "INSERT INTO [QGFORENSE].[dbo].[DocumentoGF]
        ([TipoDocumentoE]
        ,[DocumentoEmitido]
        ,[NumeroIndicios]
        ,[Area]
        ,[Resultado]
        ,[Observacion]
        ,[SP]
        ,[ExpedienteID])
        VALUES
        (
            '$document_type',
            '$emited_document',
            '$indication',
            '$area',
            '$result',
            '$observation',
            '$sp',
            '$record_id'
        )";

$stmt = sqlsrv_query( $conn, $sql);
sqlsrv_fetch($stmt); 

/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

sqlsrv_close($conn);

?>