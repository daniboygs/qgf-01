<?php
session_start();
include ('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";


if($fiscalia != 0){
	$sql = "SELECT    
        DATEPART(MONTH, [Fecha]) AS 'Month',
            COUNT(*) AS 'Records'
        FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID
        WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
        GROUP BY  
            DATEPART(MONTH, [Fecha])
        ORDER BY 
            'Month'";	
}
else{
	$sql = "SELECT    
        DATEPART(MONTH, [Fecha]) AS 'Month',
            COUNT(*) AS 'Records'
        FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID
        WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
        GROUP BY  
            DATEPART(MONTH, [Fecha])
        ORDER BY 
        'Month'";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = $result;
$return = array();
$html = '';
$months = array(
	1=>'Enero',
	2=>'Febrero',
	3=>'Marzo',
	4=>'Abril',
	5=>'Mayo',
	6=>'Junio',
	7=>'Julio',
	8=>'Agosto',
	9=>'Septiembre',
	10=>'Octubre',
	11=>'Noviembre',
	12=>'Diciembre'
);

$x = array();
$y = array();


while( $row = sqlsrv_fetch_array( $records) ) {
$x[] = $months[$row[0]];
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



