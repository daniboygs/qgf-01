<?php
include('../../../../service/sicap_connection.php');

$nuc = $_POST['nuc'];

$sql = "SELECT [CatModalidadesID]
        FROM [PRUEBA].[dbo].[Carpeta] c 
        INNER JOIN [PRUEBA].[dbo].[Delito] d 
        ON c.CarpetaID = d.CarpetaID 
        WHERE NUC = '$nuc'";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$crime_id = '';

if ($row_count != 0){
    while( $row = sqlsrv_fetch_array( $result) ) {
        $crime_id = $row['CatModalidadesID'];
    }
    echo $crime_id;
}
else{
    echo 0;
}

sqlsrv_close($conn);
    
?>

