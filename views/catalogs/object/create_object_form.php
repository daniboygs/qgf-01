<?php 
    session_start();
    if(isset($_SESSION['username'])){ 
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $area = $_SESSION['area'];
        $fiscalia = $_SESSION['fiscalia'];
        $uid = $_SESSION['uid'];

        include("env/env.php");
?>

<script src="<?php echo $url; ?>/js/<?php echo $js; ?>"></script>
<link href="<?php echo $url; ?>/styles/<?php echo $css; ?>" rel="stylesheet">  
     

<form action="" class="form-group" id="create_object_form">

    <div class="page-header">
        <h1 class="title" id="titulo" >NUEVO OBJETO</h1>
    </div>

    <hr>

            
    <div class="form-row">
            
        <div class="form-group col-md-12">
            <label for="">Objeto a agregar: </label>
            <input type="text" class="form-control" id="object" name="object" preholder="Autoridad solicitante" maxlength="100" required>
        </div>

    </div>
        
    <br>

    <div class="button-form">
        <button type="button" class="btn btn-outline-danger" style="margin-right: 10px" id="cancel-object-btn">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary" id="save-object-btn">Guardar</button>
    </div>
    
    <br>

</form>

<?php
    }
    else{
        echo "<script> document.location.href='../index.php';</script>"; 
    }     
?>

 