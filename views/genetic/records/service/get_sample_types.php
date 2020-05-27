<?php
$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatTipoMuestra] ORDER BY Tipo";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$samples = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
/*else{
    while( $row = sqlsrv_fetch_array( $result) ) {
        echo $row['ExpedienteID'];
    }
}*/

?>