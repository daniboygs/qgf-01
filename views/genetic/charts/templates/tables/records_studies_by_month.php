<?php
session_start();
include('../../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";


if($fiscalia != 0){
	$sql = "SELECT    
				DATEPART(MONTH, [Fecha]) AS 'Month', COUNT(*) AS 'Records'
			FROM [QGFORENSE].[dbo].[ExpedienteGF] 
			WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia'
			GROUP BY  
				DATEPART(MONTH, [Fecha])
			ORDER BY 
				'Month'";	
}
else{
	$sql = "SELECT    
				DATEPART(MONTH, [Fecha]) AS 'Month', COUNT(*) AS 'Records'
			FROM [QGFORENSE].[dbo].[ExpedienteGF] 
			WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'
			GROUP BY  
				DATEPART(MONTH, [Fecha])
			ORDER BY 
				'Month'";	
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$records = $result;

$count_records_by_month = array();
$count_studies_by_month = array();

while( $row = sqlsrv_fetch_array( $records) ) {
    array_push($count_records_by_month, array($row['Month'], $row['Records']));
}




if($fiscalia != 0){
	$sql = "SELECT    
                DATEPART(MONTH, [Fecha]) AS 'Month', COUNT(*) AS 'Studies'
                FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
                INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
                ON e.ExpedienteID = est.ExpedienteID 
                INNER JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
                ON est.CatEstudioID = ce.CatEstudioID
                WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND e.FiscaliaID = '$fiscalia'
                GROUP BY  
                    DATEPART(MONTH, [Fecha])
                ORDER BY 
                    'Month'";	
}
else{
	$sql = "SELECT    
                DATEPART(MONTH, [Fecha]) AS 'Month', COUNT(*) AS 'Studies'
                FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
                INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
                ON e.ExpedienteID = est.ExpedienteID 
                INNER JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
                ON est.CatEstudioID = ce.CatEstudioID
                WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'
                GROUP BY  
                    DATEPART(MONTH, [Fecha])
                ORDER BY 
                    'Month'";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$studies = $result;

while( $row = sqlsrv_fetch_array( $studies) ) {
    array_push($count_studies_by_month, array($row['Month'], $row['Studies']));
}


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


$count_records_studies_by_month = array();

foreach($count_records_by_month as $count_records){

    foreach($count_studies_by_month as $count_studies){
        if($count_studies[0] == $count_records[0]){
            $study_count = $count_studies[1];
            break;
        }
        else{
            $study_count = 0;
        }
    }

    array_push($count_records_studies_by_month, array($count_records[0], $count_records[1], $study_count));
}


$i = 1;
$bgc = '#F0F0F0';
$c = '#000000';

foreach($count_records_studies_by_month as $count){

    

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
            <td style="background-color: '.$bgc.'; color: '.$c.'; font-weight: bold;">'.$months[$count[0]].'</td>
            <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$count[1].'</td>
            <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$count[2].'</td>
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
            <th style="text-align: center;">Estudios</th>
        </tr>
        '.$html.'
    </table>



';

echo $html;

sqlsrv_close($conn);


?>
