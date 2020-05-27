<?php
include('../../../../service/connection.php');

$record_id = $_POST['record_id'];
$document_type= $_POST['document_type'];
$emited_document= $_POST['emited_document'];
$indication = $_POST['indication'];
$area = $_POST['area'];
$documentResult = $_POST['result'];  
$observation = $_POST['observation'];
$sp = $_POST['sp'];


if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT * FROM [QGFORENSE].[dbo].[DocumentoGF] WHERE ExpedienteID = $record_id";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$document_count = sqlsrv_num_rows( $result );



if($document_count != 0){
    $sql = "UPDATE [QGFORENSE].[dbo].[DocumentoGF]
            SET [TipoDocumentoE] = '$document_type'
                ,[DocumentoEmitido] = '$emited_document'
                ,[NumeroIndicios] = '$indication'
                ,[Area] = '$area'
                ,[Resultado] = '$documentResult'
                ,[Observacion] = '$observation'
                ,[SP] = '$sp'
            WHERE ExpedienteID = $record_id
        ";
}
else{
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
            '$documentResult',
            '$observation',
            '$sp',
            '$record_id'
        )";
}

$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 

if( $stmt === false ) {
    echo false;
}
else{
    echo true;
}


/*$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}*/

sqlsrv_close($conn);

?>