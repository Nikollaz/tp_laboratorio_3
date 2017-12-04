$(document).ready(function() {

    $("#entradaVehiculo").click(function(event){
        
    	event.preventDefault();

    	$("#patente").css("border-color", "");
        $("#color").css("border-color", "");
        $("#marca").css("border-color", "");
		$("#cochera").css("border-color", "");

    	if
    		(	
    			$("#patente").val() === "" ||
    			$("#color").val() === "" ||
    			$("#marca").val() === "" ||
    			$("#cochera").val() === ""
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
    		if( $("#cochera").val() === "" ){
    			
    			$("#cochera").css("border-color", "red");

    		}

    	} else {

    		var data =  "patente=" + $("#patente").val() + "&" +
     					"color=" + $("#color").val() + "&" +
     					"marca=" + $("#marca").val() + "&" +
     					"cochera=" + $("#cochera").val();

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