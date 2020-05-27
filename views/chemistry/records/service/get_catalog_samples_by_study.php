<?php
session_start();
include ('../../../../service/connection.php');

$cat_study_id = $_POST['cat_study_id'];

$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDescripcionQF] WHERE CatEstudioID = '$cat_study_id'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$descriptions = $result;
$html = '';

switch($cat_study_id){

    case 1:
    case 2:
    case 4:
    case 13:
    case 14:
    case 15:
    case 17:
    case 19:
    case 21:
    case 24:

        while( $row = sqlsrv_fetch_array($descriptions) ) {
            $html.='
                <option value="'.$row['CatDescripcionID'].'">'.$row['Descripcion'].'</option>
            ';
        }

        $html = addInputStructure($html, 0, "", "");

    break;

    default:

}


function addInputStructure($html, $op, $title, $lower_title){
    $return = '';
    switch($op){
        case 0:

            $return = '
                <label for="">Muestra: </label>
                <select class="form-control" id="sample" preholder="Descripción" required>
                    '.$html.' 
                </select>
            ';

        break;

        default:
    }

    echo $return;
}


echo $html;

?>