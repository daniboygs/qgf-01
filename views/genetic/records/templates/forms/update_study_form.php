
<?php
    include('../../../../../service/connection.php');
    $record_id = $_POST['record_id'];
?>

<script>
    document.getElementById("study").selectedIndex = -1;
    var record_id = (<?php echo $record_id ?>);
</script>


<hr>

<form action="" class="form-group" id="update_study_form">

    <div class="page-header">
        <h1 class="title" style="background-color: #7C8B9E;"> ESTUDIOS</h1>
    </div>

    <hr>

    <div class="form-row">
        
        <div class="form-group col-md-9">
            <label for="">Descripción: </label>
            <input type="text" class="form-control" id="description" placeholder="Descripción" maxlength="100">
        </div>

        <div class="form-group col-md-3">
            <label for="">Persona: </label>
            <select class="form-control" id="person" preholder="Persona" required>
                <option value="Víctima">Víctima</option>
                <option value="Imputado">Imputado</option>
                <option value="Referencia">Referencia</option>
                <option value="Cadáver Masculino">Cadáver Masculino</option>
                <option value="Cadáver Femenino">Cadáver Femenino</option>
            </select>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="">Estudio: </label>
            <select class="form-control" id="study" required>
                
                <?php
                include("../../service/get_study_types.php");
                while($row = sqlsrv_fetch_array($studies)){
                ?> 
                <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                            
                <?php
                }
                ?>
            </select>
        </div>  

    </div>

    <div class="form-row">

        <div class="form-group col-md-12" id="catalog-description"></div>

    </div>

    <div class="form-row">

        <!--<div id="sample-form-group" class="form-group col-md-9">
            <label for="">Tipo de muestra: </label>
            <select class="form-control" id="sample" required onchange="setVariantInput()">-->
                
            <?php
                /*include("service/get_sample_types.php");
                while($row = sqlsrv_fetch_array($samples)){*/
                ?> 
                <!--<option value="<?php /*echo $row[0]*/?>"><?php /*echo $row[1]*/?></option>-->
                            
                <?php
                /*}*/
                ?>
            <!--</select>
        </div>-->

        <div id="sample-form-group" class="form-group col-md-12">
        <?php
            include("../../service/get_multiple_sample_types.php");
        ?> 
        </div> 

    </div>

    <div id="variants-section"></div>

    <br>

    <script>
        setTimeout(function(){ 
            document.getElementById("study").selectedIndex = 0;
            document.getElementById("add-study-btn").style.display = "block";
        }, 
        1000);
    </script>
    <div class="button-form">
        <!--<button type="button" class="btn btn-danger" style="margin-right: 10px" id="cancel-study-btn">Cancelar</button>-->
        <button type="button" class="btn btn-outline-primary" onclick="createStudy(<?php echo $record_id; ?>, 'update')" id="add-study-btn" style="display: none;">Agregar estudio</button>
    </div>

</form>  

<br>
<br>

<div class="modal fade" id="show-variants-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Variantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="show-variants-modal-content">
        No se han agregado variantes
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php
    sqlsrv_close($conn);
?>

