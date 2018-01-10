$(document).ready(function() {
    
    $("#cocheras").click(function(event){

        event.preventDefault();

        $('#grillasBody').fadeOut('medium', function(){

            $("#grillasBody").load("./Front-end/HTML/tablaCocheras.html",function(){

                $.getScript("./Front-end/JS/tablaCocheras.js"); 
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

    $("#empleados").click(function(event){

        event.preventDefault();

        $('#grillasBody').fadeOut('medium', function(){

            $("#grillasBody").load("./Front-end/HTML/tablaEmpleados.html",function(){

                $.getScript("./Front-end/JS/tablaEmpleados.js"); 
                $('#grillasBody').fadeIn('medium');

            });

        });
  
    });

});