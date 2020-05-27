<?php 
  session_start();
  if(isset($_SESSION['username'])){ 
    $username = $_SESSION['username'];
	  $name = $_SESSION['name'];
    $area = $_SESSION['area'];
    $fiscalia = $_SESSION['fiscalia'];
    $uid = $_SESSION['uid'];
  }
  else{
    header("Location: ../index.php"); 
  }
?>

<script src="../views/chemistry/records/js/function.js"></script>
<link href="../views/chemistry/records/styles/styles.css" rel="stylesheet">  

<div class="page-header">
    <h1 class="title" id="titulo" >MODIFICAR EXPEDIENTE</h1>
</div>
<br>

<!--
<form action="" class="form-group" id="create_record_form">

    <div class="page-header">
        <h1 class="title" id="titulo" >MODIFICAR EXPEDIENTE</h1>
    </div>
    <br>

    <hr>

        <div class="form-row">


            <div class="form-group col-md-3">
            <label for="">Nuc: </label>
            <input type="text" class="form-control" id="nuc" placeholder="NUC" minlength="13"  maxlength="13" onkeypress="validateNuc(event)" required>
            </div>
            

        </div>

        
    <br>


    <div class="button-form">
        <button type="submit" class="btn btn-outline-primary" id="save-record-btn">Buscar</button>
    </div>
    
    <br>

</form>
-->


<hr>

<div id="record-container"></div>
<div id="study-container"></div>
<div id="study-table-container"></div>
<div id="detail-table" ></div>
<!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

-->

<?php
    include("service/get_record_crud_table.php");
?> 






<div>

<?php

    $studies = new ArrayObject();
    $studies['result'] = array();
    $studies['description'] = array();
    $studies['study'] = array();

    array_push($studies['result'], 'falso');

?>

</div>
<br>
    		
    
 
 