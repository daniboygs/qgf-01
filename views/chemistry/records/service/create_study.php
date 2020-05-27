<?php
session_start();
include ('../../../../service/connection.php');

$document_type = $_POST['document_type'];
$emited_document = $_POST['emited_document'];
$indication = $_POST['indication'];

$description = $_POST['description'];
$nuc = $_POST['nuc'];
$result = $_POST['result'];
$sample = $_POST['sample'];
$detail = $_POST['detail'];
$study = $_POST['study'];
$record_id = $_POST['record_id'];

$person = $_POST['person'];

$sp = $_POST['sp'];

$detail_id_collection = json_decode($_POST['detail_collection']);


if($study == 1 || $study == 2){
    if($_POST['detail'] != 'n/a'){
        $detail = $_POST['detail'].' mg%';
    }
    else{
        $detail = $_POST['detail'];
    }
    
}
else{
    if($detail!='n/a'){
        $sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleQF] WHERE CatDetalleID = '$detail'";

        $params = array();
        $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $details = sqlsrv_query( $conn, $sql , $params, $options );

        $row_count = sqlsrv_num_rows( $details );

        while($row = sqlsrv_fetch_array($details)){
            $detail = $row[1];
        }
    }
    
}

if($sample!='n/a'){
    $sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDescripcionQF] WHERE CatDescripcionID = '$sample'";

    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $descriptions = sqlsrv_query( $conn, $sql , $params, $options );

    $row_count = sqlsrv_num_rows( $descriptions );

    while($row = sqlsrv_fetch_array($descriptions)){
        $sample = $row[1];
    }
}

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = 
"INSERT INTO [QGFORENSE].[dbo].[EstudioQF]
([Descripcion]
,[Resultado]
,[Muestra]
,[Detalle]
,[CatEstudioID]
,[ExpedienteID]
,[TipoDocumentoE]
,[DocumentoEmitido]
,[NumeroIndicios]
,[SP])
VALUES
(
    '$description',
    '$result',
    '$sample',
    '$detail',
    '$study',
    '$record_id',
    '$document_type',
    '$emited_document',
    '$indication',
    '$sp'
    
)
SELECT SCOPE_IDENTITY()
";


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_next_result($stmt); 
sqlsrv_fetch($stmt); 
$study_id = sqlsrv_get_field($stmt, 0); 


$detail_name_collection = array(); 
$detail_collection = array();

foreach ($detail_id_collection as $element) {
    $sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleQF] WHERE CatDetalleID = '$element'";

    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $details = sqlsrv_query( $conn, $sql , $params, $options );

    while($row = sqlsrv_fetch_array($details)){
        array_push($detail_name_collection, $row[1]);
        array_push($detail_collection, [$row[0], $row[1]]);
    }

}


foreach ($detail_collection as $element) {

    $sql = 
    "INSERT INTO [QGFORENSE].[dbo].[DetalleQF]
    ([CatDetalleID], [Detalle], [EstudioID])
    VALUES
    (
        '$element[0]', '$element[1]', '$study_id'
    )
    ";


    $stmt = sqlsrv_query( $conn, $sql);

}




if(count($detail_name_collection)>0){
    $i=0;
    $detail = "";

    foreach ($detail_name_collection as $name) {
    
        if($i < count($detail_name_collection)-1){
            $detail.=$name.', ';
        }
        else{
            $detail.=$name;
        }
        $i++;
    }
}






$sql = 
    "UPDATE [QGFORENSE].[dbo].[EstudioQF]
    SET [Detalle] = '$detail'
    WHERE [EstudioID] = '$study_id'"
    ;

$stmt = sqlsrv_query( $conn, $sql);


if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
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

?>