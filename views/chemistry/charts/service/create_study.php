<?php
session_start();
include ('../../../../service/connection.php');

$nuc = $_POST['nuc'];
$result = $_POST['result'];
$description = $_POST['description'];
$study = $_POST['study'];
$record_id = $_POST['record_id'];
$drugs = json_decode($_POST['drugs']);

if($study == 1 || $study == 2){
    $description = $_POST['description'].' mg%';
}
else{
    if($description!='n/a'){
        $sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleQF] WHERE CatDetalleID = '$description'";

        $params = array();
        $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $details = sqlsrv_query( $conn, $sql , $params, $options );

        $row_count = sqlsrv_num_rows( $details );

        while($row = sqlsrv_fetch_array($details)){
            $description = $row[1];
        }
    }
    
}

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = 
"INSERT INTO [QGFORENSE].[dbo].[EstudioQF]
([Resultado]
,[Descripcion]
,[CatEstudioID]
,[ExpedienteID])
VALUES
(
    '$result',
    '$description',
    '$study',
    '$record_id'
)
SELECT SCOPE_IDENTITY()
";


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_next_result($stmt); 
sqlsrv_fetch($stmt); 
$study_id = sqlsrv_get_field($stmt, 0); 


$details_drugs = array();

foreach ($drugs as $drug) {
    $sql = "SELECT * FROM [QGFORENSE].[dbo].[CatDetalleQF] WHERE CatDetalleID = '$drug'";

    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $details = sqlsrv_query( $conn, $sql , $params, $options );

    while($row = sqlsrv_fetch_array($details)){
        array_push($details_drugs, $row[1]);
    }

}


foreach ($drugs as $drug) {

    $sql = 
    "INSERT INTO [QGFORENSE].[dbo].[DetalleQF]
    ([CatDetalleID], [EstudioID])
    VALUES
    (
        '$drug', '$study_id'
    )
    ";


    $stmt = sqlsrv_query( $conn, $sql);

}




if(count($details_drugs)>0){
    $i=0;
    $description = "";

    foreach ($details_drugs as $drug) {
    
        if($i < count($details_drugs)-1){
            $description.=$drug.', ';
        }
        else{
            $description.=$drug;
        }
        $i++;
    }
}






$sql = 
    "UPDATE [QGFORENSE].[dbo].[EstudioQF]
    SET [Descripcion] = '$description'
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