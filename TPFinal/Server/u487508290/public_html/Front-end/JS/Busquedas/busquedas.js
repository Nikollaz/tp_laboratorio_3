$(document).ready(function() {
    
    $("#Empleados").click(function(event){

        event.preventDefault();

        $('#busquedasBody').fadeOut('medium', function(){

            $("#busquedasBody").load("./Front-end/HTML/Busquedas/busquedaEmpleados.html",function(){

                $.getScript("./Front-end/JS/Busquedas/busquedaEmpleados.js"); 
                $('#busquedasBody').fadeIn('medium');

            });

        });
  
    });

    $("#Cocheras").click(function(event){

        event.preventDefault();

        $('#busquedasBody').fadeOut('medium', function(){

            $("#busquedasBody").load("./Front-end/HTML/Busquedas/busquedaCocheras.html",function(){

                $.getScript("./Front-end/JS/Busquedas/busquedaCocheras.js"); 
                $('#busquedasBody').fadeIn('medium');

            });

        });
  
    });

});