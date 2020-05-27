<?php
$sql = "SELECT DISTINCT [uid], [nombre], [area], [FiscaliaID]
            FROM [QGFORENSE].[dbo].[Usuarios] WHERE FiscaliaID != 0 AND area = 2 ORDER BY nombre";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$peritos = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
/*else{
    while( $row = sqlsrv_fetch_array( $result) ) {
        echo $row['ExpedienteID'];
    }
}*/
?>