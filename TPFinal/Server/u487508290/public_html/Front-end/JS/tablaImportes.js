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
    
    function filtrarNoEstacionados(vehiculos){

        var vehiculosNoEstacionados = vehiculos.filter(function(a){
        
            return a.EmpleadoSalida !== null;
        
        });
        
        return vehiculosNoEstacionados;

    }

    function cargarTablaVehiculos(vehiculos){
        
        if ( $.fn.dataTable.isDataTable( '#tablaImportes' ) ) {
            var table = $('#tablaImportes').DataTable();
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
            else if(key==="EmpleadoSalida")
                $("#tablaVehiculosHeaderKeys").append("<th>Empleado Salida</th>");
            else if(key==="HoraDeSalida")
                $("#tablaVehiculosHeaderKeys").append("<th>Hora de salida</th>");
            else if(key==="importe")
                $("#tablaVehiculosHeaderKeys").append("<th>Importe</th>");
            else if(key==="tiempo_seg")
                $("#tablaVehiculosHeaderKeys").append("<th>Tiempo</th>");
            else
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
                else if(key==="tiempo_seg")
                    $("#tablaVehiculosBodyRow"+counter.toString()).append("<td>"+toHHMMSS(value)+" hs</td>");
                else
                    $("#tablaVehiculosBodyRow"+counter.toString()).append("<td>" + value + "</td>");

            });

            counter++;

            $("#tablaVehiculosBody").append("</tr>");
        });
        
        $("#tablaImportes").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
        });

    }
    
    function cargarVehiculos(desde, hasta) {
        
    	var data =  "fechaInicio=" + desde + "&" +
     		"fechaFin=" + hasta;
        
        $.ajax({
            type: "GET",
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

                    cargarTablaVehiculos(filtrarNoEstacionados(response));

                }
            }
        });
    }

    cargarVehiculos("","");

    $("#btnFiltrar").click(function(){
            
        cargarVehiculos($("#fechaInicio").val(),$("#fechaFin").val());
        
    });
});