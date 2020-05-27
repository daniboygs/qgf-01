<?php
include('../../../../service/connection.php');

$sample = $_POST['sample'];
$name = $_POST['name'];
$variants_number = $_POST['variants_number'];
$html = '';

$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatVarianteGF] WHERE MuestraID = '$sample' ORDER BY Variante";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$variants = $result;
$html = '';


while( $row = sqlsrv_fetch_array( $variants) ) {
    $html.='
        <option value="'.$row['CatVarianteID'].'">'.$row['Variante'].'</option>
    ';
}

$params_sample = "'$sample', '$name'";

if($html != ''){
    $html = '

        <div class="form-row">
            <div class="form-group col-md-11">
                <label for="" id="variant-label-'.$sample.'">Variante ('.$name.'): <a style="color: #dc3545;">('.$variants_number.' agregados)</a></label>
                <div style="display: -webkit-box;">
                    <select class="form-control" id="variant-'.$sample.'" preholder="'.$name.'">
                        '.$html.' 
                    </select>
                    <button type="button" class="btn btn-outline-primary" id="add-study-variant-btn-'.$sample.'" style="margin-left: 10px;" onclick="addStudyVariant('.$params_sample.')">+</button>
                    <button type="button" class="btn btn-outline-warning" id="show-study-variant-btn-'.$sample.'" style="margin-left: 2px;" data-toggle="modal" data-target="#show-variants-modal" onclick="showStudyVariant('.$params_sample.')">...</button>
                </div>
            </div>
        </div>

    ';
}


echo $html;

sqlsrv_close($conn);

?>