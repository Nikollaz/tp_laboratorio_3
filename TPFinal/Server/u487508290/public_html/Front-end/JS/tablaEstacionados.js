$(document).ready(function() {
    
    function cargarVehiculos(vehiculos){
        
        if ( $.fn.dataTable.isDataTable( '#tablaEstacionados' ) ) {
            var table = $('#tablaEstacionados').DataTable();
            table.destroy();
        }

        $("#tablaVehiculosHeader").html("");
        $("#tablaVehiculosBody").html("");

        /*
            Cargar de headers por keys
        */
        $("#tablaVehiculosHeader").append("<tr id='tablaVehiculosHeaderKeys'>");

        $.each(vehiculos[0], function(key, persona) {
            
            if(key==="EmpleadoIngreso")
                $("#tablaVehiculosHeaderKeys").append("<th>Empleado Ingreso</th>");
            else if(key==="HoraDeEntrada")
                $("#tablaVehiculosHeaderKeys").append("<th>Hora de entrada</th>");
            else if(key==="id")
                $("#tablaVehiculosHeaderKeys").append("<th>ID</th>");
            else if(key==="patente")
                $("#tablaVehiculosHeaderKeys").append("<th>Patente</th>");
            else
                $("#tablaVehiculosHeaderKeys").append("<th>" + key + "</th>");

        });

        $("#tablaVehiculosHeader").append("</tr>");

        /*
            Cargar de contenido por values
        */

        var counter = 0;
        
        if(vehiculos.length===0)
        {
            $("#tablaVehiculosBody").append("<tr id='tablaVehiculosBodyRow'>");

                $("#tablaVehiculosBodyRow").append("<td>No hay vehiculos estacionados</td>");

            $("#tablaVehiculosBody").append("</tr>");
        }
        else 
        {
            $.each(vehiculos, function(key, persona) 
            {

                $("#tablaVehiculosBody").append("<tr id='tablaVehiculosBodyRow"+counter.toString()+"'>");
    
                $.each(persona, function(key, value) {
                    
                    $("#tablaVehiculosBodyRow"+counter.toString()).append("<td>" + value + "</td>");
    
                });
    
                counter++;
    
                $("#tablaVehiculosBody").append("</tr>");
                
            });
        }

        $("#tablaEstacionados").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
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