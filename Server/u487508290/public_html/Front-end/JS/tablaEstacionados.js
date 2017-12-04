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
                console.log(response);
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

                    cargarVehiculos(filtrarEstacionados(response));

                }

            }
        });

    })();

    function filtrarEstacionados(vehiculos){

        var vehiculosEstacionados = vehiculos.filter(function(a){

            return a.EmpleadoSalida === null;

        }).map(function(a){

            var nuevoVehiculo = {};
            nuevoVehiculo.id = a.id;
            nuevoVehiculo.patente = a.patente;
            nuevoVehiculo.Color = a.Color;
            nuevoVehiculo.Marca = a.Marca;
            nuevoVehiculo.Foto = a.Foto;
            nuevoVehiculo.EmpleadoIngreso = a.EmpleadoIngreso;
            nuevoVehiculo.HoraDeEntrada = a.HoraDeEntrada;
            nuevoVehiculo.Cochera = a.Cochera;

            return nuevoVehiculo;

        });

        return vehiculosEstacionados;

    }

});