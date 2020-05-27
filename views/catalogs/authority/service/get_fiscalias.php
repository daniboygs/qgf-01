<?php
$sql = "SELECT DISTINCT f.[FiscaliaID], f.[Nombre] 
        FROM [QGFORENSE].[dbo].[CatFiscalias] f 
        INNER JOIN [QGFORENSE].[dbo].[Usuarios] u 
        ON f.FiscaliaID = u.FiscaliaID 
        WHERE u.area = 1";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$fiscalias = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
/*else{
    while( $row = sqlsrv_fetch_array( $result) ) {
        echo $row['ExpedienteID'];
    }
}*/
?>