<script src="../views/chemistry/records/js/function.js"></script>
<link href="../views/chemistry/records/styles/styles.css" rel="stylesheet">  

<?php
session_start();
include ('../../../service/connection.php');

$record_id = $_POST['record_id'];

?>

<script>
    document.getElementById("study").selectedIndex = -1;
    var record_id = (<?php echo $record_id ?>);
</script>



<form action="" class="form-group" id="create_study_form">

    <div class="page-header">
        <h1 class="title" style="background-color: #7C8B9E;"> ESTUDIOS</h1>
    </div>
    <br>

    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="">Descripción: </label>
            <input type="text" class="form-control record-input" id="description" placeholder="Descripción" maxlength="100" required>
        </div>

        <!--
            <div class="form-group col-md-3">
            <label for="">Persona: </label>
            <select class="form-control" id="person" preholder="Persona" required>
                <option value="Víctima">Víctima</option>
                <option value="Imputado">Imputado</option>
                <option value="Pariente">Pariente</option>
                <option value="n/a">n/a</option>
            </select>
        </div>
        -->

    </div>

    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="">Tipo de documento emitido: </label>
            <select class="form-control" id="document-type" preholder="Tipo documento" required onchange="showInputsByReport()">
                <option value="Dictamen">Dictámen</option>
                <option value="Informe">Informe</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">Documento emitido: </label>
            <select class="form-control" id="emited-document" preholder="Documento emitido" required>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div> 

        <div class="form-group col-md-3">
            <label for="">Numero de indicios: </label>
            <input type="number" class="form-control" id="indication" min="0" name="quantity" required>
        </div>

        <div class="form-group col-md-2">
            <label for="">SP: </label>
            <input type="number" value="0" class="form-control" id="sp" min="0" name="quantity" required>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="">Estudio: </label>
            <select class="form-control" id="study" required onchange="getCatalogsByStudy()">
                
                <?php
                include("service/get_study_types.php");
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


    <div class="form-row" id="result-catalog-detail-row">

        <div class="form-group col-md-3">
            <label for="">Resultado: </label>
            <select class="form-control" id="result" preholder="Resultado" required>
                <option value="Positivo">Positivo</option>
                <option value="Negativo">Negativo</option>
            </select>
        </div> 
        
        <div class="form-group col-md-9" id="catalog-detail"></div>

    </div>

    <br>
    <div class="button-form">
        <button type="submit" class="btn btn-outline-primary" id="add-study-btn">Agregar estudio</button>
    </div>
    <br>

</form> 
