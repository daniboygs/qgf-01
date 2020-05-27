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

<div class="page-header">
    <h1 class="title" id="titulo" >MODIFICAR EXPEDIENTE</h1>
</div>
<hr>

<div id="record-container"></div>
<div id="study-container"></div>
<div id="study-table-container"></div>
<div id="detail-table"></div>
<div id="document-container"></div>
<div id="existant-document-alert" style="margin-top: 30px; margin-bottom: 30px;"></div>

<?php
	include("service/get_record_crud_table.php");
	}
	else{
		echo "<script> document.location.href='../index.php';</script>"; 
	}
?>
 
 