<?php
session_start();
include ('../../../../service/connection.php');

$record_id = $_POST['record_id'];

$sql = "SELECT ROW_NUMBER() OVER(ORDER BY es.EstudioID ASC) AS 'N', EstudioID, Resultado, es.Descripcion, es.Muestra, es.Detalle, ce.Descripcion AS 'Estudio', es.ExpedienteID, es.DocumentoEmitido FROM [QGFORENSE].[dbo].[EstudioQF] es INNER JOIN [QGFORENSE].[dbo].[CatEstudioQF] ce ON es.CatEstudioID = ce.CatEstudioID WHERE ExpedienteID = '$record_id'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $details) ) {
    $html.='
        <tr>
            <td style="text-align: center;">'.$row['N'].'</td>
            <td style="text-align: center;">'.$row['Descripcion'].'</td>
            <td>'.$row['Estudio'].'</td>
            <td style="text-align: center;">'.$row['DocumentoEmitido'].'</td>
            <td style="text-align: center;">'.$row['Resultado'].'</td>
            <td style="text-align: center;">'.$row['Muestra'].'</td>
            <td>'.$row['Detalle'].'</td>
            <td><button type="button" onclick="deleteStudy('.$row['EstudioID'].', '.$row['ExpedienteID'].')" class="btn btn-outline-danger" id="delete-detail">Eliminar</button></td>
        </tr>
    ';
}

if($html != ''){
    $html = '
    <script>
        $(".loader-div").removeClass("loader");
    </script>
    <table class="table" >
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estudio</th>
            <th scope="col">Documento Emitido</th>
            <th scope="col">Resultado</th>
            <th scope="col">Muestra</th>
            <th scope="col">Detalle</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            '.$html.'   
        </tbody>
    </table>
    ';
}
else{
    $html = '
    <script>
        $(".loader-div").removeClass("loader");
    </script>
    <table class="table" >
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estudio</th>
            <th scope="col">Documento Emitido</th>
            <th scope="col">Resultado</th>
            <th scope="col">Muestra</th>
            <th scope="col">Detalle</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody> 
        </tbody>
    </table>
    <div style="background-color: #FFE66A; width: 100%; text-align: center; font-size: 16pt; color: grey;"><strong>NO SE HAN CAPTURADO ESTUDIOS</strong> </div>
    <hr>
    ';
}

echo $html;

?>