$(document).ready(function() {

    $('.loader-div').removeClass('loader');
  
	jQuery('#create_authority_form').submit(create_authority);

	function create_authority(){

		showLoading(true);

		authority=$("#authority").val();  
		fiscalia=$("#fiscalia").val();

		$.ajax({  
			type: "POST",  
			url: "../views/catalogs/authority/service/create_authority.php",  
			data:   "authority="+authority.toUpperCase()+
					"&fiscalia="+fiscalia
		}).done(function(response){

			blurt({'title' : 'Correcto', 'text' : 'Autoridad agregada correctamente', 'type' : 'success'});

			showLoading(false);

			document.getElementById("create_authority_form").reset();
		});
			
			return false;
	}


	$("#cancel-authority-btn").click(function(){ 
		document.getElementById("create_authority_form").reset();
	});
      
  
});
  
function showLoading(ind){
	if(ind){
		$(".loader-div").addClass("loader");
	}
	else{
		$(".loader-div").removeClass("loader");
	}
}

  
  
  
  
  
  