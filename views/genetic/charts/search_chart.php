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

<script src="<?php echo $genetic_url; ?>/charts/js/<?php echo $genetic_charts_js; ?>"></script>
<link href="<?php echo $genetic_url; ?>/charts/styles/<?php echo $genetic_charts_css; ?>" rel="stylesheet">  

<?php
	include("templates/forms/search_chart_form.php");
?>

<div class='chart-container' id='chart-container'></div>
<div class='table-container' id='table-container' style="display: none;"></div>

<?php
	}
	else{
		echo "<script> document.location.href='../index.php';</script>"; 
	}
?>
