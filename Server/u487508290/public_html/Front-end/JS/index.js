var LOADING_GIF = "<img src='./Front-end/Resources/35.gif' style='max-width:25px;max-heigh:25px;'></img>";
var SERVER = "http://www.njsr27.com/API";
var vehiculos = null;

$(document).ready(function() {
    
    if(localStorage.getItem("SessionToken") === null){ //Deberia añadirse la validacion de que ademas tenga datos validos

      $("#appHeader").html("");

      $("#appBody").load("./Front-end/HTML/login.html",function(){
         $.getScript("./Front-end/JS/login.js"); 
      });

    } else {

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
            
                if(response.Estado === "Error" && response.Mensaje === "Debe estar logeado para ver este contenido"){

                  $("#appHeader").html("");

                  $("#appBody").load("./Front-end/HTML/login.html",function(){
                     $.getScript("./Front-end/JS/login.js"); 
                  });

                } else {

                  $("#appHeader").load("./Front-end/HTML/mainAppHeader.html",function(){
                     $.getScript("./Front-end/JS/mainAppHeader.js"); 
                  });

                  $("#appBody").load("./Front-end/HTML/mainAppBody.html",function(){
                     $.getScript("./Front-end/JS/mainAppBody.js"); 
                  });

                }
            }

        });

      })();

    }

});