<?php
session_start();
include('../../../../../service/connection.php');

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

$html = '';
$studies = $result;


$i = 1;
$bgc = '#F0F0F0';
$c = '#000000';

while( $row = sqlsrv_fetch_array( $studies) ) {

    

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
            <td style="background-color: '.$bgc.'; color: '.$c.'; font-weight: bold;">'.$row['Descripcion'].'</td>
            <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$row['Estudios'].'</td>
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
            <th>Estudio</th>
            <th style="text-align: center;">Cantidad</th>
        </tr>
        '.$html.'
    </table>



';

echo $html;

sqlsrv_close($conn);


?>
