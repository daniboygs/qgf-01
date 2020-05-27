<?php
    $record_id = $_POST['record_id'];
    $documentDocumentType = $_POST['document_type'];
    $documentEmitedDocument = $_POST['emited_document'];
    $documentIndication = $_POST['indication'];
    $documentArea = $_POST['area'];
    $documentResult = $_POST['result'];
    $documentObservation = $_POST['observation'];
    $documentSP = $_POST['sp'];
?>

<hr>

<form id="update_document_form">

    <div class="page-header">
        <h1 class="title" style="background-color: #7C8B9E;"> DOCUMENTO</h1>
    </div>

    <hr>  

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
            <input type="number" value="0" class="form-control" id="indication" min="0" name="quantity" required>
        </div>

        <div class="form-group col-md-2">
            <label for="">SP: </label>
            <input type="number" value="0" class="form-control" id="sp" min="0" name="quantity" required>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-6" id="area-form-group">
            <label for="">Area: </label>
            <select class="form-control" id="area" preholder="Area" required>
                <option value="Identificación humana">Identificación humana</option>
                <option value="Investigación criminal">Investigación criminal</option>
            </select>
        </div> 

        <div class="form-group col-md-6">
            <label for="" id="result-label">Resultado: </label>
            <select class="form-control" id="result" preholder="Resultado" required>
                <option value="Positivo">Positivo</option>
                <option value="Negativo">Negativo</option>
            </select>
        </div> 

    </div>

    <div class="form-row">
        
        <div class="form-group col-md-12">
            <label for="">Observaciones: </label>
            <input type="text" value="<?php echo $documentObservation ?>" class="form-control" id="observation" placeholder="Observaciones" maxlength="250" required>
        </div>

    </div>

    <br>


        <div class="button-form">
            <button type="button" class="btn btn-outline-primary" onclick="updateDocument(<?php echo $record_id; ?>, 'update')">Guardar</button>
        </div>

    <br>

</form>


<script>
    document.getElementById("document-type").value = ('<?php echo $documentDocumentType ?>');
    document.getElementById("emited-document").value = ('<?php echo $documentEmitedDocument ?>');
    document.getElementById("indication").value = ('<?php echo $documentIndication ?>');
    document.getElementById("area").value = ('<?php echo $documentArea ?>');
    document.getElementById("result").value = ('<?php echo $documentResult ?>');
    document.getElementById("sp").value = ('<?php echo $documentSP ?>');
    showInputsByReport();
</script>


