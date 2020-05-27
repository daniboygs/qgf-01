<?php
    include('../../../service/connection.php');
?>

<form action="" id="search_records_form">

    <div class="page-header">
        <h1 class="title" id="titulo">CONSULTA EXPEDIENTES GENÉTICA FORENSE</h1>
    </div>

    <hr>

    <div class="form-row">
    
        <div class="form-group col-md-4">
            <label for="">Fiscalía: </label>
            <select class="form-control" id="fiscalia" preholder="Fiscalía" required>

                <option value="0">--Todas las fiscalías--</option>
                
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

        <div class="form-group col-md-4">
            <label for="">Fecha inicio: </label>
            <input class="form-control" type="date" id="start_date" name="start_date" require>
        </div>

        <div class="form-group col-md-4">
            <label for="">Fecha fin: </label>
            <input class="form-control" type="date" id="finish_date" name="finish_date" require>
        </div>


    </div>


    <br>

    <div class="button-form">
        <button type="submit" class="btn btn-outline-primary" id="search_records">Buscar</button>
    </div>

    <br>

</form>
<br>

<hr>

<div id="cont-table-rows"></div>
<div id="record-table"></div>

<script>
    document.getElementById("fiscalia").selectedIndex = 0;

    document.getElementById("start_date").valueAsDate = new Date();

    document.getElementById("finish_date").valueAsDate = new Date();
</script> 

<?php
    sqlsrv_close($conn);
?>
 