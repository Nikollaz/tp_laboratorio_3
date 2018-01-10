$(document).ready(function() {

    $("#altaEmpleado").click(function(event){
        
    	event.preventDefault();

    	$("#email").css("border-color", "");
        $("#password").css("border-color", "");
        $("#turno").css("border-color", "");
		$("#sexo").css("border-color", "");
    	$("#perfil").css("border-color", "");
    	$("#id").css("border-color", "");

    	if
    		(	
    			$("#email").val() === "" ||
    			$("#password").val() === "" ||
    			$("#turno").val() === "" ||
    			$("#sexo").val() === "" ||
    			$("#perfil").val() === "" ||
    			$("#id").val() === ""
    		)
    	{
    		alert("Todos los campos son obligatorios");

    		if( $("#email").val() === "" ){
    			
    			$("#email").css("border-color", "red");

    		}
    		if( $("#password").val() === "" ){
    			
    			$("#password").css("border-color", "red");

    		}
    		if( $("#turno").val() === "" ){
    			
    			$("#turno").css("border-color", "red");

    		}
    		if( $("#sexo").val() === "" ){
    			
    			$("#sexo").css("border-color", "red");

    		}
    		if( $("#perfil").val() === "" ){
    			
    			$("#perfil").css("border-color", "red");

    		}
    		if( $("#id").val() === "" ){
    			
    			$("#id").css("border-color", "red");

    		}

    	} else {

    		var data =  "email=" + $("#email").val() + "&" +
     					"password=" + $("#password").val() + "&" +
     					"turno=" + $("#turno").val() + "&" +
     					"sexo=" + $("#sexo").val() + "&" +
     					"id=" + $("#id").val() + "&" +
     					"perfil=" + $("#perfil").val();

	        $.ajax({

	            type: "PUT",
	            url: SERVER + "/empleados",
	            dataType: "text",
	            data: data,
	            crossDomain: true,
	            headers: {

			        'SessionToken' : localStorage.getItem("SessionToken")

			   	},
	            beforeSend: function() {

	                $("#carga").html(LOADING_GIF);

	            },
	            success: function(response) {

	                response = JSON.parse(response);
	                
	                $("#infoExito").css("display", "none");
	                $("#infoError").css("display", "none");
	                $("#infoExito").html("");
	                $("#infoError").html("");
	                
	                if(response.Estado === "Ok"){

	                	$("#carga").html("");

	                    $("#infoExito").css("display", "inherit");
                        $("#infoExito").html(response.Mensaje);
	                    
	                } else {

	                    $("#carga").html("");

	                    $("#infoError").css("display", "inherit");
                        $("#infoError").html(response.Mensaje);

	                }	                

	            }

	        });
	                 
    	}

    });

});