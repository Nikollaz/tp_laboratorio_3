$(document).ready(function() {

    $("#altaVehiculo").click(function(event){
        
    	event.preventDefault();

    	$("#patente").css("border-color", "");
        $("#color").css("border-color", "");
        $("#marca").css("border-color", "");
		$("#foto").css("border-color", "");
    	$("#emailEmpleadoIngreso").css("border-color", "");
    	$("#horaDeEntrada").css("border-color", "");
    	$("#cochera").css("border-color", "");
    	$("#emailEmpleadoSalida").css("border-color", "");
    	$("#horaDeSalida").css("border-color", "");
    	$("#importe").css("border-color", "");
    	$("#tiempo_seg").css("border-color", "");

    	if
    		(	
    			$("#patente").val() === "" ||
    			$("#color").val() === "" ||
    			$("#marca").val() === "" ||
    			$("#foto").val() === "" ||
    			$("#emailEmpleadoIngreso").val() === "" ||
    			$("#horaDeEntrada").val() === "" ||
    			$("#cochera").val() === "" ||
    			$("#emailEmpleadoSalida").val() === "" ||
    			$("#horaDeSalida").val() === "" ||
    			$("#importe").val() === "" ||
    			$("#tiempo_seg").val() === ""
    		)
    	{
    		alert("Todos los campos son obligatorios");

    		if( $("#patente").val() === "" ){
    			
    			$("#patente").css("border-color", "red");

    		}
    		if( $("#color").val() === "" ){
    			
    			$("#color").css("border-color", "red");

    		}
    		if( $("#marca").val() === "" ){
    			
    			$("#marca").css("border-color", "red");

    		}
    		if( $("#foto").val() === "" ){
    			
    			$("#foto").css("border-color", "red");

    		}
    		if( $("#emailEmpleadoIngreso").val() === "" ){
    			
    			$("#emailEmpleadoIngreso").css("border-color", "red");

    		}
    		if( $("#horaDeEntrada").val() === "" ){
    			
    			$("#horaDeEntrada").css("border-color", "red");

    		}
    		if( $("#cochera").val() === "" ){
    			
    			$("#cochera").css("border-color", "red");

    		}
    		if( $("#emailEmpleadoSalida").val() === "" ){
    			
    			$("#emailEmpleadoSalida").css("border-color", "red");

    		}
    		if( $("#horaDeSalida").val() === "" ){
    			
    			$("#horaDeSalida").css("border-color", "red");

    		}
    		if( $("#importe").val() === "" ){
    			
    			$("#importe").css("border-color", "red");

    		}
    		if( $("#tiempo_seg").val() === "" ){
    			
    			$("#tiempo_seg").css("border-color", "red");

    		}

    	} else {

    		var data =  "patente=" + $("#patente").val() + "&" +
     					"color=" + $("#color").val() + "&" +
     					"marca=" + $("#marca").val() + "&" +
     					"foto=" + $("#foto").val() + "&" +
     					"emailEmpleadoIngreso=" + $("#emailEmpleadoIngreso").val() + "&" +
     					"horaDeEntrada=" + $("#horaDeEntrada").val() + "&" +
     					"cochera=" + $("#cochera").val() + "&" +
     					"emailEmpleadoSalida=" + $("#emailEmpleadoSalida").val() + "&" +
     					"horaDeSalida=" + $("#horaDeSalida").val() + "&" +
     					"importe=" + $("#importe").val() + "&" +
     					"tiempo_seg=" + $("#tiempo_seg").val();

	        $.ajax({

	            type: "POST",
	            url: SERVER + "/vehiculos",
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