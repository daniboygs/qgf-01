<?php
include('../../../../service/connection.php');

$fiscalia = $_POST['fiscalia'];

$sql = "SELECT [uid], [nombre], [area], [FiscaliaID] FROM [QGFORENSE].[dbo].[Usuarios] WHERE FiscaliaID = '$fiscalia' AND area = 2 ORDER BY nombre";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $details) ) {
    $html.='
        <option value="'.$row['uid'].'">'.$row['nombre'].'</option>
    ';
}

if($html != ''){
    $html = '

        <label for="">Perito designado: </label>
        <select class="form-control" id="perito" preholder="Perito" required>
            '.$html.' 
        </select>

    ';
}
else{
    $html = '

        <label for="">Perito designado: </label>
        <select class="form-control" id="perito" preholder="Perito" disabled required>
        </select>

    ';
}



echo $html;

sqlsrv_close($conn);

?>