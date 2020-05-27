<?php
session_start();
include('../../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";


if($fiscalia != 0){
	$sql = "SELECT    
				DATEPART(MONTH, [Fecha]) AS 'Month',
				COUNT(*) AS 'Records'
			FROM      [QGFORENSE].[dbo].[ExpedienteGF] 
			WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia'
			GROUP BY  
				DATEPART(MONTH, [Fecha])
			ORDER BY 
				'Month'";	
}
else{
	$sql = "SELECT    
				DATEPART(MONTH, [Fecha]) AS 'Month',
				COUNT(*) AS 'Records'
			FROM      [QGFORENSE].[dbo].[ExpedienteGF] 
			WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'
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


$i = 1;
$bgc = '#F0F0F0';
$c = '#000000';

while( $row = sqlsrv_fetch_array( $records) ) {

    

    if($i%2 == 1){
        $bgc = '#F0F0F0';
        $c = '#000000';
      
    }
    else{
        $bgc = '#FFFFFF';
        $c = '#000000';
    }


    $html.='

        <tr>
            <td style="background-color: '.$bgc.'; color: '.$c.';">&nbsp;&nbsp;&nbsp;'.$i.'</td>
            <td style="background-color: '.$bgc.'; color: '.$c.'; font-weight: bold;">'.$months[$row['Month']].'</td>
            <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$row['Records'].'</td>
        </tr>

    ';

    $i++;

}


$html = '


    <hr>

    <div id="excel-btn">
        <button class="btn btn-outline-success" onclick="tableToExcel()">Descargar excel</button>
    </div>

    <br>

    <table id="table_count" class="table">

        <tr>
            <th>#</th>
            <th>Mes</th>
            <th style="text-align: center;">Expedientes</th>
        </tr>
        '.$html.'
    </table>



';

echo $html;

sqlsrv_close($conn);


?>
