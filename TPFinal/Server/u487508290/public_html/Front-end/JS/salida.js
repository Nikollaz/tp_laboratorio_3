$(document).ready(function() {
    
    (function() {
        
        $.ajax({
            type: "GET",
            url: SERVER + "/vehiculos",
            dataType: "text",
            crossDomain: true,
            headers: {
                'SessionToken' : localStorage.getItem("SessionToken")
            },
            beforeSend: function() {

                $("#carga").html(LOADING_GIF);

            },
            success: function(response) {

                response = JSON.parse(response);
                
                if(response.Estado === "Error"){

                    alert(response.Mensaje);
                    
                    $("#carga").html("");

                } else {

                    $("#carga").html("");

                    $.each(response, function(key, value) 
                    {
                        if(value.EmpleadoSalida === null){
                            $("#patente").append("<option>"+value.patente+"</option>");
                        }
                        
                    });

                }

            }
        });

    })();

    $("#salidaVehiculo").click(function(event){
        
    	event.preventDefault();

    	$("#patente").css("border-color", "");

    	if
    		(	
    			$("#patente").val() === ""
    		)
    	{
    		alert("Todos los campos son obligatorios");

    		if( $("#patente").val() === "" ){
    			
    			$("#patente").css("border-color", "red");

    		}

    	} else {

    		var data =  "patente=" + $("#patente").val();

	        $.ajax({

	            type: "POST",
	            url: SERVER + "/vehiculos/salida",
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
	                    $("#infoExito").html(response.Mensaje + ". Importe a cobrar: " + response.Vehiculo[0].importe + "$");
	                    
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