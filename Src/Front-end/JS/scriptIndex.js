const LOADING_GIF = "<img src='./Front-end/Resources/35.gif' style='max-width:25px;max-heigh:25px;'></img>";
const SERVER = "http://localhost:8080/TPFinal/Src/API";

function login() {

    $("#email").css("border-color", "");
    $("#password").css("border-color", "");

    var email = $("#email").val();
    var password = $("#password").val();

    if (email !== "" && password !== "") {

    	var datos = "email=" + email + "&password=" + password;

        $.ajax({
        	type: "POST",
            url: SERVER + "/login",
            data: datos,
            dataType: "text",
            beforeSend: function() {

                $("#carga").html(LOADING_GIF);

            },
            success: function(response) {

                alert(response);
                /*
                    Respuesta de la validacion de login, En caso de que no se haya encotrado 
                    el usuario o haya estado mal el password, avisarlo con un mensaje. 
                    En caso de que sea exitoso, cargar el perfil del usuario en una cookie o session storage para 
                    futuro uso, y cargar una nueva pagina en el body del html. Por ejemplo,
                    llamar a un servicio que te traiga un array con los autos del estacionamiento, y a partir de la misma
                    cargar una tabla en el body del HTML
                */

                $("#carga").html("");
            }
        });

    }


    if ($("#email").val() === "") {
        alert("El campo de email es obligatorio");
        $("#email").css("border-color", "red");
    }

    if ($("#password").val() === "") {
        alert("El campo de password es obligatorio");
        $("#password").css("border-color", "red");
    }

}

function cargarTestUsuario() {
    $("#email").val("usuario@test.com");
    $("#password").val("usuario@test.com");
}

function cargarTestAdmin() {
    $("#email").val("admin@test.com");
    $("#password").val("admin@test.com");
}