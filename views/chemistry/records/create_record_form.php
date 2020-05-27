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

<script>
    document.getElementById("authority").selectedIndex = -1;
    document.getElementById("perito").selectedIndex = -1;
    document.getElementById("date").valueAsDate = new Date();
</script> 
         

<form action="" class="form-group" id="create_record_form">

    <div class="page-header">
        <h1 class="title" id="titulo" >NUEVO EXPEDIENTE</h1>
    </div>
    <br>

    <hr>

        <div id="update-alert" class="alert alert-warning" style="display: none;" role="alert">
            <strong>No se han guardado los cambios!, </strong>porfavor guarde sus cambios
        </div>


        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="">Nuc: </label>
                <input type="text" class="form-control" id="nuc" placeholder="NUC" minlength="13"  maxlength="13" onkeypress="validateNuc(event)" required>
            </div>

            
            <div class="form-group col-md-4">
                <label for="">Fecha: </label>
                <input type="date" class="form-control" id="date" name="trip-start" required>
            </div>

            <div class="form-group col-md-4">
                <label for="">Fiscalía: </label>
                <select class="form-control" id="fiscalia" preholder="Fiscalía" onchange="changePeritosAuthorities()" required>
                    
                    <?php
                    include("service/get_fiscalias.php");
                    while($row = sqlsrv_fetch_array($fiscalias)){
                    ?> 
                    <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                
                    <?php
                    }
                    ?>
                </select>
            </div> 
            

        </div>

        <div class="form-row">

            <!--<div class="form-group col-md-4">
            <label for="">Descripción Hecho: </label>
            <input type="text" class="form-control" id="description" placeholder="Descripción" maxlength="45" required>
            </div>-->

            <!--<div class="form-group col-md-6">
            <label for="">Autoridad Solicitante: </label>
            <input type="text" class="form-control" id="authority" placeholder="Autoridad Solicitante" maxlength="45" required>
            </div>-->

            

            <div id="authority-select" class="form-group col-md-12">
                <label for="">Autoridad Solicitante: </label>
                <select class="form-control" id="authority" preholder="Autoridad Solicitantea" required>
                    
                    <?php
                    include("service/get_authorities.php");
                    while($row = sqlsrv_fetch_array($authorities)){
                    ?> 
                    <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                
                    <?php
                    }
                    ?>
                </select>
            </div>  


        </div>

        <div class="form-row">

            <!--<div class="form-group col-md-7">
            <label for="">Perito designado: </label>
            <input type="text" class="form-control" id="perito" placeholder="Perito designado" maxlength="45" required>
            </div>-->

            <div id="perito-select" class="form-group col-md-7">
                <label for="">Perito designado: </label>
                <select class="form-control" id="perito" preholder="Perito designado" required>
                    
                    <?php
                    include("service/get_peritos.php");
                    while($row = sqlsrv_fetch_array($peritos)){
                    ?> 
                    <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                
                    <?php
                    }
                    ?>
                </select>
            </div> 

            <div class="form-group col-md-5">
            <label for="">Oficio: </label>
            <input type="text" class="form-control" id="oficio" placeholder="Oficio" maxlength="45" required>
            </div>


        </div>

        
        
        <script>
            document.getElementById("perito").disabled = true;
            document.getElementById("authority").disabled = true;
            if((<?php echo $fiscalia ?>) != 0){
                document.getElementById("fiscalia").value = ('<?php echo $fiscalia ?>');
                document.getElementById("fiscalia").disabled = true;
                document.getElementById("perito").value = ('<?php echo $uid ?>');
                document.getElementById("perito").disabled = true;
                document.getElementById("authority").disabled = false;
            }
            else{
                document.getElementById("fiscalia").selectedIndex = -1;
                document.getElementById("fiscalia").disabled = false;
                document.getElementById("perito").selectedIndex = -1;
            }
        </script>
        

        
    <br>

    <div class="button-form">
        <button type="button" class="btn btn-outline-warning" id="update-record-btn" style="display: none;" onclick="updateRecordBtn()">Modificar</button>
    </div>

    <div class="button-form" style="display: inline-flex">
        <button type="button" class="btn btn-outline-danger" style="margin-right: 10px; display: none;" id="cancel-update-record-btn" onclick="cancelUpdateRecordBtn()">Cancelar</button>
        <button type="button" class="btn btn-outline-primary" id="save-update-record-btn" style="display: none;" onclick="saveUpdateRecordBtn()">Guardar</button>
    </div>


    <div class="button-form">
        <button type="button" class="btn btn-outline-danger" style="margin-right: 10px" id="cancel-record-btn">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary" id="save-record-btn">Guardar</button>
    </div>
    
    <br>

</form>



<hr>

<div id="study-container"></div>

<div id="detail-table" ></div>






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
    		
    
 
 