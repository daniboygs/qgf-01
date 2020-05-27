$(document).ready(function(){ 
    
    jQuery('#login-form').submit(login);
    
    function login(){
        username=$("#user").val();  
        password=$("#pass").val(); 
	   
        $.ajax({  
            type: "POST",  
            url: "service/login.php",  
            data: "user="+username+"&pass="+password  
        }).done(function(response){

             var content = JSON.parse(response);
             
             var state = content.state;

            if(!state.localeCompare("ok")){
                $('.loader-div').addClass('loader');
                window.location = 'main/index.php';
            }
            else{
                blurt({'title' : 'Usuario incorrecto', 'text' : 'Usuario o contraseña incorrecto', 'type' : 'error'});
            }
			
		});  
        
        return false;
    }
	
});