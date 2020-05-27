<?php
session_start();
include ('../../../service/connection.php');

$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatEstudioQF]";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$studies = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
?>