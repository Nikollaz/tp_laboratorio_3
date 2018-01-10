$(document).ready(function() {

    function cargarEmpleados(Empleados){
        
        if ( $.fn.dataTable.isDataTable( '#tablaEmpleadosDataTable' ) ) {
            var table = $('#tablaEmpleadosDataTable').DataTable();
            table.destroy();
        }

        $("#tablaEmpleadosHeader").html("");
        $("#tablaEmpleadosBody").html("");

        /*
            Cargar de headers por keys
        */
        $("#tablaEmpleadosHeader").append("<tr id='tablaEmpleadosHeaderKeys'>");

        $.each(Empleados[0], function(key, persona) {
            
            $("#tablaEmpleadosHeaderKeys").append("<th>" + key + "</th>");

        });

        $("#tablaEmpleadosHeader").append("</tr>");

        /*
            Cargar de contenido por values
        */

        var counter = 0;

        $.each(Empleados, function(key, persona) {

            $("#tablaEmpleadosBody").append("<tr id='tablaEmpleadosBodyRow"+counter.toString()+"'>");

            $.each(persona, function(key, value) {
                
                if(key === "suspendido"){
                    if(value===0)
                        $("#tablaEmpleadosBodyRow"+counter.toString()).append("<td>No</td>");
                    else
                        $("#tablaEmpleadosBodyRow"+counter.toString()).append("<td>Si</td>");
                }
                else
                    $("#tablaEmpleadosBodyRow"+counter.toString()).append("<td>" + value + "</td>");

            });

            counter++;

            $("#tablaEmpleadosBody").append("</tr>");
        });
        
        $("#tablaEmpleadosDataTable").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
        });

    }
    
    (function() {
        
        $.ajax({
            type: "GET",
            url: SERVER + "/empleados",
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

                    $("#tablaEmpleados").html
                    (
                        "<div class='alert alert-danger'>" +
                            response.Mensaje +
                        "</div>"
                    );
                    $("#carga").html("");

                } else {

                    $("#carga").html("");
                    
                    Empleados = response;

                    cargarEmpleados(response);

                }

            }
        });

    })();

});