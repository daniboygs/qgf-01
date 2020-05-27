<?php
session_start();
include ('../../../../service/connection.php');

$cat_study_id = $_POST['cat_study_id'];

$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleQF] WHERE CatEstudioID = '$cat_study_id'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$details = $result;
$html = '';

switch($cat_study_id){

    case 1:

    case 2:

        $html = addInputStructure($html, 2, "", "");

    break;

    case 4:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="determination-drug-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Drogas", "drogas");
        }

    break;

    case 14:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="drug-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Drogas", "drogas");
        }

    break;

    case 19:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="waste-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Residuos", "residuos");
        }

    break;


    case 21:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="toxic-substance-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Sustancias tóxicas", "sustancias tóxicas");
        }

    break;

    case 5:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="acelerant-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Acelerantes de la combustion", "acelerantes");
        }

    break;

    case 13:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="seminal-component-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Componentes del líquido seminal", "componentes");
        }

    break;

    case 15:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="botanic-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Material bortánico", "material botánico");
        }

    break;

    /*case 20:
        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <li><a id="human-blood-'.$row['CatDetalleID'].'" class="small" data-value="'.$row['CatDetalleID'].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row['Detalle'].'</a></li>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 1, "Especie", "especie");
        }

    break;*/

    default:

        while( $row = sqlsrv_fetch_array( $details) ) {
            $html.='
                <option value="'.$row['CatDetalleID'].'">'.$row['Detalle'].'</option>
            ';
        }
        
        if($html != ''){
            $html = addInputStructure($html, 0, "", "");
        }


}


function addInputStructure($html, $op, $title, $lower_title){
    $return = '';
    switch($op){
        case 0:

            $return = '
                <label for="">Detalle: </label>
                <select class="form-control" id="detail" preholder="Detalle" required>
                    '.$html.' 
                </select>
            ';

        break;

        case 1:
            
            $return = '    
                <script>
                var options = [];
        
                $( "#drugs-drop.dropdown-menu a" ).on( "click", function( event ) {
                
                var $target = $( event.currentTarget ),
                    val = $target.attr( "data-value" ),
                    $inp = $target.find( "input" ),
                    idx;
                
                if ( ( idx = options.indexOf( val ) ) > -1 ) {
                    options.splice( idx, 1 );
                    setTimeout( function() { $inp.prop( "checked", false ) }, 0);
                } else {
                    options.push( val );
                    setTimeout( function() { $inp.prop( "checked", true ) }, 0);
                }
                
                $( event.target ).blur();
                    
                console.log( options );
                return false;
                });
        
                </Script>
        
        
                <div>
        
                <label for="">'.$title.': </label>
        
                    <div id="drugs-drop" class="button-group">
                        <button type="button" id="comboCheck" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" onclick="multiselectCombobox()">Seleccione '.$lower_title.': <span style="float: right;" class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
                        <ul class="dropdown-menu" >
                            '.$html.' 
                        </ul>
                    </div>
        
                </div>
            ';

        break;

        case 2:

            $return = '
                <div class="form-group col-md-10">
                    <label for="">Detalle: </label>

                    <input type="number" class="form-control" id="detail" min="0" name="quantity" value="0" required>
                </div>
                <strong> mg%</strong>
            ';

        break;

        default:
    }

    echo $return;
}


echo $html;

?>