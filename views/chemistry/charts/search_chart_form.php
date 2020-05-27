<script src="../views/chemistry/charts/js/function.js"></script>
<link href="../views/chemistry/charts/styles/styles.css" rel="stylesheet">  

<script>
    document.getElementById("fiscalia").selectedIndex = 0;

    document.getElementById("start_date").valueAsDate = new Date();

    document.getElementById("finish_date").valueAsDate = new Date();

    document.getElementById("chart-type").style.display = "none";

    document.getElementById("chart-table-selector").style.display = "none";
</script>        

<div class="page-header">
    <h1 class="title" id="titulo" >GRÁFICAS</h1>
</div>
<br>

<hr>

<form action="" id="search_chart_form">

<!--
<div class="btn-group btn-group-toggle" data-toggle="buttons" style="float:right; width:100%;">
  <label class="btn btn-secondary btn-secondary" id="adminAct_todas">
    <input type="checkbox" name="options" id="all-check" autocomplete="off"> Todo
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="januarycheck" autocomplete="off"> Enero
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="februarycheck" autocomplete="off"> Febrero
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="marchcheck" autocomplete="off"> Marzo
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="aprilcheck" autocomplete="off"> Abril
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="maycheck" autocomplete="off"> Mayo
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="juncheck" autocomplete="off"> Junio
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="julycheck" autocomplete="off"> Julio
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="augustcheck" autocomplete="off"> Agosto
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="septembercheck" autocomplete="off"> Septiembre
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="octobercheck" autocomplete="off"> Octubre
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="novembercheck" autocomplete="off"> Noviembre
  </label>
  <label class="btn btn-secondary btn-info" id="adminAct_sinAtender">
    <input type="checkbox" name="options" id="decembercheck" autocomplete="off"> Diciembre
  </label>
</div>
-->
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
    <!--<button type="button" class="btn btn-danger" style="margin-right: 10px" id="record_cancel_btn">Cancelar</button>-->
    <button type="submit" class="btn btn-outline-primary" id="search_records">Buscar</button>
</div>
<br>

</form>

<br>

<hr>

<div class="row">

    <div class="form-group col-md-6" id="chart-type">
        <label for="">Tipo de gráfica: </label>   
        <select class="form-control" id="chart-selector" preholder="Gráfica" required>

            <option value="0">Cantidad de expedientes y estudios por mes</option>
            <option value="1">Cantidad de estudios por tipo</option>
            <option value="2">Cantidad de expedientes por mes</option>
            <option value="3">Cantidad de expedientes y estudios por región</option>
            <option value="4">Cantidad de estudios de drogas por delito</option>
            <option value="5">Cantidad de detalle por estudio</option>
            
        </select>
    </div>  

    <div class="col-md-6" id="chart-table-selector" style="padding-top: 30px; padding-bottom: 30px;">

      <div class="btn-group btn-group-toggle" data-toggle="buttons" style="float: right;" onchange="changeSelector()">
        <label class="btn btn-outline-primary active">
          <input type="radio" name="options" id="chart-option" autocomplete="off"> Gráfica
        </label>
        <label class="btn btn-outline-primary">
          <input type="radio" name="options" id="table-option" autocomplete="off"> Tabla
        </label>
      </div>

    </div>  


</div>

<div class='chart-container' id='chart-container'></div>

<div class='table-container' id='table-container' style="display: none;"></div>