$(document).ready(function() {

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    if(getCookie("email") !== "" && getCookie("password") !== ""){

         $("#email").val(getCookie("email"));
         $("#password").val(getCookie("password"));

    }

    $("#loginBtn").click(function(){

        $("#email").css("border-color", "");
        $("#password").css("border-color", "");

        var email = $("#email").val();
        var password = $("#password").val();

        if (email !== "" && password !== "") {

            if($("#recordarme").is(':checked')){
                
                document.cookie = "email=" + email + ";";
                document.cookie = "password=" + password + ";";

            }

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

                    var SessionToken = JSON.parse(response).SessionToken;

                    if(SessionToken !== undefined){

                        localStorage.setItem("SessionToken", SessionToken);
                        ACTIVE_PROFILE = JSON.parse(response).perfil;
                        localStorage.setItem("perfil", ACTIVE_PROFILE);

                        $('#appHeader').fadeOut('medium', function(){
                            
                            $("#appHeader").load("./Front-end/HTML/mainAppHeader.html",function(){
                                
                                $.getScript("./Front-end/JS/mainAppHeader.js"); 
                                $('#appHeader').fadeIn('medium');
                                
                            });
                            
                        });
                        
                        $('#appBody').fadeOut('medium', function(){
                            
                            $("#appBody").load("./Front-end/HTML/mainAppBody.html",function(){
                                
                                $.getScript("./Front-end/JS/mainAppBody.js"); 
                                $('#appBody').fadeIn('medium');
                                
                            });
                            
                        });

                    } else {

                        alert(JSON.parse(response).Mensaje);

                    }

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

    }); 

     $("#testBtnUsuario").click(function(){
        $("#email").val("Jorge001@estacionamiento.com");
        $("#password").val("45678921");
    });

     $("#testBtnAdmin").click(function(){
        $("#email").val("Vladimir001@estacionamiento.com");
        $("#password").val("25021544");
    });


});