<?php
session_start();
include ('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";


if($fiscalia != 0){
	$sql = "SELECT    
                f.Nombre,
                COUNT(*) AS 'Estudios'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatFiscalias] f ON e.FiscaliaID = f.FiscaliaID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND f.FiscaliaID = '$fiscalia' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                f.Nombre
            ORDER BY 
                f.Nombre";	
}
else{
	$sql = "SELECT    
                f.Nombre,
                COUNT(*) AS 'Estudios'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatFiscalias] f ON e.FiscaliaID = f.FiscaliaID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                f.Nombre
            ORDER BY 
                f.Nombre";
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



