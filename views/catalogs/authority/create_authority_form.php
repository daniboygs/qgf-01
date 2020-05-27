<?php 
    session_start();
    if(isset($_SESSION['username'])){ 
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $area = $_SESSION['area'];
        $fiscalia = $_SESSION['fiscalia'];
        $uid = $_SESSION['uid'];

        include('../../../service/connection.php');
        include("env/env.php");
  
?>

<script src="<?php echo $url; ?>/js/<?php echo $js; ?>"></script>
<link href="<?php echo $url; ?>/styles/<?php echo $css; ?>" rel="stylesheet">  
     

<form action="" class="form-group" id="create_authority_form">

    <div class="page-header">
        <h1 class="title" id="titulo" >NUEVA AUTORIDAD SOLICITANTE</h1>
    </div>
    <br>

    <hr>

            
    <div class="form-row">

            
        <div class="form-group col-md-8">
            <label for="">Nombre de autoridad solicitante: </label>
            <input type="text" class="form-control" id="authority" name="authority" preholder="Autoridad solicitante" maxlength="100" required>
        </div>

        <div class="form-group col-md-4">
            <label for="">Fiscalía: </label>
            <select class="form-control" id="fiscalia" preholder="Fiscalía" required>
                
                <?php
                include("service/get_fiscalias.php");
                while($row = sqlsrv_fetch_array($fiscalias)){

                    if($area == 0 && $fiscalia == 0){
                        ?> 
                        <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                    
                        <?php
                    }
                    else if($area == 0 && $fiscalia == $row[0]){
                        ?> 
                        <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                    
                        <?php
                    }
                
                }
                ?>
            </select>
        </div>  


    </div>
        
    <br>

    <div class="button-form">
        <button type="button" class="btn btn-outline-danger" style="margin-right: 10px" id="cancel-authority-btn">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary" id="save-authority-btn">Guardar</button>
    </div>
    
    <br>

</form>

<?php
    sqlsrv_close($conn);
    }
    else{
        echo "<script> document.location.href='../index.php';</script>"; 
    }  
?>

 