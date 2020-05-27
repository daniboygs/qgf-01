<?php 
	session_start();
  	if(isset($_SESSION['username'])){ 
		$username = $_SESSION['username'];
		$name = $_SESSION['name'];
		$area = $_SESSION['area'];
		$fiscalia = $_SESSION['fiscalia'];
		$uid = $_SESSION['uid'];

		include("../../../env/env.php");
?>

<script src="<?php echo $genetic_url; ?>/records/js/<?php echo $genetic_records_js; ?>"></script>
<link href="<?php echo $genetic_url; ?>/records/styles/<?php echo $genetic_records_css; ?>" rel="stylesheet">  

<?php
	include("templates/forms/search_records_form.php");
?>

<div id="cont-table-rows"></div>
<div id="record-table"></div>

<?php
	}
	else{
		echo "<script> document.location.href='../index.php';</script>"; 
	}
?>
 
 