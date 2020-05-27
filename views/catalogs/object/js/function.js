$(document).ready(function() {
    $('.loader-div').removeClass('loader');
  
      jQuery('#create_object_form').submit(create_object);
  
      
    function create_object(){
		showLoading(true);
		object=$("#object").val();  
		fiscalia=$("#fiscalia").val();

		$.ajax({  
			type: 	"POST",  
			url: 	"../views/catalogs/object/service/create_object.php",  
			data:   "variant="+object
		}).done(function(response){
			
			blurt({'title' : 'Correcto', 'text' : 'Objeto agregado correctamente', 'type' : 'success'});

			showLoading(false);

			document.getElementById("create_object_form").reset();
		});
			
			return false;
		}

		$("#cancel-object-btn").click(function(){ 
		document.getElementById("create_object_form").reset();
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

  
  
  
  
  
  