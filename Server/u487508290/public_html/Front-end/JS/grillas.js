$(document).ready(function() {
    
    $("#estacionados").click(function(event){

        event.preventDefault();

        $('#grillasBody').fadeOut('medium', function(){

            $("#grillasBody").load("./Front-end/HTML/tablaEstacionados.html",function(){

                $.getScript("./Front-end/JS/tablaEstacionados.js"); 
                $('#grillasBody').fadeIn('medium');

            });

        });
  
    });

    $("#importes").click(function(event){

        event.preventDefault();

        $('#grillasBody').fadeOut('medium', function(){

            $("#grillasBody").load("./Front-end/HTML/tablaImportes.html",function(){

                $.getScript("./Front-end/JS/tablaImportes.js"); 
                $('#grillasBody').fadeIn('medium');

            });

        });
  
    });

    $("#usuarios").click(function(event){

        event.preventDefault();

        $('#grillasBody').fadeOut('medium', function(){

            $("#grillasBody").load("./Front-end/HTML/tablaUsuarios.html",function(){

                $.getScript("./Front-end/JS/tablaUsuarios.js"); 
                $('#grillasBody').fadeIn('medium');

            });

        });
  
    });

});