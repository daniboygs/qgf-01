<script type="text/javascript">

	function create_array(json) {
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}

</script>


<div class='line-chart' id='line-chart'></div>


<script>

	x1 = create_array('<?php echo $_POST['x1'] ?>');
	y1 = create_array('<?php echo $_POST['y1'] ?>');

	x2 = create_array('<?php echo $_POST['x2'] ?>');
	y2 = create_array('<?php echo $_POST['y2'] ?>');

	var trace1 = {
		x: x1,
		y: y1,
		name: 'Expedientes',
		type: 'scatter',
		marker: {color: '#152F4A'},
	};

	var trace2 = {
		x: x2,
		y: y2,
		name: 'Estudios',
		type: 'scatter',
		marker: {color: '#C09F77'},
	};

	var data = [trace1];

	Plotly.newPlot('line-chart', data);

	$('.modebar').removeClass('modebar--hover');
	$('.modebar').removeClass(' ease-bg');

</script>
