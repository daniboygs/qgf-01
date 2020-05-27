<?php
include('../../../../service/connection.php');

$cat_study_id = $_POST['cat_study_id'];

$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleGF] WHERE CatEstudioID = '$cat_study_id'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';

while( $row = sqlsrv_fetch_array( $details) ) {
    $html.='
        <option value="'.$row['CatDetalleID'].'">'.$row['Detalle'].'</option>
    ';
}

if($html != ''){
    $html = '

        <label for="">Detalle: </label>
        <select class="form-control" id="detail" preholder="Detalle" required>
            '.$html.' 
        </select>

    ';
}

echo $html;

sqlsrv_close($conn);

?>
