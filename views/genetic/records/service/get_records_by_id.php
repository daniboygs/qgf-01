<?php
include('../../../../service/connection.php');

$record_id = $_POST['record_id'];


$sql = "SELECT * FROM [QGFORENSE].[dbo].[ExpedienteGF] WHERE ExpedienteID = $record_id";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = $result;
$return = array();
$html = '';
$x = array();
$y = array();


while( $row = sqlsrv_fetch_array( $records) ) {

    if($row['FechaVencimiento'] != null){
        $return = array(
            'nuc' => $row['nuc'],
            'date' => $row['Fecha']->format('yy-m-d'),
            'expirated_date' => $row['FechaVencimiento']->format('yy-m-d'),
            'authority' => $row['AutoridadSolicitanteID'],
            'perito' => $row['PeritoID'],
            'oficio' => $row['Oficio'],
            'fiscalia' => $row['FiscaliaID']
        );
    }
    else{
        $return = array(
            'nuc' => $row['nuc'],
            'date' => $row['Fecha']->format('yy-m-d'),
            'expirated_date' => $row['Fecha']->format('yy-m-d'),
            'authority' => $row['AutoridadSolicitanteID'],
            'perito' => $row['PeritoID'],
            'oficio' => $row['Oficio'],
            'fiscalia' => $row['FiscaliaID']
        );
    }
    
}

echo json_encode($return, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>