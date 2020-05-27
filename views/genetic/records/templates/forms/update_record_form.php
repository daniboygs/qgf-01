<?php
    session_start();
    if(isset($_SESSION['username'])){ 
        $fiscalia = $_SESSION['fiscalia'];

        include('../../../../../service/connection.php');

        $record_id = $_POST['record_id'];
        $recordNuc = $_POST['nuc'];
        $recordDate = $_POST['date'];
        $recordExpiratedDate = $_POST['expirated_date'];
        $recordAuthority = $_POST['authority'];
        $recordPerito = $_POST['perito'];
        $recordOficio = $_POST['oficio'];
        $recordFiscalia = $_POST['fiscalia'];
?>
         

<form action="" class="form-group" id="create_record_form"> 

    <div style="color: #7C8B9E;">
        <h1 id="nuc-label"><?php echo $recordNuc ?></h1>
    </div>
    <br>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="">Nuc: </label>
                <input value="<?php echo $recordNuc ?>" type="text" class="form-control" id="nuc" placeholder="NUC" minlength="13"  maxlength="13" onkeypress="validateNuc(event)" required>
            </div>

            
            <div class="form-group col-md-4">
                <label for="">Fecha: </label>
                <input value="<?php echo $recordDate ?>" type="date" class="form-control" id="date" name="trip-start" required>
            </div>

            <div class="form-group col-md-4">
                <label for="">Fecha de vencimiento: </label>
                <input value="<?php echo $recordExpiratedDate ?>" type="date" class="form-control record-input" id="expirated-date" name="trip-start" required>
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="">Fiscalía: </label>
                <select class="form-control" id="fiscalia" preholder="Fiscalía" onchange="changePeritosAuthorities()" required>
                    
                    <?php
                    include("../../service/get_fiscalias.php");
                    while($row = sqlsrv_fetch_array($fiscalias)){
                    ?> 
                    <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                
                    <?php
                    }
                    ?>
                </select>
            </div> 

            <div id="authority-select" class="form-group col-md-8">
                <label for="">Autoridad Solicitante: </label>
                <select class="form-control" id="authority" preholder="Autoridad solicitantea" required>
                    
                    <?php
                    include("../../service/get_authorities.php");
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

            <div id="perito-select" class="form-group col-md-7">
                <label for="">Perito designado: </label>
                <select class="form-control" id="perito" preholder="Perito designado" required>
                    
                    <?php
                    include("../../service/get_peritos.php");
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
            <input value="<?php echo $recordOficio ?>" type="text" class="form-control" id="oficio" placeholder="Oficio" maxlength="45" required>
            </div>


        </div>

    
        
    <br>

    <div class="button-form" style="display: inline-flex">
        <!--<button type="button" class="btn btn-outline-danger" style="margin-right: 10px; display: none;" id="cancel-update-record-btn" onclick="cancelUpdateRecordBtn()">Cancelar</button>-->
        <button type="button" class="btn btn-outline-primary" onclick="updateRecord()">Guardar</button>
    </div>

    
    <br>

</form>


<script>
    document.getElementById("fiscalia").value = ('<?php echo $recordFiscalia ?>');
    document.getElementById("authority").disabled = false;
    changePeritosAuthorities();

    setTimeout(function(){ 
        document.getElementById("perito").value = ('<?php echo $recordPerito ?>');
        document.getElementById("authority").value = ('<?php echo $recordAuthority ?>');
        if((<?php echo $fiscalia ?>) != 0){
            document.getElementById("fiscalia").disabled = true;
            document.getElementById("perito").disabled = true;
        }
        else{
            document.getElementById("fiscalia").disabled = false;
            document.getElementById("perito").disabled = false;
        }
    }, 
    500);
</script>

<?php
        sqlsrv_close($conn);
    }
?>