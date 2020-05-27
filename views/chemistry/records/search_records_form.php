<script src="../views/chemistry/records/js/function.js"></script>
<link href="../views/chemistry/records/styles/styles.css" rel="stylesheet">  

<script>
    document.getElementById("fiscalia").selectedIndex = 0;

    document.getElementById("start_date").valueAsDate = new Date();

    document.getElementById("finish_date").valueAsDate = new Date();
</script> 

<form action="" id="search_records_form">

<div class="page-header">
    <h1 class="title" id="titulo" >EXPEDIENTES</h1>
</div>
<br>

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

  <script>
      document.getElementById("fiscalia").selectedIndex = 0;
  </script>

  <div class="form-group col-md-4">
  <label for="">Fecha inicio: </label>
  <input class="form-control" type="date" id="start_date" name="start_date" require>
  </div>

  <div class="form-group col-md-4">
  <label for="">Fecha fin: </label>
  <input class="form-control" type="date" id="finish_date" name="finish_date" require>
  </div>

  <!--

  <br/>
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
        <div class="button-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Estudios<span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
    <ul class="dropdown-menu">
    <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>
    <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
    <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
    <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
    <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
    <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
    </ul>
    </div>
    </div>
    </div>
    </div>

        -->

</div>


<br>
<div class="button-form">
    <button type="submit" class="btn btn-outline-primary" id="search_records-btn">Buscar</button>
</div>
<br>

</form>
<br>

<hr>

<div id="cont-table-rows"></div>
<div id="record-table"></div>
