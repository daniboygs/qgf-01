<?php
include('../../../../service/connection.php');

$nuc = $_POST['nuc'];
$description = $_POST['description'];
$study = $_POST['study'];
$record_id = $_POST['record_id'];
$person = $_POST['person'];

$samples = json_decode($_POST['samples']);
$variants = json_decode($_POST['variants']);

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sample_name_values = "";
$variant_name_values = "";

if(count($samples) != 0){
    $i = 1;

    foreach ($samples as $element) {

        if($i == count($samples)){
            $sample_name_values = $sample_name_values.$element->sample_name."";
        }
        else{
            $sample_name_values = $sample_name_values.$element->sample_name.", ";
        }
        $i = $i+1;
    
    }

}
else{
    $sample_name_values = "n/a";
}

if(count($variants) != 0){
    $i = 1;

    foreach ($variants as $element) {

        if($i == count($variants)){
            $variant_name_values = $variant_name_values.$element->variant_name."";
        }
        else{
            $variant_name_values = $variant_name_values.$element->variant_name.", ";
        }
        $i = $i+1;
    
    }

}
else{
    $variant_name_values = "n/a";
}

$sql = 
"INSERT INTO [QGFORENSE].[dbo].[EstudioGF]
([Descripcion]
,[Persona]
,[CatEstudioID]
,[ExpedienteID]
,[Muestra]
,[Variante])
VALUES
(
    '$description',
    '$person',
    '$study',
    '$record_id',
    '$sample_name_values',
    '$variant_name_values'
)
SELECT SCOPE_IDENTITY()
";

$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_next_result($stmt); 
sqlsrv_fetch($stmt); 


$study_id = sqlsrv_get_field($stmt, 0); 


$variant_id_values = "";


if(count($variants) != 0){
    $i = 1;

    foreach ($variants as $element) {

        if($i == count($variants)){
            $variant_id_values = $variant_id_values."(".$element->variant_id.", ".$study_id.");";
        }
        else{
            $variant_id_values = $variant_id_values."(".$element->variant_id.", ".$study_id."),";
        }
        $i = $i+1;
    
    }


    $sql =
    "INSERT INTO [QGFORENSE].[dbo].[VarianteGF] (
        CatVarianteID,
        EstudioID
    )
    VALUES
        $variant_id_values";

    $stmt = sqlsrv_query( $conn, $sql);

    sqlsrv_fetch($stmt); 

}

$sample_id_values = "";


if(count($samples) != 0){
    $i = 1;

    foreach ($samples as $element) {

        if($i == count($samples)){
            $sample_id_values = $sample_id_values."('".$element->sample_id."', ".$study_id.");";
        }
        else{
            $sample_id_values = $sample_id_values."('".$element->sample_id."', ".$study_id."),";
        }
        $i = $i+1;
    
    }


    $sql =
    "INSERT INTO [QGFORENSE].[dbo].[MuestraGF] (
        CatMuestraID,
        EstudioID
    )
    VALUES
        $sample_id_values";

    $stmt = sqlsrv_query( $conn, $sql);

    sqlsrv_fetch($stmt); 

}


echo $record_id;

/* $next_result = sqlsrv_next_result($stmt);

if( $next_result ) {
   while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
      echo $row['ExpedienteID']; 
   }
} elseif( is_null($next_result)) {
     echo "No more results.<br />";
} else {
     die(print_r(sqlsrv_errors(), true));
} */

sqlsrv_close($conn);

?>