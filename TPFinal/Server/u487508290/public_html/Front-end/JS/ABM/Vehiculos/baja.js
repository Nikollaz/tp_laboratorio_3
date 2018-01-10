$(document).ready(function() {

    $("#bajaVehiculo").click(function(event){
        
    	event.preventDefault();

        $("#id").css("border-color", "");

    	if
    		(	
    		    $("#id").val() === ""
    		)
    	{
    		alert("Todos los campos son obligatorios");

    		if( $("#id").val() === "" ){
    			
    			$("#id").css("border-color", "red");

    		}

    	} else {

    		var data =  "id=" + $("#id").val();

	        $.ajax({

	            type: "DELETE",
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