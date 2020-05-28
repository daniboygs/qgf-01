<?php 
  session_start();
  include("env/env.php");
  if(isset($_SESSION['username'])){ 
    echo "<script>window.location.href='main/index.php';</script>";
  }
?>

<!DOCTYPE html>

<html lang="en">

    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Forense</title>

		<link rel="shortcut icon" href="./assets/img/fge.png" />

		<link href="libs/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="libs/blurt-1.0.2/dist/css/blurt.min.css" rel="stylesheet">
		<link href="styles/<?php echo $css; ?>" rel="stylesheet">  
		
	
		<script src="libs/jquery/jquery-3.2.0.min.js" ></script>
		<script src="libs/bootstrap-4.0.0/dist/js/bootstrap.min.js" ></script>
		<script src="libs/blurt-1.0.2/dist/js/blurt.min.js" ></script>
        <script src="js/<?php echo $js; ?>"></script>
      
    </head>

    <body class="text-center" style="display: block;">
     
      	<form class="form-signin" id="login-form">

			<div id="user-logo">
				<img class="mb-4" src="assets/img/user.png" alt="" width="200" height="200">
			</div>

			<h1 class="h3 mb-3 font-weight-normal">Inicio de Sesión Principal</h1>
			
			<input id="user" name="user" type="text" class="form-control" placeholder="Usuario" required autofocus>
			
			<br>

			<input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña" required>

			<br>

			<button class="btn btn-lg btn-outline-primary btn-block" type="submit" class="botonlg" id="login" >Acceder</button>

		</form>
		  
		<br>
		
  		<div style="text-align: center; width: 100%; color: white;"><?php echo "$system_name-"; ?><?php echo "$version-"; ?><?php echo $release; ?></div>
      
    </body>
  
</html>