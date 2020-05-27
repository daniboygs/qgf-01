<?php
include('../../../../service/connection.php');

$record_id = $_POST['record_id'];


$sql = "SELECT * FROM [QGFORENSE].[dbo].[DocumentoGF] WHERE ExpedienteID = $record_id";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$documents = $result;
$return = array();

if($row_count > 0){
    while( $row = sqlsrv_fetch_array( $documents) ) {
        $return = array(
            'document_type' => $row['TipoDocumentoE'],
            'emited_document' => $row['DocumentoEmitido'],
            'indication' => $row['NumeroIndicios'],
            'area' => $row['Area'],
            'result' => $row['Resultado'],
            'observation' => $row['Observacion'],
            'sp' => $row['SP'],
            'exists' => true
        );
    }
}
else{
    $return = array(
        'document_type' => 'Dictamen',
        'emited_document' => 'Si',
        'indication' => '0',
        'area' => 'Identificación humana',
        'result' => 'Positivo',
        'observation' => '',
        'sp' => '0',
        'exists' => false
    );
}



echo json_encode($return, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>