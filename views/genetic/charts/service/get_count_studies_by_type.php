<?php
session_start();
include('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";


if($fiscalia != 0){
	$sql = "SELECT    
                ce.Descripcion, COUNT(*) AS 'Estudios'
                FROM      [QGFORENSE].[dbo].[ExpedienteGF] e 
                INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
                ON e.ExpedienteID = est.ExpedienteID 
                INNER JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
                ON est.CatEstudioID = ce.CatEstudioID 
                WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND e.FiscaliaID = '$fiscalia'
                GROUP BY  
                    ce.Descripcion
                ORDER BY 
                    ce.Descripcion";	
}
else{
	$sql = "SELECT    
                ce.Descripcion, COUNT(*) AS 'Estudios'
                FROM      [QGFORENSE].[dbo].[ExpedienteGF] e 
                INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
                ON e.ExpedienteID = est.ExpedienteID 
                INNER JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
                ON est.CatEstudioID = ce.CatEstudioID 
                WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'
                GROUP BY  
                    ce.Descripcion
                ORDER BY 
                    ce.Descripcion";
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



