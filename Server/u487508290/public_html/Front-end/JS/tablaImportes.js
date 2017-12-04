$(document).ready(function() {

    function cargarVehiculos(vehiculos){

        $("#tablaVehiculosHeader").html("");
        $("#tablaVehiculosBody").html("");

        /*
            Cargar de headers por keys
        */
        $("#tablaVehiculosHeader").append("<tr id='tablaVehiculosHeaderKeys'>");

        $.each(vehiculos[0], function(key, persona) {
            
            $("#tablaVehiculosHeaderKeys").append("<th>" + key + "</th>");

        });

        $("#tablaVehiculosHeader").append("</tr>");

        /*
            Cargar de contenido por values
        */

        var counter = 0;

        $.each(vehiculos, function(key, persona) {

            $("#tablaVehiculosBody").append("<tr id='tablaVehiculosBodyRow"+counter.toString()+"'>");

            $.each(persona, function(key, value) {
                
                if(key === "importe")
                    $("#tablaVehiculosBodyRow"+counter.toString()).append("<td>" + value + "$ </td>");
                else
                    $("#tablaVehiculosBodyRow"+counter.toString()).append("<td>" + value + "</td>");

            });

            counter++;

            $("#tablaVehiculosBody").append("</tr>");
        });

    }
    
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

                    $("#tablaVehiculos").html
                    (
                        "<div class='alert alert-danger'>" +
                            response.Mensaje +
                        "</div>"
                    );
                    
                    $("#carga").html("");

                } else {

                    $("#carga").html("");
                    
                    vehiculos = response;

                    cargarVehiculos(filtrarNoEstacionados(response));

                }

            }
        });

    })();

    function filtrarNoEstacionados(vehiculos){

        var vehiculosNoEstacionados = vehiculos.filter(function(a){

            return a.EmpleadoSalida !== null;

        });

        return vehiculosNoEstacionados;

    }

});