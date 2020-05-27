<?php
session_start();
include ('../../../../service/connection.php');

$record_id = $_POST['record_id'];

$sql = "SELECT * FROM [QGFORENSE].[dbo].[EstudioQF] WHERE ExpedienteID = '$record_id'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $details) ) {
    $html.='
        <tr>
            <td>'.$row['EstudioID'].'</td>
            <td>'.$row['Resultado'].'</td>
            <td>'.$row['Descripcion'].'</td>
            <td><button type="button" onclick="deleteDetail('.$row['EstudioID'].', '.$row['ExpedienteID'].')" class="btn btn-danger" id="delete-detail">Eliminar</button></td>
        </tr>
    ';
}

if($html != ''){
    $html = '
    <table class="table" >
        <thead>
        <tr>
            <th scope="col">Estudio</th>
            <th scope="col">Resultado</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            '.$html.'   
        </tbody>
    </table>
    ';
}

echo $html;

?>