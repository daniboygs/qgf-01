     
<?php
    include('../../../service/connection.php');
?>

<div class="page-header">
    <h1 class="title" id="titulo" >GRÁFICAS GENÉTICA FORENSE</h1>
</div>

<hr>

<form action="" id="search_chart_form">

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


<div class="row">

    <div class="form-group col-md-6" id="chart-type">

        <label for="">Tipo de gráfica: </label>   
        <select class="form-control" id="chart-selector" preholder="Gráfica" required>

            <option value="0">Cantidad de expedientes y estudios por mes</option>
            <option value="1">Cantidad de estudios por tipo</option>
            <option value="2">Cantidad de expedientes por mes</option>
            <option value="3">Cantidad de expedientes y estudios por región</option>
            
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

<script>
    document.getElementById("fiscalia").selectedIndex = 0;

    document.getElementById("start_date").valueAsDate = new Date();

    document.getElementById("finish_date").valueAsDate = new Date();

    document.getElementById("chart-type").style.display = "none";

    document.getElementById("chart-table-selector").style.display = "none";
</script>   

<?php
    sqlsrv_close($conn);
?>