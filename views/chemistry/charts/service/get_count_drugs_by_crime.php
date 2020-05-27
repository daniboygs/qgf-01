<?php
session_start();
include ('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";

if($fiscalia != 0){
    $sql = "SELECT
                cme.Nombre,   
                COUNT(cme.Nombre) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                cme.Nombre
            ORDER BY 
                cme.Nombre";
}
else{
	$sql = "SELECT
                cme.Nombre,   
                COUNT(cme.Nombre) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                cme.Nombre
            ORDER BY 
                cme.Nombre";
}

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = $result;
$count_studies_by_crime = array();

while( $row = sqlsrv_fetch_array( $records) ) {
    array_push($count_studies_by_crime, array($row['Nombre'], $row['Cantidad']));
}


$sql = "";

if($fiscalia != 0){
    $sql = "SELECT
                cme.Nombre,
                COUNT(d.detalle) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                cme.Nombre
            ORDER BY 
                cme.Nombre";
}
else{
	$sql = "SELECT
                cme.Nombre,
                COUNT(d.detalle) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                cme.Nombre
            ORDER BY 
                cme.Nombre";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = $result;
$return = array();
$html = '';
$x = array();
$y = array();
$total = 0;


while( $row = sqlsrv_fetch_array( $records) ) {
    $x[] = $row[0];
    $y[] = $row[1];
}

$arrayX = json_encode($x);
$arrayY = json_encode($y);

$return = array();

$return = array(
	'x' => $arrayX,
	'y' => $arrayY
);

echo json_encode($return, JSON_FORCE_OBJECT);

sqlsrv_close($conn);


?>
