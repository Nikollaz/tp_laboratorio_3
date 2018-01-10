$(document).ready(function() {
    
    (function() {
        
        $.ajax({
            type: "GET",
            url: SERVER + "/cocheras",
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

                    $("#tablaVehiculos").html
                    (
                        "<div class='alert alert-danger'>" +
                            response.Mensaje +
                        "</div>"
                    );
                    $("#carga").html("");

                } else {

                    $("#carga").html("");
                    
                    $.each(response, function(key, value) 
                    {
                        if(value.ocupada === 0){
                            $("#cocheras").append("<option>"+value.nombre+"</option>");
                        }
                    });

                }

            }
        });

    })();

    $("#entradaVehiculo").click(function(event){
        
    	event.preventDefault();

    	$("#patente").css("border-color", "");
        $("#color").css("border-color", "");
        $("#marca").css("border-color", "");
		$("#cocheras").css("border-color", "");

    	if
    		(	
    			$("#patente").val() === "" ||
    			$("#color").val() === "" ||
    			$("#marca").val() === "" ||
    			$("#cocheras").val() === ""
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
    		if( $("#cocheras").val() === "" ){
    			
    			$("#cocheras").css("border-color", "red");

    		}

    	} else {
    	    
    	    var discapacitado = false;

            if($("#discapacitado").is(':checked')){
                discapacitado = true;
            } else {
                discapacitado = false;
            }

    		var data =  "patente=" + $("#patente").val() + "&" +
     					"color=" + $("#color").val() + "&" +
     					"marca=" + $("#marca").val() + "&" +
     					"cochera=" + $("#cocheras").val() + "&" +
     					"discapacitado=" + discapacitado.toString();

	        $.ajax({

	            type: "POST",
	            url: SERVER + "/vehiculos/entrada",
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