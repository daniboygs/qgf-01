<?php
  	//conexion local
	$servername = "172.16.2.27";
	$username = "daniel";
	$password = "jdgs1995#";
	$db = "PRUEBA";
	$connectionInfo = array('CharacterSet' => 'UTF-8', 'Database' => $db, 'UID' => $username, 'PWD' => $password);

	$conn = sqlsrv_connect( $servername, $connectionInfo);

	/*if( $conn ) {
		echo "Conexión establecida.<br />";
	}else{
		echo "Conexión no se pudo establecer.<br />";
		die( print_r( sqlsrv_errors(), true));
	}*/
?>
