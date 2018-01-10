var LOADING_GIF = "<img src='./Front-end/Resources/ajax_loader_gray_512.gif' style='max-width:25px;max-heigh:25px;'></img>";
var SERVER = "http://www.njsr27.com/API";
var vehiculos = null;
var ACTIVE_PROFILE = null;

$(document).ready(function() {
    
    if(localStorage.getItem("SessionToken") === null){ 

      $("#appHeader").html("");
      
      $('#appBody').fadeOut('medium', function(){
          
        $("#appBody").load("./Front-end/HTML/login.html",function(){
          
            $.getScript("./Front-end/JS/login.js"); 
            $('#appBody').fadeIn('medium');
             
        });
          
      });

    } else {

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
            
                if(response.Estado === "Error" && response.Mensaje === "Debe estar logeado para ver este contenido"){

                    $("#appHeader").html("");
                    
                    $('#appBody').fadeOut('medium', function(){
                        
                        $("#appBody").load("./Front-end/HTML/login.html",function(){
                            
                             $.getScript("./Front-end/JS/login.js");
                             $('#appBody').fadeIn('medium');
                             
                        });
                        
                    });
                    
                } else {
                    
                    ACTIVE_PROFILE = localStorage.getItem("perfil");
                    
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

                }
            }

        });

      })();

    }

});