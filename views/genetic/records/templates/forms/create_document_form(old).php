<script src="../views/genetic/records/js/function.js"></script>
<link href="../views/genetic/records/styles/styles.css" rel="stylesheet">  

<script>
    var record_id = <?php echo json_encode($record_id); ?>;
</script>

<hr>

<form action="" class="form-group" id="create_document_form">

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

        <div class="form-group col-md-4">
            <label for="">Documento emitido: </label>
            <select class="form-control" id="emited-document" preholder="Documento emitido" required>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div> 

        <div class="form-group col-md-4">
            <label for="">Numero de indicios: </label>
            <input type="number" value="0" class="form-control" id="indication" min="0" name="quantity" required>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
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
            <input type="text" class="form-control" id="observation" placeholder="Observaciones" maxlength="250" required>
        </div>

    </div>

    <br>

        <div class="button-form">
            <button type="button" class="btn btn-outline-warning" id="update-document-btn" style="display: none;" onclick="updateDocumentBtn()">Modificar</button>
        </div>

        <div class="button-form" style="display: inline-flex">
            <button type="button" class="btn btn-outline-danger" style="margin-right: 10px; display: none;" id="cancel-update-document-btn" onclick="cancelUpdateDocumentBtn()">Cancelar</button>
            <button type="button" class="btn btn-outline-primary" id="save-update-document-btn" style="display: none;" onclick="saveUpdateDocumentBtn()">Guardar</button>
        </div>

        <div class="button-form">
            <button type="button" class="btn btn-outline-danger" style="margin-right: 10px" id="cancel-document-btn">Cancelar</button>
            <button type="submit" class="btn btn-outline-primary" id="save-document-btn">Guardar</button>
        </div>

    <br>

</form>