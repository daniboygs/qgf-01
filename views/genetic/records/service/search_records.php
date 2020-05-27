<?php
include('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];
$start_date = $_POST['start_date'];
$finish_date = $_POST['finish_date'];

$sql = "";



if($fiscalia != 0){
    $sql = "SELECT DISTINCT [ExpedienteID] 
            FROM [QGFORENSE].[dbo].[ExpedienteGF] 
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia' 
            ORDER BY ExpedienteID";
}
else{
    $sql = "SELECT DISTINCT [ExpedienteID] 
            FROM [QGFORENSE].[dbo].[ExpedienteGF] 
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' 
            ORDER BY ExpedienteID";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$records_count = sqlsrv_num_rows( $result );

if($fiscalia != 0){
	$sql = "SELECT 
            ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'n'
            FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
            INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
            ON e.ExpedienteID = est.ExpedienteID 
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND FiscaliaID = '$fiscalia'";
}
else{
	$sql = "SELECT 
            ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'n'
            FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
            INNER JOIN [QGFORENSE].[dbo].[EstudioGF] est 
            ON e.ExpedienteID = est.ExpedienteID 
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$studies_count = sqlsrv_num_rows( $result );

if($fiscalia != 0){
	$sql = "SELECT ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'n', 
            e.ExpedienteID AS 'ExpedienteID', 
            e.nuc AS 'nuc', 
            e.Fecha AS 'Fecha', 
            d.DocumentoEmitido AS 'DocumentoEmitido', 
            ce.Descripcion AS 'Estudio', 
            d.Resultado AS 'Resultado', 
            est.Descripcion AS 'DescripcionEstudio', 
            a.Nombre AS 'Grupo', 
            est.Descripcion, 
            u.nombre as 'Perito', 
            f.Nombre as 'Fiscalia',
            est.EstudioID,
            d.DocumentoID
            FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
            LEFT JOIN [QGFORENSE].[dbo].[CatModalidadesEstadisticas] a 
            ON a.CatModalidadesEstadisticasID = e.DelitoID 
            LEFT JOIN [QGFORENSE].[dbo].[EstudioGF] est 
            ON e.ExpedienteID = est.ExpedienteID 
            LEFT JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
            ON est.CatEstudioID = ce.CatEstudioID 
            left JOIN [QGFORENSE].[dbo].[DocumentoGF] d
            ON e.ExpedienteID = d.ExpedienteID
            LEFT JOIN [QGFORENSE].[dbo].[Usuarios] u
            ON u.uid = e.PeritoID
            INNER JOIN [QGFORENSE].[dbo].[CatFiscalias] f
            ON f.FiscaliaID = e.FiscaliaID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date' AND e.FiscaliaID = '$fiscalia'
            ORDER BY e.Fecha";
}
else{
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'n', 
            e.ExpedienteID AS 'ExpedienteID', 
            e.nuc AS 'nuc', 
            e.Fecha AS 'Fecha', 
            d.DocumentoEmitido AS 'DocumentoEmitido', 
            ce.Descripcion AS 'Estudio', 
            d.Resultado AS 'Resultado', 
            est.Descripcion AS 'DescripcionEstudio', 
            a.Nombre AS 'Grupo', 
            est.Descripcion, 
            u.nombre as 'Perito', 
            f.Nombre as 'Fiscalia',
            est.EstudioID,
            d.DocumentoID
            FROM [QGFORENSE].[dbo].[ExpedienteGF] e 
            LEFT JOIN [QGFORENSE].[dbo].[CatModalidadesEstadisticas] a 
            ON a.CatModalidadesEstadisticasID = e.DelitoID 
            LEFT JOIN [QGFORENSE].[dbo].[EstudioGF] est 
            ON e.ExpedienteID = est.ExpedienteID 
            LEFT JOIN [QGFORENSE].[dbo].[CatEstudioGF] ce 
            ON est.CatEstudioID = ce.CatEstudioID 
            left JOIN [QGFORENSE].[dbo].[DocumentoGF] d
            ON e.ExpedienteID = d.ExpedienteID
            LEFT JOIN [QGFORENSE].[dbo].[Usuarios] u
            ON u.uid = e.PeritoID
            INNER JOIN [QGFORENSE].[dbo].[CatFiscalias] f
            ON f.FiscaliaID = e.FiscaliaID
            WHERE Fecha >= '$start_date' AND Fecha <= '$finish_date'
            ORDER BY e.Fecha";
}


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';

$table = array();
$exp_id = 0;
$exp_id = '';
$nuc = '';
$date = '';
$name = '';
$i = 0;
$studies = array();


$ind = true;
$bgc = '#A4A4A4';
$c = '#FFFFFF';

while( $row = sqlsrv_fetch_array( $details) ) {

    if($exp_id != $row['ExpedienteID']){

        if($ind){
            $bgc = '#F0F0F0';
            $c = '#000000';
            $ind = !$ind;
            $st_bgc = '#F0F0F0';
            $doc_bgc = '#F0F0F0';
        }
        else{
            $bgc = 'white';
            $c = '#000000';
            $ind = !$ind;
            $st_bgc = 'white';
            $doc_bgc = 'white';
        }

        if($row["EstudioID"] == null){
            $st_bgc = '#FF9984';
        }
        if($row["DocumentoID"] == null){
            $doc_bgc = '#FF9984';
        }
        
        $html.='
	
            <tr>
                <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$row['n'].'</td>
                <td style="background-color: '.$bgc.'; color: '.$c.';  text-align: center;"><strong>'.$row['nuc'].'</strong></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; text-align: center;">'.$row['Fecha']->format('d/m/Y').'</td>
                <td style="background-color: '.$bgc.'; color: '.$c.';">'.$row["Grupo"].'</td>
                <td style="background-color: '.$bgc.'; color: '.$c.';">'.$row["Perito"].'</td>
                <td style="background-color: '.$bgc.'; color: '.$c.';">'.$row["Fiscalia"].'</td>
                <td style="background-color: '.$doc_bgc.'; color: '.$c.'; text-align: center;">'.$row["DocumentoEmitido"].'</td>
                <td style="background-color: '.$doc_bgc.'; color: '.$c.'; text-align: center;"><strong>'.$row["Resultado"].'</strong></td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';">'.$row["Descripcion"].'</td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';"><span data-feather="circle"></span> '.$row["Estudio"].'</td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';">'.$row["DescripcionEstudio"].'</td>
            </tr>

        ';

    }
    else{
        $html.='
	
            <tr>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$bgc.'; color: '.$c.'; border-top: '.$bgc.'"></td>
                <td style="background-color: '.$doc_bgc.'; color: '.$c.'; text-align: center;">'.$row["DocumentoEmitido"].'</td>
                <td style="background-color: '.$doc_bgc.'; color: '.$c.'; text-align: center;"><strong>'.$row["Resultado"].'</strong></td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';">'.$row["Descripcion"].'</td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';">'.$row["Estudio"].'</td>
                <td style="background-color: '.$st_bgc.'; color: '.$c.';">'.$row["DescripcionEstudio"].'</td>
            </tr>

        ';
    }
    $exp_id = $row['ExpedienteID'];
}
/*
<form action="" id="filter_records_by_nuc_form" >
        <div class="form-group col-md-3">
            <input type="text" class="form-control" id="nuc" placeholder="NUC" maxlength="13" required>
        </div>

        <button type="submit" class="btn btn-primary" id="filter_records">Buscar</button>
    </form>


    <input type="button" onclick="tableToExcel()" value="Export to Excel">
*/
if($html != ''){
    $html = '

    <script>
        $(".loader-div").removeClass("loader");
    </script>

    

    <div id="search-in-tables">
        <div class="form-group pull-right">
            <input type="text" class="search form-control" onkeyup="filter()" placeholder="Buscar">
        </div>
        <div id="excel-btn">
            <button class="btn btn-outline-success" onclick="tableToExcel()">Descargar excel</button>
        </div>
        <div id="search-table-rows">
            Expedientes: <strong>'.$records_count.'</strong>
            <br>
            Estudios: <strong style="float: right;">'.$studies_count.'</strong>
        </div>
    </div>
    <table id="records-table" class="table results" >
        <thead>
        <tr> 
            <th scope="col">#</th>
            <th scope="col">Nuc</th>
            <th scope="col">Fecha</th>
            <th scope="col">Delito</th>
            <th scope="col">Perito Designado</th>
            <th scope="col">Fiscalia</th>
            <th scope="col">Documento Emitido</th>
            <th scope="col">Resultado</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estudio</th>
            <th scope="col">Observaciones</th>
        </tr>
        </thead>
        <tbody  id="TableDesignar">
			'.$html.'
        </tbody>
	</table>
    ';
}
if($html != ''){
    echo $html;
}
else{
    echo '
        <script>
            $(".loader-div").removeClass("loader");
        </script>
        <div style="width: 100%; text-align: center;"><h2>No existen registros de esta consulta</h2></div>
        ';
}


sqlsrv_close($conn);

?>