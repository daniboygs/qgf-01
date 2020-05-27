$(document).ready(function(){ 
	
	$('#chemistry_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/chemistry/records/search_records_form.php');
		$('#chemistry_record').addClass('active-nav');
		return false;
	});
		
	$('#new_chemistry_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/chemistry/records/create_record_form.php');
		$('#new_chemistry_record').addClass('active-nav');
		return false;
	});

	$('#chart_chemistry_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/chemistry/charts/search_chart_form.php');
		$('#chart_chemistry_record').addClass('active-nav');
		return false;
	});

	$('#genetic_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/genetic/records/search_records.php');
		$('#genetic_record').addClass('active-nav');
		return false;
	});
		
	$('#new_genetic_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/genetic/records/create_record.php');
		$('#new_genetic_record').addClass('active-nav');
		return false;
	});

	$('#chart_genetic_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/genetic/charts/search_chart.php');
		$('#chart_genetic_record').addClass('active-nav');
		return false;
	});

	$('#authority_crud').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/catalogs/authority/create_authority_form.php');
		$('#authority_crud').addClass('active-nav');
		return false;
	});

	$('#object_crud').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/catalogs/object/create_object_form.php');
		$('#object_crud').addClass('active-nav');
		return false;
	});

	$('#update_chemistry_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/chemistry/records/update_record.php');
		$('#update_chemistry_record').addClass('active-nav');
		return false;
	});

	$('#update_genetic_record').on('click', function() {
		$('.loader-div').addClass('loader');
		$('.nav-link').removeClass('active-nav');
		$("#container").load('../views/genetic/records/update_record.php');
		$('#update_genetic_record').addClass('active-nav');
		return false;
	});
	
});