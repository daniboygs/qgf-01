<?php
$sql = "SELECT * FROM [QGFORENSE].[dbo].[CatTipoMuestra] ORDER BY Tipo";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$samples = $result;

if ($row_count === false)
    echo "Error al obtener datos.";
/*else{
    while( $row = sqlsrv_fetch_array( $result) ) {
        echo $row['ExpedienteID'];
    }
}*/


//sqlsrv_close($conn);

$html='';

while( $row = sqlsrv_fetch_array( $samples) ) {
    $html.='
        <li><a id="'.trim($row[0]," ").'" class="small" data-value="'.trim($row[0]," ").'" name="'.$row[1].'" tabIndex="-1"><input type="checkbox"/>&nbsp;'.$row[1].'</a></li>
    ';
}


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
        
                <label for="">Tipo de muestra: </label>
        
                    <div id="drugs-drop" class="button-group">
                        <button type="button" id="comboCheck" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" onclick="multiselectCombobox()">Seleccione tipos de muestra: <span style="float: right;" class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
                        <ul class="dropdown-menu" onchange="setVariantInput()">
                            '.$html.' 
                        </ul>
                    </div>
        
                </div>
            ';

echo $return;
?>