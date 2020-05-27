<?php
include('../../../service/connection.php');

//$record_id = $_POST['record_id'];


if($area != 0 && $fiscalia != 0){
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'N', e.ExpedienteID, e.nuc, e.Fecha, u.nombre AS Perito, a.Nombre AS Autoridad FROM [QGFORENSE].[dbo].[ExpedienteGF] e INNER JOIN [QGFORENSE].[dbo].[AutoridadSolicitante] a ON e.AutoridadSolicitanteID = a.AutoridadSolicitanteID INNER JOIN [QGFORENSE].[dbo].[Usuarios] u ON e.PeritoID = u.uid WHERE PeritoID = $uid ORDER BY Fecha DESC";
}

else if($fiscalia != 0){
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'N', e.ExpedienteID, e.nuc, e.Fecha, u.nombre AS Perito, a.Nombre AS Autoridad FROM [QGFORENSE].[dbo].[ExpedienteGF] e INNER JOIN [QGFORENSE].[dbo].[AutoridadSolicitante] a ON e.AutoridadSolicitanteID = a.AutoridadSolicitanteID INNER JOIN [QGFORENSE].[dbo].[Usuarios] u ON e.PeritoID = u.uid WHERE FiscaliaID = $fiscalia ORDER BY Fecha DESC";
}

else{
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY e.ExpedienteID ASC) AS 'N', e.ExpedienteID, e.nuc, e.Fecha, u.nombre AS Perito, a.Nombre AS Autoridad FROM [QGFORENSE].[dbo].[ExpedienteGF] e INNER JOIN [QGFORENSE].[dbo].[AutoridadSolicitante] a ON e.AutoridadSolicitanteID = a.AutoridadSolicitanteID INNER JOIN [QGFORENSE].[dbo].[Usuarios] u ON e.PeritoID = u.uid ORDER BY Fecha DESC";
}

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $records) ) {
    $html.='
        <tr>
            <td style="text-align: center;">'.$row['N'].'</td>
            <td style="text-align: center;"><strong>'.$row['nuc'].'</strong></td>
            <td style="text-align: center;">'.$row['Fecha']->format('d/m/Y').'</td>
            <td>'.$row['Perito'].'</td>
            <td>'.$row['Autoridad'].'</td>
            <td style="text-align: center;">
                <button type="button" onclick="updateRecordById('.$row['ExpedienteID'].')" class="btn btn-outline-primary" id="delete-detail">Modificar</button>
            </td>
        </tr>
    ';
}

if($html != ''){
    $html = '
    <script>
        $(".loader-div").removeClass("loader");
    </script>

    <div id="search-in-tables">
        <div class="form-group pull-right">
            <input type="text" class="search form-control" onkeyup="filter()" placeholder="NUC">
        </div>
    </div>

    <table class="table results" >
        <thead>
        <tr>
        <th>#</th>
            <th scope="col">nuc</th>
            <th>Fecha</th>
            <th>Perito designado</th>
            <th>Autoridad solicitante</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            '.$html.'   
        </tbody>
    </table>
    ';
}

echo $html;

sqlsrv_close($conn);

?>