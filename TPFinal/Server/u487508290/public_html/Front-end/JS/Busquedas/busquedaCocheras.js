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
    
    function cargarTablaVehiculos(vehiculos){

        $("#MasUsadasBody").html("");
        $("#MenosUsadasBody").html("");
        $("#SinUsarBody").html("");
        
        $("#MasUsadasBody").append(
            "<tr>"+
                "<th>Cochera</th>"+
                "<th>Usos</th>"+
            "</tr>"
        );
        
        $("#MenosUsadasBody").append(
            "<tr>"+
                "<th>Cochera</th>"+
                "<th>Usos</th>"+
            "</tr>"
        );
        
        $("#SinUsarBody").append(
            "<tr>"+
                "<th>Cochera</th>"+
                "<th>Usos</th>"+
            "</tr>"
        );
        /*
            Cargar de contenido por values
        */

        $.each(vehiculos, function(key, cocheras) {

            if(key==="Mas usadas"){
                
                var counter = 0;

                $.each(cocheras, function(key, cochera) {
                    
                    $("#MasUsadasBody").append("<tr id='MasUsadasBodyRow"+counter.toString()+"'>");
                    
                    $.each(cochera, function(key, value) {

                            $("#MasUsadasBodyRow"+counter.toString()).append("<td>" + value + "</td>");
                            
                    });
                    
                    $("#MasUsadasBody").append("</tr>");
                    
                    counter++;
                   
                });
                
            }else if(key==="Menos usadas"){
                
                var counter2 = 0;

                $.each(cocheras, function(key, cochera) {
                    
                    $("#MenosUsadasBody").append("<tr id='MenosUsadasBodyRow"+counter2.toString()+"'>");
                    
                    $.each(cochera, function(key, value) {

                        $("#MenosUsadasBodyRow"+counter2.toString()).append("<td>" + value + "</td>");
                        
                    });
                    
                    $("#MenosUsadasBody").append("</tr>");
                    
                    counter2++;
                   
                });
                
            }else if(key==="Sin usar"){
                
                var counter3 = 0;

                $.each(cocheras, function(key, cochera) {
                    
                    $("#SinUsarBody").append("<tr id='SinUsarBodyRow"+counter3.toString()+"'>");
                    
                    $.each(cochera, function(key, value) {

                        $("#SinUsarBodyRow"+counter3.toString()).append("<td>" + value + "</td>");
                        
                    });
                    
                    $("#SinUsarBody").append("</tr>");
                    
                    counter3++;
                   
                });
                
            }

        });

    }
    
    function cargarVehiculos(desde, hasta) {
        
    	var data =  "fechaInicio=" + desde + "&" +
     		"fechaFin=" + hasta;
        
        $.ajax({
            type: "POST",
            url: SERVER + "/cocheras",
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
        
        $.each(data, function(key, value) {
            
            $.each(value, function(key, cocheras) {
                
                dataPointsCantidades.push({
                    y: cocheras.Usos,
                    label: cocheras.Cochera
                });

            });
 
        });

        var options = {
        	animationEnabled: true,
        	theme: "light2", // "light1", "light2", "dark1", "dark2"
        	title:{
        		text: "Estadisticas de las cocheras"
        	},
        	axisY: {
        		title: "Usos"
        	},
        	data: [{        
        		type: "column",  
        		showInLegend: true, 
        		legendMarkerColor: "grey",
				legendText: "Usos = utilizacion en las operaciones de entrada/salida",
        		dataPoints: dataPointsCantidades
        	}]
        	/*exportEnabled: true,
        	animationEnabled: true,
        	indexLabel: "{label} {y}",
        	title: {
        		text: "Estadisticas de las cocheras"
        	},
        	data: [
            	{
            		type: "pie", //change it to splineArea, line, area, bar, pie, etc
            		dataPoints: dataPointsCantidades
            	}
        	]*/
        };
        
        $("#chartContainer").CanvasJSChart(options);
        
    }

});