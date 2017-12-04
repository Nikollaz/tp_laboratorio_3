$(document).ready(function() {

    function cargarusuarios(usuarios){

        $("#tablaUsuariosHeader").html("");
        $("#tablaUsuariosBody").html("");

        /*
            Cargar de headers por keys
        */
        $("#tablaUsuariosHeader").append("<tr id='tablaUsuariosHeaderKeys'>");

        $.each(usuarios[0], function(key, persona) {
            
            $("#tablaUsuariosHeaderKeys").append("<th>" + key + "</th>");

        });

        $("#tablaUsuariosHeader").append("</tr>");

        /*
            Cargar de contenido por values
        */

        var counter = 0;

        $.each(usuarios, function(key, persona) {

            $("#tablaUsuariosBody").append("<tr id='tablaUsuariosBodyRow"+counter.toString()+"'>");

            $.each(persona, function(key, value) {
                
                if(key === "importe")
                    $("#tablaUsuariosBodyRow"+counter.toString()).append("<td>" + value + "$ </td>");
                else
                    $("#tablaUsuariosBodyRow"+counter.toString()).append("<td>" + value + "</td>");

            });

            counter++;

            $("#tablaUsuariosBody").append("</tr>");
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

                    $("#tablaUsuarios").html
                    (
                        "<div class='alert alert-danger'>" +
                            response.Mensaje +
                        "</div>"
                    );
                    $("#carga").html("");

                } else {

                    $("#carga").html("");
                    
                    usuarios = response;

                    cargarusuarios(filtrarUsuarios(response));

                }

            }
        });

    })();

    function filtrarUsuarios(usuarios){

        var usuariosFiltrados = usuarios.filter(function(a){

            return a.EmpleadoSalida !== null;

        }).map(function(a){

            var nuevoUsuario = a;

            if(a.suspendido == 0){
                nuevoUsuario.suspendido = "No";
            } else {
                nuevoUsuario.suspendido = "Si";
            }

            return nuevoUsuario;

        });

        return usuariosFiltrados;

    }

});