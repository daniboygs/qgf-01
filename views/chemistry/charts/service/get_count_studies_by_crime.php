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
                d.Detalle,
                COUNT(d.detalle) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                d.Detalle, cme.Nombre
            ORDER BY 
                cme.Nombre";
}
else{
	$sql = "SELECT
                cme.Nombre,   
                d.Detalle,
                COUNT(d.detalle) AS 'Cantidad'
            FROM      [QGFORENSE].[dbo].[ExpedienteQF] e INNER JOIN [QGFORENSE].[dbo].[EstudioQF] est ON e.ExpedienteID = est.ExpedienteID INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON est.CatEstudioID = ce.CatEstudioID INNER JOIN [QGFORENSE].[dbo].[DetalleQF] d ON est.EstudioID = d.EstudioID INNER JOIN CatModalidadesEstadisticas cme ON e.DelitoID = cme.CatModalidadesEstadisticasID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND (est.Resultado<> 'NA' and est.Resultado<> 'n/a' and est.Resultado<> 'NO APLICA')
            GROUP BY  
                d.Detalle, cme.Nombre
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

$crime = '';
$crime_count = 0;

$bgc = '#F0F0F0';
$c = '#000000';

while( $row = sqlsrv_fetch_array( $records) ) {

    if($crime != $row['Nombre']){

        foreach($count_studies_by_crime as $count){
            if($row['Nombre'] == $count[0]){
                $crime_count = $count[1];
            }
        }

        $html.='

            <tr>
                <td style="background-color: '.$bgc.'; color: '.$c.'; font-weight: bold;">'.$row['Nombre'].'</td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; font-weight: bold; text-align: center;">'.$crime_count.'</td>
            </tr>

            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;'.$row['Detalle'].'</td>
                <td style="text-align: center;">'.$row['Cantidad'].'</td>
            </tr>

        ';

    }
    else{
        $html.='

            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;'.$row['Detalle'].'</td>
                <td style="text-align: center;">'.$row['Cantidad'].'</td>
            </tr>

        ';
    }
    $crime = $row['Nombre'];
}

$html = '

    <script>
        $(".loader-div").removeClass("loader");
    </script>

    <hr>

    <div id="excel-btn">
        <button class="btn btn-outline-success" onclick="tableToExcel()">Descargar excel</button>
    </div>

    <br>

    <table id="count_drugs_by_crime" class="table">

        <tr>
            <th>Delito</th>
            <th style="text-align: center;">Total</th>
        </tr>
        '.$html.'
    </table>



';

echo $html;

sqlsrv_close($conn);


?>



