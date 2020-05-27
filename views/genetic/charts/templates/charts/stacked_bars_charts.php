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

	console.log('x1', x1);
	console.log('y1', y1);

	var trace1 = {
		x: x1,
		y: y1,
		name: 'SF Zoo',
		type: 'bar',
		text: y1.map(String),
		textposition: 'auto',
		font: {
			family: 'Arial',
			size: 10
		},
		marker: {color: '#152F4A'},
	};

	var data2 = [trace1];

	var layout = {barmode: 'group', height: 600};

	Plotly.newPlot('bars-plot', data2, layout);


	$('.modebar').removeClass('modebar--hover');
	$('.modebar').removeClass(' ease-bg');

</script>
