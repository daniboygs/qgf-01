<?php
session_start();
include ('../../../service/connection.php');

if($fiscalia != 0){
    $sql = "SELECT DISTINCT * FROM [QGFORENSE].[dbo].[AutoridadSolicitante] where FiscaliaID = $fiscalia ORDER BY Nombre";
}
else{
    $sql = "SELECT DISTINCT * FROM [QGFORENSE].[dbo].[AutoridadSolicitante]";
}

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$authorities = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
/*else{
    while( $row = sqlsrv_fetch_array( $result) ) {
        echo $row['ExpedienteID'];
    }
}*/


//sqlsrv_close($conn);

?>