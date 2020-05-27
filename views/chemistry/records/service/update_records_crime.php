<?php
session_start();
include ('../../../../service/sicap_connection.php');

$sql = "UPDATE [QGFORENSE].[dbo].[ExpedienteQF]
        SET 
        [DelitoID] = modalidades.CatModalidadesID
        FROM (SELECT d.[CatModalidadesID], c.[NUC] COLLATE Latin1_General_100_CI_AI AS 'NUC'
                FROM [PRUEBA].[dbo].[Carpeta] c 
                INNER JOIN [PRUEBA].[dbo].[Delito] d 
                ON c.CarpetaID = d.CarpetaID) AS modalidades
        WHERE  modalidades.NUC = [QGFORENSE].[dbo].[ExpedienteQF].nuc";


$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 
    
?>

