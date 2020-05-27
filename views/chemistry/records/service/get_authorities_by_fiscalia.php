<?php
session_start();
include ('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];

$sql = "SELECT DISTINCT * FROM [QGFORENSE].[dbo].[AutoridadSolicitante] where FiscaliaID = $fiscalia ORDER BY Nombre";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $details) ) {
    $html.='
        <option value="'.$row['AutoridadSolicitanteID'].'">'.$row['Nombre'].'</option>
    ';
}

if($html != ''){
    $html = '

        <label for="">Autoridad solicitante: </label>
        <select class="form-control" id="authority" preholder="Autoridad" required>
            '.$html.' 
        </select>

    ';
}
else{
    $html = '

    <label for="">Autoridad solicitante: </label>
    <select class="form-control" id="authority" preholder="Autoridad" disabled required>
    </select>

    ';
}



echo $html;

?>