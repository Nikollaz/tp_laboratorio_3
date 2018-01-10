$(document).ready(function() {
    
    $("#alta").click(function(event){

        event.preventDefault();

        $('#ABMVehiculosBody').fadeOut('medium', function(){

            $("#ABMVehiculosBody").load("./Front-end/HTML/ABM/Vehiculos/alta.html",function(){

                $.getScript("./Front-end/JS/ABM/Vehiculos/alta.js"); 
                $('#ABMVehiculosBody').fadeIn('medium');

            });

        });
  
    });

    $("#baja").click(function(event){

        event.preventDefault();

        $('#ABMVehiculosBody').fadeOut('medium', function(){

            $("#ABMVehiculosBody").load("./Front-end/HTML/ABM/Vehiculos/baja.html",function(){

                $.getScript("./Front-end/JS/ABM/Vehiculos/baja.js"); 
                $('#ABMVehiculosBody').fadeIn('medium');

            });

        });
  
    });

    $("#modificacion").click(function(event){

        event.preventDefault();

        $('#ABMVehiculosBody').fadeOut('medium', function(){

            $("#ABMVehiculosBody").load("./Front-end/HTML/ABM/Vehiculos/modificacion.html",function(){

                $.getScript("./Front-end/JS/ABM/Vehiculos/modificacion.js"); 
                $('#ABMVehiculosBody').fadeIn('medium');

            });

        });
  
    });

});