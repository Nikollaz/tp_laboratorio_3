$(document).ready(function() {
    
    $("#Logins").click(function(event){

        event.preventDefault();

        $('#BusquedaBody').fadeOut('medium', function(){

            $("#BusquedaBody").load("./Front-end/HTML/Busquedas/EmpleadosLogins.html",function(){

                $.getScript("./Front-end/JS/Busquedas/EmpleadosLogins.js"); 
                $('#BusquedaBody').fadeIn('medium');

            });

        });
  
    });

    $("#Operaciones").click(function(event){

        event.preventDefault();

        $('#BusquedaBody').fadeOut('medium', function(){

            $("#BusquedaBody").load("./Front-end/HTML/Busquedas/EmpleadosOperaciones.html",function(){

                $.getScript("./Front-end/JS/Busquedas/EmpleadosOperaciones.js"); 
                $('#BusquedaBody').fadeIn('medium');

            });

        });
  
    });

});