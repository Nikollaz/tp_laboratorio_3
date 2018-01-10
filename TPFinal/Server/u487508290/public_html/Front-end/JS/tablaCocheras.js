$(document).ready(function() {

    function cargarCocheras(Cocheras){
        
        if ( $.fn.dataTable.isDataTable( '#tablaCocherasDataTable' ) ) {
            var table = $('#tablaCocherasDataTable').DataTable();
            table.destroy();
        }

        $("#tablaCocherasHeader").html("");
        $("#tablaCocherasBody").html("");

        /*
            Cargar de headers por keys
        */
        $("#tablaCocherasHeader").append("<tr id='tablaCocherasHeaderKeys'>");

        $.each(Cocheras[0], function(key, persona) {
            
            if(key==="ReservadoDiscEmbar")
                $("#tablaCocherasHeaderKeys").append("<th>Reservada para discapacitados</th>");
            else
                $("#tablaCocherasHeaderKeys").append("<th>" + key + "</th>");

        });

        $("#tablaCocherasHeader").append("</tr>");

        /*
            Cargar de contenido por values
        */

        var counter = 0;

        $.each(Cocheras, function(key, persona) {

            $("#tablaCocherasBody").append("<tr id='tablaCocherasBodyRow"+counter.toString()+"'>");

            $.each(persona, function(key, value) {
                
                if(key==="ReservadoDiscEmbar" || key==="ocupada"){
                    if(value===0)
                        $("#tablaCocherasBodyRow"+counter.toString()).append("<td>No</td>");
                    else
                        $("#tablaCocherasBodyRow"+counter.toString()).append("<td>Si</td>");
                }
                else if(key==="piso")
                    $("#tablaCocherasBodyRow"+counter.toString()).append("<td>" + value + "º</td>");
                else
                    $("#tablaCocherasBodyRow"+counter.toString()).append("<td>" + value + "</td>");

            });

            counter++;

            $("#tablaCocherasBody").append("</tr>");
        });
        
        $("#tablaCocherasDataTable").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
        });

    }
    
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

                    $("#tablaCocheras").html
                    (
                        "<div class='alert alert-danger'>" +
                            response.Mensaje +
                        "</div>"
                    );
                    
                    $("#carga").html("");

                } else {

                    $("#carga").html("");

                    cargarCocheras(response);

                }

            }
        });

    })();

});