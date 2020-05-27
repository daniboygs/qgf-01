<?php
session_start();
include ('connection.php');

//Variables recibidas del index

$user = $_POST['user'];
$pass = $_POST['pass'];

//Consulta a la BD para verificar usuario y contraseña

$sql = "SELECT * FROM [QGFORENSE].[dbo].[Usuarios] WHERE [usuario] = '$user' AND [contrasena] = '$pass'";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$json = '';
$return = array();

if ($row_count <= 0){
	$return = array(
		'state' => 'fail',
		'username' => ''
	);
}
else{
	while( $row = sqlsrv_fetch_array( $result) ) {
		$json = json_encode($row);
	}
	
	$json = json_decode($json, true);
		
	$return = array(
		'state' => 'ok',
		'username' => $json['usuario'],
		'name' => $json['nombre'].' '.$json['apellidoPaterno'].' '.$json['apellidoMaterno'],
		'area' => $json['area'],
		'fiscalia' => $json['FiscaliaID'],
		'uid' => $json['uid'],
	);
	$_SESSION['username'] = $return['username'];
	$_SESSION['name'] = $return['name'];
	$_SESSION['area'] = $return['area'];
	$_SESSION['fiscalia'] = $return['fiscalia'];
	$_SESSION['uid'] = $return['uid'];
}

echo json_encode($return, JSON_FORCE_OBJECT);

sqlsrv_close($conn);


	


/*$resultado=mysqli_query($conn, $sql);
if ($resultado->num_rows>0){
	$datos= $resultado->fetch_object();
    $nivel = $datos->idPermiso;
	
	$_SESSION['RPE'] = $datos->RPE;
	
	$retornar = array(
	'estado' => 'ok',
	'RPE' => $datos->RPE, 
	'idPermiso' => $datos->idPermiso
	);
	
} else{
	$retornar = array(
	'estado' => 'Bad',
	'RPE' => '0', 
	'idPermiso' => '0'
	);
	
}*/

//Devolvemos el array pasado a JSON como objeto
//echo json_encode($retornar, JSON_FORCE_OBJECT);

//mysqli_close($conn);

?>