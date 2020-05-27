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


<div class='bars-plot' id='bars-plot'></div>


<script>
    
	x1 = create_array('<?php echo $_POST['x1'] ?>');
	y1 = create_array('<?php echo $_POST['y1'] ?>');

	x2 = create_array('<?php echo $_POST['x2'] ?>');
	y2 = create_array('<?php echo $_POST['y2'] ?>');

	var trace1 = {
		x: x1,
		y: y1,
		name: 'Expedientes',
		type: 'bar',
		text: y1.map(String),
		textposition: 'auto',
		marker: {color: '#152F4A'},
	};

	var trace2 = {
		x: x2,
		y: y2,
		name: 'Estudios',
		type: 'bar',
		text: y2.map(String),
		textposition: 'auto',
		marker: {color: '#C09F77'},
	};


	var data2 = [trace1, trace2];

	var layout = {barmode: 'group'};

	Plotly.newPlot('bars-plot', data2, layout);

	$('.modebar').removeClass('modebar--hover');
	$('.modebar').removeClass(' ease-bg');

</script>
