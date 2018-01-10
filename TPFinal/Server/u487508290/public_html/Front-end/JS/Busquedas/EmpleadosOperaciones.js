$(document).ready(function() {
    
    function toHHMMSS(a) {
        var sec_num = parseInt(a, 10); // don't forget the second param
        var hours   = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);
        
        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        return hours+':'+minutes+':'+seconds;
    }
    
    function cargarTablaVehiculos(operaciones){
        
        if ( $.fn.dataTable.isDataTable( '#tablaOperaciones' ) ) {
            var table = $('#tablaOperaciones').DataTable();
            table.destroy();
        }
        
        $("#OperacionesEmpleados").html("");
        
        /*
            Cargar de contenido por values
        */
        
        var counter = 0;

        $.each(operaciones, function(empleado, cantidad) {
 
             $("#OperacionesEmpleados").append("<tr id='OperacionesEmpleadosRow"+counter.toString()+"'>");

             $("#OperacionesEmpleadosRow"+counter.toString()).append("<td>" + empleado + "</td>");
             $("#OperacionesEmpleadosRow"+counter.toString()).append("<td>" + cantidad + "</td>");
   
            $("#OperacionesEmpleados").append("</tr>");
            
            counter++;

        });
        
        $("#tablaOperaciones").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
        });

    }
    
    function cargarVehiculos(desde, hasta) {
        
    	var data = "filtro=operaciones" + "&" +
    	    "fechaInicio=" + desde + "&" +
     		"fechaFin=" + hasta;
        
        $.ajax({
            type: "POST",
            url: SERVER + "/empleados/busqueda",
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
                    
                    cargarTablaVehiculos(response);
                    cargarGrafico(response);

                }
            }
        });
    }

    cargarVehiculos("","");

    $("#btnFiltrar").click(function(){
            
        cargarVehiculos($("#fechaInicio").val(),$("#fechaFin").val());
        
    });
    
    function cargarGrafico(data){
        
        $("#chartContainer").html("");
        
        //Better to construct options first and then pass it as a parameter
        
        var dataPointsCantidades = [];
        
        $.each(data, function(empleado, cantidad) {
 
            dataPointsCantidades.push({
                y: cantidad,
                label: empleado
            });

        });

        var options = {
        	exportEnabled: true,
        	animationEnabled: true,
        	indexLabel: "{label} {y}",
        	title: {
        		text: "Operaciones por empleado"
        	},
        	data: [
            	{
            		type: "pie", //change it to splineArea, line, area, bar, pie, etc
            		dataPoints: dataPointsCantidades
            	}
        	]
        };
        
        $("#chartContainer").CanvasJSChart(options);
        
    }

    
});